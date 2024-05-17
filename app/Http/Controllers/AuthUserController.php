<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class AuthUserController extends Controller
{
    /**
     * Display the authenticated user's data.
     */
    public function show(Request $request)
    {
        // Retrieve the authenticated user's data from the request
        $user = $request->user();

        // Return the authenticated user's data as JSON response
        return response()->json(['message' => 'Berhasil menampilkan data user', 'data' => $user], 200);
    }
}
