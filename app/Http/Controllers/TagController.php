<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return response()->json($tags);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $tag = Tag::create($request->all());
        return response()->json($tag, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tag = Tag::find($id);
        if (!$tag) {
            return response()->json(['message' => 'Tag not found'], 404);
        }
        return response()->json($tag);
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
        $tag = Tag::find($id);
        if (!$tag) {
            return response()->json(['message' => 'Tag not found'], 404);
        }

        $request->validate([
            'name' => 'string',
        ]);

        $tag->update($request->all());
        return response()->json($tag);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::find($id);
        if (!$tag) {
            return response()->json(['message' => 'Tag not found'], 404);
        }
        $tag->delete();
        return response()->json(['message' => 'Tag deleted']);
    }
}
