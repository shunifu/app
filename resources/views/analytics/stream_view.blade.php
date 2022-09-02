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

            @if ($stream_list->isEmpty())
            <h3 class="small lead text-muted text-center ">No Analytics Found.</h3>
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<lottie-player src="https://assets2.lottiefiles.com/packages/lf20_x62chJ.json" mode="bounce" background="transparent"  speed="1"  style="width: 300px; height: 300px; margin-left:auto; margin-right:auto"   loop  autoplay></lottie-player>
            @else
            <div class="table-responsive">
<div class="col-md-12 mx-auto">
@foreach (\App\Models\School::all('school_letter_head') as $item)
<img src={{asset('storage/'.$item->school_letter_head) }}  class="mx-auto d-block" />
@endforeach
</div>
             
<div class="row">
<div class="col pb-4">
{{-- <h3>{{$title->stream_name}}</h3> --}}
</div>

</div>

             

                    <table class="table table-sm table-compact">
                      <thead class="thead-light ">
                  <tr>
                    <th> No.</th>
                    <th>Class</th>
                      <th>Student Name</th>
                      <th>Student Average</th>
                   
                    
                  </tr>
                  </thead>
                  <tbody>
                 
                       @foreach ($stream_list as $item)
                          <tr>
                          <td class="vertical-middle">{{$loop->iteration}} </td>
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
                            @if ($item->student_average>=60 )
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

