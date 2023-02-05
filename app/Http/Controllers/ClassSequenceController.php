<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use App\Models\ClassSequence;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ClassSequenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes=Grade::all();
      
        $class_data=DB::table('class_sequences')
->join('grades as destination_grade', 'destination_grade.id', '=', 'class_sequences.destination')
->join('grades as origin_grade', 'origin_grade.id', '=', 'class_sequences.origin')
->join('streams as destination_stream', 'destination_stream.id', '=', 'destination_grade.stream_id')
->join('streams as  origin_stream', 'origin_stream.id', '=', 'origin_grade.stream_id')

->select('class_sequences.id as id', 'destination_grade.id as destination_id', 'destination_grade.grade_name as destination_name', 'origin_grade.id as origin_id', 'origin_grade.grade_name as origin_name', 'origin_stream.id as origin_stream', 'destination_stream.id as destination_stream', 'destination_grade.section_id as destination_section_id', 'origin_grade.section_id as origin_section_id')
 ->get();


       

      

        return view('academic-admin.sequence-management.index', compact('classes', 'class_data'));
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
        $destination=$request->destination;
        $origin=$request->from;
    
        //validation
        $validation=$request->validate([
            'from'=>'required',
            'destination'=>'required'
        ]);

        $sequenceExists=ClassSequence::where('origin', $origin)->where('destination', $destination)->exists();

        // //Check Streams
        // $from_stream=DB::table('streams')
        // ->join('grades','streams.id','=','grades.stream_id')
        // ->whereBetween('grades.id', [$origin, $destination])
        // ->select('streams.id', 'streams.stream_name')
        // ->get();

        $from_stream=Grade::find($origin);
        $to_stream=Grade::find($destination);

        if ($from_stream->stream_id==$to_stream->stream_id) {
            flash()->overlay(' <i class="fas fa-exclamation-circle  text-danger  "></i> Error. You cannot map classes in the same stream', 'Class Mapping');
            return Redirect::back();
        }


        if ($origin==$destination) {
            flash()->overlay(' <i class="fas fa-exclamation-circle  text-danger  "></i> Error. You cannot map the same class to the same class', 'Class Mapping');
            return Redirect::back();
        }



        if ($sequenceExists) {
            flash()->overlay(' <i class="fas fa-exclamation-circle  text-danger  "></i> Error. that sequence already exists in the system', 'Class Mapping');
            return Redirect::back();
        }
 
        $classSequence=ClassSequence::create([
                'origin'=>$request->from,
                'destination'=>$request->destination
            ]);
        // $classSequence = $classSequence->fresh();

        flash()->overlay('<i class="fas fa-check-circle text-success"></i> Congratulations. Class has been successfully mapped', 'Map Class');
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassSequence  $classSequence
     * @return \Illuminate\Http\Response
     */
    public function show(ClassSequence $classSequence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassSequence  $classSequence
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassSequence $classSequence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassSequence  $classSequence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassSequence $classSequence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassSequence  $classSequence
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassSequence $classSequence, $id)
    {
      

        $delete=ClassSequence::find($id)->delete();



        if($delete){
            return response ()->json([
                'status'=>"200",
                'message'=>'Sequence successfully deleted',
            ]);
    }else{

        return response ()->json([
            'status'=>"400",
           
        ]);

    }
    

  
}

       


    


