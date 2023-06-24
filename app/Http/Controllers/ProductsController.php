<?php

namespace App\Http\Controllers;
use App\Models\attachments;
use App\Models\categories;
use App\Models\Colors;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;


class ProductsController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    public function index()
    {
        $products = Products::with(['Colors', 'categories', ])->get();
        return response()->json($products);
    }

    public function show($id)
    {
        $product = Products::with(['Colors', 'categories'])->find($id);
        return response()->json($product);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Name' => 'required|string|max:255',
            'Description' => 'required|string',
            'Price' => 'required|numeric|min:0',
            'Size' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }


        $product = new Products;
        // Définir les attributs du produit en fonction de la requête
        $product->Name = $request->input('Name');
        $product->Description = $request->input('Description');
        $product->Price = $request->input('Price');
        $product->Size = $request->input('Size');
        $product->created_by = $this->user->id;


        if (!$request->has('colors')) {
            return response()->json(['error' => 'colors field is required.'], 401);
        }

        if (!$request->has('categories')) {
            return response()->json(['error' => 'categories field is required.'], 401);
        }

        $product->save();

        $product->colors()->attach($request->input('colors'));
        $product->categories()->attach($request->input('colors'));


        if ($request->hasFile('attachments')) {
            $images = $request->file('attachments');

            foreach ((array)$images as $image) {
                // Enregistrement de chaque image

                $path = $image->store('images', 'resources');

                // Récupération de la taille et de l'extension du fichier
                $size = $image->getSize();
                $extention = $image->getClientOriginalExtension();

                // Création de l'enregistrement dans la table "attachments"

                $attachment = new attachments();
                $attachment->product_id = $product->id;
                $attachment->path = $path;
                $attachment->Size = $size;
                $attachment->extention = $extention;
                $attachment->Type = $image->getClientMimeType();
                $attachment->save();

            }
        }

        return response() -> json ([
            "status" => true,
            "message" => "les donnees creee",
            "data" => $product,
        ])->header('Content-Type', 'application/json');
    }

    /**
     * Met à jour un produit existant avec ses relations.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {

        $product = Products::find($id);
        // Mettre à jour les attributs du produit en fonction de la requête
        $product->Name = $request->input('Name') ? $request->input('Name') : $product->Name;
        $product->Description = $request->input('Description') ? $request->input('Description') : $product->Description;
        $product->Price = $request->input('Price') ? $request->input('Price') : $product->Price;
        $product->Size = $request->input('Size') ? $request->input('Size') : $product->Size;
        $product->created_by = $this->user->id;
        $product->save();

        // Mettre à jour les couleurs, catégories et pièces jointes du produit
        $product->Colors()->sync($request->input('colors_ids'));
        $product->categories()->sync($request->input('categories_ids'));
        $product->attachments()->sync($request->input('attachments_ids'));

        return response()->json($product);
    }

    /**
     * Supprime un produit et ses relations.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $product = Products::find($id);

        // Détacher toutes les relations du produit
        $product->Colors()->detach();
        $product->categories()->detach();
        $product->attachments()->detach();

        // Supprimer le produit
        $product->delete();

        return response()->json('Deleted successfully.');
    }
}
