<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kabupatens = Kabupaten::all();
        return response()->json(['message' => 'Berhasil menanpilakan data Kabupaten', 'data' => $kabupatens], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kabupaten = Kabupaten::create($request->all());
        return response()->json(['message' => 'Berhasil menambahkan Kabupaten', 'data' => $kabupaten], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kabupaten $kabupaten)
    {
        return response()->json(['message' => 'Berhasil menampilkan data Kabupaten', 'data' => $kabupaten], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kabupaten $kabupaten)
    {
        $kabupaten->update($request->all());
        return response()->json(['message' => 'Berhasil mengubah data', 'data' => $kabupaten], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kabupaten $kabupaten)
    {
        $kabupaten->delete();
        return response()->json(['message' => 'Berhasil menghapus data'], 200);
    }
}
