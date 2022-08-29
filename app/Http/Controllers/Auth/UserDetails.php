<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserDetails extends Controller
{

    public function show($id){

        try {
            $user = User::findOrFail($id);
            if ($user) {
                return response()->json(['status' => 'success', 'message' => 'User details',$user]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
