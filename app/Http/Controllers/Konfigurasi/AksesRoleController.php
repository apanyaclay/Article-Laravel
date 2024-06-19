<?php

namespace App\Http\Controllers\Konfigurasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AksesRoleController extends Controller
{
    public function index()
    {
        return view('aksesRole.index', [
            'title' => 'akses role',
            'aksesRole' => Role::all(),
            'permission' => Permission::all(),
        ]);
    }
    public function edit(string $id)
    {
        $role = Role::findById($id);
        $permission = Permission::all();
        $rolePermission = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
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
        return view('aksesRole.create', [
            'title' => 'Add/Edit Permission',
            'role' => $role,
            'permission' => $permission,
            'rolePermission' => $rolePermission,
            'filteredPermissions' => $filteredPermissions,
        ]);
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'permission' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $role = Role::findOrFail($id);
            $role->syncPermissions($request->permission);
            DB::commit();
            return redirect()->route('akses-role.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back();
        }
    }
}
