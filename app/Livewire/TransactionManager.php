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

        if (empty($unit)) {
            $this->cart[$index]['quantity'] = $quantity * $selectedUnitId;
        } else {
            $this->cart[$index]['quantity'] = $quantity * $unit->qty;
        }
        $this->calculateSubtotal($index);
    }

    private function calculateSubtotal($index)
    {
        // $product = Product::find($this->cart[$index]['id']);
        $this->cart[$index]['subtotal'] = $this->cart[$index]['quantity'] * $this->cart[$index]['price'] - ($this->cart[$index]['discount'] ?? 0);
        $this->updateTotal();
    }

    public function updatePriceType($index, $type)
    {
        $product = Product::find($this->cart[$index]['id']);

        // Ubah harga berdasarkan tipe harga yang dipilih
        switch ($type) {
            case 'retail_price':
                $this->cart[$index]['price'] = $product->retail_price;
                break;
            case 'distributor_price':
                $this->cart[$index]['price'] = $product->distributor_price;
                break;
            case 'agent_price':
                $this->cart[$index]['price'] = $product->agent_price;
                break;
            case 'reseller_price':
                $this->cart[$index]['price'] = $product->reseller_price;
                break;
            default:
                $this->cart[$index]['price'] = $product->retail_price;
                break;
        }

        // Update subtotal jika harga berubah
        $this->calculateSubtotal($index);
    }

    public function updateDiscount($index, $discount)
    {
        $this->cart[$index]['discount'] = (float)$discount;
        $this->calculateSubtotal($index);
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
        $this->updateTotal();
    }

    public function addCustomer($customerId)
    {
        $customer = Customer::find($customerId);

        if ($customer) {
            $this->customer = $customer;
            $this->selectedCustomer = $customer;
            $this->searchCustomer = $customer->name;
        }
        $this->resetErrorBag('customer');
        // $this->resetSearch();
    }

    public function resetSearch()
    {
        $this->products = [];
        $this->search = '';
        $this->searchCustomer = '';
        $this->customers = [];
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

    public function addToCart($productId)
    {
        $product = Product::find($productId);

        $defaultUnit = $product->units->first() ? $product->units->first()->id : '1';

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
                    'price' => $product->retail_price,
                    'subtotal' => $product->retail_price,
                    'units' => $product->units,
                    'unit' => $defaultUnit
                ];
            }

            $this->calculateSubtotal($index ?? count($this->cart) - 1);
            $this->resetSearch();
        }
    }

    public function store()
    {
        // validasi customer jika pembayaran dengan utang
        if ($this->paymentMethod === 'utang' && empty($this->customer)) {
            $this->addError('customer', 'Data customer harus diisi jika metode pembayaran adalah utang.');
            return;
        } elseif ($this->paymentMethod === 'utang') {
            $status = 'Belum Lunas';
            $utang = $this->total_price - $this->totalPaid;
        } else {
            $status = null;
            $utang = null;
        }

        DB::beginTransaction();

        try {
            $transaction = Transaction::create([
                'customer_id' => $this->customer->id ?? null,
                'payment_method' => $this->paymentMethod,
                'total_price' => $this->total_price,
                'total_paid' => $this->totalPaid,
                'change_due' => $this->changeDue,
                'utang' => $utang,
                'status' => $status,
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

    public function andprint()
    {
        $this->store();
    }

    private function resetCart()
    {
        $this->cart = [];
        $this->total_price = 0;
        $this->totalPaid = 0;
        $this->changeDue = 0;
        $this->paymentMethod = null;
        $this->customer = null;
        $this->totalPaid = null;

        $this->resetSearch();
    }

    public function render()
    {
        return view('livewire.transaction.index');
    }
}
