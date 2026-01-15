<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show(Request $request) {
        $cart = Cart::firstOrCreate(['user_id' => $request->user()->id]);

        $cart->load('items.shirt.team.league');

        return response()->json([
            'data' => $cart
        ]);
    }

    public function addItem(Request $request)
    {
        $request->validate([
            'shirt_id' => 'required|exists:shirts,id',
            'quantity' => 'required|integer|min:1',
            'size' => 'required|string'
        ]);

        $cart = Cart::firstOrCreate(['user_id' => $request->user()->id]);

        $item = CartItem::updateOrCreate(
            [
                'cart_id' => $cart->id,
                'shirt_id' => $request->shirt_id,
                'size' => $request->size
            ],
            [
                'quantity' => $request->quantity
            ]
        );

        return response()->json([
            'data' => $item
        ], 201);
    }

    public function removeItem(Request $request, CartItem $item)
    {
        if ($item->cart->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }

        $item->delete();

        return response()->json([
            'message' => 'Product removed'
        ], 204);
    }
}
