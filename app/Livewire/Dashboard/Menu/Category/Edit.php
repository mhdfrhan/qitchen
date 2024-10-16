<?php

namespace App\Livewire\Dashboard\Menu\Category;

use App\Models\MenuCategory;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Edit extends Component
{
    public $categoryId, $category = [], $name, $description;

    protected $rules = [
        'name' => 'required|max:255',
        'description' => 'required',
    ];

    public function mount($categoryId)
    {
        $this->categoryId = $categoryId;

        $category = MenuCategory::findOrFail($this->categoryId);
        if ($category) {
            $this->name = $category->name;
            $this->description = $category->description;
        }
    }

    public function update()
    {
        try {
            $this->validate();
        } catch (ValidationException $th) {
            $this->dispatch('notify', message: 'Opss something went wrong', type: 'error');
            $this->dispatch('close');
            return;
        }

        try {
            $category = MenuCategory::findOrFail($this->categoryId);
            $category->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            $this->dispatch('notify', message: 'Category successfully updated', type: 'success');
            $this->dispatch('categoryUpdated');
            $this->dispatch('close-modal', 'category-edit');
        } catch (\Throwable $th) {
            $this->dispatch('close');
            $this->dispatch('notify', message: 'Opss something went wrong ' . $th->getMessage(), type: 'error');
        }
    }


    public function render()
    {
        $this->category = MenuCategory::findOrFail($this->categoryId);
        return view('livewire.dashboard.menu.category.edit');
    }
}
