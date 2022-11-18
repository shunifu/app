<x-app-layout>
  <x-slot name="header">

  </x-slot>
  <div class="row">
      <div class="col-md-12">
        <div class="card card-light">
            <div class="p-3 no-print">
              <a href="/users/student/manage">Back</a>
            </div>
            
            <div class="card-header no-print">
              <h3 class="card-title">Stream Analytics</h3>
            </div>
          
          <div class="card-body">
           
            <hr>
            <div class="p-4"></div>

            @if ($passed->isEmpty() OR $failed->isEmpty())
            <h3 class="small lead text-muted text-center ">No Analytics Found.</h3>
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<lottie-player src="https://assets2.lottiefiles.com/packages/lf20_x62chJ.json" mode="bounce" background="transparent"  speed="1"  style="width: 300px; height: 300px; margin-left:auto; margin-right:auto"   loop  autoplay></lottie-player>
            @else
            <div class="table-responsive">
<div class="col-md-12 mx-auto">
@foreach (\App\Models\School::all() as $item)
<img src={{$item->school_letter_head}}  class="mx-auto d-block" />
@endforeach
</div>
             
<div class="row">
<div class="col pb-4">
{{-- <h3>{{$title->stream_name}}</h3> --}}
</div>

</div>


<div class="row">
  <div class="col">
    Those that passed.
    <hr>
    <table class="table table-sm table-compact">
      <thead class="thead-light ">
  <tr>
      <th>Position</th>
      <th>Class</th>
      <th>Student Name</th>
      <th>Student Average</th>
   
    
  </tr>
  </thead>
  <tbody>
 
       @foreach ($passed as $item)
          <tr>

            <td>
              @if ($tie_type=="share")

                        @if ($key=="class_based")

                        @php
                        $sql_piece="WHERE sc.student_class=".$classofstudent."  AND sc.assessement_id=".$assessement_id."";
                        @endphp
                        
                        @endif
    
                        @if ($key=="stream_based")
                       
                        @php
                        $sql_piece="WHERE sc.student_stream=".$streamofstudent."  AND sc.assessement_id=".$assessement_id."";
                        @endphp

                        @endif
                        @php
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
                        ".$sql_piece."
                        ORDER BY sc.student_average DESC ) as sub
                        WHERE sub.student_id=".$item->learner_id.""));
                        foreach ($student_position as $key) {
                        echo $key->student_position;
                        }
                        @endphp
                        @endif


                        @if ($tie_type=="share_n_+_1")
                    

                        @if ($key=="class_based")

                        @php
                       $sql_piece="where assessement_progress_reports.assessement_id=".$assessement_id." AND assessement_progress_reports.student_class=".$classofstudent."";
                        @endphp
                      
                        @endif

                        @if ($key=="stream_based")

                        @php
                        $sql_piece="where assessement_progress_reports.assessement_id=".$assessement_id." AND assessement_progress_reports.student_stream=".$streamofstudent."";
                        @endphp

                        @endif


                        @php


                    
                    $student_position=\DB::select(\DB::raw("select t.*
from (select assessement_progress_reports.student_id,assessement_progress_reports.student_average, rank() over (order by assessement_progress_reports.student_average desc) as student_position
from assessement_progress_reports ".$sql_piece.") t
where student_id = ".$item->learner_id.""));
                        foreach ($student_position as $key) {
                        echo $key->student_position;
                        }
 
                        @endphp
                    
                
                        @endif

                        @if ($tie_type=="sequential") 
                        @php
                        
                        $student_position=\DB::select(\DB::raw("SELECT * FROM
                        (SELECT
                        (@rownum := @rownum + 1) AS student_position,
                        student_id,
                        student_average, 
                        assessement_id
                        FROM assessement_progress_reports a
                        CROSS JOIN (SELECT @rownum := 0) params
                        WHERE student_stream =".$streamofstudent." AND assessement_id=".$assessement_id."
                        ORDER BY student_average DESC) as sub
                        WHERE sub.student_id=".$item->learner_id.""));
                        foreach ($student_position as $key) {
                        echo $key->student_position;
                        }
                        
                        
                        @endphp
                        @endif
            </td>
      
          <td class="vertical-middle">{{$item->grade_name}} </td>
          <td class="vertical-middle">{{$item->lastname}} {{$item->name}} {{$item->middlename}} </td>
          {{-- <td class="vertical-middle">
            @if ($item->passing_subject_status==0)
                <span class="text-danger">Failed P.S</span>
            @else
            <span class="text-success">Passed P.S</span>
            @endif
          
          </td> --}}
          {{-- <td class="vertical-middle">{{$item->number_of_passed_subjects}} </td> --}}
          <td class="vertical-middle">
            @if ($item->student_average>=$pass_rate )
            <span class="text-success">{{$item->student_average}}% </span>
            @else
            <span class="text-danger">{{$item->student_average}}% </span> 
            @endif
           
           </td>

      </tr>
          @endforeach
        
  </tbody>
</table>

  </div>


  <div class="col">
    Those that failed
    <hr>

    <table class="table table-sm table-compact">
      <thead class="thead-light ">
  <tr>
   
      <th>Position</th>
      <th>Class</th>
      <th>Student Name</th>
      <th>Student Average</th>
   
    
  </tr>
  </thead>
  <tbody>
 
       @foreach ($failed as $item)
          <tr>
      <td>@if ($tie_type=="share")

        @if ($key=="class_based")

        @php
        $sql_piece="WHERE sc.student_class=".$classofstudent."  AND sc.assessement_id=".$assessement_id."";
        @endphp
        
        @endif

        @if ($key=="stream_based")
       
        @php
        $sql_piece="WHERE sc.student_stream=".$streamofstudent."  AND sc.assessement_id=".$assessement_id."";
        @endphp

        @endif
        @php
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
        ".$sql_piece."
        ORDER BY sc.student_average DESC ) as sub
        WHERE sub.student_id=".$item->learner_id.""));
        foreach ($student_position as $key) {
        echo $key->student_position;
        }
        @endphp
        @endif


        @if ($tie_type=="share_n_+_1")
    

        @if ($key=="class_based")

        @php
       $sql_piece="where assessement_progress_reports.assessement_id=".$assessement_id." AND assessement_progress_reports.student_class=".$classofstudent."";
        @endphp
      
        @endif

        @if ($key=="stream_based")

        @php
        $sql_piece="where assessement_progress_reports.assessement_id=".$assessement_id." AND assessement_progress_reports.student_stream=".$streamofstudent."";
        @endphp

        @endif


        @php


    
    $student_position=\DB::select(\DB::raw("select t.*
from (select assessement_progress_reports.student_id,assessement_progress_reports.student_average, rank() over (order by assessement_progress_reports.student_average desc) as student_position
from assessement_progress_reports ".$sql_piece.") t
where student_id = ".$item->learner_id.""));
        foreach ($student_position as $key) {
        echo $key->student_position;
        }

        @endphp
    

        @endif

        @if ($tie_type=="sequential") 
        @php
        
        $student_position=\DB::select(\DB::raw("SELECT * FROM
        (SELECT
        (@rownum := @rownum + 1) AS student_position,
        student_id,
        student_average, 
        assessement_id
        FROM assessement_progress_reports a
        CROSS JOIN (SELECT @rownum := 0) params
        WHERE student_stream =".$streamofstudent." AND assessement_id=".$assessement_id."
        ORDER BY student_average DESC) as sub
        WHERE sub.student_id=".$item->learner_id.""));
        foreach ($student_position as $key) {
        echo $key->student_position;
        }
        
        
        @endphp
        @endif</td>
          <td class="vertical-middle">{{$item->grade_name}} </td>
          <td class="vertical-middle">{{$item->lastname}} {{$item->name}} {{$item->middlename}} </td>
          {{-- <td class="vertical-middle">
            @if ($item->passing_subject_status==0)
                <span class="text-danger">Failed P.S</span>
            @else
            <span class="text-success">Passed P.S</span>
            @endif
          
          </td> --}}
          {{-- <td class="vertical-middle">{{$item->number_of_passed_subjects}} </td> --}}
          <td class="vertical-middle">
            @if ($item->student_average>=$pass_rate )
            <span class="text-success">{{$item->student_average}}% </span>
            @else
            <span class="text-danger">{{$item->student_average}}% </span> 
            @endif
           
           </td>

      </tr>
          @endforeach
        
  </tbody>
</table>
    
  </div>
</div>
             

          
       
     
            </div>
          @endif
        
      </div>


          
      </div>     
          
      </div>  
      {{-- <script>
      $(document).ready(function(){
      var token = $('meta[name="csrf-token"]').attr('content');
      $(".transfer_to").change(function () {
      event.preventDefault();

      var transfer_to=this.value;
      var student_id=$(this).attr('id');
          
      $.ajax({
          // header:{
          //   'X-CSRF-TOKEN': token
          // },
          //'+transfer_to+'/'+student_id
          
              url: "/students/transfer/process/",
              type: 'POST',
              data: {transfer_to:transfer_to,student_id:student_id},
              })
              .done(function(data) {
                 
                 
              
              })
              .fail(function(data) {
                  console.log(data);
              })
              .always(function() {
                  console.log("complete");
              });
     });
});
      </script> --}}
     
      

</x-app-layout>

