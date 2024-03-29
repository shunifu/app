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







foreach ($strands as $strand) {
echo '<tr>';

echo '<td>'.$strand->strand.'</td>';
echo '<td>'.$strand->assessement_grade.'</td>';

echo '</tr>';


}




if($item->stream_id==1 OR $item->stream_id==2){

    $strands_array = array();
foreach ($strands as $h) {
    $strands_array[] = $h->assessement_grade;
}
$uique_arrays = array_count_values($strands_array);
// dd(array_sum($uique_arrays));

$total_strands=array_sum($uique_arrays);
$descriptor_keys = collect($uique_arrays);

$keys = $descriptor_keys->keys();


$weight=[];
foreach ($keys as $key => $value) {

   if($value=="Excellent"){
    $weight[]=5;
   }

   if($value=="Very Good"){
    $weight[]=4;
   }

   if($value=="Good"){
    $weight[]=3;
   }
    
   if($value=="Sufficient"){
    $weight[]=2;
   }

   if($value=="Not Sufficient"){
    $weight[]=1;
   }

  
}
$weight_sum=array_sum($weight);
$score=($weight_sum/$total_strands)*100;

echo '<tr> <thead>';
echo '<th>'."Comment".'</th>';

foreach ($comments  as $comment) {
   if( in_array(round($score), range($comment->from,$comment->to)) ) 
     echo '<td>'.$comment->comment.'</td>';
           
}

echo '</thead></tr>'; 

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
if(round($mark->ca_average)<$pass_mark){

echo '<td>Tests: '.'<strong><span class="text-danger">'.round($mark->ca_average).'%'.'</span></strong></td>';
}else{
echo '<td>Tests: '.'<strong><span class="text-primary">'.round($mark->ca_average).'%'.'</span></strong></td>';
}
echo '</tr>';
echo '<tr>';
 if(round($mark->exam_mark)<$pass_mark){

echo '<td>Exam: '.'<strong><span class="text-danger">'.round($mark->exam_mark).'%'.'</span></strong></td>';
}else{
echo '<td>Exam: '.'<strong><span class="text-primary">'.round($mark->exam_mark).'%'.'</span></strong></td>';
}

echo '</tr>';
echo '<tr>';
 if(round($mark->student_average)<$pass_mark){

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