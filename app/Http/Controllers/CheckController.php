<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Stream;
use App\Models\TeachingLoad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckController extends Controller
{
    public function check_loads_index(){
        //check loads

        $gradesList=Grade::all();
        return view('teaching-loads.index-checker', compact('gradesList'));

    }

    public function admin_check_loads_index(){
        //check loads

        $streams=Stream::all();
        return view('teaching-loads.checker.admin.index', compact('streams'));

    }


    public function check_loads_process(Request $request){

        $grade=$request->grade;


       //show the loads in that grade

    //    $getLoad=TeachingLoad::where('class_id', $grade)->get();
       $getLoad=DB::table('teaching_loads')
       ->join('grades','grades.id','=','teaching_loads.class_id')

       ->join('subjects','subjects.id','=','teaching_loads.subject_id')
       ->join('users','users.id','=','teaching_loads.teacher_id')
       ->join('academic_sessions','academic_sessions.id','=','teaching_loads.session_id')
       ->where('academic_sessions.active', 1 )
       ->select('teaching_loads.id','grades.grade_name as grade_name','subjects.subject_name', 'users.name', 'users.lastname', 'users.middlename', 'users.salutation')
       ->orderBy('subject_name', 'ASC')
       ->get();
       return view('teaching-loads.checker-view', compact('getLoad'));
        

    }



    public function admin_check_loads_process(Request $request){

        $validation=$request->validate([
            'stream'=>'required',
        ]);




        $getLoad=DB::table('teaching_loads')
       ->join('grades','grades.id','=','teaching_loads.class_id')
       ->join('subjects','subjects.id','=','teaching_loads.subject_id')
       ->join('users','users.id','=','teaching_loads.teacher_id')
       ->join('academic_sessions','academic_sessions.id','=','teaching_loads.session_id')
       ->where('academic_sessions.active', 1 )
       ->where('grades.stream_id', $request->stream)
       ->select('teaching_loads.id','grades.grade_name as grade_name','subjects.subject_name', 'users.name', 'users.lastname', 'users.middlename', 'users.salutation')
       ->orderBy('subject_name', 'ASC')
       ->get();

       $stream=Stream::find($request->stream);
       return view('teaching-loads.checker.admin.admin-checker-view', compact('getLoad', 'stream'));



    



    }

    public function view_students($id){

        $view_loads=DB::table('student_loads')
        ->join('users','student_loads.student_id','=','users.id')
        ->join('teaching_loads','student_loads.teaching_load_id','=','teaching_loads.id')
     
        ->where('teaching_loads.id', $id )
     
        ->select('teaching_loads.id as teaching_load_id','student_loads.student_id','student_loads.id as student_load_id', 'users.name', 'users.lastname', 'users.middlename', 'users.profile_photo_path', 'teaching_loads.teacher_id', 'teaching_loads.subject_id', 'class_id', 'teaching_loads.session_id')
        ->get();
 
     return view('teaching-loads.view-admin', compact('view_loads'));

    }
}
