<?php

namespace App\Traits;

use App\Models\Mark;
use App\Models\Grade;
use App\Models\School;
use App\Models\Stream;
use App\Models\Subject;
use App\Models\PassRate;
use App\Models\Assessement;
use App\Models\StudentLoad;
use App\Models\TermAverage;
use Illuminate\Http\Request;
use App\Models\AssessementWeight;
use Illuminate\Support\Facades\DB;
use App\Models\StudentSubjectAverage;
use App\Models\AssessementProgressReport;

 /**
     * @param Request $request
     * @return $this|false|string
     */
  //  $stream = $request->stream;

trait InsightsTrait
{

  
        public function termCalculations(Request $request){
     
    }



    public function assessementCalculations($stream, $session, $assessement_id, $outcome){

     

      $section=Grade::where('stream_id', $stream)->first();

      $assessement_id=$assessement_id;
      $section_id=$section->section_id;
      
      //Get pass_rate
      $criteria=PassRate::where('section_id', $section_id)->first();
         
      //Pass rate variables
      $pass_rate=$criteria->passing_rate;
      $number_of_subjects=$criteria->number_of_subjects;
      $passing_subject_rule=$criteria->passing_subject_rule;
      $term_average_rule=$criteria->average_calculation; //average calculation
      $subject_average_rule=$criteria->subject_average_calculation; //subject average calculation
      $term_average_type=$criteria->term_average_type;//average type
      $number_of_decimal_places=$criteria->number_of_decimal_places;// number of decimal places
      $tie_type=$criteria->tie_type;// number of decimal places
      $school=School::first();
      
      
      
      
      $subject=Subject::where('subject_type','passing_subject')->first();
      $passing_subject=$subject->id;
      
      $non_contributing=Subject::where('subject_type','non-value')->first();
      if(is_null($non_contributing)){
      
          $non_contributing_subject="0";
          
      }else{
          $non_contributing_subject=$non_contributing->id;
      }
      
      
      
      
      $stream_is=Stream::where('id',$stream)->first();
      $stream_title=$stream_is->stream_name;


     
      
      $getAssessement=Assessement::find($assessement_id);
      $assessement_name=$getAssessement->assessement_name;

       //Stream Based Scoresheet


      
        
        //get students
        $students = DB::table('grades_students')
        ->join('users', 'grades_students.student_id', '=', 'users.id')
        ->join('grades', 'grades_students.grade_id', '=', 'grades.id')
        ->where('grades.stream_id', $stream)
        ->where('grades_students.active', 1)
        ->get()->pluck('student_id');
        if($term_average_type=="decimal"){
          $avg_calculation="ROUND(SUM(t.mark) /".$number_of_subjects.", $number_of_decimal_places )";

        }else{
          $avg_calculation="ROUND(SUM(t.mark) /".$number_of_subjects." )";
        }
      
      $student_average = [];
      foreach ($students as $student ) {
     
        if($criteria->average_calculation=="custom" ){


          if($term_average_type=="decimal"){
              $avg_calculation="ROUND(SUM(t.mark) /".$number_of_subjects.", $number_of_decimal_places )";
      
            }else{
              $avg_calculation="ROUND(SUM(t.mark) /".$number_of_subjects." )";
            }
      
      
       //if Passing subject rule applies 
             if($criteria->passing_subject_rule=="1"){
      
              //Student AVERAGE
              $student_average[]=DB::select(DB::raw("SELECT student_id, ".$avg_calculation." as average_mark ,grade_id, term_id.term, section_id,stream_id,assessement_type, nps.number_of_passed_subjects, prm.passing_subject_status,lmr.marks_count, lmr.loads_count   from 
      
              (select marks.student_id,grades.id as grade_id, grades.stream_id, grades.section_id, ROUND(AVG(mark))  as mark  from marks 
              INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id
              INNER JOIN student_loads ON student_loads.teaching_load_id=marks.teaching_load_id
              INNER JOIN subjects ON subjects.id=teaching_loads.subject_id
              INNER JOIN grades ON grades.id=teaching_loads.class_id
              where marks.student_id = ".$student." AND marks.assessement_id=".$assessement_id." AND subject_id <> ".$non_contributing_subject." AND student_loads.active=1 AND marks.active=1 
              GROUP BY subject_id
              order by (subject_id =".$passing_subject.") desc, mark desc
                          LIMIT ".$number_of_subjects.") t, 
                          (SELECT count(marks.mark) as number_of_passed_subjects FROM marks INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id INNER JOIN student_loads ON student_loads.teaching_load_id=marks.teaching_load_id INNER JOIN subjects ON subjects.id=teaching_loads.subject_id WHERE  marks.student_id = ".$student." AND marks.assessement_id=".$assessement_id."  AND marks.mark>=".$pass_rate." AND subject_id <> ".$non_contributing_subject." AND student_loads.active=1 AND marks.active=1  order by  mark desc
                         ) nps, 
                         (SELECT COUNT(marks.mark) as passing_subject_status FROM marks INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id INNER JOIN subjects ON subjects.id = teaching_loads.subject_id WHERE marks.student_id = ".$student." AND marks.assessement_id = ".$assessement_id."  AND marks.mark>=".$pass_rate." AND subject_id=".$passing_subject." ) prm,
      
                         (SELECT (SELECT COUNT(*) from marks  where marks.student_id=".$student." AND  marks.assessement_id=".$assessement_id." AND marks.active=1  ) as marks_count, (SELECT COUNT(*) from student_loads  where student_loads.student_id=".$student." AND student_loads.active=1  ) as loads_count
                         )lmr,
                         
                         (SELECT DISTINCT(assessements.term_id) as term, assessements.assessement_type from marks INNER JOIN assessements ON assessements.id=marks.assessement_id WHERE assessements.id=".$assessement_id.") term_id
                   
                         
               ORDER BY round((SUM(t.mark))/".$number_of_subjects.") DESC"));
      
                  
      
              }else if($criteria->passing_subject_rule=="0"){

                
                  
      
      
                  // dd()
      
                  $student_average[]=DB::select(DB::raw("SELECT student_id, ".$avg_calculation." as average_mark  ,grade_id,assessement_type, term_id.term, section_id,stream_id, nps.number_of_passed_subjects, prm.passing_subject_status,lmr.marks_count, lmr.loads_count  from 
      
                  (select marks.student_id,grades.id as grade_id, grades.stream_id, grades.section_id, ROUND(AVG(mark))  as mark  from marks 
                                  INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id
                                  INNER JOIN subjects ON subjects.id=teaching_loads.subject_id
                                  INNER JOIN grades ON grades.id=teaching_loads.class_id
                                  INNER JOIN student_loads ON student_loads.teaching_load_id=marks.teaching_load_id
                                  where marks.student_id = ".$student." AND marks.assessement_id=".$assessement_id."  AND subject_id <> ".$non_contributing_subject." AND student_loads.active=1
                              GROUP BY subject_id
                              order by  mark desc
                              LIMIT ".$number_of_subjects.") t, 
                              (SELECT count(marks.mark) as number_of_passed_subjects FROM marks INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id  INNER JOIN subjects ON subjects.id=teaching_loads.subject_id  INNER JOIN student_loads ON student_loads.teaching_load_id=marks.teaching_load_id WHERE  marks.student_id = ".$student." AND marks.assessement_id=".$assessement_id." AND subject_id <> ".$non_contributing_subject." AND marks.mark>=".$pass_rate." AND student_loads.active=1 AND marks.active=1  ORDER BY  mark desc
                             ) nps, 
                             (SELECT COUNT(marks.mark) as passing_subject_status FROM marks INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id INNER JOIN subjects ON subjects.id = teaching_loads.subject_id WHERE marks.student_id = ".$student." AND marks.assessement_id = ".$assessement_id." AND marks.mark>=".$pass_rate." AND subject_id=".$passing_subject." ) prm,
      
                             (SELECT (SELECT COUNT(*) from marks where marks.student_id=".$student." AND marks.assessement_id=".$assessement_id."  AND marks.active=1 ) as marks_count, (SELECT COUNT(*) from student_loads  where student_loads.student_id=".$student." AND student_loads.active=1 ) as loads_count
                             )lmr,
                             
                             (SELECT DISTINCT(assessements.term_id) as term, assessements.assessement_type from marks INNER JOIN assessements ON assessements.id=marks.assessement_id WHERE assessements.id=".$assessement_id.") term_id
                       
                             
                   ORDER BY round((SUM(t.mark))/".$number_of_subjects.") DESC"));
      
              }
             
        
      }else if($criteria->average_calculation=="default"){
      
        //  $total_subjects=StudentLoad::where('student_id', $student)->count();
          // $total_subjects = DB::table('student_loads')
          // ->join('teaching_loads', 'teaching_loads.id', '=', 'student_loads.teaching_load_id')
          // ->where('student_id', $student)
          // ->where('teaching_loads.active', 1)
          // ->count();
      
          $total_subjects = DB::table('student_loads')
          ->join('teaching_loads', 'student_loads.teaching_load_id', '=', 'teaching_loads.id')
          ->join('academic_sessions', 'academic_sessions.id', '=', 'teaching_loads.session_id')
          ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
          ->where('teaching_loads.active', 1)
          ->where('student_loads.student_id', $student)
          ->where('student_loads.active', 1)
          ->where('subjects.subject_type','<>', 'non-value')
          ->where('academic_sessions.active', 1)//Scoping to active academic year. 
          ->get()->count();
          
      
          $total_marks = DB::table('marks')
          ->join('teaching_loads', 'marks.teaching_load_id', '=', 'teaching_loads.id')
          ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
          ->join('student_loads', 'student_loads.teaching_load_id', '=', 'teaching_loads.id')
          ->where('marks.student_id', $student)
          ->where('assessement_id', $assessement_id)
          ->where('student_loads.active', 1)
          ->where('subjects.subject_type','<>', 'non-value')
          ->get()->count();
        
          $total_marks=Mark::where('student_id', $student)->where('assessement_id', $assessement_id)->count();
      
          if($total_marks>$total_subjects){
              //More marks than teaching loads
              //->Probably deleted loads & left mark
      
              $loads=DB::select(DB::raw(" SELECT teaching_load_id  FROM marks  WHERE teaching_load_id NOT IN (SELECT student_loads.teaching_load_id FROM student_loads WHERE student_id=".$student." AND student_loads.active=1) AND student_id=".$student.""));
      
              
              if(!is_null($loads)){
                  foreach($loads as $load){
          
                      $insert_load = StudentLoad::create([
                          'student_id'=>$student,
                          'teaching_load_id'=>$load->teaching_load_id,
                  
                              ]);
                  
                  }
      
              }
                 
      
          }
        //  $avg_calculation="ROUND(SUM(t.mark) /".$number_of_subjects.", $number_of_decimal_places )";
      
        if($term_average_type=="decimal"){
          $avg_calculation="ROUND(SUM(t.mark) /".$total_subjects.", $number_of_decimal_places )";
      
        }else{
          $avg_calculation="ROUND(SUM(t.mark) /".$total_subjects." )";
        }
          //$student_average[]=DB::select(DB::raw("SELECT student_id,".$avg_calculation."  AS average_mark, 
        
          $student_average[]=DB::select(DB::raw("SELECT student_id, ".$avg_calculation." as average_mark ,grade_id, term_id.term,assessement_type, section_id,stream_id, nps.number_of_passed_subjects, prm.passing_subject_status,lmr.marks_count, lmr.loads_count  from 
          (select marks.student_id,grades.id as grade_id, grades.stream_id, grades.section_id, marks.mark  as mark  from marks 
      INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id
      INNER JOIN student_loads ON student_loads.teaching_load_id=marks.teaching_load_id
      INNER JOIN subjects ON subjects.id=teaching_loads.subject_id
      INNER JOIN grades ON grades.id=teaching_loads.class_id
      where marks.student_id =".$student." AND marks.assessement_id=".$assessement_id." AND subject_id <> ".$non_contributing_subject." AND student_loads.active=1 AND marks.active=1
                GROUP BY marks.id 
              ) t, 
                    (SELECT count(marks.mark) as number_of_passed_subjects FROM marks INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id  INNER JOIN subjects ON subjects.id=teaching_loads.subject_id INNER JOIN student_loads ON student_loads.teaching_load_id=marks.teaching_load_id WHERE  marks.student_id = ".$student."  AND marks.assessement_id=".$assessement_id."  AND marks.mark>=".$pass_rate." AND subject_id <> ".$non_contributing_subject." AND student_loads.active=1  AND marks.active=1 order by  mark desc
                   ) nps, 
                   (SELECT COUNT(marks.mark) as passing_subject_status FROM marks INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id INNER JOIN subjects ON subjects.id = teaching_loads.subject_id WHERE marks.student_id =".$student."  AND marks.assessement_id =".$assessement_id." AND marks.mark>=".$pass_rate."  AND subject_id=".$passing_subject.") prm,
      
                   (SELECT (SELECT COUNT(*) from marks  where marks.student_id=".$student." and marks.assessement_id=".$assessement_id." AND marks.active=1) as marks_count, (SELECT COUNT(*) from student_loads INNER JOIN teaching_loads ON teaching_loads.id=student_loads.teaching_load_id  where student_loads.student_id=".$student." AND teaching_loads.active=1 and student_loads.active=1 ) as loads_count
                   )lmr,
                
                   (SELECT DISTINCT(assessements.term_id) as term, assessements.assessement_type from marks INNER JOIN assessements ON assessements.id=marks.assessement_id WHERE assessements.id=".$assessement_id." ) term_id"));
      
        
      }
      
   
      
      
      
        }
        //End of foreach loop
      
      
      //upserting data into database
      $insert=AssessementProgressReport::upsert(collect($student_average)->map(function($item) use($assessement_id) {
      
          
          return [
           
              'assessement_id'=>$assessement_id,
              'student_id'=>$item['0']->student_id,
              'student_average'=>$item['0']->average_mark,
              'student_class'=>$item['0']->grade_id,
              'term_id'=>$item['0']->term,
              'assessement_type'=>$item['0']->assessement_type,
              'student_section'=>$item['0']->section_id,
              'student_stream'=>$item['0']->stream_id,
              'number_of_passed_subjects'=>$item['0']->number_of_passed_subjects,
              'passing_subject_status'=>$item['0']->passing_subject_status,
              'loads_count'=>$item['0']->loads_count,
              'marks_count'=>$item['0']->marks_count,
              'assessement_report_key'=>$item['0']->student_id.'-'.$item['0']->term.'-'.$assessement_id,
          ];
        })->toArray(), ['assessement_report_key'], ['student_average','number_of_passed_subjects', 'passing_subject_status' , 'loads_count', 'marks_count']);
      
return $report=["pass_rate"=>$pass_rate,  "students"=>$students, 'loads_count'=>$total_subjects, 'assessement'=>$assessement_name, 'term_average_type'=>$term_average_type, 'number_of_decimal_places'=>$number_of_decimal_places, 'tie_type'=>$tie_type,'passing_subject_rule'=>$passing_subject_rule, 'number_of_subjects'=>$number_of_subjects, 'assessement_id'=>$assessement_id, 'assessement_name'=>$assessement_name,
];




if($outcome=="scoresheet"){
//if scoresheet 

//1. Check if it is an assessement based scoresheet or it is a term based scoresheet

//if it is a assessement based scoresheet
 

}

if($outcome=="report_card"){
  dd('report card blade');
  }

  if($outcome=="performance_analysis"){
    dd('performance analysis');
    }


        
    }




}



?>