<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $desas = Desa::all();
        return response()->json(['message' => 'Berhasil menanpilakan data desa', 'data' => $desas], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $desa = Desa::create($request->all());
        return response()->json(['message' => 'Berhasil menambahkan desa', 'data' => $desa], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Desa $desa)
    {
        return response()->json(['message' => 'Berhasil menampilkan data desa', 'data' => $desa], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Desa $desa)
    {
        $desa->update($request->all());
        return response()->json(['message' => 'Berhasil mengubah data', 'data' => $desa], 200);
    }

    public function getByKecamatan($kecamatanId)
    {
        $desas = Desa::where('id_kecamatan', $kecamatanId)->get();
        return response()->json(['data' => $desas]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Desa $desa)
    {
        $desa->delete();
        return response()->json(['message' => 'Berhasil menghapus data'], 200);
    }
}
