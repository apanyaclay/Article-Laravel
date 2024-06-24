<?php

namespace App\Http\Controllers\Konfigurasi;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class SubMenuController extends Controller
{
    public function index()
    {
        return view('submenu.index', [
            'title' => 'Sub Menu',
            'submenu' => SubMenu::all(),
        ]);
    }
    public function create()
    {
        return view('submenu.create', [
            'title' => 'Add Sub Menu',
            'menu' => Menu::all(),
            'permissions' => Permission::all(),
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required',
            'menu_id'       => 'required',
            'order_no'      => [
                'required',
                Rule::unique('sub_menus')->where(function ($query) use ($request) {
                    return $query->where('menu_id', $request->menu_id);
                }),
            ],
            'route'         => 'required',
            'permission_id' => 'required',
            'description'   => 'required',
            'is_active'     => 'required',
        ]);
        DB::beginTransaction();
        try {
            SubMenu::create($data);
            DB::commit();
            return redirect()->route('submenu.index')->with('success', 'Sub Menu berhasil ditambahkan');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('submenu.create')->with('error', 'Sub Menu gagal ditambahkan');
        }
    }
    public function edit($id)
    {
        return view('submenu.edit', [
            'title' => 'Edit Sub Menu',
            'submenu' => SubMenu::findOrFail($id),
            'menu' => Menu::all(),
            'permissions' => Permission::all(),
        ]);
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name'          => 'required',
            'menu_id'       => 'required',
            'order_no'      => [
                'required',
                Rule::unique('sub_menus')->where(function ($query) use ($request) {
                    return $query->where('menu_id', $request->menu_id);
                })->ignore($id), // $id adalah ID dari item yang sedang diperbarui
            ],
            'route'         => 'required',
            'permission_id' => 'required',
            'description'   => 'required',
            'is_active'     => 'required',
        ]);
        DB::beginTransaction();
        try {
            SubMenu::where('id', $id)->update($data);
            DB::commit();
            return redirect()->route('submenu.index')->with('success', 'Sub Menu berhasil diedit');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('submenu.create')->with('error', 'Sub Menu gagal diedit');
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            SubMenu::destroy($id);
            DB::commit();
            return redirect()->route('submenu.index')->with('success', 'Sub Menu berhasil dihapus');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('submenu.index')->with('error', 'Sub Menu gagal dihapus');
        }
    }
}
