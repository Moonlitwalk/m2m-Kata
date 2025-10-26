<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\{Auth, Hash};
use App\Http\Requests\{LoginUserRequest, RegisterUserRequest};
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{

    public function register(RegisterUserRequest $request)
    {

        $data = $request->validated();

        //$user = User::create($data); -> wäre laut AI zu ungenau hier weil Felder wie password_confirmation mit in den validated daten steht,
        //könnte zu mass assignment Fehlern führen

        $user = User::create([
            'name' => $data['name'],
            'email' => strtolower($data['email']),
            'password' => Hash::make($data['password'])
        ]);

        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ],
            'token => $token'
        ], 201);
    }


    public function login(LoginUserRequest $request)
    {
        $creds = $request->validated();
        if (!Auth::attempt($creds)) {
            return response()->json(['message' => 'invalid login'], 401);
        }
        $token = $request->user()->createToken('api')->plainTextToken;
        return response()->json(['token' => $token]);
    }


    public function me(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()?->delete();
        return response()->noContent();
    }


}
