<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('role', compact('roles'));
    }

    public function create()
    {
        return view('role-create');
    }

    public function store(request $request)
    {
        $request->validate([
            'name'=>['required', 'string', 'max:255'],
            'guard_name'=>['required', 'string', 'max:255'],
        ]);

        Role::create([
            'name' => $request->name,
            'guar_name' => $request->uard_name,
        ]);

        return redirect()
        ->route('role')
        ->with('succes', 'data berhasil di simpan');
    }

    public function edit(Role $role)
    {
        return view('role-edit',compact('$role'));
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()
           ->route('role')
           ->with('succes', 'data berhasil diapus');
    }
}
