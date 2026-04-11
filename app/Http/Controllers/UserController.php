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
        // ⬇️Menampilkan data role
        $role = Role::all();
        return view('user-create', compact('role'));
    }

    public function edit(User $user)
    {
        // ⬇️Menampilkan halaman edit dan mengirim data $user
        $role = Role::all();
        return view('user-edit', compact('user', 'role'));
    }

    public function store(Request $request)
    {
        // ⬇️Validasi data user
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'role' => 'nullable|array|min:1',
            'role.*' => 'exists:roles,id'
        ]);
        // ⬇️proses tambah data user dari request
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        // ⬇️Melakukan singkronisasi data role jika ada
        $user->roles()->sync($request->role ?? []);
        // ⬇️kembali ke halaman tabel user dan mengirimkan pesan "success"
        return redirect()
            ->route('user')
            ->with('success', 'Data berhasil disimpan');
    }

    public function update(User $user, Request $request)
    {
        // ⬇️Validasi user
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
        // ⬇️Update password jika password tidak kosong
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        // ⬇️Singkronisasi role jika role tidak kosong
        $user->roles()->sync($request->role ?? []);
        // ⬇️kembali ke halaman user dan mengirim pesan success.
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
