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

    <div class="card text-left">
            
      <div class="card-body">
    <form action="{{route('pathway.bulk_store')}}" method="post">  
      @csrf
    <div class="form-row" id="master_div">
      <div class="col-md-1 form-group">

                    <x-jet-label> Class</x-jet-label>
                    <select class="form-control" name="grade">
                    <option value=""> Class</option>
                    @foreach ($class as $student_class)
                    <option value={{$student_class->id}}>{{$student_class->grade_name}}</option>
                    @endforeach
                    </select>
                    @error('grade')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
        </div>
          
    
        <div class="col-md-2 form-group">
              <div class="col form-group">
                  <x-jet-label>Surname</x-jet-label>
                  <input type="text" name="lastname[]" id="lastname" required    class="form-control" placeholder="Student Surname" >
                  @error('lastname')
                  <span class="text-danger">{{$message}}</span>  
                  @enderror
                  </div></p>
        </div>

        <div class="col-md-2 form-group">
          <div class="col form-group">
              <x-jet-label>Name</x-jet-label>
              <input type="text" name="name[]" id="name" required    class="form-control" placeholder="Student Name" >
              @error('name')
              <span class="text-danger">{{$message}}</span>  
              @enderror
              </div></p>
    </div>

    <div class="col-md-2 form-group">
      <div class="col form-group">
          <x-jet-label>Middlename</x-jet-label>
          <input type="text" name="middlename[]" id="name" required    class="form-control" placeholder="Student Middlename" >
          @error('nmiddleame')
          <span class="text-danger">{{$message}}</span>  
          @enderror
          </div></p>
    </div>

    <div class="col-md-2 form-group">
      <div class="col form-group">
        <x-jet-label>Gender</x-jet-label>
    <select class="form-control" name="gender[]" required id="gender">
      <option value="">Select Gender</option>
      <option value="male">Male</option>
      <option value="female">Female</option>
      </select>
      </div>
    </div>


    <div class="col-md-2 form-group">
      <div class="col form-group">
          <x-jet-label>Parent Cell</x-jet-label>
          <input type="number" name="parent_cell[]" id="parent_cell" required    class="form-control" placeholder="Parent Cell" >
          @error('name')
          <span class="text-danger">{{$message}}</span>  
          @enderror
          </div>
</div>


<div class="col-md-1 form-group">
  <div class="col form-group">
    <x-jet-label class="label"> Add More</x-jet-label>
      <button type="button" class="btn btn-success" name="add"
      id="add_input" type="button"><i class="fas fa-plus-circle"></i></button>
     
      </div>
</div>

      </div>

      <div id="slave_div">
        <div class="col-md-1 form-group">
          <div class="col form-group">
            <x-jet-label class="label"> Add More</x-jet-label>
              <input type="button" class="btn btn-danger" name="add"
              id="add_input" type="button"><i class="fas fa-plus-circle"></i></button>
             
              </div>
        </div>
      </div>

        <x-jet-button>Register Student</x-jet-button>
     
    </form>
      </div>
    </div>
          
 


          <script>
              $(document).ready(function () {
                
                  $("#add_input").click(function (e) { 
               
                    var copySlot = $("#master_div").clone(); // clone here 
                    $('label', copySlot).hide(); // hide Clone Label
                    $('button', copySlot).hide(); // hide Clone Label
                    copySlot.appendTo("#slave_div"); // append now
                     
                //   var clone=$('#master_div').clone().find("label", "#add_input").hide().end().appendTo('#slave_div');
                  
  
                  });

                  $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#slave_div').remove();
            });
        
              });


           

          </script>


    
</x-app-layout>

 