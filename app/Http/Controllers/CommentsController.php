<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\outfits;
use App\Models\Products;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class CommentsController extends Controller
{


    public function store(Request $request,$outfite)
    {
        $request->validate([
            'content' => 'required',
        ]);

        try {
            // Find the product
            $outfits = outfits::findOrFail($outfite);

            // Get the authenticated user
            $user = JWTAuth::parseToken()->authenticate();

            // Create a new comment
            $comment = new Comments();
            $comment->content = $request->input('content');

            // Associate the comment with the product and the authenticated user
            $comment->outfits()->associate($outfits);
            $comment->user()->associate($user);
            $comment->save();
            return response()->json(['message' => 'Comment stored successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }

    public function show($id)
    {
        $comments = Comments::whereHas('outfits', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();

        if ($comments->isEmpty()) {
            return response()->json(['message' => 'Comment not found'], 404);
        }
        return response()->json(['comment' => $comments], 200);
    }
}
