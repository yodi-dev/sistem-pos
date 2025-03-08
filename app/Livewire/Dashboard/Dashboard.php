<?php

namespace App\Livewire\Dashboard;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Wholesale;
use Livewire\Attributes\On;
use App\Models\WholesaleItem;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}
