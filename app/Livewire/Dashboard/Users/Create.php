<?php

namespace App\Livewire\Dashboard\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Create extends Component
{
    public $name, $email, $phone, $role = 'user', $password;

    protected $rules = [
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|numeric|digits_between:10,16',
        'role' => 'required',
        'password' => 'required'
    ];

    public function createUser()
    {
        $this->validate();

        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->dispatch('notify', message: collect($e->errors())->flatten()->first(), type: 'error');
            return;
        }


        try {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'phone' => $this->phone,
                'role' => $this->role ?? 'user',
                'created_at' => now()
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Failed to add user: ' . $e->getMessage(), type: 'error');
            return;
        }

        if ($user) {
            $this->dispatch('notify', message: 'Successfully added a user', type: 'success');
            $this->dispatch('userAdded');
            $this->reset();
        } else {
            $this->dispatch('notify', message: 'Failed to add user', type: 'error');
            return;
        }
        $this->dispatch('close-modal', 'user-create');
    }

    public function render()
    {
        return view('livewire.dashboard.users.create');
    }
}
