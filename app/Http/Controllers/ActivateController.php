<?php

namespace App\Http\Controllers;

use App\Models\Activate;
use Illuminate\Http\Request;

class ActivateController extends Controller
{

    public function index()
    {
        $activate = Activate::first()->select('activate')->pluck('activate')->first();
        return response()->json(['message' => 'Berhasil menampilakan data activate', 'activate' => $activate], 200);
    }

    public function toggleActivation(Request $request)
    {
        // Fetch existing activation status from the database (assuming there's only one row)
        $activation = Activate::first();

        // Validate request
        $request->validate([
            'activate' => 'required|boolean',
        ]);

        // Update the activation status
        $activation->update([
            'activate' => $request->input('activate'),
        ]);

        return response()->json(['activate' => $activation->activate]);
    }
}
