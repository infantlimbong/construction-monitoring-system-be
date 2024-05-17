<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau Password tidak ditemukan'],
            ]);
        }
    
        $user = Auth::user();
    
        // Check if user's id_role is not 1
        if ($user->id_role === 5) {
            throw ValidationException::withMessages([
                'email' => ['Email atau Password tidak ditemukan'],
            ]);
        }
    
        $token = $user->createToken('ApiToken')->plainTextToken;
    
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => 'Berhasil Login',
        ]);
    }

    public function guest_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau Password tidak ditemukan'],
            ]);
        }
    
        $user = Auth::user();
    
        // Check if user's id_role is not 1
        if ($user->id_role !== 5) {
            throw ValidationException::withMessages([
                'email' => ['Email atau Password tidak ditemukan'],
            ]);
        }
    
        $token = $user->createToken('ApiToken')->plainTextToken;
    
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => 'Berhasil Login',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Gagal Logout',
        ]);
    }
}
