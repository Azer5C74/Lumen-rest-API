<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all());
    }

    public function show($id)
    {

        try {
            if (!empty($id)) {
                $category = Article::get()->where('category_id', $id);
                if (count($category) == 0) {
                    return response()->json(['status' => 'error', 'message' => 'no results', Response::HTTP_NO_CONTENT]);

                };
                return response()->json($category);
            }

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);

        }
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|unique:categories|max:10',
                'slug' => 'required|unique:categories|max:10',

            ];
            $this->validate($request, $rules);


            if (Category::create($request->all())) {
                return response()->json(['status' => 'success', 'message' => 'Category Created Successfully', $request->all()]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $slug)
    {
        try {
            $category = Category::findOrFail($slug);
            $rules = [
                'name' => 'required|unique:categories|max:5',
                'slug' => 'required|unique:categories|max:5',

            ];
            $this->validate($request, $rules);
            $category->fill($request->all());

            if ($category->save()) {
                return response()->json(['status' => 'success', 'message' => 'Category Updated Successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy($slug)
    {
        try {
            $category = Category::findOrFail($slug);
            if ($category->delete()) {
                return response()->json(['status' => 'success', 'message' => 'Category Deleted Successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
