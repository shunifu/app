<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Mark;
use App\Models\Grade;
use App\Models\PassRate;
use App\Models\Assessement;
use App\Models\StudentLoad;
use App\Models\TeachingLoad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Svg\Tag\Rect;
use App\Traits\GreetingsTrait;
use App\Traits\MarksTrait;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use GreetingsTrait;
    use MarksTrait;
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
        
        $greetings= $this->greetings();
        $assessements= $this->assessements();
        $teaching_loads= $this->teaching_loads();

        return view('academic-admin.marks-management.index', compact('greetings','teaching_loads','assessements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Insert or ignore

        $activeSession=AcademicSession::where('active', 1)->first();
        $session_id=$activeSession->id;

//Check if same s

      
for($i = 0; $i < count($request->student_id); $i++) {
    $students=$request->student_id[$i];
    $marks=($request->marks[$i]);
    $load_id=$request->teaching_load_id[$i];
    $teacher_id=$request->teacher_id[$i];
    $assessement_id=$request->assessement_id[$i];
    

    //Delete duplicates

    
   if(is_null($request->marks[$i])){



   } else{

    Mark::updateOrCreate(
        ['student_id'=>$students,
        'teaching_load_id'=>$load_id,
        'mark'=>$request->marks[$i],
        'teacher_id'=>$teacher_id,
        'assessement_id'=>$assessement_id, 
        'session_id'=>$session_id
        
         ], ['mark'=>$request->marks[$i]]);

   }

}
   
flash()->overlay('<i class="fas fa-check-circle text-success"></i>'.' Good Work '.Auth::user()->name . ' You have successfully added marks.', 'Add Marks');
return redirect('/marks');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */



    //  public $greetings;

    // public function __construct()
    // {

    //     $hour=date('H');
    

    //  // $this->order_number=$order_number;

    //     if ($hour >= 20) {
    //         $greetings = "Good Night";
    //     } elseif ($hour > 17) {
    //        $greetings = "Good Evening";
    //     } elseif ($hour > 11) {
    //         $greetings = "Good Afternoon";
    //     } elseif ($hour < 12) {
    //        $greetings = "Good Morning";
    //     }

    //   $this->greetings=$greetings;

    //  //   dd($greetings);
     
   // }

    public function show(Mark $mark, Request $request)
    {

        //dd($request->all());
       
         // Validation
        $validator=$request->validate([
            'teaching_load'=>'required',
            'assessement_id'=>'required',
           
        ]);
        $assessement_id=$request->assessement_id;

        $greetings=$this->greetings();
        $teaching_loads=$this->teaching_loads();
        $assessements=$this->assessements();

        $assessement_description=Assessement::find($assessement_id);

        // $teaching_loads = DB::table('teaching_loads')
		// 		->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
		// 		->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
		// 		->join('academic_sessions', 'teaching_loads.session_id', '=', 'academic_sessions.id')
		// 		->where('teaching_loads.teacher_id', Auth::user()->id)
        //         ->where('academic_sessions.active', 1 )
        //         ->where('teaching_loads.active', 1 )
		// 		->select('grade_name', 'subject_name', 'teaching_loads.id as teaching_load_id')
		// 		->get();

        //Assessment Lists
        // $assessements=DB::table('assessements')
        // ->join('terms','terms.id','=','assessements.term_id')
        // ->join('assessement_types','assessement_types.id','=','assessements.assessement_type')
        // ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
        // ->where('academic_sessions.active', 1 )//
        // ->select('assessements.id as assessement_id','terms.term_name', 'assessement_name', 'assessement_type_name')
        // ->get();

        // dd($assessements);

     //Same stream Same subject


     //create cleaning tool
     
     //check class the student is in
     //check if teaching load.class matches with class student is in

     //if no match 
     //delete entry in marks



     
    //   $r=array($request->teaching_load);
    //    dd($request->teaching_load);
    //   exit();

    //   foreach ($request->teaching_load as $key => $value) {
        $string=$request->teaching_load;
        //dd($string);

      
// $array=array_map('intval', explode(',', $string));
$array = implode("','",$string);

        
        $students=DB::select(DB::raw("SELECT
            student_loads.student_id,
            users.name,
            users.id as student_id,

            users.middlename,
            users.lastname,
            student_loads.teaching_load_id,
            subjects.subject_name,
            grades.grade_name,
            grades.id as grade_id,
            (SELECT marks.mark from marks WHERE  teaching_load_id= student_loads.teaching_load_id AND marks.assessement_id=$assessement_id AND student_id=users.id) AS mark,
            (SELECT marks.id from marks WHERE  teaching_load_id= student_loads.teaching_load_id AND marks.assessement_id=$assessement_id AND student_id=users.id) AS mark_id
           FROM
               student_loads
               INNER JOIN users ON users.id=student_loads.student_id
               INNER JOIN grades_students ON grades_students.student_id=student_loads.student_id
               INNER JOIN teaching_loads ON teaching_loads.id=student_loads.teaching_load_id
               INNER JOIN grades ON grades.id=teaching_loads.class_id
               INNER JOIN subjects ON subjects.id=teaching_loads.subject_id  
               WHERE student_loads.teaching_load_id IN ('".$array."') AND grades_students.active=1 AND teaching_loads.active=1
           ORDER BY `users`.`lastname`, `users`.`name` ASC"));
    //   }


    // $students_object=(object)$students;
    // $students_collection=$students_object->get();
    // $student_list=$students_collection->groupBy('grade_id')->toArray();
    // dd($student_list);
   
    
        //   }
    
        //$teaching_loads= $this->teaching_loads();
        $loads_description = DB::table('teaching_loads')
        ->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
        ->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
        ->wherein('teaching_loads.id', $string)
        ->where('teaching_loads.active', 1)
        ->select('grade_name', 'subject_name', 'teaching_loads.id as teaching_load_id')
        ->get();

        // dd($loads_description);

 
    return view('academic-admin.marks-management.show', compact('greetings', 'teaching_loads', 'assessements', 'students', 'assessement_id', 'loads_description', 'assessement_description'));      

    }

    public function manage(Request $request){
        $greetings= $this->greetings();
         //Assessment Lists
         $assessements=DB::table('assessements')
        ->join('terms','terms.id','=','assessements.term_id')
        ->join('assessement_types','assessement_types.id','=','assessements.assessement_type')
        ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
        ->where('academic_sessions.active', 1 )//
        ->select('assessements.id as assessement_id','terms.term_name', 'assessement_name', 'assessement_type_name')
        ->get();

         $teaching_loads = DB::table('teaching_loads')
         ->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
         ->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
         ->where('teaching_loads.teacher_id', Auth::user()->id)
         ->join('academic_sessions', 'teaching_loads.session_id', '=', 'academic_sessions.id')
				->where('teaching_loads.teacher_id', Auth::user()->id)
                ->where('academic_sessions.active', 1 )
                ->where('teaching_loads.active', 1 )
         ->select('grade_name', 'subject_name', 'teaching_loads.id as teaching_load_id')
         ->get();
 
       $assessement=$request->assessement_id;
        return view('academic-admin.marks-management.manage', compact('greetings', 'teaching_loads', 'assessements'));
     
      
    }

    public function show_marks(Request $request){

        $greetings= $this->greetings();
        

        $marks = DB::table('marks')
        ->join('users', 'marks.student_id', '=', 'users.id')
        ->join('teaching_loads', 'marks.teaching_load_id', '=', 'teaching_loads.id')
        ->join('assessements', 'marks.assessement_id', '=', 'assessements.id')
        ->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
        ->where('teaching_loads.id', $request->teaching_load)
        ->where('assessements.id', $request->assessement_id)
        ->select('marks.id as mark_id', 'mark','name','lastname','middlename','subject_id','subject_name','assessement_id','class_id','teaching_load_id')
        ->get();

        $assessements=DB::table('assessements')
        ->join('terms','terms.id','=','assessements.term_id')
        ->join('assessement_types','assessement_types.id','=','assessements.assessement_type')
        ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
        ->where('academic_sessions.active', 1 )
        ->select('assessements.id as assessement_id','terms.term_name', 'assessement_name', 'assessement_type_name')
        ->get();


        $assessement_name=Assessement::find($request->assessement_id)->assessement_name;

        $loads = DB::table('teaching_loads')
        ->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
        ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
        ->where('teaching_loads.id', $request->teaching_load)
        ->first();

        $teaching_loads = DB::table('teaching_loads')
        ->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
        ->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
        ->where('teaching_loads.teacher_id', Auth::user()->id)
        ->where('teaching_loads.active', 1)
        ->select('grade_name', 'subject_name', 'teaching_loads.id as teaching_load_id')
        ->get();
        //Scope to current academic_year

        
        return view('academic-admin.marks-management.view-marks', compact('greetings','marks', 'loads', 'assessement_name','teaching_loads','assessements'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        
        $mark = DB::table('marks')
        ->join('users', 'users.id', '=', 'marks.student_id')
        ->join('assessements', 'assessements.id', '=', 'marks.assessement_id')
        ->join('teaching_loads', 'teaching_loads.id', '=', 'marks.teaching_load_id')
        ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
        ->where('marks.id','=',$id)
        ->select('marks.id as mark_id','users.name','marks.mark', 'users.lastname', 'users.middlename','assessements.assessement_name','subjects.subject_name')
        ->get();
        
        return response()->json($mark[0]);

      
    }

    public function analysis(){

        $greetings= $this->greetings();

        $teaching_loads = DB::table('teaching_loads')
				->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
				->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
				->where('teaching_loads.teacher_id', Auth::user()->id)
                ->where('teaching_loads.active', 1)
				->select('grade_name', 'subject_name', 'teaching_loads.id as teaching_load_id')
				->get();

        //Assessment Lists
        $assessements=DB::table('assessements')
        ->join('terms','terms.id','=','assessements.term_id')
        ->join('assessement_types','assessement_types.id','=','assessements.assessement_type')
        ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
        ->where('academic_sessions.active', 1)
        ->select('assessements.id as assessement_id','terms.term_name', 'assessement_name', 'assessement_type_name')
        ->get();


    return view('academic-admin.marks-management.analytics', compact('greetings','teaching_loads','assessements'));

    }

    public function analysis_store(Request $request){

        $greetings= $this->greetings();

        $stream_qry = DB::table('teaching_loads')
        ->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
        ->where('teaching_loads.id', $request->teaching_load)
        ->select('grades.stream_id')
        ->first();

       $stream=$stream_qry->stream_id;

        
        $section=Grade::where('stream_id', $stream)->first();
        $section_id=$section->section_id;


        

 

        if($criteriaExists=PassRate::where('section_id', $section_id)->exists()){
            $criteria=PassRate::where('section_id', $section_id)->first();
            $pass_rate=$criteria->passing_rate;
      
   
            $passed = DB::table('marks')
            ->join('users', 'marks.student_id', '=', 'users.id')
            ->join('teaching_loads', 'marks.teaching_load_id', '=', 'teaching_loads.id')
            ->join('assessements', 'marks.assessement_id', '=', 'assessements.id')
            ->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
            ->where('teaching_loads.id', $request->teaching_load)
            ->where('assessements.id', $request->assessement_id)
            ->where('marks.mark','>=', $pass_rate)
            ->orderByDesc('mark')
            ->get();
    
            $failed = DB::table('marks')
            ->join('users', 'marks.student_id', '=', 'users.id')
            ->join('teaching_loads', 'marks.teaching_load_id', '=', 'teaching_loads.id')
            ->join('assessements', 'marks.assessement_id', '=', 'assessements.id')
            ->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
            ->where('teaching_loads.id', $request->teaching_load)
            ->where('assessements.id', $request->assessement_id)
            ->where('marks.mark','<', $pass_rate)
            ->orderByDesc('mark')
            ->get();
    
            $total=($passed->count()+$failed->count());
            //Total should be all students (student loads)
    
            $total_passed=$passed->count();
            $total_failed=$failed->count();
    
            $subject_pass_rate=round(($passed->count()/$total)*100);
            $subject_fail_rate=round(($failed->count()/$total)*100);
    
            $assessement_data = DB::table('marks')
            ->join('users', 'marks.teacher_id', '=', 'users.id')
            ->join('teaching_loads', 'marks.teaching_load_id', '=', 'teaching_loads.id')
            ->join('assessements', 'marks.assessement_id', '=', 'assessements.id')
            ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
            ->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
            ->where('teaching_loads.id', $request->teaching_load)
            ->where('assessements.id', $request->assessement_id)
            ->first();
    
            // dd($assessement_data);
    
            //Show Pie Chart
            //Show Barchart -Pass Rate-- Failure Rate
    
           
            $results=['passed'=>$total_passed, 'failed'=>$total_failed];
            return view('academic-admin.marks-management.analytics-details', compact('assessement_data','greetings','total','subject_pass_rate','subject_fail_rate','passed','failed', 'total_failed','total_passed', 'results'));
        }else{

            flash()->overlay('<i class="fas fa-check-circle success"></i>'.' Sorry, Passing criteria not set. Please consult system administrator to add passing criteria . ', 'Response');
            return Redirect::back();

        }
      

       


    }

    public function check_marks( Request $request){

   //   $teachingLoad=TeachingLoad::where('active', 1)->get()->pluck('id')->toArray();

      $current_session=AcademicSession::where('active',1 )->first();
      $current_academic_year=$current_session->id;
        
  
    $teachingLoad=TeachingLoad::where('session_id', $current_academic_year)->get()->pluck('id')->toArray();

   

      $check=[];
      foreach ($teachingLoad as $loads){

        $check[]=DB::select(DB::raw("SELECT users.name, 
        users.middlename,
        users.salutation,
        users.lastname,
        grades.grade_name,
        subjects.subject_name,
        COUNT(teaching_loads.teacher_id) as total_loads, 
        (SELECT count(student_loads.student_id) as total_students from student_loads WHERE student_loads.teaching_load_id=".$loads.") as total_students,
        (SELECT COUNT(marks.mark) FROM marks WHERE marks.teaching_load_id=".$loads.") as marks_entered FROM teaching_loads
        INNER JOIN users ON users.id=teaching_loads.teacher_id 
        INNER JOIN subjects ON subjects.id=teaching_loads.subject_id 
        INNER JOIN grades ON grades.id=teaching_loads.class_id 
        WHERE teaching_loads.id=".$loads." AND teaching_loads.active=1
        GROUP BY teaching_loads.subject_id, teaching_loads.class_id ORDER BY grades.grade_name ASC"));

      }

     //Sort the isssue of academic session
    
      $assessements=DB::table('assessements')
      ->join('terms','terms.id','=','assessements.term_id')
      ->join('assessement_types','assessement_types.id','=','assessements.assessement_type')
      ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
      ->where('academic_sessions.active', 1)
      ->select('assessements.id as assessement_id','terms.term_name', 'assessement_name', 'assessement_type_name')
      ->get();


return view('academic-admin.marks-management.check-marks', compact('check','assessements'));

//ADD assessement bani
      

    }

    public function marks_check_search(Request $request){

        $assessements=DB::table('assessements')
        ->join('terms','terms.id','=','assessements.term_id')
        ->join('assessement_types','assessement_types.id','=','assessements.assessement_type')
        ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
        ->where('academic_sessions.active', 1 )
        ->select('assessements.id as assessement_id','terms.term_name', 'assessement_name', 'assessement_type_name')
        ->get();

    $current_session=AcademicSession::where('active',1 )->first();
    $current_academic_year=$current_session->id;
      

        $teachingLoad=TeachingLoad::where('session_id', $current_academic_year)->get()->pluck('id')->toArray();

    //   dd($teachingLoad);


        $check[]=DB::select(DB::raw("SELECT 
		teaching_loads.id,		
		users.name, 
        users.middlename,
        users.salutation,
        users.lastname,
        grades.grade_name,
        subjects.subject_name, 
     	(SELECT COUNT(*) from student_loads inner join marks ON marks.teaching_load_id=student_loads.teaching_load_id  WHERE marks.assessement_id=".$request->assessement_id." AND  marks.teaching_load_id=student_loads.teaching_load_id  AND student_loads.teaching_load_id=teaching_loads.id AND teaching_loads.active=1 AND student_loads.active=1 AND marks.active=1) as total_loads,
    	(SELECT COUNT(*) from marks  WHERE marks.assessement_id=".$request->assessement_id." AND marks.teaching_load_id=teaching_loads.id AND marks.active=1 AND teaching_loads.active=1) as marks_count
       	FROM teaching_loads
        INNER JOIN users ON users.id=teaching_loads.teacher_id 
        INNER JOIN subjects ON subjects.id=teaching_loads.subject_id 
        INNER JOIN grades ON grades.id=teaching_loads.class_id 
        where teaching_loads.active=1
        ORDER BY grades.grade_name
"));

      
      return view('academic-admin.marks-management.check-marks-result', compact('check','assessements'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mark $mark)
    {
       
        $mark=Mark::find($request->id)->update(['mark'=>$request->new_mark]);

        //Update Subject Averages
        
        //  Mark::create

        // flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. Email Added', 'Add Email');
    
        // return redirect('/student/register/')->with('status','Email Successfully Added.');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mark $mark, Request $request)

    {
        $list=$request->marks;
        if (empty($list)) {

            flash()->overlay('<i class="fas fa-check-circle success"></i>'.' Sorry. There are no marks for that class and assessement. Click the following link <a href="/marks/">Add Marks</a> to add marks. ', 'Delete Marks');
            return redirect('/marks');
            
        }else{

        
      

        
    for($i = 0; $i <count($list); $i++) {

       $deleteMarks=Mark::find($list[$i])->delete();
    
     }
  
     flash()->overlay('<i class="fas fa-check-circle success"></i>'.' Congratulations. You have successfully deleted Marks.', 'Delete Marks');
          
    
     return redirect('/marks');
    }
     
        
    }

    public function transfer_marks(Request $request){

        $greetings= $this->greetings();
         //Assessment Lists
         $assessements=DB::table('assessements')
         ->join('terms','terms.id','=','assessements.term_id')
         ->join('assessement_types','assessement_types.id','=','assessements.assessement_type')
         ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
         ->where('academic_sessions.active', 1 )
         ->select('assessements.id as assessement_id','terms.term_name', 'assessement_name', 'assessement_type_name')
         ->get();

         $teaching_loads = DB::table('teaching_loads')
         ->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
         ->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
         ->where('teaching_loads.teacher_id', Auth::user()->id)
         ->where('teaching_loads.active', 1)
         ->select('grade_name', 'subject_name', 'teaching_loads.id as teaching_load_id')
         ->get();
 
       $assessement=$request->assessement_id;

    //    $mark = DB::table('marks')
    //    ->join('grades', 'teaching_loads.class_id', '=', 'grades.id')
    //    ->join('subjects', 'teaching_loads.subject_id', '=', 'subjects.id')
    //    ->where('teaching_loads.teacher_id', Auth::user()->id)
    //    ->select('grade_name', 'subject_name', 'teaching_loads.id as teaching_load_id')
    //    ->get();

   
        return view('academic-admin.marks-management.transfer', compact('greetings', 'teaching_loads', 'assessements'));
    
    }

    public function transfering(Request $request){

        //Change the assessement_id

        //dd($request->all());

        $assessement_to=Assessement::where('id',$request->transfer_to )->first();
        $assessement_from=Assessement::where('id',$request->transfer_from )->first();
        $to=$assessement_to->assessement_name;
        $from=$assessement_from->assessement_name;

       
       //Transfer rules:
       //1. Transfer only if 'transfer_to' is empty
       //2. Transfer only if 'transfer_from' has marks
       
    $getMarks=Mark::where('assessement_id',$request->transfer_to)->where('teaching_load_id',$request->teaching_load)->get();

    $getFromMarks=Mark::where('assessement_id',$request->transfer_from)->where('teaching_load_id',$request->teaching_load)->get();

  //  $getMarks->count();

        if($getMarks->isEmpty()  AND  $getFromMarks->isNotEmpty()){
            $update=Mark::where('teaching_load_id',$request->teaching_load)->where('assessement_id',$request->transfer_from)->update(['assessement_id'=>$request->transfer_to]);
            flash()->overlay('<i class="fas fa-check-circle text-success"></i>'.' Good work,  '.Auth::user()->name.'. You have successfully transfered marks from '.$from.' to '.$to);
        } else{

            flash()->overlay(''.' Sorry,  '.Auth::user()->name.'. It looks like there is an error. Please check if  '.$to.' has marks. if it has marks, then the marks wont be transferd. Marks are only transfered if there are no marks to where you are transfering the marks to.'.' Or check if  '.$from.' '.'has marks. if the assessment you are transfering from does not have marks, you will not be able to transfer. To successfully transfer marks,  the transfer-from-assessement should not be empty and the transfer-to-assessment must be empty');

        }

       

        

        return redirect('marks/transfer/');
    }
}
