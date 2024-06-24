<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Categorie;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\TelegramArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        return view('article.index', [
            'title' => 'Articles',
            'articles' => Article::latest()->get(),
        ]);
    }
    public function create()
    {
        return view('article.create', [
            'title' => 'Add Articles',
            'category' => Categorie::all(),
            'tag' => Tag::all(),
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
            'excerpt' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'category_id' => 'required',
            'tag_id' => 'required|array',
            'tag_id.*' => 'exists:tags,id',
        ]);
        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $timestamp = now()->timestamp;
                $newFileName = Str::slug($originalName) . '_' . $timestamp . '.' . $extension;
                $filePath = $file->storeAs('article', $newFileName, 'public'); // Simpan di storage/app/public/article
            } else {
                $filePath = null;
            }
            $article = Article::create([
                'title' => $data['title'],
                'slug' => $data['slug'],
                'content' => $data['content'],
                'excerpt' => $data['excerpt'],
                'status' => $data['status'],
                'image' => $filePath,
                'category_id' => $data['category_id'],
                'author' => auth()->user()->id,
            ]);
            foreach ($data['tag_id'] as $tagId) {
                ArticleTag::create([
                    'article_id' => $article->id,
                    'tag_id' => $tagId,
                ]);
            }
            if ($data['status'] == 'published') {
                $telegram = [
                    'title' => $request->title,
                    'slug' => $request->slug,
                    'excerpt' => $request->excerpt,
                    'image' => $filePath,
                ];
                // $article->notify(new TelegramArticle($telegram));
            }

            DB::commit();
            return redirect()->route('article.index')->with('success', 'Article update successfully');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update article');
        }
    }
    public function show($id)
    {
        return view('article.show', [
            'title' => 'Detail Articles',
            'article' => Article::with('category')->find($id),
        ]);
    }
    public function edit($id)
    {
        return view('article.edit', [
            'title' => 'Edit Articles',
            'article' => Article::find($id),
            'category' => Categorie::all(),
            'tag' => Tag::all(),
        ]);
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
            'excerpt' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
            'category_id' => 'required',
            'tag_id' => 'required|array',
            'tag_id.*' => 'exists:tags,id',
        ]);
        DB::beginTransaction();
        try {
            $article = Article::find($id);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $timestamp = now()->timestamp;
                $newFileName = Str::slug($originalName) . '_' . $timestamp . '.' . $extension;
                $filePath = $file->storeAs('article', $newFileName, 'public'); // Simpan di storage/app/public/article
                // Hapus gambar lama jika ada
                if ($article->image && Storage::disk('public')->exists($article->image)) {
                    Storage::disk('public')->delete($article->image);
                }
            } else {
                $filePath = $article->image;
            }

            $article->update([
                'title' => $data['title'],
                'slug' => $data['slug'],
                'content' => $data['content'],
                'excerpt' => $data['excerpt'],
                'status' => $data['status'],
                'image' => $filePath,
                'category_id' => $data['category_id'],
                'author' => auth()->user()->id,
            ]);
            // Hapus tag lama
            ArticleTag::where('article_id', $article->id)->delete();

            // Tambahkan tag baru
            foreach ($data['tag_id'] as $tagId) {
                ArticleTag::create([
                    'article_id' => $article->id,
                    'tag_id' => $tagId,
                ]);
            }
            if ($request->status == 'published') {
                $telegram = [
                    'title' => $request->title,
                    'slug' => $request->slug,
                    'excerpt' => $request->excerpt,
                    'image' => $filePath,
                    // 'image' => asset('storage/' . $filePath),
                ];
                // $article->notify(new TelegramArticle($telegram));
            }
            DB::commit();
            return redirect()->route('article.index')->with('success', 'Article update successfully');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
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
