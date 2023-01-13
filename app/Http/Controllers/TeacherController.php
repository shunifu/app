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
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Encryption\DecryptException;

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

    
    //     $mark=Mark::where('teacher_id',$id)->exists();
    //     if($mark){

    //         flash()->overlay('Caution. The teacher has marks attached to the marks table. Transfer those loads to another teacher first then this teacher will be deleted', 'Delete Teacher');

    //     }else{
           
    //         $teacher_role_id=$getRole->id;
    //         $teacher->detachRole($getRole);
    //         $getTeacher=User::where('role_id', $teacher_role_id)->get();
    //         $delete=User::find($id)->delete();

    //         flash()->overlay('<i class="fas fa-check-circle "></i>'.' Success.You have deleted teacher', 'Delete Teacher');
    //     }
       

    //     return Redirect::back();

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

            flash()->overlay($teacher_name."'s has been deactivated from the system. The teacher won't be able to login again into the system. To undo deactivation click", 'Deactivate Teacher');

    
            return Redirect::back();
            
        } catch (DecryptException $e) {
            return view('errors.unauthorized');
        }


    }

    public function class_teacher(){

        //Get current session
        $getRole=Role::where('name', 'teacher')->first();
        $teacher_role_id=$getRole->id;
        $getTeacher=User::where('role_id', $teacher_role_id)->get();

        $classes=Grade::all();
        $session=AcademicSession::where('active', 1)->get();

        $result=DB::table('grades_teachers')
            ->join('grades','grades_teachers.grade_id','=','grades.id')
            ->join('users','grades_teachers.teacher_id','=','users.id')
            ->join('academic_sessions','grades_teachers.academic_session','=','academic_sessions.id')
            ->select('grades.grade_name', 'users.name','users.lastname', 'users.salutation', 'academic_sessions.academic_session', 'grades_teachers.id')
            ->orderBy('grades.grade_name','asc')
            ->get();

return view('users.teachers.classteacher', compact('getTeacher', 'classes', 'session', 'result'));
    }

    public function assign_classteacher(Request $request){


        //validation
           $this->validate($request,[
                'grade_id'=>'required',
                'academic_session'=>'required',
                'teacher_id'=>'required',
             
               ]);

    $class_teacher_role=Role::where('name', 'class_teacher')->first();
    $class_teacher_name=$class_teacher_role->id;


        $classteacher = GradeTeacher::create([ 
            'teacher_id'=>$request->teacher_id,
            'grade_id'=>$request->grade_id,
            'academic_session'=>$request->academic_session,
       ]);
      
       $user=User::find($request->teacher_id);
       $user->attachRole($class_teacher_role);


       flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have added a class teacher', 'Add Class Teacher');

       return Redirect::back();
      

    }

    public function classteacher_delete($id){
        $getRole=Role::where('name', 'class_teacher')->first();
        $classteacher_role_id=$getRole->id;
        

    if(Auth::user()->hasRole('admin_teacher')){

    $user=GradeTeacher::find($id);
    
    $teacher_id=$user->teacher_id;
    $teacher=User::find($teacher_id);

    //remove class_teacher role
    $teacher->detachRole($getRole);

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

   
}

 