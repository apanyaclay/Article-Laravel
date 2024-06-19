<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
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
            Tag::create($data);
            DB::commit();
            return redirect()->route('tag.index')->with('success', 'Article update successfully');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('tag.index')->with('error', 'Failed to update article');
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
            $tag = Tag::find($id);
            $tag->update($data);
            DB::commit();
            return redirect()->route('tag.index')->with('success', 'Article update successfully');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('tag.index')->with('error', 'Failed to update article');
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Tag::destroy($id);
            DB::commit();
            return redirect()->route('tag.index')->with('success', 'Article deleted successfully');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('tag.index')->with('error', 'Failed to delete article');
        }
    }
}
