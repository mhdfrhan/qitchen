<?php

namespace App\Livewire\Dashboard\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Detail extends Component
{
    public $userId;
    public $user;
    public $status;
    public $name, $email, $phone, $newPassword;

    public function mount($userId)
    {
        $this->userId = $userId;
        $this->loadUser();
    }

    public function loadUser()
    {
        $this->user = User::find($this->userId);
        if ($this->user) {
            $this->status = $this->user->role;
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->phone = $this->user->phone;
        }
    }

    public function updateUser()
    {
        try {
            if ($this->user) {
                $this->user->name = $this->name;
                $this->user->email = $this->email;
                $this->user->phone = $this->phone;
                $this->user->role = $this->status;

                // Update password if provided
                if ($this->newPassword) {
                    $this->user->password = Hash::make($this->newPassword);
                }

                $this->user->save();

                $this->dispatch('userUpdated');
                $this->dispatch('close-modal', 'user-detail');
                $this->dispatch('notify', message: 'User details updated successfully.', type: 'success');
            }
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Failed to update user: ' . $e->getMessage(), type: 'error');
        }
    }



    public function render()
    {
        return view('livewire.dashboard.users.detail');
    }
}
