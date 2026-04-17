<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
     public function index()
    {
        $item = Item::with('category')->get();

        return response()->json([
            'message' => 'Item getted successfully',
            'data' => $item
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' =>'required|string',
            'stock' =>'required|integer',
            'category_id' =>'required|exists:categories,id'
        ]);

        $item = Item::create([
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'category_id' => $request->category_id
        ]);

        return response()->json([
            'message' => 'item stored successfully',
            'data' => $item
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::find($id);
        if (is_null($item)) {
            return response()->json([
                'message' => 'Item not Found'
            ], 404);
        }

        return response()->json([
            'message' => 'Item getted successfully',
            'data' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Item::find($id);
        if (is_null($item)) {
            return response()->json([
                'message' => 'Item not Found'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string',
            'description' =>'required|string',
            'stock' =>'required|integer',
            'category_id' =>'required|exists:categories,id'
        ]);

        $item->update([
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'category_id' => $request->category_id
        ]);

        return response()->json([
            'message' => 'Item updated successfully',
            'data' => $item
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);
        if (is_null($item)) {
            return response()->json([
                'message' => 'Item not Found'
            ], 404);
        }

        $item->delete();

        return response()->json([
            'message' => 'Item deleted successfully'
        ]);
    }
}
