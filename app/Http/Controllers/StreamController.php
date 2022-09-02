<?php

namespace App\Http\Controllers;

use App\Models\Stream;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StreamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
       $stream_collection=Stream::all();
        
        return view('academic-admin.stream-management.add-stream', compact('stream_collection'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation=$request->validate([
            'stream_name'=>'required',
            'stream_type'=>'required',
            'final_stream'=>'required'
        ]);

        $stream_name=$request->input('stream_name');
        $stream_type=$request->input('stream_type');
        $final_stream=$request->input('final_stream');
      
        Stream::create([
            'stream_name' =>  $stream_name,
            'stream_type' =>  $stream_type,
            'final_stream'  =>  $final_stream, 
        ]);

        flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have successfully added '.$stream_name, 'Add Stream');

        return Redirect::back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stream  $stream
     * @return \Illuminate\Http\Response
     */
    public function show(Stream $stream)
    {
       // Stream::all();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stream  $stream
     * @return \Illuminate\Http\Response
     */
    public function edit(Stream $stream, $id)
    {

       
        $stream_id=decrypt($id);
    
        $stream=Stream::find($stream_id);

       
       
        return view('academic-admin.stream-management.edit', compact('stream'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stream  $stream
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stream $stream)
    {

        //validation
        $validation=$request->validate([
            'stream_name'=>'required',
            'stream_type'=>'required',
            'final_stream'=>'required',
        ]);
    
        
       
        $update=Stream::find($request->id)->update([
            "stream_name"=>$request->stream_name,
            "stream_type"=>$request->stream_type,
            "final_stream"=>$request->final_stream,
        ]);

        if($update){
            flash()->overlay(' <i class="fas fa-check-circle text-success"></i> Success. You have successfully updated '.$request->stream_name, 'Add Stream');

            return redirect('/academic-admin/stream'); 
        }else{
            flash()->overlay(' <i class="fa fa-exclamation-triangle" aria-hidden="true text-danger"></i> Error. The was an error updating. Please try again. '.$request->stream_name, 'Edit Stream');

            return Redirect::back();  
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stream  $stream
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stream $stream)
    {
      
         //check if exists in grades

      //  dd($stream);
    }
}
