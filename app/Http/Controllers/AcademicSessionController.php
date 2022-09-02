<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Models\AcademicSession;
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

     
        $academic_year = AcademicSession::create([
            'academic_session' => $request->academic_year,
            ]);


       if(isset($request->make_active)){
        $reset=AcademicSession::where('active',1)->update([
            'active'=>0      
      ]);
        $update=AcademicSession::where('academic_session',$request->academic_year)->update([
            'active'=>1       
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

    // $session_exists=AcademicSession::where('academic_session', $request->academic_year)->first();
    // // if($request->academic_year==){
    // //     $session_exists->academic_session==$request->academic_year)
    // // }



    try {
      
           $update=AcademicSession::find($request->session_id)->update([
            'academic_session'=>$request->academic_year

    
           ]);

           if(isset($request->status)){


            if ($request->status=="true") {
                $reset=AcademicSession::where('active',1)->update([
                    'active'=>0      
              ]);
              $update=AcademicSession::find($request->session_id)->update([
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
