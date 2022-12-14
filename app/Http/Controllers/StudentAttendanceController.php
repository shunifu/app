<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use App\Models\CummulativeAttendance;
use App\Models\GradeTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\StudentAttendance;
use App\Models\Term;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;

class StudentAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRole('class_teacher')) {
            $classteacher_list=DB::table('grades_teachers')
            ->join('academic_sessions', 'academic_sessions.id', '=', 'grades_teachers.academic_session')
            ->join('grades', 'grades.id', '=', 'grades_teachers.grade_id')
            ->join('users', 'users.id', '=', 'grades_teachers.teacher_id')
            ->where('academic_sessions.active', 1)
            ->where('grades_teachers.teacher_id', Auth::user()->id)
            ->select('users.id as teacher_id', 'users.name', 'users.middlename', 'users.lastname', 'users.salutation', 'grades_teachers.teacher_id', 'grades_teachers.grade_id', 'grades.grade_name')
            ->first();
            //  dd($classteacher_list);
            $date= Carbon::now()->format('Y-m-d');

            $student_list=DB::table('grades_students')
            ->join('academic_sessions', 'academic_sessions.id', '=', 'grades_students.academic_session')
            ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
            ->join('users', 'users.id', '=', 'grades_students.student_id')
            ->where('academic_sessions.active', 1)
            ->where('grades_students.grade_id', $classteacher_list->grade_id)
            ->select('users.name', 'users.middlename', 'users.lastname', 'users.salutation', 'grades_students.student_id', 'grades.grade_name')
            ->get();





            return view('academic-admin.attendance-management.index', compact('classteacher_list', 'date', 'student_list'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $classteacher_list=DB::table('grades_teachers')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'grades_teachers.academic_session')
        ->join('grades', 'grades.id', '=', 'grades_teachers.grade_id')
        ->join('users', 'users.id', '=', 'grades_teachers.teacher_id')
        ->where('academic_sessions.active', 1)
        ->where('grades_teachers.teacher_id', Auth::user()->id)
        ->select('users.id as teacher_id', 'users.name', 'users.middlename', 'users.lastname', 'users.salutation', 'grades_teachers.teacher_id', 'grades_teachers.grade_id', 'grades.grade_name')
        ->first();
        //  dd($classteacher_list);
        $date= Carbon::now()->format('Y-m-d');

        $terms = DB::table('terms')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'terms.academic_session')
        ->where('academic_sessions.active', 1)
        ->select('terms.id as id', 'academic_sessions.id as session_id', 'terms.term_name')
        ->get();


        $student_list=DB::table('grades_students')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'grades_students.academic_session')
        ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
        ->join('users', 'users.id', '=', 'grades_students.student_id')
        ->where('academic_sessions.active', 1)
        ->where('grades_students.grade_id', $classteacher_list->grade_id)
        ->select('users.name', 'users.middlename', 'users.lastname', 'users.salutation', 'grades_students.student_id', 'grades.grade_name')
        ->get();

        return view('academic-admin.attendance-management.create', compact('classteacher_list', 'date', 'student_list', 'terms'));
        
    }

    public function cummulative_store(Request $request){



        if (!Schema::hasTable('cummulative_attendances')) {
            Schema::create('cummulative_attendances', function($table){
                  
                   $table->id();
                   $table->integer('student_id');
                   $table->integer('term_id');
                   $table->integer('class');
                   $table->integer('number_of_absent_days')->default(0);
                   $table->timestamps();
           });
       }


        //validation

        $validation=$request->validate([
            'term'=>'required',
            'absent_days'=>'required',
           
        ]);

        $students=$request->student_id;
        $term=$request->term;
        $grade_id=$request->grade_id;
        $absent_days=$request->absent_days;

        //
       

        //You should use update or create
   
        for($i = 0; $i <count($students); $i++) {
      
            $attendance=CummulativeAttendance::updateOrCreate([
            'student_id'=>$students[$i],
            'term_id'=>$term,
            'class'=>$grade_id,
            'number_of_absent_days'=>$absent_days[$i],
            ], ['number_of_absent_days'=>$absent_days[$i]]);
        
         }

         flash()->overlay('<i class="fas fa-check-circle text-success"></i>'.' Congratulations. You have successfully added student attendance'.' '.'</span> '.'into the attendance register.', 'Attendence Data');
 
         return Redirect::back();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation=$request->validate([
            'attendance_date'=>'required|date',

        ]);

        $count_list=count($request->all());

        $grade_id=$request->grade_id;
        $attendance_date=$request->attendance_date;
        $teacher_id=$request->teacher_id;
        $students=$request->student_id;
        $status=$request->status;

       

        //Check if exists


        


        for($i = 0; $i <count($students); $i++) {

            $addTeachingLoads=Attendence::create([
            'student_id'=>$students[$i],
            'teacher_id'=>$teacher_id,
            'grade_id'=>$grade_id,
            'attendence_date'=>$attendance_date,
            'attendence_status'=>$status[$i],
            ]);
        
         }

        // send to parents


        flash()->overlay('<i class="fas fa-check-circle text-success"></i>'.' Congratulations. You have successfully added student attendance'.' '.'</span> '.'into the attendance register.', 'Attendence Data');
 
        return Redirect::back();
   
    }
   /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentAttendance  $studentAttendance
     * @return \Illuminate\Http\Response
     */
    public function show(StudentAttendance $studentAttendance)
    {

        $grades=GradeTeacher::where('');
        return view('academic-admin.attendance-management.manage');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentAttendance  $studentAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentAttendance $studentAttendance, Request $request)
    {
        $student_attendance=Attendence::where('attendence_date', $request->date )->where('teacher_id',$request->teacher_id)->get();

       
        return view('academic-admin.attendance-management.view', compact('student_attendance'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentAttendance  $studentAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentAttendance $studentAttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentAttendance  $studentAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentAttendance $studentAttendance)
    {
        //
    }



    
}
