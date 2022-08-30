<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserDetails extends Controller
{

    public function show(){

        try {
            $user = User::findOrFail(Auth::user()->id);
            if ($user) {
                return response()->json(['status' => 'success', 'message' => 'User details and Articles',$user, $this->userIndex()]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function userIndex()
    {
        $articles = Article::where(['user_id' => Auth::user()->id])
            ->paginate();
        return response()->json($articles);
    }



}
