<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Grade;
use App\Models\PassRate;
use App\Models\PaymentRestriction;
use App\Models\ReportTemplate;
use App\Models\ReportVariable;
use App\Models\School;
use App\Models\Section;
use App\Models\Stream;
use App\Models\StudentClass;
use App\Models\Term;
use App\Models\TimeRestriction;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Dd;

class CBEReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function index()
    {
             //Terms

             $terms=DB::table('terms')
             ->join('academic_sessions', 'academic_sessions.id', '=', 'terms.academic_session')
             ->select('terms.id as term_id','terms.term_name', 'academic_sessions.academic_session')
             ->where('academic_sessions.active',1)
             ->get();
     
     
             //Scope to current session ....think about it.
     
             //Streams
             $streams=Stream::all();
     
             //Classes
             $classes=Grade::all();
     
             //Section
             $sections=Section::all();
     
            
     
             $templates=ReportTemplate::all();
     
             $variables=ReportVariable::all();
     
             if (is_null($templates) ) {
     
                 flash()->overlay('<i class="fas fa-exclamation-circle text-danger"></i> Error. Please add report templates. To do so, please go to settings , then Report Settings and click Report Templates');
                 return redirect('/report/templates');
     
               
             }
     
             if (is_null($variables) ) {
     
                 flash()->overlay('<i class="fas fa-exclamation-circle text-danger"></i> Error. Please add report variables. To do so, please go to settings , then Report Settings and click Report Variables');
                 return redirect('/report/variables');
     
               
             }
             
             return view('academic-admin.reports-management.cbe-report.index', compact('terms','streams','classes','sections','templates','variables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

     // dd($request->all());

     $stream_id=$request->stream;
     $term_id=$request->term;
     $scope=$request->p_class;


     if($scope=="stream_based"){
        $students=DB::table('grades_students')
        ->join('grades', 'grades_students.grade_id', '=', 'grades.id')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'grades_students.academic_session')
        ->join('users', 'users.id', '=', 'grades_students.student_id')
        ->select('users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id')
        ->where('academic_sessions.active',1)
        ->where('grades.stream_id',$stream_id)
        ->where('grades_students.active',1)
        ->get();
     }


     if($scope=="class_based"){
        $students=DB::table('grades_students')
        ->join('grades', 'grades_students.grade_id', '=', 'grades.id')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'grades_students.academic_session')
        ->join('users', 'users.id', '=', 'grades_students.student_id')
        ->select('users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id')
        ->where('academic_sessions.active',1)
        ->where('grades.stream_id',$stream_id)
        ->where('grades_students.active',1)
        ->get();
     }



        


        
     return view('academic-admin.reports-management.cbe-report.list', compact('students', 'term_id'));

         

        
    }


    public function generate($term_id, $encrypted_student_id){

    //  dd('sd');


 $student_id=Crypt::decrypt($encrypted_student_id );

        $pdf = App::make('dompdf.wrapper');

        //Get the strands

        // $student_data=DB::table('strands')
        // ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
        // ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
        // ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
        // ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
        // ->join('users', 'users.id', '=', 'cbe_marks.student_id')
        // ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
        // ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
        // // ->where('academic_sessions.active',1)
        // ->where('cbe_marks.student_id',$id)
        // ->where('cbe_marks.term_id',3)
        // ->groupBy('subjects.id')
        // ->get();

        
       

//religious, social, personal skills
        $religious_education=DB::table('student_loads')
        ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
        ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
        ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
        ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
        ->where('student_loads.student_id',$student_id)
        ->where('student_loads.active',1)
        ->whereIn('subjects.id',[26])
        ->get();


        $social_studies=DB::table('student_loads')
        ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
        ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
        ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
        ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
        ->where('student_loads.student_id',$student_id)
        ->where('student_loads.active',1)
        ->whereIn('subjects.id',[36])
        ->get();


        $hpe=DB::table('student_loads')
        ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
        ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
        ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
        ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
        ->where('student_loads.student_id',$student_id)
        ->where('student_loads.active',1)
        ->whereIn('subjects.id',[38])
        ->get();

     


        $siswati=DB::table('student_loads')
        ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
        ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
        ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
        ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
        ->where('student_loads.student_id',$student_id)
        ->where('student_loads.active',1)
        ->whereIn('subjects.id',[10])
        ->get();

        $english=DB::table('student_loads')
        ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
        ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
        ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
        ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
        ->where('student_loads.student_id',$student_id)
        ->where('student_loads.active',1)
        ->whereIn('subjects.id',[2])
        ->get();

        $maths=DB::table('student_loads')
        ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
        ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
        ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
        ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
        ->where('student_loads.student_id',$student_id)
        ->where('student_loads.active',1)
        ->whereIn('subjects.id',[6])
        ->get();

        $ict=DB::table('student_loads')
        ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
        ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
        ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
        ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
        ->where('student_loads.student_id',$student_id)
        ->where('student_loads.active',1)
        ->whereIn('subjects.id',[39])
        ->get();

        $agric=DB::table('student_loads')
        ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
        ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
        ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
        ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
        ->where('student_loads.student_id',$student_id)
        ->where('student_loads.active',1)
        ->whereIn('subjects.id',[23])
        ->get();

        $science=DB::table('student_loads')
        ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
        ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
        ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
        ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
        ->where('student_loads.student_id',$student_id)
        ->where('student_loads.active',1)
        ->whereIn('subjects.id',[14])
        ->get();


        $expressive_art=DB::table('student_loads')
        ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
        ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
        ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
        ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
        ->where('student_loads.student_id',$student_id)
        ->where('student_loads.active',1)
        ->where('subjects.id',[37])
        ->get();


        $practical_arts=DB::table('student_loads')
        ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
        ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
        ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
        ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
        ->where('student_loads.student_id',$student_id)
        ->where('student_loads.active',1)
        ->whereIn('subjects.id',[42])
        ->get();
        

        $personal_skills=DB::table('student_loads')
        ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
        ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
        ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
        ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
        ->where('student_loads.student_id',$student_id)
        ->where('student_loads.active',1)
        ->whereIn('subjects.id',[44])
        ->get();

        $consumer_science=DB::table('student_loads')
        ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
        ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
        ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
        ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
        ->where('student_loads.student_id',$student_id)
        ->where('student_loads.active',1)
        ->whereIn('subjects.id',[16])
        ->get();

        $general_studies=DB::table('student_loads')
        ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
        ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
        ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
        ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
        ->where('student_loads.student_id',$student_id)
        ->where('student_loads.active',1)
        ->whereIn('subjects.id',[43])
        ->get();



        $french=DB::table('student_loads')
        ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
        ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
        ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
        ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
        ->where('student_loads.student_id',$student_id)
        ->where('student_loads.active',1)
        ->whereIn('subjects.id',[46])
        ->get();





$getStream=StudentClass::where('student_id',$student_id )->first();
$stream=Grade::where('id', $getStream->grade_id)->first();
$stream_is=$stream->stream_id;

if($stream_is==1 OR $stream_is==2){
    $student_data="0";


    $student_details=DB::table('users')
    ->join('grades_students', 'grades_students.student_id', '=', 'users.id')
    ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
    ->join('streams', 'streams.id', '=', 'grades.stream_id')
    ->select('users.id as student_id','users.name','users.lastname','users.middlename','grades.id as grade_id','grades.grade_name', 'streams.stream_name as stream_name', 'users.profile_photo_path as student_image', 'users.national_id as pin', 'streams.id as stream_id'  )
    ->where('users.id',$student_id)
    
    ->get();
}else{
    $student_data="0";


    $student_details=DB::table('users')
    ->join('grades_students', 'grades_students.student_id', '=', 'users.id')
    ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
    ->join('streams', 'streams.id', '=', 'grades.stream_id')
    ->join('term_averages', 'term_averages.student_id', '=', 'users.id')
    ->select('users.id as student_id','users.name','users.lastname','users.middlename','grades.id as grade_id','grades.grade_name', 'streams.stream_name as stream_name', 'users.profile_photo_path as student_image', 'users.national_id as pin', 'streams.id as stream_id', 'term_averages.final_term_status' )
    ->where('users.id',$student_id)
    ->where('term_id',$term_id)
    ->get();
}


     

        


        $stream=$student_details['0']->stream_id;
        $grade_id=$student_details['0']->grade_id;

        $student_grade=Grade::where('id',$grade_id )->first();
        $student_section=$student_grade->section_id;

        $academic_sessions=DB::table('terms')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'terms.academic_session')
        ->select('terms.id as term_id','academic_sessions.academic_session as academic_year', 'terms.term_name')
        ->where('terms.id',$term_id)
        ->get();

    $school=School::all();
    $comments = DB::table('report_comments')->where('section_id',$student_section)->where('user_type', 1)->get();
    $class_teacher_comments = DB::table('report_comments')->where('section_id',$student_section)->where('user_type', 2)->get();   
    $headteacher_comments = DB::table('report_comments')->where('section_id',$student_section)->where('user_type', 3)->get();   

    $terms=Term::where('id',$term_id)->first();
    $term_opening_date=$terms->start_date;
    $term_closing_date=$terms->end_date;
    $next_term_date=$terms->next_term_date;
    $final_term_status=$terms->final_term_status;

    $pass_rates=PassRate::where('section_id', $student_section)->first();
    $pass_mark=$pass_rates->passing_rate;




    // if($stream==2){
    //     return view('academic-admin.reports-management.cbe-report.grade2', compact('science','back_subjects','student_details','school','academic_sessions', 'comments', 'ict','maths', 'hpe', 'english','siswati',  'headteacher_comments', 'class_teacher_comments'));
    // }elseif($stream==3){
    //     return view('academic-admin.reports-management.cbe-report.view', compact('science','back_subjects','student_details','school','academic_sessions', 'comments', 'ict','maths', 'hpe', 'english','siswati',  'headteacher_comments', 'class_teacher_comments'));
    // }


    if ($stream==1 OR $stream==2) {
        $size="size:  landscape A4;";
      
        $gutter="no-gutters";
      
        $row='<div class="row" style="flex-direction: row-reverse;" >';
       
    }else{
        $size="size:  landscape A4;";
        $gutter=" ";
        $row='<div class="row">';
    }

    

    if($stream==1 or $stream==2){
        return view('academic-admin.reports-management.cbe-report.view_foundation_phase', compact('next_term_date','final_term_status','term_opening_date','term_closing_date','science','student_details','school','academic_sessions', 'comments', 'ict','maths', 'hpe', 'english','siswati',  'headteacher_comments', 'class_teacher_comments', 'term_id','agric','expressive_art', 'consumer_science','personal_skills', 'practical_arts','general_studies', 'stream', 'size', 'gutter', 'row', 'pass_mark', 'french','religious_education'));
    }

    if($stream==3){
        return view('academic-admin.reports-management.cbe-report.view_grade3', compact('next_term_date','final_term_status','term_opening_date','term_closing_date','science','student_details','school','academic_sessions', 'comments', 'ict','maths', 'hpe', 'english','siswati',  'headteacher_comments', 'class_teacher_comments', 'term_id','agric','expressive_art', 'consumer_science','personal_skills', 'practical_arts','general_studies', 'stream', 'size', 'gutter', 'row', 'pass_mark', 'french','religious_education'));
    }

    if($stream==4){
        return view('academic-admin.reports-management.cbe-report.view_grade4', compact('next_term_date','final_term_status','term_opening_date','term_closing_date','science','student_details','school','academic_sessions', 'comments', 'ict','maths', 'hpe', 'english','siswati',  'headteacher_comments', 'class_teacher_comments', 'term_id','agric','expressive_art', 'consumer_science','personal_skills', 'practical_arts','general_studies', 'stream', 'size', 'gutter', 'row', 'pass_mark', 'french','religious_education'));
    }
    if($stream==5){
        return view('academic-admin.reports-management.cbe-report.view_grade5', compact('next_term_date','final_term_status','term_opening_date','term_closing_date','science','student_details','school','academic_sessions', 'comments', 'ict','maths', 'hpe', 'english','siswati',  'headteacher_comments', 'class_teacher_comments', 'term_id','agric','expressive_art', 'consumer_science','personal_skills', 'practical_arts','general_studies', 'stream', 'size', 'gutter', 'row', 'pass_mark', 'french','religious_education', 'agric', 'social_studies'));
    }



   

  

    }


    public function generate_parent(Request $request){

       // dd($request->all());
  
      //   "student_id" => "4632"
      //   "term" => "3"
      //   "report_type" => "cbe"
      // ]
  
  
     $student_id=$request->student_id;
     $term_id=$request->term;
     $report_type=$request->report_type;


    // dd($request->all());

     //Check Time Restriction
        

$time_restriction=TimeRestriction::where('term_id', $term_id )->first();

$from_date=$time_restriction->from;
$to_date=$time_restriction->to;

$startDate = Carbon::parse($from_date);
$endDate = Carbon::parse($to_date);
$dateToCheck =Carbon::now();

if ($dateToCheck->between($startDate, $endDate)) {
   

  $payments=PaymentRestriction::where('parent_id', Auth::user()->id)->exists();
 

  if($payments){



 

flash()->overlay('<i class="fas fa-check-circle text-error"></i> Error. Cannot view report.', 'Outstanding Fees');
     
return redirect()->back();
  }
      
  
  
  //  $student_id=Crypt::decrypt($encrypted_student_id );
  
          $pdf = App::make('dompdf.wrapper');
  
          //Get the strands
  
          // $student_data=DB::table('strands')
          // ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
          // ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
          // ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
          // ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
          // ->join('users', 'users.id', '=', 'cbe_marks.student_id')
          // ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
          // ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
          // // ->where('academic_sessions.active',1)
          // ->where('cbe_marks.student_id',$id)
          // ->where('cbe_marks.term_id',3)
          // ->groupBy('subjects.id')
          // ->get();
  
          
         
  
  //religious, social, personal skills
          $religious_education=DB::table('student_loads')
          ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
          ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
          ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
          ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
          ->where('student_loads.student_id',$student_id)
          ->where('student_loads.active',1)
          ->whereIn('subjects.id',[26])
          ->get();
  
  
          $social_studies=DB::table('student_loads')
          ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
          ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
          ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
          ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
          ->where('student_loads.student_id',$student_id)
          ->where('student_loads.active',1)
          ->whereIn('subjects.id',[36])
          ->get();
  
  
          $hpe=DB::table('student_loads')
          ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
          ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
          ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
          ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
          ->where('student_loads.student_id',$student_id)
          ->where('student_loads.active',1)
          ->whereIn('subjects.id',[38])
          ->get();
  
       
  
  
          $siswati=DB::table('student_loads')
          ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
          ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
          ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
          ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
          ->where('student_loads.student_id',$student_id)
          ->where('student_loads.active',1)
          ->whereIn('subjects.id',[10])
          ->get();
  
          $english=DB::table('student_loads')
          ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
          ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
          ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
          ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
          ->where('student_loads.student_id',$student_id)
          ->where('student_loads.active',1)
          ->whereIn('subjects.id',[2])
          ->get();
  
          $maths=DB::table('student_loads')
          ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
          ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
          ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
          ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
          ->where('student_loads.student_id',$student_id)
          ->where('student_loads.active',1)
          ->whereIn('subjects.id',[6])
          ->get();
  
          $ict=DB::table('student_loads')
          ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
          ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
          ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
          ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
          ->where('student_loads.student_id',$student_id)
          ->where('student_loads.active',1)
          ->whereIn('subjects.id',[39])
          ->get();
  
          $agric=DB::table('student_loads')
          ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
          ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
          ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
          ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
          ->where('student_loads.student_id',$student_id)
          ->where('student_loads.active',1)
          ->whereIn('subjects.id',[23])
          ->get();
  
          $science=DB::table('student_loads')
          ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
          ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
          ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
          ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
          ->where('student_loads.student_id',$student_id)
          ->where('student_loads.active',1)
          ->whereIn('subjects.id',[14])
          ->get();
  
  
          $expressive_art=DB::table('student_loads')
          ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
          ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
          ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
          ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
          ->where('student_loads.student_id',$student_id)
          ->where('student_loads.active',1)
          ->where('subjects.id',[37])
          ->get();
  
  
          $practical_arts=DB::table('student_loads')
          ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
          ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
          ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
          ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
          ->where('student_loads.student_id',$student_id)
          ->where('student_loads.active',1)
          ->whereIn('subjects.id',[42])
          ->get();
          
  
          $personal_skills=DB::table('student_loads')
          ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
          ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
          ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
          ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
          ->where('student_loads.student_id',$student_id)
          ->where('student_loads.active',1)
          ->whereIn('subjects.id',[44])
          ->get();
  
          $consumer_science=DB::table('student_loads')
          ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
          ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
          ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
          ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
          ->where('student_loads.student_id',$student_id)
          ->where('student_loads.active',1)
          ->whereIn('subjects.id',[16])
          ->get();
  
          $general_studies=DB::table('student_loads')
          ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
          ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
          ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
          ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
          ->where('student_loads.student_id',$student_id)
          ->where('student_loads.active',1)
          ->whereIn('subjects.id',[43])
          ->get();
  
  
  
          $french=DB::table('student_loads')
          ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
          ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
          ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
          ->select('teaching_loads.id as teaching_load_id','subjects.subject_name','subjects.id as subject_id', 'subjects.id as subject_id','subjects.subject_name', 'student_loads.student_id','grades.stream_id as stream_id')
          ->where('student_loads.student_id',$student_id)
          ->where('student_loads.active',1)
          ->whereIn('subjects.id',[46])
          ->get();
  
  
  
  
  
  $getStream=StudentClass::where('student_id',$student_id )->first();
  $stream=Grade::where('id', $getStream->grade_id)->first();
  $stream_is=$stream->stream_id;
  
  if($stream_is==1 OR $stream_is==2){
      $student_data="0";
  
  
      $student_details=DB::table('users')
      ->join('grades_students', 'grades_students.student_id', '=', 'users.id')
      ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
      ->join('streams', 'streams.id', '=', 'grades.stream_id')
      ->select('users.id as student_id','users.name','users.lastname','users.middlename','grades.id as grade_id','grades.grade_name', 'streams.stream_name as stream_name', 'users.profile_photo_path as student_image', 'users.national_id as pin', 'streams.id as stream_id'  )
      ->where('users.id',$student_id)
      
      ->get();
  }else{
      $student_data="0";
  
  
      $student_details=DB::table('users')
      ->join('grades_students', 'grades_students.student_id', '=', 'users.id')
      ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
      ->join('streams', 'streams.id', '=', 'grades.stream_id')
      ->join('term_averages', 'term_averages.student_id', '=', 'users.id')
      ->select('users.id as student_id','users.name','users.lastname','users.middlename','grades.id as grade_id','grades.grade_name', 'streams.stream_name as stream_name', 'users.profile_photo_path as student_image', 'users.national_id as pin', 'streams.id as stream_id', 'term_averages.final_term_status' )
      ->where('users.id',$student_id)
      ->where('term_id',$term_id)
      ->get();
  }
  
  
       
  
          
  
  
          $stream=$student_details['0']->stream_id;
          $grade_id=$student_details['0']->grade_id;
  
          $student_grade=Grade::where('id',$grade_id )->first();
          $student_section=$student_grade->section_id;
  
          $academic_sessions=DB::table('terms')
          ->join('academic_sessions', 'academic_sessions.id', '=', 'terms.academic_session')
          ->select('terms.id as term_id','academic_sessions.academic_session as academic_year', 'terms.term_name')
          ->where('terms.id',$term_id)
          ->get();
  
      $school=School::all();
      $comments = DB::table('report_comments')->where('section_id',$student_section)->where('user_type', 1)->get();
      $class_teacher_comments = DB::table('report_comments')->where('section_id',$student_section)->where('user_type', 2)->get();   
      $headteacher_comments = DB::table('report_comments')->where('section_id',$student_section)->where('user_type', 3)->get();   
  
      $terms=Term::where('id',$term_id)->first();
      $term_opening_date=$terms->start_date;
      $term_closing_date=$terms->end_date;
      $next_term_date=$terms->next_term_date;
      $final_term_status=$terms->final_term_status;
  
      $pass_rates=PassRate::where('section_id', $student_section)->first();
      $pass_mark=$pass_rates->passing_rate;
  
  
  
  
      // if($stream==2){
      //     return view('academic-admin.reports-management.cbe-report.grade2', compact('science','back_subjects','student_details','school','academic_sessions', 'comments', 'ict','maths', 'hpe', 'english','siswati',  'headteacher_comments', 'class_teacher_comments'));
      // }elseif($stream==3){
      //     return view('academic-admin.reports-management.cbe-report.view', compact('science','back_subjects','student_details','school','academic_sessions', 'comments', 'ict','maths', 'hpe', 'english','siswati',  'headteacher_comments', 'class_teacher_comments'));
      // }
  
  
      if ($stream==1 OR $stream==2) {
          $size="size:  landscape A4;";
        
          $gutter="no-gutters";
        
          $row='<div class="row" style="flex-direction: row-reverse;" >';
         
      }else{
          $size="size:  landscape A4;";
          $gutter=" ";
          $row='<div class="row">';
      }
  
      
  
      if($stream==1 or $stream==2){
          return view('academic-admin.reports-management.cbe-report.view_foundation_phase', compact('next_term_date','final_term_status','term_opening_date','term_closing_date','science','student_details','school','academic_sessions', 'comments', 'ict','maths', 'hpe', 'english','siswati',  'headteacher_comments', 'class_teacher_comments', 'term_id','agric','expressive_art', 'consumer_science','personal_skills', 'practical_arts','general_studies', 'stream', 'size', 'gutter', 'row', 'pass_mark', 'french','religious_education'));
      }
  
      if($stream==3){
          return view('academic-admin.reports-management.cbe-report.view_grade3', compact('next_term_date','final_term_status','term_opening_date','term_closing_date','science','student_details','school','academic_sessions', 'comments', 'ict','maths', 'hpe', 'english','siswati',  'headteacher_comments', 'class_teacher_comments', 'term_id','agric','expressive_art', 'consumer_science','personal_skills', 'practical_arts','general_studies', 'stream', 'size', 'gutter', 'row', 'pass_mark', 'french','religious_education'));
      }
  
      if($stream==4){
          return view('academic-admin.reports-management.cbe-report.view_grade4', compact('next_term_date','final_term_status','term_opening_date','term_closing_date','science','student_details','school','academic_sessions', 'comments', 'ict','maths', 'hpe', 'english','siswati',  'headteacher_comments', 'class_teacher_comments', 'term_id','agric','expressive_art', 'consumer_science','personal_skills', 'practical_arts','general_studies', 'stream', 'size', 'gutter', 'row', 'pass_mark', 'french','religious_education'));
      }
      if($stream==5){
          return view('academic-admin.reports-management.cbe-report.view_grade5', compact('next_term_date','final_term_status','term_opening_date','term_closing_date','science','student_details','school','academic_sessions', 'comments', 'ict','maths', 'hpe', 'english','siswati',  'headteacher_comments', 'class_teacher_comments', 'term_id','agric','expressive_art', 'consumer_science','personal_skills', 'practical_arts','general_studies', 'stream', 'size', 'gutter', 'row', 'pass_mark', 'french','religious_education', 'agric', 'social_studies'));
      }
  
  
  
     
    } else {
        echo "The date is not between the start and end dates.";
    }
    
    
  
      }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
