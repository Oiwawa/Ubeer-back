<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(): string
    {
        return User::all()->toJson();
    }

    /**
     * Store a newly created user in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make([$request->all()], [
            'username' => 'string|unique:users,username',
            'email' => 'email|unique:users,email',
            'password' => 'string',
            'address' => 'string',
            'zipcode' => 'string',
            'city' => 'string',
        ]);

        $data = $validator->validate();
        $user = new User();
        $user->fill($data);
        $user->save();
        return response()->json(compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return response()->json(compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, User $user): JsonResponse
    {
        $validator = Validator::make([$request->all()], [
            'username' => 'string|unique:user,username',
            'email' => 'email|unique:user,email',
            'password' => 'string',
            'address' => 'string',
            'zipcode' => 'string',
            'city' => 'string',
        ]);

        $data = $validator->validate();
        $user->fill($data);
        $user->save();
        return response()->json(compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json(['status' => 'user deleted']);
    }
}
