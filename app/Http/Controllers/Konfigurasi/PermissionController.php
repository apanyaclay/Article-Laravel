<?php

namespace App\Http\Controllers\Konfigurasi;

use App\Http\Controllers\Controller;
use App\Events\MyEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view('permission.index', [
            'title' => 'permission',
            'permission' => Permission::all(),
        ]);
    }
    public function create()
    {
        return view('permission.create', [
            'title' => 'Add permission',
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name'
        ]);
        DB::beginTransaction();
        try {
            Permission::create([
                'name' => $request->name,
            ]);
            event(new MyEvent($request->name));
            DB::commit();
            return redirect()->route('permission.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back();
        }
    }
    public function edit(string $id)
    {
        $permission = Permission::findById($id);
        return view('permission.edit', [
            'title' => 'Edit permission',
            'permission' => $permission,
        ]);
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,'.$id,
        ]);
        DB::beginTransaction();
        try {
            $permission = Permission::findById($id);
            $permission->update([
                'name' => $request->name,
            ]);
            event(new MyEvent($request->name));
            DB::commit();
            return redirect()->route('permission.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back();
        }
    }
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $permission = Permission::findById($id);
            $permission->delete();
            DB::commit();
            return redirect()->route('permission.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back();
        }
    }
}
