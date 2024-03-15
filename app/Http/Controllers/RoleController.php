<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(10);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permissions' => 'required'
        ],[
            'name.required' => 'Role name is required',
            'permissions.required' => 'Permission is required'
        ]);
        $role = Role::create(['name' => $request->name]);
        $permissions = [];
        foreach ($request->permissions as $permission) {
            $permissions[] = Permission::findById($permission);

        }
        $role->syncPermissions($permissions);
        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findById($id);
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required',
            'permissions' => 'required'
        ],[
            'name.required' => 'Role name is required',
            'permissions.required' => 'Permission is required'
        ]);
        $role = Role::findById($id);
        $role->name = $request->name;
        $role->save();
        $permissions = [];
        foreach ($request->permissions as $permission) {
            $permissions[] = Permission::findById($permission);
        }
        $role->syncPermissions($permissions);
        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the role by its id
        $role = Role::findById($id);

        // Revoke all permissions associated with this role
        foreach ($role->permissions as $permission) {
            $role->revokePermissionTo($permission);
        }

        // Delete the role
        $role->delete();

        // Redirect back to the roles index page with a success message
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }

}
