<?php

namespace App\Http\Controllers;

use App\Models\LapKondisiJembatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LapKondisiJembatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lap_kondisi_jembatans = LapKondisiJembatan::all();
        return response()->json(['message' => 'Berhasil menanpilakan data jembatan', 'data' => $lap_kondisi_jembatans], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $lap_kondisi_jembatan = LapKondisiJembatan::create($request->all());
        // return response()->json(['message' => 'Berhasil menambahkan jembatan', 'data' => $lap_kondisi_jembatan], 201);

        try {
            // Validate the incoming request
            $request->validate([
                'no_ruas_jembatan' => 'required',
                'nama_ruas_jembatan' => 'required',
                'panjang_ruas_jembatan' => 'nullable',
                'status_jembatan' => 'nullable',
                'kondisi_baik' => 'nullable',
                'kondisi_cukup_baik' => 'nullable',
                'kondisi_rusak_ringan' => 'nullable',
                'kondisi_rusak_berat' => 'nullable',
                'keseluruhan_kondisi' => 'nullable',
                'tahun_pembangunan' => 'nullable',
                'koordinat_jembatan' => 'nullable',
                'progress' => 'nullable',
                // Adjust file types and size limit as needed
                'gambar_jembatan.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            ]);

            // Create LapKondisijembatan instance with validated data
            $data = $request->except('gambar_jembatan');

            // Handle file uploads and populate gambar_jembatan_paths
            $gambar_jembatan_paths = [];
            if ($request->hasFile('gambar_jembatan')) {
                foreach ($request->file('gambar_jembatan') as $file) {
                    // Store the image and get its path
                    $path = $file->store('public/gambar_jalan');
                    // Get the public URL for the stored file
                    $url = Storage::url($path);
                    $gambar_jembatan_paths[] = $url;
                }
            }

            // Convert array of paths to string
            $gambar_jembatan_paths_string = implode(',', $gambar_jembatan_paths);

            // Set the gambar_jembatan_paths field in the $data array
            $data['gambar_jembatan'] = $gambar_jembatan_paths_string;

            // Automatically set the id_user field based on authenticated user
            $data['id_user'] = auth()->id();

            // Create LapKondisijembatan instance with validated data including gambar_jembatan_paths
            $lap_kondisi_jembatan = LapKondisiJembatan::create($data);

            return response()->json(['message' => 'Berhasil menambahkan jembatan', 'data' => $lap_kondisi_jembatan], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while storing the data.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LapKondisiJembatan $lap_kondisi_jembatan)
    {
        return response()->json(['message' => 'Berhasil menampilkan data jembatan', 'data' => $lap_kondisi_jembatan], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LapKondisiJembatan $lap_kondisi_jembatan)
    {
        $lap_kondisi_jembatan->update($request->all());
        return response()->json(['message' => 'Berhasil mengubah jembatan', 'data' => $lap_kondisi_jembatan], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LapKondisiJembatan $lap_kondisi_jembatan)
    {
        $lap_kondisi_jembatan->delete();
        return response()->json(['message' => 'Berhasil menghapus data'], 200);
    }
}
