<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attachments = Attachment::all();
        return response()->json($attachments);
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
            'path' => 'required|string',
            'size' => 'required|numeric',
            'extension' => 'required|string',
            'type' => 'required|in:product,outfit',
        ]);

        $attachment = Attachment::create($request->all());
        return response()->json($attachment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attachment = Attachment::find($id);
        if (!$attachment) {
            return response()->json(['message' => 'Attachment not found'], 404);
        }
        return response()->json($attachment);
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
        $attachment = Attachment::find($id);
        if (!$attachment) {
            return response()->json(['message' => 'Attachment not found'], 404);
        }

        $request->validate([
            'path' => 'string',
            'size' => 'numeric',
            'extension' => 'string',
            'type' => 'in:product,outfit',
        ]);

        $attachment->update($request->all());
        return response()->json($attachment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attachment = Attachment::find($id);
        if (!$attachment) {
            return response()->json(['message' => 'Attachment not found'], 404);
        }
        $attachment->delete();
        return response()->json(['message' => 'Attachment deleted']);
    }
}
