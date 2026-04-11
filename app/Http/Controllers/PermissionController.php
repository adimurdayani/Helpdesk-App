<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $data = Permission::all();
        return view('permission', compact('data'));
    }

    public function create()
    {
        return view('permission-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:355'],
            'guard_name' => ['required', 'string', 'max:255']
        ]);

        Permission::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect()
            ->route('permission')
            ->with('success', 'Data berhasil disimpan');
    }

    public function edit(Permission $permission)
    {
        return view('permission-edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:355'],
            'guard_name' => ['required', 'string', 'max:255']
        ]);

        $permission->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect()
            ->route('permission')
            ->with('success', 'Data berhasil diubah');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()
            ->route('permission')
            ->with('success', 'Data berhasil dihapus');
    }
}
