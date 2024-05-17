<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json(['message' => 'Berhasil menampilakan data user', 'data' => $users], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            return response()->json(['message' => 'Email telah terdaftar'], 400);
        }

        // $user = User::create($request->all());
        $hashedPassword = Hash::make($request->password);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'id_role' => $request->id_role,
            'password' => $hashedPassword,
        ]);

        return response()->json(['message' => 'Berhasil menambahkan user', 'data' => $user], 201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json(['message' => 'Berhasil menampilkan data user', 'data' => $user], 200);
    }

    public function authenticatedUser(Request $request)
    {
        return response()->json(['message' => 'Successfully retrieved authenticated user', 'data' => $request->user()], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->only('nama', 'email', 'id_role'));

        // Check if password is provided and update it
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return response()->json(['message' => 'Berhasil mengubah data', 'data' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'Berhasil menghapus data'], 200);
    }
}
