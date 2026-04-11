<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('user', compact('users'));
    }

    public function create()
    {
        $role = Role::all();
        return view('user-create', compact('role'));
    }

    public function edit(User $user)
    {
        $role = Role::all();
        return view('user-edit', compact('user', 'role'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'role' => 'nullable|array|min:1',
            'role.*' => 'exists:roles,id'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->roles()->sync($request->role ?? []);

        return redirect()->route('user')->with('success', 'Data berhasil disimpan');
    }

    public function update(User $user, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'password_confirmation' => 'nullable|min:6',
            'role' => 'nullable|array|min:1',
            'role.*' => 'exists:roles,id'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }


        $user->save();
        $user->roles()->sync($request->role ?? []);

        return redirect()
            ->route('user')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()
            ->route('user')
            ->with('success', 'Data berhasil dihapus');
    }
}
