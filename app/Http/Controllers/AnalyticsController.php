<?php

namespace App\Http\Controllers;
ini_set('max_execution_time', 34300);
use App\Models\Mark;
use App\Models\Term;
use App\Models\User;
use App\Models\Grade;
use App\Models\School;
use App\Models\Stream;
use App\Models\Section;
use App\Models\Subject;
use App\Models\PassRate;
use App\Models\Analytics;
use App\Models\Assessement;
use App\Models\StudentLoad;
use App\Models\TermAverage;
use Illuminate\Support\Arr;
use App\Models\TeachingLoad;

use Illuminate\Http\Request;
use App\Models\AcademicSession;
use App\Models\AssessementWeight;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentSubjectAverage;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Redirect;
use App\Models\AssessementProgressReport;
use App\Models\ReportTemplate;

use function GuzzleHttp\Psr7\build_query;
use Illuminate\Support\Facades\Validator;
use App\Traits\InsightsTrait;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AnalyticsController extends Controller
{
    use InsightsTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin=Auth::user()->hasRole('admin_teacher');
        $teacher=Auth::user()->hasRole('teacher');
        $student=Auth::user()->hasRole('student');
        $parent=Auth::user()->hasRole('parent');
        $assessements=Assessement::all();

        $activeSession=AcademicSession::where('active', 1)->first();
      
        $session_id=$activeSession->id;

        $grades=Grade::all();
        $sections=Section::all();
        $streams=Stream::all();
        $assessements_active=DB::table('assessements')
        ->join('terms','terms.id','=','assessements.term_id')
        ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
        ->where('terms.academic_session', $session_id)
        ->select('terms.id as term_id','terms.term_name',  'academic_sessions.id as session_id','academic_sessions.academic_session as session_name', 'assessements.id as assessement_id', 'assessements.assessement_name')
        ->get();

        $subjects=Subject::all();

        //Scope to current session

        if($admin){
        return view('analytics.admin', compact('grades', 'sections', 'streams', 'assessements','subjects', 'assessements_active'));
        }else if($teacher){
            return view('analytics.admin', compact('grades', 'sections', 'streams', 'assessements','subjects', 'assessements_active'));
        }else if($parent){
            return view('analytics.parent', compact('grades', 'sections', 'streams', 'assessements'));
        }else if($student){
            return view('analytics.student', compact('grades', 'sections', 'streams', 'assessements'));
        }
    }

    public function class(){

        $admin=Auth::user()->hasRole('admin_teacher');
        $teacher=Auth::user()->hasRole('teacher');
        $student=Auth::user()->hasRole('student');
        $parent=Auth::user()->hasRole('parent');
        $assessements=Assessement::all();

        $activeSession=AcademicSession::where('active', 1)->first();
      
        $session_id=$activeSession->id;

        $grades=Grade::all();
        $sections=Section::all();
        $streams=Stream::all();
        $assessements_active=DB::table('assessements')
        ->join('terms','terms.id','=','assessements.term_id')
        ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
        ->where('terms.academic_session', $session_id)
        ->select('terms.id as term_id','terms.term_name',  'academic_sessions.id as session_id','academic_sessions.academic_session as session_name', 'assessements.id as assessement_id', 'assessements.assessement_name')
        ->get();

        $subjects=Subject::all();

        //Scope to current session

        if($admin){
        return view('analytics.admin-class', compact('grades', 'sections', 'streams', 'assessements','subjects', 'assessements_active'));
        }else if($teacher){
            return view('analytics.admin-class', compact('grades', 'sections', 'streams', 'assessements','subjects', 'assessements_active'));
        }else if($parent){
            return view('analytics.parent', compact('grades', 'sections', 'streams', 'assessements'));
        }else if($student){
            return view('analytics.student', compact('grades', 'sections', 'streams', 'assessements'));
        }

    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // page that will display all schools insights form


        $templates=ReportTemplate::all();

        $sessions=AcademicSession::orderBy('academic_session', 'desc')->get();
     

        return view('analytics.insights.index', compact('sessions', 'templates'));
    }


    public function baseline_fetch(Request $request){
        $baseline=$request->baseline;


        if($request->baseline=="term"){

            //if the baseline==term then 
            //1. Show list of terms for the selected academic year

    $result=DB::table('terms')
    ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
    ->where('terms.academic_session', $request->session)
    ->select('terms.id as term_id','terms.term_name',  'academic_sessions.id as session_id','academic_sessions.academic_session as session_name')
    ->get();
    }
        
        if($request->baseline=="assessement"){

    $result=DB::table('assessements')
    ->join('terms','terms.id','=','assessements.term_id')
    ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
    ->where('terms.academic_session', $request->session)
    ->select('terms.id as term_id','terms.term_name',  'academic_sessions.id as session_id','academic_sessions.academic_session as session_name', 'assessements.id as assessement_id', 'assessements.assessement_name')
    ->get();

        }

        return response()->json([
            'status'=>200,
            'result'=>$result,
    
          ]);


    //    }
        
    }

    public function category_fetch(Request $request){
        
        if($request->category=="stream"){
            $category_result=Stream::all();
        }

        if($request->category=="section"){
            $category_result=Section::all();
        }

        if($request->category=="class"){
            $category_result=Grade::all();
        }

        if($request->category=="student"){   
            $category_result=User::where('active', 1)->get();
        }

        if($request->category=="teacher"){
            $category_result=User::where('active', 1)->where('role_id', 5)->orderBy('lastname')->orderBy('name')->get();
        }

        if($request->category=="school"){
            $category_result=" ";  

        }

        if($request->category=="subject"){
            $category_result=Subject::all();  

        }


        return response()->json([
            'status'=>200,
            'category_result'=>$category_result,
            'int'=>$request->category,
    
          ]);

    }



    public function generate(Request $request){

      //  dd($request->all());


    //validation //you have to redo validation
    $validation=$request->validate([
        'session'=>'required',
        'baseline'=>'required',
        'baseline_group'=>'required',
        'category'=>'required',
        // 'outcome'=>'required',

    ]);

    $category=$request->category;
    $outcome=$request->outcome;
    $session=$request->session;
    $baseline=$request->baseline;


  

    //Beginning of Assessement Based Reporting 

       if ($request->baseline=="assessement") {
           //Assessement Based


        //chosen assessement_id
        $assessement_id=$request->baseline_group;

    

        //Beginning of Assessement Stream-Based outcomes
        if ($request->category=="stream") {

         //   dd($request->all());
            

            //chosen stream
            $stream=$request->category_result;
            $group="stream";

            //1.Assessement Stream-Based outcome- Scoresheet
        
            if ($outcome=="scoresheet") {

                //this is an assessment based scoresheet
                
                $data= $this->assessementCalculations($stream, $session, $assessement_id, $outcome, $baseline,$group);

             

                return view('analytics.insights.assessement-insights.scoresheet', compact('data', 'assessement_id', 'stream'));
              
            }


            //2.Assessement Stream-Based outcome- Report Cards
            if ($outcome=="report_card") {
             
                $data= $this->assessementCalculations($stream, $session, $assessement_id, $outcome, $baseline, $group);
                dd("assessement based stream report card");
            }
            //2.End of Assessement Stream-Based outcome- Report Cards


            //3.Assessement Stream-Based outcome- Performance Analysis
            if ($outcome=="performance_analysis") {
                dd("assessement based stream performance analysis");
            }
            //3.End of assessement Stream-Based outcome- Performance Analysis
        }

         //End  of Assessement Stream-Based outcomes


     
        //Beginning of Assessement Class-Based outcomes

        if ($request->category=="class") {
        //1.Assessement Class-Based outcome- Scoresheet 

         //chosen class
          $class=$request->category_result;

          $group="class";

   
          $data= $this->assessementCalculations($stream, $session, $assessement_id, $outcome, $baseline,$group);

          if ($outcome=="scoresheet") {

            //this is an assessment based scoresheet
        

            return view('analytics.insights.assessement-insights.scoresheet', compact('data', 'assessement_id', 'stream'));
          
        }


        if ($outcome=="report_card") {

            //this is an assessment based scoresheet
        

            return view('analytics.insights.assessement-insights.report_card', compact('data', 'assessement_id', 'stream'));
          
        }


        if ($outcome=="performance_analysis") {

            //this is an assessment based scoresheet
        

            return view('analytics.insights.assessement-insights.report_card', compact('data', 'assessement_id', 'stream'));
          
        }


          $data= $this->assessementCalculations($class, $session, $assessement_id, $outcome, $baseline,$group);

          return view('analytics.insights.assessement-insights.scoresheet', compact('data', 'pass_rate', 'assessement_id', 'class'));




        //2.Assessement Class-Based outcome- Report Card 
        //3.Assessement Class-Based outcome- Performance Analysis 
        }  


    }

//End of Assessement Based Reporting









    //Beginning of Term Based Reporting 

    if ($request->baseline=="term") {
     


 

     //Beginning of Assessement Stream-Based outcomes
     if ($request->category=="stream") {
         

         //chosen stream
         $stream=$request->category_result;
         $group="stream";

         //1.Assessement Stream-Based outcome- Scoresheet
     
         if ($outcome=="scoresheet") {

             //this is an assessment based scoresheet
             
             $data= $this->assessementCalculations($stream, $session, $assessement_id, $outcome, $baseline,$group);

          

             return view('analytics.insights.assessement-insights.scoresheet', compact('data', 'assessement_id', 'stream'));
           
         }


         //2.Assessement Stream-Based outcome- Report Cards
         if ($outcome=="report_card") {
          
             $data= $this->assessementCalculations($stream, $session, $assessement_id, $outcome, $baseline, $group);
             dd("assessement based stream report card");
         }
         //2.End of Assessement Stream-Based outcome- Report Cards


         //3.Assessement Stream-Based outcome- Performance Analysis
         if ($outcome=="performance_analysis") {
             dd("assessement based stream performance analysis");
         }
         //3.End of assessement Stream-Based outcome- Performance Analysis
     }

      //End  of Assessement Stream-Based outcomes


  
     //Beginning of Assessement Class-Based outcomes

     if ($request->category=="class") {
     //1.Assessement Class-Based outcome- Scoresheet 

      //chosen class
       $class=$request->category_result;

       $group="class";

       $data= $this->assessementCalculations($class, $session, $assessement_id, $outcome, $baseline,$group);

       return view('analytics.insights.assessement-insights.scoresheet', compact('data', 'pass_rate', 'assessement_id', 'class'));




     //2.Report Class-Based outcome- Report Card 
     //3.Report Class-Based outcome- Performance Analysis 
     }  


 }

//End of Assessement Based Reporting


    }

    public function stream(Request $request){
//section

$isAdminTeacher= Auth::user()->hasRole('admin_teacher');
        $isPrincipal= Auth::user()->hasRole('school-administrator');
        $isTeacher= Auth::user()->hasRole('teacher');

        //Add teachers


        Schema::table('assessement_progress_reports', function ($table) {
       
            $table->float('student_average')->change();
            
        });

        if($isAdminTeacher OR $isPrincipal OR $isTeacher){

    

            // flash()->overlay('<i class="fas fa-check-circle text-success"></i> Update. The Scoresheet module is undergoing an upgrade. Please check back later', 'Update Notice');
            // return redirect()->back();
          //  $request->exists('class_name')
            if($request->exists('class_name')){

                $student_class=$request->class_name;
                $getstream=Grade::find($student_class);
                $student_stream=$getstream->stream_id;
            
            }else{
                $student_stream=$request->stream_name;
            
            }
                   


$section=Grade::where('stream_id', $student_stream)->first();

$assessement_id=$request->assessement;
$section_id=$section->section_id;

//Get pass_rate
$criteria=PassRate::where('section_id', $section_id)->first();
   
//Pass rate variables
$pass_rate=$criteria->passing_rate;
$number_of_subjects=$criteria->number_of_subjects;
$passing_subject_rule=$criteria->passing_subject_rule;
$term_average_rule=$criteria->average_calculation; //average calculation
$subject_average_rule=$criteria->subject_average_calculation; //subject average calculation
$term_average_type=$criteria->term_average_type;//average type
$number_of_decimal_places=$criteria->number_of_decimal_places;// number of decimal places
$tie_type=$criteria->tie_type;// number of decimal places
$school=School::first();




$subject=Subject::where('subject_type','passing_subject')->first();
$passing_subject=$subject->id;
$passing_subject_name=$subject->subject_name;

$non_value_exists=Subject::where('subject_type','non-value')->exists();

if($non_value_exists){
    $subject_non_value=Subject::where('subject_type','non-value')->get()->pluck('id')->toArray();         
    $nonvalue_subjects_id = implode(',',$subject_non_value);
   
}else{
    $non_value_subject=0;
}



$stream_is=Stream::where('id',$student_stream)->first();
$stream_title=$stream_is->stream_name;

$getAssessement=Assessement::find($assessement_id);

// dd($assessement_id);

$assessement_name=$getAssessement->assessement_name;

$activeYearIs=AcademicSession::where('active',1)->first();
$activeYear=$activeYearIs->id;
  // dd($criteria->passing_subject_rule);

  
  //get students
  $students = DB::table('grades_students')
  ->join('users', 'grades_students.student_id', '=', 'users.id')
  ->join('grades', 'grades_students.grade_id', '=', 'grades.id')
  ->where('grades.stream_id', $student_stream)
  ->where('grades_students.active', 1)
  ->get()->pluck('student_id');


$student_average = [];
foreach ($students as $student ) {
//Generate Assessement Values

if($criteria->average_calculation=="custom" ){


    if($term_average_type=="decimal"){
        $avg_calculation="ROUND(SUM(t.mark) /".$number_of_subjects.", $number_of_decimal_places )";

      }else{
        $avg_calculation="ROUND(SUM(t.mark) /".$number_of_subjects." )";
      }


 //if Passing subject rule applies 
       if($criteria->passing_subject_rule=="1"){

        //Student AVERAGE
        $student_average[]=DB::select(DB::raw("SELECT student_id, ".$avg_calculation." as average_mark ,grade_id, term_id.term, section_id,stream_id,assessement_type, nps.number_of_passed_subjects, prm.passing_subject_status,lmr.marks_count, lmr.loads_count   from 

        (select marks.student_id,grades.id as grade_id, grades.stream_id, grades.section_id, ROUND(AVG(mark))  as mark  from marks 
        INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id
        INNER JOIN student_loads ON student_loads.teaching_load_id=marks.teaching_load_id
        INNER JOIN subjects ON subjects.id=teaching_loads.subject_id
        INNER JOIN grades ON grades.id=teaching_loads.class_id
        where marks.student_id = ".$student." AND marks.assessement_id=".$assessement_id." AND subject_id NOT IN (".$nonvalue_subjects_id.") AND student_loads.active=1 AND marks.active=1 
        GROUP BY subject_id
        order by (subject_id =".$passing_subject.") desc, mark desc
                    LIMIT ".$number_of_subjects.") t, 
                    (SELECT count(marks.mark) as number_of_passed_subjects FROM marks INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id   WHERE  marks.student_id = ".$student." AND marks.assessement_id=".$assessement_id."  AND marks.mark>=".$pass_rate." AND subject_id NOT IN (".$nonvalue_subjects_id.")  AND marks.active=1  order by  mark desc
                   ) nps, 
                   (SELECT COUNT(marks.mark) as passing_subject_status FROM marks INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id INNER JOIN subjects ON subjects.id = teaching_loads.subject_id WHERE marks.student_id = ".$student." AND marks.assessement_id = ".$assessement_id."  AND marks.mark>=".$pass_rate." AND subject_id=".$passing_subject." ) prm,

                   (SELECT (SELECT COUNT(*) from marks  where marks.student_id=".$student." AND  marks.assessement_id=".$assessement_id." AND marks.active=1  ) as marks_count, (SELECT COUNT(*) from student_loads  where student_loads.student_id=".$student." AND student_loads.active=1  ) as loads_count
                   )lmr,
                   
                   (SELECT DISTINCT(assessements.term_id) as term, assessements.assessement_type from marks INNER JOIN assessements ON assessements.id=marks.assessement_id WHERE assessements.id=".$assessement_id.") term_id
             
                   
         ORDER BY round((SUM(t.mark))/".$number_of_subjects.") DESC"));

            

        }else if($criteria->passing_subject_rule=="0"){
            


            // dd()

            $student_average[]=DB::select(DB::raw("SELECT student_id, ".$avg_calculation." as average_mark  ,grade_id,assessement_type, term_id.term, section_id,stream_id, nps.number_of_passed_subjects, prm.passing_subject_status,lmr.marks_count, lmr.loads_count  from 

            (select marks.student_id,grades.id as grade_id, grades.stream_id, grades.section_id, ROUND(AVG(mark))  as mark  from marks 
                            INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id
                            INNER JOIN subjects ON subjects.id=teaching_loads.subject_id
                            INNER JOIN grades ON grades.id=teaching_loads.class_id
                            INNER JOIN student_loads ON student_loads.teaching_load_id=marks.teaching_load_id
                            where marks.student_id = ".$student." AND marks.assessement_id=".$assessement_id."  AND subject_id NOT IN (".$nonvalue_subjects_id.") AND student_loads.active=1
                        GROUP BY subject_id
                        order by  mark desc
                        LIMIT ".$number_of_subjects.") t, 
                         (SELECT count(marks.mark) as number_of_passed_subjects FROM marks INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id   WHERE  marks.student_id = ".$student." AND marks.assessement_id=".$assessement_id."  AND marks.mark>=".$pass_rate." AND subject_id NOT IN (".$nonvalue_subjects_id.")  AND marks.active=1  order by  mark desc
                         ) nps, 
                       (SELECT COUNT(marks.mark) as passing_subject_status FROM marks INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id INNER JOIN subjects ON subjects.id = teaching_loads.subject_id WHERE marks.student_id = ".$student." AND marks.assessement_id = ".$assessement_id." AND marks.mark>=".$pass_rate." AND subject_id=".$passing_subject." ) prm,

                       (SELECT (SELECT COUNT(*) from marks where marks.student_id=".$student." AND marks.assessement_id=".$assessement_id."  AND marks.active=1 ) as marks_count, (SELECT COUNT(*) from student_loads  where student_loads.student_id=".$student." AND student_loads.active=1 ) as loads_count
                       )lmr,
                       
                       (SELECT DISTINCT(assessements.term_id) as term, assessements.assessement_type from marks INNER JOIN assessements ON assessements.id=marks.assessement_id WHERE assessements.id=".$assessement_id.") term_id
                 
                       
             ORDER BY round((SUM(t.mark))/".$number_of_subjects.") DESC"));

        }
       
  
}else if($criteria->average_calculation=="default"){

  //  $total_subjects=StudentLoad::where('student_id', $student)->count();
    // $total_subjects = DB::table('student_loads')
    // ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
    // ->where('student_id', $student)
    // ->where('teaching_loads.active', 1)
    // ->count();

    $total_subjects = DB::table('student_loads')
    ->join('teaching_loads', 'student_loads.teaching_load_id', '=', 'teaching_loads.id')
    ->join('academic_sessions', 'academic_sessions.id', '=', 'teaching_loads.session_id')
    ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
    ->where('teaching_loads.active', 1)
    ->where('student_loads.student_id', $student)
    ->where('student_loads.active', 1)
     ->whereNotIn('subjects.id', array($nonvalue_subjects_id))
    ->where('academic_sessions.active', 1)//Scoping to active academic year. 
    ->get()->count();
    

    $total_marks = DB::table('marks')
    ->join('teaching_loads', 'marks.teaching_load_id', '=', 'teaching_loads.id')
    ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
    ->where('teaching_loads.active', 1)
    ->where('marks.student_id', $student)
    ->where('marks.active', 1)
     ->whereNotIn('subjects.id', array($nonvalue_subjects_id))
    ->where('marks.session_id', $activeYear)//Scoping to active academic year. 
    ->get()->count();

  
  
    // $total_marks=Mark::where('student_id', $student)->where('assessement_id', $assessement_id)->count();

    if($total_marks>$total_subjects){
        //More marks than teaching loads
        //->Probably deleted loads & left mark

        $loads=DB::select(DB::raw(" SELECT teaching_load_id  FROM marks  WHERE teaching_load_id NOT IN (SELECT student_loads.teaching_load_id FROM student_loads WHERE student_id=".$student." AND student_loads.active=1) AND student_id=".$student." AND assessement_id=".$assessement_id.""));

      //  dd($loads);

        
        if(!is_null($loads)){
            foreach($loads as $load){
    
                $insert_load = StudentLoad::create([
                    'student_id'=>$student,
                    'teaching_load_id'=>$load->teaching_load_id,
            
                        ]);
            
            }

        }
           

    }



   
    
    if($total_subjects>$total_marks){
        //More subjects than marks
       //fix bug where assessement 

        $loads=DB::select(DB::raw(" SELECT teaching_load_id  FROM student_loads  WHERE teaching_load_id   IN (SELECT teaching_load_id FROM marks WHERE student_id=".$student." AND assessement_id=".$assessement_id." AND active=0) AND student_loads.student_id=".$student." AND student_loads.active=1 "));

    

       // dd($loads);
      

        
        if(!is_null($loads)){

            //update marks table by making session_id="active academic year" & marks.active=1

  
            foreach($loads as $load){

                Mark::where('student_id',$student)->where('teaching_load_id', $load->teaching_load_id)->update([
                    "active"=>'1',
                    "session_id"=>$activeYear,
                ]);
    
             

        }
           

    }


    

    }


  //  $avg_calculation="ROUND(SUM(t.mark) /".$number_of_subjects.", $number_of_decimal_places )";

  if($term_average_type=="decimal"){
    $avg_calculation="ROUND(SUM(t.mark) /".$total_subjects.", $number_of_decimal_places )";

  }else{
    $avg_calculation="ROUND(SUM(t.mark) /".$total_subjects." )";
  }
    //$student_average[]=DB::select(DB::raw("SELECT student_id,".$avg_calculation."  AS average_mark, 
  
    $student_average[]=DB::select(DB::raw("SELECT student_id, ".$avg_calculation." as average_mark ,grade_id, term_id.term,assessement_type, section_id,stream_id, nps.number_of_passed_subjects, prm.passing_subject_status,lmr.marks_count, lmr.loads_count  from 
    (select marks.student_id,grades.id as grade_id, grades.stream_id, grades.section_id, marks.mark  as mark  from marks 
INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id
INNER JOIN student_loads ON student_loads.teaching_load_id=marks.teaching_load_id
INNER JOIN subjects ON subjects.id=teaching_loads.subject_id
INNER JOIN grades ON grades.id=teaching_loads.class_id
where marks.student_id =".$student." AND marks.assessement_id=".$assessement_id." AND subject_id NOT IN (".$nonvalue_subjects_id.") AND student_loads.active=1 AND marks.active=1
          GROUP BY marks.id 
        ) t, 
        (SELECT count(marks.mark) as number_of_passed_subjects FROM marks INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id   WHERE  marks.student_id = ".$student." AND marks.assessement_id=".$assessement_id."  AND marks.mark>=".$pass_rate." AND subject_id NOT IN (".$nonvalue_subjects_id.")  AND marks.active=1  order by  mark desc
                   ) nps, 
             (SELECT COUNT(marks.mark) as passing_subject_status FROM marks INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id INNER JOIN subjects ON subjects.id = teaching_loads.subject_id WHERE marks.student_id =".$student."  AND marks.assessement_id =".$assessement_id." AND marks.mark>=".$pass_rate."  AND subject_id=".$passing_subject.") prm,

             (SELECT (SELECT COUNT(*) from marks  where marks.student_id=".$student." and marks.assessement_id=".$assessement_id." AND marks.active=1) as marks_count,
            (SELECT COUNT(*) from student_loads INNER JOIN teaching_loads ON teaching_loads.id=student_loads.teaching_load_id  where student_loads.student_id=".$student." AND teaching_loads.active=1 and student_loads.active=1 ) as loads_count
             )lmr,
          
             (SELECT DISTINCT(assessements.term_id) as term, assessements.assessement_type from marks INNER JOIN assessements ON assessements.id=marks.assessement_id WHERE assessements.id=".$assessement_id." ) term_id"));

  
}




  }
  //End of foreach loop


//use upsert  



$insert=AssessementProgressReport::upsert(collect($student_average)->map(function($item) use($assessement_id) {

    
    return [
     
        'assessement_id'=>$assessement_id,
        'student_id'=>$item['0']->student_id,
        'student_average'=>$item['0']->average_mark,
        'student_class'=>$item['0']->grade_id,
        'term_id'=>$item['0']->term,
        'assessement_type'=>$item['0']->assessement_type,
        'student_section'=>$item['0']->section_id,
        'student_stream'=>$item['0']->stream_id,
        'number_of_passed_subjects'=>$item['0']->number_of_passed_subjects,
        'passing_subject_status'=>$item['0']->passing_subject_status,
        'loads_count'=>$item['0']->loads_count,
        'marks_count'=>$item['0']->marks_count,
        'assessement_report_key'=>$item['0']->student_id.'-'.$item['0']->term.'-'.$assessement_id,
    ];
  })->toArray(), ['assessement_report_key'], ['student_average','number_of_passed_subjects', 'passing_subject_status' , 'loads_count', 'marks_count']);

  $assessement_id=$request->assessement;
  // $request->has('class_name')
  if($request->exists('stream_name')){
      $streamofstudent=$request->stream_name;
      $classofstudent="";
      $key="stream_based";
  }
  
  if($request->exists('class_name')){
  
      $classofstudent=$request->class_name;
      $getstream=Grade::find($classofstudent);
      $streamofstudent=$getstream->stream_id;
  
      $key="class_based";
  
  }

  if($request->analysis_indicator=='stream_scoresheet'){

    if($request->exists('class_name')){
       $sql_piece=" INNER JOIN grades ON assessement_progress_reports.student_class=grades.id
       WHERE assessement_progress_reports.student_class=".$student_class." AND marks.assessement_id=".$request->assessement." AND assessement_progress_reports.assessement_id=".$request->assessement." AND teaching_loads.active=1 AND grades.id=assessement_progress_reports.student_class  AND grades_students.active=1
       GROUP BY marks.student_id  
       ORDER BY assessement_progress_reports.student_average DESC ";
    }
    if($request->exists('stream_name')){
        $sql_piece= " INNER JOIN grades ON assessement_progress_reports.student_stream=grades.stream_id
        WHERE assessement_progress_reports.student_stream=".$student_stream." AND marks.assessement_id=".$request->assessement." AND assessement_progress_reports.assessement_id=".$request->assessement." AND teaching_loads.active=1 AND grades.stream_id=assessement_progress_reports.student_stream AND grades.id=assessement_progress_reports.student_class AND grades_students.active=1
        GROUP BY marks.student_id  
        ORDER BY assessement_progress_reports.student_average DESC";

     }



     $school_data=School::first();
$base64=$school_data->base64;


     if ($school_data->school_code=="1025") {
       




        if ($criteria->passing_subject_rule=="1") {
            $scoresheet=DB::select(DB::raw("SELECT 
        marks.student_id,
        grades.grade_name,
        users.name,
        users.middlename,
        users.lastname,
        users.id as learner_id,
        assessement_progress_reports.student_average,   
        loads_count, 
        marks_count,
        CASE WHEN assessement_progress_reports.number_of_passed_subjects>=".$number_of_subjects." AND assessement_progress_reports.passing_subject_status<>0 AND assessement_progress_reports.student_average>=".$pass_rate." THEN 'Passed' ELSE 'Failed' END AS 'remark',
         MAX(CASE WHEN subjects.id=2 THEN mark END) AS 'EnglishLanguage',
         MAX(CASE WHEN subjects.id=5 THEN mark END) AS 'Geography',
         MAX(CASE WHEN subjects.id=6 THEN mark END) AS 'Mathametics',
         MAX(CASE WHEN subjects.id=10 THEN mark END) AS 'Siswati',
         MAX(CASE WHEN subjects.id=12 THEN mark END) AS 'PhysicalScience',
         MAX(CASE WHEN subjects.id=13 THEN mark END) AS 'Biology',
         MAX(CASE WHEN subjects.id=14 THEN mark END) AS 'NaturalScience',
         MAX(CASE WHEN subjects.id=15 THEN mark END) AS 'French',
         MAX(CASE WHEN subjects.id=16 THEN mark END) AS 'ConsumerStudies',
         MAX(CASE WHEN subjects.id=18 THEN mark END) AS 'BusinessStudies',
         MAX(CASE WHEN subjects.id=21 THEN mark END) AS 'Accounting',
         MAX(CASE WHEN subjects.id=22 THEN mark END) AS 'Economics',
         MAX(CASE WHEN subjects.id=23 THEN mark END) AS 'Agriculture',
         MAX(CASE WHEN subjects.id=24 THEN mark END) AS 'FS_Maths',
         MAX(CASE WHEN subjects.id=25 THEN mark END) AS 'ComputerStudies',
         MAX(CASE WHEN subjects.id=27 THEN mark END) AS 'History',
         MAX(CASE WHEN subjects.id=28 THEN mark END) AS 'ICT',
         MAX(CASE WHEN subjects.id=29 THEN mark END) AS 'FS_CS',
         MAX(CASE WHEN subjects.id=34 THEN mark END) AS 'EGT',
         MAX(CASE WHEN subjects.id=36 THEN mark END) AS 'QR',
         MAX(CASE WHEN subjects.id=37 THEN mark END) AS 'EMS',
         MAX(CASE WHEN subjects.id=38 THEN mark END) AS 'ActiveCitizenry',
         MAX(CASE WHEN subjects.id=39 THEN mark END) AS 'FS_English',
         MAX(CASE WHEN subjects.id=40 THEN mark END) AS 'Music'
           
        FROM marks INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id
        INNER JOIN subjects ON teaching_loads.subject_id=subjects.id
        INNER JOIN users ON users.id=marks.student_id
        INNER JOIN grades_students ON grades_students.student_id=marks.student_id
        INNER JOIN assessement_progress_reports ON assessement_progress_reports.student_id=marks.student_id".$sql_piece.""));

        }
     } else {
        
     
     

    if ($criteria->passing_subject_rule=="1") {
        $scoresheet=DB::select(DB::raw("SELECT 
    marks.student_id,
    grades.grade_name,
    users.name,
    users.middlename,
    users.lastname,
    users.id as learner_id,
    assessement_progress_reports.student_average,   
    loads_count, 
    marks_count,
    CASE WHEN assessement_progress_reports.number_of_passed_subjects>=".$number_of_subjects." AND assessement_progress_reports.passing_subject_status<>0 AND assessement_progress_reports.student_average>=".$pass_rate." THEN 'Passed' ELSE 'Failed' END AS 'remark',
     MAX(CASE WHEN subjects.id=2 THEN mark END) AS 'EnglishLanguage',
     MAX(CASE WHEN subjects.id=3 THEN mark END) AS 'EnglishInLiterature',
     MAX(CASE WHEN subjects.id=5 THEN mark END) AS 'Geography',
     MAX(CASE WHEN subjects.id=6 THEN mark END) AS 'Mathametics',
     MAX(CASE WHEN subjects.id=10 THEN mark END) AS 'Siswati',
     MAX(CASE WHEN subjects.id=12 THEN mark END) AS 'PhysicalScience',
     MAX(CASE WHEN subjects.id=13 THEN mark END) AS 'Biology',
     MAX(CASE WHEN subjects.id=14 THEN mark END) AS 'Science',
     MAX(CASE WHEN subjects.id=15 THEN mark END) AS 'French',
     MAX(CASE WHEN subjects.id=16 THEN mark END) AS 'HomeEconomics',
     MAX(CASE WHEN subjects.id=17 THEN mark END) AS 'BookKeeping',
     MAX(CASE WHEN subjects.id=18 THEN mark END) AS 'BusinessStudies',
     MAX(CASE WHEN subjects.id=19 THEN mark END) AS 'FoodNutrition',
     MAX(CASE WHEN subjects.id=20 THEN mark END) AS 'FashionFabrics',
     MAX(CASE WHEN subjects.id=21 THEN mark END) AS 'Accounting',
     MAX(CASE WHEN subjects.id=22 THEN mark END) AS 'Economics',
     MAX(CASE WHEN subjects.id=23 THEN mark END) AS 'Agriculture',
     MAX(CASE WHEN subjects.id=24 THEN mark END) AS 'AdditionalMathametics',
     MAX(CASE WHEN subjects.id=25 THEN mark END) AS 'ICT',
     MAX(CASE WHEN subjects.id=26 THEN mark END) AS 'RE',
     MAX(CASE WHEN subjects.id=27 THEN mark END) AS 'History',
     MAX(CASE WHEN subjects.subject_code=101 THEN mark END) AS 'DesignTechnology',
     MAX(CASE WHEN subjects.subject_code=102 THEN mark END) AS 'Computer',
     MAX(CASE WHEN subjects.subject_code=103 THEN mark END) AS 'DS',
     MAX(CASE WHEN subjects.subject_code=76 THEN mark END) AS 'SocialStudies',
     MAX(CASE WHEN subjects.subject_code=77 THEN mark END) AS 'PracticalArts',
     MAX(CASE WHEN subjects.subject_code=78 THEN mark END) AS 'GeneralStudies', 
     MAX(CASE WHEN subjects.subject_code=79 THEN mark END) AS 'Agriculturep', 
     MAX(CASE WHEN subjects.subject_code=710 THEN mark END) AS 'ExpressiveArts',
     MAX(CASE WHEN subjects.subject_code=711 THEN mark END) AS 'ICTp',
     MAX(CASE WHEN subjects.subject_code=713 THEN mark END) AS 'HPE',
     MAX(CASE WHEN subjects.subject_code=714 THEN mark END) AS 'FineArts',
     MAX(CASE WHEN subjects.subject_code=715 THEN mark END) AS 'SoapCraft',
     MAX(CASE WHEN subjects.subject_code=716 THEN mark END) AS 'ShoeCraft',
     MAX(CASE WHEN subjects.subject_code=717 THEN mark END) AS 'HandCraft',
     MAX(CASE WHEN subjects.subject_code=115 THEN mark END) AS 'PrevocICT',
     MAX(CASE WHEN subjects.subject_code=116 THEN mark END) AS 'AgiculturalTechnology',
     MAX(CASE WHEN subjects.subject_code=117 THEN mark END) AS 'BusinessAccounting',
     MAX(CASE WHEN subjects.subject_code=118 THEN mark END) AS 'FoodTextileTechnology',
     MAX(CASE WHEN subjects.subject_code=119 THEN mark END) AS 'TechnicalStudies', 
     MAX(CASE WHEN subjects.subject_code=712 THEN mark END) AS 'ConsumerSciencep',
     MAX(CASE WHEN subjects.subject_code=121 THEN mark END) AS 'Entreprenuership',
     MAX(CASE WHEN subjects.subject_code=6884 THEN mark END) AS 'Biocore'
       
    FROM marks INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id
    INNER JOIN subjects ON teaching_loads.subject_id=subjects.id
    INNER JOIN users ON users.id=marks.student_id
    INNER JOIN grades_students ON grades_students.student_id=marks.student_id
    INNER JOIN assessement_progress_reports ON assessement_progress_reports.student_id=marks.student_id".$sql_piece.""));

    }else{
        $scoresheet=DB::select(DB::raw("SELECT 
    marks.student_id,
    grades.grade_name,
    users.name,
    users.middlename,
    users.lastname,
    users.id as learner_id,
    assessement_progress_reports.student_average,   
    loads_count, 
    marks_count,
    CASE WHEN assessement_progress_reports.number_of_passed_subjects>=".$number_of_subjects."  AND assessement_progress_reports.student_average>=".$pass_rate." THEN 'Passed' ELSE 'Failed' END AS 'remark',
     MAX(CASE WHEN subjects.id=2 THEN mark END) AS 'EnglishLanguage',
     MAX(CASE WHEN subjects.id=3 THEN mark END) AS 'EnglishInLiterature',
     MAX(CASE WHEN subjects.id=5 THEN mark END) AS 'Geography',
     MAX(CASE WHEN subjects.id=6 THEN mark END) AS 'Mathametics',
     MAX(CASE WHEN subjects.id=10 THEN mark END) AS 'Siswati',
     MAX(CASE WHEN subjects.id=12 THEN mark END) AS 'PhysicalScience',
     MAX(CASE WHEN subjects.id=13 THEN mark END) AS 'Biology',
     MAX(CASE WHEN subjects.id=14 THEN mark END) AS 'Science',
     MAX(CASE WHEN subjects.id=15 THEN mark END) AS 'French',
     MAX(CASE WHEN subjects.id=16 THEN mark END) AS 'HomeEconomics',
     MAX(CASE WHEN subjects.id=17 THEN mark END) AS 'BookKeeping',
     MAX(CASE WHEN subjects.id=18 THEN mark END) AS 'BusinessStudies',
     MAX(CASE WHEN subjects.id=19 THEN mark END) AS 'FoodNutrition',
     MAX(CASE WHEN subjects.id=20 THEN mark END) AS 'FashionFabrics',
     MAX(CASE WHEN subjects.id=21 THEN mark END) AS 'Accounting',
     MAX(CASE WHEN subjects.id=22 THEN mark END) AS 'Economics',
     MAX(CASE WHEN subjects.id=23 THEN mark END) AS 'Agriculture',
     MAX(CASE WHEN subjects.id=24 THEN mark END) AS 'AdditionalMathametics',
     MAX(CASE WHEN subjects.id=25 THEN mark END) AS 'ICT',
     MAX(CASE WHEN subjects.id=26 THEN mark END) AS 'RE',
     MAX(CASE WHEN subjects.id=27 THEN mark END) AS 'History',
     MAX(CASE WHEN subjects.subject_code=101 THEN mark END) AS 'DesignTechnology',
     MAX(CASE WHEN subjects.subject_code=102 THEN mark END) AS 'Computer',
     MAX(CASE WHEN subjects.subject_code=103 THEN mark END) AS 'DS',
     MAX(CASE WHEN subjects.subject_code=76 THEN mark END) AS 'SocialStudies',
     MAX(CASE WHEN subjects.subject_code=77 THEN mark END) AS 'PracticalArts',
     MAX(CASE WHEN subjects.subject_code=78 THEN mark END) AS 'GeneralStudies', 
     MAX(CASE WHEN subjects.subject_code=79 THEN mark END) AS 'Agriculturep', 
     MAX(CASE WHEN subjects.subject_code=710 THEN mark END) AS 'ExpressiveArts',
     MAX(CASE WHEN subjects.subject_code=711 THEN mark END) AS 'ICTp',
     MAX(CASE WHEN subjects.subject_code=713 THEN mark END) AS 'HPE',
     MAX(CASE WHEN subjects.subject_code=714 THEN mark END) AS 'FineArts',
     MAX(CASE WHEN subjects.subject_code=715 THEN mark END) AS 'SoapCraft',
     MAX(CASE WHEN subjects.subject_code=716 THEN mark END) AS 'ShoeCraft',
     MAX(CASE WHEN subjects.subject_code=717 THEN mark END) AS 'HandCraft',
     MAX(CASE WHEN subjects.subject_code=115 THEN mark END) AS 'PrevocICT',
     MAX(CASE WHEN subjects.subject_code=116 THEN mark END) AS 'AgiculturalTechnology',
     MAX(CASE WHEN subjects.subject_code=117 THEN mark END) AS 'BusinessAccounting',
     MAX(CASE WHEN subjects.subject_code=118 THEN mark END) AS 'FoodTextileTechnology',
     MAX(CASE WHEN subjects.subject_code=119 THEN mark END) AS 'TechnicalStudies', 
     MAX(CASE WHEN subjects.subject_code=712 THEN mark END) AS 'ConsumerSciencep',
     MAX(CASE WHEN subjects.subject_code=121 THEN mark END) AS 'Entreprenuership',
     MAX(CASE WHEN subjects.subject_code=6884 THEN mark END) AS 'Biocore'
       FROM marks INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id
       INNER JOIN subjects ON teaching_loads.subject_id=subjects.id
       INNER JOIN users ON users.id=marks.student_id
       INNER JOIN grades_students ON grades_students.student_id=marks.student_id
       INNER JOIN assessement_progress_reports ON assessement_progress_reports.student_id=marks.student_id".$sql_piece.""));

    }
}
    
    

//if there are missing marks then return a page that shows the marks that are missing
// dd($scoresheet[]->loads_count);

//create a loop from loads students

// foreach ($students as $student ) {
// $get=DB::table('student_loads')
// ->where('student_id', $student)
// ->get();


// }










if($school_data->school_type=="primary-school"){
    return view('analytics.scoresheet.primary',compact('scoresheet','stream_title', 'section_id', 'assessement_name','assessement_id', 'tie_type', 'streamofstudent', 'assessement_id', 'base64', 'pass_rate','key', 'classofstudent', 'term_average_rule', 'number_of_subjects', 'passing_subject_rule', 'passing_subject_name'));   
}else{

    if ($school_data->school_code=="1025") {
        return view('analytics.scoresheet.index_sisekelo',compact('scoresheet','stream_title','number_of_subjects','passing_subject_rule','term_average_rule', 'section_id', 'assessement_name','assessement_id', 'tie_type', 'streamofstudent', 'assessement_id', 'base64', 'pass_rate', 'key', 'classofstudent', 'term_average_rule', 'number_of_subjects', 'passing_subject_rule', 'passing_subject_name')); 
    }else{
        return view('analytics.scoresheet.index',compact('scoresheet','stream_title','number_of_subjects','passing_subject_rule','term_average_rule', 'section_id', 'assessement_name','assessement_id', 'tie_type', 'streamofstudent', 'assessement_id', 'base64', 'pass_rate', 'key', 'classofstudent', 'term_average_rule', 'number_of_subjects', 'passing_subject_rule', 'passing_subject_name')); 
    }
    
}


   

}


if($request->analysis_indicator=='summary'){

$school=School::all();


$assessement_id=$request->assessement;
$criteria=PassRate::where('section_id', $section_id)->first();
   

    if($key=="class_based"){
        $passed= DB::table('assessement_progress_reports')
        ->join('grades', 'grades.id', '=', 'assessement_progress_reports.student_class')
        ->join('users', 'users.id', '=', 'assessement_progress_reports.student_id')
        ->where('student_class', $request->class_name)
        ->where('assessement_id', $request->assessement)
        ->where('users.active', 1)
        ->where('student_average','>=',$pass_rate)

       
        ->select('users.id as learner_id','profile_photo_path','grade_name', 'name', 'lastname', 'middlename', 'number_of_passed_subjects','passing_subject_status','student_average')
        ->orderByDesc('student_average')
        ->get();

        $failed= DB::table('assessement_progress_reports')
        ->join('grades', 'grades.id', '=', 'assessement_progress_reports.student_class')
        ->join('users', 'users.id', '=', 'assessement_progress_reports.student_id')
        ->where('student_class', $request->class_name)
        ->where('assessement_id', $request->assessement)
        ->where('users.active', 1)
        ->where('student_average','<',$pass_rate)
        ->orderBy('student_average', 'asc')
        ->select('users.id as learner_id','profile_photo_path','grade_name', 'name', 'lastname', 'middlename', 'number_of_passed_subjects','passing_subject_status','student_average')
        ->get();

    
    
        $title=DB::table('assessement_progress_reports')
        ->join('grades', 'grades.id', '=', 'assessement_progress_reports.student_class')
        ->join('assessements', 'assessements.id', '=', 'assessement_progress_reports.assessement_id')
        ->where('student_class', $request->class_name)
       ->where('assessement_id', $request->assessement)
       ->select('grade_name','assessement_name')
        ->first();
    }else{
        $passed= DB::table('assessement_progress_reports')
        ->join('grades', 'grades.id', '=', 'assessement_progress_reports.student_class')
        ->join('users', 'users.id', '=', 'assessement_progress_reports.student_id')
        ->where('student_stream', $streamofstudent)
        ->where('assessement_id', $request->assessement)
        ->where('users.active', 1)
        ->where('student_average','>=',$pass_rate)
       
        ->select('users.id as learner_id','profile_photo_path','grade_name', 'name', 'lastname', 'middlename', 'number_of_passed_subjects','passing_subject_status','student_average')
        ->orderByDesc('student_average')
        ->get();

        $failed= DB::table('assessement_progress_reports')
        ->join('grades', 'grades.id', '=', 'assessement_progress_reports.student_class')
        ->join('users', 'users.id', '=', 'assessement_progress_reports.student_id')
        ->where('student_stream', $streamofstudent)
        ->where('assessement_id', $request->assessement)
        ->where('users.active', 1)
        ->where('student_average','<',$pass_rate)
        ->orderBy('student_average', 'asc') 
        ->select('users.id as learner_id','profile_photo_path','grade_name', 'name', 'lastname', 'middlename', 'number_of_passed_subjects','passing_subject_status','student_average')
      
        ->get();
    
        $title=DB::table('assessement_progress_reports')
        ->join('grades', 'grades.id', '=', 'assessement_progress_reports.student_class')
        ->join('assessements', 'assessements.id', '=', 'assessement_progress_reports.assessement_id')
        ->where('student_class', $classofstudent)
       ->where('assessement_id', $request->assessement)
       ->select('grade_name','assessement_name')
        ->first();
    }
   
    // dd($request->all());

 

   return view('analytics.stream_view', compact('passed','title', 'pass_rate','failed', 'school', 'classofstudent','streamofstudent','assessement_id','tie_type','key' ));

        
}

if($request->analysis_indicator=='subject_analysis'){

     //  dd($request->all());
     $hour= date('H');

     if ($hour >= 20) {
         $greetings = "Good Night";
     } elseif ($hour > 17) {
        $greetings = "Good Evening";
     } elseif ($hour > 11) {
         $greetings = "Good Afternoon";
     } elseif ($hour < 12) {
        $greetings = "Good Morning";
     }
  

     
     $section=Grade::where('stream_id', $request->stream_name)->first();
     $section_id=$section->section_id;

     $criteria=PassRate::where('section_id', $section_id)->first();
     $pass_rate=$criteria->passing_rate;
   

     $passed = DB::table('marks')
     ->join('users', 'marks.student_id', '=', 'users.id')
     ->join('teaching_loads', 'marks.teaching_load_id', '=', 'teaching_loads.id')
     ->join('assessements', 'marks.assessement_id', '=', 'assessements.id')
     ->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
     ->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
     ->where('grades.stream_id', $request->stream_name)
   //  ->where('teac')
     ->where('assessements.id', $request->assessement)
     ->where('subjects.id', $request->subject)
     ->where('marks.mark','>=', $pass_rate)
     ->where('marks.active','=', 1)
     ->where('users.active','=', 1)
     ->where('teaching_loads.active','=', 1)
     ->orderByDesc('mark')
     ->get();

     //dd($passed);

     $failed = DB::table('marks')
     ->join('users', 'marks.student_id', '=', 'users.id')
     ->join('teaching_loads', 'marks.teaching_load_id', '=', 'teaching_loads.id')
     ->join('assessements', 'marks.assessement_id', '=', 'assessements.id')
     ->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
     ->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
     ->where('grades.stream_id', $request->stream_name)
     ->where('assessements.id', $request->assessement)
     ->where('subjects.id', $request->subject)
     ->where('marks.mark','<', $pass_rate)
     ->where('marks.active','=', 1)
     ->where('users.active','=', 1)
     ->where('teaching_loads.active','=', 1)
     ->orderBy('lastname')
     ->get();

     $total = DB::table('marks')
     ->join('users', 'marks.student_id', '=', 'users.id')
     ->join('teaching_loads', 'marks.teaching_load_id', '=', 'teaching_loads.id')
     ->join('assessements', 'marks.assessement_id', '=', 'assessements.id')
     ->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
     ->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
     ->where('grades.stream_id', $request->stream_name)
     ->where('assessements.id', $request->assessement)
     ->where('subjects.id', $request->subject)
     ->where('marks.active','=', 1)
     ->where('users.active','=', 1)
     ->where('teaching_loads.active','=', 1)
     ->orderBy('lastname')
     ->get()->count();

 $total_sat=($passed->count()+$failed->count());

     $total_passed=$passed->count();
     $total_failed=$failed->count();

     $subject_pass_rate=round(($passed->count()/$total_sat)*100);
     $subject_fail_rate=round(($failed->count()/$total_sat)*100);

     $assessement_data = DB::table('marks')
     ->join('users', 'marks.student_id', '=', 'users.id')
     ->join('teaching_loads', 'marks.teaching_load_id', '=', 'teaching_loads.id')
     ->join('assessements', 'marks.assessement_id', '=', 'assessements.id')
     ->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
     ->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
     ->where('grades.stream_id', $request->stream_name)
     ->where('assessements.id', $request->assessement)
     ->where('subjects.id', $request->subject)
     ->where('marks.active','=', 1)
     ->where('users.active','=', 1)
     ->where('teaching_loads.active','=', 1)
     ->first();

     return view('analytics.view-subject-analytics', compact('assessement_data','total','subject_pass_rate','subject_fail_rate','passed','failed', 'total_failed','total_passed'));

}


        
}
        }


   



public function term_based_12(Request $request){
}

public function term_based(Request $request){

    Schema::table('student_subject_averages', function ($table) {
       
        $table->float('ca_average')->change();
        $table->float('student_average')->change();
        $table->float('exam_mark')->change();
    });

 
 
$admin=Auth::user()->hasRole('admin_teacher');
        $teacher=Auth::user()->hasRole('teacher');
        $student=Auth::user()->hasRole('student');
        $parent=Auth::user()->hasRole('parent');

        $grades=Grade::all();
        $sections=Section::all();
        $streams=Stream::all();
        $terms = DB::table('terms')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'terms.academic_session')
        ->where('academic_sessions.active', 1)
        ->select('terms.id as id', 'academic_sessions.id as session_id', 'terms.term_name')
        ->get();

      


    

        $subjects=Subject::all();

        //Scope to current session

        if($admin){
        return view('analytics.term-analytics.index', compact('grades', 'sections', 'streams','terms'));
        }else if($teacher){
            return view('analytics.admin', compact('grades', 'sections', 'streams','subjects'));
        }else if($parent){
            return view('analytics.parent', compact('grades', 'sections', 'streams', 'assessements'));
        }else if($student){
            return view('analytics.student', compact('grades', 'sections', 'streams', 'assessements'));
        }
    }


    public function term_based_class(Request $request){

        Schema::table('student_subject_averages', function ($table) {
       
            $table->float('ca_average')->change();
            $table->float('student_average')->change();
            $table->float('exam_mark')->change();
        });


        if (!Schema::hasColumn('student_subject_averages', 'ca_piece')) //check the column
		{
			Schema::table('student_subject_averages', function (Blueprint $table)
			{
			   
				$table->double('ca_piece')->nullable();
                $table->double('exam_piece')->nullable();
			});
		}

    
     
    $admin=Auth::user()->hasRole('admin_teacher');
            $teacher=Auth::user()->hasRole('teacher');
            $student=Auth::user()->hasRole('student');
            $parent=Auth::user()->hasRole('parent');
            $class_teacher=Auth::user()->hasRole('class_teacher');
    
            $grades=Grade::all();
            $sections=Section::all();
            $streams=Stream::all();
            $terms = DB::table('terms')
            ->join('academic_sessions', 'academic_sessions.id', '=', 'terms.academic_session')
            ->where('academic_sessions.active', 1)
            ->select('terms.id as id', 'academic_sessions.id as session_id', 'terms.term_name')
            ->get();
    
          
    
    
        
    
            $subjects=Subject::all();
    
            //Scope to current session
    
            if($admin OR $class_teacher){
            return view('analytics.term-analytics.index-class', compact('grades', 'sections', 'streams','subjects', 'terms'));
            }else if($teacher){
                return view('analytics.class_index', compact('grades', 'sections', 'streams','subjects'));
            }
        }


    public function term_based_show(Request $request){

        // DB::table('student_subject_averages')->delete();
        // DB::table('term_averages')->delete();

        $type_key=$request->key;

        if($type_key=="class_based"){

            $classofstudent=$request->grade_id;
            $getstream=Grade::find($classofstudent);
            $stream=$getstream->stream_id;
            $stream_title=$getstream->stream_id;
           
            $class_title=$getstream->grade_name;
           

            $validation=$request->validate([
                'grade_id'=>'required',
                'term'=>'required',
                'indicator'=>'required',
             
    
            ]);
            
        
        }elseif($type_key=="stream_based"){
            $stream=$request->stream_name;
          

            $validation=$request->validate([
                'stream_name'=>'required',
                'term'=>'required',
                'indicator'=>'required',
             
    
            ]);

            $stream_data=Stream::where('id', $stream)->first();
            $stream_title=$stream_data->stream_name;
        }

      
       $term=$request->term;

       $term_data=Term::where('id', $term)->first();
       $term_name=$term_data->term_name;

    
       $school_data=School::first();

   

   // Getting the section of the selected stream (high school or secondary)
   $section=Grade::where('stream_id', $stream)->first();
   $section_id=$section->section_id;


//Settings Validation
//1. Check ca:exam 

$ca_exam_assignment_exists = DB::table('c_a__exams')
->join('terms', 'terms.id', '=', 'c_a__exams.term_id')
->join('academic_sessions', 'academic_sessions.id', '=', 'terms.academic_session')
->where('academic_sessions.active', 1)
->where('terms.id', $term)
->exists();
//chek for term
// dd($ca_exam_assignment_exists);



if (!($ca_exam_assignment_exists)) {
  //if it does not exist
 flash()->overlay('<i class="fas fa-exclamation-circle text-danger"></i> Error. It looks like in this term, there is no assessement that has been assigned as CA or Exam.');
 return redirect()->back();
}

//2. Check assessement weights

$assessement_weights_exist = DB::table('assessement_weights')
->join('terms', 'terms.id', '=', 'assessement_weights.term_id')
->join('academic_sessions', 'academic_sessions.id', '=', 'terms.academic_session')
->where('academic_sessions.active', 1)
->where('terms.id', $term)
->where('stream_id', $stream)
->exists();



if (!($assessement_weights_exist)) {
 //if it does not exist
 flash()->overlay('<i class="fas fa-exclamation-circle text-danger"></i> Error. Please add continuous assessement (CA) percentage weight and exam percentage weight. To do so, please visit assessement settings.');
 return redirect()->back();
}

$pass_rates_exist=DB::table('pass_rates')
->where('pass_rates.section_id',$section_id)
->select('pass_rates.id as pass_rate_id','average_calculation', 'passing_rate','number_of_subjects','passing_subject_rule')
->exists();

if (!($pass_rates_exist)) {
 //if it does not exist
 flash()->overlay('<i class="fas fa-exclamation-circle text-danger"></i> Error. Please add pass rates. To do so, please visit assessement settings section ');
 return redirect()->back();
}


$term_checker=DB::table('terms')
->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
->where('academic_sessions.active', 1)
->where('terms.final_term', 1)
->exists();

if (!($term_checker)) {
 //if it does not exist
 flash()->overlay('<i class="fas fa-exclamation-circle text-danger"></i> Error. Please update term. Make sure that you set TERM 2 to final term & do not forget to delete  Term 3 ');
 return redirect()->back();
}
//end of settinigs validations


//Check if marks complete for students

//1. Get the assesements for the term 
//2. Do a loop of the assesements 



//end of check for completion of marks for students

//1. Getting the pass rates & criteria & number of subjects for the stream
$criteria=PassRate::where('section_id', $section_id)->first();
$pass_rate=$criteria->passing_rate;// pass rate
$number_of_subjects=$criteria->number_of_subjects; //number of subject
$passing_subject_rule=$criteria->passing_subject_rule; // passin subject rule
$term_average_rule=$criteria->average_calculation; //average calculation
$subject_average_rule=$criteria->subject_average_calculation; //subject average calculation
$term_average_type=$criteria->term_average_type;//average type
$number_of_decimal_places=$criteria->number_of_decimal_places;// number of decimal places
$tie_type=$criteria->tie_type;// number of decimal places

$school_is=School::first();


 if($school_is->school_code=='0387'){
     if($stream==1){
         $number_of_subjects==6;
     }
 }





$subject=Subject::where('subject_type','passing_subject')->first();
$passing_subject=$subject->id;


$non_value_exists=Subject::where('subject_type','non-value')->exists();

if($non_value_exists){
    $subject_non_value=Subject::where('subject_type','non-value')->get()->pluck('id')->toArray();         
    $nonvalue_subjects_id = implode(',',$subject_non_value);
   
}else{
    $non_value_subject=0;
}

//Getting Academic Year
$get_academic_session = DB::table('terms')
->join('academic_sessions', 'terms.academic_session', '=', 'academic_sessions.id')
->where('terms.id',$term )//scope this to specified academic year
->first();





//Weight for the term
$weight=AssessementWeight::where('term_id',$term)->where('stream_id', $stream)->first(); 
$ca_weight=$weight->ca_percentage*(0.01);
$exam_weight=$weight->exam_percentage*(0.01);
//End of Weight for the term



// //Getting the tests assigned to the term
// $assigned_assessements=Assessement::where('term_id', $term)->get()->toArray();


// //dd($assigned_assessements);
// $number_of_tests_in_term=Assessement::where('term_id',$term)->count();


// $ca_assessements=Assessement::where('term_id', $term)->where('assessement_type', 1)->get();
// $exam_assessements=Assessement::where('term_id', $term)->where('assessement_type', 2)->get();
//filter to stream

//calculate subject average based on criteria

//end of subject average calculation

//if stream based




if ($type_key=="stream_based") {
    $students = DB::table('grades_students')
    ->join('users', 'grades_students.student_id', '=', 'users.id')
    ->join('grades', 'grades_students.grade_id', '=', 'grades.id')
    ->where('grades.stream_id', $stream)
    ->where('grades_students.active', 1)
    ->where('users.active', 1)
    ->get()->pluck('student_id');
}elseif($type_key=="class_based"){

$students = DB::table('grades_students')
 ->join('users', 'grades_students.student_id', '=', 'users.id')
 ->where('grades_students.grade_id', $classofstudent)
 ->where('grades_students.active', 1)
 ->where('users.active', 1)
 ->get()->pluck('student_id');

}


 



//List of students in the stream

//end of stream based


//if class based




//end of classbased


$subject_average=[];
$student_average=[];
// $getsubject[];
// $getterm[];
$report=[];


if ($type_key=="stream_based") {
    $total_students = DB::table('grades_students')
    ->join('grades', 'grades_students.grade_id', '=', 'grades.id')
    ->join('users', 'grades_students.student_id', '=', 'users.id')
    ->join('streams', 'streams.id', '=', 'grades.stream_id')
    ->where('grades.stream_id', $stream)
    ->where('grades_students.active', 1)
    ->where('users.active', 1)
    ->get()->count('grades_students.student_id');
}elseif($type_key=="class_based"){
    $total_students = DB::table('grades_students')
    ->join('users', 'grades_students.student_id', '=', 'users.id')
    ->where('grades_students.grade_id', $classofstudent)
    ->where('grades_students.active', 1)
    ->where('users.active', 1)
    ->get()->count('grades_students.student_id');
}




foreach ($students as $student ) {

 //First validate the marks entered


//Generate subject average
//Comments
//1.Remember to make dynamize assessment_id

//Generating the subject averages
//Check subject average calculation criteria

if($subject_average_rule=="custom"){

//if the subject average rule is custom, it means that the subject average is calculated  based on the selection of assessements



$subject_average[]=DB::select(DB::raw("SELECT marks.student_id,
GROUP_CONCAT(subjects.subject_name) AS subject_name,
subjects.id as subject_id,
c_a__exams.term_id as term_id,
teaching_loads.class_id as student_class,
teaching_loads.id as teaching_load_id,
(AVG(CASE WHEN  c_a__exams.term_id=".$term." AND c_a__exams.assign_as = 'CA' THEN marks.mark END))AS ca,
(AVG(CASE WHEN  c_a__exams.term_id=".$term." AND c_a__exams.assign_as = 'Examination' THEN marks.mark END))AS exam,
(AVG(CASE WHEN  c_a__exams.term_id=".$term." AND c_a__exams.assign_as = 'CA' THEN (marks.mark)*".$ca_weight." END))AS ca_weight,
(AVG( CASE WHEN  c_a__exams.term_id=".$term." AND c_a__exams.assign_as = 'Examination' THEN (marks.mark)*".$exam_weight." END)) as exam_weight
FROM
marks
INNER JOIN c_a__exams ON c_a__exams.assessement_id = marks.assessement_id
INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id
INNER JOIN subjects ON subjects.id = teaching_loads.subject_id
INNER JOIN users ON users.id=marks.student_id
WHERE marks.student_id = ".$student." AND `c_a__exams`.`term_id` = ".$term." AND marks.active=1 AND users.active=1 AND teaching_loads.active=1
GROUP BY
marks.student_id,
subjects.id"));




}

//  dd($subject_average);
 
}

if($subject_average_rule=="custom"){


foreach ($subject_average as $key) {

$insert=StudentSubjectAverage::upsert(collect($key)->map(function($item) use($student) {
 return [
 'student_id' => $item->student_id,
 'term_id'  =>$item->term_id,
 'subject_id' => $item->subject_id,
 'teaching_load_id' =>$item->teaching_load_id,
 'ca_average' =>$item->ca,
 'exam_mark' =>$item->exam,
 'ca_piece' =>$item->ca_weight,
 'exam_piece' =>$item->exam_weight,
 'student_average' =>(round(($item->ca_weight)+($item->exam_weight))),
 'student_class'  =>$item->student_class,
 'student_key' =>$item->student_id.'-'.$item->term_id.'-'.$item->subject_id,
     ];
 })->toArray(), ['student_key'], ['ca_average','exam_mark', 'student_average']);
}

}




//Generate Stream subject averages

//1. Get stream 


//End of stream subject average



//We can deduce term average from the upserted subject average
//Remember to scope to session

foreach ($students as $student ) {


// $total_subjects=StudentLoad::where('student_id', $student)->count();//Remember to scope to session


$total_subjects = DB::table('student_loads')
->join('teaching_loads', 'student_loads.teaching_load_id', '=', 'teaching_loads.id')
->join('academic_sessions', 'academic_sessions.id', '=', 'teaching_loads.session_id')
->where('student_loads.student_id', $student)
->where('student_loads.active', 1)
->where('academic_sessions.academic_session',$get_academic_session->academic_session )//scoping to current academic 
->get()->count();
//This ($total_subjects) query will retrieve only the number of student loads for the active session



if($criteria->average_calculation=="custom" ){

 if($term_average_type=="decimal"){
     $avg_calculation="ROUND(SUM(t.mark) /".$number_of_subjects.", $number_of_decimal_places )";

   }else{
     $avg_calculation="ROUND(SUM(t.mark) /".$number_of_subjects." )";
   }

//if Passing subject rule applies 
    if($criteria->passing_subject_rule=="1"){

//Student AVERAGE
$student_average[]=DB::select(DB::raw("SELECT student_id, ".$avg_calculation." AS average_mark ,grade_id,  section_id,stream_id, nps.number_of_passed_subjects,term_id, prm.passing_subject_status from 
(select student_subject_averages.student_id,grades.id as grade_id,term_id, grades.stream_id, grades.section_id, ROUND(AVG(student_subject_averages.student_average))  as mark  from student_subject_averages 
INNER JOIN teaching_loads ON teaching_loads.id=student_subject_averages.teaching_load_id
INNER JOIN subjects ON subjects.id=teaching_loads.subject_id
INNER JOIN grades ON grades.id=student_subject_averages.student_class
where student_subject_averages.student_id = ".$student." AND student_subject_averages.term_id=".$term." AND student_subject_averages.subject_id NOT IN (".$nonvalue_subjects_id.")
GROUP BY student_subject_averages.subject_id
ORDER BY (student_subject_averages.subject_id =".$passing_subject.") desc, mark desc
LIMIT ".$number_of_subjects.") t, 
(SELECT
 COUNT(student_subject_averages.student_average) AS number_of_passed_subjects
 FROM
 student_subject_averages
 WHERE
 student_subject_averages.student_id =".$student."  AND student_subject_averages.term_id =".$term." AND student_subject_averages.student_average >=".$pass_rate." AND student_subject_averages.subject_id NOT IN (".$nonvalue_subjects_id.")
 ORDER BY
 student_average
 DESC
) nps, 
(SELECT
COUNT(student_subject_averages.student_average) AS passing_subject_status
FROM
student_subject_averages
WHERE
student_subject_averages.student_id = ".$student."  AND student_subject_averages.term_id=".$term."  AND  student_subject_averages.subject_id = ".$passing_subject." AND student_subject_averages.student_average>=".$pass_rate.") prm
ORDER BY round((SUM(t.mark))/".$number_of_subjects.") DESC"));


     }else if($criteria->passing_subject_rule=="0"){
         

         $student_average[]=DB::select(DB::raw("SELECT student_id, ".$avg_calculation." AS average_mark ,grade_id,  section_id,stream_id, nps.number_of_passed_subjects,term_id, prm.passing_subject_status from 
         (select student_subject_averages.student_id,grades.id as grade_id,term_id, grades.stream_id, grades.section_id, ROUND(AVG(student_subject_averages.student_average))  as mark  from student_subject_averages 
         INNER JOIN teaching_loads ON teaching_loads.id=student_subject_averages.teaching_load_id
         INNER JOIN subjects ON subjects.id=teaching_loads.subject_id
         INNER JOIN grades ON grades.id=student_subject_averages.student_class
         where student_subject_averages.student_id = ".$student." AND student_subject_averages.term_id=".$term." AND student_subject_averages.subject_id NOT IN (".$nonvalue_subjects_id.")
         GROUP BY student_subject_averages.subject_id
         ORDER BY  mark desc
         LIMIT ".$number_of_subjects.") t, 
         (SELECT
                 COUNT(student_subject_averages.student_average) AS number_of_passed_subjects
                 FROM
                 student_subject_averages
                 WHERE
                 student_subject_averages.student_id =".$student."  AND student_subject_averages.term_id =".$term." AND student_subject_averages.student_average >=".$pass_rate." AND student_subject_averages.subject_id NOT IN (".$nonvalue_subjects_id.")
                 ORDER BY
                 student_average
                 DESC
          ) nps, 
         (SELECT
     COUNT(student_subject_averages.student_average) AS passing_subject_status
     FROM
     student_subject_averages
     WHERE
     student_subject_averages.student_id = ".$student."  AND student_subject_averages.term_id=".$term."  AND  student_subject_averages.subject_id = ".$passing_subject." AND student_subject_averages.student_average>=".$pass_rate.") prm
         ORDER BY round((SUM(t.mark))/".$number_of_subjects.") DESC"));
             

     }
    

}else if($criteria->average_calculation=="default"){


 $total_subjects = DB::table('student_loads')
 ->join('teaching_loads', 'student_loads.teaching_load_id', '=', 'teaching_loads.id')
 ->join('academic_sessions', 'academic_sessions.id', '=', 'teaching_loads.session_id')
 ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
 ->where('teaching_loads.active', 1)
 ->where('student_loads.student_id', $student)
 ->whereNotIn('subjects.id', array($nonvalue_subjects_id))
 ->where('academic_sessions.active', 1)//Scoping to active academic year. 
 ->where('student_loads.active', 1)
 ->get()->count();

if($term_average_type=="decimal"){
 $avg_calculation="ROUND(SUM(t.mark) /".$total_subjects.", $number_of_decimal_places )";

}else{
 $avg_calculation="ROUND(SUM(t.mark) /".$total_subjects." )";
}
 $student_average[]=DB::select(DB::raw("SELECT student_id,".$avg_calculation."  AS average_mark, 
 t.grade_id, 
 term_id,
 section_id,
 stream_id,
 nps.number_of_passed_subjects,
 prm.passing_subject_status,
 lmr.marks_count,
 total.total,
 lmr.loads_count
 FROM( SELECT
 student_subject_averages.student_id,
 student_subject_averages.student_class AS grade_id,
 grades.stream_id,
 grades.section_id,
 term_id,
 student_subject_averages.student_average AS mark
 FROM
 student_subject_averages
 INNER JOIN teaching_loads ON teaching_loads.id = student_subject_averages.teaching_load_id
 INNER JOIN grades ON grades.id = student_subject_averages.student_class
 WHERE student_subject_averages.student_id = ".$student." AND student_subject_averages.term_id = ".$term." AND student_subject_averages.subject_id NOT IN (".$nonvalue_subjects_id.")
 GROUP BY
 student_subject_averages.id
) t,
(
 SELECT
 COUNT(student_subject_averages.student_average) AS number_of_passed_subjects
 FROM
 student_subject_averages
 WHERE
 student_subject_averages.student_id =".$student." AND student_subject_averages.term_id =".$term." AND student_subject_averages.student_average >= ".$pass_rate." AND student_subject_averages.subject_id NOT IN (".$nonvalue_subjects_id.")
 ORDER BY
 student_average
 DESC
) nps,

(

 
 SELECT
COUNT(student_subject_averages.student_average) AS passing_subject_status
FROM
student_subject_averages
WHERE
student_subject_averages.student_id = ".$student."  AND student_subject_averages.term_id=".$term."  AND  subject_id = ".$passing_subject." AND student_subject_averages.student_average>=".$pass_rate."
 
 
) prm,
(SELECT COUNT(*) as total FROM `grades_students` INNER JOIN grades on grades.id=grades_students.grade_id INNER JOIN streams ON streams.id=grades.stream_id where grades.stream_id=".$stream." AND grades_students.active=1)total,
(
 
SELECT(SELECT COUNT(*) 
FROM
 student_subject_averages WHERE
 student_id = ".$student." AND student_subject_averages.term_id = ".$term."
 ) AS marks_count,
 (
 SELECT COUNT(*)
 FROM
 student_loads
 WHERE
 student_id = ".$student." AND student_loads.active=1
) AS loads_count
) lmr"));


}




}


//Upsert into sb
//Foreach ($student_average as $term_average) {
$insert_into_term_avg=TermAverage::upsert(collect($student_average)->map(function($term_avg_item) use($student) {
 return [
 'student_id' => $term_avg_item['0']->student_id,
 'term_id'  => $term_avg_item['0']->term_id,
 'student_average' =>$term_avg_item['0']->average_mark,
 'student_section' =>$term_avg_item['0']->section_id,
 'student_stream'=>$term_avg_item['0']->stream_id,
 'number_of_passed_subjects'=>$term_avg_item['0']->number_of_passed_subjects,
 'passing_subject_status'=>$term_avg_item['0']->passing_subject_status,
 'student_class'  =>$term_avg_item['0']->grade_id,
 'student_key' =>$term_avg_item['0']->student_id.'-'.$term_avg_item['0']->term_id,
 ];
   })->toArray(), ['student_key'], ['student_average','number_of_passed_subjects', 'passing_subject_status']);

   $school_info=School::all();

   $isFinal=Term::where('id',$term)->where('final_term',1)->exists();

  

   if ($isFinal) {
    if($passing_subject_rule==1){
        // $getPassed=TermAverage::where('term_id', $term)->where('number_of_passed_subjects','>=', $number_of_subjects)->where('passing_subject_status', 1)->where('student_average','>=',$pass_rate)->where('student_stream',$stream)->update([
        //     'final_term_status'=>'Proceed'
        // ]);



$getPassed = DB::table('term_averages')
->join('grades', 'term_averages.student_class', '=', 'grades.id')
->where('grades.stream_id', $stream)
->where('term_averages.term_id', $term)
->where('passing_subject_status', 1)
->where('number_of_passed_subjects','>=', $number_of_subjects)
->where('student_average','>=',$pass_rate)
->update([
    'final_term_status'=>'Proceed'
]);



     }else{
        $getPassed = DB::table('term_averages')
        ->join('grades', 'term_averages.student_class', '=', 'grades.id')
        ->where('grades.stream_id', $stream)
        ->where('term_averages.term_id', $term)
        ->where('number_of_passed_subjects','>=', $number_of_subjects)
        ->where('student_average','>=',$pass_rate)
        ->update(['final_term_status'=>'Proceed']);
     }
   }

  
if ($request->indicator=="scoresheet" OR $request->indicator=="manual_promotion" OR $request->indicator=="summary_scoresheet" ) {
             
   $indicator=$request->indicator;

   if($type_key=="stream_based"){
    $where_clause="WHERE grades.stream_id=".$stream." AND student_subject_averages.term_id=".$term." AND term_averages.term_id=".$term." AND users.active=1 AND grades_students.active=1 AND student_loads.active=1
    GROUP BY student_subject_averages.student_id  
    ORDER BY term_averages.student_average DESC";
   }elseif ($type_key=="class_based") {
    $where_clause="WHERE grades.id=".$classofstudent." AND student_subject_averages.term_id=".$term." AND term_averages.term_id=".$term." AND users.active=1 AND grades_students.active=1 AND student_loads.active=1
    GROUP BY student_subject_averages.student_id  
    ORDER BY term_averages.student_average DESC";
   }

   

    if($criteria->passing_subject_rule=="0"){
        $scoresheet=DB::select(DB::raw("SELECT 
         student_subject_averages.student_id,
        grades.grade_name,
        users.id as learner_id,
        users.name,
        users.middlename,
        users.lastname,
        term_averages.student_average,
        term_averages.number_of_passed_subjects,
        term_averages.passing_subject_status,
        term_averages.final_term_status,
        CASE WHEN term_averages.number_of_passed_subjects>=".$number_of_subjects."  AND term_averages.student_average>=".$pass_rate." THEN 'Passed' ELSE 'Failed' END AS 'remark',
        MAX(CASE WHEN subjects.id=2 THEN student_subject_averages.student_average END) AS 'EnglishLanguage',
        MAX(CASE WHEN subjects.id=3 THEN student_subject_averages.student_average END) AS 'EnglishInLiterature',
        MAX(CASE WHEN subjects.id=5 THEN student_subject_averages.student_average END) AS 'Geography',
        MAX(CASE WHEN subjects.id=6 THEN student_subject_averages.student_average END) AS 'Mathametics',
        MAX(CASE WHEN subjects.id=10 THEN student_subject_averages.student_average END) AS 'Siswati',
        MAX(CASE WHEN subjects.id=12 THEN student_subject_averages.student_average END) AS 'PhysicalScience',
        MAX(CASE WHEN subjects.id=13 THEN student_subject_averages.student_average END) AS 'Biology',
        MAX(CASE WHEN subjects.id=14 THEN student_subject_averages.student_average END) AS 'Science',
        MAX(CASE WHEN subjects.id=15 THEN student_subject_averages.student_average END) AS 'French',
        MAX(CASE WHEN subjects.id=16 THEN student_subject_averages.student_average END) AS 'HomeEconomics',
        MAX(CASE WHEN subjects.id=17 THEN student_subject_averages.student_average END) AS 'BookKeeping',
        MAX(CASE WHEN subjects.id=18 THEN student_subject_averages.student_average END) AS 'BusinessStudies',
        MAX(CASE WHEN subjects.id=19 THEN student_subject_averages.student_average END) AS 'FoodNutrition',
        MAX(CASE WHEN subjects.id=20 THEN student_subject_averages.student_average END) AS 'FashionFabrics',
        MAX(CASE WHEN subjects.id=21 THEN student_subject_averages.student_average END) AS 'Accounting',
        MAX(CASE WHEN subjects.id=22 THEN student_subject_averages.student_average END) AS 'Economics',
        MAX(CASE WHEN subjects.id=25 THEN student_subject_averages.student_average END) AS 'ICT',
        MAX(CASE WHEN subjects.id=24 THEN student_subject_averages.student_average END) AS 'AdditionalMathametics',
        MAX(CASE WHEN subjects.id=26 THEN student_subject_averages.student_average END) AS 'RE',
        MAX(CASE WHEN subjects.id=27 THEN student_subject_averages.student_average END) AS 'History',
        MAX(CASE WHEN subjects.subject_code=101 THEN student_subject_averages.student_average END) AS 'DesignTechnology',
        MAX(CASE WHEN subjects.subject_code=102 THEN student_subject_averages.student_average END) AS 'Computer',
        MAX(CASE WHEN subjects.subject_code=103 THEN student_subject_averages.student_average END) AS 'DS',
        MAX(CASE WHEN subjects.subject_code=200 THEN student_subject_averages.student_average END) AS 'GP',
        MAX(CASE WHEN subjects.subject_code=201 THEN student_subject_averages.student_average END) AS 'RM',
        MAX(CASE WHEN subjects.subject_code=76 THEN student_subject_averages.student_average END) AS 'SocialStudies',
        MAX(CASE WHEN subjects.subject_code=77 THEN student_subject_averages.student_average END) AS 'PracticalArts',
        MAX(CASE WHEN subjects.subject_code=78 THEN student_subject_averages.student_average END) AS 'GeneralStudies', 
        MAX(CASE WHEN subjects.subject_code=79 THEN student_subject_averages.student_average END) AS 'Agriculturep', 
        MAX(CASE WHEN subjects.subject_code=710 THEN student_subject_averages.student_average END) AS 'ExpressiveArts',
        MAX(CASE WHEN subjects.subject_code=711 THEN student_subject_averages.student_average END) AS 'ICTp',
        MAX(CASE WHEN subjects.subject_code=713 THEN student_subject_averages.student_average END) AS 'HPE',
        MAX(CASE WHEN subjects.subject_code=714 THEN student_subject_averages.student_average END) AS 'FineArts',
        MAX(CASE WHEN subjects.subject_code=715 THEN student_subject_averages.student_average END) AS 'SoapCraft',
        MAX(CASE WHEN subjects.subject_code=716 THEN student_subject_averages.student_average END) AS 'ShoeCraft',
        MAX(CASE WHEN subjects.subject_code=717 THEN student_subject_averages.student_average END) AS 'HandCraft',
        MAX(CASE WHEN subjects.subject_code=115 THEN student_subject_averages.student_average END) AS 'PrevocICT',
        MAX(CASE WHEN subjects.subject_code=116 THEN student_subject_averages.student_average END) AS 'AgiculturalTechnology',
        MAX(CASE WHEN subjects.subject_code=117 THEN student_subject_averages.student_average END) AS 'BusinessAccounting',
        MAX(CASE WHEN subjects.subject_code=118 THEN student_subject_averages.student_average END) AS 'FoodTextileTechnology',
        MAX(CASE WHEN subjects.subject_code=119 THEN student_subject_averages.student_average END) AS 'TechnicalStudies', 
        MAX(CASE WHEN subjects.subject_code=712 THEN student_subject_averages.student_average END) AS 'ConsumerSciencep',
        MAX(CASE WHEN subjects.subject_code=121 THEN student_subject_averages.student_average END) AS 'Entreprenuership',
        MAX(CASE WHEN subjects.id=23 THEN student_subject_averages.student_average END) AS 'Agriculture'
        FROM student_subject_averages INNER JOIN teaching_loads ON teaching_loads.id=student_subject_averages.teaching_load_id
        INNER JOIN subjects ON teaching_loads.subject_id=subjects.id
        INNER JOIN users ON users.id=student_subject_averages.student_id
        INNER JOIN grades_students ON grades_students.student_id=student_subject_averages.student_id
        INNER JOIN grades ON grades_students.grade_id=grades.id
        INNER JOIN term_averages ON term_averages.student_id=student_subject_averages.student_id
        INNER JOIN student_loads ON student_loads.student_id=term_averages.student_id
        ".$where_clause.""));



if($type_key=="stream_based"){
    $total_passed = DB::table('term_averages')
    ->join('grades', 'term_averages.student_class', '=', 'grades.id')
    ->where('grades.stream_id', $stream)
    ->where('term_averages.term_id', $term)
    ->where('number_of_passed_subjects','>=', $number_of_subjects)
    ->where('student_average','>=',$pass_rate)->count();
}elseif($type_key=="class_based"){
    $total_passed = DB::table('term_averages')
    ->where('student_class', $classofstudent)
    ->where('term_averages.term_id', $term)
    ->where('number_of_passed_subjects','>=', $number_of_subjects)
    ->where('student_average','>=',$pass_rate)->count();

}




    }
    
    
    if($criteria->passing_subject_rule=="1"){
        $scoresheet=DB::select(DB::raw("SELECT 
        student_subject_averages.student_id,
        grades.grade_name,
        users.id as learner_id,
        users.name,
        users.middlename,
        users.lastname,
        term_averages.student_average,
        term_averages.number_of_passed_subjects,
        term_averages.passing_subject_status,
        term_averages.final_term_status,
        CASE WHEN term_averages.number_of_passed_subjects>=".$number_of_subjects." AND term_averages.passing_subject_status<>0 AND term_averages.student_average>=".$pass_rate." THEN 'Passed' ELSE 'Failed' END AS 'remark',
        MAX(CASE WHEN subjects.id=2 THEN student_subject_averages.student_average END) AS 'EnglishLanguage',
        MAX(CASE WHEN subjects.id=3 THEN student_subject_averages.student_average END) AS 'EnglishInLiterature',
        MAX(CASE WHEN subjects.id=5 THEN student_subject_averages.student_average END) AS 'Geography',
        MAX(CASE WHEN subjects.id=6 THEN student_subject_averages.student_average END) AS 'Mathametics',
        MAX(CASE WHEN subjects.id=10 THEN student_subject_averages.student_average END) AS 'Siswati',
        MAX(CASE WHEN subjects.id=12 THEN student_subject_averages.student_average END) AS 'PhysicalScience',
        MAX(CASE WHEN subjects.id=13 THEN student_subject_averages.student_average END) AS 'Biology',
        MAX(CASE WHEN subjects.id=14 THEN student_subject_averages.student_average END) AS 'Science',
        MAX(CASE WHEN subjects.id=15 THEN student_subject_averages.student_average END) AS 'French',
        MAX(CASE WHEN subjects.id=16 THEN student_subject_averages.student_average END) AS 'HomeEconomics',
        MAX(CASE WHEN subjects.id=17 THEN student_subject_averages.student_average END) AS 'BookKeeping',
        MAX(CASE WHEN subjects.id=18 THEN student_subject_averages.student_average END) AS 'BusinessStudies',
        MAX(CASE WHEN subjects.id=19 THEN student_subject_averages.student_average END) AS 'FoodNutrition',
        MAX(CASE WHEN subjects.id=20 THEN student_subject_averages.student_average END) AS 'FashionFabrics',
        MAX(CASE WHEN subjects.id=21 THEN student_subject_averages.student_average END) AS 'Accounting',
        MAX(CASE WHEN subjects.id=22 THEN student_subject_averages.student_average END) AS 'Economics',
        MAX(CASE WHEN subjects.id=23 THEN student_subject_averages.student_average END) AS 'Agriculture',
        MAX(CASE WHEN subjects.id=24 THEN student_subject_averages.student_average END) AS 'AdditionalMathametics',
        MAX(CASE WHEN subjects.id=25 THEN student_subject_averages.student_average END) AS 'ICT',
        MAX(CASE WHEN subjects.id=26 THEN student_subject_averages.student_average END) AS 'RE',
        MAX(CASE WHEN subjects.id=27 THEN student_subject_averages.student_average END) AS 'History',
        MAX(CASE WHEN subjects.subject_code=101 THEN student_subject_averages.student_average END) AS 'DesignTechnology',
        MAX(CASE WHEN subjects.subject_code=102 THEN student_subject_averages.student_average END) AS 'Computer',
        MAX(CASE WHEN subjects.subject_code=103 THEN student_subject_averages.student_average END) AS 'DS',
        MAX(CASE WHEN subjects.subject_code=200 THEN student_subject_averages.student_average END) AS 'GP',
        MAX(CASE WHEN subjects.subject_code=201 THEN student_subject_averages.student_average END) AS 'RM',
        MAX(CASE WHEN subjects.subject_code=76 THEN student_subject_averages.student_average END) AS 'SocialStudies',
        MAX(CASE WHEN subjects.subject_code=77 THEN student_subject_averages.student_average END) AS 'PracticalArts',
        MAX(CASE WHEN subjects.subject_code=78 THEN student_subject_averages.student_average END) AS 'GeneralStudies', 
        MAX(CASE WHEN subjects.subject_code=79 THEN student_subject_averages.student_average END) AS 'Agriculturep', 
        MAX(CASE WHEN subjects.subject_code=710 THEN student_subject_averages.student_average END) AS 'ExpressiveArts',
        MAX(CASE WHEN subjects.subject_code=711 THEN student_subject_averages.student_average END) AS 'ICTp',
        MAX(CASE WHEN subjects.subject_code=713 THEN student_subject_averages.student_average END) AS 'HPE',
        MAX(CASE WHEN subjects.subject_code=714 THEN student_subject_averages.student_average END) AS 'FineArts',
        MAX(CASE WHEN subjects.subject_code=715 THEN student_subject_averages.student_average END) AS 'SoapCraft',
        MAX(CASE WHEN subjects.subject_code=716 THEN student_subject_averages.student_average END) AS 'ShoeCraft',
        MAX(CASE WHEN subjects.subject_code=717 THEN student_subject_averages.student_average END) AS 'HandCraft',
        MAX(CASE WHEN subjects.subject_code=115 THEN student_subject_averages.student_average END) AS 'PrevocICT',
        MAX(CASE WHEN subjects.subject_code=116 THEN student_subject_averages.student_average END) AS 'AgiculturalTechnology',
        MAX(CASE WHEN subjects.subject_code=117 THEN student_subject_averages.student_average END) AS 'BusinessAccounting',
        MAX(CASE WHEN subjects.subject_code=118 THEN student_subject_averages.student_average END) AS 'FoodTextileTechnology',
        MAX(CASE WHEN subjects.subject_code=119 THEN student_subject_averages.student_average END) AS 'TechnicalStudies', 
        MAX(CASE WHEN subjects.subject_code=712 THEN student_subject_averages.student_average END) AS 'ConsumerSciencep',
        MAX(CASE WHEN subjects.subject_code=121 THEN student_subject_averages.student_average END) AS 'Entreprenuership',
        MAX(CASE WHEN subjects.id=23 THEN student_subject_averages.student_average END) AS 'Agriculture'
    
        FROM student_subject_averages INNER JOIN teaching_loads ON teaching_loads.id=student_subject_averages.teaching_load_id
        INNER JOIN subjects ON teaching_loads.subject_id=subjects.id
        INNER JOIN users ON users.id=student_subject_averages.student_id
        INNER JOIN grades_students ON grades_students.student_id=student_subject_averages.student_id
        INNER JOIN grades ON grades_students.grade_id=grades.id
        INNER JOIN term_averages ON term_averages.student_id=student_subject_averages.student_id
        INNER JOIN student_loads ON student_loads.student_id=term_averages.student_id
        ".$where_clause.""));
        

if($type_key=="stream_based"){
    $total_passed = DB::table('term_averages')
    ->join('grades', 'term_averages.student_class', '=', 'grades.id')
    ->where('grades.stream_id', $stream)
    ->where('term_averages.term_id', $term)
    ->where('number_of_passed_subjects','>=', $number_of_subjects)
    ->where('passing_subject_status', 1)
    ->where('student_average','>=',$pass_rate)->count();
}elseif($type_key=="class_based"){
    $total_passed = DB::table('term_averages')
    ->where('student_class', $classofstudent)
    ->where('term_averages.term_id', $term)
    ->where('number_of_passed_subjects','>=', $number_of_subjects)
    ->where('passing_subject_status', 1)
    ->where('student_average','>=',$pass_rate)->count();

}



    }



    if($type_key=="stream_based"){
        $total_progression= DB::table('term_averages')
        ->join('grades', 'term_averages.student_class', '=', 'grades.id')
        ->where('grades.stream_id', $stream)
        ->where('term_averages.term_id', $term)
        ->where('final_term_status', 'Proceed')
        ->count();
    
        $total_promoted= DB::table('term_averages')
        ->join('grades', 'term_averages.student_class', '=', 'grades.id')
        ->where('grades.stream_id', $stream)
        ->where('term_averages.term_id', $term)
        ->where('final_term_status', 'Promoted')
        ->count();
    
        $total_repeat= DB::table('term_averages')
        ->join('grades', 'term_averages.student_class', '=', 'grades.id')
        ->where('grades.stream_id', $stream)
        ->where('term_averages.term_id', $term)
        ->where('final_term_status', 'Repeat')
        ->count();
    
        $total_expelled= DB::table('term_averages')
        ->join('grades', 'term_averages.student_class', '=', 'grades.id')
        ->where('grades.stream_id', $stream)
        ->where('term_averages.term_id', $term)
        ->where('final_term_status', 'Try Another School')
        ->count();
        $title=$stream_title;
        $int=$stream;
    }elseif($type_key=="class_based"){

        $total_progression= DB::table('term_averages')
        ->where('student_class', $classofstudent)
        ->where('term_averages.term_id', $term)
        ->where('final_term_status', 'Proceed')
        ->count();
    
        $total_promoted= DB::table('term_averages')
        ->where('student_class', $classofstudent)
        ->where('term_averages.term_id', $term)
        ->where('final_term_status', 'Promoted')
        ->count();
    
        $total_repeat= DB::table('term_averages')
        ->where('student_class', $classofstudent)
        ->where('term_averages.term_id', $term)
        ->where('final_term_status', 'Repeat')
        ->count();
    
        $total_expelled= DB::table('term_averages')
        ->where('student_class', $classofstudent)
        ->where('term_averages.term_id', $term)
        ->where('final_term_status', 'Try Another School')
        ->count();

        $title=$class_title;
        $int=$classofstudent;

    }

  

$base64="";
  


$total_failed=($total_students-$total_passed);
$pass_rate_percentage=($total_passed/$total_students)*100;
$fail_rate_percentage=($total_failed/$total_students)*100;



   
if ($request->indicator=="summary_scoresheet") {

    
        return view('analytics.term-analytics.summary-scoresheet',compact('scoresheet','stream_title','title', 'section_id', 'term_name', 'pass_rate', 'number_of_subjects', 'term', 'stream', 'tie_type', 'passing_subject_rule', 'indicator', 'total_passed', 'total_students', 'total_failed', 'pass_rate_percentage', 'fail_rate_percentage', 'total_progression', 'total_promoted', 'total_expelled', 'int','total_repeat', 'type_key'));
     
     }


   
     if ($request->indicator=="scoresheet") {


        // dd($tie_type);

      if($school_data->school_type=="primary-school"){
        return view('analytics.term-analytics.view-primary-scoresheet',compact('key','scoresheet','stream_title','title', 'section_id', 'term_name', 'pass_rate', 'number_of_subjects', 'term', 'stream', 'tie_type', 'passing_subject_rule', 'indicator', 'total_passed', 'total_students', 'total_failed', 'pass_rate_percentage', 'fail_rate_percentage', 'total_progression', 'total_promoted', 'total_expelled', 'int','total_repeat','type_key'));
         }else{

            return view('analytics.term-analytics.view',compact('scoresheet','stream_title','title', 'section_id', 'term_name', 'pass_rate', 'number_of_subjects', 'term', 'stream', 'tie_type', 'passing_subject_rule', 'indicator', 'total_passed', 'total_students', 'total_failed', 'pass_rate_percentage', 'fail_rate_percentage', 'total_progression', 'total_promoted', 'total_expelled', 'int','total_repeat','type_key'));

         }
    

     
     
     }

        // if($school_data->school_type=="primary-school"){
        //     return view('analytics.term-analytics.view-primary',compact('scoresheet','stream_title', 'section_id', 'term_name', 'pass_rate', 'number_of_subjects', 'term', 'stream', 'base64', 'tie_type', 'passing_subject_rule', 'indicator')); 
        // }else{
        //     return view('analytics.term-analytics.view',compact('scoresheet','stream_title','title', 'section_id', 'term_name', 'pass_rate', 'number_of_subjects', 'term', 'stream', 'tie_type', 'passing_subject_rule', 'indicator', 'total_passed', 'total_students', 'total_failed', 'pass_rate_percentage', 'fail_rate_percentage', 'total_progression', 'total_promoted', 'total_expelled', 'int','total_repeat'));
        // }

}

// if ($request->indicator=="criteria_promotion") {
//    return view('analytics.term-analytics.criteria_promotion',compact('stream_title', 'section_id', 'term_name', 'pass_rate', 'number_of_subjects', 'term', 'stream', 'base64', 'tie_type', 'passing_subject_rule', 'indicator'));

// }





    }


public function analytics_loads_check($student_id, $assessement_id){
$grades = DB::table('grades_students')
->join('grades', 'grades.id', '=', 'grades_students.grade_id')
->join('users', 'users.id', '=', 'grades_students.student_id')
->where('grades_students.student_id','=', $student_id)
->where('grades_students.active','=', 1)
->first();//remeber to add acaademic year



$non_contributing=Subject::where('subject_type', 'non-value')->first();
$non_value=$non_contributing->id;


$loads=DB::select(DB::raw("SELECT users.salutation, users.name, users.lastname, subjects.subject_name from student_loads INNER JOIN teaching_loads ON teaching_loads.id=student_loads.teaching_load_id INNER JOIN subjects ON subjects.id=teaching_loads.subject_id INNER JOIN users ON users.id=teaching_loads.teacher_id  WHERE  student_loads.student_id=".$student_id." AND teaching_loads.active=1 AND student_loads.active=1 AND subjects.id<> ".$non_value." ORDER BY subject_name ASC"));

$marks=DB::select(DB::raw("SELECT users.salutation, users.name, users.lastname, marks.mark, subjects.subject_name from marks INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id INNER JOIN subjects ON subjects.id=teaching_loads.subject_id  INNER JOIN users ON users.id=marks.teacher_id INNER JOIN student_loads ON student_loads.teaching_load_id=marks.teaching_load_id WHERE marks.assessement_id=".$assessement_id." AND marks.student_id=".$student_id." AND teaching_loads.active=1 AND student_loads.active=1 AND student_loads.student_id=".$student_id." AND subjects.id<> ".$non_value." ORDER BY subject_name ASC"));


    
return view('analytics.scoresheet.ratio', compact('loads', 'marks', 'grades'));

}


public function analytics_loads_checker($student_id){


    $grades = DB::table('grades_students')
    ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
    ->join('users', 'users.id', '=', 'grades_students.student_id')
    ->where('grades_students.student_id','=', $student_id)
    ->where('grades_students.active','=', 1)
    ->first();//remeber to add acaademic year
    
    
    $loads=DB::select(DB::raw("SELECT users.salutation, users.name, users.lastname, subjects.subject_name from student_loads INNER JOIN teaching_loads ON teaching_loads.id=student_loads.teaching_load_id INNER JOIN subjects ON subjects.id=teaching_loads.subject_id INNER JOIN users ON users.id=teaching_loads.teacher_id  WHERE  student_loads.student_id=".$student_id." AND teaching_loads.active=1 ORDER BY subject_name ASC"));
    

    
    
        
    return view('analytics.scoresheet.load-check', compact('loads',  'grades'));
    
    }

    public function settings(){

    }

    public function subject_analytics(Request $request){

        $admin=Auth::user()->hasRole('admin_teacher');
        $teacher=Auth::user()->hasRole('teacher');
        $student=Auth::user()->hasRole('student');
        $parent=Auth::user()->hasRole('parent');

        $grades=Grade::all();
        $sections=Section::all();
        $streams=Stream::all();
        $assessements=Assessement::all();
        $subjects=Subject::all();

        if($admin){
        return view('analytics.subject-analytics', compact('grades', 'sections', 'streams', 'assessements','subjects'));
        }else if($teacher){
            return view('analytics.teacher', compact('grades', 'sections', 'streams', 'assessements'));
        }else if($parent){
            return view('analytics.parent', compact('grades', 'sections', 'streams', 'assessements'));
        }else if($student){
            return view('analytics.student', compact('grades', 'sections', 'streams', 'assessements'));
        }


    }

    public function subject_analytics_view(Request $request){
      //  dd($request->all());
        $hour= date('H');

        if ($hour >= 20) {
            $greetings = "Good Night";
        } elseif ($hour > 17) {
           $greetings = "Good Evening";
        } elseif ($hour > 11) {
            $greetings = "Good Afternoon";
        } elseif ($hour < 12) {
           $greetings = "Good Morning";
        }
      //  dd($request->teaching_load);

    //     $stream_qry = Stream::all();

    //    $stream=$stream_qry->id;

        
        $section=Grade::where('stream_id', $request->stream_name)->first();
        $section_id=$section->section_id;

        $criteria=PassRate::where('section_id', $section_id)->first();
        $pass_rate=$criteria->passing_rate;
      
   
        $passed = DB::table('marks')
        ->join('users', 'marks.student_id', '=', 'users.id')
        ->join('teaching_loads', 'marks.teaching_load_id', '=', 'teaching_loads.id')
        ->join('assessements', 'marks.assessement_id', '=', 'assessements.id')
        ->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
        ->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
        ->where('grades.stream_id', $request->stream_name)
        ->where('assessements.id', $request->assessement)
        ->where('subjects.id', $request->subject)
        ->where('marks.mark','>=', $pass_rate)
        ->orderByDesc('mark')
        ->get();

        //dd($passed);

        $failed = DB::table('marks')
        ->join('users', 'marks.student_id', '=', 'users.id')
        ->join('teaching_loads', 'marks.teaching_load_id', '=', 'teaching_loads.id')
        ->join('assessements', 'marks.assessement_id', '=', 'assessements.id')
        ->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
        ->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
        ->where('grades.stream_id', $request->stream_name)
        ->where('assessements.id', $request->assessement)
        ->where('subjects.id', $request->subject)
        ->where('marks.mark','<', $pass_rate)
        ->orderBy('lastname')
        ->get();

        $total = DB::table('marks')
        ->join('users', 'marks.student_id', '=', 'users.id')
        ->join('teaching_loads', 'marks.teaching_load_id', '=', 'teaching_loads.id')
        ->join('assessements', 'marks.assessement_id', '=', 'assessements.id')
        ->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
        ->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
        ->where('grades.stream_id', $request->stream_name)
        ->where('assessements.id', $request->assessement)
        ->where('subjects.id', $request->subject)
        ->orderBy('lastname')
        ->get()->count();

       // $total=($passed->count()+$failed->count());

        $total_passed=$passed->count();
        $total_failed=$failed->count();

        $subject_pass_rate=round(($passed->count()/$total)*100);
        $subject_fail_rate=round(($failed->count()/$total)*100);

        $assessement_data = DB::table('marks')
        ->join('users', 'marks.student_id', '=', 'users.id')
        ->join('teaching_loads', 'marks.teaching_load_id', '=', 'teaching_loads.id')
        ->join('assessements', 'marks.assessement_id', '=', 'assessements.id')
        ->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
        ->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
        ->where('grades.stream_id', $request->stream_name)
        ->where('assessements.id', $request->assessement)
        ->where('subjects.id', $request->subject)
        ->first();



        
if($request->indicator=="summary"){
$form1A = DB::table('subject_student_averages')
        ->join('grades', 'grades.student_id', '=', 'users.id')
        ->join('teaching_loads', 'marks.teaching_load_id', '=', 'teaching_loads.id')
        ->join('assessements', 'marks.assessement_id', '=', 'assessements.id')
        ->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
        ->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
        ->where('grades.stream_id', $request->stream_name)
        ->where('assessements.id', $request->assessement)
        ->where('subjects.id', $request->subject)
        ->first();
}else{

}

        return view('analytics.view-subject-analytics', compact('assessement_data','greetings','total','subject_pass_rate','subject_fail_rate','passed','failed', 'total_failed','total_passed'));
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



public function class_based(){

        $isAdmin=Auth::user()->hasRole('admin_teacher');
        $isClassteacher=Auth::user()->hasRole('class_teacher');
        // $isStudent=Auth::user()->hasRole('student');
        // $isParent=Auth::user()->hasRole('parent');
        $isSchoolAdmin=Auth::user()->hasRole('school-administrator');

        if($isAdmin OR $isSchoolAdmin){

            $classes=Grade::all();
            $assessements=Assessement::all();
            //reminder->assessement for which academic year?->correct that.

            return view('analytics.class-based.index',compact('classes','assessements'));

        }

        if($isClassteacher){

        }


}

public function class_based_store(Request $request){



            

    $assessement_id=$request->assessement;
    $section=Grade::where('id', $request->grade)->first();
    $section_id=$section->section_id;

    
    $criteria=PassRate::where('section_id', $section_id)->first();
       
    $pass_rate=$criteria->passing_rate;
    $number_of_subjects=$criteria->number_of_subjects;
    $passing_subject_rule=$criteria->passing_subject_rule;
    
    $subject=Subject::where('subject_type','passing_subject')->first();
    $passing_subject=$subject->id;
    
    
      
      //get students
      $students = DB::table('grades_students')
      ->join('users', 'grades_students.student_id', '=', 'users.id')
      ->join('grades', 'grades_students.grade_id', '=', 'grades.id')
      ->where('grades.id', $request->grade)
      ->get()->pluck('student_id');
    
    
    $student_average = [];
    
      foreach ($students as $student ) {
      
       if($criteria->average_calculation=="custom" ){
          
            //if Passing subject rule applies 
           if($criteria->passing_subject_rule=="1"){
    
            //Student Average
        $student_average[]=DB::select(DB::raw("SELECT student_id, round((SUM(t.mark))/".$number_of_subjects.") average_mark ,grade_id, term_id.term, section_id,stream_id,assessement_type, nps.number_of_passed_subjects, prm.passing_subject_status from 
    
        (select marks.student_id,grades.id as grade_id, grades.stream_id, grades.section_id, ROUND(AVG(mark))  as mark  from marks 
        INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id
        INNER JOIN subjects ON subjects.id=teaching_loads.subject_id
        INNER JOIN grades ON grades.id=teaching_loads.class_id
        where marks.student_id = ".$student." AND marks.assessement_id=".$assessement_id." 
        GROUP BY subject_id
        order by (subject_id =".$passing_subject.") desc, mark desc
        LIMIT ".$number_of_subjects.") t, 
        (SELECT count(marks.mark) as number_of_passed_subjects FROM marks INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id  INNER JOIN subjects ON 				subjects.id=teaching_loads.subject_id WHERE  marks.student_id = ".$student." AND marks.assessement_id=".$assessement_id."  AND marks.mark>=".$pass_rate." order by  mark desc
        ) nps, 
        (SELECT COUNT(marks.mark) as passing_subject_status FROM marks INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id INNER JOIN subjects ON subjects.id = teaching_loads.subject_id WHERE marks.student_id = ".$student." AND marks.assessement_id = ".$assessement_id."  AND marks.mark>=".$pass_rate." AND subject_id=".$passing_subject." ) prm,
        
        (SELECT DISTINCT(assessements.term_id) as term, assessements.assessement_type from marks INNER JOIN assessements ON assessements.id=marks.assessement_id WHERE assessements.id=".$assessement_id.") term_id
                 
        ORDER BY round((SUM(t.mark))/".$number_of_subjects.") DESC"));
    
                
    
            }else if($criteria->passing_subject_rule=="0"){
                
    
                $student_average[]=DB::select(DB::raw("SELECT student_id, round((SUM(t.mark))/".$number_of_subjects.")  average_mark ,grade_id,assessement_type, term_id.term, section_id,stream_id, nps.number_of_passed_subjects, prm.passing_subject_status from 
    
                (select marks.student_id,grades.id as grade_id, grades.stream_id, grades.section_id, ROUND(AVG(mark))  as mark  from marks 
                                INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id
                                INNER JOIN subjects ON subjects.id=teaching_loads.subject_id
                                INNER JOIN grades ON grades.id=teaching_loads.class_id
                                where marks.student_id = ".$student." AND marks.assessement_id=".$assessement_id." 
                            GROUP BY subject_id
                            order by  mark desc
                            LIMIT ".$number_of_subjects.") t, 
                            (SELECT count(marks.mark) as number_of_passed_subjects FROM marks INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id  INNER JOIN subjects ON subjects.id=teaching_loads.subject_id WHERE  marks.student_id = ".$student." AND marks.assessement_id=".$assessement_id." AND marks.mark>=".$pass_rate." order by  mark desc
                           ) nps, 
                           (SELECT COUNT(marks.mark) as passing_subject_status FROM marks INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id INNER JOIN subjects ON subjects.id = teaching_loads.subject_id WHERE marks.student_id = ".$student." AND marks.assessement_id = ".$assessement_id." AND marks.mark>=".$pass_rate." AND subject_id=".$passing_subject." ) prm,
                           
                           (SELECT DISTINCT(assessements.term_id) as term, assessements.assessement_type from marks INNER JOIN assessements ON assessements.id=marks.assessement_id WHERE assessements.id=".$assessement_id.") term_id
                     
                           
                 ORDER BY round((SUM(t.mark))/".$number_of_subjects.") DESC"));
    
            }
           
      
    }else if($criteria->average_calculation=="default"){
    
        $total_subjects=StudentLoad::where('student_id', $student)->count();
        //remember to add academic year for student_loads
    
        $student_average[]=DB::select(DB::raw("SELECT student_id, round(SUM(t.mark)/".$total_subjects.") as average_mark ,grade_id, term_id.term,assessement_type, section_id,stream_id, nps.number_of_passed_subjects, prm.passing_subject_status from 
        (select marks.student_id,grades.id as grade_id, grades.stream_id, grades.section_id, ROUND(AVG(mark))  as mark  from marks 
                       INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id
                      INNER JOIN subjects ON subjects.id=teaching_loads.subject_id
                      INNER JOIN grades ON grades.id=teaching_loads.class_id
                      where marks.student_id =".$student." AND marks.assessement_id=".$assessement_id."  
              GROUP BY subject_id 
            ) t, 
                  (SELECT count(marks.mark) as number_of_passed_subjects FROM marks INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id  INNER JOIN subjects ON subjects.id=teaching_loads.subject_id WHERE  marks.student_id = ".$student."  AND marks.assessement_id=".$assessement_id."  AND marks.mark>=".$pass_rate."  order by  mark desc
                 ) nps, 
                 (SELECT COUNT(marks.mark) as passing_subject_status FROM marks INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id INNER JOIN subjects ON subjects.id = teaching_loads.subject_id WHERE marks.student_id =".$student."  AND marks.assessement_id =".$assessement_id." AND marks.mark>=".$pass_rate."  AND subject_id=".$passing_subject.") prm,
    
                 (SELECT DISTINCT(assessements.term_id) as term, assessements.assessement_type from marks INNER JOIN assessements ON assessements.id=marks.assessement_id WHERE assessements.id=".$assessement_id." ) term_id"));
    
    }
    
    
      }
      //End of foreach loop
    
    
    

      //add to database//
    foreach($student_average as $student_assessement_data){
        for ($i=0; $i <count($student_assessement_data) ; $i++) { 
    
            $studentMarkExists=AssessementProgressReport::where('assessement_id',$assessement_id)->where('student_id',$student_assessement_data[$i]->student_id)->where('student_class',$student_assessement_data[$i]->grade_id)->exists();
   
            if($studentMarkExists){
    
            $student_update=AssessementProgressReport::where('student_id',$student_assessement_data[$i]->student_id)
            ->where('assessement_id', $assessement_id)
            ->where('student_class', $student_assessement_data[$i]->grade_id)
            ->update([
            'student_average' => $student_assessement_data[$i]->average_mark,
            'number_of_passed_subjects' => $student_assessement_data[$i]->number_of_passed_subjects,
            'passing_subject_status' => $student_assessement_data[$i]->passing_subject_status,
            ]);


            // dd($student_update);
                
            }else{
    
                $student_data = AssessementProgressReport::create([
                    'assessement_id'=>$assessement_id,
                    'student_id'=>$student_assessement_data[$i]->student_id,
                    'student_average'=>$student_assessement_data[$i]->average_mark,
                    'student_class'=>$student_assessement_data[$i]->grade_id,
                    'term_id'=>$student_assessement_data[$i]->term,
                    'assessement_type'=>$student_assessement_data[$i]->assessement_type,
                    'student_section'=>$student_assessement_data[$i]->section_id,
                    'student_stream'=>$student_assessement_data[$i]->stream_id,
                    'number_of_passed_subjects'=>$student_assessement_data[$i]->number_of_passed_subjects,
                    'passing_subject_status'=>$student_assessement_data[$i]->passing_subject_status,
                    
                        ]);
            }
    
        }
    
    }

    //For optimization try to consolidate the data into one or two queries.//
    
    $assessement_student_data= DB::table('assessement_progress_reports')
             
                ->where('student_class', $request->grade)
                ->where('assessement_id', $request->assessement)
                ->get();
             

               //dd($assessement_student_data[0]);
               $title=DB::table('assessement_progress_reports')
               ->join('grades', 'grades.id', '=', 'assessement_progress_reports.student_class')
               ->join('assessements', 'assessements.id', '=', 'assessement_progress_reports.assessement_id')
               ->where('student_class', $request->grade)
              ->where('assessement_id', $request->assessement)
              ->select('grade_name','assessement_name')
               ->first();
               
    
      //Get passed students
     $assessement_data_passed_students= DB::table('assessement_progress_reports')
            ->join('grades', 'grades.id', '=', 'assessement_progress_reports.student_class')
            ->join('users', 'users.id', '=', 'assessement_progress_reports.student_id')
            ->where('student_class', $request->grade)
            ->where('assessement_id', $request->assessement)
            ->where('student_average','>=',$pass_rate )
            ->where('number_of_passed_subjects','>=',$number_of_subjects)
            ->where('passing_subject_status','=',1)
            ->select('profile_photo_path','grade_name', 'name', 'lastname', 'middlename', 'number_of_passed_subjects','passing_subject_status','student_average')
            ->orderByDesc('student_average')
            ->orderByDesc('number_of_passed_subjects')   
            ->get();

           

            $student_list= DB::table('assessement_progress_reports')
            ->join('grades', 'grades.id', '=', 'assessement_progress_reports.student_class')
            ->join('users', 'users.id', '=', 'assessement_progress_reports.student_id')
            ->where('student_class', $request->grade)
            ->where('assessement_id', $request->assessement)
            ->select('profile_photo_path','grade_name', 'name', 'lastname', 'middlename', 'number_of_passed_subjects','passing_subject_status','student_average')
            ->orderByDesc('student_average')   
            ->get();


            //Number of Passed students
            $assessement_data_passed_students_count= $assessement_data_passed_students->count();
    
            //students who failed number of subjects only//
            $assessement_data_failed_students_passing_subject_only= DB::table('assessement_progress_reports')
            ->join('grades', 'grades.id', '=', 'assessement_progress_reports.student_class')
            ->join('users', 'users.id', '=', 'assessement_progress_reports.student_id')
            ->where('student_class', $request->grade)
            ->where('assessement_id', $request->assessement)
            ->where('student_average','>=',$pass_rate )
            ->where('number_of_passed_subjects','>=',$number_of_subjects)
            ->where('passing_subject_status','=',0)
            ->select('profile_photo_path','grade_name', 'name', 'lastname', 'middlename', 'number_of_passed_subjects','passing_subject_status','student_average')
            ->get();

           // dd($assessement_data_failed_students_passing_subject_only);
            //number of students who failed number of subjects only//
            $assessement_data_failed_students_passing_subject_only_count=$assessement_data_failed_students_passing_subject_only->count();
    

            //student who failed based on number of subjects only//
            $assessement_data_failed_students_number_of_subjects_only= DB::table('assessement_progress_reports')
            ->join('grades', 'grades.id', '=', 'assessement_progress_reports.student_class')
            ->join('users', 'users.id', '=', 'assessement_progress_reports.student_id')
            ->where('student_class', $request->grade)
            ->where('assessement_id', $request->assessement)
            ->where('student_average','>=',$pass_rate )
            ->where('number_of_passed_subjects','<',$number_of_subjects)
            ->where('passing_subject_status','=',1)
            ->select('profile_photo_path','grade_name', 'name', 'lastname', 'middlename', 'number_of_passed_subjects','passing_subject_status','student_average')
            ->get();

            //Number of students who failed based on number of subjects only//
            $assessement_data_failed_students_number_of_subjects_only_count=$assessement_data_failed_students_number_of_subjects_only->count();
    
    
    
            $assessement_data_failed_students_average_only= DB::table('assessement_progress_reports')
            ->join('grades', 'grades.id', '=', 'assessement_progress_reports.student_class')
            ->join('users', 'users.id', '=', 'assessement_progress_reports.student_id')
            ->where('student_class', $request->grade)
            ->where('assessement_id', $request->assessement)
            ->where('student_average','<',$pass_rate )
            ->select('profile_photo_path','grade_name', 'name', 'lastname', 'middlename', 'number_of_passed_subjects','passing_subject_status','student_average')
            ->get();
    
            $assessement_data_failed_students_average_only_count=$assessement_data_failed_students_average_only->count();
    
            $assessement_data_failed_students_triple= DB::table('assessement_progress_reports')
            ->join('grades', 'grades.id', '=', 'assessement_progress_reports.student_class')
            ->join('users', 'users.id', '=', 'assessement_progress_reports.student_id')
            ->where('student_class', $request->grade)
            ->where('assessement_id', $request->assessement)
            ->where('student_average','<',$pass_rate )
            ->where('number_of_passed_subjects','<',$number_of_subjects)
            ->where('passing_subject_status','=',0)
            ->select('profile_photo_path','grade_name', 'name', 'lastname', 'middlename', 'number_of_passed_subjects','passing_subject_status','student_average')
            ->orderBy('student_average','asc')
            ->get();
           
            $assessement_data_failed_students_triple_count= $assessement_data_failed_students_triple->count();
    
            $flex_mode= DB::table('assessement_progress_reports')
            ->join('grades', 'grades.id', '=', 'assessement_progress_reports.student_class')
            ->join('users', 'users.id', '=', 'assessement_progress_reports.student_id')
            ->where('student_class', $request->grade)
            ->where('assessement_id', $request->assessement)
            ->where('student_average','>=',$pass_rate )
            ->select('profile_photo_path','grade_name', 'name', 'lastname', 'middlename', 'number_of_passed_subjects','passing_subject_status','student_average')
            ->orderByDesc('student_average')
            ->orderByDesc('number_of_passed_subjects')
            ->orderByDesc('passing_subject_status')
            ->get();
    
            $flex_mode_count=$flex_mode->count();
    
    
            //Statistics
            $total_students= DB::table('assessement_progress_reports')
            ->where('student_class', $request->grade)
            ->where('assessement_id', $request->assessement)
            ->count();
            
            //Pass Rates
           $clean_pass_rate=round(($assessement_data_passed_students_count/$total_students)*100);
           $avg_pass_rate=round(($flex_mode_count/$total_students)*100);
    
           $grade_qry=Grade::find($request->grade);
           $name_of_stream=$grade_qry->grade_name;
    
           $assessement_qry=Assessement::find($request->assessement);
           $name_of_assessement=$assessement_qry->assessement_name;
    

        //pass analysis
        $class_breakdown_clean_passes=DB::select(DB::raw("SELECT
        grades.grade_name as label,
        COUNT(*) AS value
    FROM
        assessement_progress_reports
    RIGHT JOIN grades ON grades.id = assessement_progress_reports.student_class
    WHERE
    
        assessement_progress_reports.student_average >= ".$pass_rate." AND assessement_progress_reports.number_of_passed_subjects>=".$number_of_subjects." AND assessement_progress_reports.passing_subject_status=1 AND  assessement_progress_reports.assessement_id = ".$assessement_id."  AND assessement_progress_reports.student_class =".$request->grade."
    GROUP BY
        assessement_progress_reports.student_class"));
      
      //  return view('analytics.view-pass',compact('flex_mode','flex_mode_count','assessement_data_passed_students','assessement_data_passed_students_count','clean_pass_rate','avg_pass_rate','key','total_students', 'name_of_stream', 'name_of_assessement','class_breakdown_clean_passes','pass_rate','number_of_subjects'));   

        //failure analysis
            //Fail Rates
            $triple_factor_fail_rate=round(($assessement_data_failed_students_triple_count/$total_students)*100);
            $passing_subject_only_fail_rate=round(($assessement_data_failed_students_passing_subject_only_count/$total_students)*100);
            $number_of_subjects_only_fail_rate=round(($assessement_data_failed_students_number_of_subjects_only_count/$total_students)*100);
            $average_fail_rate=round((($assessement_data_failed_students_average_only)->count()/$total_students)*100);
    
            $class_breakdown=DB::select(DB::raw("SELECT
            grades.grade_name as label,
            COUNT(*) AS value
        FROM
            assessement_progress_reports
        RIGHT JOIN grades ON grades.id = assessement_progress_reports.student_class
        WHERE
            assessement_progress_reports.student_average < ".$pass_rate." AND assessement_progress_reports.number_of_passed_subjects<".$number_of_subjects." AND assessement_progress_reports.passing_subject_status=0  AND  assessement_progress_reports.assessement_id = ".$assessement_id."  AND assessement_progress_reports.student_class =".$request->grade."
        GROUP BY
            assessement_progress_reports.student_class"));
    
            
            $assessement_data_failed_students_number_of_subjects_only_number_of_subjects= DB::table('assessement_progress_reports')
            ->join('grades', 'grades.id', '=', 'assessement_progress_reports.student_class')
            ->join('users', 'users.id', '=', 'assessement_progress_reports.student_id')
            ->where('student_class', $request->grade)
            ->where('assessement_id', $request->assessement)
            ->where('student_average','>=',$pass_rate )
            ->where('number_of_passed_subjects','<',$number_of_subjects)
            ->where('passing_subject_status','=',0)
            ->select('profile_photo_path','grade_name', 'name', 'lastname', 'middlename', 'number_of_passed_subjects','passing_subject_status','student_average')
            ->get();
            $assessement_data_failed_students_number_of_subjects_only_number_of_subjects_count=$assessement_data_failed_students_number_of_subjects_only_number_of_subjects->count();
    
            $class_breakdown_json=json_encode($class_breakdown);
   
        return view('analytics.class-based.view-analytics', compact('title','flex_mode','flex_mode_count','assessement_data_passed_students','assessement_data_passed_students_count','assessement_data_failed_students_triple','assessement_data_failed_students_triple_count','assessement_data_failed_students_average_only','assessement_data_failed_students_average_only_count','assessement_data_failed_students_number_of_subjects_only_count','assessement_data_failed_students_number_of_subjects_only','assessement_data_failed_students_passing_subject_only_count','average_fail_rate','triple_factor_fail_rate', 'name_of_stream', 'name_of_assessement', 'total_students', 'class_breakdown','assessement_data_failed_students_number_of_subjects_only_number_of_subjects_count', 'class_breakdown_json','clean_pass_rate','avg_pass_rate','student_list','pass_rate','number_of_subjects'));   
     
    
    


}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Analytics  $analytics
     * @return \Illuminate\Http\Response
     */
    public function show(Analytics $analytics)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Analytics  $analytics
     * @return \Illuminate\Http\Response
     */
    public function edit(Analytics $analytics)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Analytics  $analytics
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Analytics $analytics)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Analytics  $analytics
     * @return \Illuminate\Http\Response
     */
    public function destroy(Analytics $analytics)
    {
        //
    }
}
