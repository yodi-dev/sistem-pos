<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Product;
use Livewire\Component;
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


    public function updatedSearch()
    {
        $this->products = Product::where('name', 'like', '%' . $this->search . '%')->get();

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

    public function addToCart($productId)
    {
        $product = Product::find($productId);

        if ($product) {
            // Cek apakah produk sudah ada di keranjang
            $index = collect($this->cart)->search(fn($item) => $item['id'] === $product->id);

            if ($index !== false) {
                // Jika produk sudah ada, update quantity dan subtotal
                $this->cart[$index]['quantity'] += 1;
                $this->cart[$index]['subtotal'] = $this->cart[$index]['quantity'] * $product->retail_price;
            } else {
                // Jika produk belum ada, tambahkan ke keranjang
                $this->cart[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'quantity' => 1,
                    'retail_price' => $product->retail_price,
                    'subtotal' => $product->retail_price,
                ];
            }

            $this->updateTotal();
        }

        $this->resetSearch();
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

    public function updateQuantity($index, $quantity)
    {
        // Update kuantitas dan subtotal item di keranjang
        $this->cart[$index]['quantity'] = $quantity;
        $this->cart[$index]['subtotal'] = $this->cart[$index]['quantity'] * Product::find($this->cart[$index]['id'])->retail_price;
        $this->updateTotal();
    }

    public function updateTotal()
    {
        $this->total_price = collect($this->cart)->sum('subtotal');
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
                'total_paid' => $this->total_paid,
                'change_due' => $this->total_paid - $this->total_price,
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

    public function resetCart()
    {
        $this->cart = [];
        $this->total_price = 0;
        $this->total_paid = null;
        $this->change_due = 0;
    }

    public function render()
    {
        return view('livewire.transaction.index')->layout('layouts.app');
    }
}
