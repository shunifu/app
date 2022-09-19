<?php

namespace App\Http\Controllers;

use App\Models\Stream;
use Illuminate\Http\Request;
use App\Models\AcademicSession;
use App\Models\School;
use Illuminate\Support\Facades\DB;

class RatioCheckerController extends Controller
{
    public function index(){
       $streams= Stream::all();
       $sessions=AcademicSession::where('active', 1)->get();
       return view('analytics.checker.ratio-checker.index', compact('streams', 'sessions'));

    }

    public function  show(Request $request){

    $stream_id=$request->stream_id;
    $session_id=$request->academic_session;
    $school=School::first();
    $school_code=$school->school_code;

  
    $stream=Stream::find($stream_id);
   



    if($school->school_code==1077){
     $checklist=DB::select(DB::raw("SELECT
     users.id,
        users.name,
        users.lastname,
        users.middlename,
        grades.grade_name,
        COUNT(student_loads.student_id) AS total_loads,
        (SELECT COUNT(marks.student_id) FROM marks WHERE marks.assessement_id =8 and student_loads.student_id=marks.student_id ) AS ContinousAssessement,
	(SELECT (marks.assessement_id) FROM marks WHERE marks.assessement_id =8 and student_loads.student_id=marks.student_id LIMIT 1) AS ca_id,
    	(SELECT (marks.assessement_id) FROM marks WHERE marks.assessement_id =9 and student_loads.student_id=marks.student_id LIMIT 1) AS exam_id,
	(SELECT COUNT(marks.student_id) FROM marks WHERE marks.assessement_id =9 and student_loads.student_id=marks.student_id ) AS Examination
      
    FROM
        student_loads
    INNER JOIN users ON users.id = student_loads.student_id
    INNER JOIN grades_students ON grades_students.student_id = users.id
    INNER JOIN grades ON grades.id=grades_students.grade_id
    WHERE
        grades.stream_id=".$stream_id."
    GROUP BY
        users.id"));
       }

       if($school->school_code=='0387'){
        $checklist=DB::select(DB::raw("SELECT
        users.id,
        users.name,
        users.lastname,
        users.middlename,
        grades.grade_name,
        COUNT(student_loads.student_id) AS total_loads,
        (SELECT COUNT(marks.student_id) FROM marks WHERE marks.assessement_id=1 and student_loads.student_id=marks.student_id ) AS Test_1,
        (SELECT (marks.assessement_id) FROM marks WHERE marks.assessement_id =1 and student_loads.student_id=marks.student_id LIMIT 1) AS test_1_id,

         (SELECT COUNT(marks.student_id) FROM marks WHERE marks.assessement_id=2 and student_loads.student_id=marks.student_id ) AS Test_2,
         (SELECT (marks.assessement_id) FROM marks WHERE marks.assessement_id =2 and student_loads.student_id=marks.student_id LIMIT 1) AS test_2_id,


         
         (SELECT COUNT(marks.student_id) FROM marks WHERE marks.assessement_id =5 and student_loads.student_id=marks.student_id ) AS Examination,
         (SELECT (marks.assessement_id) FROM marks WHERE marks.assessement_id =5 and student_loads.student_id=marks.student_id LIMIT 1) AS exam_id
         
      
    FROM
        student_loads
    INNER JOIN users ON users.id = student_loads.student_id
    INNER JOIN grades_students ON grades_students.student_id = users.id
    INNER JOIN grades ON grades.id=grades_students.grade_id
    WHERE
        grades.stream_id=".$stream_id."
    GROUP BY
        users.id"));
       }


       if($school->school_code=='0962'){
        $checklist=DB::select(DB::raw("SELECT
        users.id,
        users.name,
        users.lastname,
        users.middlename,
        grades.grade_name,
        COUNT(student_loads.student_id) AS total_loads,
        (SELECT COUNT(marks.student_id) FROM marks WHERE marks.assessement_id=1 and student_loads.student_id=marks.student_id ) AS Test_1,
        (SELECT (marks.assessement_id) FROM marks WHERE marks.assessement_id =1 and student_loads.student_id=marks.student_id LIMIT 1) AS test_1_id,

         (SELECT COUNT(marks.student_id) FROM marks WHERE marks.assessement_id=2 and student_loads.student_id=marks.student_id ) AS Test_2,
         (SELECT (marks.assessement_id) FROM marks WHERE marks.assessement_id =2 and student_loads.student_id=marks.student_id LIMIT 1) AS test_2_id,


         
         (SELECT COUNT(marks.student_id) FROM marks WHERE marks.assessement_id =7 and student_loads.student_id=marks.student_id ) AS Examination,
         (SELECT (marks.assessement_id) FROM marks WHERE marks.assessement_id =7 and student_loads.student_id=marks.student_id LIMIT 1) AS exam_id
         
      
    FROM
        student_loads
    INNER JOIN users ON users.id = student_loads.student_id
    INNER JOIN grades_students ON grades_students.student_id = users.id
    INNER JOIN grades ON grades.id=grades_students.grade_id
    WHERE
        grades.stream_id=".$stream_id."
        grades_students.active=1
    GROUP BY
        users.id"));
       }


      
       return view('analytics.checker.ratio-checker.view', compact('checklist', 'stream', 'school_code'));

    }
}
