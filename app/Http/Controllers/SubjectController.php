<?php

namespace App\Http\Controllers;


use App\Models\Section;
use App\Models\Subject;
use App\Models\TeachingLoad;
use App\Models\TermAverage;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SubjectController extends Controller
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


      

        if (!Schema::hasColumn('subjects', 'order')) //check the column
		{
			Schema::table('subjects', function (Blueprint $table)
			{
			   
				$table->integer('order')->nullable();
              
			});
		}

        if (!Schema::hasColumn('subjects', 'abbreviation')) //check the column
		{
			Schema::table('subjects', function (Blueprint $table)
			{
			   
				$table->integer('abbreviation')->nullable();
              
			});
		}
       
        $collection_subject=DB::table('subjects')
        ->leftjoin('sections','sections.id','=','subjects.section_level')
        ->select('subjects.id as id','subjects.order','abbreviation' ,'sections.section_name', 'subjects.subject_name','subjects.subject_type','section_level', 'subjects.subject_code')
        ->get();

        $sections=Section::all();


        return view('academic-admin.subject-management.add-subject', compact('collection_subject','sections'));
    }



    public function modify(Request $request){

        $subject_id=$request->subject_id;
        $order=$request->order;

    foreach ($subject_id as $key => $value) {

      $subject_identifier=$subject_id[$key];
      $subject_order=$order[$key];

        
       $update=Subject::where('id', $subject_identifier)->update([

        'order'=>$subject_order,


       ]);



    //    $code=$request->code;   
    //   $effort_grade=$request->effort_grade;




        // foreach ($code as $key => $value) {

           
   

        //     $mark_id=$code[$key];
        //     $effort_grade_new=$effort_grade[$key];

          
  

        //   $update=Mark::where('id',$mark_id)->update([ 'effort_grade'=>$effort_grade_new]);
        
         
        // }

      

        }
       

       $collection_subject=DB::table('subjects')
       ->leftjoin('sections','sections.id','=','subjects.section_level')
       ->select('subjects.id as id','subjects.order','abbreviation' ,'sections.section_name', 'subjects.subject_name','subjects.subject_type','section_level', 'subjects.subject_code')
       ->get();

       $sections=Section::all();

          flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have updated subjects data.', 'Modify Subject Data');
     

       return view('academic-admin.subject-management.add-subject', compact('collection_subject','sections'));

    

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
            'subject_name'=>'required',
            'subject_type'=>'required',
            'subject_section'=>'required',
            // 'subject_code'=>'required',
        ]);
        
        $subject_name=$request->input('subject_name');
        $subject_type=$request->input('subject_type');
        $subject_code=$request->input('subject_code');
        $subject_section=$request->input('subject_section');

// $codeExists=Subject::where('subject_code', $subject_code)->exists();

// if ($codeExists) {
//     flash()->overlay(''.' Warning. ECESWA Code already exists', 'Update Subject');
//             return redirect('academic-admin/subject');
// }else{
    Subject::create([
        'subject_name' => $subject_name,
        'subject_type' => $subject_type,
        'subject_section'=>$subject_section,
        'subject_code'=>$subject_code
    ]);

    flash()->overlay('<i class="fas fa-check-circle text-success "></i> Congratulations. You have successfully added subject', 'Add Subject');

return redirect()->back();
// }

    

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject, $id)

    {
        $subject=Subject::find($id);
    //    / if(){

    //     }

        // $result=DB::table('subjects')
        // ->join('sections','grades_teachers.grade_id','=','grades.id')
        // ->join('users','grades_teachers.teacher_id','=','users.id')
        // ->join('academic_sessions','grades_teachers.academic_session','=','academic_sessions.id')
        // ->select('grades.grade_name', 'users.name','users.lastname', 'users.salutation', 'academic_sessions.academic_session', 'grades_teachers.id')
        // ->orderBy('grades.grade_name','asc')
        // ->get();

        $sections=Section::all();
       
        
        return view('academic-admin.subject-management.edit-subject', compact('subject', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {

        //dd($request->all());
        //Remember to add security check

        $id=$request->subject_id;
        $subject_data=Subject::find($id);

        // $code=$request->subject_code;

        

        // $subjectCodeExists=Subject::where('subject_code', $code)->exists();
        // if($subjectCodeExists){

        //     flash()->overlay(''.' Warning. ECESWA Code already exists', 'Update Subject');
        //     return redirect('academic-admin/subject');

        // }else{
            $subject_data->subject_name = $request->subject_name;
            $subject_data->subject_type = $request->subject_type;
            $subject_data->section_level = $request->subject_level;
            // $subject_data->subject_code = $request->subject_code;
            $subject_data->save();

    flash()->overlay('<i class="fas fa-check-circle text-success"></i>'.' Success. You have updated subject', 'Update Subject');
    return redirect('academic-admin/subject');

        // }
   
  
   

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject, $id)
    {
           //Remember to add security check
       
//Do not delete if in teaching loads

$SubjectExists=TeachingLoad::where('subject_id',$id)->exists();
//$SubjectExists=TermAverage::where('subject_id',$id)->where('active',1)->exists();
if($SubjectExists){
    flash()->overlay('Sorry cannot delete that subject as it is already assigned to teaching loads and marks.', 'Delete Subject');
    return Redirect::back();
}else{
    $subject=Subject::find($id);
    $subject->delete();
    flash()->overlay('<i class="fas fa-check-circle text-green "></i>'.' You have successfully deleted subject', 'Delete Subject');
    return Redirect::back();
}

       
    }
}
