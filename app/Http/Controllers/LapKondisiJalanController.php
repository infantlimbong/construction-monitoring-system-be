<?php

namespace App\Http\Controllers;

use App\Models\LapKondisiJalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LapKondisiJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lap_kondisi_jalans = LapKondisiJalan::all();
        return response()->json(['message' => 'Berhasil menanpilakan data jalan', 'data' => $lap_kondisi_jalans], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'no_ruas_jalan' => 'required',
                'nama_ruas_jalan' => 'required',
                'panjang_ruas_jalan' => 'nullable',
                'status_jalan' => 'nullable',
                'kondisi_baik' => 'nullable',
                'kondisi_cukup_baik' => 'nullable',
                'kondisi_rusak_ringan' => 'nullable',
                'kondisi_rusak_berat' => 'nullable',
                'keseluruhan_kondisi' => 'nullable',
                'tahun_pembangunan' => 'nullable',
                'koordinat_jalan' => 'nullable',
                'progress' => 'nullable',
                // Adjust file types and size limit as needed
                'gambar_jalan.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            ]);

            // Create LapKondisiJalan instance with validated data
            $data = $request->except('gambar_jalan');

            // Handle file uploads and populate gambar_jalan_paths
            $gambar_jalan_paths = [];
            if ($request->hasFile('gambar_jalan')) {
                foreach ($request->file('gambar_jalan') as $file) {
                    // Store the image and get its path
                    $path = $file->store('public/gambar_jalan');
                    // Get the public URL for the stored file
                    $url = Storage::url($path);
                    $gambar_jalan_paths[] = $url;
                }
            }

            // Convert array of paths to string
            $gambar_jalan_paths_string = implode(',', $gambar_jalan_paths);

            // Set the gambar_jalan_paths field in the $data array
            $data['gambar_jalan'] = $gambar_jalan_paths_string;

            // Automatically set the id_user field based on authenticated user
            $data['id_user'] = auth()->id();

            // Create LapKondisiJalan instance with validated data including gambar_jalan_paths
            $lap_kondisi_jalan = LapKondisiJalan::create($data);

            return response()->json(['message' => 'Berhasil menambahkan jalan', 'data' => $lap_kondisi_jalan], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while storing the data.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LapKondisiJalan $lap_kondisi_jalan)
    {
        return response()->json(['message' => 'Berhasil menampilkan data jalan', 'data' => $lap_kondisi_jalan], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LapKondisiJalan $lap_kondisi_jalan)
    {
        $lap_kondisi_jalan->update($request->all());
        return response()->json(['message' => 'Berhasil mengubah jalan', 'data' => $lap_kondisi_jalan], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LapKondisiJalan $lap_kondisi_jalan)
    {
        $lap_kondisi_jalan->delete();
        return response()->json(['message' => 'Berhasil menghapus data'], 200);
    }
}