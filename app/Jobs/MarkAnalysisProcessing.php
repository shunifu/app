<?php

namespace App\Jobs;

use App\Models\Mark;
use App\Models\Grade;
use App\Models\Stream;
use App\Models\Subject;
use App\Models\PassRate;
use App\Models\StudentLoad;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\AssessementProgressReport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class MarkAnalysisProcessing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        $section=Grade::where('stream_id', 1)->first();

$assessement_id=1;
$section_id=2;

//Get pass_rate
$criteria=PassRate::where('section_id', $section_id)->first();
   
//Pass rate variables
$pass_rate=$criteria->passing_rate;
$number_of_subjects=5;
$passing_subject_rule=1;

$subject=Subject::where('subject_type','passing_subject')->first();
$passing_subject=2;

$stream_is=Stream::where('id',1)->first();
$stream_title='form 1';



  
  //get students
  $students = DB::table('grades_students')
  ->join('users', 'grades_students.student_id', '=', 'users.id')
  ->join('grades', 'grades_students.grade_id', '=', 'grades.id')
  ->where('grades.stream_id', 1)
  ->get()->pluck('student_id');


$student_average = [];
foreach ($students as $student ) {
//Generate Assessement Values

if($criteria->average_calculation=="custom" ){

 //if Passing subject rule applies 
       if($criteria->passing_subject_rule=="1"){

        //Student AVERAGE
        $student_average[]=DB::select(DB::raw("SELECT student_id, round((SUM(t.mark))/".$number_of_subjects.") average_mark ,grade_id, term_id.term, section_id,stream_id,assessement_type, nps.number_of_passed_subjects, prm.passing_subject_status from 

        (select marks.student_id,grades.id as grade_id, grades.stream_id, grades.section_id, ROUND(AVG(mark))  as mark  from marks 
                        INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id
                        INNER JOIN subjects ON subjects.id=teaching_loads.subject_id
                        INNER JOIN grades ON grades.id=teaching_loads.class_id
                        where marks.student_id = ".$student." AND marks.assessement_id=".$assessement_id." 
                    GROUP BY subject_id
                    order by (subject_id =".$passing_subject.") desc, mark desc
                    LIMIT ".$number_of_subjects.") t, 
                    (SELECT count(marks.mark) as number_of_passed_subjects FROM marks INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id  INNER JOIN subjects ON 				subjects.id=teaching_loads.subject_id WHERE  marks.student_id = ".$student." AND marks.assessement_id=".$assessement_id."  AND marks.mark>=".$pass_rate." order by  mark desc
                   ) nps, 
                   (SELECT COUNT(marks.mark) as passing_subject_status FROM marks INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id INNER JOIN subjects ON subjects.id = teaching_loads.subject_id WHERE marks.student_id = ".$student." AND marks.assessement_id = ".$assessement_id."  AND marks.mark>=".$pass_rate." AND subject_id=".$passing_subject." ) prm,
                   
                   (SELECT DISTINCT(assessements.term_id) as term, assessements.assessement_type from marks INNER JOIN assessements ON assessements.id=marks.assessement_id WHERE assessements.id=".$assessement_id.") term_id
             
                   
         ORDER BY round((SUM(t.mark))/".$number_of_subjects.") DESC"));

            

        }else if($criteria->passing_subject_rule=="0"){
            

            $student_average[]=DB::select(DB::raw("SELECT student_id, round((SUM(t.mark))/".$number_of_subjects.")  average_mark ,grade_id,assessement_type, term_id.term, section_id,stream_id, nps.number_of_passed_subjects, prm.passing_subject_status from 

            (select marks.student_id,grades.id as grade_id, grades.stream_id, grades.section_id, ROUND(AVG(mark))  as mark  from marks 
                            INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id
                            INNER JOIN subjects ON subjects.id=teaching_loads.subject_id
                            INNER JOIN grades ON grades.id=teaching_loads.class_id
                            where marks.student_id = ".$student." AND marks.assessement_id=".$assessement_id." 
                        GROUP BY subject_id
                        order by  mark desc
                        LIMIT ".$number_of_subjects.") t, 
                        (SELECT count(marks.mark) as number_of_passed_subjects FROM marks INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id  INNER JOIN subjects ON 				subjects.id=teaching_loads.subject_id WHERE  marks.student_id = ".$student." AND marks.assessement_id=".$assessement_id." AND marks.mark>=".$pass_rate." order by  mark desc
                       ) nps, 
                       (SELECT COUNT(marks.mark) as passing_subject_status FROM marks INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id INNER JOIN subjects ON subjects.id = teaching_loads.subject_id WHERE marks.student_id = ".$student." AND marks.assessement_id = ".$assessement_id." AND marks.mark>=".$pass_rate." AND subject_id=".$passing_subject." ) prm,
                       
                       (SELECT DISTINCT(assessements.term_id) as term, assessements.assessement_type from marks INNER JOIN assessements ON assessements.id=marks.assessement_id WHERE assessements.id=".$assessement_id.") term_id
                 
                       
             ORDER BY round((SUM(t.mark))/".$number_of_subjects.") DESC"));

        }
       
  
}else if($criteria->average_calculation=="default"){

    $total_subjects=StudentLoad::where('student_id', $student)->count();
  
    $total_marks=Mark::where('student_id', $student)->where('assessement_id', $assessement_id)->count();

    // if($total_marks>$total_subjects){
    //     //More marks than teaching loads
    //     //->Probably deleted loads & left mark

    //     $loads=DB::select(DB::raw(" SELECT teaching_load_id  FROM marks  WHERE teaching_load_id NOT IN (SELECT student_loads.teaching_load_id FROM student_loads WHERE student_id=".$student.") AND student_id=".$student.""));

        
    //     if(is_null($loads)){
        
    //     }else{
    //         foreach($loads as $load){
    
    //             $insert_load = StudentLoad::create([
    //                 'student_id'=>$student,
    //                 'teaching_load_id'=>$load->teaching_load_id,
            
    //                     ]);
            
    //         }

    //     }
           

    // }

    // if($total_subjects>$total_marks){
    //     //More teaching loads assigned than the marks 
    //     //Redundant loads


    // }

  
    $student_average[]=DB::select(DB::raw("SELECT student_id, round(SUM(t.mark)/".$total_subjects.") as average_mark ,grade_id, term_id.term,assessement_type, section_id,stream_id, nps.number_of_passed_subjects, prm.passing_subject_status from 
    (select marks.student_id,grades.id as grade_id, grades.stream_id, grades.section_id, marks.mark  as mark  from marks 
INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id
INNER JOIN subjects ON subjects.id=teaching_loads.subject_id
INNER JOIN grades ON grades.id=teaching_loads.class_id
where marks.student_id =".$student." AND marks.assessement_id=".$assessement_id." 
          GROUP BY marks.id 
        ) t, 
              (SELECT count(marks.mark) as number_of_passed_subjects FROM marks INNER JOIN teaching_loads ON teaching_loads.id=marks.teaching_load_id  INNER JOIN subjects ON subjects.id=teaching_loads.subject_id WHERE  marks.student_id = ".$student."  AND marks.assessement_id=".$assessement_id."  AND marks.mark>=".$pass_rate."  order by  mark desc
             ) nps, 
             (SELECT COUNT(marks.mark) as passing_subject_status FROM marks INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id INNER JOIN subjects ON subjects.id = teaching_loads.subject_id WHERE marks.student_id =".$student."  AND marks.assessement_id =".$assessement_id." AND marks.mark>=".$pass_rate."  AND subject_id=".$passing_subject.") prm,
          
             (SELECT DISTINCT(assessements.term_id) as term, assessements.assessement_type from marks INNER JOIN assessements ON assessements.id=marks.assessement_id WHERE assessements.id=".$assessement_id." ) term_id"));

    
}


  }
  //End of foreach loop


//use upsert  

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
        'assessement_report_key'=>$item['0']->student_id.'-'.$item['0']->term.'-'.$assessement_id,
    ];
  })->toArray(), ['assessement_report_key'], ['student_average','number_of_passed_subjects', 'passing_subject_status']);



return 'done';
    }
}
