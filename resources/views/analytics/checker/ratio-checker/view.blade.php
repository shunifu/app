<x-app-layout>
    <x-slot name="header">
      <link rel="stylesheet" type="text/css"
      href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/r-2.2.7/datatables.min.css" />
      
    </x-slot>
    
    <div class="row">
        {{-- <div class="col-md-12">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Remove Students </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('student.removal_index')}}" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-row">
                      <div class="col-md-6 form-group">
                        <x-jet-label> Class Name</x-jet-label>
                       <select class="form-control" name="grade_id">
                        <option value="0">Select Class</option>
                        @foreach ($classes as $class)
                        <option value="{{$class->id}}">{{$class->grade_name}}</option>
                            
                        @endforeach
                       </select>
                        @error('class')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                        

                            <div class="col-md-6 form-group">
                                <x-jet-label> Academic Year</x-jet-label>
                               <select class="form-control" name="academic_session">
                                <option value="">Select Academic Year</option>
                                @foreach ($sessions as $session)
                                <option value="{{$session->id}}">{{$session->academic_session }}</option>
                                @endforeach
                               </select>
                                @error('session')
                                <span class="text-danger">{{$message}}</span>  
                                @enderror
                            </div>
                </div>
                </div>
                <!-- /.card-body -->
      
                <div class="card-footer">
                  <x-jet-button>Load Students</x-jet-button>
                </div>
            </form>


            </div>
      
      
        </div> --}}
        <div class="col-md-12 mt-4">

          <div class="card bg-white">
           
              <div class="card-header">
                  <h3 class="card-title">Ratio Checker</h3>
              </div>

              <img class="card-img-top"
                  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_220,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:Ratio Checker,w_0.3,y_0.28/v1613303961/pexels-photo-5212359_ukdzdz.jpg"
                  alt="">
          
            <div class="card-body">
        
        <p>Hi {{Auth::user()->name}}, This is where you will view students load ratio <span class="text-bold"> You 
            <br>
            
             </p>
              <p class="card-text">

              
                    <div class="card-body">
                        <div class="table-responsive">
                        
                                        <table class="table table-hover table-bordered " id="customers">
                                          <thead class="thead-light">
                                            <tr>
                                              
                                              <th>Student</th>
                                              <th>Class</th>
                                              <th>Assigned Number of Subjects</th>
                                              @if ($school_code=='1077')
                                              <th>CA Marks</th>
                                              <th>Exam Marks</th> 
                                              
                                              @endif

                                              @if ($school_code=='0387')
                                              <th>Marks for Test 1</th>
                                              <th> Marks for Test 2</th>
                                              <th>Marks for Exam</th> 
                                                  
                                              @endif

                                              @if ($school_code=='0962')
                                              <th>Marks for Test 1</th>
                                              <th> Marks for Test 2</th>
                                              <th>Marks for Exam</th> 
                                                  
                                              @endif
                                             
                                             
                                             
                                            </tr>
                                            </thead>
                                            <tbody>
                                            
              @foreach ($checklist as $item)
              <tr>
                @if ($school_code=='0387')

                
                  @if ($item->total_loads!==$item->Test_1 || $item->total_loads!==$item->Test_2 || $item->total_loads!==$item->Examination)
                  <td class="bg-red">  {{$item->lastname}} {{$item->name}} {{$item->middlename}} </td> 
                  <td class="bg-red">{{$item->grade_name}}</td>   
                  <td class="bg-red">{{$item->total_loads}} </td>
                  <td class="bg-red"><a href="/analytics/loads/check/{{$item->id}}/{{$item->test_1_id}}/"><span class="text-bold">{{$item->Test_1}}</span></a></td>
                  <td class="bg-red"><a href="/analytics/loads/check/{{$item->id}}/{{$item->test_2_id}}/"><span class="text-bold">{{$item->Test_2}}</span></a></td>
                  <td class="bg-red"><a href="/analytics/loads/check/{{$item->id}}/{{$item->exam_id}}/"><span class="text-bold">{{$item->Examination}}</span></a></td>
                  @elseif($item->total_loads<8)
                  <td class="bg-warning">{{$item->lastname}} {{$item->name}} {{$item->middlename}}</td> 
                  <td class="bg-warning">{{$item->grade_name}}</td>   
                  <td class="bg-warning">{{$item->total_loads}} </td>
                  <td class="bg-warning">{{$item->Test_1}}</td>
                  <td class="bg-warning">{{$item->Test_2}}</td>
                  <td class="bg-warning">{{$item->Examination}}</td>
                  @else
                  <td>{{$item->lastname}} {{$item->name}} {{$item->middlename}}</td> 
                  <td>{{$item->grade_name}}</td>   
                  <td>{{$item->total_loads}} </td>
                  <td>{{$item->Test_1}}</td>
                  <td>{{$item->Test_2}}</td>
                  <td>{{$item->Examination}}</td>
                  @endif
                @endif

                @if ($school_code=='0962')

                
                @if ($item->total_loads!==$item->Test_1 || $item->total_loads!==$item->Test_2 || $item->total_loads!==$item->Examination)
                <td class="bg-red">  {{$item->lastname}} {{$item->name}} {{$item->middlename}} </td> 
                <td class="bg-red">{{$item->grade_name}}</td>   
                <td class="bg-red"><a href="/analytics/loads/checker/{{$item->id}}">{{$item->total_loads}}- View Loads</a> </td>
                <td class="bg-red"><a href="/analytics/loads/check/{{$item->id}}/{{$item->test_1_id}}/"><span class="text-bold">{{$item->Test_1}}</span></a></td>
                <td class="bg-red"><a href="/analytics/loads/check/{{$item->id}}/{{$item->test_2_id}}/"><span class="text-bold">{{$item->Test_2}}</span></a></td>
                <td class="bg-red"><a href="/analytics/loads/check/{{$item->id}}/{{$item->exam_id}}/"><span class="text-bold">{{$item->Examination}}</span></a></td>
                @elseif($item->total_loads<8)
                <td class="bg-warning">{{$item->lastname}} {{$item->name}} {{$item->middlename}}</td> 
                <td class="bg-warning">{{$item->grade_name}}</td>   
                <td class="bg-warning"><a href="/analytics/loads/checker/{{$item->id}}">{{$item->total_loads}}- View Loads</a> </td>
                <td class="bg-warning">{{$item->Test_1}}</td>
                <td class="bg-warning">{{$item->Test_2}}</td>
                <td class="bg-warning">{{$item->Examination}}</td>
                @else
                
                <td>{{$item->lastname}} {{$item->name}} {{$item->middlename}}</td> 
                <td>{{$item->grade_name}}</td>   
                <td><a href="/analytics/loads/checker/{{$item->id}}">{{$item->total_loads}}- View Loads</a> </td>
                <td>{{$item->Test_1}}</td>
                <td>{{$item->Test_2}}</td>
                <td>{{$item->Examination}}</td>
                @endif
              @endif

                @if ($school_code=='1077')
                @if ($item->total_loads!==$item->ContinousAssessement  || $item->total_loads!==$item->Examination)
                <td class="bg-red">{{$item->name}} {{$item->middlename}} {{$item->lastname}} </td> 
                <td class="bg-red">{{$item->grade_name}}</td>   
                <td class="bg-red">{{$item->total_loads}} </td>
                <td class="bg-red"><a href="/analytics/loads/check/{{$item->id}}/{{$item->ca_id}}/"><span class="text-bold">{{$item->ContinousAssessement}}</span></a></td>
                <td class="bg-red"><a href="/analytics/loads/check/{{$item->id}}/{{$item->exam_id}}/"><span class="text-bold">{{$item->Examination}}</span></a></td>
                @else
                <td>{{$item->name}} {{$item->middlename}} {{$item->lastname}} </td> 
                <td>{{$item->grade_name}}</td>   
                <td>{{$item->total_loads}} </td>
                <td><a href="/analytics/loads/check/{{$item->id}}/{{$item->ca_id}}/"><span class="text-bold">{{$item->ContinousAssessement}}</span></a></td>
                <td><a href="/analytics/loads/check/{{$item->id}}/{{$item->ca_id}}/"><span class="text-bold">{{$item->Examination}}</span></a></td>
                @endif
              @endif
           

         


         
             
                     
            </tr>
              @endforeach
                                              
                                                
                                            
                                            </tbody>
                                        </table>
                        </div>
                                          
                                        </div>
                                        <!-- /.card-body -->
         
          
          
        
        
    
<hr> 

             
          
            </div>
          </div>

        </div>
    </div>
 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/r-2.2.7/datatables.min.js">
    </script>


<script>
  $(document).ready(function () {
      $.noConflict();

      $('#select_all').change(function() {


$('.students').prop("checked", this.checked);

});

$('.students').change(function() {

if ($('input:checkbox:checked.students').length === $("input:checkbox.students").length) {
  $('#select_all').prop("checked", true);
} else {
  $('#select_all').prop("checked", false);
}

})

      $('#customers').DataTable({
          // scrollY:auto,
          scrollCollapse: true,
          paging: false,
          //scrollX: true,
          info: true,
          dom: 'Bfrtip',
          select: true,
      });

  

  })

</script>



      
      
    
  
    
</x-app-layout>

 