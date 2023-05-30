<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class controllerorders extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = orders::all();

        return response()->json([
            'status' => true,
            'message' => 'voila les commandes',
            'data' => $orders,
        ])->header('Content-Type', 'application/json');
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
        {
            $data = $request ->validate([
                "total" => "required|string|max:255",
                "created_By" => "nullable",
            ]);
        
            $orders = Orders::create($data);
            
            return response() -> json ([
                "status" => true,
                "message" => "la création de commandes est juste",
                "data" => $orders,
            ])->header('Content-Type', 'application/json');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $orders = Orders::find($id);

        return response()->json([
            'status' => true,
            'message' => 'voila les details de commande',
            'data' => $orders,
        ],200)->header('Content-Type', 'application/json');
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
        $data = $request ->validate([
            "total" => "required|string|max:255",
        ]);
    
        $orders = Orders::find($id);

        if($orders){
            $orders -> update($data);
            return response() -> json ([
                "status" => true,
                "message" => "les données ont été modifiés",
                "data" => $orders,
            ])->header('Content-Type', 'application/json');
        } else{
            return response() -> json ([
                "status" => false,
                "message" => "id n'est pas trouvée",
                "data" => null,
            ],404)->header('Content-Type', 'application/json');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orders= Orders::find($id);

        if($orders){
            $orders->delete();
            return response() -> json ([
                "status" => true,
                "message" => "la donnée est supprimée",
                "data" => null,
            ],404)->header('Content-Type', 'application/json');
        }
        else {
            return response() -> json ([
                "status" => false,
                "message" => "id n'est pas trouvée",
                "data" => null,
            ],404)->header('Content-Type', 'application/json');
        }
    }
}
