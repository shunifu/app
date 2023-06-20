<?php

namespace App\Http\Controllers;

use Seshac\Otp\Otp;
use App\Models\Mark;
use App\Models\Role;
use App\Models\User;
use App\Models\Grade;
use App\Models\School;
use Spatie\Emoji\Emoji;
use Illuminate\Support\Str;
use App\Models\GradeTeacher;
use Illuminate\Http\Request;
use App\Imports\TeachersImport;
use App\Models\AcademicSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
use AfricasTalking\SDK\AfricasTalking;
use App\Models\CustomComment;
use App\Models\RoleUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TeacherController extends Controller
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

        if (Auth::user()->hasRole('admin_teacher')) {
			return view('users.teachers.index');
		} else {
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
        if(Auth::user()->hasRole('admin_teacher')){

            // $this->validate($request,[
            //     'salutation'=>'required',
            //     'first_name'=>'required',
            //     'last_name'=>'required',
               
            //     'cell_number'=>'required|min:8|max:8',
            //     'email'=>'required|email',
            //    ]);
            //get teacher role id
            $teacher_role=Role::where('name', 'teacher')->first();

              //Generate OTP
$otp =  mt_rand(1000,9999);
        
            $teacher = User::create([ 
                'name'=>$request->first_name,
                'salutation'=>$request->salutation,
                'middlename'=>$request->middle_name,
                'lastname'=>$request->last_name,
                'national_id'=>$request->national_id,
                'date_of_birth'=>$request->date_of_birth,
                'gender'=>$request->gender,
                'cell_number'=>$request->cell_number,
                'email'=>$request->email_address,
                'password'=>Hash::make($otp),
                'role_id'=>$teacher_role->id,
           ]);
           $teacher->attachRole($teacher_role);

           $username = config('app.sms_username');// use 'sandbox' for development in the test environment
           $apiKey   = config('app.sms_password'); // use your sandbox app API key for development in the test environment
           $AT = new AfricasTalking($username, $apiKey);
           
              // Get one of the services
              $sms      = $AT->sms();
           
              // Use the service
              $result   = $sms->send([
               'to'      => '+268'.$request->cell_number,
               'message' => 'Hi '.$request->name.'. Your Shunifu OTP is '.$otp.'. Go to '.URL::to('/').' .Need assistance? WhatsApp us on 76890726. Siyabonga '.$request->salutation.' '.$request->last_name.' ',
               'from'=>'Shunifu'
           ]);
           
          

    //     $otp =  Otp::setValidity(240)  // otp validity time in mins
    //   ->setLength(4)  // Lenght of the generated otp
    //   ->setMaximumOtpsAllowed(10) // Number of times allowed to regenerate otps
    //   ->setOnlyDigits(true)  // generated otp contains mixed characters ex:ad2312
    //   ->setUseSameToken(true) // if you re-generate OTP, you will get same token
    //   ->generate($teacher->id);

      
        //    User::find($teacher->id)->update([
        //     "password"=>$otp->token,
        //    ]);


        //    dd($teacher);
           //SEND otp

//            $apiKey = env('SMS_API_KEY');
// $apiSecret = env('SMS_API_SECRET');
// $accountApiCredentials = $apiKey . ':' .$apiSecret;


// $base64Credentials = base64_encode($accountApiCredentials);
// $authHeader = 'Authorization: Basic ' . $base64Credentials;

// $authEndpoint = 'https://rest.smsportal.com/Authentication';

// $authOptions = array(
//     'http' => array(
//         'header'  => $authHeader,
//         'method'  => 'GET',
//         'ignore_errors' => true
//     )
// );
// $authContext  = stream_context_create($authOptions);

// $result = file_get_contents($authEndpoint, false, $authContext);

// $authResult = json_decode($result);

// $status_line = $http_response_header[0];
// preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
// $status = $match[1];

// if ($status === '200') { 
//     $authToken = $authResult->{'token'};
    
//    // dd($authResult);
// }
// else {
//    // dd($authResult);
// }

// $sendUrl = 'https://rest.smsportal.com/bulkmessages';

// $authHeader = 'Authorization: Bearer ' . $authToken;

// $sendData = '{ "messages" : [ { "senderId" : "Shunifu", "content" : "Good Day, your One Time Password is '.$otp.' ", "destination" : '.$request->cell_number.' } ] }';

// $options = array(
//     'http' => array(
//         'header'  => array("Content-Type: application/json", $authHeader),
//         'method'  => 'POST',
//         'content' => $sendData,
//         'ignore_errors' => true
//     )
// );
// $context  = stream_context_create($options);

// $sendResult = file_get_contents($sendUrl, false, $context);

// $status_line = $http_response_header[0];
// preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
// $status = $match[1];

// if ($status === '200') {
//     //dd($sendResult);
    
//    return view('onboarding.otp', compact('user_cell'));
// }
// else {
//     //dd($sendResult);
// }
           
           
		flash()->overlay('Teacher Added. The teachers OTP sent via'.' <span class="text-bold">SMS </span> and is valid for 4 hours' , 'Add Teacher');

		return Redirect::back();

        }else{
            return view('errors.unauthorized'); 
        }
     
    }
    


    public function sendReminders(){

        $teacher_role=Role::where('name', 'teacher')->first();
        $role_id=$teacher_role->id;

        $Teachers=User::where('role_id',$role_id)->where('active', 1)->whereNotNull('cell_number')->get();
        // if ($unverifiedTeachers->exist()) {
            foreach($Teachers as $key){
       
                $username = config('app.sms_username');// use 'sandbox' for development in the test environment
                $apiKey   = config('app.sms_password'); // use your sandbox app API key for development in the test environment
                $AT = new AfricasTalking($username, $apiKey);
                
                   // Get one of the services
                   $sms      = $AT->sms();
                
                   // Use the service
                   $result   = $sms->send([
                    'to'      => '+268'.$key->cell_number,
                    'message' => 'Hi '.$key->name.'. This is a reminder that you add marks for your students today, if you still havent. Go to '.URL::to('/').' .Need help? WhatsApp on 76890726. Asbonge! '.$key->salutation.' '.$key->lastname.' ',
                    'from'=>'Shunifu'
                ]);
            }
            print_r($Teachers);


    }

    public function sendbulkOTPs(){

     
        $teacher_role=Role::where('name', 'teacher')->first();
        $role_id=$teacher_role->id;
      //  $otp="3456";

        $unverifiedTeachers=User::where('role_id',$role_id)->whereNull('status')->orWhere('status',0)->whereNotNull('cell_number')->get();
        // if ($unverifiedTeachers->exist()) {
            foreach($unverifiedTeachers as $key){
       

                $otp =  Otp::generate($key->id);
                $update=User::find($key->id)->update([

                    'password'=>Hash::make($otp->token),
            
                ]);
               
                $username = config('app.sms_username');// use 'sandbox' for development in the test environment
                $apiKey   = config('app.sms_password'); // use your sandbox app API key for development in the test environment
                $AT = new AfricasTalking($username, $apiKey);
                
                   // Get one of the services
                   $sms      = $AT->sms();
                
                   // Use the service
                   $result   = $sms->send([
                    'to'      => '+268'.$key->cell_number,
                    'message' => 'Hi '.$key->name.'. Shunifu OTP is.  '.$otp->token.'. Go to '.URL::to('/').' .Need help? WhatsApp on 76890726. Siyabonga '.$key->salutation.' '.$key->lastname.' ',
                    'from'=>'Shunifu'
                ]);
            }
            print_r($unverifiedTeachers);
       
        
    

    }

    public function import(Request $request){

        $this->validate($request, [
            'import' => 'required|mimes:xls,xlsx,csv'
         ]);
    
  
        Excel::import(new TeachersImport, $request->file('import'));
        
        flash()->overlay('Success. You have added a teacher', 'Add Teacher');

      return redirect('/users/teachers/manage');
	
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

            try {
                $decrypted = Crypt::decryptString($id);
                $result_user=User::find($decrypted);
                if(Auth::user()->hasRole('admin_teacher') OR Auth::user()->id==$decrypted){
                return view('users.teachers.profile', compact('result_user'));
                }else{
                return view('errors.unauthorized');
        }
            } catch (DecryptException $e) {
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
          //  $numberExists=User::where('cell_number', $request->cell)->exists();
          //  $emailExists=User::where('email', $request->email)->exists();
          //  $IDExists=User::where('email', $request->national_id)->exists();
          

           

         //   $this->validate($request,[
          //      'cell_number'=>'required|min:8|max:8|numeric',
          //      'email'=>'required|email',
           //    ]);
      
           try {
            //once you change cell number or email then 
            //1. 
            $update=$user->update([
                'name'=>$request->first_name,
                'middlename'=>$request->middle_name,
                'lastname'=>$request->last_name,
                'national_id'=>$request->national_id,
                'date_of_birth'=>$request->date_of_birth,
                'gender'=>$request->gender, 
                'email'=>$request->email,
                'salutation'=>$request->salutation,
                'cell_number'=>$request->cell
            ]);

            flash()->overlay(' <i class="fas fa-check-circle text-success"></i> Success. You have successfully updated '.$request->first_name."'".'s profile data', 'Update Teacher');

            return Redirect::back();

          } catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->getCode();
            if($errorCode == 23000){
                flash()->overlay('<i class="fas fa-exclamation-triangle text-danger"></i> Error. Duplicate Entry', 'Update Teacher');

                return Redirect::back();


            }
          }

          
    
       
    }
        
    }

    public function login($id){

        //if teacher admin teacher pr deputy or principal do not login into that account
        //flush out session first and then login

        if (Auth::user()->hasRole('admin_teacher')) {
            try {
                $decrypted = Crypt::decryptString($id);
                $user_data=User::find($decrypted);

                //if user is also an admin disable login
                // if ($user_data->active==1) {
                // }

                $userIs=$user_data->update([
                    'status'=>1,
                ]);



                if ($user_data->active==1) {
                    Auth::loginUsingId($decrypted, true);
                    return redirect()->route('dashboard');
                }else{

                    flash()->overlay($user_data->name."'s profile has been deactivated. Cannot login into that account ", 'Login in Teachers Account');
                    return Redirect::back();

                }
            } catch (DecryptException $e) {
                return view('errors.unauthorized');
            }
        }else{
            return view('errors.unauthorized'); 
        }
    }



    public function undo($id){

        

        

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

       
       

            // $apiKey = env('SMS_API_KEY');
        // $apiSecret = env('SMS_API_SECRET');
        // $accountApiCredentials = $apiKey . ':' .$apiSecret;
        
        
        // $base64Credentials = base64_encode($accountApiCredentials);
        // $authHeader = 'Authorization: Basic ' . $base64Credentials;
        
        // $authEndpoint = 'https://rest.smsportal.com/Authentication';
        
        // $authOptions = array(
        //     'http' => array(
        //         'header'  => $authHeader,
        //         'method'  => 'GET',
        //         'ignore_errors' => true
        //     )
        // );
        // $authContext  = stream_context_create($authOptions);
        
        // $result = file_get_contents($authEndpoint, false, $authContext);
        
        // $authResult = json_decode($result);
        
        // $status_line = $http_response_header[0];
        // preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
        // $status = $match[1];
        
        // if ($status === '200') {
        //     $authToken = $authResult->{'token'};
            
        //    // dd($authResult);
        // }
        // else {
        //    // dd($authResult);
        // }
        
        // $sendUrl = 'https://rest.smsportal.com/bulkmessages';
        
        // $authHeader = 'Authorization: Bearer ' . $authToken;
        
        // $sendData = '{ "messages" : [ { "senderId" : "Shunifu", "content" : "Good Day '.$user_data->name.', '.'your OTP is '.$uniqid.'. Use this OTP, together with your email to login to the Shunifu Platform. Make sure to create your password after login. '.env('APP_URL').' ", "destination" : '.$user_data->cell_number.' } ] }';
        
        // $options = array(
        //     'http' => array(
        //         'header'  => array("Content-Type: application/json", $authHeader),
        //         'method'  => 'POST',
        //         'content' => $sendData,
        //         'ignore_errors' => true
        //     )
        // );
        // $context  = stream_context_create($options);
        
        // $sendResult = file_get_contents($sendUrl, false, $context);
        
        // $status_line = $http_response_header[0];
        // preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
        // $status = $match[1];
        }else{
            return view('errors.unauthorized');
        }
    }

    public function view(Request $request){
        //view a list of teachers
        if(Auth::user()->hasRole('admin_teacher')){
       
    $teacher_role=Role::where('name', 'teacher')->first();
    $teacher_id=$teacher_role->id;

    $result=User::where('role_id', $teacher_id)->orderBy('active', 'DESC')->get();
    $result_total=User::where('role_id', $teacher_id)->where('active', 1)->count();


    

      
        return view('users.teachers.view', compact('result'));
    }else{
        return view('errors.unauthorized');
    }

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    
        // $mark=Mark::where('teacher_id',$id)->exists();
        // if($mark){

        //     flash()->overlay('Caution. The teacher has marks attached to the marks table. Transfer those loads to another teacher first then this teacher will be deleted', 'Delete Teacher');

        // }else{
           
        //     $teacher_role_id=$getRole->id;
        //     $teacher->detachRole($getRole);
        //     $getTeacher=User::where('role_id', $teacher_role_id)->get();
        //     $delete=User::find($id)->delete();

        //     flash()->overlay('<i class="fas fa-check-circle "></i>'.' Success.You have deleted teacher', 'Delete Teacher');
        // }
       

        // return Redirect::back();

    }


    public function reactivate($id){

        //remove from being class teacher
         //remove from being HOD teacher
         //deattach

        //make active =0
        


        try {
            $decrypted = Crypt::decryptString($id);
            $user=User::find($decrypted);

            $teacher_name=$user->name;
            $deactivate=$user->active=1;
            $user->save();


            //if classteacher, remove from classs teachers list
            //if has marks ???

            flash()->overlay($teacher_name."'s has been reactivated from the system. The teacher will now be able to login again into the system. ", 'Reactivate Teacher');


            return Redirect::back();
            
        } catch (DecryptException $e) {
            return view('errors.unauthorized');
        }


    }

    public function archive($id){

        //remove from being class teacher
         //remove from being HOD teacher
         //deattach

        //make active =0


        try {
            $decrypted = Crypt::decryptString($id);
            $user=User::find($decrypted);

            $teacher_name=$user->name;
            $deactivate=$user->active=0;
            $user->save();


            //if classteacher, remove from classs teachers list
            //if has marks ???

            flash()->overlay($teacher_name."'s has been removed from the system. The teacher will not be able to login again into the system. ", 'Remove Teacher');


            return Redirect::back();
            
        } catch (DecryptException $e) {
            return view('errors.unauthorized');
        }
        




    }

    public function class_teacher(){


        if (!Schema::hasTable('custom_comments')) {
            Schema::create('custom_comments', function($table){
                  
                   $table->id();
                   $table->integer('student_id');
                   $table->integer('term_id');
                   $table->integer('class_id');
                   $table->longText('comment');
                   $table->integer('teacher_id');
                   $table->integer('manager_type');
                   $table->timestamps();
           });
       }

        if (!Schema::hasColumn('grades_teachers', 'class_manager_status')) {
        
            Schema::table('grades_teachers', function (Blueprint $table) {
    
                $table->integer('class_manager_status')->nullable();
            });
        }

        $classtutorexists=Role::where('name','class_tutor')->exists();

        if($classtutorexists){

        }else{
            Role::create([
                'name' => 'class_tutor', 
            ]);
        }
        

        //Get current session
        $getRole=Role::where('name', 'teacher')->first();
        $teacher_role_id=$getRole->id;
        $getTeacher=User::where('role_id', $teacher_role_id)->orderBy('name')->get();

        $classes=Grade::all();
        $session=AcademicSession::where('active', 1)->get();
       $session_id=$session[0]->id;

        $result=DB::table('grades_teachers')
            ->join('grades','grades_teachers.grade_id','=','grades.id')
            ->join('users','grades_teachers.teacher_id','=','users.id')
            ->join('academic_sessions','grades_teachers.academic_session','=','academic_sessions.id')
            ->select('grades.grade_name', 'users.name','users.lastname', 'users.salutation', 'academic_sessions.academic_session', 'grades_teachers.id', 'class_manager_status')
            ->where('grades_teachers.academic_session', $session_id)
            ->orderBy('grades.grade_name','asc')
            ->get();

return view('users.teachers.classteacher', compact('getTeacher', 'classes', 'session', 'result'));
    }



//     public function class_tutor(){

//         if (!Schema::hasTable('class_tutors')) {
//             Schema::create('class_tutors', function($table){
                  
//                    $table->id();
//                    $table->integer('teacher_id');
//                    $table->integer('class_id');
//                    $table->integer('academic_session');
//                    $table->timestamps();
//            });

           
//        }


//         //Get current session
//         $getRole=Role::where('name', 'teacher')->first();
//         $teacher_role_id=$getRole->id;
//         $getTeacher=User::where('role_id', $teacher_role_id)->orderBy('name')->get();

//         $classes=Grade::all();
//         $session=AcademicSession::where('active', 1)->get();
//        $session_id=$session[0]->id;

//         $result=DB::table('class_tutors')
//             ->join('grades','class_tutors.class_id','=','grades.id')
//             ->join('users','class_tutors.teacher_id','=','users.id')
//             ->join('academic_sessions','class_tutors.academic_session','=','academic_sessions.id')
//             ->select('grades.grade_name', 'users.name','users.lastname', 'users.salutation', 'academic_sessions.academic_session', 'class_tutors.id')
//             ->where('class_tutors.academic_session', $session_id)
//             ->orderBy('grades.grade_name','asc')
//             ->get();

// return view('users.teachers.classtutor', compact('getTeacher', 'classes', 'session', 'result'));
//     }

    public function assign_classteacher(Request $request){


    //    dd($request->all());


        //validation
           $this->validate($request,[
                'grade_id'=>'required',
                'academic_session'=>'required',
                'teacher_id'=>'required',
             
               ]);


        Schema::table('grades_teachers', function (Blueprint $table) {

        $index_exists = collect(DB::select("SHOW INDEXES FROM grades_teachers"))->pluck('Key_name')->contains('grades_teachers_teacher_id_unique');
        
        if ($index_exists) {
        $table->dropForeign(['teacher_id']);
        $table->dropUnique(['teacher_id']);
        
        }
   
    });

    $class_teacher_role=Role::where('name', 'class_teacher')->first();

    
    $class_teacher_name=$class_teacher_role->id;


    //Check if teacher is already assigned in same class, same year

    $teacherExists=GradeTeacher::where('teacher_id', $request->teacher_id)->where('academic_session', $request->academic_session)->exists();

    // if($teacherExists){

    //     flash()->overlay('<i class="fas fa-exclamation-circle text-danger"></i> Error. Teacher already assigned for the year', 'Add Class Teacher');

    
    //     return Redirect::back();

    // }else{

 




    $getClassTutorRole=Role::where('name', 'class_tutor')->first();
    $class_tutor_role_id=$getClassTutorRole->id;
    


    

    //end of check

        $classteacher = GradeTeacher::create([ 
            'teacher_id'=>$request->teacher_id,
            'grade_id'=>$request->grade_id,
            'academic_session'=>$request->academic_session,
           'class_manager_status'=>$request->manager_type,
       ]);
      
       $user=User::find($request->teacher_id);


       if ($request->manager_type=="1") {
        # class teacher
        $user->detachRole($class_teacher_role);
        $user->attachRole($class_teacher_role);
      
       }  elseif ($request->manager_type=="2") {
        $user->detachRole($class_tutor_role_id);
        $user->attachRole($class_tutor_role_id);
 
       }


       if ($request->manager_type=="1") {
        flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have successfully added a class teacher/Home room', 'Add Class Teacher');
       }else{
        flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have successfully added a class tutor', 'Add Class Tutor');
       }

       return Redirect::back();
    
}





public function class_teacher_edit($id){


    try {
        $decrypted = Crypt::decrypt($id);
      //  $decrypted_id=GradeTeacher::find($decrypted);



        $class_data=DB::table('grades_teachers')
        ->join('grades','grades_teachers.grade_id','=','grades.id')
        ->join('users','grades_teachers.teacher_id','=','users.id')
        ->select('grades_teachers.id as id','grades.grade_name','users.id as teacher_id',  'users.name','users.lastname', 'users.salutation', 'grades.id as grade_id')
        ->where('grades_teachers.id', $decrypted)
        ->first();

  

        $teacher_role=Role::where('name', 'teacher')->first();
        $teacher_role_id=$teacher_role->id;

        $teachers=User::where('role_id', $teacher_role_id)->where('active', 1)->orderBy('lastname')->get();

        return view('users.teachers.class-teacher.edit', compact('class_data', 'teachers'));

        
    } catch (DecryptException $e) {
        dd($e);
    }

}
public function class_teacher_update(Request $request){


    $this->validate($request, [
        'class_teacher' => 'required'
     ]);

     $activeSession=AcademicSession::where('active', 1)->first();
     $activeSessionID=$activeSession->id;


     //Check if class teacher has already been added into class

     $teacherExists=GradeTeacher::where('teacher_id', $request->class_teacher)->where('academic_session',$activeSessionID )->exists();

     
     if ($teacherExists) {
        flash()->overlay('<i class="fas fa-exclamation-circle text-danger"></i> Error. Teacher has already been assigned to a class for the current academic year', 'Update Class Teacher');

        return Redirect::back();
     }else{


      GradeTeacher::where('id', $request->id)->update([
        'teacher_id'=>$request->class_teacher
      ]);
      
    
        
        flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have successfully updated  class teacher', 'Update Class Teacher');
    
         return redirect('/users/teacher/assign/classteacher');
         

     }

  


}

    public function classteacher_delete($id){
        $getRole=Role::where('name', 'class_teacher')->first();
        $getClassTutorRole=Role::where('name', 'class_tutor')->first();
        $classteacher_role_id=$getRole->id;
        $classtutor_role_id=$getRole->id;
        

    if(Auth::user()->hasRole('admin_teacher')){

    $user=GradeTeacher::find($id);
    
    $teacher_id=$user->teacher_id;
    $teacher=User::find($teacher_id);

    //remove class_teacher role
    $teacher->detachRole($getRole);
    $teacher->detachRole($getClassTutorRole);

    //delete teacher
    $delete=$user->delete();

    return response()->json([
        'status'=>200,
        'message'=>"Class Teacher deleted successfully",

    ]);

    // flash()->overlay('Success. You have deleted class teacher', 'Delete Class Teacher');

    return Redirect::back();

    }else{
            return view('errors.unauthorized');
        }

    }

    public function class_list(){

        $getRole=Role::where('name', 'class_teacher')->first();
        $classteacher_role_id=$getRole->id;

        if(Auth::user()->hasRole('class_teacher')){

            //Get teachers class scoped to current year or active session
            $current_year=AcademicSession::where('academic_session', date('Y'))->first();
           
            
            $loggedinClassTeacher=Auth::user()->id;
         
            // $class_teacher=GradeTeacher::where('teacher_id', $loggedinClassTeacher)->where('academic_session', $current_year->id)->first();

            $class_info=DB::table('grades_teachers')
            ->join('users','grades_teachers.teacher_id','=','users.id')
            ->join('grades','grades_teachers.grade_id','=','grades.id')
            ->join('academic_sessions','grades_teachers.academic_session','=','academic_sessions.id')
            ->where('grades_teachers.academic_session',$current_year->id)
            ->where('grades_teachers.teacher_id',$loggedinClassTeacher)
            ->select('users.name','users.lastname', 'users.salutation', 'academic_sessions.academic_session', 'grade_name', 'grade_id')
            ->first();

            

            $class_list=DB::table('grades_students')
            ->join('users','grades_students.student_id','=','users.id')
            ->join('academic_sessions','grades_students.academic_session','=','academic_sessions.id')
            ->where('grades_students.academic_session',$current_year->id)
            ->where('grades_students.grade_id',$class_info->grade_id)
            ->select('users.id as user_id','users.name','users.lastname','users.middlename', 'users.salutation', 'academic_sessions.academic_session', 'grade_id')
            ->orderBy('users.lastname','asc')
            ->get();

            $school_info=School::all();
           
            return view('academic-admin.class-management.class_list', compact('class_list', 'class_info', 'school_info'));


        }else{
            //Unautoried not found
            return view('errors.uauthorized');
        }



    }

    public function classteacher_comments_index(){
    
        $classteacher_list=DB::table('grades_teachers')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'grades_teachers.academic_session')
        ->join('grades', 'grades.id', '=', 'grades_teachers.grade_id')
        ->join('users', 'users.id', '=', 'grades_teachers.teacher_id')
        ->where('academic_sessions.active', 1)
        // ->where('class_manager_status', '1')
        // ->orWhere('class_manager_status', NULL)
        
        ->where('grades_teachers.teacher_id', Auth::user()->id)
        ->select('users.id as teacher_id', 'users.name', 'users.middlename', 'users.lastname', 'users.salutation', 'grades_teachers.teacher_id', 'grades_teachers.grade_id', 'grades.grade_name')
        ->first();
     

        $terms = DB::table('terms')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'terms.academic_session')
        ->where('academic_sessions.active', 1)
        ->select('terms.id as id', 'academic_sessions.id as session_id', 'terms.term_name')
        ->get();



      
    
      

        return view('academic-admin.comments-management.custom.index', compact('classteacher_list', 'terms'));


    }


    public function classtutor_comments_index(){
    
        $classteacher_list=DB::table('grades_teachers')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'grades_teachers.academic_session')
        ->join('grades', 'grades.id', '=', 'grades_teachers.grade_id')
        ->join('users', 'users.id', '=', 'grades_teachers.teacher_id')
        ->where('academic_sessions.active', 1)
        // ->where('class_manager_status', '1')
        // ->orWhere('class_manager_status', NULL)
        
        ->where('grades_teachers.teacher_id', Auth::user()->id)
        ->select('users.id as teacher_id', 'users.name', 'users.middlename', 'users.lastname', 'users.salutation', 'grades_teachers.teacher_id', 'grades_teachers.grade_id', 'grades.grade_name')
        ->get();
     

        $terms = DB::table('terms')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'terms.academic_session')
        ->where('academic_sessions.active', 1)
        ->select('terms.id as id', 'academic_sessions.id as session_id', 'terms.term_name')
        ->get();



   //   dd($classteacher_list);
    
      

        return view('academic-admin.comments-management.custom.index-tutor', compact('classteacher_list', 'terms'));


    }

    // public function classtutor_comments_index(){


    //     $classteacher_list=DB::table('grades_teachers')
    //     ->join('academic_sessions', 'academic_sessions.id', '=', 'grades_teachers.academic_session')
    //     ->join('grades', 'grades.id', '=', 'grades_teachers.grade_id')
    //     ->join('users', 'users.id', '=', 'grades_teachers.teacher_id')
    //     ->where('academic_sessions.active', 1)
    //     ->where('grades_teachers.teacher_id', Auth::user()->id)
    //     ->select('users.id as teacher_id', 'users.name', 'users.middlename', 'users.lastname', 'users.salutation', 'grades_teachers.teacher_id', 'grades_teachers.grade_id', 'grades.grade_name')
    //     ->first();
    //     //  dd($classteacher_list);
    //     $date= Carbon::now()->format('Y-m-d');

    //     $terms = DB::table('terms')
    //     ->join('academic_sessions', 'academic_sessions.id', '=', 'terms.academic_session')
    //     ->where('academic_sessions.active', 1)
    //     ->select('terms.id as id', 'academic_sessions.id as session_id', 'terms.term_name')
    //     ->get();




    //     return view('academic-admin.comments-management.custom.index-tutor', compact('classteacher_list', 'date', 'student_list', 'terms'));


    // }

    public function classteacher_comments_view(Request $request){
       
      
     //  dd($request->all());



        $teacher_id=$request->teacher_id;
        $term=$request->term;
        $grade_id=$request->grade_id;
        $manger_type=$request->type;


        $student_list=DB::select(DB::raw("SELECT
         grades_students.student_id,
        users.name,
        users.id as student_id,
        users.salutation,
        users.middlename,
        users.lastname,
       (SELECT custom_comments.comment from custom_comments INNER JOIN grades_students b ON b.student_id=custom_comments.student_id  WHERE custom_comments.class_id=".$grade_id." AND custom_comments.manager_type=".$manger_type." AND custom_comments.teacher_id=".$teacher_id." AND b.active=1 AND grades_students.student_id=custom_comments.student_id) as comment,
       grades.id as grade_id,
        grades.grade_name,
        term_averages.student_average,
        term_averages.number_of_passed_subjects,
        term_averages.passing_subject_status,
        term_averages.updated_at as last_updated
       
       FROM
           grades_students
           INNER JOIN users ON users.id=grades_students.student_id
           INNER JOIN term_averages ON term_averages.student_id=grades_students.student_id
           INNER JOIN grades ON grades.id=grades_students.grade_id
          WHERE grades_students.grade_id =".$grade_id." AND grades_students.active=1   AND term_averages.term_id=".$term."  AND users.active=1 
       ORDER BY `users`.`lastname`, `users`.`name` ASC"));

   //    dd($student_list);

    //       $student_list=DB::table('grades_students')
    //     ->join('academic_sessions', 'academic_sessions.id', '=', 'grades_students.academic_session')
    //     ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
    //     ->join('users', 'users.id', '=', 'grades_students.student_id')
    //     ->where('academic_sessions.active', 1)
    //     ->where('grades_students.grade_id', $grade_id)
    //     ->select('users.name', 'users.middlename', 'users.lastname', 'users.salutation', 'grades_students.student_id', 'grades.grade_name')
    //     ->get();


        $classteacher_list=DB::table('grades_teachers')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'grades_teachers.academic_session')
        ->join('grades', 'grades.id', '=', 'grades_teachers.grade_id')
        ->join('users', 'users.id', '=', 'grades_teachers.teacher_id')
        ->where('academic_sessions.active', 1)
        ->where('class_manager_status', $manger_type)
    //    ->orWhere('class_manager_status', NULL)
        ->where('grades_teachers.teacher_id', Auth::user()->id)
        ->select('users.id as teacher_id', 'users.name', 'users.middlename', 'users.lastname', 'users.salutation', 'grades_teachers.teacher_id', 'grades_teachers.grade_id', 'grades.grade_name', 'grades_teachers.class_manager_status')
        ->first();


        $terms = DB::table('terms')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'terms.academic_session')
        ->where('academic_sessions.active', 1)
        ->select('terms.id as id', 'academic_sessions.id as session_id', 'terms.term_name')
        ->get();

       

        return view('academic-admin.comments-management.custom.view', compact('classteacher_list',  'student_list', 'terms', 'teacher_id','term','grade_id','manger_type'));

    }


    public function classteacher_comments_store(Request $request){

     //  dd($request->all());

        if (!Schema::hasTable('custom_comments')) {
            Schema::create('custom_comments', function($table){
                  
                   $table->id();
                   $table->integer('student_id');
                   $table->integer('term_id');
                   $table->integer('class_id');
                   $table->longText('comment');
                   $table->integer('teacher_id');
                   $table->integer('manager_type');
                   $table->timestamps();
           });
       }


        //validation

        $validation=$request->validate([
          
            'comment'=>'required',
           
        ]);

        $students=$request->student_id;
        $term=$request->term;
        $grade_id=$request->grade_id;
        $comment=$request->comment;
        $teacher=$request->teacher_id;
        $type=$request->manager_type;

        //dd($type);


     //   dd($comment);
        
       

        //You should use update or create
   
        for($i = 0; $i <count($students); $i++) {
      
          //  dd($comment[$i]);
            $attendance=CustomComment::updateOrCreate([
            'student_id'=>$students[$i],
            'teacher_id'=>$teacher[$i],
            'term_id'=>$term[$i],
            'class_id'=>$grade_id[$i],
            'manager_type'=>$type[$i],
         //   'comment'=>$comment[$i],
            ], ['comment'=>$comment[$i]]);

         }

         flash()->overlay('<i class="fas fa-check-circle text-success"></i>'.' Congratulations. You have successfully added student comments'.' '.'</span> '.'into the comment bank .', 'Add Comments');


         if($type==1){
            return redirect('/class/classteacher/comments');
         }else{
            return redirect('/class/classtutor/comments');
         }
 
       

    }
   
}

 