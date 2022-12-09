<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Mark;
use App\Models\Term;
use App\Models\Grade;
use App\Models\Report;
use App\Models\School;
use App\Models\Stream;
use App\Models\Section;
use App\Models\Subject;
use App\Models\PassRate;
use App\Models\Assessement;
use App\Models\StudentLoad;
use App\Models\TermAverage;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\CommentSetting;
use App\Models\SubjectAverage;
use App\Models\AssessementWeight;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentSubjectAverage;
use Illuminate\Support\Facades\Schema;
use App\Models\AssessementProgressReport;
use App\Models\CA_Exam;
use App\Models\ReportTemplate;
use App\Models\ReportVariable;
use Google\Service\CloudAsset\Asset;
use Maatwebsite\Excel\Concerns\ToArray;

use function PHPUnit\Framework\isFalse;
use function PHPUnit\Framework\isTrue;

ini_set('max_execution_time', 400);

class ReportController extends Controller
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
        
        return view('academic-admin.reports-management.term.index', compact('terms','streams','classes','sections','templates','variables'));

    }

    public function class_index()


    {
        //Terms

        $terms=DB::table('terms')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'terms.academic_session')
      
        ->select('terms.id as term_id','terms.term_name', 'academic_sessions.academic_session')
        ->get();

        //Scope to current session ....think about it.

        //Streams
        $streams=Stream::all();

        //Classes
        $classes=Grade::all();

        //Section
        $sections=Section::all();

        $assessements=DB::table('assessements')
        ->join('terms','terms.id','=','assessements.term_id')
        ->join('assessement_types','assessement_types.id','=','assessements.assessement_type')
        ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
        ->where('academic_sessions.active', 1 )//
        ->select('assessements.id as assessement_id','terms.term_name', 'assessement_name', 'assessement_type_name')
        ->get();
        
        $templates=ReportTemplate::all();

        $variables=ReportVariable::all();

        return view('academic-admin.reports-management.term.index_class', compact('terms','streams','classes','sections', 'assessements', 'templates'));

    }

    public function classteacher_index(){
        $terms=DB::table('terms')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'terms.academic_session')
      
        ->select('terms.id as term_id','terms.term_name', 'academic_sessions.academic_session')
        ->get();

        //Scope to current session ....think about it.

        //Streams
        $streams=Stream::all();

        //Classes
        $classes=DB::table('grades_teachers')
        ->join('grades','grades.id','=','grades_teachers.grade_id')
        ->where('teacher_id',Auth::user()->id )//
        ->select('grades.id as id','grades.grade_name')
        ->get();

        //Section
        $sections=Section::all();

        $assessements=DB::table('assessements')
        ->join('terms','terms.id','=','assessements.term_id')
        ->join('assessement_types','assessement_types.id','=','assessements.assessement_type')
        ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
        ->where('academic_sessions.active', 1 )//
        ->select('assessements.id as assessement_id','terms.term_name', 'assessement_name', 'assessement_type_name')
        ->get();
        
        return view('academic-admin.reports-management.term.index_class', compact('terms','streams','classes','sections', 'assessements'));
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    public function section(Request $request){
      

    $section=$request->section;
    $position_type=$request->position_type;

    if($position_type=="stream_based"){
        
        //Retrieve data from AssessementTAble

        //if it does not existA

    }


    }


   

    public function stream(Request $request){

    
      //validation

//Work flow for generating reports

      //1. Get the number of tests for term and the tests assigned to that term//
      //2. Get the criteria for subject average calculation
      //3. Get the criteria for term average calculation
      //4. Calculate subject average based on criteria
      //5. Calculate term average based on criteria (subject average)
      //6. Return view with data.

//House Keeping
      //1. Validation of data
      //2. If data is missing alert teacher
      
//In summary do this;
//1. Calculate subject average
//2. Calculate Term average
//3. Store Upsert to database

    
        //Validation of form data


        if($request->exists('grade')){

            $classofstudent=$request->grade;
            $getstream=Grade::find($classofstudent);
            $stream=$getstream->stream_id;
           
            $p_key="class_based";

            $validation=$request->validate([
                'grade'=>'required',
                'term'=>'required',
                'report_template'=>'required',
             
    
            ]);
            
        
        }else{
            $stream=$request->stream;
            $p_key="stream_based";

            $validation=$request->validate([
                'stream'=>'required',
                'term'=>'required',
                'report_template'=>'required',
             
    
            ]);
        }
       

     $template_id=$request->report_template;
     $term=$request->term;


   
     

     $report_template=ReportTemplate::where('id',$template_id)->first();

     if(is_null($report_template)){
        flash()->overlay('<i class="fas fa-exclamation-circle text-danger"></i> Error. Please add create template. To do so, please go to settings , then Report Settings and lastly Report Templates');
        return redirect()->back();

     }

     $variables=ReportVariable::all();
      
  

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
            $subject_non_value=Subject::where('subject_type','non-value')->first();
            $non_value_subject=$subject_non_value->id;
            $non_value_subject_name=$subject_non_value->subject_name;

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
        if($p_key=="stream_based"){
            $students = DB::table('grades_students')
            ->join('users', 'grades_students.student_id', '=', 'users.id')
            ->join('grades', 'grades_students.grade_id', '=', 'grades.id')
            ->join('academic_sessions', 'grades_students.academic_session', '=', 'academic_sessions.id')
            ->where('grades.stream_id', $stream)
            ->where('grades_students.active', 1)
            ->where('users.active', 1)
            ->get()->pluck('student_id');
        }
        if($p_key=="class_based"){
            $students = DB::table('grades_students')
            ->join('users', 'grades_students.student_id', '=', 'users.id')
            ->join('academic_sessions', 'grades_students.academic_session', '=', 'academic_sessions.id')
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



       
       if($p_key=="stream_based"){

        $total_students = DB::table('grades_students')
        ->join('grades', 'grades_students.grade_id', '=', 'grades.id')
        ->join('users', 'grades_students.student_id', '=', 'users.id')
        ->join('streams', 'streams.id', '=', 'grades.stream_id')
        ->where('grades.stream_id', $stream)
        ->where('grades_students.active', 1)
        ->where('users.active', 1)
        ->get()->count('grades_students.student_id');
       }else{
        $total_students = DB::table('grades_students')
        ->join('grades', 'grades_students.grade_id', '=', 'grades.id')
        ->join('users', 'grades_students.student_id', '=', 'users.id')
        ->join('streams', 'streams.id', '=', 'grades.stream_id')
        ->where('grades.id', $classofstudent)
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
    assessements.term_id as term_id,
    teaching_loads.class_id as student_class,
    teaching_loads.id as teaching_load_id,
    (AVG(CASE WHEN  c_a__exams.term_id=".$term." AND c_a__exams.assign_as = 'CA' THEN marks.mark END))AS ca,
    (AVG(CASE WHEN  c_a__exams.term_id=".$term." AND c_a__exams.assign_as = 'Examination' THEN marks.mark END))AS exam,
    (AVG(CASE WHEN  c_a__exams.term_id=".$term." AND c_a__exams.assign_as = 'CA' THEN (marks.mark)*".$ca_weight." END))AS ca_weight,
    (AVG( CASE WHEN  c_a__exams.term_id=".$term." AND c_a__exams.assign_as = 'Examination' THEN (marks.mark)*".$exam_weight." END)) as exam_weight
    FROM
    marks
    INNER JOIN c_a__exams ON c_a__exams.assessement_id = marks.assessement_id
    INNER JOIN assessements ON assessements.id = marks.assessement_id
    INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id
    INNER JOIN subjects ON subjects.id = teaching_loads.subject_id
    WHERE marks.student_id = ".$student." AND `assessements`.`term_id` = ".$term." AND marks.active=1
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
            'student_average' =>(round(($item->ca_weight)+($item->exam_weight))),
            'student_class'  =>$item->student_class,
            'student_key' =>$item->student_id.'-'.$item->term_id.'-'.$item->subject_id,
                ];
            })->toArray(), ['student_key'], ['ca_average','exam_mark', 'student_average', 'position','student_class']);
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
    where student_subject_averages.student_id = ".$student." AND student_subject_averages.term_id=".$term." AND student_subject_averages.subject_id <> ".$non_value_subject."
    GROUP BY student_subject_averages.subject_id
    ORDER BY (student_subject_averages.subject_id =".$passing_subject.") desc, mark desc
    LIMIT ".$number_of_subjects.") t, 
    (SELECT
            COUNT(student_subject_averages.student_average) AS number_of_passed_subjects
            FROM
            student_subject_averages
            WHERE
            student_subject_averages.student_id =".$student."  AND student_subject_averages.term_id =".$term." AND student_subject_averages.student_average >=".$pass_rate." AND student_subject_averages.subject_id <> ".$non_value_subject."
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
                    where student_subject_averages.student_id = ".$student." AND student_subject_averages.term_id=".$term." AND student_subject_averages.subject_id <> ".$non_value_subject."
                    GROUP BY student_subject_averages.subject_id
                    ORDER BY  mark desc
                    LIMIT ".$number_of_subjects.") t, 
                    (SELECT
                            COUNT(student_subject_averages.student_average) AS number_of_passed_subjects
                            FROM
                            student_subject_averages
                            WHERE
                            student_subject_averages.student_id =".$student."  AND student_subject_averages.term_id =".$term." AND student_subject_averages.student_average >=".$pass_rate." AND student_subject_averages.subject_id <> ".$non_value_subject."
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
            ->where('subjects.subject_type','<>', 'non-value')
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
            WHERE student_subject_averages.student_id = ".$student." AND student_subject_averages.term_id = ".$term." AND student_subject_averages.subject_id <> ".$non_value_subject."
            GROUP BY
            student_subject_averages.id
        ) t,
        (
            SELECT
            COUNT(student_subject_averages.student_average) AS number_of_passed_subjects
            FROM
            student_subject_averages
            WHERE
            student_subject_averages.student_id =".$student." AND student_subject_averages.term_id =".$term." AND student_subject_averages.student_average >= ".$pass_rate." AND student_subject_averages.subject_id <> ".$non_value_subject."
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
            student_id = ".$student."
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
              })->toArray(), ['student_key'], ['student_average','number_of_passed_subjects', 'passing_subject_status','student_class']);
  

      
          
    $school_info=School::all();
    $comments = DB::table('report_comments')->where('section_id',$section_id)->where('user_type', 1)->get();
    $class_teacher_comments = DB::table('report_comments')->where('section_id',$section_id)->where('user_type', 2)->get();   
    $headteacher_comments = DB::table('report_comments')->where('section_id',$section_id)->where('user_type', 3)->get();          
        
    $examExists=AssessementWeight::where('term_id', $term)->where('exam_percentage', '<>', '0')->where('stream_id',$stream )->exists();
    $caExists=AssessementWeight::where('term_id', $term)->where('ca_percentage', '<>', '0')->where('stream_id',$stream )->exists();

    $noExam=AssessementWeight::where('term_id', $term)->where('exam_percentage', '0')->where('stream_id',$stream )->exists();
    $noCA=AssessementWeight::where('term_id', $term)->where('ca_percentage', '0')->where('stream_id',$stream )->exists();
    

    $calculation_type=$criteria->average_calculation;


    
return view('academic-admin.reports-management.term.report', compact('report', 'students', 'school_info', 'comments', 'pass_rate', 'stream','number_of_subjects', 'class_teacher_comments', 'total_students', 'total_subjects','headteacher_comments','term','term_average_type', 'number_of_decimal_places','tie_type','passing_subject_rule','examExists', "p_key", 'school_is', 'ca_weight', 'exam_weight', 'calculation_type', 'non_value_subject_name', 'report_template', 'section_id','variables','get_academic_session'));   
 }



    public function class(Request $request){
        dd($request->all());
    }

    public function student(Request $request){
        dd($request->all());
    }

    public function open_day_report_index(){

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

        $teaching_loads = DB::table('teaching_loads')
				->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
				->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
				->where('teaching_loads.teacher_id', Auth::user()->id)
				->select('grade_name', 'subject_name', 'teaching_loads.id as teaching_load_id')
				->get();

                return view('academic-admin.reports-management.openday.index', compact('greetings','teaching_loads'));


    }

    public function open_day_report_process (Request $request){

        $list=DB::select(DB::raw("SELECT
        student_loads.student_id,
        users.name,
        users.id as student_id,
        users.middlename,
        users.lastname,
        student_loads.teaching_load_id,
        subjects.subject_name,
        grades.grade_name,
        (SELECT marks.mark from marks WHERE  teaching_load_id= student_loads.teaching_load_id AND marks.assessement_id=1 AND student_id=users.id) AS test1,
         (SELECT marks.mark from marks WHERE  teaching_load_id= student_loads.teaching_load_id AND marks.assessement_id=2 AND student_id=users.id) AS test2,
      (SELECT round(AVG(marks.mark)) from marks WHERE  teaching_load_id= student_loads.teaching_load_id AND student_id=users.id) AS average
       FROM
           student_loads
           INNER JOIN users ON users.id=student_loads.student_id
           INNER JOIN grades_students ON grades_students.student_id=student_loads.student_id
           INNER JOIN teaching_loads ON teaching_loads.id=student_loads.teaching_load_id
           INNER JOIN grades ON grades.id=teaching_loads.class_id
           INNER JOIN subjects ON subjects.id=teaching_loads.subject_id  
           WHERE student_loads.teaching_load_id=".$request->teaching_load." 
       ORDER BY average DESC"));

       return view('academic-admin.reports-management.openday.report', compact('list'));

    }

    public function assessement_based_index(){

        $assessements=DB::table('assessements')
        ->join('terms', 'terms.id', '=', 'assessements.term_id')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'terms.academic_session')
        ->where('academic_sessions.academic_session','=',date('Y'))
        ->select('assessements.assessement_name','assessements.id as assessement_id', 'terms.id as term_id','terms.term_name', 'academic_sessions.academic_session')
        ->get();

    

        //Streams
        $streams=Stream::all();

        //Classes
        $classes=Grade::all();

        //Section
        $sections=Section::all();
        
        return view('academic-admin.reports-management.assessement.index', compact('assessements','streams','classes','sections'));

    }


    public function generate_assessement_report(Request $request){
       
        //Step 1- Validate Request
        $validation=$request->validate([
            'stream'=>'required',
            'assessement'=>'required',
            'position_type'=>'required',

        ]);

$section=Grade::where('stream_id', $request->stream)->first();

$assessement_id=$request->assessement;
$section_id=$section->section_id;

//Get pass_rate
$criteria=PassRate::where('section_id', $section_id)->first();
   
//Pass rate variables
$pass_rate=$criteria->passing_rate;
$number_of_subjects=$criteria->number_of_subjects;
$passing_subject_rule=$criteria->passing_subject_rule;

$subject=Subject::where('subject_type','passing_subject')->first();
$passing_subject=$subject->id;

$stream_is=Stream::where('id',$request->stream)->first();
$stream_title=$stream_is->stream_name;

$getAssessement=Assessement::find($assessement_id);

$assessement_name=$getAssessement->assessement_name;



        //Get students
        $students = DB::table('grades_students')
        ->join('users', 'grades_students.student_id', '=', 'users.id')
        ->join('grades', 'grades_students.grade_id', '=', 'grades.id')
        ->where('grades.stream_id', $request->stream)
        ->get()->pluck('student_id');
      
   

      
       // $student_average = [];
         //Get Students
foreach ($students as $student) {

#Calculate Student Mark for each student


if($criteria->average_calculation=="custom" ){

    //if Passing subject rule applies 
          if($criteria->passing_subject_rule=="1"){
   
           //Student AVERAGE
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
                           (SELECT count(marks.mark) as number_of_passed_subjects FROM marks INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id  INNER JOIN subjects ON 				subjects.id=teaching_loads.subject_id WHERE  marks.student_id = ".$student." AND marks.assessement_id=".$assessement_id." AND marks.mark>=".$pass_rate." order by  mark desc
                          ) nps, 
                          (SELECT COUNT(marks.mark) as passing_subject_status FROM marks INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id INNER JOIN subjects ON subjects.id = teaching_loads.subject_id WHERE marks.student_id = ".$student." AND marks.assessement_id = ".$assessement_id." AND marks.mark>=".$pass_rate." AND subject_id=".$passing_subject." ) prm,
                          
                          (SELECT DISTINCT(assessements.term_id) as term, assessements.assessement_type from marks INNER JOIN assessements ON assessements.id=marks.assessement_id WHERE assessements.id=".$assessement_id.") term_id
                    
                          
                ORDER BY round((SUM(t.mark))/".$number_of_subjects.") DESC"));
   
           }
          
     
   }else if($criteria->average_calculation=="default"){
   
       $total_subjects=StudentLoad::where('student_id', $student)->count();
     
       $total_marks=Mark::where('student_id', $student)->where('assessement_id', $assessement_id)->count();
   
       if($total_marks>$total_subjects){
           //More marks than teaching loads
           //->Probably deleted loads & left mark
   
           $loads=DB::select(DB::raw(" SELECT teaching_load_id  FROM marks  WHERE teaching_load_id NOT IN (SELECT student_loads.teaching_load_id FROM student_loads WHERE student_id=".$student.") AND student_id=".$student.""));
   
           
           if(!is_null($loads)){
               foreach($loads as $load){
       
                   $insert_load = StudentLoad::create([
                       'student_id'=>$student,
                       'teaching_load_id'=>$load->teaching_load_id,
               
                           ]);
               
               }
   
           }
              
   
       }
   
     
       $student_average[]=DB::select(DB::raw("SELECT student_id, round(SUM(t.mark)/".$total_subjects.") as average_mark ,grade_id, term_id.term,assessement_type, section_id,stream_id, nps.number_of_passed_subjects, prm.passing_subject_status,lmr.marks_count, lmr.loads_count  from 
       (select marks.student_id,grades.id as grade_id, grades.stream_id, grades.section_id, marks.mark  as mark  from marks 
   INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id
   INNER JOIN subjects ON subjects.id=teaching_loads.subject_id
   INNER JOIN grades ON grades.id=teaching_loads.class_id
   where marks.student_id =".$student." AND marks.assessement_id=".$assessement_id." 
             GROUP BY marks.id 
           ) t, 
                 (SELECT count(marks.mark) as number_of_passed_subjects FROM marks INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id  INNER JOIN subjects ON subjects.id=teaching_loads.subject_id WHERE  marks.student_id = ".$student."  AND marks.assessement_id=".$assessement_id."  AND marks.mark>=".$pass_rate."  order by  mark desc
                ) nps, 
                (SELECT COUNT(marks.mark) as passing_subject_status FROM marks INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id INNER JOIN subjects ON subjects.id = teaching_loads.subject_id WHERE marks.student_id =".$student."  AND marks.assessement_id =".$assessement_id." AND marks.mark>=".$pass_rate."  AND subject_id=".$passing_subject.") prm,
   
                (SELECT (SELECT COUNT(*) from marks  where student_id=".$student." and marks.assessement_id=".$assessement_id." ) as marks_count, (SELECT COUNT(*) from student_loads  where student_id=".$student."  ) as loads_count
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
   
   $subjects=[];
// foreach ($students as $student) {
//     $subjects[]=DB::select(DB::raw("SELECT 
//     marks.student_id,
//     grades.grade_name,
//     users.name,
//     users.middlename,
//     users.lastname,
//     marks.mark,
//     assessement_progress_reports.student_average,   
//     assessement_progress_reports.number_of_passed_subjects, 
//     assessement_progress_reports.passing_subject_status, 
//     subjects.subject_name,
//     loads_count, 
//     marks_count,
//     CASE WHEN assessement_progress_reports.number_of_passed_subjects>=".$number_of_subjects." AND assessement_progress_reports.passing_subject_status<>0 AND assessement_progress_reports.student_average>=60 THEN 'Passed' ELSE 'Failed' END AS 'remark'
//     FROM marks INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id
//     INNER JOIN subjects ON teaching_loads.subject_id=subjects.id
//     INNER JOIN users ON users.id=marks.student_id
//     INNER JOIN grades_students ON grades_students.student_id=marks.student_id
//     INNER JOIN grades ON grades_students.grade_id=grades.id
//     INNER JOIN assessement_progress_reports ON assessement_progress_reports.student_id=marks.student_id
//     WHERE marks.student_id=".$student." AND marks.assessement_id=".$request->assessement." AND assessement_progress_reports.assessement_id=".$request->assessement."
//     GROUP BY marks.id  
//     ORDER BY assessement_progress_reports.student_average DESC"));
// }
    

$school_info=School::all();
$comments=CommentSetting::all();
// foreach ($comments as $comment_symbol){
// if(in_array($subjects[0]->student_average, range($comment_symbol->from,$comment_symbol->to))) {
// $symbol=$comment_symbol->symbol;                                  
// }
// }

// dd($subjects);
     
 //$number_of_subjects=$criteria->number_of_subjects;

 

return view('academic-admin.reports-management.assessement.report-view', compact('students','comments', 'school_info','pass_rate','number_of_subjects', 'number_of_subjects'));  
//student_report', 'school_info', 'subjects','comments','pass_rate', 'passing_subject_rule','number_of_subjects','subject_report', 'marks

}
         
        





    


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}