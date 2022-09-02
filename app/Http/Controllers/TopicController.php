<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Stream;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TopicController extends Controller
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
        $subjects=Subject::all();
        $streams=Stream::all();
        
        $topics = DB::table('topics')
        ->join('streams', 'topics.stream_id', '=', 'streams.id')
        ->join('subjects', 'subjects.id', '=', 'topics.subject_id')
        ->select('topics.id as topic_id', 'subject_name', 'stream_name' ,'topic_name')
        ->orderBy('streams.id', 'asc')
        ->get();

        return view('online-learning.add-topic', compact('subjects','streams','topics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasRole('teacher')){
        $validation=$request->validate([
            'topic_name'=>'required', 
        
        ]);

        if($request->stream_id=='0' OR $request->subject_id=='0'){

		flash()->overlay('Error. Please check if you have selected the proper stream or subject', 'Add Topic');

        return back();
        }else{

            $add_topic=Topic::create([
                'stream_id' => $request->stream_id,
                'subject_id' => $request->subject_id,
                'topic_name' => $request->topic_name,
            ]);

           
                flash()->overlay('Success. You have successfully added topic'.' '.$request->topic_name, 'Add Topic');
                return Redirect::back();
            
        }
    }else{
        return view('errors.unauthorized');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        //
    }

    public function get_topics($id){
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic, $id){
        if(Auth::user()->hasRole('teacher')){
            DB::table('topics')->where('id', $id)->delete();
            flash()->overlay('Success. You have successfully deleted the topic', 'Delete Topic');
                return Redirect::back();

        }else{
            return view('errors.unauthorized');
        }
    }
}
