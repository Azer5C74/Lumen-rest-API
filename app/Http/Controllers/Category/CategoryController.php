<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all());
    }
    public function show( $category_id ){

       try{
        if(!empty($category_id)){
            $category = Article::get()->where('category_id',$category_id);
                if(count($category)==0){
                    return response()->json(['status' => 'error', 'message' => 'no results', 500]);

                };
            return response()->json($category);
        }

       }
       catch (\Exception $e){
           return response()->json(['status' => 'error', 'message' => $e->getMessage()]);

       }
    }
    public function store(Request $request)
    {
        try {
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;

            // Check if field is empty
            if (empty($category->name) or empty( $category->slug)) {
                return response()->json(['status' => 'error', 'message' => 'You must fill all the fields']);
            }


            // Check if category already exist
            if (Category::where('name', '=', $category->name)->exists()) {
                return response()->json(['status' => 'error', 'message' => 'Category already exists with this title']);
            }
            if ($category->save()) {
                return response()->json(['status' => 'success', 'message' => 'Category Created Successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
