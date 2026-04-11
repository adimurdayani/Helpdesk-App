<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permission = Permission::all();
        return view('permission', compact('permission'));
    }

    public function create()
    {
        return view('permission-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'guard_name' => ['required', 'string', 'max:255'],
        ]);

        Permission::create([
            'name'       => $request->name,
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
            'name'       => ['required', 'string', 'max:255'],
            'guard_name' => ['required', 'string', 'max:255'],
        ]);

        $permission->update([
            'name'       => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect()
            ->route('permission')
            ->with('success', 'Data Permission berhasil diperbarui.');
    }

    public function destroy(Permission $permission)
    {
        $id = $permission->id;

        DB::table('role_has_permissions')->where('permission_id', $id)->delete();
        DB::table('model_has_permissions')->where('permission_id', $id)->delete();
        DB::table('permissions')->where('id', $id)->delete();

        return redirect()
            ->route('permission')
            ->with('success', 'Data berhasil dihapus');
    }
}
