<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        return response()->json(Permission::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:permissions',
        ]);

        $permission = Permission::create(['name' => $validated['name']]);

        return response()->json($permission, 201);
    }

    public function show($id)
    {
        $permission = Permission::findOrFail($id);

        return response()->json($permission);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'string|unique:permissions,name,' . $id,
        ]);

        $permission = Permission::findOrFail($id);
        $permission->update(['name' => $validated['name'] ?? $permission->name]);

        return response()->json($permission);
    }

    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();

        return response()->json(['message' => 'Permission deleted successfully']);
    }
}
