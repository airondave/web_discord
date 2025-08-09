<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    // Display roles list
    public function index()
    {
        $roles = Role::orderBy('created_at', 'desc')->get();
        return view('admin.roles.index', compact('roles'));
    }

    // Store new role
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'description' => 'nullable|string|max:500',
        ]);

        Role::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => true,
        ]);

        return redirect()->route('admin.roles')->with('success', 'Role created successfully!');
    }

    // Update role
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        $role->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.roles')->with('success', 'Role updated successfully!');
    }

    // Delete role
    public function destroy(Role $role)
    {
        // Check if role is being used
        if ($role->submissions()->count() > 0) {
            return redirect()->route('admin.roles')->with('error', 'Cannot delete role that is being used by submissions.');
        }

        $role->delete();
        return redirect()->route('admin.roles')->with('success', 'Role deleted successfully!');
    }

    // Toggle role status
    public function toggleStatus(Role $role)
    {
        $role->update(['is_active' => !$role->is_active]);
        $status = $role->is_active ? 'activated' : 'deactivated';
        
        return redirect()->route('admin.roles')->with('success', "Role {$status} successfully!");
    }
}
