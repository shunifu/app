<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Strand;
use App\Models\Stream;
use App\Models\Subject;
use App\Models\TeachingLoad;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StrandController extends Controller
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


        if (!Schema::hasTable('strands')) {
            Schema::create('strands', function($table){
                  
                $table->id();
                $table->longText('strand');
                $table->integer('subject_id');
                $table->integer('stream_id');
                $table->integer('term_id');
                $table->timestamps();
           });
       }

        $terms=DB::table('academic_sessions')
        ->join('terms','terms.academic_session','=','academic_sessions.id')
        ->where('academic_sessions.active', 1 )//
        ->select('terms.term_name','terms.id as term_id')
        ->get();

        $subjects=Subject::all();
        $streams=Stream::all();

        return view('academic-admin.strands-management.index', compact('terms', 'streams', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->all());

     //  $objectives=json_encode($request->strands);


     $strands=$request->strands;

      foreach ($strands as $key => $strand) {
        # code...

        $strands = Strand::create([

			'stream_id' => $request->stream_id,
			'subject_id' => $request->subject_id,
			'term_id'=>$request->term_id,
			'strand' =>$strand,
			

		]);

     

    }

    flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have added strand', 'Add Strand');
    return redirect()->back();
    }




    public function view(){
     
        $terms=DB::table('academic_sessions')
        ->join('terms','terms.academic_session','=','academic_sessions.id')
        ->where('academic_sessions.active', 1 )//
        ->select('terms.term_name','terms.id as term_id')
        ->get();

        $subjects=Subject::all();
        $streams=Stream::all();

        return view('academic-admin.strands-management.view', compact('terms', 'streams', 'subjects'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Strand  $strand
     * @return \Illuminate\Http\Response
     */
    public function show(Strand $strand, Request $request)
    {
     //   dd($request->all());
        $subject_id=$request->subject_id;
        $term_id=$request->term_id;
        $stream_id=$request->stream_id;

        $term_name=Term::find($term_id)->term_name;
        $subject_name=Subject::find($subject_id)->subject_name;
        $stream_name=Stream::find($stream_id)->stream_name;
    

        $strands=Strand::where('subject_id', $subject_id)->where('term_id',$term_id)->where('stream_id',$stream_id)->get();

        return view('academic-admin.strands-management.show', compact('strands', 'term_name','subject_name', 'stream_name'));
    }




    public function fetch(Request $request){


        $teaching_load=TeachingLoad::find($request->teaching_load);
        $subject_id=$teaching_load->subject_id;
        $class_id=$teaching_load->class_id;

        $getStream=Grade::where('id',$class_id)->first();
        $stream_id=$getStream->stream_id;

      
        $strands=Strand::where('stream_id', $stream_id)->where('subject_id', $subject_id)->where('term_id', $request->term_id)->get();

        return response()->json([
            'status'=>200,
            'result'=>$strands,
    
          ]);


    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Strand  $strand
     * @return \Illuminate\Http\Response
     */
    public function edit(Strand $strand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Strand  $strand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Strand $strand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Strand  $strand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Strand $strand)
    {
        //
    }
}
