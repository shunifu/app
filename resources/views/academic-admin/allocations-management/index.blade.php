<x-app-layout>
    <x-slot name="header">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/js/bootstrap-multiselect.min.js" integrity="sha512-fp+kGodOXYBIPyIXInWgdH2vTMiOfbLC9YqwEHslkUxc8JLI7eBL2UQ8/HbB5YehvynU3gA3klc84rAQcTQvXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/css/bootstrap-multiselect.min.css" integrity="sha512-jpey1PaBfFBeEAsKxmkM1Yh7fkH09t/XDVjAgYGrq1s2L9qPD/kKdXC/2I6t2Va8xdd9SanwPYHIAnyBRdPmig==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Subject Allocations</h3>
      </div>
  
      
        <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_210,w_970/b_rgb:000000,e_gradient_fade,y_-0.60/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_35_style_light_align_center:Subject Allocations,w_0.2,y_0.28/v1615231896/Untitled_design_7_bahmem.png" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to manage School Academic Allocations. <br>
          
            </p>
          
         </div>
        
        </div>
    </div> 
  <div class="row">
    
  <div class="col-sm-4 col-md-4">
  
    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">Add Subject Allocation</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('allocation.store')}}" method="post">
          <div class="card-body">
            
            @csrf

            <div class="form-group">
                <x-jet-label>Select Class</x-jet-label>
               <select name="grade" id="grade" class="form-control">
                  <option value="">Select Class</option>
                  @foreach ($grades as $grade)
                  <option value="{{$grade->id}}">{{$grade->grade_name}}</option>
                  @endforeach
                 
               </select>
                @error('grade')
                <span class="text-danger">{{$message}}</span>  
                @enderror
               
            </div>
          <div class="form-group">
              <x-jet-label>Select Subject</x-jet-label><br>
             <select name="subjects[]" id="subjects" class="form-control"  multiple="multiple" >
               
                @foreach ($subjects as $subject)
                <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                @endforeach
               
             </select>
              @error('subject')
              <span class="text-danger">{{$message}}</span>  
              @enderror
             
          </div>

   

        <div class="form-group">
            <x-jet-label>Select Academic Year</x-jet-label>
           <select name="session" id="session" class="form-control">
              <option value="">Select Academic Year</option>
              @foreach ($sessions as $session)
              <option value="{{$session->id}}">{{$session->academic_session}}</option>
              @endforeach
             
           </select>
            @error('session')
            <span class="text-danger">{{$message}}</span>  
            @enderror
           
        </div>
         
      
               
          </div>
          <!-- /.card-body -->
  
          <div class="card-footer">
            <x-jet-button>Add Allocation </x-jet-button>
          </div>
       
      </div>
    </form>
  
  </div>
  
  <div class="col-md-8">
  
    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Manage Subject Allocations</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      
        <div class="card-body">
        <div class="responsive">
          <table class="table  table-hover table-responsive-sm">
            <thead class="thead-light">
              <tr>
                <th>Class</th>
                <th>Allocations</th>
              
                <th>Manage</th>
              </tr>
            </thead>
            <tbody>
             <tr>
               @foreach ($allocations as $allocation)
               <tr>
                   <td>{{$allocation->grade_name}}</td>
                   <td><a href="/allocation/view/{{$allocation->allocation_id}}">View Allocations</a></td>
                 
                   
                   
                   <td>
                    
                    <a href="/allocation/session/view/{{$allocation->allocation_id}}"><button  class="btn btn-light "><i class="fas fa-eye"> </i> View</button></a> 
                     <a href="/allocation/session/edit/{{$allocation->allocation_id}}"><button class="btn btn-light"><i class="fas fa-edit"> </i> Edit</button></a> 
                    <a href="/allocation/terms/delete/{{$allocation->allocation_id}}"><button  class="btn btn-light"><i class="fas fa-trash"> </i> Delete</button></a> 
                  
                     
                    
                     </td>
                   
                </tr>
               
               
               @endforeach
              </tr> 
              
            </tbody>
          </table>
        </div>
         
        </div>
  
     
    </div>
  
  </div>
      
    </div>   
    <script>
 
      
         
        $('#subjects').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true
        });
  
  
     
  
  </script>
            
     
    
  </x-app-layout>