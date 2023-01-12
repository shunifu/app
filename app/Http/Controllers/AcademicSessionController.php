<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Models\AcademicSession;
use App\Models\Mark;
use App\Models\StudentClass;
use App\Models\StudentLoad;
use App\Models\TeachingLoad;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AcademicSessionController extends Controller
{
    public function create(){

        //add Security
       
    //     $academic_sessions=DB::table('academic_sessions')
    //     ->join('terms', 'academic_sessions.id', '=', 'terms.academic_session')
    //     ->get();

    //   //  dd($academic_sessions);

        $academic_sessions=AcademicSession::all();
        
        return view('academic-admin.academic-session-management.session.index', compact('academic_sessions'));
    }

    public function store(Request $request){

        //Validations
        $validation=$request->validate([
            'academic_year'=>'required|digits:4|integer|min:2022|max:'.(date('Y')+1)
         
        ]);


        $currentActiveSession=AcademicSession::where('active', 1)->first();
        $session=$currentActiveSession->id;

     
        $academic_year = AcademicSession::create([
            'academic_session' => $request->academic_year,
            ]);


       if(isset($request->make_active)){

        //reset the academic year. Make the current session to inactive so that the newly created one can be active.
        $reset=AcademicSession::where('active',1)->update([
            'active'=>0      
      ]);

    

      
        //Make the newly created academic year active.
        $update=AcademicSession::where('academic_session',$request->academic_year)->update([
            'active'=>1       
      ]);


      //Update student grades
      StudentClass::where('academic_session', $session)->update([

        'active'=>0

      ]);

    

    //Update  student loads
      $studentLoads=DB::table('student_loads')
      ->join('teaching_loads','teaching_loads.id','=','student_loads.teaching_load_id')
      ->where('teaching_loads.session_id', $session)
      ->update([
        'student_loads.active'=>0
      ]);

       //Update  teaching_loads
       TeachingLoad::where('session_id', $session)->update([

        'active'=>0

      ]);

        //Update  marks
        Mark::where('session_id', $session)->update([

          'active'=>0
  
        ]);

  

     
       }
       flash()->overlay('<i class="fas fa-check-circle text-success"></i>'.' Congratulations. You have successfully added academic year.', 'Add Academic Year');
              
       return Redirect::back();

 

    }

    public function edit($id){

    
      $session=AcademicSession::find($id);

        return view('academic-admin.academic-session-management.session.edit', compact('session'));

    }


    public function update(Request $request){

      //validate

  
      
      $validation=$request->validate([
        'academic_year'=>'required|digits:4|integer|min:2021|max:'.(date('Y'))
    ]);

 




    try {
      
           $update=AcademicSession::find($request->session_id)->update([
            'academic_session'=>$request->academic_year

    
           ]);

           if(isset($request->status)){


            if ($request->status=="true") {
                $reset=AcademicSession::where('active',1)->update([
                    'active'=>0      
              ]);

              $resetStudentClasses=StudentClass::where('active',1)->update([
                'active'=>0      
          ]);

          $resetStudentLoads=StudentLoad::where('active',1)->update([
            'active'=>0      
      ]);

      $resetTeachingLoads=TeachingLoad::where('active',1)->update([
        'active'=>0      
  ]);

  $resetMarks=Mark::where('active',1)->update([
    'active'=>0      
]);

    //update  academic year to active
    $update=AcademicSession::find($request->session_id)->update([
                'active'=>1       
          ]);



      
    //     //Make the newly created academic year active.
    //     $update=AcademicSession::where('academic_session',$request->academic_year)->update([
    //       'active'=>1       
    // ]);


    //Update student grades
    StudentClass::where('academic_session', $request->session_id)->update([

      'active'=>1

    ]);

  

  //Update  student loads
    $studentLoads=DB::table('student_loads')
    ->join('teaching_loads','teaching_loads.id','=','student_loads.teaching_load_id')
    ->where('teaching_loads.session_id', $request->session_id)
    ->update([
      'student_loads.active'=>1,
      'teaching_loads.active'=>1
    ]);

     //Update  teaching_loads
     TeachingLoad::where('session_id', $request->session_id)->update([

      'active'=>1

    ]);

      //Update  marks
      Mark::where('session_id', $request->session_id)->update([

        'active'=>1

      ]);






            
            }
    
         
           }
    

           flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have updated Session', 'Update  Session');
           return redirect()->back();
      } catch (\Illuminate\Database\QueryException $e){
        $errorCode = $e->getCode();
     //   dd($errorCode);
        
            //Duplicate Entry 
flash()->overlay('<i class="fas fa-check-circle text-danger"></i> Error '.$errorCode.'..', 'Update Session');
            return redirect()->back();

        
      }
   

    



    }

    public function destroy(Request $request){

        dd($request);

    }
}
