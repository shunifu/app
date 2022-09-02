<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="row">
        <div class="col-md-4">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Assign Head of Department</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('teacher.assign_head_of_department')}}" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-group">
                        <x-jet-label>Department Name</x-jet-label>
                       <select class="form-control" name="department_id">
                        <option value="0">Select Department</option>
                        @foreach ($classes as $class)
                        <option value="{{$class->id}}">{{$class->grade_name}}</option>
                            
                        @endforeach
                       </select>
                        @error('class')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label> Class Teacher Name</x-jet-label>
                           <select class="form-control" name="teacher_id">
                            <option value="0">Select Class Teacher</option>
                            @foreach ($getTeacher as $teacher_item)
                            <option value="{{$teacher_item->id}}">{{$teacher_item->name }}</option>
                            @endforeach
                           </select>
                            @error('teacher_id')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>

                            <div class="form-group">
                                <x-jet-label> Academic Year</x-jet-label>
                               <select class="form-control" name="academic_session">
                                <option value="0">Select Academic Year</option>
                                @foreach ($session as $session_item)
                                <option value="{{$session_item->id}}">{{$session_item->academic_session }}</option>
                                @endforeach
                               </select>
                                @error('session')
                                <span class="text-danger">{{$message}}</span>  
                                @enderror
                                </div>
                </div>
                <!-- /.card-body -->
      
                <div class="card-footer">
                  <x-jet-button>Assign Class Teacher</x-jet-button>
                </div>
            </form>
            </div>
      
      
        </div>
        <div class="col-md-8">
          <div class="card card-light">
            <div class="card-header">
              <h3 class="card-title">Manage Class</h3>
            </div>
            <!-- /.card-header -->
            
            
              <div class="card-body">
                
                <table class="table">
                  <thead>
                    <tr>
                      <th>Class</th>
                      <th>Class Teacher</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                 
                     <tr>
                         <td>jkjkf</td>
                         <td>
                          Head of Department
                          </td>
                         
                      </tr>
                     
                     
                   
                    </tr>
                    
                  </tbody>
                </table>
              </div>
      
           
          </div>
      
        </div>
            
          </div>  
    
</x-app-layout>

 