<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function store(Request $request)
    {
        $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'guard_name' => ['required', 'string', 'max:255'],
        ]);

        Role::create([
            'name'       => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect()
            ->route('role')
            ->with('success', 'Data berhasil disimpan');
    }

    public function edit(Role $role)
    {
        return view('role-edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'       => ['required', 'string', 'max:255', 'unique:roles,name,' . $role->id],
            'guard_name' => ['required', 'string', 'max:255'],
        ]);

        $role->update([
            'name'       => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect()
            ->route('role')
            ->with('success', 'Data berhasil diupdate');
    }

   public function destroy(Role $role)
    {
        $role->delete();
        return redirect()
            ->route('role')
            ->with('success', 'Data berhasil dihapus');
    }
}
