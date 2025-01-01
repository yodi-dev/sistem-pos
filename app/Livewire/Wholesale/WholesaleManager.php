<?php

namespace App\Livewire\Wholesale;

use Livewire\Component;
use App\Models\Wholesale;
use Livewire\Attributes\On;

class WholesaleManager extends Component
{
    public $wholesales;
    public $selectedWholesale;
    public $showDetailModal = false;

    public function render()
    {
        $this->wholesales = Wholesale::with('supplier', 'wholesaleItems') // Memuat relasi wholesaleItems
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($wholesale) {
                // Hitung total jumlah barang untuk setiap wholesale
                $totalBarang = $wholesale->wholesaleItems->sum('quantity'); // Menjumlahkan quantity dari wholesaleItems
                $wholesale->total_barang = $totalBarang;
                return $wholesale;
            });

        return view('livewire.wholesale.wholesale-manager');
    }

    public function show($id)
    {
        $this->selectedWholesale = Wholesale::with('supplier', 'wholesaleItems.product')->find($id);
        $this->showDetailModal = true;
    }

    public function delete($id)
    {
        Wholesale::find($id)->delete();
        session()->flash('message', 'Produk berhasil dihapus.');
    }

    #[On('closeModal')]
    public function closeModal()
    {
        $this->showDetailModal = false;
    }
}
