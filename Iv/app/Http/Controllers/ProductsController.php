<?php

namespace App\Http\Controllers;
use App\Models\Attachments;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ProductsController extends Controller
{
    /**
     * Récupère tous les produits avec leurs relations.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::with(['Colors', 'categories', 'attachments'])->get();
        return response()->json($products);
    }

    /**
     * Récupère un produit spécifique avec ses relations.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Products::with(['Colors', 'categories', 'attachments'])->find($id);
        return response()->json($product);
    }

    /**
     * Crée un nouveau produit avec ses relations.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product = new Products;
        // Définir les attributs du produit en fonction de la requête
        $product->Name = $request->input('Name');
        $product->Description = $request->input('Description');
        $product->Price = $request->input('Price');
        $product->Size = $request->input('Size');
        $product->created_by = $request->input('created_by');
        $product->save();
        
        // Attacher les couleurs, catégories et pièces jointes au produit
        $product->Colors()->sync($request->input('colors_ids'));
        $product->categories()->sync($request->input('categories_id'));
        
        if ($request->hasFile('attachments')) {
            $images = $request->file('attachments');
        
            foreach ((array)$images as $image) {
                // Enregistrement de chaque image
        
                $path = $image->store('images', 'resources');
        
                // Récupération de la taille et de l'extension du fichier
                $size = $image->getSize();
                $extention = $image->getClientOriginalExtension();
        
                // Création de l'enregistrement dans la table "attachments"
        
                $attachment = new Attachments();
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Products::find($id);
        // Mettre à jour les attributs du produit en fonction de la requête
        $product->Name = $request->input('Name');
        $product->Description = $request->input('Description');
        $product->Price = $request->input('Price');
        $product->Size = $request->input('Size');
        $product->created_by = $request->input('created_by');
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
     * @return \Illuminate\Http\Response
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