<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'plants' => 'required|array',
            'plants.*.id' => 'required|exists:plants,id',
            'plants.*.quantity' => 'required|integer|min:1',
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string|in:credit_card,paypal,cash',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|string|in:pending,completed,cancelled',
            'order_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        $order = Order::create($validated);

        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
