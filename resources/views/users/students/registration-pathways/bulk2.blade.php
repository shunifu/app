<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Student Registration Portal</h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_32_style_light_align_center:Multiple-Student%20Registration Form,w_0.4,y_0.18/v1650135733/pexels-rodnae-productions-10375992_1_shjypq.jpg">
        <div class="card-body">
          <h4 class="lead">Student Registration Portal</h4>
         
          <hr>
         <div class="text-muted">
          Hi, <span class="text-bold">{{Auth::user()->salutation}} {{Auth::user()->lastname}}</span>. Welcome to the  bulk-student-add pathway. This is where you add a multiple-students at a time. Below is a form where you will add the needed student details. <br>
          <span class="text-danger">Please note that the parent email and parent cell are optional.</span><br>
          To go back click <a href="/users/student">here</a> 
         </div>
       
        </div>
    </div> 
    <div class="row">
        <div class="col">

            <div class="card text-left">
            
              <div class="card-body">
                <h3 class="text-bold">Step 1  <small class="text-danger">*</small></h3>
                <small>First select the class you want to add the students for.</small>
                <p class="card-text"> 
                     <div class="col form-group">
                  <form action="{{route('pathway.bulk_store')}}" method="post">  
                    @csrf
                    <x-jet-label>Choose Class</x-jet-label>
                    <select class="form-control" name="grade[]">
                    <option value="">Select Class</option>
                    @foreach ($class as $student_class)
                    <option value={{$student_class->id}}>{{$student_class->grade_name}}</option>
                    @endforeach
                    </select>
                    @error('grade')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                    </div>
                </p>
              </div>
            </div>
        </div>
    </div>
          <div class="card card-light">
          
              <div class="card-body">

                <h3 class="text-bold">Step 2</h3>

                          
              
                <div class="card-body">
                      @csrf
                      <table class="table table-sm table-hover mx-auto table-bordered">
                       <thead class="thead-light">
                           <tr>
                            <th>Lastname <br><small id="lastname"  class="text-muted">Enter lastname of student</small>  <small class="text-danger">*</small></th>
                            <th>Name <br><small id="name" class="text-muted">Enter name of student</small> <small class="text-danger">*</small></th>
                            <th>Middlename <br><small id="middlename" class="text-muted">Enter middlename of student</small></th>
                            <th>Gender <br><small id="gender" class="text-muted">Gender of student</small> <small class="text-danger">*</small> </th>
                            <th>Parent Cell <br><small id="parent_cell" class="text-muted">Enter Parent Cell</small></th>
                            <th>Parent Email <br><small id="parent_email" class="text-muted">Enter Parent Email</small></th>
                            <th>Action</th>
                             
                           </tr>
                       </thead>
                       <tbody class="added_data">

                           <tr id="table_row">
    <td><input type="text" name="lastname[]" id="lastname" required    class="form-control" placeholder="Student Surname" aria-describedby="lastname"></td>
    <td><input type="text" name="name[]" id="name" required class="form-control" placeholder="Student Name" aria-describedby="helpId"></td>
    <td><input type="text" name="middlename[]" id="middlename" class="form-control" placeholder="Student Middlename" aria-describedby="middlename"></td>
    <td>
    <select class="form-control" name="gender[]" required id="gender">
    <option value="">Select Gender</option>
    <option value="male">Male</option>
    <option value="female">Female</option>
    </select>
    </td>

    <td><input type="number" name="parent_cell[]"  id="parent_cell" class="form-control" placeholder="Parent Cell" aria-describedby="parent_cell"></td>
    <td><input type="email" name="parent_email[]"  id="parent_email" class="form-control" placeholder="Parent Email" aria-describedby="parent_email"></td>

    <td>
        <div class="col">
            <div class="row">
                <button type="button" class="btn btn-success" name="add"
                id="add_input" type="button"><i class="fas fa-plus-circle"></i></button>
            </div>
        </div>

      
    </td>
    
                           </tr>
                          
                       </tbody>
                   </table>

                    
                    

                                
                </div>
                <!-- /.card-body -->
      
                <div class="card-footer">
                  <x-jet-button>Register Student</x-jet-button>
                </div>
            </form>

                
              </div>

            </div>
      
      
        </div>

     


     
            
          </div>


          <script>


          </script>
          
          <script>
              $(document).ready(function () {
                  // var i=1;
                  $("#add_input").click(function (e) { 
                   e.preventDefault();



  var clone = $('.form-main').clone('.form-block');
  $('.form-main').append(clone);


                      // i++;
                    //   $('#master-div').clone().find("input:text").val("").end().appendTo('#slave-div');
// $(".added_data").append('<tr id="row'+i+'"> <td><input type="text" name="lastname"  id="lastname" class="form-control" placeholder="Student Surname" aria-describedby="lastname" required></td><td><input type="text" name="name[]" id="name" class="form-control" placeholder="Student Name" required aria-describedby="name"></td><td><input type="text" name="middlename[]" id="middlename" class="form-control" placeholder="Student Middlename" aria-describedby="middlename"></td> <td><select class="form-control" name="gender[]" id="gender"><option value="">Select Gender</option><option value="male">Male</option><option value="female">Female</option></select></td><td><input type="number" name="parent_cell[]" id="parent_cell" class="form-control" placeholder="Parent Cell" aria-describedby="parent_cell"></td><td><input type="email" name="parent_email[]" id="parent_email" class="form-control" placeholder="Parent Email" aria-describedby="parent_email"></td><td><button class="btn btn-danger btn_remove" name="remove" id='+i+' type="button"><i class="fas fa-times"></i></button> </td></tr>');    
                  });
                  $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
              });


           

          </script>


    
</x-app-layout>

 