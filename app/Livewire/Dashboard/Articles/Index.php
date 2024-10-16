<?php

namespace App\Livewire\Dashboard\Articles;

use App\Models\Articles;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $selectedDeleteSlug = null;

    #[Url(as: 'title')]
    public $search = '';

    public function updatedSeatch() {
        $this->selectedDeleteSlug = null;
    }

    public function render()
    {
        $articles = Articles::where('title', 'like', '%' . $this->search . '%')->latest()->paginate(15)->withQueryString()->onEachSide(1);
        return view('livewire.dashboard.articles.index', [
            'articles' => $articles
        ]);
    }

    public function setDelete($slug)
    {
        $this->selectedDeleteSlug = $slug;
        $this->dispatch('open-modal', 'delete-article');
    }

    public function deleteArticle()
    {
        $article = Articles::where('slug', $this->selectedDeleteSlug)->first();
        if (!$article) {
            $this->dispatch('notify', message: 'Article not found', type: 'error');
            return;
        }

        try {
            $article->image ? Storage::disk('public')->delete($article->image) : '';
            $article->delete();

            $this->dispatch('notify', message: 'Article deleted', type: 'success');

            $this->dispatch('close-modal', 'delete-article');
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: 'Opss something went wrong', type: 'error');
            return;
        }

    }

    public function setPublish($id)
    {
        $article = Articles::where('id', $id)->first();

        if (!$article) {
            $this->dispatch('notify', message: 'Article not found', type: 'error');
            return;
        }

        if ($article->is_published == 1) {
            $article->update([
                'is_published' => 0
            ]);

            $this->dispatch('notify', message: 'Article unpublished', type: 'success');
        } else {
            $article->update([
                'is_published' => 1
            ]);

            $this->dispatch('notify', message: 'Article published', type: 'success');
        }
    }
}
