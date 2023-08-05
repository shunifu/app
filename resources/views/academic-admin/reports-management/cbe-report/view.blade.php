<x-app-layout>

   <style>

    body{
        overflow: hidden;
  position: relative;
    }
    .row.no-gutter {
  margin-left: 0;
  margin-right: 0;
}
.row.no-gutter [class*='col-']:not(:first-child),
.row.no-gutter [class*='col-']:not(:last-child) {
  padding-right: 0;
  padding-left: 0;
}
.row > div {
  background: rgb(250, 250, 250);
  border: 0.5px solid;
}
   </style>

{{-- <style type="text/css" media="print">
    @page { 
        size: landscape;
    }
    body { 
        writing-mode: tb-rl;
    }
</style> --}}

    <div class="container-fluid bg-white">
        <div class="row "style="display: flex; flex-wrap: wrap">
            <div class="col-12" id="front_page">

                @foreach ($school as $school_item)
    
                <img src="{{$school_item->school_logo}}" class="img-fluid img-rounded" alt="">
               <h4 class="font-weight-bold">{{$school_item->school_name}}</h4> 
                    
                @endforeach

                @foreach ($student_details as $student_details_item)
                 
                @if ($student_details_item->stream_name=="Grade 1" OR $student_details_item->stream_name=="Grade 2")
                   Foundation Phase
                @endif
                @if ($student_details_item->stream_name=="Grade 3" OR $student_details_item->stream_name=="Grade 4")
                Middle Phase
           

             @endif
             @if ($student_details_item->stream_name=="Grade 5")
             Upper Phase
          @endif
{{$student_details_item->lastname}} {{$student_details_item->name}} {{$student_details_item->middlename}}
                
                @endforeach
    

                <img src="{{$student_details_item->student_image}}" class="img-responsive img-cicle img-rounded"
                style="max-height: 350px; max-width: 350px;">
{{$student_details_item->stream_name}}
    
            </div>
        </div>
        
  
     
       <hr style="page-break-before: always">
            <div class="row  gutters-2">

@foreach ($student_data as $item)
    


        <div class="col-6  padding-0">

    
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
echo '<tr> <thead>';
echo '<th>'."Comment".'</th>';
echo '<td>'.'kjhhjk'.'</td>';
echo '</thead></tr>';  

        @endphp

        
        
         
         
      </tbody>
   </table>
   </div>

   </div>
   @endforeach

        </div>

    
            

       </div>
      


    </div>

   

 
</x-app-layout>