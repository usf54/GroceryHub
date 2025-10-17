<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // Display all users
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Show the form to create a new user
    public function create()
    {
        return view('admin.users.create');
    }

    // Store a new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'role' => 'required|in:admin,client',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password); // Hash the password

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // Show the form to edit a user
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update a user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'role' => 'required|in:admin,client',
        ]);

        $data = $request->all();

        // Update password only if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // Delete a user
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}