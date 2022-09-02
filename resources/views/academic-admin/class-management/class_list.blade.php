<x-app-layout>
    <x-slot name="header">
        <style>
  @media print { 
             .table th { 
                background-color: grey !important; 
                color: white;

            } 
        }
        </style>
      
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light">
           
              
              <div class="card-header no-print">
                <h3 class="card-title">View Students</h3>
              </div>
            
            <div class="card-body">
            
            

              @if ($class_list->isEmpty())
              <h3 class="small lead text-muted text-center ">No Students found this class.</h3>
              <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<lottie-player src="https://assets2.lottiefiles.com/packages/lf20_x62chJ.json" mode="bounce" background="transparent"  speed="1"  style="width: 300px; height: 300px; margin-left:auto; margin-right:auto"   loop  autoplay></lottie-player>
              @else
              <div class="table-responsive">
<div class="col-md-12 mx-auto">
  @foreach ($school_info as $school_data)
  <img src={{asset('storage/'.$school_data->school_letter_head) }}  class="mx-auto d-block img-fluid img-thumbnail" />
  @endforeach
</div>
<hr>

   <div class="container-fluid d-flex justify-content-center">
                
<div class="row mx-auto">
  <div class="col py-3">
   <h3 class="text-bold text-underline">Class list: {{$class_info->grade_name}}-{{$class_info->academic_session}}</h3> 

  </div>
  
  
</div>

</div> 

               
               
 
                      <table class="table  table-bordered">
                        <thead class="table-dark ">
                    <tr>
                      <th class="thead-light"> No.</th>
                        
                        <th> Student Surname</th>
                        <th> Student Name</th>
                      
                        <th class="no-print"> Manage</th>
                       
                        
                    </tr>
                    </thead>
                    <tbody>

                    
                        
                            @foreach ($class_list as $item)
                            <tr>
                            <td class="vertical-middle">{{$loop->iteration}}  </td>
                            <td class="vertical-middle">{{$item->lastname}}  </td>
                            <td class="vertical-middle"> {{$item->name}}  {{$item->middlename}}  </td>
                         
                           
                          
                            <td class="no-print">
                              <a href="/users/student/manage/view/{{$item->user_id}}" class="link"><i class="fas fa-eye 2x mr-1"></i>View Student</a>
                              <span class="mr-3"></span>
            
                            </td>
                        </tr>
                            @endforeach
                    </tbody>
            </table>
           
              </div>
            @endif
          
        </div>

        <span class="text-bold mx-auto py-3">{{$class_info->grade_name}}-{{$class_info->academic_session}}</span>
            
        </div>
     
            
          </div>  

          <script>
              
          </script>
    
</x-app-layout>

 