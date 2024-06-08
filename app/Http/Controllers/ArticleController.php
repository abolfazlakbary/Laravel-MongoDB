<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{

    public function index()
    {
        $articles = Article::all();
        return view('articles.index', compact('articles'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(StoreArticleRequest $request)
    {
        Article::create($request->all());
        
        return redirect()->route('articles.index')
            ->with('success', 'Article created successfully.');
    }

    public function show($id)
    {
        $article = Article::find($id);

        return view('articles.show', compact('article'));
    }

    public function edit($id)
    {
        $article = Article::find($id);
        
        return view('articles.edit', compact('article'));
    }

    public function update(UpdateArticleRequest $request, $id)
    {
        $article = Article::find($id);

        $article->update($request->all());

        return redirect()->route('article.index')
            ->with('success', 'Article updated successfully.');
    }

    public function destroy($id)
    {
        $article = Article::find($id);

        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Article deleted successfully.');
    }

}
