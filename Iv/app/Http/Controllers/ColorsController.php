<?php

namespace App\Http\Controllers;

use App\Models\Colors;
use App\Models\Products;

use Illuminate\Http\Request;

class ColorsController extends Controller
{
    public function index()
    {
        // Récupérer tous les produits liés à la couleur
        $colors = Colors::with('products')->get();

        // Retourner les couleurs avec les produits associés en JSON
        return response()->json($colors);
    }

    public function show($id)
    {
        // Récupérer une couleur spécifique avec ses produits associés
        $color = Colors::with('products')->findOrFail($id);

        // Retourner la couleur avec les produits associés en JSON
        return response()->json($color);
    }

    public function store(Request $request)
    {
        // Valider les données reçues du formulaire
        $request->validate([
            'color' => 'required|string',
           // 'product_ids' => 'required|array',
           // 'product_ids.*' => 'exists:products,id',
        ]);

        // Créer une nouvelle couleur
        $color = Colors::create([
            'color' => $request->input('color'),
        ]);

        // Attacher les produits à la couleur
       // $color->products()->attach($request->input('product_ids'));

        // Retourner la couleur créée avec les produits associés en JSON
    
        return response() -> json ([
            "status" => true,
            "message" => "les donnees creee",
            "data" => $color,
        ])->header('Content-Type', 'application/json');
    }

    public function update(Request $request, $id)
    {
        // Valider les données reçues du formulaire
        $request->validate([
            'color' => 'required|string',

        ]);

        // Trouver la couleur à mettre à jour
        $color = Colors::findOrFail($id);

        // Mettre à jour les attributs de la couleur
        $color->update([
            'color' => $request->input('color'),
        ]);

        // Mettre à jour les produits associés à la couleur s'ils sont fournis
        if ($request->has('product_ids')) {
            $color->products()->sync($request->input('product_ids'));
        }

        // Retourner la couleur mise à jour avec les produits associés en JSON
        return response()->json($color);
    }

    public function destroy($id)
    {
        // Trouver la couleur à supprimer
        $color = Colors::findOrFail($id);

        // Détacher tous les produits associés à la couleur
        $color->products()->detach();

        // Supprimer la couleur
        $color->delete();

        // Retourner une réponse JSON pour indiquer que la couleur a été supprimée avec succès
        return response()->json(['message' => 'Color deleted'], 200);
    }
}