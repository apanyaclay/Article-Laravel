<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Categorie;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('blog', [
            'title' => 'Blog',
            'articles' => Article::whereStatus('published')->latest()->paginate(9),
            'featured' => Article::whereStatus('published')->latest()->firstOrFail(),
        ]);
    }
    public function show(string $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $article->increment('views');
        $tag = ArticleTag::where('article_id', $article->id)->get();
        return view('blog-detail', [
            'title' => 'Blog Detail',
            'article' => $article,
            'tag' => $tag,
        ]);
    }

    public function tag($id)
    {
        $tag = Tag::find($id);
        $articles = ArticleTag::where('tag_id', $id)->latest()->paginate(9);
        return view('tag', [
            'title' => 'Tag',
            'articles' => $articles,
            'tag' => $tag,
        ]);
    }
    public function category($id)
    {
        $category = Categorie::find($id);
        $articles = Article::where('category_id', $id)->latest()->paginate(9);
        return view('category', [
            'title' => 'Category',
            'articles' => $articles,
            'category' => $category,
        ]);
    }
    public function article()
    {
        $articles = Article::whereStatus('published')->latest();
        $q = request()->get('q');
        if (request()->has('q')) {
            $articles = Article::where('title', 'like', '%' . $q . '%')->whereStatus('published')->latest();
        }
        return view('articles', [
            'title' => 'Blog',
            'articles' => $articles->paginate(9),
            'q' => $q
        ]);
    }
}
