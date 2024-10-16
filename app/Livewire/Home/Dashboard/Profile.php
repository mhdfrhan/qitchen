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
    public $current_password, $password, $password_confirmation, $phone;

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->phone = Auth::user()->phone;
    }

    public function updateProfileInformation()
    {
        $user = Auth::user();

        try {
            $validated = $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
                'phone' => ['required', 'numeric'],
            ]);
        } catch (ValidationException $th) {
            $this->dispatch('notify', message: $th->getMessage(), type: 'error');
            return;
        }

        if ($user->phone == null) {
            $this->dispatch('phoneAdded');
        }

        $user->fill($validated);
        $user->save();


        $this->dispatch('notify', message: 'Profile successfully updated', type: 'success');
    }


    public function updatePassword()
    {
        $user = Auth::user();

        try {
            $this->validate([
                'password' => ['required', 'string', 'confirmed', Password::min(8)],
            ]);
        } catch (ValidationException $th) {
            $this->dispatch('notify', message: $th->getMessage(), type: 'error');
            return;
        }

        if ($user->google_id) {
            $user->password = Hash::make($this->password);
            $user->save();

            $this->dispatch('notify', message: 'Password successfully updated', type: 'success');
            $this->reset(['password', 'password_confirmation']);
        } else {
            if (!Hash::check($this->current_password, $user->password)) {
                $this->dispatch('notify', message: 'Current password is incorrect', type: 'error');
                return;
            }

            $user->password = Hash::make($this->password);
            $user->save();

            $this->dispatch('notify', message: 'Password successfully updated', type: 'success');
            $this->reset(['current_password', 'password', 'password_confirmation']);
        }
    }


    public function render()
    {
        return view('livewire.home.dashboard.profile');
    }
}
