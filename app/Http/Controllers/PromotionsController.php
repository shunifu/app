<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Models\School;
use App\Models\TermAverage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PromotionsController extends Controller
{
    public function promote(Request $request){

       
        $student_list=$request->students;
        $term=$request->term;
        $number_of_subjects=$request->number_of_subjects;
        $pass_rate=$request->pass_rate;
        $stream=$request->stream;
        $passing_subject_rule=$request->passing_subject_rule;

        $school_is=School::first();
      

      if($school_is->school_code=='0387'){
          if($stream==1){
            $number_of_subjects=6;
          }else{
            $number_of_subjects=$request->number_of_subjects;
          }
      }else{
        $number_of_subjects=$request->number_of_subjects;
      }


        

      
      
     //   $terms=Term::where('final_term', '1')->first();

   
     if($request->action=="promote"){

    
        // if(count($student_list)==0){
        //     flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have promoted Students', 'Promote Students');
        // }

        for($i = 0; $i <count($student_list); $i++) {

            $addTeachingLoads=TermAverage::where('student_id', $student_list[$i])->where('term_id', $term)
            ->update(['final_term_status'=>'Promoted']);
        
         }

         if($passing_subject_rule==1){
            $getPassed=TermAverage::where('term_id', $term)->where('number_of_passed_subjects','>=', $number_of_subjects)->where('passing_subject_status', 1)->where('student_average','>=',$pass_rate)->where('student_stream',$stream)->update([
                'final_term_status'=>'Proceed'
            ]);
         }else{
            $getPassed=TermAverage::where('term_id', $term)->where('number_of_passed_subjects','>=', $number_of_subjects)->where('student_average','>=',$pass_rate)->where('student_stream',$stream)->update([
                'final_term_status'=>'Proceed'
            ]);
         }
       
        
        $repeat=TermAverage::where('term_id', $term)->where('student_stream',$stream)->WhereNull('final_term_status' )->update([
            'final_term_status'=>'Repeat'
        ]);
    flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You have promoted Students', 'Promote Students');
    return redirect('/report/term-based/');
         

     
    }else if($request->action=="another_school"){

        for($i = 0; $i <count($student_list); $i++) {

            $findAnother=TermAverage::where('student_id', $student_list[$i])->where('term_id', $term)
            ->update(['final_term_status'=>'Try Another School']);
        
         }

         if($passing_subject_rule==1){
            $getPassed=TermAverage::where('term_id', $term)->where('number_of_passed_subjects','>=', $number_of_subjects)->where('passing_subject_status', 1)->where('student_average','>=',$pass_rate)->where('student_stream',$stream)->update([
                'final_term_status'=>'Proceed'
            ]);
         }else{
            $getPassed=TermAverage::where('term_id', $term)->where('number_of_passed_subjects','>=', $number_of_subjects)->where('student_average','>=',$pass_rate)->where('student_stream',$stream)->update([
                'final_term_status'=>'Proceed'
            ]);
         }
        
        $repeat=TermAverage::where('term_id', $term)->where('student_stream',$stream)->WhereNull('final_term_status' )->update([
            'final_term_status'=>'Repeat'
        ]);
        
  
    flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You updated resolution', 'Resolution');
    return redirect('/report/term-based/');

    }else if($request->action=="repeat"){

        for($i = 0; $i <count($student_list); $i++) {

            $findAnother=TermAverage::where('student_id', $student_list[$i])->where('term_id', $term)
            ->update(['final_term_status'=>'Repeat']);
        
         }

         if($passing_subject_rule==1){
            $getPassed=TermAverage::where('term_id', $term)->where('number_of_passed_subjects','>=', $number_of_subjects)->where('passing_subject_status', 1)->where('student_average','>=',$pass_rate)->where('student_stream',$stream)->update([
                'final_term_status'=>'Proceed'
            ]);
         }else{
            $getPassed=TermAverage::where('term_id', $term)->where('number_of_passed_subjects','>=', $number_of_subjects)->where('student_average','>=',$pass_rate)->where('student_stream',$stream)->update([
                'final_term_status'=>'Proceed'
            ]);
         }
        
        $repeat=TermAverage::where('term_id', $term)->where('student_stream',$stream)->WhereNull('final_term_status' )->update([
            'final_term_status'=>'Repeat'
        ]);
        
  
    flash()->overlay('<i class="fas fa-check-circle text-success"></i> Success. You updated resolution', 'Resolution');
    return redirect('/report/term-based/');

    }
}

    // public function recind_promotion(Request $request){

       
    //     $student_list=$request->students;
    //     $term=$request->term;
    //     $number_of_subjects=$request->number_of_subjects;
    //     $pass_rate=$request->pass_rate;
    //     $stream=$request->stream;

      
        
    //  //   $terms=Term::where('final_term', '1')->first();

   

    //     for($i = 0; $i <count($student_list); $i++) {

    //         $addTeachingLoads=TermAverage::where('student_id', $student_list[$i])->where('term_id', $term)
    //         ->update(['final_term_status'=>'Promoted']);
        
    //      }

    //      $getPassed=TermAverage::where('term_id', $term)->where('number_of_passed_subjects','>=', $number_of_subjects)->where('passing_subject_status', 1)->where('student_average','>=',$pass_rate)->where('student_stream',$stream)->update([
    //         'final_term_status'=>'Proceed'
    //     ]);


    //     return Redirect::back();
         

     
    // }
}