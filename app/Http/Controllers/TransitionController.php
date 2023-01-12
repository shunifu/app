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
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
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
        $grades=Grade::all();

        //Check if that the session exists
         //Check if that the session exists
        
        return view('academic-admin.academic-session-management.session-migration.index', compact('from','to', 'grades'));

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

     
        // dd(($request->all()));

    $from_session=$request->from_academic_session;
    $to_session=$request->to_academic_session;
    $current_class=$request->class_id;


        

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


            //Query to get students currently in the selected stream

         
      


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

    

// dd($students);

            return view('academic-admin.migration-management.manage', compact('students', 'from_session', 'to_session', 'current_class'));




        }
    }


        public function store( Request $request){
      


            //variables
            $from_session=$request->from_session;
            $to_session=$request->to_session;
            $students=$request->student_id;
            $present_class=$request->current_class;
            $result=$request->student_result;
            $destination_class=$request->destination_class;


            //STEPS...
            //The goal is to transition to a new academic year
            //1. Make current year active=0 --model=AcademicSession

            // $resetAcademicYear=AcademicSession::where('active', 1) ->update(['active' => 0]);

            // $activateNewYear=AcademicSession::where('id', $to_session) ->update(['active' => 1]);


            //2. Make active=0
            //models;

            //1. marks

            //deactivate old teaching loads
            // $deactivateTeachingLoads=TeachingLoad::where('active', 1)->where('session_id', $from_session)->update([
            // 'active'=>'0' ]);

            //student_loads
            // $deactivateTeachingLoads=StudentLoad::where('active', 1)->where('session_id', $from_session)->update([
            // 'active'=>'0'  ]);
    
            //marks
            // $deactivateMarks=Mark::where('active', 1)->where('session_id', $from_session)->update([ 'active'=>'0']);

         

            //Deactivate current class
            // $deactivateStudentGrade=StudentClass::where('active', 1)->where('academic_session', $from_session)->update([
            //     'active'=>'0'  ]);


            //Create new entries in grades_students

            //1. Before creating new entry check if there is a student with that session, in class and is active

  

              
  
      
       Schema::table('persons', function (Blueprint $table) {
        $index_exists = collect(DB::select("SHOW INDEXES FROM grades_students"))->pluck('Key_name')->contains('grades_students_student_id_unique');
        if ($index_exists) {
            $table->dropUnique("grades_students_student_id_unique");
        }
    });
   
    

            $combined = [];

         
      
            $class_map_exists=ClassSequence::where('origin', $present_class)->exists();

            if($class_map_exists){


                //if the class map exists then 
                
                //1. migrate students according th

                foreach ($students as $key => $val) {
                    
                    $combined[] = ['student_id'=>$val, 'result'=>$result[$key], 'destination_class'=>$destination_class[$key],'present_class'=>$present_class[$key], 'academic_session'=>$to_session[$key]];

                    $student=$combined[$key]['student_id'];
                    $final_status=$combined[$key]['result'];
                    $current_class=$combined[$key]['present_class'];
                    $next_class=$combined[$key]['destination_class'];
                    $to_session_is=$combined[$key]['academic_session'];

                
                    if ($final_status=='Proceed' or $final_status=='Promoted') {
                        //$create_new_entry=StudentClass::upsert([
                        //['student_id' => $student, 'grade_id' => $destination, 'academic_session' => $to_session, 'active'=>1]
                        //], ['student_id', 'grade_id', 'academic_session', 'active'], ['student_id', 'grade_id', 'academic_session', 'active']);

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
                      
                        User::find($student)->update(['active', 0]);
                    }


                   
                }

                flash()->overlay('<i class="fas fa-check-circle text-success "></i>'.' Success. . Migration Successful ', 'Migration Process Notice');
                return redirect('/migration');

            }else{

                flash()->overlay('<i class="fas fa-check-circle text-warning "></i>'.' Sorry. Class Mapping does not exist. Please map classes first, to do so, please click '.'<a href=/class-sequencing> here</a>', 'Migration Process Notice');
              
                return Redirect::back();
                
            }
       

        

            // foreach ($students as $key => $val) {

              
            //     $combined[] = ['student_id'=>$val, 'result'=>$result[$key], 'present_class'=>$present_class[$key]];

            //     $student=$combined[$key]['student_id'];
            //     $final_status=$combined[$key]['result'];
            //     $current_class=$combined[$key]['present_class'];

               

            //     if ($class_map_exists) {
            //         //if class-map exists for that class
            //         //get the next class
            //         $next_class=ClassSequence::where('origin', $current_class)->first();
            //         $destination=$next_class->destination;
                       
            //         if ($final_status=='Proceed' or $final_status=='Promoted') {
            //             //$create_new_entry=StudentClass::upsert([
            //             //['student_id' => $student, 'grade_id' => $destination, 'academic_session' => $to_session, 'active'=>1]
            //             //], ['student_id', 'grade_id', 'academic_session', 'active'], ['student_id', 'grade_id', 'academic_session', 'active']);

            //             $create_new_entry=StudentClass::updateOrCreate(
            //                 ['student_id' => $student, 'grade_id' => $destination, 'academic_session' => $to_session, 'active'=>1],
            //                 ['student_id' => $student, 'grade_id' => $destination, 'academic_session' => $to_session, 'active'=>1]
            //             );
            //         }

            //         if ($final_status=='Repeat') {
            //             $create_new_entry=StudentClass::updateOrCreate(
            //                 ['student_id' => $student, 'grade_id' => $current_class, 'academic_session' => $to_session, 'active'=>1],
            //                 ['student_id' => $student, 'grade_id' => $current_class, 'academic_session' => $to_session, 'active'=>1]
            //             );
            //         }

            //         if ($final_status=='Try Another School') {
                      
            //             User::find($student)->update(['active', 0]);
            //         }
                        
            //         // flash()->overlay('<i class="fas fa-check-circle text-success "></i>'.' Congratulations. You have successfully migrated students to the next class', 'Migration Process Notice');
            //         // return Redirect::back();
            //     } else {
            //         // if($class_map_doesnt_exist){
            //         //else if it does not exist
              
            //         flash()->overlay('<i class="fas fa-check-circle text-warning "></i>'.' Sorry. Class Mapping does not exist. Please map classes first, to do so, please click '.'<a href=/class-sequencing> here</a>', 'Migration Process Notice');
              
            //         return Redirect::back();
            //     }
            // }
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

