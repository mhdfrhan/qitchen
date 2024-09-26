<?php

namespace App\Livewire\Home\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Profile extends Component
{
    public $name, $email;
    public $current_password, $password, $password_confirmation;

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function updateProfileInformation()
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        $user->save();

        $this->dispatch('notify', message: 'Profile successfully updated', type: 'success');
    }

    public function updatePassword()
    {
        // Validasi input
        try {
            $this->validate([
                'current_password' => ['required', 'string'],
                'password' => ['required', 'string', 'confirmed', Password::min(8)->letters()->numbers()->mixedCase()],
            ]);
        } catch (ValidationException $th) {
            $this->dispatch('notify', message: $th->getMessage(), type: 'error');
            //throw $th;
        }

        $user = Auth::user();

        // Memeriksa apakah kata sandi saat ini benar
        if (!Hash::check($this->current_password, $user->password)) {
            $this->dispatch('notify', message: 'Current password is incorrect', type: 'error');
            return;
        }

        // Update kata sandi pengguna
        $user->password = Hash::make($this->password);
        $user->save();

        // Notifikasi sukses
        $this->dispatch('notify', message: 'Password successfully updated', type: 'success');

        // Reset input
        $this->reset(['current_password', 'password', 'password_confirmation']);
    }

    public function render()
    {
        return view('livewire.home.dashboard.profile');
    }
}
