<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Article;
use App\category;
use App\Comment;
use App\Http\Resources\Article as ArticleResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;
use App\Http\Requests;
// use App\Http\Controllers\Controller;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index()
    {
         $user_id = Article::all('user_id');
     
         $user = User::where('id', [$user_id])->first();
         $articles = Article::orderBy('created_at', 'desc')->with('user')->with('category')->paginate(10);
    
    
    // ArticleResource::collection


        return response()->json( $articles);
        
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /* $this->require($request, [
            'category' => 'required',
            'title' => 'required',
            'body'=> 'required' ,
            'cover_image' => 'image|nullable|max:1999'

        ]);*/

        if($request->hasFile('cover_image')){
            $file = $request->file('cover_image');
            // get File Name With Extenstion
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        // Get just file name
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get Just ext
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        // file name to store 
        $fileNameToStore= $filename.'_'.time().'.'.$extension;
        // uplload Image
        // $path = Storage::disk('local')->put( 'avatars', $file_get_contents($request->file('cover_image')->getRealPath()));

        //  $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        //  $path = Storage::disk('local')->put($fileNameToStore,  File::get($file));
        $destinationPath = public_path('/articles/');
            $file->move($destinationPath, $fileNameToStore);
            
        }
         else
          {
            $fileNameToStore = 'noimage.jpg';
          }




        // 
        $article  = new Article();
        $article->title = $request->input('title');
        $article->body = $request->input('body');
        $article->category_id = $request->input('category');
        $article->cover_image = $fileNameToStore;
        $article->user_id = auth()->user()->id;
        $article->save();

        return response()->json([
            "articles" => $article
        ]);
    // $post->user_id = auth()->user()->id;
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

 public function show($id) 
    {
        $article = Article::with('Category')->where('id', '=', $id)->first();
        $comment = Comment::where('article_id', '=', $id)->get();
        // $category = Category::where('article_id', '=' , $id)->first();
        return response()->json([ 'article' => $article, 'comment' => $comment]);
          
    }
  
    public function update(request $request, $id)
    {
            if($request->hasFile('cover_image')){
            $file = $request->file('cover_image');
            // get File Name With Extenstion
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        // Get just file name
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get Just ext
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        // file name to store 
        $fileNameToStore= $filename.'_'.time().'.'.$extension;
        // uplload Image
        // $path = Storage::disk('local')->put( 'avatars', $file_get_contents($request->file('cover_image')->getRealPath()));

        //  $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        //  $path = Storage::disk('local')->put($fileNameToStore,  File::get($file));
        $destinationPath = public_path('/articles/');
            $file->move($destinationPath, $fileNameToStore);
            
        }
         else
          {
            $fileNameToStore = 'noimage.jpg';
          }

         
           $article = Article::find($id);
           $article->title = $request->input('title');
           $article->body = $request->input('body');
           $article->category_id = $request->input('category');
           $article->cover_image = $fileNameToStore;
            $article->user_id = auth()->user()->id;
           $article->save();
  
        return response()->json([
            "articles" => $article
        ]);

    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

public function destroy($id)
    {  
        $article = Article::find($id);
          $article->delete();
        return response()->json([
            "articles" => $article
        ]);
           
       
        
    }
    public function isLikedByMe($id)
{
    $post = Post::findOrFail($id)->first();
    if (Like::whereUserId(Auth::id())->wherePostId($post->id)->exists()){
        return 'true';
    }
    return 'false';
}

public function like(Post $post)
{
    $existing_like = Like::withTrashed()->wherePostId($post->id)->whereUserId(Auth::id())->first();

    if (is_null($existing_like)) {
        Like::create([
            'post_id' => $post->id,
            'user_id' => Auth::id()
        ]);
    } else {
        if (is_null($existing_like->deleted_at)) {
            $existing_like->delete();
        } else {
            $existing_like->restore();
        }
    }
}
}
