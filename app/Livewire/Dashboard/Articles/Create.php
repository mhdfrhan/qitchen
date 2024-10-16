<?php

namespace App\Livewire\Dashboard\Articles;

use App\Models\Articles;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $image, $title, $slug, $value, $trixId;

    protected $rules = [
        'title' => 'required',
        'slug' => 'required',
        'image' => 'required|image|max:3048',
        'value' => 'required',
    ];

    protected $messages = [
        'required' => 'The :attribute field is required.',
        'image' => 'The :attribute must be an image.',
        'max' => 'The :attribute may not be greater than :max.',  
    ];

    public function updatedTitle()
    {
        $this->slug = $this->generateUniqueSlug(Str::slug($this->title));
    }

    private function generateUniqueSlug($slug)
    {
        $originalSlug = $slug;
        $count = 1;

        while (Articles::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        try {
            $this->validate();
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: 'Opss something went wrong ' . $th->getMessage(), type: 'error');
            return;
        }

        try {
            $imageName = Str::slug($this->title) . '.' . $this->image->getClientOriginalExtension();
            $imagePath = $this->image->storeAs('assets/img/articles/' . date('Y'), $imageName, 'public');

            $data = [
                'title' => $this->title,
                'slug' => $this->slug,
                'image' => $imagePath,
                'body' => $this->value,
                'is_published' => 1,
                'author' => Auth::user()->name
            ];

            Articles::create($data);

            return $this->redirect(route('dashboard.articles'), navigate: true);
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Opss something went wrong' . $e->getMessage(), type: 'error');
            return;
        }
    }

    public function draft()
    {
        try {
            $this->validate();
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: 'Opss something went wrong ' . $th->getMessage(), type: 'error');
            return;
        }

        try {
            $imageName = Str::slug($this->title) . '.' . $this->image->getClientOriginalExtension();
            $imagePath = $this->image->storeAs('assets/img/articles/' . date('Y'), $imageName, 'public');

            $data = [
                'title' => $this->title,
                'slug' => $this->slug,
                'image' => $imagePath,
                'body' => $this->value,
                'is_published' => 0,
                'author' => Auth::user()->name
            ];

            Articles::create($data);

            return $this->redirect(route('dashboard.articles'), navigate: true);
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Opss something went wrong' . $e->getMessage(), type: 'error');
            return;
        }
    }

    public function mount($value = '')
    {
        $this->value = $value;
        $this->trixId = 'trix-' . uniqid();
    }

    public function render()
    {
        return view('livewire.dashboard.articles.create');
    }
}
