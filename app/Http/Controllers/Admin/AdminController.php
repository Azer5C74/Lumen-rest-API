<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $rules =[
                'name' =>'required|unique:articles|max:255',
                'email' => 'required|unique|email',
                'password'=>'max:255',
                'link' => 'max:255',
                'category_id'=>['required',Rule::exists('categories','id')]
            ];
            $this->validate($request,$rules);
            $user->fill($request->all());

            if ($user->save()) {
                return response()->json(['status' => 'success', 'message' => 'Article Updated Successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user->delete()) {
                return response()->json(['status' => 'success', 'message' => 'User Deleted Successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
