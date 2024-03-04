<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicSession;
use App\Models\Assessement;
use App\Models\AssessementProgressReport;
use App\Models\AssessementWeight;
use App\Models\CA_Exam;
use App\Models\StudentSubjectAverage;
use App\Models\Term;
use App\Models\TermAverage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TermController extends Controller
{
    public function index($id){

        $academic_session=AcademicSession::find($id);


        $terms=DB::table('terms')
        ->join('academic_sessions','academic_sessions.id','=','terms.academic_session')
        ->where('academic_sessions.id', $id )
        ->select('terms.id as term_id', 'terms.term_name', 'terms.start_date','terms.end_date','terms.borders_return_date','terms.academic_session','terms.final_term','terms.next_term_date','academic_sessions.*')
        ->get();


        return view('academic-admin.academic-session-management.terms.index', compact('academic_session', 'terms'));

    }


    public function create(){

    }

    public function store(Request $request){

//Validations
$validation=$request->validate([
    'academic_session'=>'required',
    'term_name'=>'required',
    'start_date'=>'required|date',
    'end_date'=>'required|date',
]);

//rules

///1. Cannot have the same dates on the same year


// if(isset($request->final_term)){
//     Term::where('term_name')
//     $final=1;

// }else{
//     $final=0;
// }



$term = Term::create([
    'term_name' => $request->term_name,
    'academic_session' => $request->academic_session,
    'start_date'=>$request->start_date,
    'end_date'=>$request->end_date
    // 'final_term'=>$final,
    ]);


if(isset($request->final_term)){
$reset=Term::where('final_term',1)->where('academic_session',$request->academic_session)->update([
    'final_term'=>0
]);
$update=Term::where('term_name',$request->term_name)->where('academic_session',$request->academic_session)->update([
    'final_term'=>1
]);
}
flash()->overlay('<i class="fas fa-check-circle text-success"></i>'.' Congratulations. You have successfully added term.', 'Add Term ');

return Redirect::back();


    }

    public function edit($id){

        $term_id=decrypt($id);



        $term=Term::find($term_id);
     return view('academic-admin.academic-session-management.terms.edit', compact('term'));



    }

    public function update(Request $request){

    // dd($request->all());

if(isset($request->final_term)){

//Reset the final term status for that academic year
$reset=Term::where('final_term',1)->where('academic_session',$request->academic_session)->update([
    "final_term"=>NULL,
]);

$final_term=1;

}else{
    $final_term=0;
}



        $update=Term::where('id',$request->term_id)->update([
            "term_name"=>$request->term_name,
            "start_date"=>$request->opening_date,
            "end_date"=>$request->closing_date,
            "final_term"=>$final_term,
            "borders_return_date"=>$request->borders_return_date,
            "next_term_date"=>$request->next_term_date,

        ]);



     if($update){
        flash()->overlay('<i class="fas fa-check-circle text-success"></i>'.' Success . Term has been successfully updated', 'Update Term ');
        return redirect('/view/terms/'.$request->academic_session);
     }

    }

    public function destroy(Request $request){
        $term=$request->id;

        $term_id=decrypt($term);



        //Checks

        //1. Check if the terms has been assigned assessments
        $existsInAssessements=Assessement::where('term_id', $term_id)->exists();

        //2. Check if the terms has been assigned in ca_exams
        $existsInCa_Exams=CA_Exam::where('term_id', $term_id)->exists();

        //3. Check if the terms has been assigned in assessement_progress_reports
        $existsInAssessementsProgressReport=AssessementProgressReport::where('term_id', $term_id)->exists();

        //4. Check if the terms has been assigned in assessement_weights
        $existsInAssessementsWeights=AssessementWeight::where('term_id', $term_id)->exists();

        //5. Check if the terms has been assigned in term_averages
        $existsInTermAverages=TermAverage::where('term_id', $term_id)->exists();


       // dd($existsInTermAverages);

        //6. Check if the terms has been assigned in stream_subject_averages
    //    $existsInStreamSubjectAverages=DB::('stream_subject_averages')::where('term_id', $term)->exists();
// DB::select('select * from stream_subject_averages where term_id='.$term)->exists();

        //7. Check if the terms has been assigned in student_subject_averages

$existsInStudentSubjectAverages=StudentSubjectAverage::where('term_id', $term_id)->exists();

if ($existsInAssessements || $existsInCa_Exams || $existsInAssessementsProgressReport || $existsInAssessementsWeights || $existsInTermAverages ) {

    flash()->overlay('<i class="fas fa-exclamation-circle  text-danger"></i>'.' Sorry.Cannot delete term as it is already assigned in assessements', 'Delete Term ');

    return Redirect::back();



}else{


    $TermExists=Term::where('id', $term_id)->exists();

    if($TermExists){
        Term::where('id', $term_id)->delete();
        flash()->overlay('<i class="fas fa-check-circle text-success"></i>'.' Success . Term has been successfully deleted', 'Delete Term ');
        return Redirect::back();
    }






}

    }
}
