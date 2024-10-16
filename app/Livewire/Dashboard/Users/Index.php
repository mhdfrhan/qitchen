<?php

namespace App\Livewire\Dashboard\Users;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = 'user';
    public $selectedUserId = null;

    protected $queryString = ['search', 'filterStatus'];

    public function updatingSearch()
    {
        $this->resetPage();
        $this->selectedUserId = null;
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
        $this->selectedUserId = null;
    }

    public function selectUser($userId)
    {
        $user = $this->getUserQuery()->find($userId);
        if ($user) {
            $this->selectedUserId = $userId;
            $this->dispatch('set-user-id', ['id' => encrypt($userId)]);
            $this->dispatch('open-modal', 'user-detail');
        }
    }

    protected function getUserQuery()
    {
        $query = User::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterStatus == 'admin') {
            $query->where('role', 'admin');
        } elseif ($this->filterStatus == 'user') {
            $query->where('role', 'user');
        } elseif ($this->filterStatus == 'koki') {
            $query->where('role', 'koki');
        } elseif ($this->filterStatus == 'kasir') {
            $query->where('role', 'kasir');
        }

        return $query;
    }

    #[On(['userUpdated', 'userAdded'])]
    public function render()
    {
        $users = $this->getUserQuery()->paginate(25)->withQueryString();

        return view('livewire.dashboard.users.index', [
            'users' => $users,
        ]);
    }
}
