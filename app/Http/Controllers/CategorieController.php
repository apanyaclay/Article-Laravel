<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategorieController extends Controller
{
    public function index()
    {
        return view('category.index', [
            'title' => 'Category',
            'categories' => Categorie::all()
        ]);
    }
    public function create()
    {
        return view('category.create', [
            'title' => 'Add Category',
            'categories' => Categorie::all(),
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required',
            'slug'          => 'required|unique:categories,slug',
            'description'   => 'nullable',
            'parent_id'     => 'nullable',
        ]);
        DB::beginTransaction();
        try {
            Categorie::create($data);
            DB::commit();
            return redirect()->route('category.index')->with('success', 'Category update successfully');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update category');
        }
    }
    public function edit($id)
    {
        return view('category.edit', [
            'title' => 'Edit Category',
            'categorie' => Categorie::find($id),
            'categories' => Categorie::all(),
        ]);
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name'          => 'required',
            'slug'          => 'required|unique:categories,slug,'.$id,
            'description'   => 'nullable',
            'parent_id'     => 'nullable',
        ]);
        DB::beginTransaction();
        try {
            $categorie = Categorie::find($id);
            $categorie->update($data);
            DB::commit();
            return redirect()->route('category.index')->with('success', 'Category update successfully');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update category');
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Categorie::destroy($id);
            DB::commit();
            return redirect()->route('category.index')->with('success', 'Category deleted successfully');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('category.index')->with('error', 'Failed to delete category');
        }
    }
}
