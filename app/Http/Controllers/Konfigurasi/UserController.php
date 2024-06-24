<?php

namespace App\Http\Controllers\Konfigurasi;

use App\Events\MyEvent;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index', [
            'title' => 'Users',
            'user' => User::all(),
        ]);
    }
    public function create()
    {
        $role = Role::pluck('name','name')->all();
        return view('user.create', [
            'title' => 'Add User',
            'role' => $role,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'roles' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->syncRoles($request->roles);
            event(new MyEvent($request->name));
            DB::commit();
            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back();
        }
    }
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $role = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('user.edit', [
            'title' => 'Edit User',
            'user' => $user,
            'role' => $role,
            'userRole' => $userRole,
        ]);
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable',
            'roles' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
            ];
            if (!empty($request->password)) {
                $data += [
                    'password' => $request->password,
                ];
            };
            $user = User::findOrFail($id);
            $user->update($data);
            $user->syncRoles($request->roles);
            event(new MyEvent($request->name));
            DB::commit();
            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back();
        }
    }
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $role = User::findOrFail($id);
            $role->delete();
            DB::commit();
            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back();
        }
    }
}
