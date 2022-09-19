<x-app-layout>
    <x-slot name="header">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

       <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/js/bootstrap-multiselect.min.js" integrity="sha512-lxQ4VnKKW7foGFV6L9zlSe+6QppP9B2t+tMMaV4s4iqAv4iHIyXED7O+fke1VeLNaRdoVkVt8Hw/jmZ+XocsXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/css/bootstrap-multiselect.min.css" integrity="sha512-fZNmykQ6RlCyzGl9he+ScLrlU0LWeaR6MO/Kq9lelfXOw54O63gizFMSD5fVgZvU1YfDIc6mxom5n60qJ1nCrQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                   <td><a href="/view/alloations/{{$allocation->allocation_id}}">View Allocations</a></td>
                 
                   
                   
                   <td>
                    
                    <a href="/academic-admin/session/view/{{$allocation->allocation_id}}"><button  class="btn btn-light "><i class="fas fa-eye"> </i> View</button></a> 
                     <a href="/academic-admin/session/edit/{{$allocation->allocation_id}}"><button class="btn btn-light"><i class="fas fa-edit"> </i> Edit</button></a> 
                    <a href="/academic-admin/terms/delete/{{$allocation->allocation_id}}"><button  class="btn btn-light"><i class="fas fa-trash"> </i> Delete</button></a> 
                  
                     
                    
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
      $(document).ready(function () {
      
         
        $('#subjects').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true
        });
  
  
      });
  
  </script>
            
     
    
  </x-app-layout>