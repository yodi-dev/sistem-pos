<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class TransactionManager extends Component
{
    public $products = [], $cart = [], $total_price = 0, $total_paid, $change_due = 0, $search = '', $selectedCategory = null;

    // public function mount()
    // {
    //     $this->products = Product::all();
    // }

    public function addToCart($productId)
    {
        $product = Product::find($productId);
        $this->cart[] = [
            'id' => $product->id,
            'name' => $product->name,
            'category_id' => $product->category_id,
            'price' => $product->price,
            'quantity' => 1,
            'subtotal' => $product->price
        ];

        $this->calculateTotal();
    }

    public function removeFromCart($index)
    {
        unset($this->cart[$index]);
        $this->cart = array_values($this->cart);
        $this->calculateTotal();
    }

    public function updateQuantity($index, $quantity)
    {
        $this->cart[$index]['quantity'] = $quantity;
        $this->cart[$index]['subtotal'] = $this->cart[$index]['price'] * $quantity;
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total_price = array_sum(array_column($this->cart, 'subtotal'));
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
        $productsQuery = Product::query();

        if ($this->search) {
            $productsQuery->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->selectedCategory) {
            $productsQuery->where('category_id', $this->selectedCategory);
        }

        $this->products = $productsQuery->get();

        return view('livewire.transaction.index', [
            'products' => $this->products,
            'categories' => Category::all()
        ])->layout('layouts.app');
    }
}
