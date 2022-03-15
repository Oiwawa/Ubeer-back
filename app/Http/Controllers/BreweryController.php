<?php

namespace App\Http\Controllers;

use App\Models\brewery;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BreweryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Brewery[]|Collection
     */
    public function index()
    {
        return Brewery::all();
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
        $validator = Validator::make([$request->all()], [
            'name' => 'string|unique:user,username',
            'email' => 'email|unique:user,email',
            'phone' => 'string',
            'password' => 'string',
            'address' => 'string',
            'zipcode' => 'string',
            'city' => 'string',
        ]);

        $data = $validator->validate();
        $brewery = new Brewery();
        $brewery->fill($data);
        $brewery->save();
        return response()->json(compact('brewery'));
    }

    /**
     * Display the specified resource.
     *
     * @param Brewery $brewery
     * @return JsonResponse
     */
    public function show(Brewery $brewery): JsonResponse
    {
        return response()->json(compact('brewery'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param brewery $brewery
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, Brewery $brewery): JsonResponse
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
        $brewery->fill($data);
        $brewery->save();
        return response()->json(compact('brewery'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param brewery $brewery
     * @return JsonResponse
     */
    public function destroy(Brewery $brewery): JsonResponse
    {
        $brewery->delete();
        return response()->json(['status' => 'brewery deleted']);
    }
}
