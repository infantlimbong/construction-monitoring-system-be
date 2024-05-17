<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kecamatans = Kecamatan::all();
        return response()->json(['message' => 'Berhasil menanpilakan data Kecamatan', 'data' => $kecamatans], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kecamatan = Kecamatan::create($request->all());
        return response()->json(['message' => 'Berhasil menambahkan Kecamatan', 'data' => $kecamatan], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kecamatan $kecamatan)
    {
        return response()->json(['message' => 'Berhasil menampilkan data Kecamatan', 'data' => $kecamatan], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $kecamatan->update($request->all());
        return response()->json(['message' => 'Berhasil mengubah data', 'data' => $kecamatan], 200);
    }

    public function getByKabupaten($kabupatenId)
    {
        $kecamatans = Kecamatan::where('id_kabupaten', $kabupatenId)->get();
        return response()->json(['data' => $kecamatans]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kecamatan $kecamatan)
    {
        $kecamatan->delete();
        return response()->json(['message' => 'Berhasil menghapus data'], 200);
    }
}
