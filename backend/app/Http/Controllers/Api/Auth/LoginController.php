<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        if (!auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            throw ValidationException::withMessages([
                'message' => ['The Credentials you entered are incorrect.']
            ]);
        }

        $token = $request->user()->createToken(auth()->user()->name.'_ACESS_TOKEN')->plainTextToken;

        return response()->json([
            'token' => $token,
            'type' => 'Bearer'
        ], Response::HTTP_OK);
    }
}
