<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light  ">
              <div class="card-header">
                <h3 class="card-title">Student Attendance Management</h3>
              </div>

                <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_320,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:Manage Student Attendance,w_0.3,y_0.28/v1613303961/pexels-photo-5212359_ukdzdz.jpg" alt="">
                <div class="card-body">
                  <h2 class="lead text-bold">Hi, {{Auth::user()->name}}</h3>
                 <div class="text-muted">
      <p class="card-text"> Please use this section to manage student attendance for your <span class="text-bold">{{$classteacher_list->grade_name}} class</span> <br>
                  
                    </p>
                  
                 </div>
                
                </div>
                
              
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('attendance.cummulative_store')}}" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-row">

                        <div class="col-md-6 form-group">
                            <x-jet-label> Term</x-jet-label>
                           <select class="form-control" name="term">   
                            <option value="">Select Term</option>
                            @foreach ($terms as $term)
                            <option value="{{$term->id}}">{{$term->term_name}}</option> 
                            @endforeach         
                           </select>
                            @error('terms')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>
                      <div class="col-md-6 form-group">
                        <x-jet-label> Class Name</x-jet-label>
                       <select class="form-control" name="grade_id">            
<option value="{{$classteacher_list->grade_id}}">{{$classteacher_list->grade_name}}</option>
                       </select>
                        @error('grade_id')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>


                </div>
                <hr>
                <table class="table table-bordered table table-hover table-responsive-md ">
                  <thead class="thead-light">
                      <tr>
                        <th>No.</th>
                          <th>Student Name </th>
                          <th>Days Absent </th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($student_list as $key=>$student_item)
       
                      <tr>
                        <td>{{$loop->iteration}}</td>
                      
                          <td>{{$student_item->lastname}} {{$student_item->middlename}} {{$student_item->name}}</td>
         
                        <td>
                          <div class="row" id="attendance_data">
                          <input type="number" name="absent_days[]" value="0" id="absent_days" class="form-control">
                          
                           <input type="hidden" name="student_id[{{$key}}]" value="{{$student_item->student_id}}">

                         
                      
                          </div>
                    
                        </td>
                    
                    </tr> 
                      @endforeach
                    
                    
                  </tbody>
              </table>
                </div>
                <!-- /.card-body -->
      
                <div class="card-footer">
                  <x-jet-button>Add {{$classteacher_list->grade_name}} Attendance </x-jet-button>
                </div>
            </form>
            </div>
      
      
        </div>
     
            
          </div>  

        
</x-app-layout>

 