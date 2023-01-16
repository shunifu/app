<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="row">
        <div class="col">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Manage Department</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('department.update')}}" method="post">

               
                  <input type="hidden" name="current_teacher_id" value="{{$teacher_id}}">
                  <input type="hidden" name="current_department_id" value="{{$department_id}}">



                     <div class="card-body">
                      @csrf
                      <div class="form-group">
                        <x-jet-label> Department Name</x-jet-label>
                        <x-jet-input name="department"  value="{{$department_data->department_name}}"  ></x-jet-input>
                        @error('department_name')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                        <div class="form-group">
                          <x-jet-label>Choose Head of Department</x-jet-label>
                          <select class="form-control" name="new_teacher">

                            @if ($int==0)
                           @else
                           <option value="{{$hod->id}}"> {{$hod->lastname}} {{$hod->name}} </option>
                            @endif
            
                  <option value=""> ------------------------------ </option>
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
                  <x-jet-button>Edit Department</x-jet-button>
                </div>
            </form>
            </div>
      
      
        </div>
      
            
          </div>  
    
</x-app-layout>

 