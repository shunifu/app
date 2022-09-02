<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\School;
use App\Models\Subject;
use App\Models\PassRate;
use App\Models\TermAverage;
use Illuminate\Http\Request;
use App\Models\AcademicSession;
use Illuminate\Support\Facades\DB;

class ResolutionController extends Controller
{
    public function index(){
        $classes=Grade::all();
        $sessions=AcademicSession::all();
        return view('academic-admin.resolution-management.index', compact('classes', 'sessions'));
    }

    public function load(Request $request){

        dd($request->all());
        
        $terms = DB::table('terms')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'terms.academic_session')
        ->where('terms.final_term', 1)
        ->where('academic_sessions.id', $request->academic_session)
        ->select('academic_sessions.id as academic_session_id', 'terms.term_name', 'academic_sessions.academic_session', 'terms.id as term_id')
        ->first();

        $getGrade=Grade::find($request->grade_id);
        $stream=$getGrade->stream_id;
        $section_id=$getGrade->section_id;

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




       // $result=TermAverage::where('term_id', $terms->term_id)->where('student_class', $request->grade_id)->get();
       if($criteria->passing_subject_rule=="0"){
        $scoresheet=DB::select(DB::raw("SELECT 
        student_subject_averages.student_id,
        grades.grade_name,
        users.id as learner_id,
        users.name,
        users.middlename,
        users.lastname,
        term_averages.student_average,
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
           MAX(CASE WHEN subjects.id=23 THEN student_subject_averages.student_average END) AS 'Agriculture',
           MAX(CASE WHEN subjects.id=24 THEN student_subject_averages.student_average END) AS 'AdditionalMathametics',
           MAX(CASE WHEN subjects.id=25 THEN student_subject_averages.student_average END) AS 'ICT',
           MAX(CASE WHEN subjects.id=26 THEN student_subject_averages.student_average END) AS 'RE',
           MAX(CASE WHEN subjects.id=27 THEN student_subject_averages.student_average END) AS 'History',
           MAX(CASE WHEN subjects.id=32 THEN student_subject_averages.student_average END) AS 'design'
        FROM student_subject_averages INNER JOIN teaching_loads ON teaching_loads.id=student_subject_averages.teaching_load_id
        INNER JOIN subjects ON teaching_loads.subject_id=subjects.id
        INNER JOIN users ON users.id=student_subject_averages.student_id
        INNER JOIN grades_students ON grades_students.student_id=student_subject_averages.student_id
        INNER JOIN grades ON grades_students.grade_id=grades.id
        INNER JOIN term_averages ON term_averages.student_id=student_subject_averages.student_id
        WHERE grades.id=".$request->grade_id." AND student_subject_averages.term_id=".$terms->term_id." AND term_averages.term_id=".$terms->term_id."
        GROUP BY student_subject_averages.student_id  
        ORDER BY term_averages.student_average DESC"));

    }else{
        $scoresheet=DB::select(DB::raw("SELECT 
        student_subject_averages.student_id,
        grades.grade_name,
        users.id as learner_id,
        users.name,
        users.middlename,
        users.lastname,
        term_averages.student_average,
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
        MAX(CASE WHEN subjects.id=32 THEN student_subject_averages.student_average END) AS 'design'
        FROM student_subject_averages INNER JOIN teaching_loads ON teaching_loads.id=student_subject_averages.teaching_load_id
        INNER JOIN subjects ON teaching_loads.subject_id=subjects.id
        INNER JOIN users ON users.id=student_subject_averages.student_id
        INNER JOIN grades_students ON grades_students.student_id=student_subject_averages.student_id
        INNER JOIN grades ON grades_students.grade_id=grades.id
        INNER JOIN term_averages ON term_averages.student_id=student_subject_averages.student_id
        WHERE grades.id=".$request->grade_id." AND student_subject_averages.term_id=".$terms->term_id." AND term_averages.term_id=".$terms->term_id."
        GROUP BY student_subject_averages.student_id  
        ORDER BY term_averages.student_average DESC"));
    }


    

        return view('academic-admin.resolution-management.view', compact('scoresheet', 'tie_type'));


       


    }
}
