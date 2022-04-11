<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use Carbon\Carbon;
use Faker\Core\Uuid;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Nette\Utils\Random;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection|Order[]
     */
    public function index(): JsonResponse
    {
        return response()->json(Order::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $items = Product::paginate(2);
        $order = new Order();
        $order->seller = Seller::where('name', $request->get('seller'))->first();
        $order->status = ORDER::STATUS_ORDERED;
        $order->deliver_time = Carbon::parse($request->get('deliver_time'));

        $cart = $request->all('cart');
        $cart = Product::all();
        foreach ($cart as $item) {
            $order->products()->attach($item->id, ['quantity' => $item->quantity]);
        }

        return response()->json($order);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return JsonResponse
     */
    public function show(Order $order): JsonResponse
    {
        return response()->json(compact('order'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return JsonResponse
     */
    public function destroy(Order $order): JsonResponse
    {
        $order->delete();
        return response()->json(['status' => 'order deleted']);
    }
}
