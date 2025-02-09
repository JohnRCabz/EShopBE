<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController
{
    public function index()
    {
        return Item::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer', 
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $item = Item::create($validatedData);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return Item::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer', 
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $item = Item::findOrFail($id);
        $item->update($validatedData);
        return response()->json($item, 200);
    }

    public function destroy($id)
    {
        Item::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}