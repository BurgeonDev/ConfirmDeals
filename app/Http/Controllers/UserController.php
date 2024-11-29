<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        $users = User::all();
        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));
    }
    // Assign role to a user
    public function assignRole(Request $request, $userId)
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        $user = User::find($userId);
        $user->syncRoles($request->role);

        return redirect()->back()->with('success', 'Role assigned successfully');
    }

    public function createRole()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    // Store a new role
    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array',
        ]);

        $role = Role::create(['name' => $request->name]);

        // Validate each permission ID exists
        if ($request->permissions) {
            $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            $role->givePermissionTo($permissionNames);
        }

        return redirect()->route('admin.userManagement')->with('success', 'Role created successfully!');
    }

    // Show all roles
    public function listRoles()
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    // Show the role editing form
    public function editRole($id)
    {
        if (!auth()->user()->can('Manage Admin Dashbaord')) {
            abort(403, 'Unauthorized action.');
        }
        $role = Role::findOrFail($id);
        $permissions = Permission::all(); // Load all permissions
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    // Update the role
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'permissions' => 'array',
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();

        // Validate and sync permissions
        if ($request->permissions) {
            $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            $role->syncPermissions($permissionNames);
        }

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }

    // Delete the role
    public function destroyRole($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }
    public function toggleUserStatus($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();
        return back()->with('success', 'User status updated successfully.');
    }
}
