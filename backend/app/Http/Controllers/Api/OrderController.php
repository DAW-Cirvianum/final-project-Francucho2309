<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::with('details.shirt.team.league')->where('user_id', $request->user()->id)->get();

        return response()->json([
            'data' => $orders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cart = Cart::where('user_id', $request->user()->id)->with('items.shirt')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return response()->json([
                'message' => 'Cart está vacío'
            ], 400);
        }

        DB::beginTransaction();

        try {
            $total = 0;

            $order = Order::create([
                'user_id' => $request->user()->id,
                'total_price' => 0
            ]);

            foreach ($cart->items as $item) {
                $price = $item->shirt->price;
                $total += $price * $item->quantity;

                OrderDetail::create([
                    'order_id' => $order->id,
                    'shirt_id' => $item->shirt_id,
                    'quantity' => $item->quantity,
                    'price' => $price,
                    'size' => $request->input('size', 'S')
                ]);
            }

            $order->update(['total_price' => $total]);

            $cart->items()->delete();

            DB::commit();

            return response()->json([
                'data' => $order->load('details.shirt')
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Pedido fallido'
            ], 500);
        }
    }
}
