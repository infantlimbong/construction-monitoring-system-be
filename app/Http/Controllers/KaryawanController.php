<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = Karyawan::all();
        return response()->json(['message' => 'Berhasil menampilakan data karyawan', 'data' => $karyawans], 200);
    }

        /**
         * Store a newly created resource in storage.
         */
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'nip' => 'required',
            'no_telepon' => 'required',
            'jenis_kelamin' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10480',
        ]);

        // Store the image file
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('public/gambar_jalan');
            $url = Storage::url($fotoPath);
            $fotoPath = Str::after($url, 'public/');
        } else {
            $fotoPath = null;
        }

        // Create the karyawan with the uploaded foto path
        $karyawan = Karyawan::create([
            'id_user' => $request->id_user,
            'nip' => $request->nip,
            'no_telepon' => $request->no_telepon,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto' => $fotoPath,
        ]);

        return response()->json(['message' => 'Berhasil menambahkan karyawan', 'data' => $karyawan], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        return response()->json(['message' => 'Berhasil menampilkan data karyawan', 'data' => $karyawan], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $karyawan->update($request->all());
        return response()->json(['message' => 'Berhasil mengubah data', 'data' => $karyawan], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();
        return response()->json(['message' => 'Berhasil menghapus data'], 200);
    }
}
