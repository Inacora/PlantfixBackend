<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{public function store(Request $request)
{
    $order = Order::create([
        'user_id' => $request->user_id, // o auth()->id()
        'order_date' => now(),
        'status' => 'pending',
        'total_price' => $request->total_price,
    ]);

    foreach ($request->items as $item) {
        OrderPlant::create([
            'order_id' => $order->id,
            'plant_id' => $item['id'],
            'quantity' => $item['quantity'],
            'price_at_time' => $item['price'],
        ]);
    }

    return response()->json(['message' => 'Pedido realizado', 'order_id' => $order->id]);
}
}