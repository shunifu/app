<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="card card-light  ">
     
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_330,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_32_style_light_align_center:Department Management,w_0.4,y_0.18/v1617762453/pexels-photo-1181400_ozprab.jpg" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to manage school departments <br>

              You can use the Action Dropdown to access functions to manage the departments
          
            </p>
          
         </div>
        
        </div>
    </div> 
    <div class="row">
        <div class="col-md-4">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Add Department</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('department.store')}}" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-group">
                        <x-jet-label> Department Name</x-jet-label>
                        <x-jet-input name="department_name" placeholder="Enter Department Name" ></x-jet-input>
                        @error('department_name')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                        <div class="form-group">
                          <x-jet-label>Choose Head of Department</x-jet-label>
                          <select class="form-control" name="teacher">
                            <option value="">Select Department Head</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{$teacher->id}}">{{$teacher->salutation}} {{$teacher->lastname}} {{$teacher->name}} </option>
                            @endforeach
                          </select>
                          @error('teacher')
                          <span class="text-danger">{{$message}}</span>  
                          @enderror
                          </div>
                </div>
                <!-- /.card-body -->
      
                <div class="card-footer">
                  <x-jet-button>Add Department</x-jet-button>
                </div>
            </form>
            </div>
      
      
        </div>
        <div class="col-md-8">
          <div class="card card-light">
            <div class="card-header">
              <h3 class="card-title">Manage Department</h3>
            </div>
            <!-- /.card-header -->
            
            
              <div class="card-body">
                
                <div class="table-responsive">
                  <table class="table  table-compact table-hover mx-auto table-bordered">
                        <thead class="thead-light">
                    <tr>
                      <th>Department Name</th>
                      <th>Head of Department</th>
                      <th>Manage Department</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                     @foreach ($department_collection as $item)
                     <tr>
                         <td>{{$item->department_name}}</td>
                         <td>{{$item->salutation}} {{$item->name}} {{$item->lastname}}</td>


                         <td>
                          <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                              Action
                            </button>
                            <div class="dropdown-menu">
  <a class="dropdown-item" href="/academic-admin/department/view/{{$item->department_id}}">View Department</a>
  <a class="dropdown-item" href="/academic-admin/department/edit/{{$item->department_id}}">  Edit Department</a>
  <a class="dropdown-item" href="/academic-admin/department/delete/{{$item->department_id}}">Delete Department</a>

                            </div>
                          </div>
                         </td>
                         
                          {{-- <td class="text-left py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                              <a href="department/view/{{$item->department_head_id}}/{{$item->department_id}}" class="btn btn-success"><i class="fas fa-eye"></i></a>
                              <a href="department/edit/{{$item->department_head_id}}/{{$item->department_id}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                              <a href="department/delete/{{$item->department_head_id}}/{{$item->department_id}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </div>
                          </td> --}}


                      </tr>

                     @endforeach
                    </tr>
                    
                  </tbody>
                </table>
              </div>
      
           
          </div>
      
        </div>
            
          </div>  
    
</x-app-layout>

 