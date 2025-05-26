<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderPlant;
use App\Models\Plant;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
  public function index()
{
    return Order::with(['plants'])->paginate(8);
    return response()->json($orders);
}

public function store(StoreOrderRequest $request)
{
    $data = $request->validated();

    DB::beginTransaction();

    try {
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

        foreach ($data['plants'] as $plantData) {
            $plant = Plant::findOrFail($plantData['id']);

            // Validar stock suficiente
            if ($plant->stock < $plantData['quantity']) {
                throw new \Exception("No hay stock suficiente para la planta: {$plant->name}");
            }

            // Crear el registro en order_plants
            OrderPlant::create([
                'order_id' => $order->id,
                'plant_id' => $plant->id,
                'quantity' => $plantData['quantity'],
                'price' => $plantData['price'],
            ]);

            // Reducir el stock
            $plant->stock -= $plantData['quantity'];
            $plant->save();
        }

        DB::commit();

        return response()->json([
            'message' => 'Order placed successfully.',
            'order_id' => $order->id,
        ], 201);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'error' => $e->getMessage(),
        ], 400);
    }
}

public function show($id)
{
    return Order::with('plants')->findOrFail($id);
}

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|string|in:pending,processing,shipped,delivered,cancelled',
    ]);

    $order = Order::findOrFail($id);
    $order->status = $request->input('status');
    $order->save();

    return response()->json([
        'message' => 'Order status updated successfully.',
        'order' => $order,
    ]);
}

public function destroy($id)
{
    $order = Order::findOrFail($id);
    $order->delete();

    return response()->json(['message' => 'Order deleted successfully']);
}



 public function getUserByOrder($id)
{
    $order = Order::with('user')->findOrFail($id);

    return response()->json($order->user);
}

    public function search(Request $request)
{

    $query = $request->input('q');



    $orders = Order::where('status', 'like', "%{$query}%")->paginate(8);

    return response()->json($orders);
}



}
