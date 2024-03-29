<?php

namespace App\Http\Controllers;
//ini_set('max_execution_time', 23830);

use AfricasTalking\SDK\AfricasTalking;
use Seshac\Otp\Otp;
use App\Models\Mark;
use App\Models\Role;
use App\Models\User;
use App\Models\Grade;
use App\Models\Stream;
use App\Models\Session;
use \Illuminate\View\View;
use App\Models\Permission;
use \App\Tables\UsersTable;
use App\Models\StudentLoad;
use App\Models\TermAverage;
use Illuminate\Support\Str;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;

use App\Models\ParentStudent;
use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use App\Models\AcademicSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentsListTemplate;
use App\Imports\StudentMultiSheetImport;
use App\Models\StudentSubjectAverage;
use Illuminate\Support\Facades\Redirect;
use App\Models\AssessementProgressReport;
use App\Models\GradeTeacher;
use App\Models\Intervention;
use App\Models\School;
use App\Models\CBEMark;
use App\Models\Partner;
use App\Models\Sponsor;
use App\Models\StudentFees;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use FontLib\Table\Type\name;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session as Fas;
use Image;
use ImageOptimizer;
use PhpParser\Node\Stmt\TryCatch;
use Sabberworm\CSS\Property\Import;

// use Validator;



class StudentController extends Controller
{

    private $excel;
    public function __construct(Excel $excel){
        $this->excel=$excel;

    }


    public function send_msg(Request $request){



    //     $username = config('app.sms_username');
    //     $apiKey   = config('app.sms_password');
    //     $AT = new AfricasTalking($username, $apiKey);
    //     $sms      = $AT->sms();


    //         //        Use the service
    //         $result   = $sms->send([
    //             'to'      => '+268'.$request->parent_number,
    //             'message' => $request->parent_msg,
    //             'from'=>'Shunifu'
    // ]);


    flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have sent message ', 'Send Message');
    return Redirect::back();

    }


    public function store_student_updates(Request $request){


    //    dd($request->all());

        $school=School::first();
        $code=$school->school_code;
        $student_id=$request->student_id;

        $name=$request->name;
        $middlename=$request->middlename;
        $lastname=$request->lastname;
        $national_id=$request->national_id;
        $gender=$request->gender;
        $images = $request->student_image;
        $image=$request->file('student_image');


        $class_id=$request->class_id;

        $classes=Grade::all();
        $sessions=AcademicSession::where('active', 1)->get();


        $sesh=AcademicSession::where('active', 1)->first();
        $session_id=$sesh->id;





       // $allUploadApiReponse = array();
        if ($request->hasFile('student_image')) {
            $image = $request->file('student_image');
          //  Image::make($image->getRealPath())->resize(150, 150);

$student_image = cloudinary()->upload($request->file('student_image')->getRealPath(), [ 'folder' => 'shunifu','name'=>$code.'-'.$student_id, 'transformation' => [ 'quality' => 75 ]
])->getSecurePath();

        //   $image_new=ImageOptimizer::optimize($image);

        //     $image_new = $request->file('student_image')->storeOnCloudinaryAs('shunifu', $code.'-'.$student_id);

        //     $student_image=$image_new->getSecurePath();



            User::where('id', $student_id)->update([

                'name'=>$name,
                'middlename'=>$middlename,
                'lastname'=>$lastname,
                'national_id'=>$national_id,
                'gender'=>$gender,
                'profile_photo_path'=>$student_image,
            ]);


    }else{

        User::where('id',$student_id)->update([

            'name'=>$name,
            'middlename'=>$middlename,
            'lastname'=>$lastname,
            'national_id'=>$national_id,
            'gender'=>$gender,
            // 'profile_photo_path'=>"",

           ]);


    }




$students=DB::table('grades_students')
->join('grades','grades_students.grade_id','=','grades.id')
->join('users','grades_students.student_id','=','users.id')
->join('academic_sessions','grades_students.academic_session','=','academic_sessions.id')
->where('grades_students.grade_id', $class_id)
->where('grades_students.academic_session', $session_id)
->where('academic_sessions.id',$session_id )

->select('users.id as user_id','users.profile_photo_path','national_id', 'grades.grade_name','users.gender', 'users.cell_number','users.middlename', 'users.email', 'date_of_birth','users.name','users.lastname', 'users.salutation', 'academic_sessions.academic_session','grades.grade_name', 'users.id', 'academic_sessions.id as academic_session_id', 'grades.id as current_class', 'users.active')->orderBy('lastname')->orderBy('name')->get();


Fas::flash('message', "Updated");

return view('users.students.classteacher.view', compact('students', 'sessions', 'classes', 'session_id'));




//
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $table = (new UsersTable())->setup();

        return view('users.students.list.index', compact('table'));
    }

    // public function student_search ($search, Request $request){

    // return 'home';

    // }

    public function mysubjects (){

        //Verify if student
        if(Auth::user()->hasRole('student')){


            //Get student id
            //Get student class
            //get student subjects

        }


    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        //update the table to have the student status and sponsor id columns

        if (!Schema::hasColumn('grades_students', 'student_status'))   {
             Schema::table('grades_students', function (Blueprint $table) {
             $table->string('student_status')->nullable();
             $table->string('sponsor_id')->nullable();
           });
       }


        if(Auth::user()->hasRole('admin_teacher')){

        return view('users.students.index');

        }else{
            return view('errors.unauthorized');
        }
    }

    public function manage()
    {
        if(Auth::user()->hasRole('admin_teacher') OR Auth::user()->hasRole('bursar') ){

//For future multi-tenancy, scope class based on school type and school grades
        $class=Grade::all();
        $streams=Stream::all();
        $student_role=Role::where('name','student')->first();
        $inactive_students=User::where('role_id',$student_role->id)->where('active',0)->get();


        $active_students=User::where('role_id',$student_role->id)->where('active',1)->get();

        $session=AcademicSession::where('active', 1)->get();

        return view('users.students.manage', compact('class', 'session', 'streams', 'active_students','inactive_students'));
        }else{
            return view('errors.unauthorized');
        }
    }


    public function student_images_index(){


        $grades=Grade::all();

        return view('users.students.images.index', compact('grades'));

    }

    public function student_images_store(Request $request){



        $grade_id=$request->grade_id;

       // dd($request->all());

        $students = DB::table('users')
        ->join('grades_students', 'users.id', '=', 'grades_students.student_id')
        ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
        ->join('academic_sessions', 'academic_sessions.id', '=', 'grades_students.academic_session')
        ->where('grades.id',$grade_id)
        ->where('grades_students.active', 1)
        ->where('users.active', 1)
        ->select('users.*','grades.grade_name', 'academic_sessions.academic_session', 'grades.id as grade_id')
        ->get();


        return view('users.students.images.view', compact('students'));

       // dd($request->all());
    //     return response()->json([
    //         'students'=>$students,
    // ]);


    }

    public function student_stream(Request $request, $stream_id){

        //Security Protect this route.//

        $stream_data = DB::table('grades_students')
        ->join('users', 'users.id', '=', 'grades_students.student_id')
        ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
        ->where('grades.stream_id',$stream_id)
        ->where('grades_students.active', 1)
        ->where('users.active', 1)
        ->select('users.*','grades.grade_name', 'grades.id as grade_id')
        ->get();

        return response()->json($stream_data);


    }


    public function students_management(Request $request){
      //  dd($request->all());
        //Get students in the stream
        //--fullname, class, current-year, number of subjects

        $stream_id=$request->stream;

        $grades=Grade::all();
        $sessions=AcademicSession::all();
        $streams=Stream::all();


        // if($stream_id=="former_students"){

        // }else{

        //     $students = DB::table('grades_students')
        //     ->join('users', 'users.id', '=', 'grades_students.student_id')
        //     ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
        //     ->join('academic_sessions', 'academic_sessions.id', '=', 'grades_students.academic_session')
        //     ->where('grades.stream_id',$stream_id)
        //     ->where('grades_students.active', 1)
        //     ->where('users.active', 1)
        //     ->select('users.*','grades.grade_name', 'academic_sessions.academic_session')
        //     ->get();


        // }


        return view('users.students.view-students', compact('grades', 'sessions', 'streams'));





    }

    public function student_management_stream($stream_id){


        $session=AcademicSession::where('active', 1)->first();
        $session_id=$session->id;






        if($stream_id=="former_students"){

            $students = DB::table('grades_students')
            ->join('users', 'users.id', '=', 'grades_students.student_id')
            ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
            ->join('academic_sessions', 'academic_sessions.id', '=', 'grades_students.academic_session')
            ->where('grades.stream_id',$stream_id)
            ->where('grades_students.active', 0)
            ->where('users.active', 0)
            ->select('users.*','grades.grade_name', 'academic_sessions.academic_session')
            ->get();

        }else{

            $students= DB::table('grades_students')
        ->join('users', 'users.id', '=', 'grades_students.student_id')
        ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
        ->join('academic_sessions','academic_sessions.id','=','grades_students.academic_session')
        ->select('grades.grade_name as grade_name','grades.id as grade_id','users.id as id', 'name', 'lastname', 'middlename', 'gender', 'date_of_birth', 'academic_sessions.academic_session',  'profile_photo_path')
        ->where('grades.stream_id',$stream_id)
        ->where('grades_students.academic_session', $session_id)
        ->where('academic_sessions.id',$session_id )
        ->where('grades_students.active',1 )
        ->where('users.active',1 )
        ->orderBy('lastname')->orderBy('name')->get();
        }

        return response()->json([
                'students'=>$students,
        ]);


    }



    public function class_search(Request $request){


        //
        $grade_id=$request->grade_id;
        $session=AcademicSession::where('active', 1)->first();
        $session_id=$session->id;



        // $students = DB::table('users')
        // ->join('grades_students', 'users.id', '=', 'grades_students.student_id')
        // ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
        // ->join('academic_sessions', 'academic_sessions.id', '=', 'grades_students.academic_session')
        // ->where('grades.id',$grade_id)
        // ->where('grades_students.active', 1)
        // ->where('users.active', 1)
        // ->select('users.*','grades.grade_name', 'academic_sessions.academic_session', 'grades.id as grade_id')
        // ->get();


        $students= DB::table('grades_students')
        ->join('users', 'users.id', '=', 'grades_students.student_id')
        ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
        ->join('academic_sessions','academic_sessions.id','=','grades_students.academic_session')
        ->select('grades.grade_name as grade_name','grades.id as grade_id','users.id as id', 'name', 'lastname', 'middlename', 'gender', 'date_of_birth', 'academic_sessions.academic_session',  'profile_photo_path')
        ->where('grades_students.grade_id', $grade_id)
        ->where('grades_students.academic_session', $session_id)
        ->where('academic_sessions.id',$session_id )
        ->where('grades_students.active',1 )
        ->where('users.active',1 )
        ->orderBy('lastname')->orderBy('name')->get();



       // dd($request->all());
        return response()->json([
            'students'=>$students,
    ]);


    }

    public function student_search(Request $request){

        $grade_id=$request->grade_id;
        $session=AcademicSession::where('active', 1)->first();
        $session_id=$session->id;


        $query=$request->all('query');

        foreach($query as $q){

        }

        // $query="Temabutfo";




        // $student_role_id=Role::where('name', 'Student')->first();
        // $student_role=$student_role_id->id;

        // $platform = DB::table('idgbPlatforms')->where('name', 'LIKE',"%{$requestedplatform}%")->first();



            $students= DB::table('grades_students')
            ->join('users', 'users.id', '=', 'grades_students.student_id')
            ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
            ->join('academic_sessions','academic_sessions.id','=','grades_students.academic_session')
            ->select('grades.grade_name as grade_name','grades.id as grade_id','users.id as id', 'name', 'lastname', 'middlename', 'gender', 'date_of_birth', 'academic_sessions.academic_session',  'profile_photo_path')
            ->where('name', 'LIKE',"%{$q}%")
            ->orWhere('lastname', 'LIKE',"%{$q}%")
            ->where('grades_students.academic_session', $session_id)
            ->where('academic_sessions.id',$session_id )
            ->where('grades_students.active',1 )
            ->where('users.active',1 )
            ->orderBy('lastname')->orderBy('name')->get();

    // $students ="HipHipHooray";

        return response()->json([
            'students'=>$students,
    ]);



    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//         if(Auth::user()->hasRole('admin_teacher')){
//        $student=Role::where('name', 'student')->first();

//        $parent_role=Role::where('name', 'parent')->first();


//         $user = User::create([
//             'name'=>$request->first_name,
//             'middlename'=>$request->middle_name,
//             'lastname'=>$request->last_name,
//             'national_id'=>$request->national_id,
//             'date_of_birth'=>$request->date_of_birth,
//             'gender'=>$request->gender,
//             'cell_number'=>$request->cell_number,
//             'email'=>$request->email_address,
//             'password'=>Hash::make(Str::random(24)),
//             'status'=>1,
//             'role_id'=>$student->id,
//        ]);

//       $user->attachRole($student);


//        $student_id=$user->id;

//        //insert into class_student
//        $class_student=StudentClass::create([
//         'student_id'=>$student_id,
//         'grade_id'=>$request->grade,
//         'academic_session'=>$request->session,
//        ]);

//        //insert parent number
// //        $parent = User::create([
// //         'cell_number'=>$request->parent_cell,
// //         'email'=>$request->parent_email,
// //         'password'=>Hash::make(Str::random(24)),
// //         'status'=>1,
// //         'role_id'=>$parent_role->id,
// //    ]);
// //    $parent->attachRole($parent_role);
// //    $parent_id=$parent->id;

// //    $parent_student=ParentStudent::create([

// //     'parent_id'=>$parent_id,
// //     'student_id'=>$student_id,
// //    ]);
//    flash()->overlay('Success. You have added students', 'Add Students');

//    return Redirect::back();

//    }else{
//     return view('errors.unauthorized');
//    }

    }

    public function import(Request $request){

        $this->validate($request, [
            'import' => 'required|mimes:xls,xlsx,csv'
         ]);

$collection=Excel::import(new StudentsImport, $request->file('import'));
    //  $collection = (new StudentsImport)->toCollection($request->file('import'));

        flash()->overlay('Success. You have added students', 'Add Students');

      return redirect('/users/student');


    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->hasRole('teacher')){
        $result_user=DB::table('users')
            ->where('users.id', $id)
            ->select('users.gender', 'users.cell_number', 'users.email', 'date_of_birth','users.name','users.lastname','users.profile_photo_path', 'users.salutation', 'users.id')
            ->first();

            $result_class=DB::table('grades_students')
            ->join('grades','grades_students.grade_id','=','grades.id')
            ->where('grades_students.student_id', $id)
            ->select('grade_name')
            ->get();



            if($student_id=ParentStudent::where('student_id', $id)->exists()){
                $parent_id=$student_id->parent_id;
                $student_id=ParentStudent::where('student_id', $id)->first();
            $result_parent=DB::table('parents_students')
            ->join('users','parents_students.parent_id','=','users.id')
            ->where('parents_students.parent_id', $parent_id)
            ->get();
            }else{

            }



            return view('users.students.view', compact('result'));

      //  return view('users.students.manage', compact('student'));

    }else{
        return view('errors.unauthorized');
    }
}

public function profile($id){

    $isAdmin=Auth::user()->hasRole('admin_teacher');
    $isClassTeacher=Auth::user()->hasRole('class_teacher');
    $isParent=Auth::user()->hasRole('parent');

    if($isAdmin OR $isClassTeacher OR $isParent){

        $result_user=DB::table('users')
        ->where('users.id', $id)
        ->select('users.*')
        ->first();

        $result_class=DB::table('grades_students')
        ->join('grades','grades_students.grade_id','=','grades.id')
        ->join('academic_sessions','academic_sessions.id','=','grades_students.academic_session')
        ->where('grades_students.student_id', $id)
        ->orderBy('grades_students.id', 'DESC')
        ->first();


        if($parent_exists=ParentStudent::where('student_id', $id)->exists()){


            $student_id=ParentStudent::where('student_id', $id)->first();
            $parent_id=$student_id->parent_id;

        $result_parent=DB::table('parents_students')
        ->join('users','parents_students.parent_id','=','users.id')
        ->where('parents_students.parent_id', $parent_id)
        ->first();

      //  dd($result_parent);
        return view('users.students.profile', compact('result_user', 'result_class', 'result_parent'));
        }else{

            return view('users.students.profile', compact('result_user', 'result_class'));
        }


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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $isAdmin=Auth::user()->hasRole('admin_teacher');
    $isClassTeacher=Auth::user()->hasRole('class_teacher');

    if($isAdmin OR $isClassTeacher){


        //Check Email
        //Check Cell

    //     $this->validate($request, [
    //    'email' => 'unique:users|email',
    // //'cell_number' => 'unique:users|cell_number',
    // ]);


    // dd($request->cell_number);
    $id = $request->id;
    // $exists=User::where('cell_number', $request->cell_number)->orWhere('email', $request->email)->exists();
    // if($exists){


    //     $user_data = User::find($id);
	// 	$user_data->name = $request->first_name;
    //     $user_data->middlename = $request->middle_name;
	// 	$user_data->lastname = $request->last_name;
    //     $user_data->national_id = $request->national_id;
    //     $user_data->date_of_birth = $request->date_of_birth;
    //     $user_data->gender = $request->gender;

	// 	$user_data->save();

    //     flash()->overlay('Could not update some information as it already exists in the database. Either email or cell number', 'Update Information');

    //     return Redirect::back();

    // }else{



		$user_data = User::find($id);
		$user_data->name = $request->first_name;
        $user_data->middlename = $request->middle_name;
		$user_data->lastname = $request->last_name;
        $user_data->national_id = $request->national_id;
        $user_data->date_of_birth = $request->date_of_birth;
        $user_data->gender = $request->gender;
        $user_data->cell_number = $request->cell_number;
        $user_data->email = $request->email;
		$user_data->save();

        flash()->overlay('Success. You have updated student information', 'Update Data');




        $parent_exists=ParentStudent::where('student_id', $id)->exists();

        if($parent_exists){
            $parent_data_db=DB::table('parents_students')
            ->join('users','parents_students.parent_id','=','users.id')
            ->where('parents_students.student_id', $id)
            ->select('users.id')
            ->first();

            $parent_id=$parent_data_db->id;
            $parent_data = User::find($parent_id);
            $parent_data->name = $request->parent_name;
            $parent_data->middlename = $request->parent_middlename;
            $parent_data->lastname = $request->parent_surname;
            $parent_data->cell_number = $request->parent_cell;
            $parent_data->salutation = $request->parent_salutation;
            $parent_data->email = $request->parent_email;
            $parent_data->save();
        }else{

        //Check number and email
        $number_exists=User::where('cell_number', $request->parent_cell)->exists();

        $email_exists=User::where('email', $request->parent_email)->exists();
        $parent_role=Role::where('name', 'parent')->first();



        if(($request->parent_cell==$request->cell_number)){

        flash()->overlay('Error. Parent Number is similar to student number', 'Parent Detail');
		return Redirect::back();

        }

        if($number_exists ){

            $parent=User::where('cell_number', $request->parent_cell)->first();
          //if has role of student stop update


            $parent_id=$parent->id;
            //If both email and number exists
            //Add student to parent_students

                  //insert parent number


   $parent_student=ParentStudent::create([

    'parent_id'=>$parent_id,
    'student_id'=>$request->id,
   ]);


return Redirect::back();

        }else if(!$number_exists AND !$email_exists){
                         //insert parent number
       $parent = User::create([
        'cell_number'=>$request->parent_cell,
        'email'=>$request->parent_email,
        'password'=>Hash::make(Str::random(24)),
        'status'=>1,
        'role_id'=>$parent_role->id,
        'user_code'=>Str::random(16),
   ]);
   $parent->attachRole($parent_role);
   $parent_id=$parent->id;
 //  dd($number_exists);
   $parent_student=ParentStudent::create([

    'parent_id'=>$parent_id,
    'student_id'=>$request->id,
   ]);

    //send email to parent
   //send sms to parent


        }

        }

        flash()->overlay('Success. You have updated student information', 'Add Parent');
		return Redirect::back();
    }else{
        return view('errors.unauthorized');
    }
}


public function parent_update(Request $request){

    $isAdmin=Auth::user()->hasRole('admin_teacher');
    $isClassTeacher=Auth::user()->hasRole('class_teacher');

    if($isAdmin OR $isClassTeacher){

        $id = $request->id;

		$user_data = User::find($id);
		$user_data->name = $request->first_name;
        $user_data->middlename = $request->middle_name;
		$user_data->lastname = $request->last_name;
        $user_data->national_id = $request->national_id;
        $user_data->date_of_birth = $request->date_of_birth;
        $user_data->gender = $request->gender;


		$user_data->save();


        $parent_exists=ParentStudent::where('student_id', $id)->exists();

        if(!$parent_exists){
            $parent_data_db=DB::table('parents_students')
            ->join('users','parents_students.parent_id','=','users.id')
            ->where('parents_students.student_id', $id)
            ->select('users.id')
            ->first();
            $parent_id=$parent_data_db->id;
            $parent_data = User::find($parent_id);
            $parent_data->name = $request->parent_name;
            $parent_data->middlename = $request->parent_middlename;
            $parent_data->lastname = $request->parent_surname;
            $parent_data->cell_number = $request->parent_cell;
            $parent_data->salutation = $request->parent_salutation;
            $parent_data->save();
        }

        flash()->overlay('Success. You have updated student information', 'Update Student');
		return Redirect::back();
    }else{
        return view('errors.unauthorized');
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //First delete assessement_reports
        // delete student loads

        //delete marks
        //delete grades_students

        //then delete users


        $assessement_report=AssessementProgressReport::where('student_id', $id);
        $term_averages=TermAverage::where('student_id', $id);
        $student_subject_average=StudentSubjectAverage::where('student_id', $id);
        $student_load=StudentLoad::where('student_id', $id);
        $mark=Mark::where('student_id', $id);
        $grade=StudentClass::where('student_id', $id);
      //  $parent=ParentStudent::where('student_id', $id);



      if($assessement_report->exists()){
        $assessement_report->delete();
    }

    if($term_averages->exists()){
        $term_averages->delete();
    }
    if($student_subject_average->exists()){
        $student_subject_average->delete();
    }

        if($student_load->exists()){
            $student_load->delete();
        }

        if($mark->exists()){
            $mark->delete();
        }



        if($grade->exists()){
            $grade->delete();
        }

        $delete=User::find($id)->delete();
        flash()->overlay('<i class="fas fa-check-circle "></i>'.' Success.You have deleted student', 'Delete Student');




      return redirect('users/student/manage');

    }


    public function student_removal(){
        //Archive Students

        $classes=Grade::all();
        $sessions=AcademicSession::where('active', 1)->get();

        return view('users.students.removal-management.index', compact('classes', 'sessions'));

    }


    public function student_issues_classteacher(){
        //Archive Students


        if (!Schema::hasColumn('grades_students', 'student_status'))   {
            Schema::table('grades_students', function (Blueprint $table) {
            $table->string('student_status')->nullable();
            $table->string('sponsor_id')->nullable();
          });
      }


        $classes=DB::table('grades_teachers')
        ->join('academic_sessions','academic_sessions.id','=','grades_teachers.academic_session')
        ->join('grades','grades.id','=','grades_teachers.grade_id')
        ->where('academic_sessions.active', 1)
        ->where('grades_teachers.teacher_id', Auth::user()->id)
        ->select('grades.id as id', 'grades.grade_name')->get();

        $sessions=AcademicSession::where('active', 1)->get();

        return view('users.students.removal-management.index_class_teacher', compact('classes', 'sessions'));

    }

    public function removal_loadstudents(Request $request){
        // dd($request->all());

        $classes=Grade::all();
        $sessions=AcademicSession::where('active', 1)->get();
        $class_id=$request->grade_id;
        $session_id=$request->academic_session;



        $students=DB::table('grades_students')
        ->join('grades','grades_students.grade_id','=','grades.id')
        ->join('users','grades_students.student_id','=','users.id')
        ->join('academic_sessions','grades_students.academic_session','=','academic_sessions.id')
        ->where('grades_students.grade_id', $class_id)
        ->where('grades_students.academic_session', $session_id)
        ->where('academic_sessions.id',$session_id )

        ->select('grades_students.student_status','users.id as user_id', 'grades.grade_name','users.gender', 'users.cell_number','users.middlename', 'users.email', 'date_of_birth','users.name','users.lastname','users.profile_photo_path', 'users.salutation', 'academic_sessions.academic_session','grades.grade_name', 'users.id', 'academic_sessions.id as academic_session_id', 'grades.id as current_class', 'users.active')->orderBy('lastname')->orderBy('name')->get();

        return view('users.students.removal-management.view', compact('students', 'sessions', 'classes', 'session_id'));


        // $data= DB::table('grades_students')
        // ->join('users', 'users.id', '=', 'grades_students.student_id')
        // ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
        // ->join('academic_sessions','academic_sessions.id','=','grades_students.academic_session')
        // ->select('grades.grade_name as grade_name','grades.id as grade_id','users.id as id', 'name', 'lastname', 'middlename', 'gender', 'date_of_birth',   'profile_photo_path')
        // ->where('grades_students.grade_id', $grade_id)
        // ->where('grades_students.academic_session', $session_id)
        // ->where('academic_sessions.id',$session_id )
        // ->where('grades_students.active',1 )
        // ->where('users.active',1 )
        // ->orderBy('lastname')->orderBy('name')->get();


    }



    public function classteacher_student_view(Request $request){
    //    dd($request->all());


            //Step 1- Validate Request
            $validation=$request->validate([
                'action'=>'required',
            ]);




        $class_id=$request->grade_id;
        $session_id=$request->academic_session;
        $action=$request->action;


        if($action=="register"){



            $classes=DB::table('grades_teachers')
            ->join('academic_sessions','academic_sessions.id','=','grades_teachers.academic_session')
            ->join('grades','grades.id','=','grades_teachers.grade_id')
            ->where('academic_sessions.active', 1)
            ->where('grades_teachers.teacher_id', Auth::user()->id)
            ->select('grades.id as id', 'grades.grade_name')->get();

            $session=AcademicSession::all()->sortBy('academic_session');
            $sponsors=Partner::where('partner_type', 1)->get();

            return view('users.students.registration-pathways.bulk', compact('classes', 'session', 'sponsors'));


        }else{

            $classes=Grade::all();
            $sessions=AcademicSession::where('active', 1)->get();

            $students=DB::table('grades_students')
        ->join('grades','grades_students.grade_id','=','grades.id')
        ->join('users','grades_students.student_id','=','users.id')
        ->join('academic_sessions','grades_students.academic_session','=','academic_sessions.id')
        ->where('grades_students.grade_id', $class_id)
        ->where('grades_students.academic_session', $session_id)
        ->where('academic_sessions.id',$session_id )

        ->select('users.id as user_id','users.profile_photo_path','national_id', 'grades.grade_name','users.gender', 'users.cell_number','users.middlename', 'users.email', 'date_of_birth','users.name','users.lastname', 'users.salutation', 'academic_sessions.academic_session','grades.grade_name', 'users.id', 'academic_sessions.id as academic_session_id', 'grades.id as current_class','grades_students.student_status','grades_students.sponsor_id', 'users.active')->orderBy('lastname')->orderBy('name')->get();

      //  dd($students);


      $sponsors=Partner::where('partner_type', 1)->get();


        return view('users.students.classteacher.view', compact('students', 'sessions', 'classes', 'session_id', 'sponsors'));

        }





    }


    public function removal(Request $request){

        // dd($request->all());
        $student_list=$request->students;
        $session_=AcademicSession::where('active', 1)->first();
        $session=$session_->id;
        $current_class=$request->current_class;

        if (!Schema::hasTable('cbe_marks')) {
            Schema::create('cbe_marks', function($table){

                   $table->id();
                   $table->unsignedBigInteger('teacher_id');
                   $table->unsignedBigInteger('student_id');
                   $table->unsignedBigInteger('teaching_load_id');
                   $table->unsignedBigInteger('strand_id');
                   $table->unsignedBigInteger('term_id');

                   $table->string('grade')->nullable();
                   $table->integer('active')->default('1');

                   $table->timestamps();
           });
       }


       if ($request->btn=="merge") {



       $student_data=[];
       for ($i = 0; $i <count($student_list); $i++) {


        $student_data[]=DB::table('grades_students')
        ->join('grades','grades_students.grade_id','=','grades.id')
        ->join('users','grades_students.student_id','=','users.id')
        ->join('academic_sessions','grades_students.academic_session','=','academic_sessions.id')
        ->where('grades_students.grade_id', $current_class)
        ->where('grades_students.academic_session', $session)
        ->where('academic_sessions.id',$session )
        ->where('users.id',$student_list[$i])
     ->select('users.id as student_id', 'users.name', 'users.middlename','users.lastname','grades.grade_name', 'academic_sessions.id as session_id', 'grades.id as grade_id')

        ->first();
        // $student_data[]=User::where('id', $student_list[$i])->first();


    //    dd($student_data);


//         $sub = StudentLoad::select('id')

//     ->where('student_id',$student_list)
//     ->where('academic_session',$session )
//     ->groupBy('subjects.id');

// $kj=DB::table(DB::raw("($sub->toSq()) as loads"))
//     ->mergeBindings($sub)

//     ->get();

//     dd($kj);

//       $student_data[]=  DB::select(DB::raw("SELECT users.name, users.middlename, users.lastname, grades.grade_name,
// GROUP_CONCAT(subjects.subject_name) AS subject_name,
// subjects.id as subject_id

// FROM
// grades_students
// INNER JOIN student_loads ON student_loads.student_id = grades_students.student_id
// INNER JOIN teaching_loads ON teaching_loads.id = student_loads.teaching_load_id
// INNER JOIN subjects ON subjects.id = teaching_loads.subject_id
// INNER JOIN grades ON grades.id = teaching_loads.class_id
// INNER JOIN users ON users.id=grades_students.student_id
// WHERE grades_students.student_id = ".$student_list[$i]." AND `grades_students`.`academic_session` =".$session." AND  users.active=1 AND teaching_loads.active=1
// GROUP BY
// users.id,
// subjects.id"));



       }

   //    dd($student_data);

     return view('users.students.merge-management.index', compact('student_data', 'session'));


       }


        if ($request->btn=="delete") {
            for ($i = 0; $i <count($student_list); $i++) {
                $assessement_report=AssessementProgressReport::where('student_id', $student_list[$i]);
                $student_average=StudentSubjectAverage::where('student_id', $student_list[$i]);
                $term_averages=TermAverage::where('student_id', $student_list[$i]);
                $student_load=StudentLoad::where('student_id', $student_list[$i]);
                $mark=Mark::where('student_id', $student_list[$i]);
                $grade=StudentClass::where('student_id', $student_list[$i]);
                $parent=ParentStudent::where('student_id', $student_list[$i]);
                $cbe_mark=CBEMark::where('student_id', $student_list[$i]);

                if ($assessement_report->exists()) {
                    $assessement_report->delete();
                }

                if ($student_average->exists()) {
                    $student_average->delete();
                }

                if ($term_averages->exists()) {
                    $term_averages->delete();
                }

                if ($student_load->exists()) {
                    $student_load->delete();
                }

                if ($mark->exists()) {
                    $mark->delete();
                }

                if ($cbe_mark->exists()) {
                    $cbe_mark->delete();
                }


                if ($grade->exists()) {
                    $grade->delete();
                }

                $delete=User::find($student_list[$i])->delete();

                //student detach
            }
        }



        if ($request->btn=="partial_delete") {
            for ($i = 0; $i <count($student_list); $i++) {

                $grade=StudentClass::where('student_id', $student_list[$i])->where('grade_id',$current_class )->first();



                if ($grade->exists()) {
                   $grade=StudentClass::where('id',$grade->id)->delete();
                }


                //student detach
            }
        }

        if($request->btn=="archive") {
            for ($i = 0; $i <count($student_list); $i++) {


                // $assessement_report=AssessementProgressReport::where('student_id', $student_list[$i]);
            $student_average=StudentSubjectAverage::where('student_id', $student_list[$i]);
            $term_averages=TermAverage::where('student_id', $student_list[$i]);
            $student_load=StudentLoad::where('student_id', $student_list[$i]);
            $mark=Mark::where('student_id', $student_list[$i]);
            $grade=StudentClass::where('student_id', $student_list[$i])->where('academic_session',$session);
            $user=User::where('id', $student_list[$i]);
                // $parent=ParentStudent::where('student_id', $student_list[$i]);
            $user=User::where('id', $student_list[$i]);
            $cbe_mark=CBEMark::where('student_id', $student_list[$i]);






                //archive workflow
                //1. users.active=0
                if ($user->exists()) {
                    $user->update(['active'=>'0']);
                }

                //2. student_loads.active=0
                if ($student_load->exists()) {
                    $student_load->update(['active'=>'0']);
                  //  $student_load->delete();
                }

                //3. grade_students.active=0
                if ($grade->exists()) {
                    $grade->update(['active'=>'0']);
                //    $grade->delete();


                }


                //3. Marks
                if ($mark->exists()) {
                    $mark->update(['active'=>'0']);
                }

                if ($cbe_mark->exists()) {
                    $cbe_mark->update(['active'=>'0']);
                }

                if ($term_averages->exists()) {
                    $term_averages->delete();
                }

                if ($student_average->exists()) {
                    $student_average->delete();
                }

            }
        }




        if($request->btn=="unarchive") {
            for ($i = 0; $i <count($student_list); $i++) {


                // $assessement_report=AssessementProgressReport::where('student_id', $student_list[$i]);
                // $student_average=StudentSubjectAverage::where('student_id', $student_list[$i]);
                // $term_averages=TermAverage::where('student_id', $student_list[$i]);
            $student_load=StudentLoad::where('student_id', $student_list[$i]);
            $mark=Mark::where('student_id', $student_list[$i]);
            $grade=StudentClass::where('student_id', $student_list[$i])->where('academic_session',$session);
            $user=User::where('id', $student_list[$i]);
                // $parent=ParentStudent::where('student_id', $student_list[$i]);
            $user=User::where('id', $student_list[$i]);
            $cbe_mark=CBEMark::where('student_id', $student_list[$i]);






                //archive workflow
                //1. users.active=0
                if ($user->exists()) {
                    $user->update(['active'=>'1']);
                }

                //2. student_loads.active=0
                if ($student_load->exists()) {
                    $student_load->update(['active'=>'1']);
                  //  $student_load->delete();
                }

                //3. grade_students.active=0
                if ($grade->exists()) {
                    $grade->update(['active'=>'1']);



                }


                //3. Marks
                if ($mark->exists()) {
                    $mark->update(['active'=>'1']);
                }

                if ($cbe_mark->exists()) {
                    $cbe_mark->update(['active'=>'1']);
                }

            }
        }


        if ($request->btn=="transfer") {


            for ($i = 0; $i <count($student_list); $i++) {

            // dd($student_list);
                $assessement_report=AssessementProgressReport::where('student_id', $student_list[$i])->where('student_class', $current_class);



                // $student_average=StudentSubjectAverage::where('student_id', $student_list[$i]);

                // $term_averages=TermAverage::where('student_id', $student_list[$i]);


                //delete student loads
                $student_load=StudentLoad::where('student_id', $student_list[$i])->where('active', 1);

                //delete marks
                $mark=Mark::where('student_id', $student_list[$i])->where('session_id', $session);

                //update student class
                $grade=StudentClass::where('student_id', $student_list[$i])->where('academic_session', $session);

                // dd($session);

                $cbe_mark=CBEMark::where('student_id', $student_list[$i]);


                if ($assessement_report->exists()) {
                    $assessement_report->delete();
                }

                // if ($student_average->exists()) {
                //     $student_average->delete();
                // }

                // if ($term_averages->exists()) {
                //     $term_averages->delete();
                // }

                //delete loads
                if ($student_load->exists()) {
                    $student_load->delete();
                }

                if ($mark->exists()) {
                    $mark->delete();
                }

                if ($cbe_mark->exists()) {
                    $cbe_mark->delete();
                }



                if ($grade->exists()) {
                  //  dd($grade);
                    $grade->update(['grade_id'=>$request->transfer_to]);
                }
            }
        }

        flash()->overlay('<i class="fas fa-check-circle "></i>'.' Success.Issue has been sorted', 'Sort Student Issues');
        return redirect('/users/student/manage/removal/');

    }

    public function load(Request $request){
        //Access Controll

    //Scope  the Session
     $class_id=$request->grade_id;
     $class=Grade::where('id', $class_id)->first();
     $class=Grade::all();
     $session=AcademicSession::where('active', 1)->get();//Remember to scope session
     $student_class=Grade::where('id', $class_id)->first();

        $result=DB::table('grades_students')
            ->join('grades','grades_students.grade_id','=','grades.id')
            ->join('users','grades_students.student_id','=','users.id')
            ->join('academic_sessions','grades_students.academic_session','=','academic_sessions.id')
            ->where('grade_id', $class_id)
            ->where('academic_sessions.active', 1)
            ->select('users.id as user_id', 'grades.grade_name','users.gender', 'users.cell_number','users.middlename', 'users.email', 'date_of_birth','users.name','users.lastname','users.profile_photo_path', 'users.salutation', 'academic_sessions.academic_session', 'users.id')
            ->orderByRaw("lastname ASC, name ASC")
            ->get();//remember to scope session

            return view('users.students.view', compact('result', 'class', 'session','student_class'));
    }


    public function list(Request $request){
        //Access Controll
     $class_id=$request->grade_id;
     $class=Grade::where('id', $class_id)->get();
     $class=Grade::all();
     $session=AcademicSession::where('active', 1)->get();

        $result=DB::table('grades_students')
            ->join('grades','grades_students.grade_id','=','grades.id')
            ->join('users','grades_students.student_id','=','users.id')
            ->join('academic_sessions','grades_students.academic_session','=','academic_sessions.id')
            ->where('grade_id', $class_id)
            ->select('users.id as user_id', 'grades.grade_name','users.gender', 'users.cell_number','users.middlename', 'users.email', 'date_of_birth','users.name','users.lastname','users.profile_photo_path', 'users.salutation', 'academic_sessions.academic_session', 'users.id')


            ->get();

            return view('users.students.view', compact('result', 'class', 'session'));
    }


    public function  password_reset($id){

        $user_data = User::find($id);
        $uniqid = Str::random(8);
        $password=$user_data->password = Hash::make($uniqid);
        $user_data->save();

        //Send OTP via SMS/Email/Push Notification
        dd($uniqid);



    }


    public function student_merge(Request $request){

      // dd($request->all());
        $students=$request->students;
        $chosen=$request->chosen;

       $rejected=array_diff($students, array($chosen));





//       dd($rejected);


$chosen_student=DB::table('student_loads')
->join('teaching_loads','teaching_loads.id','=','student_loads.teaching_load_id')
->join('subjects','subjects.id','=','teaching_loads.subject_id')
->where('teaching_loads.active', 1)
->where('student_loads.student_id',$chosen)
->select('student_loads.student_id as student_id', 'subjects.id as subject_id', 'teaching_loads.class_id', 'student_loads.id as student_load_id')
->get();

        foreach ($rejected as $key => $student) {


            //1. Get subjects leaners are doing





         //   dd($chosen);

            $rejected_students_subjects=DB::table('student_loads')
            ->join('teaching_loads','teaching_loads.id','=','student_loads.teaching_load_id')
            ->join('subjects','subjects.id','=','teaching_loads.subject_id')
            ->where('teaching_loads.active', 1)
            ->whereIn('student_loads.student_id',(array($student)) )
            ->select('student_loads.student_id as student_id', 'subjects.id as subject_id', 'teaching_loads.class_id', 'student_loads.id as student_load_id')
            ->get()->pluck('subject_id')->toArray();


            $chosen_student_subjects=DB::table('student_loads')
            ->join('teaching_loads','teaching_loads.id','=','student_loads.teaching_load_id')
            ->join('subjects','subjects.id','=','teaching_loads.subject_id')
            ->where('teaching_loads.active', 1)
            ->where('student_loads.student_id',$chosen)
            ->select('student_loads.student_id as student_id', 'subjects.id as subject_id', 'teaching_loads.class_id', 'student_loads.id as student_load_id')
            ->get()->pluck('subject_id')->toArray();


          //  dd($rejected_students_loads);


            //2. Transfer subjects to chosen
                 //compare the subject list of chosen with rejected

                 $chosen_subjectlist=implode(",",$chosen_student_subjects);
                 $rejected_subjectlist=implode(",",$rejected_students_subjects);


                 $comparison=array_diff(($rejected_students_subjects), ($chosen_student_subjects));



                 foreach ($comparison as $key => $value) {

                    //transfer student


                 }







        }

    }

public function  parent_link(Request $request){
$streams=Grade::all();
return view('users.students.parent-link.index',compact('streams'));
}


public function  parent_link_class_teacher(Request $request){
    $session=AcademicSession::where('active',1)->first();
    $class=DB::table('grades_teachers')
    ->join('academic_sessions','grades_teachers.academic_session','=','academic_sessions.id')
    ->join('grades','grades_teachers.grade_id','=','grades.id')
    ->where('grades_teachers.teacher_id', Auth::user()->id)
    ->where('grades_teachers.academic_session', $session->id)
    ->select('grades.id as grade_id', 'grades.grade_name')->get();
    return view('users.students.parent-link.classteacher.index_classteacher',compact('class'));
    }

public function  parent_link_admin(Request $request){

    $session=AcademicSession::where('active',1)->first();
    // $streams=DB::table('grades_teachers')
    // ->join('academic_sessions','grades_teachers.academic_session','=','academic_sessions.id')
    // ->join('grades','grades_teachers.grade_id','=','grades.id')
    // // ->where('grades_teachers.teacher_id', Auth::user()->id)
    // // ->where('grades_teachers.academic_session', $session->id)
    // ->select('grades.id as grade_id', 'grades.grade_name')->get();


       $streams=DB::table('grades')

    // ->join('grades','grades_teachers.grade_id','=','grades.id')
    // ->where('grades_teachers.teacher_id', Auth::user()->id)
    // ->where('grades_teachers.academic_session', $session->id)
    ->select('grades.id as grade_id', 'grades.grade_name')->get();

    return view('users.students.parent-link.index_classteacher',compact('streams'));
    }


public function parent_link_show(Request $request){

$students=DB::select(DB::raw("SELECT
users.id as student_id,
users.name,
users.middlename,
users.lastname,
p.cell_number as cell_number,
grades.grade_name,
(SELECT parents_students.parent_id as parent_id from parents_students WHERE parents_students.student_id=users.id ) as parent_id
 from grades_students
 INNER JOIN users ON grades_students.student_id=users.id
LEFT JOIN parents_students on parents_students.student_id=users.id
LEFT JOIN users p ON p.id=parents_students.parent_id
INNER JOIN grades on grades.id=grades_students.grade_id
WHERE grades.id=$request->stream_id
ORDER BY `grades`.`grade_name`,`users`.`lastname`  ASC"));
return view('users.students.parent-link.list',compact('students'));

}

public function classteacher_parent_link_show(Request $request){

    $students=DB::select(DB::raw("SELECT
    users.id as student_id,
    users.name,
    users.middlename,
    users.lastname,
    p.cell_number as cell_number,
    grades.grade_name,
    (SELECT parents_students.parent_id as parent_id from parents_students WHERE parents_students.student_id=users.id ) as parent_id
     from grades_students
     INNER JOIN users ON grades_students.student_id=users.id
    LEFT JOIN parents_students on parents_students.student_id=users.id
    LEFT JOIN users p ON p.id=parents_students.parent_id
    INNER JOIN grades on grades.id=grades_students.grade_id
    WHERE grades.id=$request->class_id
    ORDER BY `grades`.`grade_name`,`users`.`lastname`  ASC"));
    return view('users.students.parent-link.classteacher.list',compact('students'));

    }

// public function increase_time_limit(int $seconds): bool
// {
//     return set_time_limit(max(
//         ini_get('max_execution_time'), $seconds
//     ));
// }

// somewhere else in your code


public function parent_link_store(Request $request){

    $parent_role=Role::where('name', 'parent')->first();
    $parent_role_id=$parent_role->id;
    $parent_role_name=$parent_role->name;


    for($i = 0; $i < count($request->parent_cell); $i++) {
        $students=$request->student_id[$i];
        $parents=($request->parent_id[$i]);
        $parent_cell=$request->parent_cell[$i];


        $CellExists=User::where('cell_number',$parent_cell);

        if($CellExists->exists()=="true"){

      // User::where('cell_number',$parent_cell)->update(['cell_number'=>$request->parent_cell[$i]]);

        $parentID=User::where('cell_number',$parent_cell)->first();
        $parent_id_is=$parentID->id;

        //check if there is a combination of both parent_students
        //if there is a match then do not add

    $parent_exists_in_parents_table=ParentStudent::where('student_id', $students)->exists();
      // dd($parent_exists_in_parents_table);

      if($parent_exists_in_parents_table){


        //update


      }else{
          if(is_null($parent_cell)){

            //update parent cell


          }else{
            $student_db=DB::table('parents_students')->upsert([
                [
                    'student_id' => $students,
                    'parent_id' => $parentID->id,
                ]
            ], ['student_id', 'id'], ['parent_id']);

          }

      }

        }else{

        $ifCellExists=User::where('cell_number',$request->parent_cell[$i])->whereNull('cell_number')->exists();

        if($ifCellExists){

     User::where('cell_number',$request->parent_cell[$i])->update(['cell'=>$request->parent_cell[$i]]);
        }else{
        $newParent= User::create([
            'cell_number' =>$request->parent_cell[$i],
           'password' => Hash::make(Str::random(5)),
           'status' => 0,
           'role_id'=>$parent_role_id,
           'user_code'=>Str::random(5),
     ]);

     $newParent_id=$newParent->id;

     $newParent->attachRole($parent_role_id);


     $studentParentExists=ParentStudent::where('student_id',$students)->exists();
     if($studentParentExists){

        //Student exists
        //1 Do nothing

     }else{
        $parent_student=ParentStudent::create([
            'parent_id'=>$newParent_id,
            'student_id'=>$students,
           ]);

     }

     }
     }
    }

  flash()->overlay('<i class="fas fa-check-circle text-success"></i>'.' Congratulations. You have successfully added Parents Data.', 'Add Parents Cell Numbers');

  return redirect('/link/students-parents/');

}



public function store_parent_cell(Request $request){

    $parent_role=Role::where('name', 'parent')->first();
    $parent_role_id=$parent_role->id;
    $parent_role_name=$parent_role->name;


    for($i = 0; $i < count($request->parent_cell); $i++) {
        $students=$request->student_id[$i];
        $parents=($request->parent_id[$i]);
        $parent_cell=$request->parent_cell[$i];

        $CellExists=User::where('cell_number',$parent_cell);

        if($CellExists->exists()=="true"){

      // User::where('cell_number',$parent_cell)->update(['cell_number'=>$request->parent_cell[$i]]);

        $parentID=User::where('cell_number',$parent_cell)->first();

        //check if there is a combination of both parent_students
        //if there is a match then do not add

    $parent_exists_in_parents_table=ParentStudent::where('student_id', $students)->exists();
      // dd($parent_exists_in_parents_table);

      if($parent_exists_in_parents_table){
      }else{
          if(is_null($parent_cell)){

          }else{
            $student_db=DB::table('parents_students')->upsert([
                [
                    'student_id' => $students,
                    'parent_id' => $parentID->id,
                ]
            ], ['student_id', 'id'], ['parent_id']);

          }

      }

        }else{

        $ifCellExists=User::where('cell_number',$request->parent_cell[$i])->whereNull('cell_number')->exists();

        if($ifCellExists){

     User::where('cell_number',$request->parent_cell[$i])->update(['cell'=>$request->parent_cell[$i]]);
        }else{
        $newParent= User::create([
            'cell_number' =>$request->parent_cell[$i],
           'password' => Hash::make(Str::random(5)),
           'status' => 0,
           'role_id'=>$parent_role_id,
           'user_code'=>Str::random(5),
     ]);

     $newParent_id=$newParent->id;

     $newParent->attachRole($parent_role_id);


     $studentParentExists=ParentStudent::where('student_id',$students)->exists();
     if($studentParentExists){

        //Student exists
        //1 Do nothing

     }else{
        $parent_student=ParentStudent::create([
            'parent_id'=>$newParent_id,
            'student_id'=>$students,
           ]);

     }

     }
     }
    }

  flash()->overlay('<i class="fas fa-check-circle text-success"></i>'.' Congratulations. You have successfully added Parents Data.', 'Add Parents Cell Numbers');

  return redirect('/class/student-management/link-parents');

}







public function parent_cell_show($id, $student_id){
 //

        // 1. check if number exists
    $parent_cell_exists=User::where('cell_number', $id)->exists();



    if($parent_cell_exists){
        // 2. if exists

    $parent_cell=User::where('cell_number', $id)->first();
    $parent_id=$parent_cell->id;

  //     1. Change the parent_id in parent_students and put in the parent id of new parent (owner of new number)


    $updateParent=ParentStudent::where('student_id', $student_id)->where('parent_id', $parent_id)->update([
        "parent_id"=>$parent_id,
    ]);



    }else{
          //     if it does not exist
    //      1. Add new number as user

    // $new_parent=User::create([
    //     'cell_number'=>$id
    // ])
    //      2. Assign new user to student in parent_students

    }





    $parent_cell=User::where('cell_number', $id)->first();
    $parent_id=$parent_cell->id;

    return response()->json($mark[0]);


}







public function transfer(){
    $grades=Grade::all();
    $streams=Stream::all();

    return view('users.students.transfer-management.index', compact('grades','streams'));
}


public function get_students(Request $request){
    $grade=$request->grade;
    $grade_id=Grade::where('id',$grade)->first();
    $class_id=$grade_id->id;
    $class_name=$grade_id->grade_name;
    $stream_id=$grade_id->stream_id;

    $grades_list=Grade::where('stream_id',$stream_id)->get();

    $result=DB::table('grades_students')
           ->join('grades','grades_students.grade_id','=','grades.id')
           ->join('users','grades_students.student_id','=','users.id')
           ->join('academic_sessions','grades_students.academic_session','=','academic_sessions.id')
           ->where('stream_id', $class_id)
           ->select('users.id as user_id', 'grades.grade_name','users.gender', 'users.cell_number','users.middlename', 'users.email', 'date_of_birth','users.name','users.lastname','users.profile_photo_path', 'users.salutation', 'academic_sessions.academic_session', 'users.id','grades_students.grade_id')

           ->get();

     return view('users.students.transfer-management.student-list', compact('result','grades_list', 'class_name'));

     //scope

}

public function transfer_students(Request $request){

    //Check existing
    //check out the academic year as well
    //dd('sdf');

    dd($request->all());

    for($i = 0; $i < count($request->student_id); $i++) {
    $students=$request->student_id[$i];
    $transfer_to=$request->transfer_to[$i];

     //Delete from student loads
    //Delete from grades students
    //Delete from marks

$update_students=StudentClass::where('student_id', $students)->where('active', 1)->update(['grade_id' =>$transfer_to]);

    }
    //Delete from student loads
    //Delete from grades students
    //Delete from marks
}
public function process_transfer($student_id,$transfer_to){
    // return response()->json($mark[0]);
     dd($student_id);

 }



 public function single_pathway_index(){
    $class=Grade::all();
    $session=AcademicSession::all()->sortByDesc('academic_session');
    return view('users.students.registration-pathways.single', compact('class', 'session'));


 }

 public function single_pathway_store(Request $request){

 //   dd($request->all());

    //1. Add to users table
    //2. Add to grade students
    //3. Add to role_Students

    //if parent exists add to the parents students table


    if(Auth::user()->hasRole('admin_teacher')){
        $student=Role::where('name', 'student')->first();

          //Step 1- Validate Request
          $validation=$request->validate([
            'first_name'=>'required|alpha',
            'middle_name'=>'nullable|alpha',
            'last_name'=>'required|alpha',
            'national_id'=>'digits:13',
            'date_of_birth'=>'date',
            'gender'=>'required',
            'session'=>'required',
            'grade'=>'required',
            'cell_number'=>'unique:users,cell_number|nullable|digits:8|starts_with:76,78,79',
            'email_address'=>'unique:users,email|nullable|email:rfc,dns',
            'parent_cell'=>'unique:users,cell_number|nullable|digits:8|starts_with:76,78,79',
            'parent_email'=>'unique:users,email|nullable|email:rfc,dns',
            'student_status'=>'required',
        ]);


        try {


         $user = User::create([
            'name'=>$request->first_name,
            'middlename'=>$request->middle_name,
            'lastname'=>$request->last_name,
            'national_id'=>$request->national_id,
            'date_of_birth'=>$request->date_of_birth,
            'gender'=>$request->gender,
            'cell_number'=>$request->cell_number,
            'email'=>$request->email_address,
            'password'=>Hash::make(Str::random(4)),
            'status'=>1,
            'role_id'=>$student->id,
        ]);

        $user->attachRole($student);
        $student_id=$user->id;

        //Add student to class/grade
        $class_student=StudentClass::create([
        'student_id'=>$student_id,
        'grade_id'=>$request->grade,
        'academic_session'=>$request->session,
        'active'=>1,
        ]);

        flash()->overlay('<i class="fas fa-check-circle text-success"></i>'.' Congratulations. You have successfully added'.'<span class="text-bold"> '.$request->first_name.' '.$request->last_name.'</span> '.'into the student registry.', 'Register Student');

    } catch (Exception $e) {

            flash()->overlay('<i class=" fa-exclamation-triangle text-danger"></i>'.' Error. Student could not be added into the system.', 'Register Student');

           Log::debug($e->getMessage());
//Log::channel('slack')->info('Something happened!');
        }


    return Redirect::back();

    }else{
     return view('errors.unauthorized');
    }

}

public function bulk_pathway_index(){

    $classes=Grade::all()->sortBy('grade_name');
    $session=AcademicSession::all()->sortBy('academic_session');
    $sponsors=Partner::where('partner_type', 1)->get();

    return view('users.students.registration-pathways.bulk', compact('classes', 'session', 'sponsors'));

}

public function bulk_pathway_store(Request $request){

  //  dd($request->all());

    //Validation
    $validation=$request->validate([
        'student_name'=>'required',
        'student_middlename'=>'nullable',
        'student_lastname'=>'required',
        'student_class'=>'required',

        'student_gender'=>'required',
    ]);



// dd($request->all());

    $student=Role::where('name', 'student')->first();
    $academic_year=AcademicSession::where('active', 1)->first();
    $session=$academic_year->id;



    $name=$request->student_name;
    $lastname=$request->student_lastname;
    $middlename=$request->student_middlename;
    $gender=$request->student_gender;
    $student_status=$request->student_status;
    $student_gender=$request->student_gender;
    // $student_sponsor=$request->student_sponsor;
    $grade=$request->student_class;



    try {
        //code...

        for ($i = 0; $i <count($name); $i++) {
            $user = User::create([
            'name'=>$name[$i],
            'middlename'=>$middlename[$i],
            'lastname'=>$lastname[$i],
            'password'=>Hash::make(Str::random(4)),
            'status'=>1,
            'role_id'=>$student->id,
       ]);



            $user->attachRole($student);

            $student_id=$user->id;


            //dd(array($student_id));

       // Add student to class/grade
        $class_student=StudentClass::create([
        'student_id'=>$student_id,
        'grade_id'=>$grade,
        'academic_session'=>$session,




        ]);

    }
        flash()->overlay('<i class="fas fa-check-circle text-success"></i>'.' Congratulations. You have successfully added'.'<span class="text-bold"> Students</span> '.'into the student registry.', 'Register Student');

    } catch (Exception $e) {

      //  dd($e->getMessage());

            flash()->overlay('<i class=" fa-exclamation-triangle text-danger"></i>'.' Error. Students could not be added into the systemm because of '.' '.$e->getMessage(), 'Register Student');

           Log::debug($e->getMessage());
//Log::channel('slack')->info('Something happened!');
        }


        if(Auth::user()->hasRole('class_teacher')){

            return redirect('/class/student-management');
}else{
    return Redirect::back();
}




}

public function template_export(Excel $excel){

    // return $excel->download(new StudentsListTemplate, 'students_template.xlsx');
    return Excel::download(new StudentsListTemplate, 'students_template.xlsx');

}

public function spreadsheet_pathway_index(){

}

public function spreadsheet_pathway_store(Request $request){

    //multiple sheet upload

}


public function getPayment(Request $request, $id, $grade_id){


    // $student=User::find($id);

//     if($student){
// return response()->json([

//     'status'=>200,
//     'student'=>$student,
// ]);
//     }

    $payment_data = DB::table('users')
    // ->rightjoin('student_fees', 'users.id', '=', 'student_fees.student_id')
    // ->join('grades_students', 'grades_students.id', '=', 'users.id')
    // ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
   // ->join('academic_sessions', 'academic_sessions.id', '=', 'student_fees.financial_year')
   // ->where('academic_sessions.active',1)
    ->where('users.id',$id)
    // ->where('grades_students.grade_id',$grade_id)
    // ->select('users.*','grades.grade_name')
    ->get();



    return response()->json($payment_data);


}


public function makePayment_test(Request $request){
    $student_id=$request->student_id[0];
   // $grad=GradeStudent::where('student_id', $student_id);
//    $grade_data = DB::table('grades_students')
//      ->join('academic_session', 'academic_session.id', '=', 'grade_students.session_id')
//      ->where('academic_session.id',$request->)
//    ->get();

    for($i = 0; $i < count($request->student_id); $i++) {
        $students=$student_id;
        $item=$request->item[$i];
        $amount=($request->amount[$i]);
        $ref=$request->reference[$i];
        $payment_date=$request->payment_date[$i];
        $fy=$request->fy[$i];

        //Delete duplicates
        if(is_null($request->amount[$i])){

        } else{

        StudentFees::create(
            ['student_id'=>$students,
            'amount'=>$amount,
            'ref'=>$ref,
            'payment_date'=>$payment_date,
            'item'=>$item,
            'financial_year'=>$fy,

             ]);

        }

        }



flash()->overlay('<i class="fas fa-check-circle text-success"></i>'.' Good Work '.Auth::user()->name . ' You have successfully added Fees Information.', 'Add Fees');
return Redirect::back();
}
public function makePayment(Request $request){
  //  dd($request->all());


    $activeSession=AcademicSession::where('active', 1)->first();
    $session_id=$activeSession->id;

    for($i = 0; $i < count($request->student_id); $i++) {
        $students=$request->student_id[$i];
        $amount=($request->amount[$i]);
        $ref=$request->ref[$i];
        $payment_date=$request->payment_date[$i];
        $session=$request->session[$i];


        //Delete duplicates
        if(is_null($request->amount[$i])){

        } else{

        StudentFees::updateOrCreate(
            ['student_id'=>$students,
            'amount'=>$amount,
            'ref'=>$ref,
            'amount'=>$ref,
            'payment_date'=>$payment_date,
            'session_id'=>$session_id

             ], ['amount'=>$amount]);

        }

        }

//Check if same s


for($i = 0; $i < count($request->student_id); $i++) {
$students=$request->student_id[$i];
$amount=($request->amount[$i]);
$ref=$request->ref[$i];
$payment_date=$request->payment_date[$i];
$session=$request->session[$i];


//Delete duplicates
if(is_null($request->amount[$i])){

} else{

StudentFees::updateOrCreate(
    ['student_id'=>$students,
    'amount'=>$amount,
    'ref'=>$ref,
    'payment_date'=>$payment_date,
    'session_id'=>$session_id

     ], ['amount'=>$amount]);

}

}

flash()->overlay('<i class="fas fa-check-circle text-success"></i>'.' Good Work '.Auth::user()->name . ' You have successfully added Fees Information.', 'Add Fees');
return redirect('/marks');

}



public function student_image(Request $request){

    //dd($request->all());

    $student_id=$request->student_id;

    $school=School::first();
    $school_code=$school->school_code;



    // dd($request->all());

    if($request->hasFile('student_image')){


        // $cloudinary->uploadApi()->upload("dog_couch.jpg", [
        //     "public_id" => "dog_couch",
        //     "background_removal" => "cloudinary_ai",
        //     "notification_url" => "https://mysite.example.com/hooks"]);


        $image = $request->file('student_image')->storeOnCloudinaryAs('shunifu', $school_code.'-'.$student_id);

        $student_image=$image->getSecurePath();



        User::where('id', $student_id)->update([

            'profile_photo_path'=>$student_image,
        ]);

     //   return Redirect::back();

    }else{

    }
    // return Redirect::back();

}


public function import_multiple_single_format(Request $request){

    $collection=Excel::import(new StudentMultiSheetImport, $request->file('import'));

    // Excel::import(
    //     new MultiSheetSingleFormatImport, 'MOCK_DATA.xlsx'
    // );

}


    }
