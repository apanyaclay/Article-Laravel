<?php

namespace App\Http\Controllers\Konfigurasi;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Notifications\TelegramNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class MenuController extends Controller
{
    public function index()
    {
        return view('menu.index', [
            'title' => 'Menu',
            'menu' => Menu::all(),
        ]);
    }
    public function create()
    {
        return view('menu.create', [
            'title' => 'Add Menu',
            'permissions' => Permission::all(),
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required',
            'icon'          => 'required',
            'order_no'      => 'required|unique:menus,order_no',
            'route'         => 'required',
            'description'   => 'required',
            'is_active'     => 'required',
        ]);
        DB::beginTransaction();
        try {
            $menu = Menu::create($data);
            $menu->notify(new TelegramNotification());
            DB::commit();
            return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan');
        } catch (\Exception $th) {
            DB::rollBack();
            Log::error('error:', [$th->getMessage()]);
            return redirect()->route('menu.create')->with('error', 'Menu gagal ditambahkan');
        }
    }
    public function edit($id)
    {
        return view('menu.edit', [
            'title' => 'Edit Menu',
            'menu' => Menu::findOrFail($id),
            'permissions' => Permission::all(),
        ]);
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name'          => 'required',
            'icon'          => 'required',
            'order_no'      => 'required|unique:menus,order_no,'.$id,
            'route'         => 'required',
            'description'   => 'required',
            'is_active'     => 'required',
        ]);
        DB::beginTransaction();
        try {
            Menu::where('id', $id)->update($data);
            DB::commit();
            return redirect()->route('menu.index')->with('success', 'Menu berhasil diedit');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('menu.create')->with('error', 'Menu gagal diedit');
        }
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Menu::destroy($id);
            DB::commit();
            return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus');
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->route('menu.index')->with('error', 'Menu gagal dihapus');
        }
    }
}
