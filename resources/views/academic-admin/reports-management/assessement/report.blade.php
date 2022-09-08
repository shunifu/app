<x-app-layout>
    <x-slot name="header">
        <style type="text/css">
            i {
            margin-right: 5px;
            }


            
            textarea {
            border: none;
            background-color: transparent;
            resize: none;
            outline: none;
            height: auto;
            
            }
            input,select{
            color:black;
            }
            #img{
            width: 100px;
            height:auto;
            }
            th {
            background-color: #707070;
            color: rgb(255, 255, 255);
            text-align: center;
            } 
            @media print {
            tr {
            
            }}

            
            @media print {
            th.background {
            background-color: #A9A9A9 !important;
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
    assessement_progress_reports.student_average,
    assessement_progress_reports.number_of_passed_subjects,
    assessement_progress_reports.passing_subject_status,
    terms.term_name,
    terms.start_date,
    terms.end_date,
    grades.grade_name,
    streams.stream_name,
    sections.section_name,
    academic_sessions.academic_session,
    academic_sessions.id AS session_id
FROM
    assessement_progress_reports
INNER JOIN users ON users.id = assessement_progress_reports.student_id
INNER JOIN terms ON terms.id = assessement_progress_reports.term_id
INNER JOIN grades ON grades.id = assessement_progress_reports.student_class
INNER JOIN streams ON streams.id = assessement_progress_reports.student_stream
INNER JOIN sections ON sections.id = assessement_progress_reports.student_section
INNER JOIN academic_sessions ON academic_sessions.id = terms.academic_session
WHERE assessement_progress_reports.student_id = ".$student." AND assessement_progress_reports.assessement_id=".$assessement_id.""));

    
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

                               if ($tie_type=="share") {
                                //    if tie type is share, i.e ties share the same position run the query below
 $student_position=\DB::select(\DB::raw("SELECT * FROM (SELECT st.id as student_id,
          sc.student_average,
          CASE 
            WHEN @grade = COALESCE(sc.student_average, 0) THEN @rownum 
            ELSE @rownum := @rownum + 1 
          END AS student_position,
          @grade := COALESCE(sc.student_average, 0) as avg
         
     FROM users st
LEFT JOIN assessement_progress_reports sc ON sc.student_id = st.id
     JOIN (SELECT @rownum := 0, @grade := NULL) r  
     WHERE sc.student_stream=".$stream."  AND sc.term_id=".$term."
 ORDER BY sc.student_average DESC ) as sub
WHERE sub.student_id=".$student.""));
            }else if($tie_type=="sequential"){

                                // Else if ties do not share the same position run the query below
                                $student_position=\DB::select(\DB::raw("SELECT * FROM
                                (SELECT
(@rownum := @rownum + 1) AS student_position,
 student_id,
student_average
FROM assessement_progress_reports a
CROSS JOIN (SELECT @rownum := 0) params
WHERE student_stream =".$stream." AND term_id=".$term."
ORDER BY student_average DESC) as sub
WHERE sub.student_id=".$student.""));
                               }
                                
                                

        foreach ($student_position as $key) {
            echo $key->student_position.' out of '.$total_students.' '. $student_term_data->stream_name.' '.'learners' ;
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
                            Term Opening Date <span class="text-bold">{{\Carbon\Carbon::parse($student_term_data->start_date)->format('d F Y')}}</span>
                            <br>
                            Term Closing Date <span class="text-bold">{{\Carbon\Carbon::parse($student_term_data->end_date)->format('d F Y')}}</span>
                            <br>
                            Next Term Date: <span class="text-bold">5 April 2022</span>

                            
                            <br>
                            Student Class: <span class="text-bold">{{$student_term_data->grade_name}}</span>
                            {{-- <br>
                            Student Stream: <span class="text-bold">{{$student_term_data->stream_name}}</span>
                            <br>
                            Student Section: <span class="text-bold">{{$student_term_data->section_name}}</span> --}}
                            <br>
                            Assigned Subjects: <span class="text-bold">
                                <?php
                                $student_subjects=\DB::select(\DB::raw("SELECT COUNT(*) as total 
                                FROM student_loads 
                                WHERE student_loads.session_id=".$student_term_data->session_id." AND student_id = ".$student.""));
                                ?>

                    @foreach($student_subjects as $total_subjects)
                    {{$total_subjects->total }} 
                    @endforeach

                                Subjects</span>
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
    marks.mark,
    users.salutation,
    users.lastname,
    users.name,
    subjects.subject_name,
    subjects.id AS subject_id
FROM
    assessement_progress_reports
INNER JOIN marks ON marks.assessement_id = assessement_progress_reports.assessement_id
INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id
INNER JOIN subjects ON subjects.id = teaching_loads.subject_id
INNER JOIN users ON users.id = teaching_loads.teacher_id
WHERE
   assessement_progress_reports.assessement_id = 1 AND assessement_progress_reports.student_id = ".$student." AND marks.student_id = ".$student."
   AND marks.assessement_id=assessement_progress_reports.assessement_id
ORDER BY
    student_average
DESC"));
?>


<table class="table table-sm table-bordered">
    <thead class="btn-secondary">
        <tr class="hope">
            <th class="background">Subject Name</th>
           
            {{-- <th class="background">Continuous Assessment</th>    
            <th class="background"> Examination</th>     --}}
            <th class="background">Subject Mark</th>   
            <th class="background">Symbol</th>
            <th class="background">Comment</th>
            <th class="background">Teacher</th>

        </tr>
    </thead>

 
    
  
   
   
    @foreach($student_subject_average as $item2)
      <tr>
         <td> {{ $item2->subject_name }}  </td>
         {{-- <td> 
            @if ($item2->ca_average<$pass_rate)
            <span class="text-danger">{{round($item2->ca_average)}}%</span>
            @else
            {{round($item2->ca_average)}}%
            @endif
        </td>   --}}
        {{-- <td  @if(!isset($item2->exam_mark)) class="bg-danger" @endif> 
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

            
            
            
        </td>  --}}
        <td> 
            @if ($item2->mark<$pass_rate)
            <span class="text-danger">{{round($item2->mark)}}%</span>
            @else
            {{round($item2->mark)}}%
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
              
            @if(in_array(round($item2->mark), range($comment_symbol->from,$comment_symbol->to, 0.01)) ) 
            
              {{$comment_symbol->symbol }}
               
               @endif

               @endforeach
              
            </td>

            <td>
                @foreach ($comments as $comment)
                
                
                @if( in_array(round($item2->mark), range($comment->from,$comment->to)) ) 
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

                 
                   {{-- Comments --}}
                   {{-- <div class="col">
                       <label>Class Teacher Comment</label>
                    @foreach ($class_teacher_comments as $teacher_comment)
                   
                    @if (in_array($student_term_data->student_average, range($teacher_comment->from,$teacher_comment->to,  0.01)) )
                    <textarea class="form-control">{{$teacher_comment->comment}}</textarea>
                        
                    @endif
                    @endforeach
                   </div> --}}

                   {{-- <div class="col">
                    <label>Headteacher's Comment</label>
                    @foreach ($headteacher_comments  as $headteacher_comment)
                    @if (in_array($student_term_data->student_average, range($headteacher_comment->from,$headteacher_comment->to, 0.01)) )
                    <textarea class="form-control">{{$headteacher_comment->comment}}</textarea>
                        
                    @endif
                    @endforeach
                   </div> --}}

                   </div>

                   <div class="row py-3">
                    <div class="col">
                        {{-- <label>{{$student_term_data->section_name}} Report Guide</label> --}}
                       
                        <label>Report Guide</label>
                        In order for a student to pass, she/he must at least.
  <ol>
    <li>Get an overall average of a minimum of <span class="text-bold">{{$pass_rate}}% </span> or more.</li>
    <li>Get a minimum average of at least <span class="text-bold">{{$pass_rate}}%</span> </li>

    @php
$school_is=\App\Models\School::first();
      

      if($school_is->school_code=='0387'){
          if($stream==1){
            echo '<li>Get an average of <span class="text-bold">'.$pass_rate.'% or more </span> in at least 6 subjects inclusive of  <span class="text-bold">English Language</span></li>';
          }else{
            echo '<li>Get an average of <span class="text-bold">'.$pass_rate.'% or more </span> in at least '.$number_of_subjects.' subjects inclusive of  <span class="text-bold">English Language</span></li>';
          }
      }else{
        echo '<li>Get an average of <span class="text-bold">'.$pass_rate.'% or more </span> in at least '.$number_of_subjects.' subjects   <span class="text-bold"></span></li>';
      }


@endphp
   
    
  </ol>

                       </div>
                   </div>

                   <div class="row">
                    <div class="col">
                        <div id="signaturetitle">
                           Headteacher's Signature:
                          </div>
                          
                          <input type="text" id="signature">

                       </div>
                       @php
$school_is=\App\Models\School::first();
      

      if($school_is->school_code=='0387'){
         
      }else{
          
        echo '<div class="col"><div id="signaturetitle">Class Teachers Signature:</div><input type="text" id="signature"></div>';
                       
      }

@endphp
                     

                       <div class="col">
                        <div id="signaturetitle">
                            Offical School Stamp:
                          </div>

                       </div>
                   </div>
               </div>
    

            </div>
        </div>
    </div>
{{-- end of report--}}
        
        
        @endforeach
     
   


<script>
        $(document).ready(function() {
      $('.my-select').selectpicker();
   //   $('h1').css({color:pink});
    });
</script>


        {{-- <script>


            function goBack() {
              window.location = document.referrer;
            }
            </script> --}}

{{-- <script type="text/javascript">
    //STEP 2 - Chart Data

    var data = {!! json_encode($marks, JSON_HEX_TAG) !!};
  
   
    const chartData = data;

    //STEP 3 - Chart Configurations
    const chartConfig = {
    type: 'column2d',
    renderAt: 'chart-container',
    width: '100%',
    height: '450',
    dataFormat: 'json',
    dataSource: {
        // Chart Configuration
        "chart": {
            "caption": "Performance Breakdown",
            "subCaption": "Student Performance Breakdown",
            "xAxisName": "Subjects",
            "yAxisName": "Mark in %",
            "numberSuffix": "",
            "theme": "fusion",
            "showValues": "1",
            "placeValuesInside": "1",
            "rotateValues": "0",
            "valueFont": "Arial",
            "valueFontColor": "#ffffff",
            "valueFontSize": "12",
            "valueFontBold": "1",
            "valueFontItalic": "0",
           "valueFontAlpha": "90"
            },
        // Chart Data
        "data": chartData
        }
    };

    FusionCharts.ready(function(){
    var fusioncharts = new FusionCharts(chartConfig);
    fusioncharts.render();
    });

</script> --}}
   
       
</x-app-layout>