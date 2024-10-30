<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Component;

class CustomerManager extends Component
{
    public $customers;

    public function render()
    {
        $this->customers = Customer::all();
        return view('livewire.customer.index')->layout('layouts.app');
    }
}
