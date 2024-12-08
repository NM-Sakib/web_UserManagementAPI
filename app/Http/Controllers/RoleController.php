<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index()
    {
        return response()->json(Role::with('permissions')->get());
    }

    public function store(Request $request)
    {
        if(!Gate::allows('delete users')) {
            abort(403);
        }
        // dd(1);

        $validated = $request->validate([
            'name' => 'required|string|unique:roles',
            'permissions' => 'array',
        ]);

    // dd($request->all());

        $role = Role::create(['name' => $validated['name']]);
        $role->permissions()->sync($request->input('permissions', []));

        return response()->json($role->load('permissions'), 201);
    }

    public function show($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        return response()->json($role);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'string|unique:roles,name,' . $id,
            'permissions' => 'array',
        ]);

        $role = Role::findOrFail($id);
        $role->update(['name' => $validated['name'] ?? $role->name]);
        $role->permissions()->sync($request->input('permissions', []));

        return response()->json($role->load('permissions'));
    }

    public function destroy($id)
    {
        Role::findOrFail($id)->delete();
        return response()->json(['message' => 'Role deleted successfully']);
    }
}
