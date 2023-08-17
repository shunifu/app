<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Term;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
// use Seshac\Otp\Otp;

class ParentController extends Controller
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
      return view('users.parents.index');
    }

    public function manage()
    {

        $getRole=Role::where('name', 'parent')->first();
        $parent_role_id=$getRole->id;
        $getParent=User::where('role_id', $parent_role_id)->get();

        
        return view('users.parents.manage', compact('getParent'));

        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasRole('admin_teacher') OR Auth::user()->hasRole('office_admin')){

            $this->validate($request,[
                'salutation'=>'required',
               
                'first_name'=>'required',
                'last_name'=>'required',
                'cell_number'=>'required|min:8|max:8',
                'email_address'=>'email',
               ]);
            $parent_role=Role::where('name', 'parent')->first();
            $otp=Str::random(24);
            $parent = User::create([ 
                'name'=>$request->first_name,
                'salutation'=>$request->salutation,
                'middlename'=>$request->middle_name,
                'lastname'=>$request->last_name,
                
                'cell_number'=>$request->cell_number,
                'email'=>$request->email_address,
                'password'=>Hash::make($otp),
                'status'=>1,
                'role_id'=>$parent_role->id,
           ]);
           $parent->attachRole($parent_role);

           //SEND otp
           
           
           flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have added parent', 'Add Parent');
           return redirect('/users/parents/manage');

        }else{
            return view('errors.unauthorized'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $isAdmin=Auth::user()->hasRole('admin_teacher');
       $isUser=Auth::user()->id==$id;

        if($isAdmin OR $isUser){
            $result_user=User::find($id);
        

            return view('users.parents.view', compact('result_user'));
            }else{
                return view('errors.unauthorized');
            }
            

        }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id=$request->id;
        $loggedin=Auth::user()->id;


        if(Auth::user()->hasRole('admin_teacher') OR ($loggedin==$id)){
            $user=User::find($id);
       
           try {
            $update=$user->update(['name'=>$request->first_name,'middlename'=>$request->middle_name, 'lastname'=>$request->last_name, 'national_id'=>$request->national_id,'date_of_birth'=>$request->date_of_birth,'gender'=>$request->gender, 'email'=>$request->email,'cell_number'=>$request->cell]);

            flash()->overlay(' <i class="fas fa-check-circle text-success"></i> Success. You have successfully updated '.$request->first_name."'".'s profile data', 'Update Parent');

            return Redirect::back();

          } catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->getCode();
            if($errorCode == 23000){
                flash()->overlay('<i class="fas fa-exclamation-triangle text-danger"></i> Error. Duplicate Entry', 'Update Parent');

                return Redirect::back();


            }
          }

          
    
       
    }
    }

    public function child_performance(Request $request){

     //  dd($request->all());

      
        $assessement_id=$request->assessement_id;
        $student_id=$request->student_id;


        $kid= DB::table('assessement_progress_reports')
        ->join('grades', 'grades.id', '=', 'assessement_progress_reports.student_class')
        ->join('users', 'users.id', '=', 'assessement_progress_reports.student_id')
		->where('assessement_progress_reports.student_id', $student_id)
        ->where('users.id', $student_id)
        ->where('assessement_id', $assessement_id)
        ->select('profile_photo_path','grade_name', 'name', 'lastname', 'middlename', 'number_of_passed_subjects','passing_subject_status','student_average')
	    ->first();

    //    dd($kid);

      
        

        $marks= DB::table('marks')
        ->join('teaching_loads', 'teaching_loads.id', '=', 'marks.teaching_load_id')
        ->join('assessements', 'assessements.id', '=', 'marks.assessement_id')
        ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
        ->join('users', 'users.id', '=', 'marks.student_id')
		->where('marks.student_id', $student_id)
        ->where('assessement_id', $assessement_id)
        ->select('profile_photo_path', 'name', 'lastname','subject_name as label', 'middlename', 'marks.mark as value', 'assessements.assessement_name')
	    ->get();

        $assessement_data= DB::table('marks')
        ->join('assessements', 'assessements.id', '=', 'marks.assessement_id')
		->where('marks.student_id', $student_id)
        ->where('marks.assessement_id', $assessement_id)
        ->select('assessements.assessement_name')
	    ->first();

        // dd($assessement);

        
        // $exam= DB::table('marks')
        
        // ->join('teaching_loads', 'teaching_loads.id', '=', 'marks.teaching_load_id')
        // ->join('assessements', 'assessements.id', '=', 'marks.assessement_id')
        // ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
        // ->join('users', 'users.id', '=', 'marks.student_id')
		// ->where('marks.student_id', $id)
        // ->where('marks.assessement_id', 5)
        // ->select('assessement_name','profile_photo_path', 'name', 'lastname','subject_name as label', 'middlename', 'marks.mark as value', 'assessements.assessement_name')
	    // ->get();

        // $test2= DB::table('marks')
        
        // ->join('teaching_loads', 'teaching_loads.id', '=', 'marks.teaching_load_id')
        // ->join('assessements', 'assessements.id', '=', 'marks.assessement_id')
        // ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
        // ->join('users', 'users.id', '=', 'marks.student_id')
		// ->where('marks.student_id', $id)
        // ->where('marks.assessement_id', 2)
        // ->select('assessement_name','profile_photo_path', 'name', 'lastname','subject_name as label', 'middlename', 'marks.mark as value', 'assessements.assessement_name')
	    // ->get();

       // dd($exam);

    
       $children = DB::table('parents_students')
       ->join('users', 'users.id', '=', 'parents_students.student_id')
       ->where('parents_students.parent_id', Auth::user()->id)
       ->get()->count();

       $mychildren = DB::table('parents_students')
       ->join('users', 'users.id', '=', 'parents_students.student_id')
       ->where('parents_students.parent_id', Auth::user()->id)
       ->get();

       $assessements=DB::table('assessements')
       ->join('terms','terms.id','=','assessements.term_id')
       ->join('assessement_types','assessement_types.id','=','assessements.assessement_type')
       ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
       ->where('academic_sessions.active', 1 )
       ->select('assessements.id as assessement_id','terms.term_name', 'assessement_name', 'assessement_type_name')
       ->get();


        return view('analytics.parent',compact('kid','marks','mychildren','assessement_data', 'assessements'));

    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }



    public function report_card(){


        // $children = DB::table('parents_students')
        // ->join('users', 'users.id', '=', 'parents_students.student_id')
        // ->where('parents_students.parent_id', Auth::user()->id)
        // ->get()->count();
 
    $children = DB::table('parents_students')
    ->join('users', 'users.id', '=', 'parents_students.student_id')
    ->join('grades_students', 'grades_students.student_id', '=', 'users.id')
    ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
    ->where('parents_students.parent_id', Auth::user()->id)
    ->where('users.active', 1)
    ->get();

        $terms=Term::all();


        return view('users.parents.performance.index',compact('children', 'terms'));

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



      public function reset($id){

        //generate otp

        if (Auth::user()->hasRole('admin_teacher')) {
            try {
                $decrypted = Crypt::decryptString($id);
                $user_data=User::find($decrypted);
                $teacher_name=$user_data->name;
                $teacher_surname=$user_data->lastname;
                $teacher_id=$user_data->id;
                $teacher_cell=$user_data->cell_number;
                $salutation=$user_data->salutation;


                if ($user_data->active==1) {

                    //generate OTP
                    $otp =  Otp::generate($teacher_id);

                   // dd($otp);

//https://

                 $url=substr( URL::to('/'),7);
                

                   //we $uniqid = mt_rand(1000, 9999);
                    $password=$user_data->password = Hash::make($otp->token);
                   $status= $user_data->status = 0;
                    $user_data->save();

                     //Send OTP via SMS

                    //check id cell_number is added

                    if(empty($teacher_cell)){
                        flash()->overlay($teacher_name."Does not have a cell number registered ", 'Send SMS');
                    }else{


                        $username = config('app.sms_username');// use 'sandbox' for development in the test environment
                     $apiKey   = config('app.sms_password'); // use your sandbox app API key for development in the test environment
                     $AT = new AfricasTalking($username, $apiKey);
                     
                        // Get one of the services
                        $sms      = $AT->sms();
                     
                        // Use the service
                        $result   = $sms->send([
                         'to'      => '+268'.$teacher_cell,
                         'message' => 'Hi '.$teacher_name.' Shunifu OTP is '.$otp->token.'. Go to '.URL::to('/').' .Need assistance? WhatsApp on 76890726. Thanks '.$salutation.' '.$teacher_surname.' ',
                         'from'=>'Shunifu'
                     ]);
                     
                        
                    }
    
                    flash()->overlay('OTP is '.$otp->token.' ', 'Generate One Time Password');
                } else {
                    flash()->overlay($teacher_name."'s OTP cannot be generated because that teacher is no longer active on the platform ", 'Generate One Time Password');
                }

                return Redirect::back();
            } catch (DecryptException $e) {
                return view('errors.unauthorized');
            }

       
       

        }else{
            return view('errors.unauthorized');
        }
    }
}
