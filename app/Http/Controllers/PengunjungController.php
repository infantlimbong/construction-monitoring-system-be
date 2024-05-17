<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengunjungs = Pengunjung::all();
        return response()->json(['message' => 'Berhasil menampilakan data pengunjung', 'data' => $pengunjungs], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $hashedPassword = Hash::make($request->password);

        $pengunjung = Pengunjung::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $hashedPassword,
        ]);
        return response()->json(['message' => 'Berhasil menambahkan pengunjung', 'data' => $pengunjung], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengunjung $pengunjung)
    {
        return response()->json(['message' => 'Berhasil menampilkan data pengunjung', 'data' => $pengunjung], 200);
    }

    public function authenticatedPengunjung(Request $request)
    {
        $pengunjung = Auth::guard('pengunjungs')->user();
        return response()->json(['message' => 'Successfully retrieved authenticated pengunjung', 'data' => $pengunjung], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengunjung $pengunjung)
    {
        $pengunjung->update($request->all());
        return response()->json(['message' => 'Berhasil mengubah pengunjung', 'data' => $pengunjung], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengunjung $pengunjung)
    {
        $pengunjung->delete();
        return response()->json(['message' => 'Berhasil menghapus data'], 200);
    }
}
