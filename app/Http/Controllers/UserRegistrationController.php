<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRegistrationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:5|max:150',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // login the user
        Auth::guard()->login($user = User::create($data));

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
    }
}
