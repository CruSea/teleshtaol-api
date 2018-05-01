<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TestimonyComment;
use App\Testimony;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestimonyCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment = TestimonyComment::all();

        return response()->json($comment);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

   
    public function store(Request $request, $testimonyId)
    {
       $comment = new TestimonyComment();
       $comment->testimony_id = $testimonyId;
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
    public function displayComments($testimonyId)
    {     
           
        $testimony = Testimony::where('id', '=', $testimonyId)->first();
//    $comments = TestimonyComment::all();
     $comments = TestimonyComment::where('testimony_id', '=', $testimonyId)->get();
     return response()->json([ 'testimony' => $testimony, 'comment' => $comments]);
  
  }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $testimony, $id)
    {
        $comment = TestimonyComment::find($id);
        // $comment->associate($article);
        $comment->testimony_id = $testimony;
        $comment->comment = $request->input('comment');
        $comment->save();
        $testimony = Testimony::where('id', '=', $testimony)->first();
        return response()->json([ 'testimony' => $testimony, 'comment' => $comment]);
       
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
