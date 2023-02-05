<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
  
    
    
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Entry?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="delete_entry_val">
            Are you sure you want to delete  that entry.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger confirm_delete">Yes Delete</button>
          </div>
        </div>
      </div>
    </div>

  
  
    
    <!--Response Modal -->
    <div class="modal fade" id="responseModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Response</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body response">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">OK Sengivile!</button>
            
          </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-md-4">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Assign Class Teacher</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('teacher.assign_classteacher')}}" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-group">
                        <x-jet-label> Class Name</x-jet-label>
                       <select class="form-control" name="grade_id" value="{{ old('grade_id') }}">
                        <option value="">Select Class</option>
                        @foreach ($classes as $class)
                        <option value="{{$class->id}}">{{$class->grade_name}}</option>
                            
                        @endforeach
                       </select>
                        @error('grade_id')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label> Class Teacher Name</x-jet-label>
                           <select class="form-control" name="teacher_id">
                            <option value="">Select Class Teacher</option>
                            @foreach ($getTeacher as $teacher_item)
                            <option value="{{$teacher_item->id}}"> {{$teacher_item->name }} {{$teacher_item->middlename }} {{$teacher_item->lastname }}</option>
                            @endforeach
                           </select>
                            @error('teacher_id')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>

                            <div class="form-group">
                                <x-jet-label> Academic Year</x-jet-label>
                               <select class="form-control" name="academic_session">
                                <option value="">Select Academic Year</option>
                                @foreach ($session as $session_item)
                                <option value="{{$session_item->id}}">{{$session_item->academic_session }}</option>
                                @endforeach
                               </select>
                                @error('academic_session')
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
                
                <table class="table table-bordered table table-hover table-responsive-md ">
                  <thead class="thead-light">
                    <tr>
                      <th>Class</th>
                      <th>Class Teacher</th>
                      <th>Academic Year</th>
                      <th>Manage</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                 
                     
            @foreach ($result as $result_item)
            <tr>
            <td>{{$result_item->grade_name}}</td>
            <td>{{$result_item->salutation}} {{$result_item->lastname}} {{$result_item->name}}</td>
            <td>{{$result_item->academic_session}}</td>
            <td class="text-left py-0 align-middle">
              <div class="btn-group btn-group-sm">
                <a href="/users/teacher/class-teacher/edit/{{encrypt($result_item->id)}}"><button type="button" value="{{$result_item->id}}" class="btn btn-primary edit"><i class="fas fa-edit mr-1"></i>Edit</button></a>
                <button type="button" value="{{$result_item->id}}" class="btn btn-danger delete"><i class="fas fa-trash mr-1"></i>Delete</button>
              </div>
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

         
  
          <script>
            $(document).ready(function () {

          
         $.ajaxSetup({
   headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
});

              $(document).on("click",'.delete', function (e) {
                e.preventDefault();
                var id=$(this).val();
                $('#delete_entry_val').val(id);
             if(confirm("Are you sure you want to delete this class teacher?"))
             $.ajax({
                 type: "DELETE",
                 url: "/users/class-teacher/delete/"+id,
                 dataType: "json",
               }).done(function(data) {

               // alert(data.message);
                // $("#deleteModal").modal('hide');
                // $("#responseModal").modal('show');
                // $(".response").text(data.message);
                alert('Data Deleted');
                location.reload();   

                   
                 }).fail(function(data) {
                   
               });
                
              });

              $(document).on("click",'.confirm_delete', function (e) {
                e.preventDefault();
               var id= $('#delete_entry_val').val();
               $.ajax({
                 type: "DELETE",
                 url: "/users/class-teacher/delete/"+id,
                 dataType: "json",
               }).done(function(data) {

               // alert(data.message);
                $("#deleteModal").modal('hide');
                $("#responseModal").modal('show');
                $(".response").text(data.message);
                location.reload(3090);   

                   
                 }).fail(function(data) {
                   
               });
                
                
              });
             
                     
                   });
         </script>



</x-app-layout>


 