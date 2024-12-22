<?php

namespace App\Livewire\Product;

use App\Models\Unit;
use App\Models\Product;
use Livewire\Component;

class UnitManager extends Component
{
    public $product, $productId;
    public $unitId, $unit_name, $quantity_per_unit;
    public $units = [];

    public function render()
    {
        return view('livewire.product.unit-manager');
    }

    public function mount($id)
    {
        $product = Product::find($id);
        $this->productId = $id;
        $this->product = $product;
        $this->units = $this->product->units;
    }

    protected $rules = [
        'unit_name' => 'required|string|max:50',
        'quantity_per_unit' => 'required|integer|min:1',
    ];

    public function fillDefaultValues($name, $quantity)
    {
        $this->unit_name = $name;
        $this->quantity_per_unit = $quantity;
    }

    public function deleteUnit($unitId)
    {
        $unit = Unit::find($unitId);
        if ($unit) {
            $unit->delete();
            $this->units = $this->product->units;
        }
    }

    public function resetForm()
    {
        $this->unitId = null;
        $this->unit_name = '';
        $this->quantity_per_unit = '';
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
        $this->units = $this->product->units;
    }
}
