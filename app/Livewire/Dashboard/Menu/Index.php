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
    public $selectedEditMenuId = null;
    public $selectedDeleteId = null;
    public $selectedMenuDelete = [];

    
    #[On(['menu-created', 'menu-updated', 'menu-deleted'])]
    public function render()
    {
        $this->menu = Menu::orderBy('available', 'asc')->orderBy('category_id')->orderBy('created_at', 'desc')->get();
        return view('livewire.dashboard.menu.index');
    }

    public function selectEditMenu($id)
    {
        try {
            $decrypt = decrypt($id);
        } catch (\Throwable $th) {
            return redirect(route('dashboard'));
        }

        $menu = Menu::findOrFail($decrypt);
        if ($menu) {
            $this->selectedEditMenuId = $menu->id;
        } else {
            return $this->dispatch('notify', message: "Menu not found", type: 'error');
        }

        $this->dispatch('open-modal', 'menu-edit');
    }

    public function selectDeleteMenu($id)
    {
        try {
            $decrypt = decrypt($id);
        } catch (\Throwable $th) {
            return redirect(route('dashboard'));
        }

        $menu = Menu::findOrFail($decrypt);
        if ($menu) {
            $this->selectedDeleteId = $menu->id;
            $this->selectedMenuDelete = $menu;
        } else {
            return $this->dispatch('notify', message: "Menu not found", type: 'error');
        }

        $this->dispatch('open-modal', 'menu-delete');
    }

    public function deleteMenu()
    {
        try {
            $menu = Menu::findOrFail($this->selectedDeleteId);
            if (!$menu) {
                return redirect(route('dashboard'));
            }

            Storage::disk('public')->delete($menu->image);
            $menu->delete();

            $this->dispatch('notify', message: 'Menu successfully deleted', type: 'success');

            $this->dispatch('close-modal', 'menu-delete');
            $this->selectedDeleteId = null;
            $this->selectedMenuDelete = [];
        } catch (\Throwable $th) {
            return redirect(route('dashboard'));
        }
    }
}
