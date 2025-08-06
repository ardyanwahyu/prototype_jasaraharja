<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
     public function index()
        {
            $users = User::latest()->get();
            return view('admin.users.index', compact('users'));
        }

    public function show($id)
        {
            $user = User::findOrFail($id);
            return view('admin.users.show', compact('user'));
        }

    public function edit($id)
        {
            $user = User::findOrFail($id);
            return view('admin.users.edit', compact('user'));
        }

    public function update(Request $request, $id)
        {
            $user = User::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'nullable|string|max:20',
                'role' => 'required|in:admin,tamu',
            ]);

            $user->update($validated);

            return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate.');
        }

    public function destroy($id)
        {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
        }
}
