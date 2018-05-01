<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Testimony;
class TestimonyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimony =  Testimony::orderBy('created_at', 'desc')->paginate(10);
       
        return response()->json($testimony);
    }
    // approved tedstimonies
    public function showapproved()
    {
        $testimony =  Testimony::where('approval', 1)->orderBy('created_at', 'desc')->paginate(10);
       
        return response()->json($testimony);
    }
    // Disapprove testimonies 
    public function showDisapproved()
    {
        $testimony =  Testimony::where('approval', 0)->orderBy('created_at', 'desc')->paginate(10);
       
        return response()->json($testimony);
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

   


    public function store(Request $request)
    {
        $testimony  = new Testimony();
        // $post->user_id = auth()->user()->id;
        $testimony->title = $request->input('title');
        $testimony->body = $request->input('body');
        $testimony->save();

        return response()->json($testimony);
    }




    
    public function approveTestimony(Request $request, $id)
    {
       
        $testimony = Testimony::find($id);
        $testimony->approval = $request->input('approve');
        $testimony->save();
        
        return response()->json( [ "testimony" => $testimony]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $testimony = Testimony::find($id);

        return response()->json($testimony);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $testimony = Testimony::find($id);
        // var_dump($testimony->title);
        $testimony->title = $request->input('title');
        $testimony->body = $request->input('body');
        // $data =$request->all();
        // $testimony->fill($data);
        $testimony->save();

        return response()->json($testimony);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimony = Testimony::find($id);
        $testimony->delete();
            return response()->json($testimony);
    }
}
