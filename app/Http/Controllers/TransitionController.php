<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Term;
use App\Models\User;
use App\Models\Stream;
use App\Models\StudentLoad;
use App\Models\TermAverage;
use App\Models\StudentClass;
use App\Models\TeachingLoad;
use Illuminate\Http\Request;
use App\Models\ClassSequence;
use App\Models\AcademicSession;
use App\Models\Grade;
use App\Models\ParentStudent;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class TransitionController extends Controller
{
    public function index(){

        return view('academic-admin.academic-session-management.session-migration.index');

    }

    public function index_automatic(){
        $from_year=date('Y')-1;
        $to_year=date('Y');
        $from=AcademicSession::where('academic_session', $from_year)->get();
        $to=AcademicSession::where('academic_session', $to_year)->get();
        $current_year=date('Y');
        $sessions=AcademicSession::where('active', 0)->where('academic_session', $current_year)->get();
        $grades=Grade::all();

        return view('academic-admin.academic-session-management.session-migration.automatic-migration.index', compact('from_year', 'to_year', 'from', 'to', 'current_year', 'sessions','grades'));
    }


    public function index_custom(){

        $from_year=date('Y')-1;
        $to_year=date('Y');
        $from=AcademicSession::where('academic_session', $from_year)->get();
        $to=AcademicSession::where('academic_session', $to_year)->get();
        $current_year=date('Y');
        $sessions=AcademicSession::where('active', 0)->where('academic_session', $current_year)->get();
        $grades=Grade::all();

        return view('academic-admin.academic-session-management.session-migration.custom-migration.index', compact('from_year', 'to_year', 'from', 'to', 'current_year', 'sessions','grades'));

    }




    public function process(Request $request){



    $from_session=$request->from_academic_session;
    $to_session=$request->to_academic_session;
    $current_class=$request->class_id;
    $destination_class=$request->destination_class;
    $students=$request->students;



    //get info about stream of the selected current class
    $stream=DB::table('streams')
    ->join('grades','grades.stream_id','=','streams.id')
    ->where('grades.id', $current_class)
    ->select( 'grades.id as grade_id', 'grades.grade_name', 'streams.id', 'streams.stream_type', 'final_stream')
    ->first();

    $stream_type=$stream->stream_type;
    $final_stream_status=$stream->final_stream;

    //final stream exists in school
    $final_stream_checker=DB::table('streams')
    ->where('final_stream', 1)
    ->exists();



        //Validations
    $validator=Validator::make($request->all(),[
            'class_id'=>'required',
            'from_academic_session'=>'required',
            'to_academic_session'=>'required',

        ]);

        if ($validator->fails()) {
            return response ()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);

        }else{

            if (empty($stream_type) OR (!$final_stream_checker)) {
                flash()->overlay('<i class="fas fa-check-circle text-warning "></i>'.' Error. . Stream type not set. Please set stream type ', 'Migration  Notice');
                return redirect('/academic-admin/stream');
            }else{

                //else if validation met

                //custom migration
                if($request->migration_type=="custom"){

                   //if it is custom migration then show
                   //1. list of students in current class

                   $students=DB::table('users')
                   ->join('grades_students','grades_students.student_id','=','users.id')
                   ->join('grades','grades.id','=','grades_students.grade_id')
                   ->where('grades.id', $request->class_id)
                   ->whereNull('grades_students')
                   ->where('grades_students.academic_session', $from_session)
                   ->select('users.id as student_id','users.name', 'users.lastname', 'users.middlename', 'grades.id as grade_id', 'grades.grade_name', 'users.active as users_active', 'grades_students.active as grades_student_active')
                   ->get();


                   $next_class=Grade::where('id',$destination_class)->first();
                   $next_class_name=$next_class->grade_name;

                   return view('academic-admin.academic-session-management.session-migration.custom-migration.view', compact('students', 'from_session', 'to_session', 'current_class', 'next_class_name', 'destination_class'));
                }

                //endof custom migration



          //if migration type is automatic
            if($request->migration_type=="automatic"){





            $students=DB::table('users')
            ->join('grades_students','grades_students.student_id','=','users.id')
            ->join('grades','grades.id','=','grades_students.grade_id')

            // ->join('streams','streams.id','=','grades.stream_id')
            ->join('term_averages','term_averages.student_id','=','users.id')
            ->join('terms','terms.id','=','term_averages.term_id')
            ->where('grades.id', $request->class_id)
            ->where('grades_students.academic_session', $from_session)
            ->where('terms.academic_session', $from_session)
            // ->where('terms.id','term_averages.term_id')
            ->where('terms.final_term',1)
            ->select('users.id as student_id', 'term_averages.final_term_status as result','users.name', 'users.lastname', 'users.middlename', 'grades.id as grade_id', 'grades.grade_name', 'terms.academic_session', 'users.active as users_active', 'grades_students.active as grades_student_active')
            ->get();



            $scope="internal";

            $class_map_exists=ClassSequence::where('origin', $request->class_id)->exists();

            $stream_sequence="0";


            if($final_stream_status==1){

            }else{
                if(!$class_map_exists){


                    flash()->overlay('<i class="fas fa-check-circle text-warning "></i>'.' Sorry. Class Mapping does not exist. Please map classes first, to do so, please click '.'<a href=/class-sequencing> here</a>', 'Migration Process Notice');

                    return Redirect::back();
                }
            }




         }



            return view('academic-admin.migration-management.manage', compact('students', 'from_session', 'to_session', 'current_class', 'scope', 'final_stream_status', 'stream_sequence'));






// dd($students);




        }

        }
    }


        public function store( Request $request){


            //variables
            $from_session=$request->from_session;
            $to_session=$request->to_session;
            $students=$request->students;
            $present_class=$request->current_class;
            $result=$request->student_result;
            $destination_class=$request->destination_class;

//get the current active session
$activeYearQuery=AcademicSession::where('active',1)->first();
$activeSessionID=$activeYearQuery->id;
$activeSessionName=$activeYearQuery->academic_session;

//next session id
$next_sessionID=$to_session['0'];
$next_sessionQuery=AcademicSession::where('id',$next_sessionID)->first();//query to get the next session
$next_sessionName=$next_sessionQuery->academic_session;//the next session name



//check if the current academic session is the same as the next session
//this is to check if the active session is the same as the session being migrated to
//this is to ensure that the user only migrates if he/she is in the new academic year

if (($activeSessionID)!=($next_sessionID)) {
    flash()->overlay('<i class="fa-solid fa-circle-exclamation" text-danger ></i>'.' Please note that,  you  have not activated academic year '.$next_sessionName.'. Before running the migration please activate the  '.$next_sessionName.' academic year. To do so, click  '.'<a href=/academic-admin/session> here</a> ' , 'Migration Process Notice');
    return redirect('/migration/automatic');

}else{


    //get info about stream of the selected current class
    $stream=DB::table('streams')
    ->join('grades','grades.stream_id','=','streams.id')
    ->where('grades.id', $present_class)
    ->select( 'grades.id as grade_id', 'grades.grade_name', 'streams.id', 'streams.stream_type', 'final_stream')
    ->first();

    $stream_type=$stream->stream_type;
    $final_stream_status=$stream->final_stream;



    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    Schema::table('grades_students', function (Blueprint $table) {

    $index_exists_session_FK= collect(DB::select("SHOW INDEXES FROM grades_students"))->pluck('Key_name')->contains('grades_students_academic_session_foreign');

        $index_exists_grade_FK = collect(DB::select("SHOW INDEXES FROM grades_students"))->pluck('Key_name')->contains('grades_students_grade_id_foreign');

        $index_exists = collect(DB::select("SHOW INDEXES FROM grades_students"))->pluck('Key_name')->contains('grades_students_student_id_unique');



        if ($index_exists_session_FK) {

           // $table->dropForeign(['academic_session']);
           }

           if ($index_exists_grade_FK) {
         //   $table->dropForeign(['grade_id']);
           }

        if ($index_exists) {
         $table->dropForeign(['student_id']);
         $table->dropUnique(['student_id']);
        //  grades_students_grades_students_student_id_unique_unique
        }

    });

    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $combined = [];


                  //if the stream is the final stream then execute the code below;
                  //Archive the student who is in the final stream
                  if($final_stream_status==1){

                    foreach ($students as $key => $val) {

                        $combined[] = ['student_id'=>$val, 'present_class'=>$present_class[$key]];

                        $student=$combined[$key]['student_id'];
                        $current_class=$combined[$key]['present_class'];

                        //archive all students in that final stream
                        User::where('id', $student)->update([ 'active'=> 0]);
                        ParentStudent::where('student_id', $student)->update(['active'=>0]);
                    }

                    flash()->overlay('<i class="fas fa-check-circle text-success "></i>'.' Success. . Migration Successful ', 'Migration Process Notice');
                    return redirect('/migration');
                    //end of final stream status
                }



            if($request->migration_type=="custom"){


                foreach ($students as $key => $val) {

                    $combined[] = ['student_id'=>$val,  'destination_class'=>$destination_class[$key],'present_class'=>$present_class[$key], 'academic_session'=>$to_session[$key]];

                    $student=$combined[$key]['student_id'];

                    $current_class=$combined[$key]['present_class'];
                    $next_class=$combined[$key]['destination_class'];
                    $to_session_is=$combined[$key]['academic_session'];


                    //  The following code block checks if the destination class is greater than 0
                    if ($next_class>0 ) {


                        //check if the student exists in the destination class
                        $student_exists=StudentClass::where('student_id', $student)->where('academic_session', $to_session_is)->exists();

                        if ($student_exists) {
                            # code...
                        }else{

                        //if the student does not exist in the destination class then do the following;

                        $create_new_entry=StudentClass::updateOrCreate(
                            ['student_id' => $student, 'grade_id' => $next_class, 'academic_session' => $to_session_is, 'active'=>1],
                            ['student_id' => $student, 'grade_id' => $next_class, 'academic_session' => $to_session_is, 'active'=>1]
                        );
                    }
                }

                    if ($next_class=='0' ) {

                        //archive //do not create a new class

                        $create_new_entry=StudentClass::where('student_id', $student)->update([
                            'active' => "0",

                        ]);
                    }


                }

                flash()->overlay('<i class="fas fa-check-circle text-success "></i>'.' Success. . Migration Successful ', 'Migration Process Notice');
                return redirect('/migration');

            }else{

                //else if the migration type is automatic




            //check if the class map exists
            $class_map_exists=ClassSequence::where('origin', $present_class)->exists();

            if($class_map_exists){


                $total_students=$request->student_id;

                //if the class map exists then

                //1. migrate students according the next class based on sequence/map

                foreach ($total_students as $key => $val) {

                    $combined[] = ['student_id'=>$val, 'result'=>$result[$key], 'destination_class'=>$destination_class[$key],'present_class'=>$present_class[$key], 'academic_session'=>$to_session[$key]];

                    $student=$combined[$key]['student_id'];
                    $final_status=$combined[$key]['result'];
                    $current_class=$combined[$key]['present_class'];
                    $next_class=$combined[$key]['destination_class'];
                    $to_session_is=$combined[$key]['academic_session'];


                    if ($final_status=='Proceed' or $final_status=='Promoted') {


                        $create_new_entry=StudentClass::updateOrCreate(
                            ['student_id' => $student, 'grade_id' => $next_class, 'academic_session' => $to_session_is, 'active'=>1],
                            ['student_id' => $student, 'grade_id' => $next_class, 'academic_session' => $to_session_is, 'active'=>1]
                        );
                    }


                    if ($final_status=='Repeat') {
                        $create_new_entry=StudentClass::updateOrCreate(
                            ['student_id' => $student, 'grade_id' => $current_class, 'academic_session' => $to_session_is, 'active'=>1],
                            ['student_id' => $student, 'grade_id' => $current_class, 'academic_session' => $to_session_is, 'active'=>1]
                        );
                    }



                    if ($final_status=='Try Another School') {

                        User::find($student)->update([ 'active'=> 0]);
                    }
                }

                flash()->overlay('<i class="fas fa-check-circle text-success "></i>'.' Success. . Migration Successful ', 'Migration Process Notice');
                return redirect('/migration');

            }else{

                flash()->overlay('<i class="fas fa-check-circle text-warning "></i>'.' Sorry. Class Mapping does not exist. Please map classes first, to do so, please click '.'<a href=/class-sequencing> here</a>', 'Migration Process Notice');

                return Redirect::back();

            }
        }
    }
}

      public function next_class($id){

        $next_class=DB::table('streams')
        ->join('grades','grades.stream_id','=','streams.sequence')
        ->where('streams.id', $id)
        ->select('grades.id as next_grade_id', 'grades.grade_name as next_grade_name' )
        ->get();

        return response()->json([

            'grade'=>$next_class,
          ]);



      }

    }

