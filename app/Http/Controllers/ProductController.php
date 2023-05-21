<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Name' => 'required|string',
            'Description' => 'required|string',
            'Price' => 'required|numeric',
            'Size' => 'required|enum:Djellaba,Kaftan,Takchita,Jabador,Burnous',
            'count' => 'required|integer',
            'id_Images' => 'required|integer',
            'Color' => 'required|string',
            'created_at' => 'required|timestamp',
            'created_By' => 'required|integer',
        ]);

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $request->validate([
            'Name' => 'string',
            'Description' => 'string',
            'Price' => 'numeric',
            'Size' => 'enum:Djellaba,Kaftan,Takchita,Jabador,Burnous',
            'count' => 'integer',
            'id_Images' => 'integer',
            'Color' => 'string',
            'created_at' => 'timestamp',
            'created_By' => 'integer',
        ]);

        $product->update($request->all());
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }
}
