<?php

namespace App\Livewire\Wholesale;

use Livewire\Component;
use App\Models\Wholesale;
use Livewire\Attributes\On;
use Barryvdh\DomPDF\Facade\Pdf;

class WholesaleManager extends Component
{
    public $wholesales;
    public $selectedWholesale;
    public $showDetailModal = false;

    public function render()
    {
        $this->wholesales = Wholesale::with('supplier', 'wholesaleItems')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($wholesale) {
                $totalBarang = $wholesale->wholesaleItems->sum('quantity');
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

    public function printWholesale($id)
    {
        return redirect()->route('wholesale.print', $id);
    }

    public function print($id)
    {
        $selectedWholesale = Wholesale::with(['supplier', 'wholesaleItems.product'])->findOrFail($id);

        $data = [
            'selectedWholesale' => $selectedWholesale,
        ];

        $pdf = Pdf::loadView('wholesale.print', $data);

        return $pdf->download('detail_kulakan.pdf');
    }


    public function delete($id)
    {
        Wholesale::find($id)->delete();
        $this->dispatch('showToast', 'Berhasil menghapus data kulakan.');
    }

    #[On('closeModal')]
    public function closeModal()
    {
        $this->showDetailModal = false;
    }
}
