<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Articles;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        return view('dashboard.articles.index', [
            'title' => 'Articles'
        ]);
    }

    public function create()
    {
        return view('dashboard.articles.create', [
            'title' => 'Create Article'
        ]);
    }

    public function edit($slug)
    {
        $article = Articles::where('slug', $slug)->first();
        if (!$article) {
            abort(404);
        }

        return view('dashboard.articles.edit', [
            'title' => 'Edit Article',
            'article' => $article
        ]);
    }
}
