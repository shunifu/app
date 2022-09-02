<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\SplitSubject;
use Illuminate\Http\Request;
use App\Models\AssessementOnline;
use Illuminate\Support\Facades\DB;
use App\Models\AssessementQuestion;
use Illuminate\Support\Facades\Auth;
use Google\Service\BigtableAdmin\Split;
use Illuminate\Support\Facades\Redirect;


class AssessementQuestionController extends Controller
{
    public  function index(){

        $my_teaching_loads=DB::table('teaching_loads')
        ->join('users','teaching_loads.teacher_id','=','users.id')
        ->join('subjects','teaching_loads.subject_id','=','subjects.id')
        ->join('grades','teaching_loads.class_id','=','grades.id')
        ->where('teaching_loads.teacher_id', Auth::user()->id )
        ->select('subject_name','grade_name', 'name', 'teaching_loads.id', 'teaching_loads.subject_id', 'teaching_loads.teacher_id')
        ->orderBy('grades.grade_name', 'ASC')
        ->get();
      //  dd($my_teaching_loads);

        return view('online-learning.assessement-management.index', compact('my_teaching_loads'));
    }

    public function index_without_lesson(){


        //$assessements=AssessementOnline::where('teacher_id',Auth::user()->id)->get();
        $assessements=DB::table('assessement_onlines')
        ->join('assessement_types','assessement_types.id','=','assessement_onlines.assessement_type')
        ->leftjoin('assessement_questions','assessement_questions.assessement_id','=','assessement_onlines.id')
        ->join('teaching_loads','teaching_loads.id','=','assessement_onlines.teaching_load_id')
        ->join('grades','teaching_loads.class_id','=','grades.id')
        ->join('subjects','teaching_loads.subject_id','=','subjects.id')
        ->where('assessement_onlines.teacher_id',Auth::user()->id)
        ->select(DB::raw('count(assessement_questions.assessement_id) as total_questions'), 'grades.grade_name','subjects.subject_name','assessement_types.assessement_type_name', 'assessement_onlines.due_date', 'assessement_onlines.created_at','assessement_onlines.assessement_title', 'assessement_onlines.lesson_topic', 'assessement_onlines.id')
        ->orderBy('assessement_onlines.created_at', 'DESC')
        ->groupBy('assessement_onlines.id')
        ->get();
    // dd($assessements);
      
        return view('online-learning.assessement-management.index-without-lesson',compact('assessements'));

    }

    public function getSubject(Request $request)
    {

        $subject=DB::table('teaching_loads')
        ->join('users','teaching_loads.teacher_id','=','users.id')
        ->join('subjects','teaching_loads.subject_id','=','subjects.id')
        ->join('grades','teaching_loads.class_id','=','grades.id')
        ->where('teaching_loads.id', $request->subject_id )
        ->select('subject_name','grade_name', 'name', 'teaching_loads.id', 'teaching_loads.subject_id', 'teaching_loads.teacher_id')
        ->orderBy('grades.grade_name', 'ASC')
        ->pluck('subject_name');
    //  $subject = DB::table("teaching_loads")
    // ->find($request->subject_id);

    if ($subject[0]=="Physical Science") {
        //Get ID of Physics and Chemistry

        $subjects=DB::table('subjects')
        ->join('teaching_loads','teaching_loads.subject_id','=','subjects.id')
        ->where('teaching_loads.id', $request->subject_id )
        ->get()->pluck('subject_name');

        $subjects=DB::table('split_subjects')
        ->join('subjects','split_subjects.key','=','subjects.subject_name')
        ->where('key', "Physical Science" )
        ->get()->pluck('subject');

// $subjects='[{subject_name:Chemistry,subject_name:Chemistry}]';
        return response()->json($subjects);
    } else {
        # code...
    }
    
 
    }

    public function create_assessment(Request $request){

    //   dd($request->all());

        //Validate Inputs
        // $validation=$request->validate([
        //     'teaching_load'=>'required',
        //     'assessement_title'=>'required',
        //     'lesson_topic'=>'required',
        //     'assignment_due_date'=>'required',
        //     'teacher_id'=>'required',
        // ]);
    



        //Get Physics & Chemistry id's

        // if (!is_null($request->subject)) {
        //     $splits=DB::table('subjects')
        //     ->where('subjects.subject_name', $request->subject )
        //     ->first();
    
        //     $subject=$splits->id;
        // }else{
        //     $subject='null';
        // }
      
    //    $assessement= AssessementOnline::create([
    //         'teaching_load'=>$request->teaching_load,
    //         'teacher_id'=>Auth::user()->id,
    //         'subject'=>$subject,
    //         'assessement_title'=>$request->assessement_title,
    //         'lesson_topic'=>$request->lesson_topic,
    //         'assignment_due_date'=>$request->assignment_due_date,


    //     ]);

        // $assessement_id=$assessement->id;
        // AssessementOnline::where

        // flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have added assessements, now attach questions to that assessement', 'Add Assessements');

       // return view('online-learning.assessement-management.attach-questions', compact('assessement_id'));
      //Save Assessement


    

    }

    public function assessement_store(Request $request){

     //   dd($request->all());

        if ($request->has('subject')){
            $subject=$request->subject;
        }else{
            $subject="";
         
        }
        //Validations

     //   dd($request->all());

        $validation=$request->validate([
            'teaching_load'=>'required',
           // 'subject'=>'required',
            'assessement_type'=>'required',
            'assessement_title'=>'required',
            'lesson_topic'=>'required',
            'assignment_due_date'=>'required',
            'timed_status'=>'required',
            'teacher_id'=>'required',
            

        ]);

     //   dd($request->assessement_title);
        AssessementOnline::create([
			'teacher_id' => $request->teacher_id,
			'assessement_type' =>$request->assessement_type,
			'assessement_title' =>$request->assessement_title,
			'lesson_topic'=>$request->lesson_topic,
            'due_date' => $request->assignment_due_date,
            'teaching_load_id'=>$request->teaching_load,
            'subject_id' => $subject,
		]);


		flash()->overlay('Success. You have added assessement', 'Add Assessement');

        //Go to Assessement List
        //with the most recent assessement at the top

		return redirect('/online-learning/assessement/create/without-lesson/');

    }

    public function attach_questions($id){

        //check if assessement belongs to teacher or has been added by the teacher

        $checkTeacher=AssessementOnline::where('teacher_id', Auth::user()->id)->where('id', $id)->exists();
        

        if ($checkTeacher=="true") {
            $assessement=AssessementOnline::find($id);
            $assessement_id=$assessement->id;

            //Get Assessements
            $assessement_details=DB::table('assessement_onlines')
            ->join('assessement_types','assessement_types.id','=','assessement_onlines.assessement_type')
            ->leftjoin('assessement_questions','assessement_questions.assessement_id','=','assessement_onlines.id')
            ->join('teaching_loads','teaching_loads.id','=','assessement_onlines.teaching_load_id')
            ->join('grades','teaching_loads.class_id','=','grades.id')
            ->join('subjects','teaching_loads.subject_id','=','subjects.id')
            ->where('assessement_onlines.id',$assessement_id)
            ->select(DB::raw('count(assessement_questions.assessement_id) as total_questions'),DB::raw('SUM(assessement_questions.mark) as total_marks'), 'grades.grade_name','subjects.subject_name','assessement_types.assessement_type_name', 'assessement_onlines.due_date', 'assessement_onlines.created_at','assessement_onlines.assessement_title', 'assessement_onlines.lesson_topic', 'assessement_onlines.id')
            ->orderBy('assessement_onlines.created_at', 'DESC')
         //   ->groupBy('assessement_onlines.id')
            ->get();

            $question_list=AssessementQuestion::where('assessement_id',$assessement_id)->get();

           

          //  dd($question_list);
            return view('online-learning.assessement-management.attach-questions', compact('assessement_id', 'assessement_details', 'question_list'));
            
        }else{
            return view('errors.unauthorized');
        }


    }

    public function attach_questions_store(Request $request){

        //Validations

        $validation=$request->validate([
            'question_type'=>'required',
            'question'=>'required',
            'answer'=>'required',
            // 'mark'=>'required|numeric|max:100',
            'teacher_id'=>'required',
            'assessement_id'=>'required',
            
        ]);

       

        for($i = 0; $i < count($request->teacher_id); $i++) {
            $short_answer=$request->question_type[$i];
            $question=$request->question[$i];
            $answer=$request->answer[$i];
            $mark=$request->mark[$i];
            $teacher_id=$request->teacher_id[$i];
            $assessement_id=$request->assessement_id[$i];

            $AddQuestion=AssessementQuestion::create([
                'teacher_id'=>$teacher_id,
                'question'=>$question,
                'answer'=>$answer,
                'mark'=>$mark,
                'assessement_id'=>$assessement_id,
    
            ]);
        }

        if (!empty($AddQuestion->id)) {
            flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have successfully added questions', 'Add Question');
            return redirect()->back();
        }else{
            flash()->overlay('<i class="fas fa-times text-danger"></i>Failed. Adding question failed.', 'Add Question');
            return redirect()->back();
        }
    



    

    }

    public function delete_question(Request $request){

        //Authorization

        dd($request->all());
       

    //    AssessementQuestion::find($id)->delete();
       
    
    //    return 'deal';

    }

    public function delete_assessement($id){

        //Check if teacher
        //if authorized teacher delete
        //else return unauthoized

        $checkTeacher=AssessementOnline::where('teacher_id', Auth::user()->id)->where('id',$id)->exists();
        if($checkTeacher){

            $questionsExist=AssessementQuestion::where('assessement_id', $id)->exists();
            if($questionsExist){
                $questionsExist=AssessementQuestion::where('assessement_id', $id)->delete();
                AssessementOnline::where('id', $id)->delete();//delete assessement

                flash()->overlay('<i class="fas fa-check-circle text-success"></i> Data, successfully deleted including questions attached', 'Delete');
                return redirect()->back();
            }else{
                AssessementOnline::where('id', $id)->delete();//delete assessement
                flash()->overlay('<i class="fas fa-check-circle text-success"></i> Data, successfully deleted', 'Delete');
                return redirect()->back();
            }

            
      
           
         
        }else{
            //unauthorized
        }



    }


    public function view_assessement($id){

       //Authorization
       $isTeacher=Auth::user()->hasRole('teacher');

       if ($isTeacher) {
           # code...
    

        

        $assessement=AssessementOnline::find($id);
        $assessement_id=$assessement->id;

        //Get Assessements
        $assessement_details=DB::table('assessement_onlines')
        ->join('assessement_types','assessement_types.id','=','assessement_onlines.assessement_type')
        ->leftjoin('assessement_questions','assessement_questions.assessement_id','=','assessement_onlines.id')
        ->join('teaching_loads','teaching_loads.id','=','assessement_onlines.teaching_load_id')
        ->join('grades','teaching_loads.class_id','=','grades.id')
        ->join('subjects','teaching_loads.subject_id','=','subjects.id')
        ->where('assessement_onlines.id',$assessement_id)
        ->select(DB::raw('count(assessement_questions.assessement_id) as total_questions'),DB::raw('SUM(assessement_questions.mark) as total_marks'), 'grades.grade_name','subjects.subject_name','assessement_types.assessement_type_name', 'assessement_onlines.due_date', 'assessement_onlines.created_at','assessement_onlines.assessement_title', 'assessement_onlines.lesson_topic', 'assessement_onlines.id', 'assessement_onlines.teaching_load_id','assessement_types.id as assessement_type_id' )
        ->orderBy('assessement_onlines.created_at', 'DESC')
        ->first();

      // dd($assessement_details);

        $my_teaching_loads=DB::table('teaching_loads')
        ->join('users','teaching_loads.teacher_id','=','users.id')
        ->join('subjects','teaching_loads.subject_id','=','subjects.id')
        ->join('grades','teaching_loads.class_id','=','grades.id')
        ->where('teaching_loads.teacher_id', Auth::user()->id )
        ->select('subject_name','grade_name', 'name', 'teaching_loads.id', 'teaching_loads.subject_id', 'teaching_loads.teacher_id')
        ->orderBy('grades.grade_name', 'ASC')
        ->get();

    

        return view('online-learning.assessement-management.edit-assignment', compact('assessement_details', 'my_teaching_loads'));

    }

}

    public function update_assessement(Request $request){

    $update=AssessementOnline::where('id',$request->id)->update([
    'teaching_load_id'=>$request->teaching_load,
    'due_date'=>$request->assignment_due_date,
    'assessement_title'=>$request->assessement_title,
    'lesson_topic'=>$request->lesson_topic,
    ]);

    flash()->overlay(' <i class="fas fa-check-circle text-success"></i> Success. You have successfully updated', 'Update Assessement');
    
    return Redirect::back();

    }

    public function edit_assessement($id){

           //Check if teacher
        //if authorized teacher delete
        //else return unauthoized

        $checkTeacher=AssessementOnline::where('teacher_id', Auth::user()->id)->where('id',$id)->exists();
        if($checkTeacher){
            try {
                $update=AssessementOnline::where('id',$id)->update([
                    // 'name'=>$request->first_name,
                    // 'middlename'=>$request->middle_name,
                    // 'lastname'=>$request->last_name,
                    // 'national_id'=>$request->national_id,
                    // 'date_of_birth'=>$request->date_of_birth,
                    // 'gender'=>$request->gender, 
                    // 'email'=>$request->email,
                    // 'cell_number'=>$request->cell
                ]);
    
        //flash()->overlay(' <i class="fas fa-check-circle text-success"></i> Success. You have successfully updated '.$request->first_name."'".'s profile data', 'Update Teacher');
    
                return Redirect::back();
    
              } catch (\Illuminate\Database\QueryException $e){
                $errorCode = $e->getCode();
                if($errorCode == 23000){
                    flash()->overlay('<i class="fas fa-exclamation-triangle text-danger"></i> Error. Duplicate Entry', 'Update Teacher');
    
                    return Redirect::back();
    
    
                }
              }
           
         
        }else{
            //return 

            return view('errors.unauthorized');
        }

    }

   
}