<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\outfits;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class OutfitsController extends Controller
{

    public function index2()
    {


        $outfits=outfits::with(
            ['products']
        )->withCount(['comments', 'likes'])
        ->get();

        return response()->json($outfits);
    }

    public function index()
    {
        $user = JWTAuth::parseToken()->authenticate();

        $outfits = outfits::with(['products'])
            ->withCount(['comments', 'likes'])
            ->get()
            ->map(function ($outfit) use ($user) {
                $outfit->isLiked = Likes::where('outfits_id', $outfit->id)
                    ->where('user_id', $user->id)
                    ->exists();
                return $outfit;
            });

        return response()->json($outfits);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            //'image' => 'required|image',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.x' => 'required|numeric',
            'products.*.y' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $outfit = new outfits;
        $outfit->name = $request->input('name');
        $outfit->description = $request->input('description');
        // Handle image upload and set the image attribute accordingly
        // Example: $outfit->image = $request->file('image')->store('images');
        $outfit->save();

        $productData = $request->input('products');

        foreach ($productData as $productItem) {
            $productId = $productItem['id'];
            $x = $productItem['x'];
            $y = $productItem['y'];

            $product = Products::find($productId);
            if ($product) {
                $outfit->products()->attach($product, ['x' => $x, 'y' => $y]);
            }
        }

        return response()->json(['message' => 'Outfit created successfully',
            'data' => $outfit], 201);
    }

    public function show(string $id)
    {
        $outfit = outfits::find($id);
        if (!$outfit) {
            return response()->json(['message' => 'Outfit not found'], 404);
        }
        return response()->json($outfit);
    }

}
