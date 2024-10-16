<?php

namespace App\Livewire\Dashboard\Menu;

use App\Models\Menu;
use App\Models\MenuCategory;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

use function PHPSTORM_META\type;

class Create extends Component
{
    use WithFileUploads;

    public $categories = [];
    public $image, $name, $description, $price, $category, $is_halal, $available;

    protected $rules = [
        'image' => 'required|image|max:3024',
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

    public function updatedPrice()
    {
       if ($this->price < 0) {
           $this->price = 0;
       }
    }

    public function store()
    {
        $this->validate();

        try {
            $imageName = Str::random(20) . '.' . $this->image->getClientOriginalExtension();
            $imagePath = $this->image->storeAs('assets/img/menu/', $imageName, 'public');

            Menu::create([
                'image' => $imagePath,
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'category_id' => $this->category,
                'is_halal' => $this->is_halal ?? 0,
                'available' => $this->available ?? 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->dispatch('notify', message: 'Menu successfully created', type: 'success');
            $this->dispatch('menu-created');
            $this->dispatch('close');
            $this->reset();
        } catch (\Throwable $th) {
            $this->dispatch('close');
            $this->dispatch('notify', message: 'Opss something went wrong', type: 'error');
        }
    }

    public function render()
    {
        $this->categories = MenuCategory::all();
        return view('livewire.dashboard.menu.create');
    }
}
