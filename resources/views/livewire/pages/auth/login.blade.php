<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('transactions', absolute: false), navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="card w-96 bg-base-100 shadow-lg rounded-lg">
        <div class="card-body">
            <form wire:submit="login">
                <!-- Email Address -->
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <x-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email"
                        required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="form-control mb-6">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" wire:model="form.password" name="password" required id="password"
                        placeholder="********" class="input input-bordered w-full" />
                    <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="btn w-full">
                        {{ __('Masuk') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
