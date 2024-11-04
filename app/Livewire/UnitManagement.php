<?php

namespace App\Livewire;

use App\Models\Unit;
use Livewire\Component;

class UnitManagement extends Component
{
    public $productId;
    public $unitId;
    public $unit_name;
    public $quantity_per_unit;
    public $units = [];

    protected $rules = [
        'unit_name' => 'required|string|max:50',
        'quantity_per_unit' => 'required|integer|min:1',
    ];

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->loadUnits();
    }

    public function loadUnits()
    {
        $this->units = Unit::where('product_id', $this->productId)->get();
    }

    public function saveUnit()
    {
        $this->validate();

        Unit::updateOrCreate(
            ['id' => $this->unitId],
            [
                'product_id' => $this->productId,
                'name' => $this->unit_name,
                'qty' => $this->quantity_per_unit,
            ]
        );

        $this->resetForm();
        $this->loadUnits();
    }

    public function editUnit($id)
    {
        $unit = Unit::findOrFail($id);
        $this->unitId = $unit->id;
        $this->unit_name = $unit->name;
        $this->quantity_per_unit = $unit->qty;
    }

    public function deleteUnit($id)
    {
        Unit::findOrFail($id)->delete();
        $this->loadUnits();
    }

    public function resetForm()
    {
        $this->unitId = null;
        $this->unit_name = '';
        $this->quantity_per_unit = '';
    }

    public function render()
    {
        return view('livewire.unit-management');
    }
}
