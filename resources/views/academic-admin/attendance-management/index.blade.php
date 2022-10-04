<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light  ">
              <div class="card-header">
                <h3 class="card-title">Student Attendance Management</h3>
              </div>

                <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_320,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:Student Attendance,w_0.3,y_0.28/v1613303961/pexels-photo-5212359_ukdzdz.jpg" alt="">
                <div class="card-body">
                  <h2 class="lead text-bold">Hi, {{Auth::user()->name}}</h3>
                 <div class="text-muted">
      <p class="card-text"> Please use this section to add student attendance for your <span class="text-bold">{{$classteacher_list->grade_name}} class</span> <br>
                  
                    </p>
                  
                 </div>
                
                </div>
                
              
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('attendance.store')}}" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-row">
                      <div class="col-md-6 form-group">
                        <x-jet-label> Class Name</x-jet-label>
                       <select class="form-control" name="grade_id">            
<option value="{{$classteacher_list->grade_id}}">{{$classteacher_list->grade_name}}</option>
                       </select>
                        @error('grade_id')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <x-jet-label>Attendance Date</x-jet-label>

                           <input type="date" class="form-control" name="attendance_date" id="attendance_date">
                           {{-- <select class="form-control" name="attendance_date">
                         
                           
                            <option value="{{$date}}">{{$date}}</option>
                           
                           </select> --}}

                           <input type="hidden" value="{{$classteacher_list->teacher_id}}" name="teacher_id" id="teacher_id">
                            @error('teacher_id')
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
                          <th>Attendance Status </th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($student_list as $key=>$student_item)
                      {{-- @foreach ($nodes as $key => $node)
    <li>{{ $key }}: {{ $node->url }}</li>


@endforeach --}}

{{-- @php
    dd($key)
@endphp --}}


                      <tr>
                        <td>{{$loop->iteration}}</td>
                      
                          <td>{{$student_item->lastname}} {{$student_item->middlename}} {{$student_item->name}}</td>
                      
                    

                      
                      
                        <td>
                          <div class="row" id="attendance_data">
                            {{-- <div class="btn-group btn-group-toggle" data-toggle="buttons">
                              <label class="btn btn-success ">
                                <input type="radio" name="{{$student_item->student_id}}" id="{{$student_item->student_id}}" autocomplete="off" > Present
                              </label>
                              <label class="btn btn-danger">
                                <input type="radio" name="{{$student_item->student_id}}" id="{{$student_item->student_id}}" autocomplete="off"> Absent
                              </label>
                            </div> --}}
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="status[{{$key}}]" id="{{$student_item->student_id}}"  checked value="1">
                              <label class="form-check-label" for="{{$student_item->student_id}}">
                              Present
                              </label>
                            
                           </div>
                           <input type="hidden" name="student_id[{{$key}}]" value="{{$student_item->student_id}}">

                           <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status[{{$key}}]" id="{{$student_item->student_id}}" value="0">
                            <label class="form-check-label" for="{{$student_item->student_id}}">
                            Absent
                            </label>
                         </div>
                         
                         <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="status[{{$key}}]" id="{{$student_item->student_id}}" value="2">
                          <label class="form-check-label" for="{{$student_item->student_id}}">
                          Sick
                          </label>
                       </div>
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

          <script>
            $(document).ready(function () {
              
            });
          </script>
    
</x-app-layout>

 