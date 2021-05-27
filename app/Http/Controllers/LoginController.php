<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke(Request $request)
    {
        $details = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard()->attempt($details)) {
            $request->session()->regenerate();

            return response()->json([
                'message' => 'Welcome to our app',
                'user' => Auth::user(),
            ]);
        }

        throw ValidationException::withMessages([
            'email' => ['These credentials do not match our records.'],
        ])->status(401);
    }
}
