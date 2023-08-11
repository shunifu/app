<x-app-layout>

  <style>

 
 @media print {

@page {
   size: landscape A4;
   border: red;
  
}
body{
   font-size: 10px;
   -webkit-print-color-adjust: exact !important;
   
}

div.col-4{
 
    width: 40%;
    border: 1px solid black;
  
    font-size: 9.5px;
    /* 100 = viewport width, as 1vw = 1/100th of that
       So if the container is 50% of viewport (as here)
       then factor that into how you want it to size.
       Let's say you like 5vw if it were the whole width,
       then for this container, size it at 2.5vw (5 * .5 [i.e. 50%])
    */
    /* font-size: 2.5vw; */

}

#des{
  width: 100%;
    border: 1px solid black;
  
    font-size: 9.5px;
}


div.assessement{
  width: 40%;
    border: 1px solid black;
  
    font-size: 9.5px;
}
/* 
table{
 font-size:11px !important;
} */
/* 
#contain{
 font-size: 12px;
} */

}
/* .container {
  width: 100%;
  padding: 0;
  margin: 0;
}

.row {
  height: 8.5in;
  display: inline-flex;
  padding: 0;
  margin: 0;

  max-height: 100;
  width: 100%;
} */

  </style>


   


<div class="container-fluid d-flex flex-column bg-white" id="contain">
     <div class="row">

        <div class="col">

           <div class="row">
            
             <div class="col-4">
  {{-- Subjects --}}

  @foreach ($back_subjects as $item) 

  <div class="table-responsive">
   <table class="table  table-bordered table-sm" id="performance_table">
    <thead>
      <tr>
        
         <th colspan="2"><strong>{{$item->subject_name}} </strong></th>
       </tr>
       <tr>
           <td>Strand</td>
           <td>Grade</td>
         </tr>

        
     </thead>

     <tbody>

         
       
       @php


if($item->stream_id==13 OR $item->stream_id==12 ){
//foundation

$strands=DB::table('strands')
       ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
       ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
       ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
       ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
       ->join('users', 'users.id', '=', 'cbe_marks.student_id')
       ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
       ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
       // ->where('academic_sessions.active',1)
       ->where('cbe_marks.student_id',$item->student_id)
       ->where('teaching_loads.subject_id',$item->subject_id)
       ->where('cbe_marks.term_id',$term_id)
       ->get();
}else{



$strands=DB::table('strands')
       ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
       ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
       ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
       ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
       ->join('users', 'users.id', '=', 'cbe_marks.student_id')
       ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
       ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
       // ->where('academic_sessions.active',1)
       ->where('cbe_marks.student_id',$item->student_id)
       ->where('teaching_loads.subject_id',$item->subject_id)
       ->where('cbe_marks.term_id',$term_id)
       ->get();

   
}






foreach ($strands as $strand) {
  echo '<tr>';

echo '<td>'.$strand->strand.'</td>';
echo '<td>'.$strand->assessement_grade.'</td>';

echo '</tr>';


}




if($item->stream_id==13 OR $item->stream_id==12){

}else{



$marks=DB::table('student_subject_averages')
       
       ->join('teaching_loads', 'teaching_loads.id', '=', 'student_subject_averages.teaching_load_id')
       ->join('users', 'users.id', '=', 'student_subject_averages.student_id')
       ->where('student_subject_averages.student_id',$item->student_id)
       ->where('teaching_loads.subject_id',$item->subject_id)
       ->where('student_subject_averages.term_id',$term_id)
       ->get();

foreach ($marks as $mark) {
   echo '<tr>';
echo '<th rowspan="3">Achievement</th>'; 
if(round($mark->ca_average)<"50"){

echo '<td>Tests: '.'<strong><span class="text-danger">'.round($mark->ca_average).'%'.'</span></strong></td>';
}else{
echo '<td>Tests: '.'<strong><span class="text-primary">'.round($mark->ca_average).'%'.'</span></strong></td>';
}
echo '</tr>';
echo '<tr>';
   if(round($mark->exam_mark)<"50"){

echo '<td>Exam: '.'<strong><span class="text-danger">'.round($mark->exam_mark).'%'.'</span></strong></td>';
}else{
echo '<td>Exam: '.'<strong><span class="text-primary">'.round($mark->exam_mark).'%'.'</span></strong></td>';
}

echo '</tr>';
echo '<tr>';
   if(round($mark->student_average)<"50"){

       echo '<td>Total: '.'<strong><span class="text-danger">'.round($mark->student_average).'%'.'</span></strong></td>';
   }else{
       echo '<td>Total: '.'<strong><span class="text-primary">'.round($mark->student_average).'%'.'</span></strong></td>';
   }
  

echo '</tr>';



echo '<tr> <thead>';
echo '<th>'."Comment".'</th>';

foreach ($comments  as $comment) {
   if( in_array(round($mark->student_average), range($comment->from,$comment->to)) ) 
              

               echo '<td>'.$comment->comment.'</td>';
           
}

echo '</thead></tr>'; 
}




}



       @endphp

       
       
        
        
     </tbody>
  </table> 




 </div>

@endforeach 

@foreach ($hpe as $item) 

<div class="table-responsive">
 <table class="table  table-bordered table-sm" id="performance_table">
  <thead>
    <tr>
      
       <th colspan="2"><strong>{{$item->subject_name}} </strong></th>
     </tr>
     <tr>
         <td>Strand</td>
         <td>Grade</td>
       </tr>

      
   </thead>

   <tbody>

     
     @php


if($item->stream_id==13 OR $item->stream_id==12 ){
//foundation

$strands=DB::table('strands')
     ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
     ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
     ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
     ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
     ->join('users', 'users.id', '=', 'cbe_marks.student_id')
     ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
     ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
     // ->where('academic_sessions.active',1)
     ->where('cbe_marks.student_id',$item->student_id)
     ->where('teaching_loads.subject_id',$item->subject_id)
     ->where('cbe_marks.term_id',$term_id)
     ->get();
}else{



$strands=DB::table('strands')
     ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
     ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
     ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
     ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
     ->join('users', 'users.id', '=', 'cbe_marks.student_id')
     ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
     ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
     // ->where('academic_sessions.active',1)
     ->where('cbe_marks.student_id',$item->student_id)
     ->where('teaching_loads.subject_id',$item->subject_id)
     ->where('cbe_marks.term_id',$term_id)
     ->get();

 
}






foreach ($strands as $strand) {
echo '<tr>';

echo '<td>'.$strand->strand.'</td>';
echo '<td>'.$strand->assessement_grade.'</td>';

echo '</tr>';


}




if($item->stream_id==13 OR $item->stream_id==12){

}else{



$marks=DB::table('student_subject_averages')
     
     ->join('teaching_loads', 'teaching_loads.id', '=', 'student_subject_averages.teaching_load_id')
     ->join('users', 'users.id', '=', 'student_subject_averages.student_id')
     ->where('student_subject_averages.student_id',$item->student_id)
     ->where('teaching_loads.subject_id',$item->subject_id)
     ->where('student_subject_averages.term_id',$term_id)
     ->get();

foreach ($marks as $mark) {
 echo '<tr>';
echo '<th rowspan="3">Achievement</th>'; 
if(round($mark->ca_average)<"50"){

echo '<td>Tests: '.'<strong><span class="text-danger">'.round($mark->ca_average).'%'.'</span></strong></td>';
}else{
echo '<td>Tests: '.'<strong><span class="text-primary">'.round($mark->ca_average).'%'.'</span></strong></td>';
}
echo '</tr>';
echo '<tr>';
 if(round($mark->exam_mark)<"50"){

echo '<td>Exam: '.'<strong><span class="text-danger">'.round($mark->exam_mark).'%'.'</span></strong></td>';
}else{
echo '<td>Exam: '.'<strong><span class="text-primary">'.round($mark->exam_mark).'%'.'</span></strong></td>';
}

echo '</tr>';
echo '<tr>';
 if(round($mark->student_average)<"50"){

     echo '<td>Total: '.'<strong><span class="text-danger">'.round($mark->student_average).'%'.'</span></strong></td>';
 }else{
     echo '<td>Total: '.'<strong><span class="text-primary">'.round($mark->student_average).'%'.'</span></strong></td>';
 }


echo '</tr>';



echo '<tr> <thead>';
echo '<th>'."Comment".'</th>';

foreach ($comments  as $comment) {
 if( in_array(round($mark->student_average), range($comment->from,$comment->to)) ) 
            

             echo '<td>'.$comment->comment.'</td>';
         
}

echo '</thead></tr>'; 
}




}



     @endphp

     
     
      
      
   </tbody>
</table> 




</div>

@endforeach 








</div>


        <div class="col " id="des">
         <table class="table table-compact  table-bordered table-sm" id="contain">
           <thead>
             <tr>
               <th colspan="3">Assessement Grade Descriptor</th>
             </tr>
           </thead>
           <tbody>
             <tr>
               <td style=" white-space: nowrap;"><strong>Excellent [E]</strong></td>
               <td colspan="2" style=" white-space: nowrap;">Learner is outstanding in all<br>areas of competency or<br>strand</td>
             </tr>
             <tr>
               <td style=" white-space: nowrap;"><strong>Very Good [VG]</strong></td>
               <td colspan="2" style=" white-space: nowrap;">Learner is highly proficient<br>in most areas of competency<br>or strand</td>
             </tr>
             <tr>
               <td style=" white-space: nowrap;"><strong>Good [G]</strong></td>
               <td colspan="2" style=" white-space: nowrap;">Learner has mastered the<br>competencies satisfactorily<br>or strand</td>
             </tr>
             <tr>
               <td style=" white-space: nowrap;"><strong>Sufficient [S]</strong></td>
               <td colspan="2" style=" white-space: nowrap;">Learner may have not<br>achieved all the<br>competencies or strand</td>
             </tr>
             <tr>
               <td style=" white-space: nowrap;"><strong>Not Sufficient</strong></td>
               <td colspan="2"style=" white-space: nowrap;" >Learner has not been able to<br>reach a minimum level of<br>competency or strand</td>
             </tr>
           </tbody>
           </table>
@php

      $marks=DB::table('term_averages') 
     ->where('term_averages.student_id',$item->student_id)
     ->where('term_averages.term_id',$term_id)
     ->get();
          
@endphp
           <table class="table  table-bordered table-sm">
             <thead>
               <tr>
                 <th colspan="4" >Class Teacher's General Comments</th>
               </tr>
             </thead>
             <tbody>
               <tr>
              
                @foreach ($marks  as $mark_item)
                <td colspan="5" height="70px">

                  @foreach ($class_teacher_comments as $teacher_comment)
                 
                  @if (in_array(number_format($mark_item->student_average), range($teacher_comment->from,$teacher_comment->to,  0.01)) )
                 {{$teacher_comment->comment}}
                      
                  @endif
                  @endforeach
                </td>
                @endforeach

               
               </tr>

             </tbody>
             </table>


             <table class="table  table-bordered table-sm">
               <thead>
                 <tr>
                   <th colspan="4">Head Teacher's  Comments</th>
                 </tr>
               </thead>
               <tbody>
                 <tr>
       
                  @foreach ($marks  as $mark_item)
                  <td colspan="4" height="70px">
  
                    @foreach ($headteacher_comments as $headteacher_comment)
                   
                    @if (in_array(number_format($mark_item->student_average), range($headteacher_comment->from,$headteacher_comment->to,  0.01)) )
                   {{$headteacher_comment->comment}} 
                        
                    @endif
                    @endforeach
                  </td>
                  @endforeach
                 
                 </tr>
 
               </tbody>
               </table>

               <table class="table  table-bordered table-sm">
                 <thead>
                   <tr>
                    <center> <th colspan="4">School Calendar</th></center>
                   </tr>
                 </thead>
                 <tbody>
                   <tr>
                     <td>Term Close&nbsp;&nbsp;Date</td>
                     <td colspan="3">Next Open Date</td>
                   </tr>
                   <tr>
                    <td class="text-bold">11 August 2023</td>
                    <td class="text-bold" colspan="3">12 September 2023</td>
                   </tr>
                 </tbody>
                 </table>

                 <table class="table  table-bordered table-sm">
                   <thead>
                     <tr>
                      <center> <th colspan="4">Days Absent</th></center>
                     </tr>
                   </thead>
                   <tbody>
                    
                     <tr>
                      <td >Days Absent In Term</td>
                      <td class="text-bold" colspan="1"> 


                        <?php
 
                        $attendance=\DB::select(\DB::raw("SELECT number_of_absent_days FROM cummulative_attendances WHERE student_id=".$item->student_id." AND term_id=3 order by id desc LIMIT 1"));
                    
                        
                  
                        foreach ($attendance as $attendance_key) {
                        echo $attendance_key->number_of_absent_days.' '.'days out of 72 Days';
                     
                         }
                  
                                   
                    
                    
                     ?>


                      </td>
                     </tr>
                   </tbody>
                   </table>

        </div>

        

           <div class="col text-center" id="contain"  style="   width: 40%;border: 1px solid black;font-size: 9.5px;">

               @foreach ($school as $school_item)
   
               <img src="{{$school_item->school_logo}}" height="180px" width="180px" class="img-fluid img-rounded  rounded mx-auto d-block" alt="">
           

              <h4 class="text-center font-weight-bold ">{{$school_item->school_name}}</h4>
               @endforeach

               <hr>
               @foreach ($student_details as $student_details_item)
                
               @if ($student_details_item->stream_name=="Grade 1" OR $student_details_item->stream_name=="Grade 2")
               <h5 class=" text-center font-weight-bold ">Foundation Phase</h5>
               @endif
               @if ($student_details_item->stream_name=="Grade 3" OR $student_details_item->stream_name=="Grade 4")
               <h5 class="text-center font-weight-bold ">Middle Phase</h5>
       
            @endif
            @if ($student_details_item->stream_name=="Grade 5")
            <h5 class=" text-center font-weight-bold ">Upper Phase</h5>
         @endif
         <div class="pic mx-auto" style=" width:120px; height:120px; border-radius:50%; background-image: url({{$student_details_item->student_image}}); background-position: center; background-size:100% auto; background-repeat: no-repeat;"></div>
         <p class="text-justify">
           <h6 class=" ">Student Name: <strong>{{$student_details_item->lastname}} {{$student_details_item->name}} {{$student_details_item->middlename}}</strong></h6>
           <h6 class="  ">Personal Identification Number: <strong>{{$student_details_item->pin}} </strong></h6>
           <h6 class=" ">Class: <strong>{{$student_details_item->grade_name}} Report </strong></h6>

           @foreach ($academic_sessions as $session)
           <h6 class="">Reporting Period: <strong>{{$session->term_name}} {{$session->academic_year}} </strong></h6>   
           @endforeach
         
         </p>
         <hr>
         <small id="shunifu" class="text-justify">&copy {{date('Y')}} CBE Report generated by the Shunifu Platform. Shunifu is Eswatini's leading school management platform, developed through the incubatory support of the Royal Science & Technology Park (RSTP). <br>7689 0726 +268 517 9400</small>
         
               @endforeach
   
          

             
   
           </div>



     
       
 
   
      </div>
     
        </div>

     </div>
        
        <div style="break-after:page"><p></div>
<p id="contain">

      
      
<div class="row">
  


        <div class="col-6">
          @foreach ($english as $item) 


        <div class="table-responsive">
         <table class="table  table-bordered table-sm" id="performance_table">
          <thead>
            <tr>
              
               <th colspan="2"><strong>{{$item->subject_name}} </strong></th>
             </tr>
             <tr>
                 <td>Strand</td>
                 <td>Grade</td>
               </tr>
       
              
           </thead>
       
           <tbody>

             @php
       
       
       if($item->stream_id==13 OR $item->stream_id==12 ){
       //foundation
       
       $strands=DB::table('strands')
             ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
             ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
             ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
             ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
             ->join('users', 'users.id', '=', 'cbe_marks.student_id')
             ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
             ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
             // ->where('academic_sessions.active',1)
             ->where('cbe_marks.student_id',$item->student_id)
             ->whereIn('teaching_loads.subject_id',[$item->subject_id])
             ->where('cbe_marks.term_id',$term_id)
             ->get();
       }else{
       
       
       
       $strands=DB::table('strands')
             ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
             ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
             ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
             ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
             ->join('users', 'users.id', '=', 'cbe_marks.student_id')
             ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
             ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
             // ->where('academic_sessions.active',1)
             ->where('cbe_marks.student_id',$item->student_id)
             ->where('teaching_loads.subject_id',$item->subject_id)
             ->where('cbe_marks.term_id',$term_id)
             ->get();
       
         
       }
       
       
       
       
       
       
       foreach ($strands as $strand) {
        echo '<tr>';
       
       echo '<td>'.$strand->strand.'</td>';
       echo '<td>'.$strand->assessement_grade.'</td>';
       
       echo '</tr>';
       
       
       }
       
       
       
       
       if($item->stream_id==13 OR $item->stream_id==12){
       
       }else{
       
       
       
       $marks=DB::table('student_subject_averages')
             
             ->join('teaching_loads', 'teaching_loads.id', '=', 'student_subject_averages.teaching_load_id')
             ->join('users', 'users.id', '=', 'student_subject_averages.student_id')
             ->where('student_subject_averages.student_id',$item->student_id)
             ->where('teaching_loads.subject_id',$item->subject_id)
             ->where('student_subject_averages.term_id',$term_id)
             ->get();
       
       foreach ($marks as $mark) {
         echo '<tr>';
       echo '<th rowspan="3">Achievement</th>'; 
       if(round($mark->ca_average)<"50"){
       
       echo '<td>Tests: '.'<strong><span class="text-danger">'.round($mark->ca_average).'%'.'</span></strong></td>';
       }else{
       echo '<td>Tests: '.'<strong><span class="text-primary">'.round($mark->ca_average).'%'.'</span></strong></td>';
       }
       echo '</tr>';
       echo '<tr>';
         if(round($mark->exam_mark)<"50"){
       
       echo '<td>Exam: '.'<strong><span class="text-danger">'.round($mark->exam_mark).'%'.'</span></strong></td>';
       }else{
       echo '<td>Exam: '.'<strong><span class="text-primary">'.round($mark->exam_mark).'%'.'</span></strong></td>';
       }
       
       echo '</tr>';
       echo '<tr>';
         if(round($mark->student_average)<"50"){
       
             echo '<td>Total: '.'<strong><span class="text-danger">'.round($mark->student_average).'%'.'</span></strong></td>';
         }else{
             echo '<td>Total: '.'<strong><span class="text-primary">'.round($mark->student_average).'%'.'</span></strong></td>';
         }
           
       echo '</tr>';

       echo '<tr> <thead>';
       echo '<th>'."Comment".'</th>';
       
       foreach ($comments  as $comment) {
         if( in_array(round($mark->student_average), range($comment->from,$comment->to)) ) 
                    
       
                     echo '<td>'.$comment->comment.'</td>';
                 
       }
       
       echo '</thead></tr>'; 
       }
       

       }
         
             @endphp

           </tbody>
        </table> 

       </div>
    
     
       @endforeach 
     </div>




 <div class="col-6">

  @foreach ($siswati as $item) 



  <div class="table-responsive">
   <table class="table  table-bordered table-sm" id="performance_table">
    <thead>
      <tr>
        
         <th colspan="2"><strong>{{$item->subject_name}} </strong></th>
       </tr>
       <tr>
           <td>Strand</td>
           <td>Grade</td>
         </tr>
 
        
     </thead>
 
     <tbody>

       @php
 
 
 if($item->stream_id==13 OR $item->stream_id==12 ){
 //foundation
 
 $strands=DB::table('strands')
       ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
       ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
       ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
       ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
       ->join('users', 'users.id', '=', 'cbe_marks.student_id')
       ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
       ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
       // ->where('academic_sessions.active',1)
       ->where('cbe_marks.student_id',$item->student_id)
       ->whereIn('teaching_loads.subject_id',[$item->subject_id])
       ->where('cbe_marks.term_id',$term_id)
       ->get();
 }else{
 
 
 
 $strands=DB::table('strands')
       ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
       ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
       ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
       ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
       ->join('users', 'users.id', '=', 'cbe_marks.student_id')
       ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
       ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
       // ->where('academic_sessions.active',1)
       ->where('cbe_marks.student_id',$item->student_id)
       ->where('teaching_loads.subject_id',$item->subject_id)
       ->where('cbe_marks.term_id',$term_id)
       ->get();
 
   
 }
 
 
 
 
 
 
 foreach ($strands as $strand) {
  echo '<tr>';
 
 echo '<td>'.$strand->strand.'</td>';
 echo '<td>'.$strand->assessement_grade.'</td>';
 
 echo '</tr>';
 
 
 }
 
 
 
 
 if($item->stream_id==13 OR $item->stream_id==12){
 
 }else{
 
 
 
 $marks=DB::table('student_subject_averages')
       
       ->join('teaching_loads', 'teaching_loads.id', '=', 'student_subject_averages.teaching_load_id')
       ->join('users', 'users.id', '=', 'student_subject_averages.student_id')
       ->where('student_subject_averages.student_id',$item->student_id)
       ->where('teaching_loads.subject_id',$item->subject_id)
       ->where('student_subject_averages.term_id',$term_id)
       ->get();
 
 foreach ($marks as $mark) {
   echo '<tr>';
 echo '<th rowspan="3">Achievement</th>'; 
 if(round($mark->ca_average)<"50"){
 
 echo '<td>Tests: '.'<strong><span class="text-danger">'.round($mark->ca_average).'%'.'</span></strong></td>';
 }else{
 echo '<td>Tests: '.'<strong><span class="text-primary">'.round($mark->ca_average).'%'.'</span></strong></td>';
 }
 echo '</tr>';
 echo '<tr>';
   if(round($mark->exam_mark)<"50"){
 
 echo '<td>Exam: '.'<strong><span class="text-danger">'.round($mark->exam_mark).'%'.'</span></strong></td>';
 }else{
 echo '<td>Exam: '.'<strong><span class="text-primary">'.round($mark->exam_mark).'%'.'</span></strong></td>';
 }
 
 echo '</tr>';
 echo '<tr>';
   if(round($mark->student_average)<"50"){
 
       echo '<td>Total: '.'<strong><span class="text-danger">'.round($mark->student_average).'%'.'</span></strong></td>';
   }else{
       echo '<td>Total: '.'<strong><span class="text-primary">'.round($mark->student_average).'%'.'</span></strong></td>';
   }
     
 echo '</tr>';

 echo '<tr> <thead>';
 echo '<th>'."Comment".'</th>';
 
 foreach ($comments  as $comment) {
   if( in_array(round($mark->student_average), range($comment->from,$comment->to)) ) 
              
 
               echo '<td>'.$comment->comment.'</td>';
           
 }
 
 echo '</thead></tr>'; 
 }
 

 }
   
       @endphp

     </tbody>
  </table> 
</div>
  @endforeach 

 </div>
</div>
 

<div class="row">
  <div class="col-4">

  @foreach ($maths as $item) 

<div class="table-responsive">
<table class="table  table-bordered table-sm" id="performance_table">
<thead>
  <tr>
    
     <th colspan="2"><strong>{{$item->subject_name}} </strong></th>
   </tr>
   <tr>
       <td>Strand</td>
       <td>Grade</td>
     </tr>

    
 </thead>

 <tbody>

   @php


if($item->stream_id==13 OR $item->stream_id==12 ){
//foundation

$strands=DB::table('strands')
   ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
   ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
   ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
   ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
   ->join('users', 'users.id', '=', 'cbe_marks.student_id')
   ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
   ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
   // ->where('academic_sessions.active',1)
   ->where('cbe_marks.student_id',$item->student_id)
   ->whereIn('teaching_loads.subject_id',[$item->subject_id])
   ->where('cbe_marks.term_id',$term_id)
   ->get();
}else{



$strands=DB::table('strands')
   ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
   ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
   ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
   ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
   ->join('users', 'users.id', '=', 'cbe_marks.student_id')
   ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
   ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
   // ->where('academic_sessions.active',1)
   ->where('cbe_marks.student_id',$item->student_id)
   ->where('teaching_loads.subject_id',$item->subject_id)
   ->where('cbe_marks.term_id',$term_id)
   ->get();


}






foreach ($strands as $strand) {
echo '<tr>';

echo '<td>'.$strand->strand.'</td>';
echo '<td>'.$strand->assessement_grade.'</td>';

echo '</tr>';


}




if($item->stream_id==13 OR $item->stream_id==12){

}else{



$marks=DB::table('student_subject_averages')
   
   ->join('teaching_loads', 'teaching_loads.id', '=', 'student_subject_averages.teaching_load_id')
   ->join('users', 'users.id', '=', 'student_subject_averages.student_id')
   ->where('student_subject_averages.student_id',$item->student_id)
   ->where('teaching_loads.subject_id',$item->subject_id)
   ->where('student_subject_averages.term_id',$term_id)
   ->get();

foreach ($marks as $mark) {
echo '<tr>';
echo '<th rowspan="3">Achievement</th>'; 
if(round($mark->ca_average)<"50"){

echo '<td>Tests: '.'<strong><span class="text-danger">'.round($mark->ca_average).'%'.'</span></strong></td>';
}else{
echo '<td>Tests: '.'<strong><span class="text-primary">'.round($mark->ca_average).'%'.'</span></strong></td>';
}
echo '</tr>';
echo '<tr>';
if(round($mark->exam_mark)<"50"){

echo '<td>Exam: '.'<strong><span class="text-danger">'.round($mark->exam_mark).'%'.'</span></strong></td>';
}else{
echo '<td>Exam: '.'<strong><span class="text-primary">'.round($mark->exam_mark).'%'.'</span></strong></td>';
}

echo '</tr>';
echo '<tr>';
if(round($mark->student_average)<"50"){

   echo '<td>Total: '.'<strong><span class="text-danger">'.round($mark->student_average).'%'.'</span></strong></td>';
}else{
   echo '<td>Total: '.'<strong><span class="text-primary">'.round($mark->student_average).'%'.'</span></strong></td>';
}
 
echo '</tr>';

echo '<tr> <thead>';
echo '<th>'."Comment".'</th>';

foreach ($comments  as $comment) {
if( in_array(round($mark->student_average), range($comment->from,$comment->to)) ) 
          

           echo '<td>'.$comment->comment.'</td>';
       
}

echo '</thead></tr>'; 
}


}

   @endphp

 </tbody>
</table> 

</div>

@endforeach 
  </div>








  <div class="col-4">

    @foreach ($ict as $item) 
  
  <div class="table-responsive">
  <table class="table  table-bordered table-sm" id="performance_table">
  <thead>
    <tr>
      
       <th colspan="2"><strong>{{$item->subject_name}} </strong></th>
     </tr>
     <tr>
         <td>Strand</td>
         <td>Grade</td>
       </tr>
  
      
   </thead>
  
   <tbody>
  
     @php
  
  
  if($item->stream_id==13 OR $item->stream_id==12 ){
  //foundation
  
  $strands=DB::table('strands')
     ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
     ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
     ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
     ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
     ->join('users', 'users.id', '=', 'cbe_marks.student_id')
     ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
     ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
     // ->where('academic_sessions.active',1)
     ->where('cbe_marks.student_id',$item->student_id)
     ->whereIn('teaching_loads.subject_id',[$item->subject_id])
     ->where('cbe_marks.term_id',$term_id)
     ->get();
  }else{
  
  
  
  $strands=DB::table('strands')
     ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
     ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
     ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
     ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
     ->join('users', 'users.id', '=', 'cbe_marks.student_id')
     ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
     ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
     // ->where('academic_sessions.active',1)
     ->where('cbe_marks.student_id',$item->student_id)
     ->where('teaching_loads.subject_id',$item->subject_id)
     ->where('cbe_marks.term_id',$term_id)
     ->get();
  
  
  }
  
  
  
  
  
  
  foreach ($strands as $strand) {
  echo '<tr>';
  
  echo '<td>'.$strand->strand.'</td>';
  echo '<td>'.$strand->assessement_grade.'</td>';
  
  echo '</tr>';
  
  
  }
  
  
  
  
  if($item->stream_id==13 OR $item->stream_id==12){
  
  }else{
  
  
  
  $marks=DB::table('student_subject_averages')
     
     ->join('teaching_loads', 'teaching_loads.id', '=', 'student_subject_averages.teaching_load_id')
     ->join('users', 'users.id', '=', 'student_subject_averages.student_id')
     ->where('student_subject_averages.student_id',$item->student_id)
     ->where('teaching_loads.subject_id',$item->subject_id)
     ->where('student_subject_averages.term_id',$term_id)
     ->get();
  
  foreach ($marks as $mark) {
  echo '<tr>';
  echo '<th rowspan="3">Achievement</th>'; 
  if(round($mark->ca_average)<"50"){
  
  echo '<td>Tests: '.'<strong><span class="text-danger">'.round($mark->ca_average).'%'.'</span></strong></td>';
  }else{
  echo '<td>Tests: '.'<strong><span class="text-primary">'.round($mark->ca_average).'%'.'</span></strong></td>';
  }
  echo '</tr>';
  echo '<tr>';
  if(round($mark->exam_mark)<"50"){
  
  echo '<td>Exam: '.'<strong><span class="text-danger">'.round($mark->exam_mark).'%'.'</span></strong></td>';
  }else{
  echo '<td>Exam: '.'<strong><span class="text-primary">'.round($mark->exam_mark).'%'.'</span></strong></td>';
  }
  
  echo '</tr>';
  echo '<tr>';
  if(round($mark->student_average)<"50"){
  
     echo '<td>Total: '.'<strong><span class="text-danger">'.round($mark->student_average).'%'.'</span></strong></td>';
  }else{
     echo '<td>Total: '.'<strong><span class="text-primary">'.round($mark->student_average).'%'.'</span></strong></td>';
  }
   
  echo '</tr>';
  
  echo '<tr> <thead>';
  echo '<th>'."Comment".'</th>';
  
  foreach ($comments  as $comment) {
  if( in_array(round($mark->student_average), range($comment->from,$comment->to)) ) 
            
  
             echo '<td>'.$comment->comment.'</td>';
         
  }
  
  echo '</thead></tr>'; 
  }
  
  
  }
  
     @endphp
  
   </tbody>
  </table> 
  
  </div>
  
  @endforeach 
    </div>





  <div class="col-4">

    @foreach ($science as $item) 
  
  <div class="table-responsive">
  <table class="table  table-bordered table-sm" id="performance_table">
  <thead>
    <tr>
      
       <th colspan="2"><strong>{{$item->subject_name}} </strong></th>
     </tr>
     <tr>
         <td>Strand</td>
         <td>Grade</td>
       </tr>
  
      
   </thead>
  
   <tbody>
  
     @php
  
  
  if($item->stream_id==13 OR $item->stream_id==12 ){
  //foundation
  
  $strands=DB::table('strands')
     ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
     ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
     ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
     ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
     ->join('users', 'users.id', '=', 'cbe_marks.student_id')
     ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
     ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
     // ->where('academic_sessions.active',1)
     ->where('cbe_marks.student_id',$item->student_id)
     ->whereIn('teaching_loads.subject_id',[$item->subject_id])
     ->where('cbe_marks.term_id',$term_id)
     ->get();
  }else{
  
  
  
  $strands=DB::table('strands')
     ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
     ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
     ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
     ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
     ->join('users', 'users.id', '=', 'cbe_marks.student_id')
     ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
     ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
     // ->where('academic_sessions.active',1)
     ->where('cbe_marks.student_id',$item->student_id)
     ->where('teaching_loads.subject_id',$item->subject_id)
     ->where('cbe_marks.term_id',$term_id)
     ->get();
  
  
  }
  
  
  
  
  
  
  foreach ($strands as $strand) {
  echo '<tr>';
  
  echo '<td>'.$strand->strand.'</td>';
  echo '<td>'.$strand->assessement_grade.'</td>';
  
  echo '</tr>';
  
  
  }
  
  
  
  
  if($item->stream_id==13 OR $item->stream_id==12){
  
  }else{
  
  
  
  $marks=DB::table('student_subject_averages')
     
     ->join('teaching_loads', 'teaching_loads.id', '=', 'student_subject_averages.teaching_load_id')
     ->join('users', 'users.id', '=', 'student_subject_averages.student_id')
     ->where('student_subject_averages.student_id',$item->student_id)
     ->where('teaching_loads.subject_id',$item->subject_id)
     ->where('student_subject_averages.term_id',$term_id)
     ->get();
  
  foreach ($marks as $mark) {
  echo '<tr>';
  echo '<th rowspan="3">Achievement</th>'; 
  if(round($mark->ca_average)<"50"){
  
  echo '<td>Tests: '.'<strong><span class="text-danger">'.round($mark->ca_average).'%'.'</span></strong></td>';
  }else{
  echo '<td>Tests: '.'<strong><span class="text-primary">'.round($mark->ca_average).'%'.'</span></strong></td>';
  }
  echo '</tr>';
  echo '<tr>';
  if(round($mark->exam_mark)<"50"){
  
  echo '<td>Exam: '.'<strong><span class="text-danger">'.round($mark->exam_mark).'%'.'</span></strong></td>';
  }else{
  echo '<td>Exam: '.'<strong><span class="text-primary">'.round($mark->exam_mark).'%'.'</span></strong></td>';
  }
  
  echo '</tr>';
  echo '<tr>';
  if(round($mark->student_average)<"50"){
  
     echo '<td>Total: '.'<strong><span class="text-danger">'.round($mark->student_average).'%'.'</span></strong></td>';
  }else{
     echo '<td>Total: '.'<strong><span class="text-primary">'.round($mark->student_average).'%'.'</span></strong></td>';
  }
   
  echo '</tr>';
  
  echo '<tr> <thead>';
  echo '<th>'."Comment".'</th>';
  
  foreach ($comments  as $comment) {
  if( in_array(round($mark->student_average), range($comment->from,$comment->to)) ) 
            
  
             echo '<td>'.$comment->comment.'</td>';
         
  }
  
  echo '</thead></tr>'; 
  }
  
  
  }
  
     @endphp
  
   </tbody>
  </table> 
  
  </div>
  
  @endforeach 
    </div>
    <p></p>

  
</div>
<div style="page-break-before: always"></div>
<div class="row">

  <div class="col-6">

    @foreach ($expressive_art as $item) 
  
  <div class="table-responsive">
  <table class="table  table-bordered table-sm" id="performance_table">
  <thead>
    <tr>
      
       <th colspan="2"><strong>{{$item->subject_name}} </strong></th>
     </tr>
     <tr>
         <td>Strand</td>
         <td>Grade</td>
       </tr>
  
      
   </thead>
  
   <tbody>
  
     @php
  
  
  if($item->stream_id==13 OR $item->stream_id==12 ){
  //foundation
  
  $strands=DB::table('strands')
     ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
     ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
     ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
     ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
     ->join('users', 'users.id', '=', 'cbe_marks.student_id')
     ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
     ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
     // ->where('academic_sessions.active',1)
     ->where('cbe_marks.student_id',$item->student_id)
     ->whereIn('teaching_loads.subject_id',[$item->subject_id])
     ->where('cbe_marks.term_id',$term_id)
     ->get();
  }else{
  
  
  
  $strands=DB::table('strands')
     ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
     ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
     ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
     ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
     ->join('users', 'users.id', '=', 'cbe_marks.student_id')
     ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
     ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
     // ->where('academic_sessions.active',1)
     ->where('cbe_marks.student_id',$item->student_id)
     ->where('teaching_loads.subject_id',$item->subject_id)
     ->where('cbe_marks.term_id',$term_id)
     ->get();
  
  
  }
  
  
  
  
  
  
  foreach ($strands as $strand) {
  echo '<tr>';
  
  echo '<td>'.$strand->strand.'</td>';
  echo '<td>'.$strand->assessement_grade.'</td>';
  
  echo '</tr>';
  
  
  }
  
  
  
  
  if($item->stream_id==13 OR $item->stream_id==12){
  
  }else{
  
  
  
  $marks=DB::table('student_subject_averages')
     
     ->join('teaching_loads', 'teaching_loads.id', '=', 'student_subject_averages.teaching_load_id')
     ->join('users', 'users.id', '=', 'student_subject_averages.student_id')
     ->where('student_subject_averages.student_id',$item->student_id)
     ->where('teaching_loads.subject_id',$item->subject_id)
     ->where('student_subject_averages.term_id',$term_id)
     ->get();
  
  foreach ($marks as $mark) {
  echo '<tr>';
  echo '<th rowspan="3">Achievement</th>'; 
  if(round($mark->ca_average)<"50"){
  
  echo '<td>Tests: '.'<strong><span class="text-danger">'.round($mark->ca_average).'%'.'</span></strong></td>';
  }else{
  echo '<td>Tests: '.'<strong><span class="text-primary">'.round($mark->ca_average).'%'.'</span></strong></td>';
  }
  echo '</tr>';
  echo '<tr>';
  if(round($mark->exam_mark)<"50"){
  
  echo '<td>Exam: '.'<strong><span class="text-danger">'.round($mark->exam_mark).'%'.'</span></strong></td>';
  }else{
  echo '<td>Exam: '.'<strong><span class="text-primary">'.round($mark->exam_mark).'%'.'</span></strong></td>';
  }
  
  echo '</tr>';
  echo '<tr>';
  if(round($mark->student_average)<"50"){
  
     echo '<td>Total: '.'<strong><span class="text-danger">'.round($mark->student_average).'%'.'</span></strong></td>';
  }else{
     echo '<td>Total: '.'<strong><span class="text-primary">'.round($mark->student_average).'%'.'</span></strong></td>';
  }
   
  echo '</tr>';
  
  echo '<tr> <thead>';
  echo '<th>'."Comment".'</th>';
  
  foreach ($comments  as $comment) {
  if( in_array(round($mark->student_average), range($comment->from,$comment->to)) ) 
            
  
             echo '<td>'.$comment->comment.'</td>';
         
  }
  
  echo '</thead></tr>'; 
  }
  
  
  }
  
     @endphp
  
   </tbody>
  </table> 
  
  </div>
  
  @endforeach 
    </div>




@if ($stream==8)
    


    <div class="col-6">

      @foreach ($agric as $item) 
    
    <div class="table-responsive">
    <table class="table  table-bordered table-sm" id="performance_table">
    <thead>
      <tr>
        
         <th colspan="2"><strong>{{$item->subject_name}} </strong></th>
       </tr>
       <tr>
           <td>Strand</td>
           <td>Grade</td>
         </tr>
    
        
     </thead>
    
     <tbody>
    
       @php
    
    
    if($item->stream_id==13 OR $item->stream_id==12 ){
    //foundation
    
    $strands=DB::table('strands')
       ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
       ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
       ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
       ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
       ->join('users', 'users.id', '=', 'cbe_marks.student_id')
       ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
       ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
       // ->where('academic_sessions.active',1)
       ->where('cbe_marks.student_id',$item->student_id)
       ->whereIn('teaching_loads.subject_id',[$item->subject_id])
       ->where('cbe_marks.term_id',$term_id)
       ->get();
    }else{
    
    
    
    $strands=DB::table('strands')
       ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
       ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
       ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
       ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
       ->join('users', 'users.id', '=', 'cbe_marks.student_id')
       ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
       ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
       // ->where('academic_sessions.active',1)
       ->where('cbe_marks.student_id',$item->student_id)
       ->where('teaching_loads.subject_id',$item->subject_id)
       ->where('cbe_marks.term_id',$term_id)
       ->get();
    
    
    }
    
    
    
    
    
    
    foreach ($strands as $strand) {
    echo '<tr>';
    
    echo '<td>'.$strand->strand.'</td>';
    echo '<td>'.$strand->assessement_grade.'</td>';
    
    echo '</tr>';
    
    
    }
    
    
    
    
    if($item->stream_id==13 OR $item->stream_id==12){
    
    }else{
    
    
    
    $marks=DB::table('student_subject_averages')
       
       ->join('teaching_loads', 'teaching_loads.id', '=', 'student_subject_averages.teaching_load_id')
       ->join('users', 'users.id', '=', 'student_subject_averages.student_id')
       ->where('student_subject_averages.student_id',$item->student_id)
       ->where('teaching_loads.subject_id',$item->subject_id)
       ->where('student_subject_averages.term_id',$term_id)
       ->get();
    
    foreach ($marks as $mark) {
    echo '<tr>';
    echo '<th rowspan="3">Achievement</th>'; 
    if(round($mark->ca_average)<"50"){
    
    echo '<td>Tests: '.'<strong><span class="text-danger">'.round($mark->ca_average).'%'.'</span></strong></td>';
    }else{
    echo '<td>Tests: '.'<strong><span class="text-primary">'.round($mark->ca_average).'%'.'</span></strong></td>';
    }
    echo '</tr>';
    echo '<tr>';
    if(round($mark->exam_mark)<"50"){
    
    echo '<td>Exam: '.'<strong><span class="text-danger">'.round($mark->exam_mark).'%'.'</span></strong></td>';
    }else{
    echo '<td>Exam: '.'<strong><span class="text-primary">'.round($mark->exam_mark).'%'.'</span></strong></td>';
    }
    
    echo '</tr>';
    echo '<tr>';
    if(round($mark->student_average)<"50"){
    
       echo '<td>Total: '.'<strong><span class="text-danger">'.round($mark->student_average).'%'.'</span></strong></td>';
    }else{
       echo '<td>Total: '.'<strong><span class="text-primary">'.round($mark->student_average).'%'.'</span></strong></td>';
    }
     
    echo '</tr>';
    
    echo '<tr> <thead>';
    echo '<th>'."Comment".'</th>';
    
    foreach ($comments  as $comment) {
    if( in_array(round($mark->student_average), range($comment->from,$comment->to)) ) 
              
    
               echo '<td>'.$comment->comment.'</td>';
           
    }
    
    echo '</thead></tr>'; 
    }
    
    
    }
    
       @endphp
    
     </tbody>
    </table> 
    
    </div>
    
    @endforeach 
      </div>



      @else

      <div class="col-6">

        @foreach ($general_studies as $item) 
      
      <div class="table-responsive">
      <table class="table  table-bordered table-sm" id="performance_table">
      <thead>
        <tr>
          
           <th colspan="2"><strong>{{$item->subject_name}} </strong></th>
         </tr>
         <tr>
             <td>Strand</td>
             <td>Grade</td>
           </tr>
      
          
       </thead>
      
       <tbody>
      
         @php
      
      
      if($item->stream_id==13 OR $item->stream_id==12 ){
      //foundation
      
      $strands=DB::table('strands')
         ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
         ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
         ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
         ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
         ->join('users', 'users.id', '=', 'cbe_marks.student_id')
         ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
         ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
         // ->where('academic_sessions.active',1)
         ->where('cbe_marks.student_id',$item->student_id)
         ->whereIn('teaching_loads.subject_id',[$item->subject_id])
         ->where('cbe_marks.term_id',$term_id)
         ->get();
      }else{
      
      
      
      $strands=DB::table('strands')
         ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
         ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
         ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
         ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
         ->join('users', 'users.id', '=', 'cbe_marks.student_id')
         ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
         ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade')
         // ->where('academic_sessions.active',1)
         ->where('cbe_marks.student_id',$item->student_id)
         ->where('teaching_loads.subject_id',$item->subject_id)
         ->where('cbe_marks.term_id',$term_id)
         ->get();
      
      
      }
      
      
      
      
      
      
      foreach ($strands as $strand) {
      echo '<tr>';
      
      echo '<td>'.$strand->strand.'</td>';
      echo '<td>'.$strand->assessement_grade.'</td>';
      
      echo '</tr>';
      
      
      }
      
      
      
      
      if($item->stream_id==13 OR $item->stream_id==12){
      
      }else{
      
      
      
      $marks=DB::table('student_subject_averages')
         
         ->join('teaching_loads', 'teaching_loads.id', '=', 'student_subject_averages.teaching_load_id')
         ->join('users', 'users.id', '=', 'student_subject_averages.student_id')
         ->where('student_subject_averages.student_id',$item->student_id)
         ->where('teaching_loads.subject_id',$item->subject_id)
         ->where('student_subject_averages.term_id',$term_id)
         ->get();
      
      foreach ($marks as $mark) {
      echo '<tr>';
      echo '<th rowspan="3">Achievement</th>'; 
      if(round($mark->ca_average)<"50"){
      
      echo '<td>Tests: '.'<strong><span class="text-danger">'.round($mark->ca_average).'%'.'</span></strong></td>';
      }else{
      echo '<td>Tests: '.'<strong><span class="text-primary">'.round($mark->ca_average).'%'.'</span></strong></td>';
      }
      echo '</tr>';
      echo '<tr>';
      if(round($mark->exam_mark)<"50"){
      
      echo '<td>Exam: '.'<strong><span class="text-danger">'.round($mark->exam_mark).'%'.'</span></strong></td>';
      }else{
      echo '<td>Exam: '.'<strong><span class="text-primary">'.round($mark->exam_mark).'%'.'</span></strong></td>';
      }
      
      echo '</tr>';
      echo '<tr>';
      if(round($mark->student_average)<"50"){
      
         echo '<td>Total: '.'<strong><span class="text-danger">'.round($mark->student_average).'%'.'</span></strong></td>';
      }else{
         echo '<td>Total: '.'<strong><span class="text-primary">'.round($mark->student_average).'%'.'</span></strong></td>';
      }
       
      echo '</tr>';
      
      echo '<tr> <thead>';
      echo '<th>'."Comment".'</th>';
      
      foreach ($comments  as $comment) {
      if( in_array(round($mark->student_average), range($comment->from,$comment->to)) ) 
                
      
                 echo '<td>'.$comment->comment.'</td>';
             
      }
      
      echo '</thead></tr>'; 
      }
      
      
      }
      
         @endphp
      
       </tbody>
      </table> 
      
      </div>
      
      @endforeach 
        </div>
    
      @endif




</div>



{{-- </div> --}}


{{-- <div> end of row --}}
  

 



</p>

  


</x-app-layout>