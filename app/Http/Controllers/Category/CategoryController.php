<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all());
    }

    public function store(Request $request)
    {
        try {
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;

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
