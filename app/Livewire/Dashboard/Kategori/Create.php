<?php

namespace App\Livewire\Dashboard\Kategori;

use App\Models\MenuCategory;
use Livewire\Component;

class Create extends Component
{
    public $name, $description;

    protected $rules = [
        'name' => 'required|max:255',
        'description' => 'required',
    ];

    public function store()
    {
        $this->validate();

        try {
            MenuCategory::create([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            $this->dispatch('notify', message: 'Category successfully created', type: 'success');
            $this->dispatch('close');
            $this->reset();
            $this->dispatch('categoryCreated');
        } catch (\Throwable $th) {
            $this->dispatch('close');
            $this->dispatch('alert', ['message' => 'Opss something went wrong', 'type' => 'error']);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.kategori.create');
    }
}
