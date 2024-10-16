<?php

namespace App\Livewire\Dashboard\Articles;

use App\Models\Articles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Edit extends Component
{
    use WithFileUploads;

    public $artikel, $image, $existingImage, $title, $slug, $value, $trixId;

    public function rules()
    {
        return $rules = [
            'title' => 'required',
            'slug' => 'required|unique:articles,slug,' . $this->artikel->id,
            'image' => 'nullable|image|max:3048',
            'value' => 'required',
        ];
    }

    public function mount()
    {
        $artikel = $this->artikel;
        $this->title = $artikel->title;
        $this->slug = $artikel->slug;
        $this->value = $artikel->body;
        $this->existingImage = $artikel->image;
        $this->trixId = 'trix-' . uniqid();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedTitle()
    {
        $this->slug = $this->generateUniqueSlug(Str::slug($this->title));
    }

    private function generateUniqueSlug($slug)
    {
        $originalSlug = $slug;
        $count = 1;

        while (Articles::where('slug', $slug)->where('id', '!=', $this->artikel->id)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function update()
    {
        $this->validate();

        try {
            if ($this->image) {
                $oldImagePath = $this->existingImage;
                Storage::disk('public')->delete($oldImagePath);

                $imageName = Str::slug($this->title) . '.' . $this->image->getClientOriginalExtension();
                $imagePath = $this->image->storeAs('assets/img/articles/' . date('Y'), $imageName, 'public');
            } else {
                $imagePath = $this->existingImage;
            }

            $data = [
                'title' => $this->title,
                'slug' => $this->slug,
                'image' => $imagePath,
                'body' => $this->value,
                'author' => Auth::user()->name,
                'is_published' => 1
            ];

            $this->artikel->update($data);

            return $this->redirect(route('dashboard.articles'), navigate: true);
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Opss something went wrong' . $e->getMessage(), type: 'error');
            return;
        }
    }

    public function draft()
    {
        $this->validate();

        try {
            if ($this->image) {
                $imageName = Str::slug($this->title) . '.' . $this->image->getClientOriginalExtension();
                $imagePath = $this->image->storeAs('assets/img/articles/' . date('Y'), $imageName, 'public');
            } else {
                $imagePath = $this->existingImage;
            }

            $data = [
                'title' => $this->title,
                'slug' => $this->slug,
                'image' => $imagePath,
                'body' => $this->value,
                'is_published' => 0,
                'author' => Auth::user()->name
            ];

            $this->artikel->update($data);

            return $this->redirect(route('dashboard.articles'), navigate: true);
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Opss something went wrong' . $e->getMessage(), type: 'error');
            return;
        }
    }

    public function render()
    {
        return view('livewire.dashboard.articles.edit');
    }
}
