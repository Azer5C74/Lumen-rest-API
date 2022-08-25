<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;

class LogoutController extends Controller
{


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
