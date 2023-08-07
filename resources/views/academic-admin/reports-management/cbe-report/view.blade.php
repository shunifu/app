<x-app-layout>

   <style>

  
        /* overflow: hidden;
  position: relative; */
/* 
  @media print {
        font-size: 14px;

        @page {size: A4 landscape; }

    /* .row.no-gutter {
  margin-left: 0;
  margin-right: 0;
} */
/* .row.no-gutter [class*='col-']:not(:first-child),
.row.no-gutter [class*='col-']:not(:last-child) {
  padding-right: 0;
  padding-left: 0;
} */
/* .row > div {
  background: rgb(250, 250, 250);
  border: 0.5px solid;
} */

      /* } */ 

      @media print {

@page {
    size: landscape letter;
    border: red;
   
 }
 body{
    font-size: 13px;
    -webkit-print-color-adjust: exact !important;

   
 }


}
.row  {
   
   /* outline:1px solid #ccc; */
 
}


   </style>


    


    <div class="container-fluid d-flex flex-column bg-white">
        <div class="row">

         <div class="col">

            <div class="row">
                <div class="col">
                   
                       
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


if($item->stream_id==1 OR $item->stream_id==2 ){
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
        ->where('cbe_marks.term_id',3)
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
        ->where('cbe_marks.term_id',3)
        ->get();

    // $strands=DB::table('student_subject_averages')
    //     ->join('cbe_marks', 'cbe_marks.strand_id', '=', 'strands.id')
    //     ->join('teaching_loads', 'teaching_loads.id', '=', 'cbe_marks.teaching_load_id')
      
    //     ->join('subjects', 'subjects.id', '=', 'teaching_loads.subject_id')
    //     ->join('grades', 'grades.id', '=', 'teaching_loads.class_id')
    //     ->join('users', 'users.id', '=', 'cbe_marks.student_id')
    //     ->join('student_subject_averages','student_subject_averages.student_id',  '=', 'users.id')
    //     ->join('grades_students', 'grades_students.student_id', '=', 'cbe_marks.student_id')
    //     ->select('strands.id as strand_id','strands.strand','users.id as student_id', 'users.name', 'users.middlename', 'users.lastname' ,'grades.id as grade_id', 'grades.grade_name as grade_name', 'subjects.id as subject_id','subjects.subject_name', 'cbe_marks.grade as assessement_grade', 'student_subject_averages.ca_average as ca', 'student_subject_averages.exam_mark as exam', 'student_subject_averages.student_average as final_mark')
    //     // ->where('academic_sessions.active',1)
    //     ->where('cbe_marks.student_id',$item->student_id)
    //     ->where('teaching_loads.subject_id',$item->subject_id)
    //     ->where('student_subject_averages.term_id',3)
    //     // ->where('student_subject_averages.student_id','=','cbe_marks.student_id')
    //     ->where('student_subject_averages.student_id',$item->student_id)
    //     ->where('cbe_marks.term_id',3)
    //     ->get();
}






foreach ($strands as $strand) {
   echo '<tr>';

echo '<td>'.$strand->strand.'</td>';
echo '<td>'.$strand->assessement_grade.'</td>';

echo '</tr>';


}




if($item->stream_id==1 OR $item->stream_id==2){

}else{



$marks=DB::table('student_subject_averages')
        
        ->join('teaching_loads', 'teaching_loads.id', '=', 'student_subject_averages.teaching_load_id')
        ->join('users', 'users.id', '=', 'student_subject_averages.student_id')
        ->where('student_subject_averages.student_id',$item->student_id)
        ->where('teaching_loads.subject_id',$item->subject_id)
        ->where('student_subject_averages.term_id',3)
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




                   @endphp 
                </div>
            </div>

         </div>

            <div class="col text-center">

                @foreach ($school as $school_item)
    
                <img src="{{$school_item->school_logo}}" height="180px" width="180px" class="img-fluid img-rounded  rounded mx-auto d-block" alt="">
            

               <h2 class="text-center font-weight-bold ">{{$school_item->school_name}}</h2>
                @endforeach

                <hr>
                @foreach ($student_details as $student_details_item)
                 
                @if ($student_details_item->stream_name=="Grade 1" OR $student_details_item->stream_name=="Grade 2")
                <h2 class=" text-center font-weight-bold ">Foundation Phase</h2>
                @endif
                @if ($student_details_item->stream_name=="Grade 3" OR $student_details_item->stream_name=="Grade 4")
                <h1 class="display-5 text-center font-weight-bold ">Middle Phase</h1>
        
             @endif
             @if ($student_details_item->stream_name=="Grade 5")
             <h1 class="display-5 text-center font-weight-bold ">Upper Phase</h1>
          @endif
          <div class="pic mx-auto" style=" width:120px; height:120px; border-radius:50%; background-image: url({{$student_details_item->student_image}}); background-position: center; background-size:100% auto; background-repeat: no-repeat;"></div>
          <p class="text-justify">
            <h5 class=" ">Student Name: <strong>{{$student_details_item->lastname}} {{$student_details_item->name}} {{$student_details_item->middlename}}</strong></h3>
            <h5 class="  ">Personal Identification Number: <strong>{{$student_details_item->pin}} </strong></h5>
            <h5 class=" ">Class: <strong>{{$student_details_item->grade_name}} Report </strong></h5>

            @foreach ($academic_sessions as $session)
            <h5 class="">Reporting Period: <strong>{{$session->term_name}} {{$session->academic_year}} </strong></h5>   
            @endforeach
          
          </p>
          <hr>
          <small class="text-justify">&copy {{date('Y')}} CBE Report generated by the Shunifu Platform. Shunifu is Eswatini's leading school management platform, developed through the incubatory support of the Royal Science & Technology Park (RSTP). <br>7689 0726 +268 517 9400</small>
          
                @endforeach
    
           

              
    
            </div>



        </div>
        
  
    
       </div>
      




   

 
</x-app-layout>