<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use App\Models\AcademicSession;
use App\Models\PassRate;
use App\Models\ProgressionStatus;
use App\Models\StudentSubjectAverage;
use App\Models\TermAverage;
use Illuminate\Support\Facades\DB;

class ProgressionStatusController extends Controller
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
          //Security
          $classes=Grade::all();
          $session=AcademicSession::where('active', 1)->get();

          $session = DB::table('terms')
          ->join('academic_sessions', 'academic_sessions.id', '=', 'terms.academic_session')
          ->where('academic_sessions.active', 1)
          ->where('terms.final_term', 1)
          ->select('terms.id as term_id', 'academic_sessions.academic_session', 'term_name')
          ->get();
          
          return view('progression-management.promotions-management.index', compact('classes', 'session'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all_students=2;
        $passed_students=1;
        $failed_students=0;
       
        //valdatation
          //validate data
          $validation=$request->validate([
            'student_type'=>'required',
            'grade_id'=>'required',
            'academic_session'=>'required',
    
        ]);


    //     dd($request->all());

    //    // $pass_rate=PassRate::all();

        $pass_rate = DB::table('pass_rates')                                 
        ->join('sections', 'sections.id', '=', 'pass_rates.section_id')
        ->join('grades', 'grades.section_id', '=', 'sections.id')
        ->where('grades.id', $request->grade_id)
        ->first();

       

     
        $passing_rate=$pass_rate->passing_rate;
        $number_of_subjects=$pass_rate->number_of_subjects;
        $term_id=$request->academic_session;
        
     

        if ($request->student_type==$all_students) {
          
            //return all students 
            //get data from student_subject_average_table
            //get data from term_average_table

        // $students=TermAverage::where('term_id', $request->academic_session)->where('student_class', $request->grade_id)->get();

        $students = DB::table('term_averages')                                 
        ->join('users', 'users.id', '=', 'term_averages.student_id')
        ->where('users.active','=',1)
        ->where('term_id', '=',$request->academic_session)
        ->where('student_class', $request->grade_id)
        ->orderByDesc('term_averages.student_average')
        ->get();

      


// class analytics//
        //get total students in class
        $total = DB::table('grades_students')                                  
                    ->join('academic_sessions', 'academic_sessions.id', '=', 'grades_students.academic_session')
                    ->where('grades_students.grade_id','=',$request->grade_id)
                    ->where('grades_students.active','=',1)
                    ->where('academic_sessions.active','=',1)
                    ->count();
                  // dd($total);
        //get total passed in class
        $total_passed = DB::table('term_averages')                                 
        ->join('academic_sessions', 'academic_sessions.id', '=', 'term_averages.session_id')
        ->join('terms', 'terms.id', '=', 'term_averages.term_id')
        ->where('term_averages.student_class','=',$request->grade_id)
        ->where('term_averages.term_id','=',$term_id)
        ->where('term_averages.student_average','>=',$passing_rate)
        ->where('term_averages.number_of_passed_subjects','>=',$number_of_subjects)
        ->where('term_averages.passing_subject_status','=',1)
        ->where('academic_sessions.active','=',1)
        ->count();

        $total_failed=$total-$total_passed;
        $class_pass_rate=($total_passed/$total)*100;
        $class_fail_rate=($total_failed/$total)*100;

       
       

        //get total failed in class
      
        $total_failed_passing_subject = DB::table('term_averages')                                 
        ->join('academic_sessions', 'academic_sessions.id', '=', 'term_averages.session_id')
        ->where('term_averages.student_class','=',$request->grade_id)
        ->where('term_averages.term_id','=',$request->academic_session)
        ->where('term_averages.passing_subject_status','=',0)
        ->where('academic_sessions.active','=',1)
        ->get();
        $total_failed_average = DB::table('term_averages')                                 
        ->join('academic_sessions', 'academic_sessions.id', '=', 'term_averages.session_id')
        ->where('term_averages.student_class','=',$request->grade_id)
        ->where('term_averages.term_id','=',$request->academic_session)
        ->where('term_averages.student_average','<',$pass_rate->passing_rate)
        ->where('academic_sessions.active','=',1)
        ->get();

        $total_number_of_subjects = DB::table('term_averages')                                 
        ->join('academic_sessions', 'academic_sessions.id', '=', 'term_averages.session_id')
        ->where('term_averages.student_class','=',$request->grade_id)
        ->where('term_averages.term_id','=',$request->academic_session)
        ->where('term_averages.number_of_passed_subjects','<',$pass_rate->number_of_subjects)
        ->where('academic_sessions.active','=',1)
        ->get();

        $grade=DB::table('grades')                                 
        ->join('streams', 'streams.id', '=', 'grades.stream_id')
        ->join('sections', 'sections.id', '=', 'grades.section_id')
        ->where('grades.id','=',$request->grade_id)
        ->select('grades.id as grade_id','grades.grade_name', 'streams.stream_name', 'sections.section_name')
        ->first();

    

        $class_average=DB::table('term_averages')                                 
        ->where('term_id', $term_id)
        ->where('student_class',$request->grade_id)
        ->AVG('student_average');

        
      


    $grade_id=$grade->grade_id;
      $grade_name=$grade->grade_name;
      $stream_name=$grade->stream_name;
      $section_name=$grade->section_name;

      $term_id=$request->academic_session;
        
// $total_failed=combine all 3 and get unique values
        //get pass rate in class


        //get fail rate in class
//end of class analytics


// stream analytics //
        //get total students in stream
        //get total passed in stream
        //get total failed in stream
        //get pass rate in stream
        //get fail rate in stream
//end of stream analytics //

//Get list of students


        


        return view('progression-management.promotions-management.view', compact('class_average','total', 'total_passed', 'students', 'total_failed', 'class_pass_rate', 'class_fail_rate', 'passing_rate', 'number_of_subjects','grade_name', 'section_name', 'stream_name' , 'grade_id', 'term_id'));
      
        }
        
        // if($passed_students){

        // }
        
        // if($failed_students){

        // }
    }

    public function processing(Request $request){

       //validations

       $validation=$request->validate([
        'term_average'=>'required|numeric|min:1|max:100',
        'number_of_subjects'=>'required|numeric',
        'subject_average'=>'required',
        'passing_subject_criteria'=>'required',
    ]);

   
    //Process
    
$student_data=TermAverage::where('student_class', $request->grade_id)->where('term_id',$request->term_id)->get();

dd($student_data);

foreach ($student_data as $student => $value) {

    if($value->student_average>=$request->passing_rate AND $value->number_of_passed_subjects>=$request->number_of_subjects AND $value->passing_subject_status==1 ){
        $update=TermAverage::where('student_key', $value->student_key)->update([
            'final_term_status'=>'1',
        ]);
      
    }else{
        $update=TermAverage::where('student_key', $value->student_key)->update([
            'final_term_status'=>'0',
        ]);
    }

//upsert
  //Upsert into sb
    //Foreach ($student_average as $term_average) {
        // $insert_into_term_avg=ProgressionStatus::upsert(collect($student)->map(function($student_data_item) use($student) {
        //     return [
        //     'student_id' => $student_data_item['0']->student_id,
        //     'term_id'  => $student_data_item['0']->term_id,
        //     'student_average' =>$student_data_item['0']->average_mark,
        //     'student_section' =>$student_data_item['0']->section_id,
        //     'student_stream'=>$student_data_item['0']->stream_id,
        //     'number_of_passed_subjects'=>$term_avg_item['0']->number_of_passed_subjects,
        //     'passing_subject_status'=>$term_avg_item['0']->passing_subject_status,
        //     'student_class'  =>$term_avg_item['0']->grade_id,
        //     'student_key' =>$term_avg_item['0']->student_id.'-'.$term_avg_item['0']->term_id,
        //     ];
        //       })->toArray(), ['student_key'], ['student_average','number_of_passed_subjects', 'passing_subject_status']);
  

        ProgressionStatus::upsert([
            ['student_id' => $value->student_id, 'academic_session_id' => 'San Diego', 'price' => 99],
            ['departure' => 'Chicago', 'destination' => 'New York', 'price' => 150]
        ], ['departure', 'destination']);
 
   
}


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProgressionStatus  $progressionStatus
     * @return \Illuminate\Http\Response
     */
    public function show(ProgressionStatus $progressionStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProgressionStatus  $progressionStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(ProgressionStatus $progressionStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProgressionStatus  $progressionStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgressionStatus $progressionStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProgressionStatus  $progressionStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgressionStatus $progressionStatus)
    {
        //
    }
}
