<?php

namespace App\Http\Controllers;

use App\Models\LapKondisiJalan;
use App\Models\LapKondisiJembatan;
use App\Models\Desa;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index_jalan()
    {
        $lap_kondisi_jalans = LapKondisiJalan::select('nama_ruas_jalan', 'tahun_pembangunan', 'progress', 'keseluruhan_kondisi')->get();
        return response()->json(['message' => 'Berhasil menampilakan data jalan', 'data' => $lap_kondisi_jalans], 200);
    }

    public function index_jembatan()
    {
        $lap_kondisi_jembatans = LapKondisiJembatan::select('nama_ruas_jembatan', 'tahun_pembangunan', 'progress', 'keseluruhan_kondisi')->get();
        return response()->json(['message' => 'Berhasil menampilakan data jembatan', 'data' => $lap_kondisi_jembatans], 200);
    }

    public function index_desa()
    {
        $desas = Desa::all();
        return response()->json(['message' => 'Berhasil menampilakan data desa', 'data' => $desas], 200);
    }
}
