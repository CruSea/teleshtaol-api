<?php

namespace App\Http\Controllers;
use App\Category;
use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return response()->json(['category' => $category]);
    }
    
    public function store(Request $request){
        $category = new Category();
        $category->name = $request->input('name');
        $category->save();

        return response()->json($category);

    }

    // public function createCategory(Request $request){

    //     $catagory = new Category();
    //     $catagory->name = $request->input('name');
    //     // $catagory->description = $request->input('description');
    //     $catagory->save();

    //     return response()->json($catagory);

    // }
    public function show($id)
    {

        $category = Category::findOrFail($id);
        // $comments = Comment::all();
        $article = Article::where('category_id', '=', $id)->get();
       
        return response()-> json([ 'category' => $category , 'article' => $article]);

    }
    public function destroy($id){
        $category = Category::find($id);
        $category->delete();
            return response()->json($category);
           
       
        
    }
}