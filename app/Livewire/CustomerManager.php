<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Component;

class CustomerManager extends Component
{
    public $code, $name, $address, $customer_id;
    public $search = '';
    public $isModalOpen = 0;

    public function render()
    {
        $customers = Customer::where('name', 'like', '%' . $this->search . '%')->paginate(10);

        return view('livewire.customer.index', compact('customers'))->layout('layouts.app');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetInputFields()
    {
        $this->code = '';
        $this->name = '';
        $this->address = '';
    }

    public function store()
    {
        $this->validate([
            'code' => 'string|max:255|nullable',
            'name' => 'required|string|max:255',
            'address' => 'string|max:255|nullable',
        ]);

        Customer::updateOrCreate(['id' => $this->customer_id], [
            'code' => $this->code,
            'name' => $this->name,
            'address' => $this->address
        ]);

        session()->flash('message', $this->customer_id ? 'Customer updated successfully.' : 'Customer created successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $this->customer_id = $id;
        $this->code = $customer->code;
        $this->name = $customer->name;
        $this->address = $customer->address;

        $this->openModal();
    }

    public function delete($id)
    {
        Customer::find($id)->delete();
        session()->flash('message', 'Customer deleted successfully.');
    }
}