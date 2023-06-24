<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class LikesController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'outfit_id' => 'required|exists:outfits,id',
        ]);

        // Get the authenticated user
        $user = JWTAuth::parseToken()->authenticate();

        // Check if the user has already liked the outfit
        $existingLike = Likes::where('outfits_id', $request->input('outfit_id'))
            ->where('user_id', $user->id)
            ->first();

        if ($existingLike) {
            return response()->json(['message' => 'You have already liked this outfit'], 400);
        }

        // Create a new like
        $like = new Likes();
        $like->outfits_id = $request->input('outfit_id');
        $like->user_id = $user->id;
        $like->save();

        return response()->json(['message' => 'Like stored successfully'], 201);
    }
    public function destroy(Request $request)
    {
        $request->validate([
            'outfit_id' => 'required|exists:outfits,id',
        ]);

// Get the authenticated user
        $user = JWTAuth::parseToken()->authenticate();

// Find the like with the given outfit_id that belongs to the authenticated user
        $like = Likes::where('outfits_id', $request->input('outfit_id'))
            ->where('user_id', $user->id)
            ->first();

        if (!$like) {
            return response()->json(['message' => 'Like not found'], 404);
        }

        $like->delete();

        return response()->json(['message' => 'Like deleted successfully'], 200);

    }

}
