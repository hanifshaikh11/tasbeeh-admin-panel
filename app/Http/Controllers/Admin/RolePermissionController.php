<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function edit($id)
    {
        // $role = Role::findById($id);
        // $permissions = Permission::all();
        // return view(
        //     'admin.roles.edit',
        //     compact('role', 'permissions')
        // );

        $role = Role::findById($id);
        $permissions = Permission::all()->groupBy(function ($item) {
            return explode('.', $item->name)[0];
        });

        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('admin.roles.edit', compact(
            'role',
            'permissions',
            'rolePermissions'
        ));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findById($id);
        $role->syncPermissions(
            $request->permissions ?? []
        );
        return redirect()->route('roles.index')
            ->with('success', 'Permissions updated');
    }

    public function matrix()
    {
        $roles = Role::all();
        $permissions = Permission::all()->groupBy(function ($item) {
            return explode('.', $item->name)[0];
        });

        return view(
            'admin.roles.matrix',
            compact('roles', 'permissions')
        );
    }

    public function matrixUpdate(Request $request)
    {
        $roles = Role::all();
        foreach ($roles as $role) {
            $selected = $request->input('permissions.' . $role->id, []);
            $role->syncPermissions($selected);
        }
        return back()->with('success', 'Permissions updated successfully');
    }
}
