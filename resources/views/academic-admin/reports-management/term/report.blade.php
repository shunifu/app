<x-app-layout>
    @foreach ($variables as $variable)
    <x-slot name="header">

  
            
    
        <style type="text/css">
          

            .table {
  border: 0.5px solid grey;
  table-layout: fixed;
}
.table-bordered > thead > tr > th,
.table-bordered > tbody > tr > th,
.table-bordered > tfoot > tr > th,
.table-bordered > thead > tr > td,
.table-bordered > tbody > tr > td,
.table-bordered > tfoot > tr > td {
   border: 0.3px solid rgb(35, 35, 35);
}

            
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
body { margin: 0px;   -webkit-print-color-adjust: exact !important; }
            }

            @media print {
            th.background {
            font-size: {{$variable->font_size}}px;
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
.page-break { display: block; page-break-after: always; }
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

table tbody tr td {

    font-size:{{$variable->font_size.'px'}};
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

            <ul>

           
       <li>If you are using a phone it is advisable that you download the report as a PDF. To do so, click on Download as PDF button and then save the document on your device. </li> 

       <li>Please note that when you download the report as PDF, the first page will appear blank and the second page is where there report will appear. The report card appears in the second page of the PDF.</li> 


    </ul>
        
       
       
        <button class="btn btn-primary" onclick="window.print()" id="print_report">Download Report  as PDF</button>
        <a href="/dashboard"> <button class="btn btn-primary">Go Back</button></a>
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
        terms.next_term_date,
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
                        <?php $classofstudent=$student_term_data->grade_id; ?>
                            Student Name: <span class="text-bold">{{$student_term_data->name}} {{$student_term_data->middlename}} {{$student_term_data->lastname}} </span>
                            <br>
                            Student Average: <span class="text-bold">{{$student_term_data->student_average}}%</span>
                           
                            <?php

if ($variable->term_position==0) { 
}else{
    
    ?> <br>Student Position: <span class="text-bold"> <?php       


    if ($p_key=="stream_based") {
       $sql_piece="where term_averages.term_id=".$term." AND term_averages.student_stream=".$stream." AND users.active=1";
 } else {
     $sql_piece="where term_averages.term_id=".$term." AND term_averages.student_class=".$classofstudent."  AND users.active=1";
 }
 

$student_position=\DB::select(\DB::raw("select t.*
from (select term_averages.student_id,term_averages.student_average, rank() over (order by term_averages.student_average desc) as student_position
from term_averages INNER JOIN users ON users.id=term_averages.student_id " .$sql_piece.") t 
where student_id = ".$student." "));
foreach ($student_position as $key) {
if ($p_key=="stream_based") {
echo $key->student_position.' out of '.$total_students.' ' ;
}else{
echo $key->student_position.' out of '.$total_students.' ';
}

}

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
                                   subject instead of {{$number_of_subjects}} or more
                                       @else
                                       subjects instead of {{$number_of_subjects}} or more
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
                                <img class="user-image img-fluid elevation-1 mx-auto d-block" width="180" height="180" src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1613141854/default-profile-picture-avatar-photo-placeholder-vector-illustration-vector-id1214428300_urpxk5.jpg" alt={{$student_term_data->name}} />
                                @else
                                 <div class="pic mx-auto" style=" width:120px; height:120px; border-radius:50%; background-image: url({{$student_term_data->profile_photo_path}}); background-position: center; background-size:100% auto; background-repeat: no-repeat;"></div>
                                @endif
                               
                            </center>

                        </td>

                        <td>
                        Term: <span class="text-bold">{{$student_term_data->term_name}} {{$student_term_data->academic_session}}</span>
                        <br>

                        Term Opening Date <span class="text-bold">{{ \Carbon\Carbon::parse($student_term_data->start_date)->format('d F Y')}}</span> 
                        
                     <br>
                        Term Closing Date <span class="text-bold">{{ \Carbon\Carbon::parse($student_term_data->end_date)->format('d F Y')}}</span>
                        <br>
                        Next Term Date: <span class="text-bold">{{ \Carbon\Carbon::parse($student_term_data->next_term_date)->format('d F Y')}}</span>
                        
                        <br>
                        Student Class: <span class="text-bold">{{$student_term_data->grade_name}}</span>
                        <br>

                          

                        <?php
 
                        $attendance=\DB::select(\DB::raw("SELECT number_of_absent_days FROM cummulative_attendances WHERE student_id=".$student." AND term_id=".$term." order by id desc LIMIT 1"));
                    
                        
                  
                        foreach ($attendance as $attendance_key) {
                       echo 'Days Absent in Term: '.$attendance_key->number_of_absent_days.' '.'Days';
                     
                         }
              
                     ?>
            
                         <br>
                        Report generated on: <span class="text-bold text-italic">{{date('d F Y H:i')}}</span>
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
    student_subject_averages.mock_mark,
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
    subjects.id ORDER BY subjects.order ASC"));

?>

{{-- if template is shunifu ca_exam --}}

@if ($report_template->report_colums=="ca_exam")
    


<table class="table table-sm table-bordered ">
    <thead >
        <tr class="hope">
            <th class="background">Subject Name</th>
            <th class="background" >CA</th>     
<?php if ($noMock) {   }else{  ?> <th class="background" >Mock</th> <?php  }?>
            <th class="background">Examination</th>   
            <?php if ($variable->subject_average==0) {   }else{  ?> <th class="background" >Subject Average</th> <?php  }?>
            <?php if ($variable->subject_position==0) {   }else{  ?> <th class="background" >Subject Postion</th> <?php  }?>
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

      @if ($noMock)
          
      @else
      <td  @if(!isset($item2->mock_mark)) class="bg-danger" @endif> 
        @if ($item2->mock_mark<$pass_rate)
        @isset($item2->mock_mark)
        <span class="text-danger">{{($item2->mock_mark)}}%</span>
        @endisset

        @if(!isset($item2->mock_mark))
       <span class="small text-black">mark not entered</span> 
        @endif
        
        @else
        {{round($item2->mock_mark)}}%
        @endif
    </td> 
      @endif
      
       

        
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
        

        <?php

        
         if ($variable->subject_average==0) { 
            
          }else{  
            ?><td><?php

?>
   @if (($item2->student_average<$pass_rate))
   <span class="text-danger">{{($item2->student_average)}}%</span>
   @else
   {{($item2->student_average)}}%
   @endif
</td> 
<?php
          }

        
         if ($variable->subject_position==0) { 
            
          }else{  

          ?><td><?php



//stream based positioning 




//Class Based Positioning



//teacher load based positiong 

// if($position_type="stream_based"){

//     $sub_position=\DB::select(\DB::raw("select t.*
// from (select student_subject_averages.student_id,student_subject_averages.student_average, rank() over (order by student_subject_averages.student_average  desc) as student_position
// from student_subject_averages INNER JOIN teaching_loads ON teaching_loads.id=student_subject_averages.teaching_load_id WHERE student_subject_averages.term_id=".$term." AND student_subject_averages.subject_id=".$item2->subject_id." AND  student_subject_averages.student_class IN(SELECT teaching_loads.class_id  FROM teaching_loads INNER JOIN grades ON grades.id=teaching_loads.class_id  where  and grades.stream_id=".$item2->stream_id.") ) t
// where student_id =".$student.""));

// $total=\DB::select(\DB::raw("SELECT COUNT(student_loads.student_id) AS total from student_loads INNER JOIN users ON users.id=student_loads.student_id WHERE users.active=1 AND student_loads.active=1 AND student_loads.teaching_load_id  IN (SELECT teaching_loads.id FROM teaching_loads INNER JOIN grades ON grades.id=teaching_loads.class_id where  teaching_loads.subject_id=".$item2->subject_id." AND grades.stream_id=".$item2->stream_id." AND student_loads.active=1 AND teaching_loads.active=1)"));

// }


// if($position_type="class_based"){
//     $sub_position=\DB::select(\DB::raw("select t.*
// from (select student_subject_averages.student_id,student_subject_averages.student_average, rank() over (order by student_subject_averages.student_average  desc) as student_position
// from student_subject_averages INNER JOIN teaching_loads ON teaching_loads.id=student_subject_averages.teaching_load_id WHERE student_subject_averages.term_id=".$term." AND student_subject_averages.subject_id=".$item2->subject_id." AND  student_subject_averages.student_class = ".$item2->class_id." ) t
// where student_id =".$student.""));

// $total=\DB::select(\DB::raw("SELECT COUNT(student_loads.student_id) AS total from student_loads INNER JOIN users ON users.id=student_loads.student_id WHERE users.active=1 AND student_loads.active=1 AND student_loads.teaching_load_id  IN (SELECT teaching_loads.id FROM teaching_loads INNER JOIN grades ON grades.id=teaching_loads.class_id where  teaching_loads.subject_id=".$item2->subject_id." AND grades.class_id=".$item2->class_id." AND student_loads.active=1 AND teaching_loads.active=1)"));
// }

// if($position_type="teacher_based"){
    $sub_position=\DB::select(\DB::raw("select t.*
from (select student_subject_averages.student_id,student_subject_averages.student_average, rank() over (order by student_subject_averages.student_average  desc) as student_position
from student_subject_averages INNER JOIN teaching_loads ON teaching_loads.id=student_subject_averages.teaching_load_id WHERE student_subject_averages.term_id=".$term." AND student_subject_averages.subject_id=".$item2->subject_id." AND teaching_loads.teacher_id=".$item2->teacher_id." AND  student_subject_averages.student_class IN(SELECT teaching_loads.class_id  FROM teaching_loads INNER JOIN grades ON grades.id=teaching_loads.class_id  where teaching_loads.teacher_id=".$item2->teacher_id."  and grades.stream_id=".$item2->stream_id.") ) t
where student_id =".$student.""));

$total=\DB::select(\DB::raw("SELECT COUNT(student_loads.student_id) AS total from student_loads INNER JOIN users ON users.id=student_loads.student_id WHERE users.active=1 AND student_loads.active=1 AND student_loads.teaching_load_id  IN (SELECT teaching_loads.id FROM teaching_loads INNER JOIN grades ON grades.id=teaching_loads.class_id where  teaching_loads.subject_id=".$item2->subject_id." AND teaching_loads.teacher_id=".$item2->teacher_id." and grades.stream_id=".$item2->stream_id." AND student_loads.active=1 AND teaching_loads.active=1)"));
// }




//




foreach ($sub_position as $key_position) {

foreach($total as $subtotal){
echo $key_position->student_position.' / '.$subtotal->total;
}

}

}?>
 
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
from student_subject_averages INNER JOIN grades ON grades.id=student_subject_averages.student_class WHERE student_subject_averages.term_id=".$term." AND student_subject_averages.subject_id=".$item2->subject_id."  AND  grades.stream_id=".$item2->stream_id.") t
where student_id =".$student.""));

//$sub_position=\DB::select(\DB::raw("select t.*
// from (select student_subject_averages.student_id,student_subject_averages.student_average, rank() over (order by student_subject_averages.student_average  desc) as student_position
// from student_subject_averages INNER JOIN streams ON streams.id=student_subject_averages.class_id WHERE student_subject_averages.term_id=".$term." AND student_subject_averages.subject_id=".$item2->subject_id."  AND  streams.id IN(student_subject_averages.student_class) ) t
// where student_id =".$student.""));

$total=\DB::select(\DB::raw("SELECT COUNT(student_loads.student_id) AS total from student_loads WHERE student_loads.teaching_load_id IN (SELECT teaching_loads.id FROM teaching_loads INNER JOIN grades ON grades.id=teaching_loads.class_id where  teaching_loads.subject_id=".$item2->subject_id." AND grades.stream_id=".$item2->stream_id." AND student_loads.active=1 AND teaching_loads.active=1)"));

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



$db=mysqli_connect(config("app.DB_HOST"),config("app.DB_USERNAME"),config("app.DB_PASSWORD"),env("DB_DATABASE")) or die ("Connection failed!");
$result = $db->multi_query("SET @sql = NULL;
SET SESSION group_concat_max_len = 1000000;
    SELECT
      GROUP_CONCAT(DISTINCT
        CONCAT(
          'MAX(IF(assessements.id = ''',
      assessements.id,
      ''', marks.mark, NULL)) AS ',
      replace(assessement_name, ' ', '') 
        )ORDER BY assessement_name ASC
      ) INTO @sql
from c_a__exams  INNER JOIN assessements ON assessements.id=c_a__exams.assessement_id 
 INNER JOIN marks ON marks.assessement_id=c_a__exams.assessement_id WHERE c_a__exams.term_id=".$term."  ;
SET @sql = CONCAT('SELECT 
    subjects.subject_name as Subject, 
    ', @sql, ',
   
    ROUND(student_subject_averages.student_average) as Average,

   
    (CASE WHEN student_subject_averages.student_average BETWEEN report_comments.from AND report_comments.to THEN report_comments.comment END) AS Comment,
    (CASE WHEN student_subject_averages.student_average BETWEEN report_comments.from AND report_comments.to THEN report_comments.symbol END) AS Symbol,
    CONCAT(salutation, ''  '', lastname) Teacher
    from marks 
    INNER JOIN assessements ON assessements.id = marks.assessement_id
    INNER JOIN c_a__exams ON c_a__exams.assessement_id=assessements.id
    INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id
    INNER JOIN subjects ON subjects.id = teaching_loads.subject_id
    INNER JOIN users ON users.id = marks.teacher_id
    INNER JOIN student_subject_averages ON student_subject_averages.student_id = marks.student_id
    INNER JOIN report_comments 
    WHERE marks.student_id = ".$student." 
    AND `c_a__exams`.`term_id` = ".$term." AND student_subject_averages.term_id=".$term."
    AND marks.active=1 AND student_subject_averages.teaching_load_id=marks.teaching_load_id
    AND report_comments.user_type=1 and report_comments.section_id=".$section_id."
    AND student_subject_averages.student_average BETWEEN report_comments.from AND report_comments.to
   
    GROUP BY
    marks.student_id,student_subject_averages.student_id,
    subjects.id  order by subjects.id');
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


{{-- end of templates --}}

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
                        






                            ?>
                          </div>

                       </div>

                    <div class="col">
                    <div id="signaturetitle">
                    Headteacher's Signature:
                    </div>
                    <div class="text-center">
                    @if ($variable->principal_signature==1)
                    <img class="img-fluid " width="100" height="100" src="{{$school_is->base64}} " alt="">
                    @else       
                    <img class="img-fluid " width="240" height="240" src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1667299468/image_sig_kmjh1n.jpg" alt="">            
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
                            <th class="background">Assessement Categorization</th>     
                            <th class="background">Term Average Calculation</th>   
                        
                
                        </tr>
                    </thead>
       
                      <tr>
 
                        <td>
                            A student must fulfil the following requirements in order to get a clean pass.
                            <ul>
                              
                              <li>Get a  minimum overal average of <span class="text-bold">{{$pass_rate}}% or more</span></li> 
                              {{-- 2. language and number of subjects --}}
                              <li>Get an average of <span class="text-bold">{{$pass_rate}}% or more </span> in at least {{$number_of_subjects}} subjects 
                                  
                                  @if ($passing_subject_rule==1)
                                  inclusive of  <span class="text-bold">English Language</span></li>   
                                  @endif
                          
                            </ul>
                        </td> 
                    
             
                        <td>  subject average was calculated based on the following assessement weight's;
                            <ul>
                                <li>Continuous Assessement: <strong>{{$ca_weight*100}}%</strong> </li>
                                <li>Mock: <strong>{{$mock_weight*100}}%</strong></li>
                                <li>Examination: <strong>{{$exam_weight*100}}%</strong></li>
                            </ul>
                        
                        </td>

                        <td>  Assessement Categorization is ;
                            <br>
                               CA Assessements: <span class="text-bold"> <small> {{implode(',',$ca_assessements)}}</small></span><br>
                               Mock Assessements: <span class="text-bold"> <small> {{implode(',',$mock_assessements)}}</small></span><br>
                               Exam Assessements: <span class="text-bold"><small>{{implode(',',$exam_assessements)}}</small></span> 
                           
                        
                        </td>
                
                        <td>  term average  was calculated using the following criteria:
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
                    

                   <center><small>&copy;This report was generated using the <span class="text-bold">Shunifu School Management Platform</span> which is <span class="text-bold">Eswatini's number one school management system, trusted, loved & used  by schools all over Eswatini</span>. Shunifu is developed under the incubatory support of the <span class="text-bold">Royal Science & Technology Park (RSTP)</span> 2517 9400 | 7689 0726 | 7989 0726</small></center>
                  
                
    

            </div>
        </div>
    </div>
{{-- end of report--}}
        
        
        @endforeach
        @endforeach
     
   



   
       
</x-app-layout>