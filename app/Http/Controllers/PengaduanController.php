<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaduans = Pengaduan::all();
        return response()->json(['message' => 'Berhasil menampilakan data pengaduan', 'data' => $pengaduans], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'koordinat' => 'nullable',
                'kondisi' => 'required',
                'keterangan' => 'required',
                // Adjust file types and size limit as needed
                'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            ]);

            // Create Pengaduan instance with validated data
            $data = $request->except('gambar');

            // Handle file uploads and populate gambar_paths
            $gambar_paths = [];
            if ($request->hasFile('gambar')) {
                foreach ($request->file('gambar') as $file) {
                    // Store the image and get its path
                    $path = $file->store('public/gambar_jalan');
                    // Get the public URL for the stored file
                    $url = Storage::url($path);
                    $gambar_paths[] = $url;
                }
            }

            // Convert array of paths to string
            $gambar_paths_string = implode(',', $gambar_paths);

            // Set the gambar_paths field in the $data array
            $data['gambar'] = $gambar_paths_string;

            // Automatically set the id_user field based on authenticated user
            $data['id_user'] = auth()->id();

            // Create Pengaduan instance with validated data including gambar_paths
            $pengaduan = Pengaduan::create($data);

            return response()->json(['message' => 'Berhasil menambahkan pengaduan', 'data' => $pengaduan], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while storing the data.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengaduan $pengaduan)
    {
        // Retrieve pengaduan data including the gambar field
        $gambar_paths = $pengaduan->gambar;
        
        // Return the response
        return response()->json([
            'message' => 'Berhasil menampilkan data pengaduan',
            'data' => [
                'pengaduan' => $pengaduan,
                'gambar_paths' => json_decode($gambar_paths),
            ],
        ], 200);
        // return response()->json(['message' => 'Berhasil menampilkan data pengaduan', 'data' => $pengaduan], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        $pengaduan->update($request->all());
        return response()->json(['message' => 'Berhasil mengubah data', 'data' => $pengaduan], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();
        return response()->json(['message' => 'Berhasil menghapus data'], 200);
    }
}
