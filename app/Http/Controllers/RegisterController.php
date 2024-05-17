<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function store(Request $request)
    {

        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            return response()->json(['message' => 'Email telah terdaftar'], 400);
        }

        $hashedPassword = Hash::make($request->password);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'id_role' => 5,
            'password' => $hashedPassword,
        ]);

        return response()->json(['message' => 'Berhasil menambahkan user', 'data' => $user], 201);
    }
}
