<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="row">
        <div class="col-md-4">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Add Teacher To Department</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('department.store_teacher')}}" method="post">
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
                          <select  class="form-control" name="teacher">
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
                
                <table class="table">
                  <thead>
                    <tr>
                      <th>Department Name</th>
                      <th>Head of Department</th>
                      <th>Manage Department</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                     @foreach ($department as $item)
                     <tr>
                         <td>{{$item->department_name}}</td>
                         <td>{{$item->salutation}} {{$item->name}} {{$item->lastname}}</td>
                          <td>
                            <a href="department/view/{{$item->department_head_id}}/{{$item->department_id}}" class="link"><i class="fas fa-eye"></i></a>
                            <a href="department/edit/{{$item->department_head_id}}/{{$item->department_id}}" class="link"><i class="fas fa-edit"></i></a>
                            <a href="department/delete/{{$item->department_head_id}}/{{$item->department_id}}"><i class="fas fa-trash"></i></a>
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
    
</x-app-layout>

 