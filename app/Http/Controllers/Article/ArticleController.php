<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    public function index()
    {
        return response()->json(Article::all());
    }


    public function show(Request $request, $slug)
    {
        $rules = array(
            'slug' => 'required'
        );
        $messages = array(
            'slug.required' => 'slug is required.'
        );
        $validator = Validator::make(array('slug' => $slug), $rules, $messages);
        if (!$validator->fails()) {
            return response()->json(Article::findOrFail($slug));

        } else {
            $errors = $validator->errors();
            return response()->json($errors->all());
        }
    }

    public function store(Request $request)
    {
        try {
            $rules =[
                'title' =>'required|unique:articles|max:255',
                'slug' => 'required|unique:articles|max:5',
                'description'=>'max:255',
                'link' => 'max:255',
                'category_id'=>['required',Rule::exists('categories','id')]
            ];


        $this->validate($request,$rules);
            if (Article::create($request->all())) {
                return response()->json(['status' => 'success', 'message' => 'Article Created Successfully',"date"=>$request->all()]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $slug)
    {
        try {
            $article = Article::findOrFail($slug);
            $rules =[
                'title' =>'required|unique:articles|max:255',
                'slug' => 'required|unique:articles|max:5',
                'description'=>'max:255',
                'link' => 'max:255',
                'category_id'=>['required',Rule::exists('categories','id')]
            ];
            $this->validate($request,$rules);
            $article->fill($request->all());

            if ($article->save()) {
                return response()->json(['status' => 'success', 'message' => 'Article Updated Successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
          $article = Article::findOrFail($id);
            if ($article->delete()) {
                return response()->json(['status' => 'success', 'message' => 'Article Deleted Successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
