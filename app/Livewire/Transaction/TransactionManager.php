<?php

namespace App\Livewire\Transaction;

use App\Models\Unit;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use Mike42\Escpos\Printer;
use App\Models\Transaction;
use Livewire\Attributes\On;
use Mike42\Escpos\EscposImage;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\DB;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class TransactionManager extends Component
{
    public $search = '';
    public $searchCustomer = '';
    public $products = [];
    public $customers = [];
    public $customer;
    public $paymentMethod = 'tunai';
    public $cart = [];
    public $total_price;
    public $totalPaid;
    public $changeDue;
    public $selectedProductId;
    public $selectedCustomer = null;
    public $highlightIndex = 0;

    public function mount()
    {
        $this->cart = session()->get('cart', []);
        $this->updateTotal();
    }

    public function addToCart($productId)
    {
        $product = Product::with('units')->find($productId);

        if (!$product) {
            return;
        }

        $defaultUnit = $product->units->first() ? $product->units->first()->id : '';

        $index = collect($this->cart)->search(fn($item) => $item['id'] === $product->id);

        if ($index !== false) {
            $this->cart[$index]['sub_quantity'] += 1;
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

        $this->updateTotal();
        $this->calculateSubtotal($index ?? count($this->cart) - 1);

        $this->dispatch('focusQty', count($this->cart) - 1);

        session()->put('cart', $this->cart);
        $this->resetSearch();
    }


    public function updateTotal()
    {
        $this->total_price = collect($this->cart)->sum('subtotal');
        session()->put('total', $this->total_price);
        $this->updatedTotalPaid();
    }

    public function updateQuantityOnUnitChange($index)
    {
        $selectedUnitId = $this->cart[$index]['unit'];
        $subQuantity = $this->cart[$index]['sub_quantity'];
        $unit = Unit::find($selectedUnitId);

        if ($unit) {
            $this->cart[$index]['quantity'] = $subQuantity * $unit->multiplier;
            $this->updateQuantity($index, $subQuantity);
        } else {
            $this->cart[$index]['quantity'] = $subQuantity;
            $this->updateQuantity($index, $subQuantity);
        }
    }

    public function updateQuantity($index, $quantity)
    {
        $selectedUnitId = $this->cart[$index]['unit'];
        $unit = Unit::find($selectedUnitId);

        if (empty($unit)) {
            $this->cart[$index]['quantity'] = $quantity;
        } else {
            $this->cart[$index]['quantity'] = $quantity * $unit->multiplier;
        }
        $this->calculateSubtotal($index);
    }

    public function removeFromCart($id)
    {
        $this->cart = session()->get('cart', []);
        $index = collect($this->cart)->search(fn($item) => $item['id'] === $id);

        if ($index !== false) {
            unset($this->cart[$index]);
            $this->cart = array_values($this->cart);
            session()->put('cart', $this->cart);
        }

        $this->updateTotal();
    }

    public function store()
    {
        $transaction = $this->saveTransaction();

        if ($transaction) {
            session()->forget('cart');
            session()->flash('message', 'Transaksi berhasil disimpan.');
            $this->resetCart();
        }
    }

    public function andprint()
    {
        $transaction = $this->saveTransaction();

        if ($transaction) {
            $this->resetCart();
            $this->printNota();
            session()->forget('cart');
        }
    }

    public function printNota()
    {
        $cart = session()->get('cart', []);
        $total = session()->get('total', '');
        $date = now()->format('H:i:s d-m-Y');

        $connector = new WindowsPrintConnector("thermal");

        /* Start the printer */
        $logo = EscposImage::load(public_path("images/logo_habiba.png"), true);
        $printer = new Printer($connector);

        try {
            // Operasi mencetak
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->bitImage($logo);

            /* Name of shop */
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer->text("Habiba Store\n");
            $printer->selectPrintMode();
            $printer->text("Melayani dengan sepenuh hati\n");
            $printer->text("Jl. Benteng Portugis, RT 02,\n RW 02, Ujungwatu\n");
            $printer->text("0853 2646 4699\n");
            $printer->text("================================\n");
            $printer->feed();

            // items
            foreach ($cart as $item) {
                $printer->setJustification(Printer::JUSTIFY_LEFT);
                $printer->text($item['name'] . "\n");
                $printer->setJustification(Printer::JUSTIFY_RIGHT);
                $printer->text(number_format($item['price'], 0, ',', '.') . " X " . $item['quantity'] . "              " . number_format($item['subtotal'], 0, ',', '.') .  "\n");
            }
            $printer->feed();

            // total
            $printer->setEmphasis(true);
            $printer->setJustification(Printer::JUSTIFY_RIGHT);
            $printer->text("total: " . number_format($total, 0, ',', '.'));
            $printer->setEmphasis(false);

            /* Footer */
            $printer->feed(2);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->setTextSize(1, 8);
            $printer->text("TERIMA KASIH\n");
            $printer->text("Semoga berkah selalu :)\n");
            $printer->feed();
            $printer->text($date . "\n");

            $printer->cut();
        } catch (Exception $e) {
            /* Images not supported on your PHP, or image file not found */
            $printer->text($e->getMessage() . "\n");
        } finally {
            $printer->close(); // Menutup koneksi selalu dilakukan
        }
    }

    private function resetCart()
    {
        $this->cart = [];
        $this->total_price = 0;
        $this->totalPaid = 0;
        $this->changeDue = 0;
        $this->customer = null;
        $this->totalPaid = null;

        $this->resetSearch();
    }

    public function render()
    {
        return view('livewire.transaction.index');
    }

    private function saveTransaction()
    {
        if ($this->paymentMethod === 'utang' && empty($this->customer)) {
            $this->addError('customer', 'Data customer harus diisi jika metode pembayaran adalah utang.');
            return false;
        } else {
            $status = $this->paymentMethod === 'utang' ? 'Belum Lunas' : null;
            $utang = $this->paymentMethod === 'utang' ? $this->total_price - $this->totalPaid : null;

            DB::beginTransaction();

            try {
                $transaction = Transaction::create([
                    'customer_id' => $this->customer->id ?? null,
                    'payment_method' => $this->paymentMethod,
                    'total_price' => $this->total_price,
                    'total_paid' => $this->totalPaid,
                    'change_due' => $this->changeDue,
                    'debt' => $utang,
                    'debt_status' => $status,
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
                return $transaction;
            } catch (\Exception $e) {
                DB::rollBack();
                $this->addError('error', 'Terjadi kesalahan: ' . $e->getMessage());
                return false;
            }
        }
    }

    // shorcut
    #[On('uangPas')]
    public function uangPas()
    {
        $this->bayarPas();
    }

    #[On('simpanTransaksi')]
    public function simpanTransaksi()
    {
        $this->store();
    }

    #[On('andPrint')]
    public function shortcutAndPrint()
    {
        $this->andprint();
    }
    // endshorcut

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

    public function bayarPas()
    {
        $this->totalPaid = $this->total_price;
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

    public function updatedTotalPaid()
    {
        if (empty($this->totalPaid)) {
            $this->changeDue = 0;
        } else {
            $this->changeDue = $this->totalPaid - $this->total_price;
        }
    }
}
