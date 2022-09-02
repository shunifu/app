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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class TransitionController extends Controller
{
    public function index(){

        //Show page to process transition...

    // $from=AcademicSession::where('active', 0)->where('academic_session', $current_year)->get();
    // $to=AcademicSession::where('active', 0)->where('academic_session', $current_year)->get();
        //to 

    //Validation: new year
    //not less than current year;
     //not greater than current year;

     $from_year=date('Y')-1;
     $to_year=date('Y');

     $from=AcademicSession::where('academic_session', $from_year)->get();
     $to=AcademicSession::where('academic_session', $to_year)->get();

     
    
        
        $current_year=date('Y');
        $sessions=AcademicSession::where('active', 0)->where('academic_session', $current_year)->get();
        $streams=Stream::all();

        //Check if that the session exists
         //Check if that the session exists
        
        return view('academic-admin.academic-session-management.session-migration.index', compact('from','to', 'streams'));

    }

    public function class_type(Request $request){

        //validate GET parameter

        $class_type=$request->class_type;
        $streams=Stream::where('stream_type', $class_type)->get();


        // if($class_type=="internal"){
           

        // }else if($class_type=="external"){

        // }
        return response()->json($streams);

    }

    public function process(Request $request){

     
   

    $from_session=$request->from_academic_session;
    $to_session=$request->to_academic_session;


        

        $validator=Validator::make($request->all(),[
           
            'stream_id'=>'required',
            'from_academic_session'=>'required',
            'to_academic_session'=>'required',
            'class_type'=>'required',
        ]);

        if ($validator->fails()) {
            return response ()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
            ]);

        }else{

        //show list of classes
        //  $class


        if($request->class_type=="internal"){

            //if the class type==internal then 
            //1. show the the third term

            $student_class=DB::table('grades_students')
            ->join('academic_sessions','academic_sessions.id','=','grades_students.academic_session')
            ->join('grades','grades.id','=','grades_students.grade_id')
            ->join('users','users.id','=','grades_students.student_id')
            ->join('streams','streams.id','=','grades.stream_id')
            ->join('term_averages','term_averages.student_id','=','users.id')
            ->join('terms','terms.id','=','term_averages.term_id')
            ->where('grades.stream_id', $request->stream_id)
            ->where('grades_students.academic_session', $from_session)
            //->where('terms.final_term',1)
            ->select('users.id as student_id', 'term_averages.final_term_status as result','users.name', 'users.lastname', 'users.middlename', 'grades.id as grade_id', 'grades.grade_name', 'sequence', 'academic_sessions.academic_session')
            ->get();

        }else{

            $student_class=DB::table('grades_students')
            ->join('academic_sessions','academic_sessions.id','=','grades_students.academic_session')
            ->join('grades','grades.id','=','grades_students.grade_id')
            ->join('users','users.id','=','grades_students.student_id')
            ->join('streams','streams.id','=','grades.stream_id')
            ->where('grades.stream_id', $request->stream_id)
            ->where('grades_students.academic_session', $from_session)
            ->select('users.id as student_id', 'users.name', 'users.lastname', 'users.middlename', 'grades.id as grade_id', 'grades.grade_name', 'sequence', 'academic_sessions.academic_session')
            ->get();

        }

         


          
         
          return response()->json([
            'status'=>200,
            'students'=>$student_class,

          ]);

        //return response()->json($student_class);

        }
        


    //     $session=2;
    //     $previous_session=1;
     

    //     if($session==$previous_session){
    //         flash()->overlay('<i class="fas fa-check-circle text-warning "></i>'.' Sorry. You cannot migrate to same year', 'Migration Process Notice');

    //         return Redirect::back();
    //     }
       
    //     //deactivate old teaching loads
    //     $deactivateTeachingLoads=TeachingLoad::where('active', 1)->where('session_id', $previous_session)->update([
    //         'active'=>'0',
    //     ]);


    //      //deactivate student  loads
    //      $deactivateTeachingLoads=StudentLoad::where('active', 1)->where('session_id', $previous_session)->update([
    //         'active'=>'0',
    //     ]);

    //        $deactivateMarks=Mark::where('active', 1)->where('session_id', $previous_session)->update([
    //         'active'=>'0',
    //     ]);

    //     $students=StudentClass::where('academic_session','!=', $session)->get();//consider active==1
    //     //getting list of students who do not have the new session.

    //     foreach ($students as $key => $value) {
        
    //     $student=$value->student_id;
    //     $current_session=$value->academic_session;
    //     $current_class=$value->grade_id;

    

    //     //Check if sequence exists
    //     $class_map=ClassSequence::where('origin', $current_class)->exists();

    //     if($class_map){
    //         //if class-map exists for that class
    //         //get the next class
    //         $next_class=$class_map=ClassSequence::where('origin', $current_class)->first();
    //         $destination=$class_map->destination;

    //     }else{
    //       //else if it does not exist

    //       flash()->overlay('<i class="fas fa-check-circle text-warning "></i>'.' Sorry. Class Mapping does not exist. Please map classes first, to do so, please click '.'<a href=/class-sequencing> here</a>', 'Migration Process Notice');

    //       return Redirect::back();
    //     }

    //     //make inactive each of the students in the session
    //     $deactivate=StudentClass::where('student_id', $student)->where('academic_session', $current_session)->update(['active' => '0']);        

        
    //     //create new entry.
        
    //     //1. before creating new entry check if the is a student with that session, in class and is active

    //     $studentExistsInNewSession=StudentClass::where('academic_session', $session)->where('student_id', $student)->exists();

    //     if($studentExistsInNewSession){
    //    //2. If student with $session, is in that class and is active exists then do nothing

    //     }else{

    //     //3. Else if does not exist 

    //     // check if the student passed or was promoted or failed.
      

    //     $result=DB::table('term_averages')
    //     ->join('terms','terms.id','=','term_averages.term_id')
    //     ->where('terms.academic_session', $current_session)
    //     ->where('terms.final_term', 1)->where('session_id',$current_session)->where('student_id', $student)->get();
       

    //     foreach ($result as $key => $result_value) {
    //         $status=$result_value->final_term_status;

    //         if($status=='Passed' || $status=='Promoted'){
    // // if student passed or was promoted, then add transition student to new class by adding new entry with grade_id=destination
    //             $create_new_entry=StudentClass::create([
    //                 'student_id'=>$student,
    //                 'grade_id'=>$destination,
    //                 'academic_session'=>$session,
    //                 'active'=>1,
    //                ]);
    //         }elseif($status=='Repeat'){

    //             $create_new_entry=StudentClass::create([
    //                 'student_id'=>$student,
    //                 'grade_id'=>$current_class,
    //                 'academic_session'=>$session,
    //                 'active'=>1,
    //                ]);
    //         }
    //     }

    //     flash()->overlay('<i class="fas fa-check-circle text-success "></i>'.' Congratulations. You have successfully migrated students to the next class', 'Migration Process Notice');
           
    
    //     }


      
      




        }


        public function store( Request $request){
      
    
        ///    dd($request->all());

            //variables
            $from_session=$request->from_session;
            $to_session=$request->to_session;
            $students=$request->student_id;
            $present_class=$request->current_class;
            $result=$request->result;

           

            //STEPS...
            //The goal is to transition to a new academic year
            //1. Make current year active=0 --model=AcademicSession

            $resetAcademicYear=AcademicSession::where('active', 1) ->update(['active' => 0]);

            $activateNewYear=AcademicSession::where('id', $to_session) ->update(['active' => 1]);


            //2. Make active=0
            //models;

            //1. marks

            //deactivate old teaching loads
            $deactivateTeachingLoads=TeachingLoad::where('active', 1)->where('session_id', $from_session)->update([
            'active'=>'0' ]);

            //student_loads
            $deactivateTeachingLoads=StudentLoad::where('active', 1)->where('session_id', $from_session)->update([
            'active'=>'0'  ]);
    
            //marks
            $deactivateMarks=Mark::where('active', 1)->where('session_id', $from_session)->update([ 'active'=>'0']);

            // $deactivateMarks=DB::table('marks')
            // ->join('teaching_loads','teaching_loads.id','=','marks.teaching_load_id')
            // ->where('teaching_loads.active', 1)
            // ->where('teaching_loads.session_id', $from_session)
            // ->update(['marks.active'=>'0']);

            $deactivateStudentGrade=StudentClass::where('active', 1)->where('academic_session', $from_session)->update([
                'active'=>'0'  ]);


            //Create new entries in grades_students

            //1. Before creating new entry check if there is a student with that session, in class and is active

  

              
            // foreach ($students as $key => $value) {

            // $student=[];
            // $final_status=[];
            // $current_class=[];


            // $student=$students[$i];
            // $final_status=$result[$i];
            // $current_class=$present_class[$i];

            // $newArray = array_merge($student, $final_status, $current_class);

            // foreach ($newArray as $key => $value) {
            //     echo "$key - <strong>$value</strong> <br />";
            //   }


            $combined = [];

            // dd($students);


            foreach ($students as $key => $val) {

                
                $combined[] = ['student_id'=>$val, 'result'=>$result[$key], 'present_class'=>$present_class[$key]];

                $student=$combined[$key]['student_id'];
                $final_status=$combined[$key]['result'];
                $current_class=$combined[$key]['present_class'];

                $class_map_exists=ClassSequence::where('origin', $current_class)->exists();
                $class_map_doesnt_exist=ClassSequence::where('origin', $current_class)->doesntexist();

                if ($class_map_exists) {
                    //if class-map exists for that class
                    //get the next class
                    $next_class=ClassSequence::where('origin', $current_class)->first();
                    $destination=$next_class->destination;
                       
                    if ($final_status=='Proceed' or $final_status=='Promoted') {
                        //$create_new_entry=StudentClass::upsert([
                        //['student_id' => $student, 'grade_id' => $destination, 'academic_session' => $to_session, 'active'=>1]
                        //], ['student_id', 'grade_id', 'academic_session', 'active'], ['student_id', 'grade_id', 'academic_session', 'active']);

                        $create_new_entry=StudentClass::updateOrCreate(
                            ['student_id' => $student, 'grade_id' => $destination, 'academic_session' => $to_session, 'active'=>1],
                            ['student_id' => $student, 'grade_id' => $destination, 'academic_session' => $to_session, 'active'=>1]
                        );
                    }

                    if ($final_status=='Repeat') {
                        $create_new_entry=StudentClass::updateOrCreate(
                            ['student_id' => $student, 'grade_id' => $current_class, 'academic_session' => $to_session, 'active'=>1],
                            ['student_id' => $student, 'grade_id' => $current_class, 'academic_session' => $to_session, 'active'=>1]
                        );
                    }

                    if ($final_status=='Try Another School') {
                      
                        User::find($student)->update(['active']);
                    }
                        
                    // flash()->overlay('<i class="fas fa-check-circle text-success "></i>'.' Congratulations. You have successfully migrated students to the next class', 'Migration Process Notice');
                    // return Redirect::back();
                } else {
                    // if($class_map_doesnt_exist){
                    //else if it does not exist
              
                    flash()->overlay('<i class="fas fa-check-circle text-warning "></i>'.' Sorry. Class Mapping does not exist. Please map classes first, to do so, please click '.'<a href=/class-sequencing> here</a>', 'Migration Process Notice');
              
                    return Redirect::back();
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

