<?php

namespace App\Livewire\Home\Articles;

use App\Models\Articles;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function render()
    {
        $articles = Articles::latest()->paginate(10)->withQueryString()->onEachSide(1);
        return view('livewire.home.articles.index', [
            'articles' => $articles
        ]);
    }
}
