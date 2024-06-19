<?php

namespace App\Http\Controllers\Konfigurasi;

use App\Http\Controllers\Controller;
use App\Events\MyEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('role.index', [
            'title' => 'Role',
            'role' => Role::all(),
        ]);
    }
    public function create()
    {
        return view('role.create', [
            'title' => 'Add Role',
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);
        DB::beginTransaction();
        try {
            Role::create([
                'name' => $request->name,
            ]);
            event(new MyEvent($request->name));
            DB::commit();
            return redirect()->route('role.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back();
        }
    }
    public function edit(string $id)
    {
        $role = Role::findById($id);
        return view('role.edit', [
            'title' => 'Edit Role',
            'role' => $role,
        ]);
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $role = Role::findById($id);
            $role->update([
                'name' => $request->name,
            ]);
            event(new MyEvent($request->name));
            DB::commit();
            return redirect()->route('role.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back();
        }
    }
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $role = Role::findById($id);
            $role->delete();
            DB::commit();
            return redirect()->route('role.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back();
        }
    }
}
