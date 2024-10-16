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

        switch (Auth::user()->role) {
            case 'admin':
                $this->redirect(route('dashboard'), navigate: false);
                break;
            case 'koki':
                $this->redirect(route('kitchen'), navigate: false);
                break;
            case 'kasir':
                $this->redirect(route('kasir'), navigate: false);
                break;
            default:
                $this->redirect(route('home.dashboard'), navigate: false);
                break;
        }
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email"
                required autofocus autocomplete="username" placeholder="Email" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password"
                name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember" class="inline-flex items-center cursor-pointer">
                <input wire:model="form.remember" id="remember" type="checkbox"
                    class="rounded border-borderColor text-[#948968] shadow-sm focus:ring-light" name="remember">
                <span class="ms-2 text-sm text-neutral-400 select-none">{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm text-neutral-400 duration-300 hover:text-light" href="{{ route('password.request') }}"
                    wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="w-full">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <div class="mt-4 text-center">
            <a href="{{ route('auth.google') }}"
                class="border border-borderColor px-4 py-2 rounded-lg inline-flex items-center gap-3 text-light hover:bg-neutral-900 duration-300">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Google_%22G%22_logo.svg/480px-Google_%22G%22_logo.svg.png"
                    alt="Google Logo" class="h-6">
                <p>Login with Google</p>
            </a>
        </div>
        <p class="text-sm text-neutral-400 text-center mt-3">Don't have an account? <a
                class="text-light hover:underline" href="{{ route('register') }}" wire:navigate>Register</a></p>
    </form>
</div>
