<?php

namespace App\Livewire;

use App\Models\Unit;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;

class TransactionManager extends Component
{
    public $search = '';
    public $searchCustomer = '';
    public $products = [];
    public $customers = [];
    public $customer;
    public $paymentMethod;
    public $cart = [];
    public $total_price;
    public $totalPaid;
    public $changeDue;
    public $selectedProductId;
    public $selectedCustomer = null;
    public $highlightIndex = 0;

    public function mount()
    {
        foreach ($this->cart as $index => $item) {
            // Set default unit as the first unit of the product, or "PCS" if no units are available
            $this->cart[$index]['unit'] = !empty($item['units']) ? $item['units'][0]->id : 'Default';
        }
    }

    public function updateQuantityOnUnitChange($index)
    {
        $selectedUnitId = $this->cart[$index]['unit'];
        $subQuantity = $this->cart[$index]['sub_quantity'];
        $unit = Unit::find($selectedUnitId);

        if ($unit) {
            $this->cart[$index]['quantity'] = $subQuantity * $unit->qty;
            // $this->calculateSubtotal($index);
            $this->updateQuantity($index, $subQuantity);
        }
    }

    public function updateQuantity($index, $quantity)
    {
        $selectedUnitId = $this->cart[$index]['unit'];
        $unit = Unit::find($selectedUnitId);

        $this->cart[$index]['quantity'] = $quantity * $unit->qty;
        $this->calculateSubtotal($index);
    }

    private function calculateSubtotal($index)
    {
        $product = Product::find($this->cart[$index]['id']);
        $this->cart[$index]['subtotal'] = $this->cart[$index]['quantity'] * $product->retail_price;
        $this->updateTotal();
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);

        if ($product) {
            $index = collect($this->cart)->search(fn($item) => $item['id'] === $product->id);

            if ($index !== false) {
                $this->cart[$index]['quantity'] += 1;
            } else {
                $this->cart[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'sub_quantity' => 1,
                    'quantity' => 1,
                    'price' => $product->price,
                    'subtotal' => $product->price,
                    'units' => $product->units,
                ];
            }

            $this->calculateSubtotal($index ?? count($this->cart) - 1);
            $this->resetSearch();
        }
    }

    public function updatedSearch()
    {
        $this->products = Product::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('code', 'like', '%' . $this->search . '%')
            ->get();


        if (empty($this->search)) {
            $this->products = [];
        }
    }

    public function updatedSearchCustomer()
    {
        $this->customers = Customer::where('name', 'like', '%' . $this->searchCustomer . '%')->get();

        if (empty($this->searchCustomer)) {
            $this->customers = [];
        }
    }

    public function selectNext()
    {
        if ($this->highlightIndex < count($this->products) - 1) {
            $this->highlightIndex++;
        }
    }

    public function selectPrevious()
    {
        if ($this->highlightIndex > 0) {
            $this->highlightIndex--;
        }
    }

    public function selectNextCust()
    {
        if ($this->highlightIndex < count($this->customers) - 1) {
            $this->highlightIndex++;
        }
    }

    public function confirmSelection()
    {
        if (!empty($this->products)) {
            $selectedProduct = $this->products[$this->highlightIndex];
            $this->addToCart($selectedProduct->id);
            $this->updateTotal();
            $this->highlightIndex = 0;
        }
    }

    public function confirmCustomer()
    {
        if (!empty($this->customers)) {
            $selectedCustomer = $this->customers[$this->highlightIndex];
            $this->addCustomer($selectedCustomer->id);
            $this->highlightIndex = 0;
        }
    }





    public function addNominal($amount)
    {
        $this->totalPaid += $amount;
        $this->updatedTotalPaid();
    }

    public function clearTotalPaid()
    {
        $this->totalPaid = 0;
        $this->updatedTotalPaid();
    }

    public function addPayment($method)
    {
        $this->paymentMethod = $method;
        if ($method === 'utang') {
            $this->totalPaid = 0;
        }
    }

    public function addCustomer($customerId)
    {
        $customer = Customer::find($customerId);

        if ($customer) {
            $this->customer = $customer;
            $this->selectedCustomer = $customer;
            $this->searchCustomer = $customer->name;
        }
        $this->resetSearch();
    }

    public function resetSearch()
    {
        $this->products = [];
        $this->search = '';
        $this->customer = null;
        $this->paymentMethod = null;
    }

    public function removeFromCart($index)
    {
        unset($this->cart[$index]);
        $this->updateTotal();
    }

    public function updateTotal()
    {
        $this->total_price = collect($this->cart)->sum('subtotal');
        $this->updatedTotalPaid();
    }

    public function updatedTotalPaid()
    {

        if (empty($this->totalPaid)) {
            $this->changeDue = 0;
        } else {
            $this->changeDue = $this->totalPaid - $this->total_price;
        }
    }

    public function store()
    {
        DB::beginTransaction();

        try {
            $transaction = Transaction::create([
                'total_price' => $this->total_price,
                'total_paid' => $this->totalPaid,
                'change_due' => $this->changeDue,
                'customer_id' => $this->customer->id,
                'payment_methode' => $this->paymentMethod,
            ]);

            foreach ($this->cart as $item) {
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['subtotal'],
                ]);

                // mengurangi stok produk
                $product = Product::find($item['id']);
                $product->stock -= $item['quantity'];
                $product->save();
            }

            DB::commit();
            session()->flash('message', 'Transaksi berhasil disimpan.');
            $this->resetCart();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function resetCart()
    {
        $this->cart = [];
        $this->total_price = 0;
        $this->totalPaid = 0;
        $this->changeDue = 0;
    }

    public function render()
    {
        return view('livewire.transaction.index')->layout('layouts.app');
    }
}
