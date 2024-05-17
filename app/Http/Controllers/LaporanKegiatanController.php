<?php

namespace App\Http\Controllers;

use App\Models\LaporanKegiatan;
use Illuminate\Http\Request;

class LaporanKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporan_kegiatans = LaporanKegiatan::all();
        return response()->json(['message' => 'Berhasil menanpilakan data laporan', 'data' => $laporan_kegiatans], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $laporan_kegiatan = LaporanKegiatan::create($request->all());
        return response()->json(['message' => 'Berhasil menambahkan laporan', 'data' => $laporan_kegiatan], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanKegiatan $laporan_kegiatan)
    {
        return response()->json(['message' => 'Berhasil menampilkan data laporan', 'data' => $laporan_kegiatan], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanKegiatan $laporan_kegiatan)
    {
        $laporan_kegiatan->update($request->all());
        return response()->json(['message' => 'Berhasil mengubah laporan', 'data' => $laporan_kegiatan], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanKegiatan $laporan_kegiatan)
    {
        $laporan_kegiatan->delete();
        return response()->json(['message' => 'Berhasil menghapus data'], 200);
    }
}
