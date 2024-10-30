<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;

class TransactionManager extends Component
{
    public $search = '';
    public $products = [];
    public $cart = [];
    public $total_price = 0;
    public $total_paid = 0;
    public $change_due = 0,
        $selectedProductId;

    public function updatedSearch()
    {
        $this->products = Product::where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);

        if ($product) {
            $this->cart[] = [
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => 1,
                'subtotal' => $product->price,
            ];
            $this->updateTotal();
        }
        $this->resetSearch();
    }

    public function resetSearch()
    {
        $this->products = [];
        $this->search = '';
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
        $this->cart[$index]['subtotal'] = $this->cart[$index]['quantity'] * Product::find($this->cart[$index]['id'])->price;
        $this->updateTotal();
    }

    public function updateTotal()
    {
        $this->total_price = collect($this->cart)->sum('subtotal');
    }

    public function store()
    {
        DB::beginTransaction();

        try {
            $transaction = Transaction::create([
                'total_price' => $this->total_price,
                'total_paid' => $this->total_paid,
                'change_due' => $this->total_paid - $this->total_price,
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
