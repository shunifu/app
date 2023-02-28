<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Grade;
use App\Models\Stream;
use App\Models\Section;
use Barryvdh\DomPDF\PDF;
use App\Models\GradeTeacher;
use App\Models\School;
use App\Models\Session;
use App\Models\StudentClass;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $master_collection=DB::table('grades')
        ->join('streams','grades.stream_id','=','streams.id')
        ->join('sections','grades.section_id','=','sections.id') 
        ->select('grades.id as grade_id','grades.grade_name','stream_name', 'section_name', 'grades.section_id','grades.stream_id')->orderBy('grades.grade_name')
        ->get();
        
     
        $collection_grade=Grade::all();
        $collection_section=Section::all();
        $collection_stream=Stream::all();
        
        return view('academic-admin.class-management.add-grade', compact('master_collection','collection_grade', 'collection_stream','collection_section'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation=$request->validate([
            'grade_name'=>'required',
            'section'=>'required',
            'stream'=>'required'
        ]);

        $section_name=$request->input('section');
        $stream_name=$request->input('stream');
        $grade_name=$request->input('grade_name');

        $grade=Grade::create([
            'grade_name'=>$grade_name,
            'section_id' => $section_name,
            'stream_id'=>$stream_name,
           
        ]);


        flash()->overlay('<i class="fas fa-check-circle text-success "></i>'.' Success. You have added class.', 'Add Class');
    
        return redirect('academic-admin/class');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade, $id)
    {
        $students= DB::table('grades_students')
        ->join('users', 'users.id', '=', 'grades_students.student_id')
        ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
        ->join('academic_sessions','academic_sessions.id','=','grades_students.academic_session')
        ->select('grades.id as grade_id','users.id as id', 'name', 'lastname', 'middlename', 'gender', 'date_of_birth',   'profile_photo_path')
        ->where('grades_students.grade_id', $id)
        ->where('academic_sessions.active',1 )
        ->where('grades_students.active',1 )
        ->orderBy('lastname')->orderBy('name')->get();

        $total=StudentClass::where('grade_id', $id)->count();
        

        $teacher= DB::table('grades_teachers')
        ->join('users', 'users.id', '=', 'grades_teachers.teacher_id')
        ->join('grades', 'grades.id', '=', 'grades_teachers.grade_id')
        ->select('grades.id as grade_id','grade_name',  'name', 'lastname', 'middlename',  'profile_photo_path')
        ->where('grades_teachers.grade_id', $id)->first();

       
        return view('academic-admin.class-management.view-class', compact('students','teacher','total'));
    }

    public function createPDF($id){
         // retreive all records from db
         $data= DB::table('grades_students')
         ->join('users', 'users.id', '=', 'grades_students.student_id')
         ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
         ->join('academic_sessions','academic_sessions.id','=','grades_students.academic_session')
         ->select('grades.id as grade_id','users.id as id', 'name', 'lastname', 'middlename', 'gender', 'date_of_birth',   'profile_photo_path')
         ->where('grades_students.grade_id', $id)
         ->where('academic_sessions.active',1 )
         ->where('grades_students.active',1 )
         ->orderBy('lastname')->orderBy('name')->get();

      // share data to view
   //   view()->share('id',$data);
      $pdf = FacadePdf::loadHTML('academic-admin.class-lists.view', $data);


    //   dd($pdf);

      // download PDF file with download method
      return $pdf->download('pdf_file.pdf');

   
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade, $id)
    {
       if(Auth::user()->hasRole('admin_teacher')){
        $class_info= DB::table('grades')
        ->join('streams', 'streams.id', '=', 'grades.stream_id')
        ->join('sections', 'sections.id', '=', 'grades.section_id')
        ->select('grades.id as grade_id', 'stream_name', 'grade_name', 'section_name', 'sections.id as section_id', 'streams.id as stream_id')
        ->where('grades.id', $id)
        ->first();
       
        
        $streams=Stream::all();
        $sections=Section::all();
        return view('academic-admin.class-management.edit-grade', compact('class_info', 'sections', 'streams'));
           
       }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade )
    {

        $id=$request->id;
        if(Auth::user()->hasRole('admin_teacher')){

            $StudentsExists=StudentClass::where('grade_id', $id)->exists();

          
                Grade::find($id)->update(['grade_name'=>$request->grade_name, 'stream_id'=>$request->stream,'section_id'=>$request->section]);
            
      

		flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have updated Class', 'Edit Class');

        return redirect('/academic-admin/class');
    }
}

public function view ($id){
    if(Auth::user()->hasRole('admin_teacher')){

        $class_info= DB::table('grade_teacher')
        ->join('users', 'users.id', '=', 'grades_teacher.teacher_id')
        ->get();
   
        
        $streams=Stream::all();
        $sections=Section::all();
        return view('academic-admin.class-management.edit-grade', compact('class_info', 'sections', 'streams'));
           
       }

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade, $id)
    {
        if(Auth::user()->hasRole('admin_teacher')){
            //Cant delete class if class has students already
            
            $StudentsExists=StudentClass::where('grade_id', $id)->exists();

            if($StudentsExists){

                flash()->overlay('<i class="fas fa-check-circle text-success"></i> Sorry. You cannot delete that class because the are students in it.', 'Delete Class');

                return redirect('/academic-admin/class');
            }else{
               Grade::find($id)->delete();
               flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have deleted grade.', 'Delete Grade');

               return redirect('/academic-admin/class');
            }


        }
    }

    public function  class_lists_index(){


        $grades=Grade::all();
        $sessions=AcademicSession::all();

        return view('academic-admin.class-lists.index', compact('grades', 'sessions'));

    }


    public function  class_lists_view(Request $request){


        //validation

        $validation=$request->validate([
            'session'=>'required',
            'grade'=>'required',
        ]);

        $session_id=$request->session;
        $grade_id=$request->grade;



        $data= DB::table('grades_students')
        ->join('users', 'users.id', '=', 'grades_students.student_id')
        ->join('grades', 'grades.id', '=', 'grades_students.grade_id')
        ->join('academic_sessions','academic_sessions.id','=','grades_students.academic_session')
        ->select('grades.grade_name as grade_name','grades.id as grade_id','users.id as id', 'name', 'lastname', 'middlename', 'gender', 'date_of_birth',   'profile_photo_path')
        ->where('grades_students.grade_id', $grade_id)
        ->where('grades_students.academic_session', $session_id)
        ->where('academic_sessions.id',$session_id )
        ->where('grades_students.active',1 )
        ->where('users.active',1 )
        ->orderBy('lastname')->orderBy('name')->get();

      

        $grade=Grade::where('id', $grade_id)->first();
        $session=AcademicSession::where('id', $session_id)->first();

        // dd($data);


        $school_info=School::all();

        return view('academic-admin.class-lists.view', compact('data', 'school_info', 'grade', 'session'));


    }
}
