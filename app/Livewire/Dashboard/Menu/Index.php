<?php

namespace App\Livewire\Dashboard\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $menu = [];
    public $menuId;

    #[On(['menu-created', 'menu-updated', 'menu-deleted'])]
    public function mount()
    {
        $this->menu = Menu::orderBy('available', 'asc')->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.dashboard.menu.index');
    }

    #[On('set-menu-delete')]
    public function setMenuDelete($id)
    {
        $this->menuId = $id;
    }

    public function deleteMenu()
    {
        try {
            $menu = Menu::findOrFail($this->menuId);
            if (!$menu) {
                return redirect(route('dashboard'));
            }

            Storage::disk('public')->delete($menu->image);
            $menu->delete();

            $this->dispatch('menu-deleted');
            $this->dispatch('notify', message: 'Berhasil menghapus menu', type: 'success');
        } catch (\Throwable $th) {
            return redirect(route('dashboard'));
        }
    }
}
