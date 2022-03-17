<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(): string
    {
        return Product::all()->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
           'name' => 'string|required|unique:product,name',
           'description' => 'string',
           'price' => 'integer|required',
           'icon' => 'string|required',
        ]);

        $data = $validator->validate();
        $product = new Product($data);
        $seller = Seller::where('name', $request->get('seller'))->first();
        $product->seller_id = $seller->id;
        $product->save();

        return response()->json(compact('product'));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, Product $product): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required|unique:product,name',
            'description' => 'string',
            'price' => 'integer|required',
            'icon' => 'string|required'
        ]);

        $data = $validator->validate();
        $product->fill($data);
        $product->save();

        return response()->json(compact('product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return response()->json(['status' => 'product deleted']);
    }
}
