<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'slug.required' => 'id is required.'
        );
        $validator = Validator::make(array('slug' => $slug), $rules, $messages);
        if (!$validator->fails()) {
            return response()->json(Article::find($request->input('slug')));

        } else {
            $errors = $validator->errors();
            return response()->json($errors->all());
        }
    }

    public function store(Request $request)
    {
        try {
            $article = new Article();
            $article->title = $request->title;
            $article->slug = $request->slug;
            $article->link = $request->link;
            $article->description = $request->description;

            // Check if article already exist
            if (Article::where('title', '=', $article->title)->exists()) {
                return response()->json(['status' => 'error', 'message' => 'Article already exists with this title']);
            }
            if ($article->save()) {
                return response()->json(['status' => 'success', 'message' => 'Article Created Successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $article = Article::findOrFail($id);
            $article->title = $request->title;
            $article->link = $request->link;
            $article->slug = $request->slug;
            $article->description = $request->description;

            if ($article->save()) {
                return response()->json(['status' => 'success', 'message' => 'Article Updated Successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $article = Article::findOrFail($id);
            $article->title = $request->title;
            $article->link = $request->link;
            $article->slug = $request->slug;
            $article->description = $request->description;

            if ($article->delete()) {
                return response()->json(['status' => 'success', 'message' => 'Article Deleted Successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
