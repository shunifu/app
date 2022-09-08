<x-app-layout>
    <x-slot name="header">
        <style type="text/css">
            i {
            margin-right: 5px;
            }


            .table {
  border: 0.5px solid{{$column_color}};
}
.table-bordered > thead > tr > th,
.table-bordered > tbody > tr > th,
.table-bordered > tfoot > tr > th,
.table-bordered > thead > tr > td,
.table-bordered > tbody > tr > td,
.table-bordered > tfoot > tr > td {
   border: 0.3px solid {{$column_color}};
}

            
textarea.form-control
{  
width: 100%;
height: 100%;
border-color: Transparent;     
text-align: justify;
}

/* col{
    vertical-align: middle;
} */
          input,select{
            color:black;
            }
            #img{
            width: 100px;
            height:auto;
            }
            th {
            background-color: {{$column_color}};
            color: rgb(255, 255, 255);
            text-align: center;
            } 
            @media print {
            tr {
            
            }}

            
            @media print {
            th.background {
                font-size: 14px;
            background-color: {{$column_color}} !important;
            -webkit-print-color-adjust: exact; 
            color: #FFFFFF !important;
            
            }}

            @media all {
.page-break { display: none; }
}

@media print {
.page-break { display: block; page-break-before: always; }
}
#signaturetitle {
  font-weight: bold;
  text-align: center;
  font-size: 90%;
}

#signature {
  width: 100%;
  border: 0px;
  border-bottom: 1px solid black;
  height: 30px;
}
</style>

<!-- Latest compiled and minified CSS -->


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">




    </x-slot>

<div class="card text-left">

  <div class="card-body no-print">
    <h4 class="card-title">Guidelines On Report Generation. </h4>
    <p class="card-text">

        <div class="lead small"><h4 class="lead"></h4> </div>  
        <div class="text-body text-muted">

        This is where you will view student  reports. Please note that, it it take a few minutes for the report to show.<p>
            {{-- <select class="selectpicker my-select">
                <option>Mustard</option>
                <option>Ketchup</option>
                <option>Barbecue</option>
              </select> --}}
       
        You can Print them out, by clicking the click button. 
        <button class="btn btn-primary" onclick="window.print()" id="print_report">Print</button>
        <button class="btn btn-primary" onclick="goBack();">Go Back</button>
        </div>
    </p>
  </div>
</div>
  

@foreach ($students as $student)

  


<div style="page-break-before: always">
      {{-- {{print_r($item)}} --}}
        <div class="card text-left">
           
            <div class="card-body">
                @foreach (\App\Models\School::all() as $item)
                <div class="mx-auto text-center">
    
              
                <div class="row mx-auto" >
                    
                    <img src="{{$item->school_letter_head }}" width="820"  style="display: block;margin: auto;"/>
                </div>
              
   
                 
                       
                        <hr>
                    
                </div>
               
                @endforeach
<?php
         $term_average=\DB::select(\DB::raw("SELECT
        users.name,
        users.lastname,
        users.middlename,
        term_averages.student_average,
        term_averages.number_of_passed_subjects,
        term_averages.passing_subject_status,
        term_averages.final_term_status,
        terms.term_name,
        terms.start_date,
        terms.end_date,
        grades.grade_name,
        grades.id as grade_id,
        streams.stream_name,
        sections.section_name,
        academic_sessions.academic_session, 
        academic_sessions.id as session_id
       FROM
           term_averages
       INNER JOIN users ON users.id = term_averages.student_id
       INNER JOIN terms ON terms.id = term_averages.term_id
       INNER JOIN grades ON grades.id = term_averages.student_class
       INNER JOIN streams ON streams.id = term_averages.student_stream
       INNER JOIN sections ON sections.id = term_averages.student_section
       INNER JOIN academic_sessions ON academic_sessions.id = terms.academic_session
       WHERE
           term_averages.student_id =".$student." AND term_averages.term_id =".$term.""));

    
            
                    foreach ($term_average as $student_term_data) {
             

echo '<h2 class="text-center lead text-bold">'.$student_term_data->lastname.' '.$student_term_data->middlename.' '.$student_term_data->name."'s".' Report Card</h2>';     
                 
               ?>
               
                          <table class="table table-bordered"> 
                    <thead class="btn-secondary">
                        <tr>
                            <th class="background text-center">Student Details</th>
                            <th class="background text-center">Student Photo</th>
                            <th class="background text-center">Term Details</th>

                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                        <?php


?>
                            Student Name: <span class="text-bold">{{$student_term_data->name}} {{$student_term_data->middlename}} {{$student_term_data->lastname}} </span>
                            <br>
                            Student Average: <span class="text-bold">{{$student_term_data->student_average}}%</span>
                            <br>
                            Student Position: <span class="text-bold">
                               <?php

                               

$classofstudent=$student_term_data->grade_id;




if ($tie_type=="share_n_+_1") {

    if ($p_key=="stream_based") {
       $sql_piece="where term_averages.term_id=".$term." AND term_averages.student_stream=".$stream."";
 } else {
     $sql_piece="where term_averages.term_id=".$term." AND term_averages.student_class=".$classofstudent."";
 }
 
 //    if tie type is share, i.e ties share the same position run the query below



$student_position=\DB::select(\DB::raw("select t.*
from (select term_averages.student_id,term_averages.student_average, rank() over (order by term_averages.student_average desc) as student_position
from term_averages ".$sql_piece.") t
where student_id = ".$student.""));
foreach ($student_position as $key) {
if ($p_key=="stream_based") {
echo $key->student_position.' out of '.$total_students.' ' ;
}else{
echo $key->student_position.' out of '.$total_students.' ';
}

}


}else if ($tie_type=="share") {
//     $student_position=\DB::select(\DB::raw("select t.*
// from (select term_averages.student_id,term_averages.student_average, rank() over (order by term_averages.student_average desc) as student_position
// from term_averages ".$sql_piece.") t
// where student_id = ".$student.""));
// foreach ($student_position as $key) {
// if ($p_key=="stream_based") {
// echo $key->student_position.' out of '.$total_students.' ' ;
// }else{
// echo $key->student_position.' out of '.$total_students.' ';
// }

// }
if ($p_key=="stream_based") {
       $sql_piece="where sc.term_id=".$term." AND sc.student_stream=".$stream."";
 } else {
     $sql_piece="where sc.term_id=".$term." AND sc.student_class=".$classofstudent."";
 }
 

$student_position=\DB::select(\DB::raw("SELECT * FROM (SELECT st.id as student_id,
          sc.student_average,
          CASE 
            WHEN @grade = COALESCE(sc.student_average, 0) THEN @rownum 
            ELSE @rownum := @rownum + 1 
          END AS student_position,
          @grade := COALESCE(sc.student_average, 0) as avg
         
     FROM users st
LEFT JOIN term_averages sc ON sc.student_id = st.id
     JOIN (SELECT @rownum := 0, @grade := NULL) r  
     ".$sql_piece."
 ORDER BY sc.student_average DESC ) as sub
WHERE sub.student_id=".$student.""));
    
}
        

                                ?>
                                 </span>
                            <br>
                           
                            Result: 
                            @if ($passing_subject_rule==1)
                            @if ($student_term_data->student_average>=$pass_rate AND $student_term_data->number_of_passed_subjects>=$number_of_subjects  AND $student_term_data->passing_subject_status==1)
                                
                            <span class="text-success text-bold">Passed</span> <i class="fas fa-check-circle text-success"></i> 
                            
                            @else
                            
                            <span class="text-danger text-bold">Failed</span> 
                                                            <br>
                                                        
                            
                            Why {{ $student_term_data->name }} failed this term:<span class="text-bold"></span>
                            
                            <ul>
                            
                                @if ($student_term_data->student_average<$pass_rate)
                                <li>
                                   Low Average 
                                </li>
                                @endif
                            
                               
                                @if ($student_term_data->number_of_passed_subjects==0)
                                <li>
                                    Failed <span class="text-danger">all</span> subjects
                                 </li>
                            
                                 @endif
                                 @if ($student_term_data->number_of_passed_subjects<$number_of_subjects)
                                 <li>
                                   Passed only <span class="text-danger">{{$student_term_data->number_of_passed_subjects}}</span>
                                   @if ($student_term_data->number_of_passed_subjects==1)
                                   subject
                                       @else
                                       subjects
                                   @endif
                                  
                                </li>
                                @endif
                               
                            @if ($student_term_data->passing_subject_status<1)
                            <li>
                              Failed Passing Subject
                            </li>
                            @endif   
                            
                            </ul>
                            
                            @endif
                            {{-- End of condition within passing subject --}}

                            @else
                            {{-- if passing subject rule is 0 --}}

                            @if ($student_term_data->student_average>=$pass_rate AND $student_term_data->number_of_passed_subjects>=$number_of_subjects )
                                
                            <span class="text-success text-bold">Passed</span> <i class="fas fa-check-circle text-success"></i> 
                            <br>
                            
                            @else
                            
                            <span class="text-danger text-bold">Failed</span> 
                                                            <br>
                                                        
                            
                            Why {{ $student_term_data->name }} failed this term:<span class="text-bold"></span>
                            
                            <ul>
                            
                                @if ($student_term_data->student_average<$pass_rate)
                                <li>
                                   Low Average 
                                </li>
                                @endif
                            
                               
                                @if ($student_term_data->number_of_passed_subjects==0)
                                <li>
                                    Failed <span class="text-danger">all</span> subjects
                                 </li>
                            
                                 @endif
                                 @if ($student_term_data->number_of_passed_subjects<$number_of_subjects)
                                 <li>
                                   Passed only <span class="text-danger">{{$student_term_data->number_of_passed_subjects}}</span>
                                   @if ($student_term_data->number_of_passed_subjects==1)
                                   subject
                                       @else
                                       subjects
                                   @endif
                                  
                                </li>
                                @endif
                               
                            
                            </ul>
                            
                            @endif


                            @endif
<br>
{{-- Resolution: <span class=" text-bold">{{$student_term_data->final_term_status}}  </span> --}}




                        </td>
                                                   
                            
                            
                           
            
                        <td>
                            <center>
                                <img class="user-image img-circle elevation-1" width="200" height="200" src="https://ui-avatars.com/api/?name={{$student_term_data->name}}+&amp;color=7F9CF5&amp;background=EBF4FF" alt={{$student_term_data->name}} />
                                
                               
                            </center>

                        </td>

                        <td>
                            Term: <span class="text-bold">{{$student_term_data->term_name}} {{$student_term_data->academic_session}}</span>
                            <br>
                            Term Opening Date <span class="text-bold">05 April 2022</span>
                            <br>
                            Term Closing Date <span class="text-bold">19 August 2022</span>
                            <br>
                            Next Term Date: <span class="text-bold">7 September 2022</span>

                            
                            <br>
                            Student Class: <span class="text-bold">{{$student_term_data->grade_name}}</span>
                            {{-- <br>
                            Student Stream: <span class="text-bold">{{$student_term_data->stream_name}}</span>
                            <br>
                            Student Section: <span class="text-bold">{{$student_term_data->section_name}}</span> --}}
                            <br>
                            
                        
                            
                            Report Generated: <span class="text-bold text-italics">{{date('d F Y H:i')}}</span>
                            <br>


                        </td>


                    </tr>
                        
                 
 
                       
                    </tbody>
                </table>
       
<p class="py-2 mx-auto">
    <center><span class="mx-auto">Breakdown of {{$student_term_data->name}}'s   Academic Performance</span> </center>
</p>
               
<?php
        
}
?>      


<?php

$student_subject_average=\DB::select(\DB::raw("SELECT
    student_subject_averages.student_average,
    student_subject_averages.ca_average,
    student_subject_averages.exam_mark,
    subjects.subject_name, 
    subjects.subject_type, 
    subjects.id as subject_id,
    users.name,
    users.salutation,
    users.lastname,
    (AVG( CASE WHEN assessements.id = 1 AND assessements.term_id = 2 THEN (marks.mark) END)) as Test1,
     (AVG( CASE WHEN assessements.id = 2 AND assessements.term_id = 2 THEN (marks.mark) END)) as Test2,
 
    
    FROM
    marks
    INNER JOIN assessements ON assessements.id = marks.assessement_id
    INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id
    INNER JOIN subjects ON subjects.id = teaching_loads.subject_id
    INNER JOIN users ON users.id = marks.teacher_id
     INNER JOIN student_subject_averages ON student_subject_averages.student_id = marks.student_id
    WHERE marks.student_id = ".$student." AND `assessements`.`term_id` = ".$term." AND marks.active=1 AND student_subject_averages.teaching_load_id=marks.teaching_load_id
    GROUP BY
    marks.student_id,student_subject_averages.student_id,
    subjects.id"));

?>


<table class="table table-sm table-bordered">
    <thead class="btn-secondary">
        <tr class="hope">
            <th class="background">Subject Name</th>
           
            <th class="background">Test 1</th>    
            <th class="background">Test 2</th>   
            <th class="background">Total Tests</th>  
            <th class="background">CA (40%)</th>   

            @if ($examExists)
            <th class="background"> Exam Mark</th>    
            <th class="background"> Exam (60%)</th> 
            @endif

            <th class="background">Subject Average</th>   
        
            <th class="background">Symbol</th>
            <th class="background">Comment</th>
            <th class="background">Teacher</th>

        </tr>
    </thead>

 

   
   
    @foreach($student_subject_average as $item2)
      <tr>
         <td> {{ $item2->subject_name }}  </td>
         <td> 
            @if ($item2->Test1<$pass_rate)
            <span class="text-danger">{{round($item2->Test1)}}%</span>
            @else
            {{round($item2->Test1)}}%
            @endif
        </td>
        <td> 
            @if ($item2->Test2<$pass_rate)
            <span class="text-danger">{{round($item2->Test2)}}%</span>
            @else
            {{round($item2->Test2)}}%
            @endif
        </td>
        <td> 
           
           
            {{round($item2->Test1+$item2->Test2)}}%
           
        </td> 
        <td> 
           
           
            {{round($item2->ca_average*0.4)}}%
           
        </td> 
        @if ($examExists)
        <td  @if(!isset($item2->exam_mark)) class="bg-danger" @endif> 
            @if ($item2->exam_mark<$pass_rate)
            @isset($item2->exam_mark)
            <span class="text-danger">{{round($item2->exam_mark)}}%</span>
            @endisset

            @if(!isset($item2->exam_mark))
           <span class="small text-white">mark not entered</span> 
            @endif
            
            @else
            {{round($item2->exam_mark)}}%
            @endif
        </td> 
        

        <td  @if(!isset($item2->exam_mark)) class="bg-danger" @endif> 
       
            @if(!isset($item2->exam_mark))
           <span class="small text-white">mark not entered</span> 
            
            
            @else
            {{round($item2->exam_mark*0.6)}}
            @endif
        </td> 
        @endif
         {{-- <td> 
            @if ($item2->ca_average<$pass_rate)
            <span class="text-danger">{{round($item2->ca_average)}}%</span>
            @else
            {{round($item2->ca_average)}}%
            @endif
        </td>   --}}
     
        <td> 
            @if ($item2->student_average<$pass_rate)
            <span class="text-danger">{{round($item2->student_average)}}%</span>
            @else
            {{round($item2->student_average)}}%
            @endif
        </td> 
        {{-- <td>
           

// $sub_position=\DB::select(\DB::raw("SELECT * FROM
// (SELECT
// (@rownum := @rownum + 1) AS student_position,
//  student_id,
// student_average,
// (SELECT COUNT(student_id) from student_loads INNER JOIN teaching_loads ON teaching_loads.id=student_loads.teaching_load_id INNER JOIN grades ON grades.id=teaching_loads.class_id where term_id=$term and subject_id=$item2->subject_id AND grades.stream_id=$stream) as total
// FROM student_subject_averages a
// INNER JOIN grades ON grades.id=a.student_class
// CROSS JOIN (SELECT @rownum := 0) params
// WHERE grades.stream_id=".$stream." AND term_id=".$term." AND subject_id=".$item2->subject_id."
// ORDER BY student_average DESC) as sub  
// WHERE sub.student_id=".$student.""));

// foreach ($sub_position as $key_position) {
//      if(!isset($item2->exam_mark)){
//         echo '<span class="small text-danger">No Position because of missing mark.</span>';
//     }else{
//         echo $key_position->student_position.' / '.$key_position->total;
//     }
    
//        }
// ?>




        </td>
         --}}
       

        


        <td>
            @foreach ($comments as $comment_symbol)
              
            @if(in_array(round($item2->student_average), range($comment_symbol->from,$comment_symbol->to, 0.01)) ) 
            
              {{$comment_symbol->symbol }}
               
               @endif

               @endforeach
              
            </td>

            <td>
                @foreach ($comments as $comment)
                
                
                @if( in_array(round($item2->student_average), range($comment->from,$comment->to)) ) 
                {{$comment->comment}}
                
                @endif
                @endforeach
                </td>

                <td>
                    {{$item2->salutation}} {{substr($item2->name, 0, 1)}}. {{$item2->lastname}}
                </td>

      </tr>
    
  @endforeach
 
       

    </tr>
   
</table> 


{{-- <div id="chart-container">
    FusionCharts XT will load here!
</div> --}}
               <div class="card-body mx-y">
                   <div class="row">

                 <?php

foreach ($term_average as $student_term_data) {

    ?>
                   {{-- Comments --}}
                   <div class="col" id="i">
                       <label>Class Teacher Comment</label>
                    @foreach ($class_teacher_comments as $teacher_comment)
                   
                    @if (in_array(number_format($student_term_data->student_average), range($teacher_comment->from,$teacher_comment->to,  0.01)) )
                    <textarea class="form-control" id="j">{{$teacher_comment->comment}}</textarea>
                        
                    @endif
                    @endforeach
                   </div>

                   <div class="col" id="i">
                    <label>Headteacher's Comment</label>
                    @foreach ($headteacher_comments  as $headteacher_comment)
                    @if (in_array(number_format($student_term_data->student_average), range($headteacher_comment->from,$headteacher_comment->to, 0.01) ))
                    <textarea class="form-control">{{$headteacher_comment->comment}}</textarea>
                        
                    @endif
                    @endforeach
                   </div>
                   <?php
                }
                                  ?>
                   </div>

                   <div class="row ">
                    
                    <div class="col">
                        <hr>
                        <label> Report Guide</label>
                        <br>
                       
 
                        In order for a student to pass, she/he must at least.
  <ol>
    
    <li>Get a minimum average of at least <span class="text-bold">{{$pass_rate}}%</span></li> 
    {{-- 2. language and number of subjects --}}
    <li>Get an average of <span class="text-bold">{{$pass_rate}}% or more </span> in at least {{$number_of_subjects}} subjects 
        
        @if ($passing_subject_rule==1)
        inclusive of  <span class="text-bold">English Language</span></li>   
        @endif

  </ol>

                       </div>
                   </div>

                   <div class="row">
                   

                    <div class="col">
                        <div id="signaturetitle">
                          Class Teacher Signature
                          </div>

                       </div>

                    
                       <div class="col">
                        <div id="signaturetitle">
                           Headteacher's Signature:
                          </div>
                         
                          <div class="text-center">
<img class="img-fluid mx-auto " width="80" height="80" src="{{$school_is->base64}} " alt="">
                       </div>
                    </div>

                       

                       <div class="col">
                        <div id="signaturetitle">
                            Offical School Stamp:
                          </div>

                       </div>
                   </div>
                   <hr>
                   <center><small>&copy; 2022 Report generated by the <strong>Shunifu Intergrated School Management Platform</strong>-Developed by <strong>Innovazania</strong> based at the Royal Science & Technology Park. 7689 0726 | 7989 0726</small></center>
               </div>
    

            </div>
        </div>
    </div>
{{-- end of report--}}
        
        
        @endforeach
     
   



   
       
</x-app-layout>