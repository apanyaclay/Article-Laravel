<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index()
    {
        return view('', [
            'title' => 'Articles'
        ]);
    }
    public function create()
    {
        return view('', [
            'title' => 'Add Articles'
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);
        DB::beginTransaction();
        try {
            Article::create($data);
            DB::commit();
            return redirect()->route('article.index')->with('success', 'Article update successfully');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('article.index')->with('error', 'Failed to update article');
        }
    }
    public function show($id)
    {
        return view('', [
            'title' => 'Detail Articles'
        ]);
    }
    public function edit($id)
    {
        return view('', [
            'title' => 'Edit Articles'
        ]);
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $article = Article::find($id);
            $article->update($data);
            DB::commit();
            return redirect()->route('article.index')->with('success', 'Article update successfully');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('article.index')->with('error', 'Failed to update article');
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Article::destroy($id);
            DB::commit();
            return redirect()->route('article.index')->with('success', 'Article deleted successfully');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('article.index')->with('error', 'Failed to delete article');
        }
    }
}
