<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create($request->getData());
        $token = $user->createToken($user->name.'_ACESS_TOKEN')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'type' => 'Bearer'
        ], Response::HTTP_OK);
    }
}
