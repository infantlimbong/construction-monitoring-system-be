<?php

namespace App\Http\Controllers;

use App\Models\SumberDana;
use Illuminate\Http\Request;

class SumberDanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sumber_danas = SumberDana::all();
        return response()->json(['message' => 'Berhasil menanpilakan data sumber dana', 'data' => $sumber_danas], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sumber_dana = SumberDana::create($request->all());
        return response()->json(['message' => 'Berhasil menambahkan sumber dana', 'data' => $sumber_dana], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SumberDana $sumber_dana)
    {
        return response()->json(['message' => 'Berhasil menampilkan data sumber dana', 'data' => $sumber_dana], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SumberDana $sumber_dana)
    {
        $sumber_dana->update($request->all());
        return response()->json(['message' => 'Berhasil mengubah data', 'data' => $sumber_dana], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SumberDana $sumber_dana)
    {
        $sumber_dana->delete();
        return response()->json(['message' => 'Berhasil menghapus data'], 200);
    }
}
