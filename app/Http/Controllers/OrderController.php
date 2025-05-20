<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderPlant;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_date' => now(),
            'status' => 'pending',
            'total_price' => $data['total_price'],
            'address' => $data['address'],
            'city' => $data['city'],
            'country' => $data['country'],
            'phone_number' => $data['phone_number'],
        ]);

        foreach ($data['plants'] as $plant) {
            OrderPlant::create([
                'order_id' => $order->id,
                'plant_id' => $plant['id'],
                'quantity' => $plant['quantity'],
                'price' => $plant['price'], 
            ]);
        }

        return response()->json([
            'message' => 'Order placed successfully.',
            'order_id' => $order->id,
        ]);
    }
}
