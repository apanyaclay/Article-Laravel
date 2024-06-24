<?php

namespace App\Http\Controllers\Konfigurasi;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AksesUserController extends Controller
{
    public function index()
    {
        return view('aksesUser.index', [
            'title' => 'Akses User',
            'user' => User::all(),
        ]);
    }
    public function edit(string $id)
    {
        $user = User::find($id);
        $roleNames = $user->getRoleNames();
        $role = Role::whereIn('name', $roleNames)->get();
        $permission = Permission::all();
        $userPermission = DB::table('model_has_permissions')
            ->where('model_id', $user->id)
            ->pluck('model_has_permissions.permission_id', 'model_has_permissions.permission_id')
            ->all();
        $filteredPermissions = [];
        foreach ($permission as $item) {
            if (str_contains($item->name, 'view')) {
                $words = explode(' ', $item->name);
                if (isset($words[1])) {
                    $filteredPermissions[] = $words[1];
                }
            }
        }
        return view('aksesUser.create', [
            'title' => 'Add/Edit Permission',
            'user' => $user,
            'permission' => $permission,
            'filteredPermissions' => $filteredPermissions,
            'userPermission' => $userPermission,
        ]);
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'permission' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->syncPermissions($request->permission);
            DB::commit();
            return redirect()->back()->with('success', 'Akses User berhasil diupdate');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Akses User gagal diupdate');
        }
    }
}
