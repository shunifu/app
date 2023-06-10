<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Role;
use App\Models\User;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\StudentLoad;
use App\Models\TeachingLoad;
use Illuminate\Http\Request;
use App\Models\AcademicSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentSubjectAverage;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

class TeachingLoadController extends Controller
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
      if (Auth::user()->hasRole('teacher')) {

         
       

        //Get for the year
        $name=Auth::user()->name;
        $teacher_id=Auth::user()->id;
        $classes=Grade::all()->sortBy('grade_name');
        $sessions=AcademicSession::where('active', 1)->get();//should be the active year
        $subjects=Subject::all();

        // $locked=0;
        // if($locked==1){
 
        //  flash()->overlay( 'Sorry, System has been locked. Marks cannot be entered since schools have closed. Please consult school administration for further assistance . ', 'Response');
        //  return Redirect::back();
 
        // }else{

       
return view('teaching-loads.index', compact('classes', 'sessions', 'subjects')); 

        

    }else{
      return view('errors.unauthorized');
    }
  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

     // dd($request->all());
    
      //validation
      $this->validate($request,[
        'subject_id'=>'required',
        'class_id'=>'required',
        'academic_session'=>'required',

       ]);

      //  $active==1;

     

      //Prevent duplication
      //teachers
      //students

      //check if teacher or list of subjects-classes already exist.

  $teachingLoadQRY=TeachingLoad::where('subject_id',$request->subject_id)->where('class_id',$request->class_id)->where('session_id',$request->academic_session)->where('teacher_id', $request->teacher_id);




  $student_list=$request->students;


  if($teachingLoadQRY->exists()){

  //get teaching_load_id
  $teaching_load=$teachingLoadQRY->first();
  $teaching_load_id=$teaching_load->id;
    
  //if exists, do not add load

   //check if students are loaded in load

  $studentLoadQRY=DB::table('student_loads')
  ->join('teaching_loads','student_loads.teaching_load_id','=','teaching_loads.id')
  ->where('teaching_loads.subject_id', $request->subject_id )
  ->where('teaching_loads.class_id', $request->class_id )
  ->where('teaching_loads.session_id',$request->academic_session)
  ->get()->pluck('student_id')->toArray();


    //compare loaded students with students in database
    $load=array_values(array_diff($student_list, $studentLoadQRY));


  if(empty($load)){
    flash()->overlay('<i class="fas fa-check-circle success"></i>'.' Sorry. Students already assigned teaching loads.', 'Add Teaching Load');
        
  
     return redirect('users/teacher/loads')->with('Sorry. Students already assigned teaching loads.');

  } else{



    for($i = 0; $i <count($load); $i++) {

      $addTeachingLoads=StudentLoad::create([
      'student_id'=>$load[$i],
      'teaching_load_id'=>$teaching_load_id,
      'session_id'=>$request->academic_session,
      'active'=>1
      ]);
  
   }

   flash()->overlay('<i class="fas fa-check-circle success"></i>'.' Congratulations. You have successfully added teaching loads.', 'Add Teaching Load');
        
  
   return redirect('users/teacher/loads/view/'.$teaching_load_id,)->with('Teaching Load successfully created');
  }
    

  }else{

    //load does not exist
    //add teaching load 
    //add students

          //Create teaching load

        

          $addTeachingLoads=TeachingLoad::create([

            'teacher_id'=>$request->teacher_id,
            'subject_id'=>$request->subject_id,
            'class_id'=>$request->class_id,
            'session_id'=>$request->academic_session,
            'active'=>1,
  
        ]);

       
  
        $load_id=$addTeachingLoads->id;

        $studentLoadQRY=DB::table('student_loads')
        ->join('teaching_loads','student_loads.teaching_load_id','=','teaching_loads.id')
        ->where('teaching_loads.subject_id', $request->subject_id )
        ->where('teaching_loads.class_id', $request->class_id )
        ->where('teaching_loads.session_id',$request->academic_session)
        ->where('student_loads.active',1)
        ->get()->pluck('student_id')->toArray();
      
      
          //compare loaded students with students in database
          $load=array_values(array_diff($student_list, $studentLoadQRY));
      
      
        if(empty($load)){
          flash()->overlay('<i class="fas fa-check-circle success"></i>'.' Sorry. Students already assigned teaching loads.', 'Add Teaching Load');
              
        
           return redirect('users/teacher/loads')->with('Teaching Load successfully created');
      
        } else{
      
      
      
          for($i = 0; $i <count($load); $i++) {
      
            $addTeachingLoads=StudentLoad::create([
            'student_id'=>$load[$i],
            'teaching_load_id'=>$load_id,
            'session_id'=>$request->academic_session,
            'active'=>1,
            ]);
        
         }
      
         $view_loads=DB::table('student_loads')
         ->join('users','student_loads.student_id','=','users.id')
         ->join('teaching_loads','student_loads.teaching_load_id','=','teaching_loads.id')
      
         ->where('teaching_loads.id', $load_id )
      
         ->select('teaching_loads.id as teaching_load_id','student_loads.student_id','student_loads.id as student_load_id', 'users.name', 'users.lastname', 'users.middlename', 'users.profile_photo_path', 'teaching_loads.teacher_id', 'teaching_loads.subject_id', 'class_id', 'teaching_loads.session_id')
         ->get();

        //  flash()->overlay('<i class="fas fa-check-circle success"></i>'.' Congratulations. You have successfully added teaching loads.', 'Add Teaching Load');
              
        
        //  return view('teaching-loads.view', compact('load_id', 'view_loads'));

         return redirect('users/teacher/loads/view/'.$load_id,)->with('Teaching Load successfully created');
        }
        
  
      // for($i = 0; $i < count($request->students); $i++) {
      //     $student_id=$request->students[$i];
      //       $addTeachingLoads=StudentLoad::create([
      //         'student_id'=>$student_id,
      //         'teaching_load_id'=>$load_id,       
      //   ]);
      // }
  
      // flash()->overlay('<i class="fas fa-check-circle success"></i>'.' Congratulations. You have successfully added teaching loads.', 'Add Teaching Load');
        
  
      // return redirect('users/teacher/loads/view/'.$load_id)->with('Teaching Load successfully created');

  }



     
    }
  

    public function get_load (Request $request){

     $student_id=$request->student_id;
     $teaching_load=$request->teaching_load_id;

     //delete mark if exists


     //delete in student load

      $load_data = DB::table('student_loads')
      ->join('users', 'users.id', '=', 'student_loads.student_id')
      ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
      ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
      ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
      ->where('student_loads.student_id','=',$student_id)
      ->where('student_loads.teaching_load_id','=',$teaching_load)
      ->select('users.id as user_id','users.name', 'users.lastname', 'users.middlename','subjects.subject_name', 'grades.grade_name', 'student_loads.id as student_load_id', 'teaching_loads.id as teaching_load' )
      ->get();
      
      return response()->json($load_data[0]);

    }

    public function loads_update(Request $request){

    
      //delete marks if exists

      $mark=Mark::where('student_id', $request->student_id_is)->where('teaching_load_id', $request->teaching_load_id_is);

      if($mark->exists()){
      
        $mark->delete();

      }

      $deleteLoad=StudentLoad::find($request->student_load_id)->delete();

      if($deleteLoad){

       return response()->json(
         ['message'=>"DELETED"]
       );
      }else{
        return response()->json(
          ['message'=>"Not Deleted"]
        );
      }



      
    }



    public function loadstudents(Request $request){

      // dd($request->all());

        //Validation

          $validator=$request->validate([
            'grade_id'=>'required',
            'subject_id'=>'required',
            'academic_session'=>'required',
        ]);

      if (Auth::user()->hasRole('teacher')) {

        $class_id=$request->grade_id;
        $subject_id=$request->subject_id;
        $academic_session=$request->academic_session;
    

        $classes=Grade::all();
        $sessions=AcademicSession::where('active', 1)->get();
        $subjects=Subject::all();

        $load_class=Grade::find($class_id);
        $load_session=AcademicSession::find($academic_session);
        $load_subject=Subject::find($subject_id);
        $teacher_id=Auth::user()->id;
        

         $result_students=DB::table('grades_students')
         ->join('users','grades_students.student_id','=','users.id')
         ->join('academic_sessions','academic_sessions.id','=','grades_students.academic_session')
         ->where('grades_students.grade_id', $class_id )
         ->where('grades_students.academic_session', $academic_session)
         ->where('users.active', 1)
         ->select('users.name','users.lastname','users.id', 'users.middlename', 'grades_students.academic_session')
         ->orderBy('lastname')->orderBy('name')->get();
         //remember to add academic year
    
       return view('teaching-loads.teaching-loads', compact('result_students', 'teacher_id', 'subject_id', 'sessions','classes', 'subjects', 'load_subject', 'load_class', 'load_session' ));


    }else{
      return view('errors.unauthorized');
    }
  }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeachingLoad  $teachingLoad
     * @return \Illuminate\Http\Response
     */
    public function show(TeachingLoad $teachingLoad)
    {

     if(Auth::user()->hasRole('teacher')){


      $activeSession=AcademicSession::where('active', 1)->first();
    
      $activeSessionID=$activeSession->id;
      $activeSessionYear=$activeSession->academic_session;

        
           $result_loads=DB::table('teaching_loads')
           ->join('users','teaching_loads.teacher_id','=','users.id')
           ->join('subjects','teaching_loads.subject_id','=','subjects.id')
           ->join('grades','teaching_loads.class_id','=','grades.id')
           ->join('academic_sessions','teaching_loads.session_id','=','academic_sessions.id')
           ->where('teaching_loads.teacher_id', Auth::user()->id )
           ->where('teaching_loads.active', 1 )
           ->where('teaching_loads.session_id',$activeSessionID )
           ->select('subject_name','grade_name', 'name', 'teaching_loads.id')
           ->orderBy('grades.grade_name', 'ASC')
           ->get();

          // dd($result_loads);

           if(($result_loads->isEmpty())){
          
            $int=0;
           }else{
            $int=1;
           }
          
          return view('teaching-loads.manage', compact('result_loads', 'int', 'activeSessionYear'));
          
           
        

   
   }else{
    //not a teacher show not a teacher blade file
    return view('errors.unauthorized');
   }

  }


   public function transfer_loads_index(){


      
  $my_teaching_loads=DB::table('teaching_loads')
  ->join('users','teaching_loads.teacher_id','=','users.id')
  ->join('subjects','teaching_loads.subject_id','=','subjects.id')
  ->join('grades','teaching_loads.class_id','=','grades.id')
  ->where('teaching_loads.teacher_id', Auth::user()->id )
  ->where('teaching_loads.active', 1)
  ->select('subject_name','grade_name', 'name', 'teaching_loads.id', 'teaching_loads.subject_id', 'teaching_loads.teacher_id')
  ->orderBy('grades.grade_name', 'ASC')
  ->get();
  //remember to add Academic year
      
  $teacher_role=Role::where('name', 'teacher')->first();
  $teacher_role_id=$teacher_role->id;
     
  $teachers=User::where('role_id', $teacher_role_id)->where('active',1)->orderBy('users.lastname', 'ASC')->orderBy('users.name','ASC')->get();
  //remember to add academic year
  return view('teaching-loads.transfer.index', compact('my_teaching_loads','teachers'));

  


   }

   public function transfer_loads_step2 (Request $request){

    $from_teaching_load=$request->my_teaching_load;


$validation=$request->validate([
  'my_teaching_load'=>'required',
  'transfer_to'=>'required',
  'transfer_type'=>'required'
]);
  
    $result_explode = explode('-', $from_teaching_load);
  
    $transfer_to=$request->transfer_to;
    $from_teacher_id=$result_explode['1'];
    $teaching_load_id=$result_explode['0'];

    
  
   

    if($request->transfer_type=="all"){


//teaching_loads-change teacher_id to to_transfer
$update_teaching_load=TeachingLoad::where('id',$teaching_load_id)->update(["teacher_id"=>$transfer_to]);

 //marks-change teacher_id
$update_marks=Mark::where('teaching_load_id',$teaching_load_id)->update(["teacher_id"=>$transfer_to]);




flash()->overlay('<i class="fas fa-check-circle text-success "></i>'.' Success.You have transfered that teaching load', 'Transfer Teaching Load');


return Redirect::back();


    }else if($request->transfer_type=="some"){
  $student_loads=DB::table('student_loads')
  ->join('users','student_loads.student_id','=','users.id')
  ->where('student_loads.teaching_load_id', $teaching_load_id )
  ->where('users.active', 1)
  ->where('student_loads.active', 1)
  ->select('student_loads.student_id as id', 'users.name', 'users.lastname', 'users.middlename', 'users.profile_photo_path')
  ->get();



  $teaching_load=DB::table('teaching_loads')
  ->join('subjects','subjects.id','=','teaching_loads.subject_id')
  ->join('grades','grades.id','=','teaching_loads.class_id')
  ->where('teaching_loads.id', $teaching_load_id )
  ->where('teaching_loads.active',1)
  ->select('teaching_loads.id', 'subjects.id as subject_id', 'subjects.subject_name', 'grades.id as grade_id', 'grades.grade_name')
  ->get();

  $transfer_to_qry=DB::table('teaching_loads')
  ->join('users','users.id','=','teaching_loads.teacher_id')
  ->join('grades','grades.id','=','teaching_loads.class_id')
  ->join('subjects','subjects.id','=','teaching_loads.subject_id')
  ->where('teaching_loads.id', $teaching_load_id )
  ->select('teaching_loads.id', 'subjects.id as subject_id', 'subjects.subject_name', 'grades.id as grade_id', 'grades.grade_name', 'users.name', 'users.lastname', 'users.salutation', 'users.middlename', 'users.id as teacher_id')
  ->first();

  $transfer_to_qry_user=DB::table('users')
  ->where('id', $transfer_to )
  ->first();

 
  return view('teaching-loads.transfer.transfer-step2-some', compact('transfer_to_qry_user','student_loads','teaching_load', 'transfer_to_qry'));


    }
      


   }

   public function transfer_loads_step2_some(Request $request){

    dd($request->all());


$teaching_load_id=$request->teaching_load;
$transfer_to=$request->teacher_id;
$students=$request->students;

$teaching_load_details=TeachingLoad::where('teaching_load_id')->first();
$subject_id=$teaching_load_details->subject_id;
$grade_id=$teaching_load_details->grade_id;
$transfer_from=$teaching_load_details->teacher_id;
$academic_session=$teaching_load_details->academic_session;

//Logic

//1. First check if the teaching load exists
$teachingLoadExists=TeachingLoad::where('teacher_id', $transfer_to)->where('subject_id',$subject_id)->where('active', 1)->where('class_id',$grade_id)->exists();

if ($teachingLoadExists) {
  //2. If it exists then do not create teaching load
  //but attach students to that load

 //teaching_loads-change teacher_id to to_transfer
$update_student_load=StudentLoad::where('id',$teaching_load_id)->whereIn('student_id',$students)->update(["teacher_id"=>$transfer_to]);

//marks-change teacher_id
$update_marks=Mark::where('teaching_load_id',$teaching_load_id)->whereIn('student_id',$students)->update(["teacher_id"=>$transfer_to]);
  


}else {
  //if it does not exist
  //1. Create teaching Load

  $createTeachingLoad=TeachingLoad::create([

    'teacher_id'=>$transfer_to,
    'subject_id'=>$subject_id,
    'class_id'=>$grade_id,
    'session_id'=>$academic_session,
    'active'=>1,

]);

//Attach students to new teaching load

//teaching_loads-change teacher_id to to_transfer
$update_student_load=StudentLoad::where('id',$createTeachingLoad->id)->whereIn('student_id',$students)->update(["teacher_id"=>$transfer_to]);

//marks-change teacher_id
$update_marks=Mark::where('teaching_load_id',$createTeachingLoad->id)->whereIn('student_id',$students)->update(["teacher_id"=>$transfer_to]);



}







flash()->overlay('<i class="fas fa-check-circle success"></i>'.' Congratulations. You have successfully transfered teaching loads.', 'Transfer Teaching Load');


return redirect('users/teacher/loads/view/'.$teaching_load_id)->with('Teaching Load successfully created');

   }

   public function transfer_loads_process (){

   }
  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeachingLoad  $teachingLoad
     * @return \Illuminate\Http\Response
     */
    public function edit(TeachingLoad $teachingLoad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeachingLoad  $teachingLoad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeachingLoad $teachingLoad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeachingLoad  $teachingLoad
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeachingLoad $teachingLoad, $id)
    {

  
     if (Auth::user()->hasRole('teacher')) {
      $authorized=TeachingLoad::find($id);
      $teacher=$authorized->teacher_id;
      if($teacher==Auth::user()->id){

      $teachingLoadExistsInMark=Mark::where('teaching_load_id',$id)->exists();

      if($teachingLoadExistsInMark){
        
      //If teaching load is in marks, then do not delete teaching load

      //Transfer teaching load to another teacher

      flash()->overlay('<i class="fas fa-check-circle text-warning "></i>'.' Warning. That teaching load has marks attached to it. Please consult with the system administrator for further assistance.', 'Delete Teaching Load');

      }else{
        DB::table('student_subject_averages')->where('teaching_load_id',$id)->delete();
        DB::table('student_loads')->where('teaching_load_id',$id)->delete();
        DB::table('marks')->where('teaching_load_id',$id)->delete(); 
        DB::table('teaching_loads')->where('id',$id)->delete();
    
  
        flash()->overlay('<i class="fas fa-check-circle text-success "></i>'.' Success.You have deleted that teaching load', 'Delete Teaching Load');

      }
     return Redirect::back();

      }else{
       return view('errors.unauthorized');
      }
      
    }else{
     return view('errors.unauthorized');
    }
   }

   public function admin_delete_teaching_load(){
     //function to enable system administrator's to delete teaching load if teaching load is in marks 

      //function to enable HOD  to delete teaching load if teaching load is in marks 

   }

   public function admin_transfer_teaching_load(){
     //function to enable system administrator's to transfer teaching load if teaching load is in marks 

      //function to enable HOD  to delete teaching load if teaching load is in marks 
   }

    public function student_destroy(TeachingLoad $teachingLoad, $id, $student)
    {
      
      //if student has mark attached, then delete that mark
      $markExists=Mark::where('teaching_load_id',$id)->where('student_id', $student)->exists();

      if($markExists){
        DB::table('marks')->where('teaching_load_id',$id)->where('student_id', $student)->delete();
        DB::table('student_loads')->where('teaching_load_id',$id)->where('student_id', $student)->delete();
        flash()->overlay('<i class="fas fa-check-circle "></i>'.' Success. You have deleted that student, including marks', 'Delete Student');
      }else{
        DB::table('student_loads')->where('teaching_load_id',$id)->where('student_id', $student)->delete();
        flash()->overlay('<i class="fas fa-check-circle "></i>'.' Success. You have deleted that student', 'Delete Student');
      }
    
      //delete student
  
  
      return redirect('/users/teacher/loads/view/'.$id);
    }

    public function archive(Request $request){

      // dd($request->all());
    $load=TeachingLoad::find($request->teaching_load_id);

    $teacher=$load['0']->teacher_id;


    $teacherIs=User::find($teacher);
    $teacher_id=$teacherIs->id;

    if (Auth::user()->hasRole('admin_teacher') or Auth::user()->id==$teacher_id) {
        if ($request->action=="archive") {
            //1. Update settings, make
            //a) student_loads.active=0;
            //b) marks.active=0;
        }


        if ($request->action=="archive") {
            for ($i = 0; $i <count($request->students); $i++) {
              
                $student_load=StudentLoad::where('student_id', $request->students[$i])->where('teaching_load_id', $request->teaching_load_id[$i]);

                $student_mark=Mark::where('student_id', $request->students[$i])->where('teaching_load_id', $request->teaching_load_id[$i]);
    
                $student_subject_average=StudentSubjectAverage::where('student_id', $request->students[$i])->where('teaching_load_id', $request->teaching_load_id[$i]);

                //archive workflow

                //delete in teaching load
                if ($student_subject_average->exists()) {
                  $student_subject_average->delete();
              }

                //1. student_loads.active=0
                if ($student_load->exists()) {
                    $student_load->update(['active'=>'0']);
                }

                //2. mark.active=0
                if ($student_mark->exists()) {
                    $student_mark->update(['active'=>'0']);
                   
                }


            }
           
            flash()->overlay('<i class="fas fa-check-circle "></i>'.' Success. You have archived that student', 'Archive Student');
            return Redirect::back();
        }

        if ($request->action=="delete") {
          for ($i = 0; $i <count($request->students); $i++) {
            
              $student_load=StudentLoad::where('student_id', $request->students[$i])->where('teaching_load_id', $request->teaching_load_id[$i]);
    
              $student_mark=Mark::where('student_id', $request->students[$i])->where('teaching_load_id', $request->teaching_load_id[$i]);
    
              $student_subject_average=StudentSubjectAverage::where('student_id', $request->students[$i])->where('teaching_load_id', $request->teaching_load_id[$i]);
    
              //archive workflow
    
              //delete in teaching load
              if ($student_subject_average->exists()) {
                  $student_subject_average->delete();
            }
    
              //1. student_loads.active=0
              if ($student_load->exists()) {
                  $student_load->delete();
              }
    
              //2. mark.active=0
              if ($student_mark->exists()) {
                  $student_mark->delete();
                 
              }
    
    
          }
         
          flash()->overlay('<i class="fas fa-check-circle "></i>'.' Success. You have deleted that student', 'Archive Student');
          return Redirect::back();
      }

        if ($request->action=="unarchive") {
          for ($i = 0; $i <count($request->students); $i++) {
            
              $student_load=StudentLoad::where('student_id', $request->students[$i])->where('teaching_load_id', $request->teaching_load_id[$i]);

              $student_mark=Mark::where('student_id', $request->students[$i])->where('teaching_load_id', $request->teaching_load_id[$i]);
  
              $student_subject_average=StudentSubjectAverage::where('student_id', $request->students[$i])->where('teaching_load_id', $request->teaching_load_id[$i]);

              //archive workflow

              //delete in teaching load
              if ($student_subject_average->exists()) {
                $student_subject_average->delete();
            }

              //1. student_loads.active=0
              if ($student_load->exists()) {
                  $student_load->update(['active'=>'1']);
              }

              //2. mark.active=0
              if ($student_mark->exists()) {
                  $student_mark->update(['active'=>'1']);
                 
              }


          }
         
          flash()->overlay('<i class="fas fa-check-circle "></i>'.' Success. You have unarchived that student', 'Archive Student');
          return Redirect::back();
      }

    }
}



public function delete(Request $request){

  // dd($request->all());
$load=TeachingLoad::find($request->teaching_load_id);

$teacher=$load['0']->teacher_id;


$teacherIs=User::find($teacher);
$teacher_id=$teacherIs->id;

if (Auth::user()->hasRole('admin_teacher') or Auth::user()->id==$teacher_id) {
    if ($request->action=="archive") {
        //1. Update settings, make
        //a) student_loads.active=0;
        //b) marks.active=0;
    }


    if ($request->action=="archive") {
        for ($i = 0; $i <count($request->students); $i++) {
          
            $student_load=StudentLoad::where('student_id', $request->students[$i])->where('teaching_load_id', $request->teaching_load_id[$i]);

            $student_mark=Mark::where('student_id', $request->students[$i])->where('teaching_load_id', $request->teaching_load_id[$i]);

            $student_subject_average=StudentSubjectAverage::where('student_id', $request->students[$i])->where('teaching_load_id', $request->teaching_load_id[$i]);

            //archive workflow

            //delete in teaching load
            if ($student_subject_average->exists()) {
              $student_subject_average->delete();
          }

            //1. student_loads.active=0
            if ($student_load->exists()) {
                $student_load->update(['active'=>'0']);
            }

            //2. mark.active=0
            if ($student_mark->exists()) {
                $student_mark->update(['active'=>'0']);
               
            }


        }
       
        flash()->overlay('<i class="fas fa-check-circle "></i>'.' Success. You have archived that student', 'Archive Student');
        return Redirect::back();
    }

    if ($request->action=="delete") {
      for ($i = 0; $i <count($request->students); $i++) {
        
          $student_load=StudentLoad::where('student_id', $request->students[$i])->where('teaching_load_id', $request->teaching_load_id[$i]);

          $student_mark=Mark::where('student_id', $request->students[$i])->where('teaching_load_id', $request->teaching_load_id[$i]);

          $student_subject_average=StudentSubjectAverage::where('student_id', $request->students[$i])->where('teaching_load_id', $request->teaching_load_id[$i]);

          //archive workflow

          //delete in teaching load
          if ($student_subject_average->exists()) {
              $student_subject_average->delete();
        }

          //1. student_loads.active=0
          if ($student_load->exists()) {
              $student_load->delete();
          }

          //2. mark.active=0
          if ($student_mark->exists()) {
              $student_mark->delete();
             
          }


      }
     
      flash()->overlay('<i class="fas fa-check-circle "></i>'.' Success. You have deleted that student', 'Archive Student');
      return Redirect::back();
  }


    

    if ($request->action=="unarchive") {
      for ($i = 0; $i <count($request->students); $i++) {
        
          $student_load=StudentLoad::where('student_id', $request->students[$i])->where('teaching_load_id', $request->teaching_load_id[$i]);

          $student_mark=Mark::where('student_id', $request->students[$i])->where('teaching_load_id', $request->teaching_load_id[$i]);

          $student_subject_average=StudentSubjectAverage::where('student_id', $request->students[$i])->where('teaching_load_id', $request->teaching_load_id[$i]);

          //archive workflow

          //delete in teaching load
          if ($student_subject_average->exists()) {
            $student_subject_average->delete();
        }

          //1. student_loads.active=0
          if ($student_load->exists()) {
              $student_load->update(['active'=>'1']);
          }

          //2. mark.active=0
          if ($student_mark->exists()) {
              $student_mark->update(['active'=>'1']);
             
          }


      }
     
      flash()->overlay('<i class="fas fa-check-circle "></i>'.' Success. You have unarchived that student', 'Archive Student');
      return Redirect::back();
  }

}
}

    public function view($id){

     if (Auth::user()->hasRole('teacher')) {

      $teacher=TeachingLoad::where('teacher_id', Auth::user()->id)->where('id', $id)->first();
      $authorized_teacher=$teacher['teacher_id'];

      if($authorized_teacher==Auth::user()->id){
       $view_loads=DB::table('student_loads')
       ->join('users','student_loads.student_id','=','users.id')
       ->join('teaching_loads','student_loads.teaching_load_id','=','teaching_loads.id')
       ->where('teaching_loads.teacher_id', Auth::user()->id )
       ->where('teaching_loads.id', $id )
       ->select('teaching_loads.id','student_loads.student_id', 'users.name', 'users.lastname', 'users.middlename', 'users.profile_photo_path', 'teaching_loads.teacher_id', 'teaching_loads.subject_id', 'class_id', 'teaching_loads.active')
       ->orderBy('users.lastname')->orderBy('users.name')->get();

    return view('teaching-loads.view', compact('view_loads'));
      }else{
       return view('errors.unauthorized');
      }
    }else{
     return view('errors.unauthorized');
    }
   }
  

    
}
