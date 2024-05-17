<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return response()->json(['message' => 'Berhasil menanpilakan data role', 'data' => $roles], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = Role::create($request->all());
        return response()->json(['message' => 'Berhasil menambahkan role', 'data' => $role], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return response()->json(['message' => 'Berhasil menampilkan data role', 'data' => $role], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role->update($request->all());
        return response()->json(['message' => 'Berhasil mengubah data', 'data' => $role], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['message' => 'Berhasil menghapus data'], 200);
    }
}
