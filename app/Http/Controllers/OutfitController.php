<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Outfit; // Import the Outfit model

class OutfitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $outfits = Outfit::all();
        return response()->json($outfits);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'created_By' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string',
            'Price' => 'required|numeric',
            'Size' => 'required|integer',
            'Type' => 'required|string|in:Djellaba,Kaftan,Takchita,Jabador,Burnous',
            'id_tags' => 'required|integer',
            'id_Produit' => 'required|integer',
            'id_Images' => 'required|integer',
        ]);

        $outfit = Outfit::create($request->all());
        return response()->json($outfit, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $outfit = Outfit::find($id);
        if (!$outfit) {
            return response()->json(['message' => 'Outfit not found'], 404);
        }
        return response()->json($outfit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $outfit = Outfit::find($id);
        if (!$outfit) {
            return response()->json(['message' => 'Outfit not found'], 404);
        }

        $request->validate([
            'created_By' => 'integer',
            'name' => 'string',
            'description' => 'string',
            'Price' => 'numeric',
            'Size' => 'integer',
            'Type' => 'string|in:Djellaba,Kaftan,Takchita,Jabador,Burnous',
            'id_tags' => 'integer',
            'id_Produit' => 'integer',
            'id_Images' => 'integer',
        ]);

        $outfit->update($request->all());
        return response()->json($outfit);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $outfit = Outfit::find($id);
        if (!$outfit) {
            return response()->json(['message' => 'Outfit not found'], 404);
        }
        $outfit->delete();
        return response()->json(['message' => 'Outfit deleted']);
    }
}
