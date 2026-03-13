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
                'message' => 'Cart is empty'
            ], 400);
        }

        DB::beginTransaction();

        try {
            $total = 0;

            $request->validate([
                'shipping_address' => 'required|string|max:255',
                'shipping_city' => 'required|string|max:100',
                'shipping_province' => 'required|string|max:100',
                'shipping_postal_code' => 'required|regex:/^[a-zA-Z0-9]+$/',
                'shipping_country' => 'required|string|max:100',
                'shipping_phone' => 'required|integer|max:20'
            ], [
                'shipping_address.string' => 'La dirección de envío debe ser una cadena de texto.',
                'shipping_address.max' => 'La dirección de envío no puede tener más de 255 caracteres.',
                'shipping_city.string' => 'La ciudad de envío debe ser una cadena de texto.',
                'shipping_city.max' => 'La ciudad de envío no puede tener más de 100 caracteres.',
                'shipping_province.string' => 'La provincia de envío debe ser una cadena de texto.',
                'shipping_province.max' => 'La provincia de envío no puede tener más de 100 caracteres.',
                'shipping_postal_code.regex' => 'El código postal de envío debe ser un número entero.',
                'shipping_postal_code.max' => 'El código postal de envío no puede tener más de 20 caracteres.',
                'shipping_country.string' => 'El país de envío debe ser una cadena de texto.',
                'shipping_country.max' => 'El país de envío no puede tener más de 100 caracteres.',
                'shipping_phone.integer' => 'El número de teléfono de envío debe ser un número entero.',
                'shipping_phone.max' => 'El número de teléfono de envío no puede tener más de 20 caracteres.'
            ]);

            $order = Order::create([
                'user_id' => $request->user()->id,
                'total_price' => 0,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_province' => $request->shipping_province,
                'shipping_postal_code' => $request->shipping_postal_code,
                'shipping_country' => $request->shipping_country,
                'shipping_phone' => $request->shipping_phone
            ]);

            foreach ($cart->items as $item) {
                $price = $item->shirt->price;
                $total += $price * $item->quantity;

                OrderDetail::create([
                    'order_id' => $order->id,
                    'shirt_id' => $item->shirt_id,
                    'quantity' => $item->quantity,
                    'price' => $price,
                    'size' => $item->size
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
                'message' => $e
            ], 500);
        }
    }

    public function show(Order $order, Request $request) {
        if ($order->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }

        return response()->json($order->load('details.shirt.images'));
    }
}
