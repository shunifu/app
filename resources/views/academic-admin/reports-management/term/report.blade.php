<x-app-layout>
    @foreach ($variables as $variable)
    <x-slot name="header">

  
            
    
        <style type="text/css">
          

            .table {
  border: 0.5px solid grey;
  table-layout: fixed;
}
/* .table-bordered > thead > tr > th,
.table-bordered > tbody > tr > th,
.table-bordered > tfoot > tr > th,
.table-bordered > thead > tr > td,
.table-bordered > tbody > tr > td,
.table-bordered > tfoot > tr > td {
   border: 0.3px solid grey;
} */

            
          input,select{
            color:black;
            }
            #img{
            width: 100px;
            height:auto;
            }
            th {
            background-color: {{$variable->column_color}};
            color: rgb(255, 255, 255);
            text-align: center;
            } 
            @media print {
            tr {
            
            }}

            @media print{
                @page { margin: 0px; }
body { margin: 0px; }
            }

            @media print {
            th.background {
                font-size: 14px;
            background-color: {{$variable->column_color}} !important;
            -webkit-print-color-adjust: exact; 
            color: #FFFFFF !important;

            
            
            }

            .table th#assessement {
  width: 5%;
  width: fit-content;
}

            /* .table td#fit, 
.table th#fit {
   
    width: 6%;
   
    text-align: center;
}

.table td#ft{
   
}

.table td#f{
    white-space: nowrap;
    width: 6%;
    text-align: center;
} */
   
        
        }

            @media all {
.page-break { display: none; }

}

@media print {
.page-break { display: block; page-break-before: always; }
}
#signaturetitle {
  font-weight: bold;
  text-align: center;
  
}

#signature {
  width: 100%;
  border: 0px;
  border-bottom: 1px solid black;
  /* height: 30px; */
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
                    
                    <img src="{{$item->school_letter_head }}" class="img-fluid mx-auto d-block"/>
                </div>
              
                    
                </div>
               
                @endforeach
<?php
         $term_average=\DB::select(\DB::raw("SELECT
        users.name,
        users.lastname,
        users.middlename,
        users.profile_photo_path,
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
             

echo '<h3 class="text-center lead text-bold">'.$student_term_data->lastname.' '.$student_term_data->middlename.' '.$student_term_data->name."'s".' Report Card</h3>';     
                 
               ?>
               
                          <table class="table table-bordered"> 
                    <thead>
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
                                                        
                            
                            Why {{ $student_term_data->name }} failed:<span class="text-bold"></span>
                            
                            <ul>
                            
                                @if ($student_term_data->student_average<$pass_rate)
                                <li>
                                   Below Average 
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
                                   Below Average 
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

@if ($get_academic_session->final_term==1)
 Resolution: <span class=" text-bold">{{$student_term_data->final_term_status}}  </span>   
@endif





                        </td>
                                                   
   
            
                        <td>
                            <center>

                                @if (is_null($student_term_data->profile_photo_path))
                                <img class="user-image img-fluid elevation-1 mx-auto d-block" width="200" height="200" src="https://ui-avatars.com/api/?name={{$student_term_data->name}}+&amp;color=7F9CF5&amp;background=EBF4FF" alt={{$student_term_data->name}} />
                                @else
                                <img class="user-image img-fluid elevation-1 mx-auto d-block" width="200" height="200" src="{{$student_term_data->profile_photo_path}}" alt={{$student_term_data->name}} />
                                @endif
                               
                                
                               
                            </center>

                        </td>

                        <td>
                        Term: <span class="text-bold">{{$student_term_data->term_name}} {{$student_term_data->academic_session}}</span>
                        <br>
                        Term Opening Date <span class="text-bold">13 September 2022</span>
                        <br>
                        Term Closing Date <span class="text-bold">22 December 2022</span>
                        <br>
                        Next Term Date: <span class="text-bold">17 January 2023</span>

                            
                        <br>
                        Student Class: <span class="text-bold">{{$student_term_data->grade_name}}</span>
                        @if (is_null($variable->student_attendance) OR $variable->student_attendance==0)


                        <?php

if ($school_is->school_code="0070") {
    $attendance=\DB::select(\DB::raw("SELECT number_of_absent_days FROM cummulative_attendances WHERE student_id=".$student." AND term_id=".$term.""));


    
if(collect($attendance)->first()) {
    foreach ($attendance as $attendance_key) {
   echo 'Days Absent: '$attendance_key->number_of_absent_days.' '.'70 Days';
 
     }
} else {
               
}






}





                        ?>
                        @else





                
                             
                        @endif
      <br>
                        Report Generated: <span class="text-bold text-italic">{{date('d F Y H:i')}}</span>
                        <br>


                        </td>


                    </tr>
                        
                 
 
                       
                    </tbody>
                </table>
       <br>
       <br>
<span class=" mx-auto">
    <center><span class="mx-auto">Breakdown of <span class="text-bold">{{$student_term_data->name}}'s </span>  Academic Performance</span> </center>
</span>
               
<?php
        
}
?>      

<?php

$student_subject_average=\DB::select(\DB::raw("SELECT
grades.stream_id,
    student_subject_averages.student_average,
    student_subject_averages.ca_average,
    student_subject_averages.exam_mark,
    subjects.subject_name, 
    subjects.subject_type, 
    subjects.id as subject_id,
    users.id as teacher_id,
    users.name,
    users.salutation,
    users.lastname
    FROM
    student_subject_averages
    INNER JOIN teaching_loads ON teaching_loads.id = student_subject_averages.teaching_load_id
    INNER JOIN subjects ON subjects.id = teaching_loads.subject_id
    INNER JOIN users ON users.id = teaching_loads.teacher_id
    INNER JOIN grades ON grades.id=student_subject_averages.student_class
    WHERE student_subject_averages.student_id = ".$student." AND `student_subject_averages`.`term_id` = ".$term." 
    GROUP BY
    student_subject_averages.student_id,
    subjects.id"));

?>

{{-- if template is shunifu x --}}

@if ($report_template->report_colums=="ca_exam")
    


<table class="table table-sm table-bordered ">
    <thead >
        <tr class="hope">
            <th class="background">Subject Name</th>
            <th class="background" >CA</th>     
            <th class="background">Examination</th>   
            <th class="background">Subject Average</th>   
            <th class="background">Subject Position</th>   
            <th class="background">Symbol</th>
            <th class="background">Comment</th>
            <th class="background">Teacher</th>

        </tr>
    </thead>

 

   
   
    @foreach($student_subject_average as $item2)
      <tr>
        <td>{{ $item2->subject_name }}</td>
      
         <td> 
            @if (is_null($item2->ca_average))
            -
            @elseif (($item2->ca_average<$pass_rate))
            <span class="text-danger">{{round(($item2->ca_average))}}%</span>
            @else
            {{round(($item2->ca_average),2)}}%
            @endif
        </td>   
      


        
        <td  @if(!isset($item2->exam_mark)) class="bg-danger" @endif> 
            @if ($item2->exam_mark<$pass_rate)
            @isset($item2->exam_mark)
            <span class="text-danger">{{($item2->exam_mark)}}%</span>
            @endisset

            @if(!isset($item2->exam_mark))
           <span class="small text-black">mark not entered</span> 
            @endif
            
            @else
            {{round($item2->exam_mark)}}%
            @endif
        </td> 
        

    
         <td> 
            @if (($item2->student_average<$pass_rate))
            <span class="text-danger">{{($item2->student_average)}}%</span>
            @else
            {{($item2->student_average)}}%
            @endif
        </td> 
  

             <td>

            <?php
           
 $sub_position=\DB::select(\DB::raw("select t.*
from (select student_subject_averages.student_id,student_subject_averages.student_average, rank() over (order by student_subject_averages.student_average  desc) as student_position
from student_subject_averages INNER JOIN teaching_loads ON teaching_loads.id=student_subject_averages.teaching_load_id WHERE student_subject_averages.term_id=".$term." AND student_subject_averages.subject_id=".$item2->subject_id." AND teaching_loads.teacher_id=".$item2->teacher_id." AND  student_subject_averages.student_class IN(SELECT teaching_loads.class_id  FROM teaching_loads INNER JOIN grades ON grades.id=teaching_loads.class_id  where teaching_loads.teacher_id=".$item2->teacher_id."  and grades.stream_id=".$item2->stream_id.") ) t
where student_id =".$student.""));

$total=\DB::select(\DB::raw("SELECT COUNT(student_loads.student_id) AS total from student_loads WHERE student_loads.teaching_load_id IN (SELECT teaching_loads.id FROM teaching_loads INNER JOIN grades ON grades.id=teaching_loads.class_id where  teaching_loads.subject_id=".$item2->subject_id." AND teaching_loads.teacher_id=".$item2->teacher_id." and grades.stream_id=".$item2->stream_id." AND student_loads.active=1)"));

 foreach ($sub_position as $key_position) {
   
        foreach($total as $subtotal){
            echo $key_position->student_position.' / '.$subtotal->total;
        }
       
    
    
      }
?>
        </td>
         
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
@endif




{{-- if selected template is exam only  --}}
@if ($report_template->report_colums=="exam_only")


<table class="table table-sm table-bordered ">
    <thead >
        <tr class="hope">
            <th class="background">Subject Name</th> 
            <th class="background">Exam Mark</th>   
            <th class="background">Subject Position</th>  
            <th class="background">Class Average</th>   
            
            <th class="background">Symbol</th>
            <th class="background">Comment</th>
            <th class="background">Teacher</th>

        </tr>
    </thead>

 

   
   
    @foreach($student_subject_average as $item2)
      <tr>
        <td>{{ $item2->subject_name }}</td>
      
       
      
       
        <td  @if(!isset($item2->exam_mark)) class="bg-danger" @endif> 
            @if ($item2->exam_mark<$pass_rate)
            @isset($item2->exam_mark)
            <span class="text-danger">{{($item2->exam_mark)}}%</span>
            @endisset

            @if(!isset($item2->exam_mark))
           <span class="small text-black">mark not entered</span> 
            @endif
            
            @else
            {{round($item2->exam_mark)}}%
            @endif
        </td> 
        


 
    
       
  

             <td>

            <?php
           
 $sub_position=\DB::select(\DB::raw("select t.*
from (select student_subject_averages.student_id,student_subject_averages.student_average, rank() over (order by student_subject_averages.student_average  desc) as student_position
from student_subject_averages INNER JOIN teaching_loads ON teaching_loads.id=student_subject_averages.teaching_load_id WHERE student_subject_averages.term_id=".$term." AND student_subject_averages.subject_id=".$item2->subject_id." AND teaching_loads.teacher_id=".$item2->teacher_id." AND  student_subject_averages.student_class IN(SELECT teaching_loads.class_id  FROM teaching_loads INNER JOIN grades ON grades.id=teaching_loads.class_id  where teaching_loads.teacher_id=".$item2->teacher_id."  and grades.stream_id=".$item2->stream_id." AND teaching_loads.active=1) ) t
where student_id =".$student.""));

$total=\DB::select(\DB::raw("SELECT COUNT(student_loads.student_id) AS total from student_loads WHERE student_loads.teaching_load_id IN (SELECT teaching_loads.id FROM teaching_loads INNER JOIN grades ON grades.id=teaching_loads.class_id where  teaching_loads.subject_id=".$item2->subject_id." AND teaching_loads.teacher_id=".$item2->teacher_id." and grades.stream_id=".$item2->stream_id." AND student_loads.active=1 AND teaching_loads.active=1)"));

 foreach ($sub_position as $key_position) {
   
        foreach($total as $subtotal){
            echo $key_position->student_position.' / '.$subtotal->total;
        }
       
    
    
      }
?>
        </td>
        <td>

            <?php
           
 $sub_avg=\DB::select(\DB::raw("select t.*
from (select ROUND(AVG(student_subject_averages.student_average)) AS subject_average
from student_subject_averages INNER JOIN teaching_loads ON teaching_loads.id=student_subject_averages.teaching_load_id WHERE student_subject_averages.term_id=".$term." AND student_subject_averages.subject_id=".$item2->subject_id." AND teaching_loads.teacher_id=".$item2->teacher_id."  AND  student_subject_averages.student_class IN(SELECT teaching_loads.class_id  FROM teaching_loads INNER JOIN grades ON grades.id=teaching_loads.class_id  where teaching_loads.teacher_id=".$item2->teacher_id." and grades.stream_id=".$item2->stream_id.") ) t;"));


 foreach ($sub_avg as $tb_avg) {
   
     
       echo $tb_avg->subject_average.'%';
       
    
    
      }
?>
        </td>
         
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

@endif




{{-- if selected template is ca only  --}}
@if ($report_template->report_colums=="ca_only")


<table class="table table-sm table-bordered ">
    <thead >
        <tr class="hope">
            <th class="background">Subject Name</th> 
            <th class="background">Continuous Assessment</th>   
            <th class="background">Subject Average</th>   
            <th class="background">Subject Position</th>   
            <th class="background">Symbol</th>
            <th class="background">Comment</th>
            <th class="background">Teacher</th>

        </tr>
    </thead>

 

   
   
    @foreach($student_subject_average as $item2)
      <tr>
        <td>{{ $item2->subject_name }}</td>
      
       
      
        <td> 
            @if (is_null($item2->ca_average))
            -
            @elseif (($item2->ca_average<$pass_rate))
            <span class="text-danger">{{round(($item2->ca_average))}}%</span>
            @else
            {{round(($item2->ca_average),2)}}%
            @endif
        </td>   
        

    
         <td> 
            @if (($item2->student_average<$pass_rate))
            <span class="text-danger">{{($item2->student_average)}}%</span>
            @else
            {{($item2->student_average)}}%
            @endif
        </td> 
  

             <td>

            <?php
           
 $sub_position=\DB::select(\DB::raw("select t.*
from (select student_subject_averages.student_id,student_subject_averages.student_average, rank() over (order by student_subject_averages.student_average  desc) as student_position
from student_subject_averages INNER JOIN teaching_loads ON teaching_loads.id=student_subject_averages.teaching_load_id WHERE student_subject_averages.term_id=".$term." AND student_subject_averages.subject_id=".$item2->subject_id." AND teaching_loads.teacher_id=".$item2->teacher_id." AND  student_subject_averages.student_class IN(SELECT teaching_loads.class_id  FROM teaching_loads INNER JOIN grades ON grades.id=teaching_loads.class_id  where teaching_loads.teacher_id=".$item2->teacher_id."  and grades.stream_id=".$item2->stream_id.") ) t
where student_id =".$student.""));

$total=\DB::select(\DB::raw("SELECT COUNT(student_loads.student_id) AS total from student_loads WHERE student_loads.teaching_load_id IN (SELECT teaching_loads.id FROM teaching_loads INNER JOIN grades ON grades.id=teaching_loads.class_id where  teaching_loads.subject_id=".$item2->subject_id." AND teaching_loads.teacher_id=".$item2->teacher_id." and grades.stream_id=".$item2->stream_id." AND student_loads.active=1)"));

 foreach ($sub_position as $key_position) {
   
        foreach($total as $subtotal){
            echo $key_position->student_position.' / '.$subtotal->total;
        }
       
    
    
      }
?>
        </td>
         
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

@endif


@if ($report_template->report_colums=="term_assessements")
@php

$db=mysqli_connect(env("DB_HOST"),env("DB_USERNAME"),env("DB_PASSWORD"),env("DB_DATABASE")) or die ("Connection failed!");
$result = $db->multi_query("SET @sql = NULL;
SET SESSION group_concat_max_len = 1000000;
    SELECT
      GROUP_CONCAT(DISTINCT
        CONCAT(
          'MAX(IF(assessements.id = ''',
      assessements.id,
      ''', marks.mark, NULL)) AS ',
      replace(assessement_name, ' ', '')
        )
      ) INTO @sql
from c_a__exams  INNER JOIN assessements ON assessements.id=c_a__exams.assessement_id 
 INNER JOIN marks ON marks.assessement_id=c_a__exams.assessement_id WHERE c_a__exams.term_id=".$term.";
SET @sql = CONCAT('SELECT 
    subjects.subject_name as Subject, 
    ', @sql, ',
   
    ROUND(student_subject_averages.ca_average) as CA,
    ROUND(student_subject_averages.student_average) as Average,
    
    (CASE WHEN student_subject_averages.student_average BETWEEN report_comments.from AND report_comments.to THEN report_comments.comment END) AS Comment,
     (CASE WHEN student_subject_averages.student_average BETWEEN report_comments.from AND report_comments.to THEN report_comments.symbol END) AS Symbol,
  
     concat(salutation,lastname) Teacher
     from marks 
    INNER JOIN assessements ON assessements.id = marks.assessement_id
    INNER JOIN c_a__exams ON c_a__exams.assessement_id=assessements.id
    INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id
    INNER JOIN subjects ON subjects.id = teaching_loads.subject_id
    INNER JOIN users ON users.id = marks.teacher_id
     INNER JOIN student_subject_averages ON student_subject_averages.student_id = marks.student_id
                  INNER JOIN report_comments 
                   WHERE marks.student_id = ".$student." AND `c_a__exams`.`term_id` = ".$term." AND marks.active=1 AND student_subject_averages.teaching_load_id=marks.teaching_load_id AND report_comments.user_type=1 and report_comments.section_id=".$section_id." AND student_subject_averages.student_average BETWEEN report_comments.from AND report_comments.to
    GROUP BY
    marks.student_id,student_subject_averages.student_id,
    subjects.id');

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;");

if ($err=mysqli_error($db)) { echo $err."<br><hr>"; }
if ($result) {
  do {
  if ($res = $db->store_result()) {
      echo "<table class='table table-sm table-bordered' width=100% border=0><tr>";

        
      // printing table headers
      for($i=0; $i<mysqli_num_fields($res); $i++)
      {
          $field = mysqli_fetch_field($res);

        
          echo "<th class='background' id='assessement'>{$field->name}</th>";
      }
      echo "</tr>\n";


//       foreach ($data as $row) {
//     // Check the value of the mark and determine the CSS class
//     if ($row['mark'] < 50) {
//       $class = 'mark-red';
//     } else {
//       $class = 'mark-green';
//     }

//     // Generate the HTML for the table row
//     echo '<tr>';
//     echo '<td>' . htmlspecialchars($row['student_name']) . '</td>';
//     echo '<td class="mark ' . $class . '">' . $row['mark'] . '%</td>';
//     echo '...';
//     echo '</tr>';
//   }


      // printing table rows
      while($row = $res->fetch_assoc())
      {

       
     
   
    echo "<tr>";
          foreach($row as $cell=>$value) {
        //   foreach ($cell as $key => $value) {
        
        //   }

     
  
        if (htmlspecialchars($value) < $pass_rate) {
        $class = 'class=text-danger';
     
    } else {
        $class = 'class=text-black';
    }
        
            if ($value === NULL) { $value = '-'; }

            if(is_numeric($value)){$percentage="%";}else{$percentage=" ";}
            
         
            echo "<td $class>$value"."$percentage</td>";
          }
          echo "</tr>\n";
      }
      $res->free();
      echo "</table>";

    }
  } while ($db->more_results() && $db->next_result());
}
$db->close();

@endphp
    
@endif

@if ($report_template->report_colums=="year_assessements")
@php
$db=mysqli_connect(env("DB_HOST"),env("DB_USERNAME"),env("DB_PASSWORD"),env("DB_DATABASE")) or die ("Connection failed!");
$result = $db->multi_query("SET @sql = NULL;
    SELECT
      GROUP_CONCAT(DISTINCT
        CONCAT(
          'MAX(IF(assessements.id = ''',
      assessements.id,
      ''', marks.mark, NULL)) AS ',
      replace(assessement_name, ' ', '')
        )
      ) INTO @sql
from assessements  
 INNER JOIN marks ON marks.assessement_id=assessements.id 
 INNER JOIN terms ON terms.id=assessements.term_id
 INNER JOIN academic_sessions ON academic_sessions.id = terms.academic_session
 WHERE  academic_sessions.active=1;
SET @sql = CONCAT('SELECT 
    subjects.subject_name as Subject, 
    ', @sql, ',
   
    ROUND(student_subject_averages.ca_average) as CA,
    ROUND(student_subject_averages.student_average) as Average,
    
    (CASE WHEN student_subject_averages.student_average BETWEEN report_comments.from AND report_comments.to THEN report_comments.comment END) AS Comment,
     (CASE WHEN student_subject_averages.student_average BETWEEN report_comments.from AND report_comments.to THEN report_comments.symbol END) AS Symbol,
     
     CONCAT(lastname,' ',name) AS Teacher
    
   
     from marks 
    INNER JOIN assessements ON assessements.id = marks.assessement_id
    INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id
    INNER JOIN subjects ON subjects.id = teaching_loads.subject_id
    INNER JOIN users ON users.id = marks.teacher_id
     INNER JOIN student_subject_averages ON student_subject_averages.student_id = marks.student_id
                  INNER JOIN report_comments 
                   WHERE marks.student_id = ".$student." AND `assessements`.`term_id` = ".$term." AND marks.active=1 AND student_subject_averages.teaching_load_id=marks.teaching_load_id AND report_comments.user_type=1 and report_comments.section_id=".$section_id." AND student_subject_averages.student_average BETWEEN report_comments.from AND report_comments.to
    GROUP BY
    marks.student_id,student_subject_averages.student_id,
    subjects.id');

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;");

if ($err=mysqli_error($db)) { echo $err."<br><hr>"; }

if ($result) {
  do {
  if ($res = $db->store_result()) {
      echo "<table class='table table-sm table-bordered' width=100% border=0><tr>";

      // printing table headers
      for($i=0; $i<mysqli_num_fields($res); $i++)
      {
          $field = mysqli_fetch_field($res);
          echo "<th class='background'>{$field->name}</th>";
      }
      echo "</tr>\n";

      // printing table rows
      while($row = $res->fetch_row())
      {
     //   dd($row[5]);
        if ($row['5'] <= 40) {
        $class = 'class=text-danger';
     
    } else {
        $class = 'class=text-info';
    }
    echo "<tr>";
          foreach($row as $cell) {
        //   foreach ($scell as $key => $value) {
        //     # code...
        //   }
            if ($cell === NULL) { $cell = '-'; }
         
            echo "<td $class>$cell</td>";
          }
          echo "</tr>\n";
      }
      $res->free();
      echo "</table>";

    }
  } while ($db->more_results() && $db->next_result());
}
$db->close();

@endphp
    
@endif



        <hr>          

                 <?php

foreach ($term_average as $student_term_data) {

    ?>


       
<table class="table table-sm table-bordered">
    <thead >
        <tr class="hope">
            <th class="background">Class Teacher's Comment</th>
            <th class="background">Head Teacher's Comment</th>    
           
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>
                @foreach ($class_teacher_comments as $teacher_comment)
                   
                @if (in_array(number_format($student_term_data->student_average), range($teacher_comment->from,$teacher_comment->to,  0.01)) )
               {{$teacher_comment->comment}}
                    
                @endif
                @endforeach
            </td>

            <td>
                @foreach ($headteacher_comments  as $headteacher_comment)
                @if (in_array(number_format($student_term_data->student_average), range($headteacher_comment->from,$headteacher_comment->to, 0.01) ))
                {{$headteacher_comment->comment}}
                    
                @endif
                @endforeach   
            </td>
        </tr>
    </tbody>


                                   
</table> 

                   <?php
                }
                                  ?>
                                  
                   {{-- </div> --}}
    
                   <div class="row">
                   

                    <div class="col">
                        <div id="signaturetitle">
                          Class Teacher Signature
                          </div>
                          <div class="text-center">
                            <?php

$class_t=\DB::select(\DB::raw("SELECT users.salutation, users.name, users.lastname FROM grades_teachers INNER JOIN users ON grades_teachers.teacher_id=users.id where grade_id=".$classofstudent.""));
foreach ($class_t as $key_t) {

echo '<span class="font-italic font-weight-light">'.substr($key_t->name, 0, 1).'  '.$key_t->lastname.' </span>';


}




                            ?>
                          </div>

                       </div>

                    
                       <div class="col">
                        <div id="signaturetitle">
                           Headteacher's Signature:
                          </div>
                          <div class="text-center">
                          @if ($variable->principal_signature==1)
                         
                            <img class="img-fluid " width="80" height="80" src="{{$school_is->base64}} " alt="">
                               @else       
                               <img class="img-fluid " width="120" height="120" src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1667299468/image_sig_kmjh1n.jpg" alt="">            
                          @endif
                         
                        </div>
                    </div>

                       

                       <div class="col">
                        <div id="signaturetitle">
School Stamp
                        </div>
                        <div class="text-center">
                            @if ($variable->school_stamp==1)
                            <img class="img-fluid " width="140" height="140" src="{{$school_is->school_stamp}} " alt="">  
                            @else
                            <img class="img-fluid " width="140" height="140" src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1667299468/image_sig_kmjh1n.jpg" alt="">
                            @endif
                           
                          </div>

                       </div>
                   </div>
                       
                   <table class="table table-sm table-bordered">
                    <thead>
                        <tr class="hope">
                            <th class="background">Passing Criteria</th>
                            <th class="background">Subject Average Calculation</th>    
                            <th class="background">Term Average Calculation</th>   
                        
                
                        </tr>
                    </thead>
       
                      <tr>
 
                        <td>
                             In order for a student to pass, she/he must at least get.
                            <ul>
                              
                              <li>A minimum average of at least <span class="text-bold">{{$pass_rate}}%</span></li> 
                              {{-- 2. language and number of subjects --}}
                              <li>An average of <span class="text-bold">{{$pass_rate}}% or more </span> in at least {{$number_of_subjects}} subjects 
                                  
                                  @if ($passing_subject_rule==1)
                                  inclusive of  <span class="text-bold">English Language</span></li>   
                                  @endif
                          
                            </ul>
                        </td> 
             
                        <td> {{$student_term_data->name}}'s subject average was calculated based on the following assessement weight's;
                            <ul>
                                <li>Continuous Assessement: <strong>{{$ca_weight*100}}%</strong> </li>
                                <li>Examination: <strong>{{$exam_weight*100}}%</strong></li>
                            </ul>
                        
                        </td>
                
                        <td> {{$student_term_data->name}}'s term average was calculated based on the following criterion;
                            <ul>
                            
                                @if ($calculation_type=="default")
                                <li> Average of  all subjects  excluding {{$non_value_subject_name}} 
                                </li> 
                                   @endif
                               

                                   @if ($calculation_type=="custom")
                                  
                                <li> Average of  <strong>best {{$number_of_subjects}} subjects </strong>@if ($passing_subject_rule==1)
                                    inclusive of  <span class="text-bold">English Language</span>@endif  excluding {{$non_value_subject_name }}</li>
                                </li> 
                                    
                                @endif

                            
                            </ul></td>
                
                       
                
                      </tr>
                    
            
                </table> 
                    

                   <center><small>&copy; Report generated by the <strong>Shunifu Platform</strong>-Developed by <strong>Innovazania</strong> based at the <strong>Royal Science & Technology Park</strong>  7689 0726 | 2517 9448</small></center>
               
    

            </div>
        </div>
    </div>
{{-- end of report--}}
        
        
        @endforeach
        @endforeach
     
   



   
       
</x-app-layout>

