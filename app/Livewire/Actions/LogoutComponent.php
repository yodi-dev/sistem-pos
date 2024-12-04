<?php

namespace App\Livewire\Actions;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutComponent extends Component
{
    public function render()
    {
        return view('livewire.actions.logout-component');
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        return redirect('/');
    }
}
