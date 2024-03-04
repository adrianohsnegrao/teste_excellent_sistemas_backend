<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Order::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.amount' => 'required|numeric'
        ]);

        try {
            $order = new Order();
            $order->total = 0;
            $order->save();

            foreach ($request->products as $product) {
                $order->products()->attach($product['id'], ['amount' => $product['amount']]);
                $order->total += Product::find($product['id'])->price * $product['amount'];
            }

            $order->save();

            return response()->json($order);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(Order $order)
    {
        return response()->json($order);
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'product_id' => 'required',
            'amount' => 'required'
        ]);

        $product = Product::find($request->product_id);

        $order->update([
            'product_id' => $request->product_id,
            'amount' => $request->amount,
            'total' => $request->amount * $order->product->price
        ]);
        return response()->json($order);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json('Order deleted successfully');
    }

    public function showProducts(Order $order)
    {
        $products = $order->products()->with('images')->get();

        return response()->json($products);
    }
}
