<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleCommentController extends Controller
{
   
    public function index($id)
    {
       $comment = Comment::all();
       return response()->json($comment);
    }

    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
      */

    // public function store(Request $request, $article_id)
    // the above will be used for fetching article id
    // public function store(Request $request)
    public function store(Request $request, $articleId)
    {
        // $this->validate($request, array (
        //     'article_id' => 'required',
        //     'comment'  => 'required|min:5|max:2000',
        
        // ));
        // $article = Article::find($article_id); 
        $comment = new comment();
        // $comment->associate($article);
        $comment->article_id = $articleId;
        $comment->comment = $request->input('comment');
        $comment->save();

        return response()->json($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function displayComments($articleId)
        
    {     
           
          $article = Article::where('id', '=', $articleId)->first();
      //  $comment = Comment::where('article_id', '=', $article)->first();
        $comments = Comment::where('article_id', '=', $articleId)->get();
       return response()->json([ 'article' => $article, 'comment' => $comments]);
    
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $article , $id)
    {
        $comment = Comment::find($id);
        // $comment->associate($article);
        $comment->article_id = $article;
        $comment->comment = $request->input('comment');
        $comment->save();

        return response()->json($comment);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
