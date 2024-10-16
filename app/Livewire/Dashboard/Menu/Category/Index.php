<?php

namespace App\Livewire\Dashboard\Menu\Category;

use App\Models\MenuCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $selectedEditCategoryId = null;
    public $selectedDeleteId = null;
    public $selectedMenuDelete = [];

    #[On(['categoryCreated', 'categoryUpdated'])]
    public function render()
    {
        $categories = MenuCategory::latest()->get();
        return view('livewire.dashboard.menu.category.index', [
            'categories' => $categories
        ]);
    }

    public function selectEditCategory($id)
    {
        try {
            $decrypt = decrypt($id);
        } catch (\Throwable $th) {
            return redirect(route('dashboard'));
        }

        $category = MenuCategory::findOrFail($decrypt);

        if ($category) {
            $this->selectedEditCategoryId = $category->id;
        } else {
            return $this->dispatch('notify', message: "Category not found", type: 'error');
        }

        $this->dispatch('open-modal', 'category-edit');
    }

    public function selectDeleteCategory($id)
    {
        try {
            $decrypt = decrypt($id);
        } catch (\Throwable $th) {
            return redirect(route('dashboard'));
        }

        $this->selectedDeleteId = $decrypt;
        $this->selectedMenuDelete = MenuCategory::findOrFail($decrypt);

        $this->dispatch('open-modal', 'category-delete');
    }

    public function deleteCategory()
    {
        if ($this->selectedDeleteId) {
            $category = MenuCategory::findOrFail($this->selectedDeleteId);

            foreach ($category->menus as $menu) {
                if ($menu->image) {
                    Storage::disk('public')->delete($menu->image);
                }
                $menu->delete();
            }

            $category->delete();

            $this->dispatch('notify', message: "Category and its menus deleted successfully", type: 'success');
            $this->selectedDeleteId = null;
            $this->selectedMenuDelete = [];
        } else {
            $this->dispatch('notify', message: "Failed to delete category", type: 'error');
        }
    }
}
