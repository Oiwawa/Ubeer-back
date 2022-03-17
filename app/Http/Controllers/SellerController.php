<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Seller[]
     */
    public function index(): array
    {
        return Seller::all();
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
        $validator = Validator::make($request->toArray(), [
            'name' => 'string|unique:seller,name',
            'email' => 'email|unique:user,email',
            'phone' => 'string',
            'password' => 'string',
            'address' => 'string',
            'zipcode' => 'string',
            'city' => 'string',
        ]);

        $data = $validator->validate();
        $seller = new Seller();
        $seller->fill($data);
        $seller->save();
        return response()->json(compact('seller'));
    }

    /**
     * Display the specified resource.
     *
     * @param Seller $seller
     * @return JsonResponse
     */
    public function show(Seller $seller): JsonResponse
    {
        return response()->json(compact('seller'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Seller $seller
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, Seller $seller): JsonResponse
    {
        $validator = Validator::make([$request->all()], [
            'name' => 'string|unique:user,username',
            'email' => 'email|unique:user,email',
            'password' => 'string',
            'address' => 'string',
            'zipcode' => 'string',
            'city' => 'string',
        ]);

        $data = $validator->validate();
        $seller->fill($data);
        $seller->save();
        return response()->json(compact('seller'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Seller $seller
     * @return JsonResponse
     */
    public function destroy(Seller $seller): JsonResponse
    {
        $seller->delete();
        return response()->json(['status' => 'seller deleted']);
    }
}
