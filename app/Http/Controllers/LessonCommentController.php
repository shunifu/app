<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\LessonComment;
use Illuminate\Support\Facades\Storage;

class LessonCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
      
        if($request->hasFile('file')){
            // $request->validate([
            //     'file' => 'required|mimes:pdf,xlx,csv,jpg,mp4,mp3,wma|max:2048',
            // ]);
      
            $filename = time().'.'.$request->file->extension();  
            
           $file=$request->file->storeAs('comment-files',$filename,'public');
       

        
            $comment=LessonComment::create([

                'lesson_id'=>$request->lesson_id,
                'user_id'=>$request->user_id,
                'comment'=>$request->comment,
                'path'=>$file,
             
 
            ]);
        
        }else{
         
            $comment=LessonComment::create([

                'lesson_id'=>$request->lesson_id,
                'user_id'=>$request->user_id,
                'comment'=>$request->comment,
                
             
 
            ]);
        }
        

        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LessonComment  $lessonComment
     * @return \Illuminate\Http\Response
     */
    public function show(LessonComment $lessonComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LessonComment  $lessonComment
     * @return \Illuminate\Http\Response
     */
    public function edit(LessonComment $lessonComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LessonComment  $lessonComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LessonComment $lessonComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LessonComment  $lessonComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(LessonComment $lessonComment)
    {
        //
    }
}
