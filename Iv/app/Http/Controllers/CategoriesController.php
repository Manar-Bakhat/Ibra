<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\Products;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        // Récupérer toutes les catégories avec les produits associés
        $categories = Categories::with('products')->get();

        // Retourner les catégories avec les produits associés en JSON
        return response()->json($categories);
    }

    public function show($id)
    {
        // Récupérer une catégorie spécifique avec les produits associés
        $category = Categories::with('products')->findOrFail($id);

        // Retourner la catégorie avec les produits associés en JSON
        return response()->json($category);
    }

    public function store(Request $request)
    {
        // Valider les données reçues du formulaire
        $request->validate([
            'title' => 'required|string',
        ]);

        // Créer une nouvelle catégorie
        $category = Categories::create([
            'title' => $request->input('title'),
        ]);

        // Attacher les produits à la catégorie
       // $category->products()->attach($request->input('product_ids'));

        // Retourner la catégorie créée avec les produits associés en JSON
       
        return response() -> json ([
            "status" => true,
            "message" => "les donnees creee",
            "data" => $category,
        ])->header('Content-Type', 'application/json');
    }

    public function update(Request $request, $id)
    {
        // Valider les données reçues du formulaire
        $request->validate([
            'title' => 'required|string',
        ]);

        // Trouver la catégorie à mettre à jour
        $category = Categories::findOrFail($id);

        // Mettre à jour les attributs de la catégorie
        $category->update([
            'title' => $request->input('title'),
        ]);

        // Mettre à jour les produits associés à la catégorie s'ils sont fournis
        if ($request->has('product_ids')) {
            $category->products()->sync($request->input('product_ids'));
        }

        // Retourner la catégorie mise à jour avec les produits associés en JSON
        return response()->json($category);
    }

    public function destroy($id)
    {
        // Trouver la catégorie à supprimer
        $category = Categories::findOrFail($id);

        // Détacher tous les produits associés à la catégorie
        $category->products()->detach();

        // Supprimer la catégorie
        $category->delete();

        // Retourner une réponse JSON pour indiquer que la catégorie a été supprimée avec succès
        return response()->json(['message' => 'Category deleted'], 200);
    }
}