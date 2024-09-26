<?php

namespace App\Livewire\Dashboard\Menu;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class Edit extends Component
{
    use WithFileUploads;

    public $categories = [];
    public $menuId, $oldName, $oldImage, $image, $name, $description, $price, $category, $is_halal, $available;

    protected $rules = [
        'image' => 'nullable|image|max:3024',
        'name' => 'required|max:255',
        'description' => 'required',
        'price' => 'required|numeric',
        'category' => 'required|exists:menu_categories,id',
        'is_halal' => 'nullable',
        'available' => 'nullable',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    #[On('set-menu-id')]
    public function setMenuId($id)
    {
        $this->menuId = $id;
        $menu = Menu::findOrFail($this->menuId);
        if (!$menu) {
            return redirect(route('dashboard'));
        }
        $this->name = $menu->name;
        $this->oldName = $menu->name;
        $this->description = $menu->description;
        $this->price = $menu->price;
        $this->category = $menu->category_id;
        $this->is_halal = (bool)$menu->is_halal;
        $this->available = (bool)$menu->available;
        $this->oldImage = $menu->image;
    }

    public function update()
    {
        $this->validate();

        try {
            $menu = Menu::findOrFail($this->menuId);

            if (!$menu) {
                $this->dispatch('close');
                $this->dispatch('alert', ['message' => 'Opss terjadi kesalahan', 'type' => 'error']);
                return;
            }

            if ($this->image) {
                if ($menu->image && Storage::disk('public')->exists($menu->image)) {
                    Storage::disk('public')->delete($menu->image);
                }

                $imageName = Str::random(20) . '.' . $this->image->getClientOriginalExtension();
                $imagePath = $this->image->storeAs('assets/img/menu/', $imageName, 'public');
                $menu->image = $imagePath;
            }

            $menu->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'category_id' => $this->category,
                'is_halal' => $this->is_halal ?? 0,
                'available' => $this->available ?? 0,
                'updated_at' => now(),
            ]);

            $this->dispatch('notify', message: 'Menu berhasil diperbarui', type: 'success');
            $this->dispatch('menu-updated');
            $this->dispatch('close');
            $this->reset();
        } catch (\Throwable $th) {
            $this->dispatch('close');
            $this->dispatch('alert', ['message' => 'Opss terjadi kesalahan', 'type' => 'error']);
        }
    }


    public function render()
    {
        $this->categories = MenuCategory::all();
        return view('livewire.dashboard.menu.edit');
    }
}
