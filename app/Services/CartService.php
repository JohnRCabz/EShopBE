<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;

class CartService
{
    public function addItemToCart(Request $request)
    {
        $validatedData = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $item = Item::findOrFail($validatedData['item_id']);

        if ($item->quantity < $validatedData['quantity']) {
            return response()->json(['message' => 'Not enough items in stock'], 400);
        }

        $cartItem = Cart::where('item_id', $validatedData['item_id'])->first();

        if ($cartItem) {
            // Update the quantity of the existing cart item
            $cartItem->quantity += $validatedData['quantity'];
            $cartItem->save();
        } else {
            // Create a new cart item
            $cartItem = Cart::create($validatedData);
        }

        // Deduct the quantity from the item
        $item->quantity -= $validatedData['quantity'];
        $item->save();

        return response()->json($cartItem, 201);
    }

    public function viewCart()
    {
        $cartItems = Cart::with('item')->get();
        $totalQuantity = Cart::totalQuantity();
        $totalAmount = Cart::totalAmount();

        return response()->json([
            'items' => $cartItems,
            'total_quantity' => $totalQuantity,
            'total_amount' => $totalAmount,
        ]);
    }

    public function removeItemFromCart($id)
    {
        $cartItem = Cart::findOrFail($id);
        $item = Item::findOrFail($cartItem->item_id);

        $item->quantity += $cartItem->quantity;
        $item->save();

        $cartItem->delete();
        return response()->json(null, 204);
    }

    public function checkout()
    {
        // Implement checkout logic here
        return response()->json(['message' => 'Checkout successful'], 200);
    }
}
