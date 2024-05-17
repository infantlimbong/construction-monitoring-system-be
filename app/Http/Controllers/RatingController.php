<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ratings = Rating::all();
        return response()->json(['message' => 'Berhasil menanpilakan data Rating', 'data' => $ratings], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'rate' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);

        // Create a new rating instance
        $rating = new Rating([
            'id_user' => auth()->id(),
            'rate' => $request->input('rate'),
            'review' => $request->input('review'),
        ]);

        // Save the rating to the database
        $rating->save();

        return response()->json(['message' => 'Berhasil menambahkan Rating', 'data' => $rating], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        return response()->json(['message' => 'Berhasil menampilkan data Rating', 'data' => $rating], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rating $rating)
    {
        $rating->update($request->all());
        return response()->json(['message' => 'Berhasil mengubah data', 'data' => $rating], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        $rating->delete();
        return response()->json(['message' => 'Berhasil menghapus data'], 200);
    }
}
