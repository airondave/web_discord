<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminManagementController extends Controller
{
    // Show create admin form
    public function create()
    {
        return view('admin.admins.create');
    }

    // Store new admin
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:admins',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Admin::create([
            'username' => $request->username,
            'name' => $request->name,
            'password' => $request->password, // Will be hashed by model
            'is_active' => true,
        ]);

        return redirect()->route('admin.manage-admins')->with('success', 'Admin user created successfully!');
    }

    // Show manage admins page
    public function index()
    {
        $admins = Admin::orderBy('created_at', 'desc')->get();
        return view('admin.admins.index', compact('admins'));
    }

    // Toggle admin status
    public function toggleStatus(Admin $admin)
    {
        // Prevent self-deactivation
        if ($admin->id === auth()->guard('admin')->id()) {
            return redirect()->route('admin.manage-admins')->with('error', 'You cannot deactivate your own account.');
        }

        $admin->update(['is_active' => !$admin->is_active]);
        $status = $admin->is_active ? 'activated' : 'deactivated';
        
        return redirect()->route('admin.manage-admins')->with('success', "Admin {$status} successfully!");
    }

    // Delete admin
    public function destroy(Admin $admin)
    {
        // Prevent self-deletion
        if ($admin->id === auth()->guard('admin')->id()) {
            return redirect()->route('admin.manage-admins')->with('error', 'You cannot delete your own account.');
        }

        $admin->delete();
        return redirect()->route('admin.manage-admins')->with('success', 'Admin deleted successfully!');
    }
}
