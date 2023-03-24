<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Student Registration Portal</h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_32_style_light_align_center:Single-Student%20Registration Form,w_0.4,y_0.18/v1650135733/pexels-rodnae-productions-10375992_1_shjypq.jpg">
        <div class="card-body">
          <h4 class="lead">Student Registration Portal</h4>
         
          <hr>
         <div class="text-muted">
          Hi, <span class="text-bold">{{Auth::user()->salutation}} {{Auth::user()->lastname}}</span>. Welcome to the  single-student-add pathway. This is where you add a single student at a time. Below is a form where you will add the needed student details. <br>
          To go back click <a href="/users/student">here</a> 
         </div>
       
        </div>
    </div> 
    <div class="row">
        <div class="col">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Single-Add  Registration Pathway</h3>
              </div>


              <div class="card-body">
              
                             <!-- form start -->
              <form action="{{route('pathway.single_store')}}" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-row">

                       <div class="col-md-4 form-group">
                        <x-jet-label>First Name</x-jet-label>
    <x-jet-input name="first_name" required value="{{ old('first_name') }}" placeholder="First Name" ></x-jet-input>
                        @error('first_name')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                       </div>

                       <div class="col-md-4  form-group">
                        <x-jet-label>Middle Name</x-jet-label>
                        <x-jet-input name="middle_name" value="{{ old('middle_name') }}" placeholder="Middle Name" ></x-jet-input>
                        @error('middle_name')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                       </div>

                       <div class="col-md-4 form-group">
                        <x-jet-label>Last Name</x-jet-label>
                        <x-jet-input name="last_name" required value="{{ old('last_name') }}" placeholder="Last Name" ></x-jet-input>
                        @error('last_name')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                        <div class="col-md-4 form-group">
                            <x-jet-label>National ID</x-jet-label>
                            <x-jet-input name="national_id" value="{{ old('national_id') }}"  readonly  type="number"  maxlength="13" placeholder="National ID" ></x-jet-input>
                            @error('national_id')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>
                        
                        <div class="col-md-4 form-group">
                            <x-jet-label>Date of Birth</x-jet-label>
                            <x-jet-input name="date_of_birth" type="date" value="{{ old('date_of_birth') }}"  readonly  ></x-jet-input>
                            @error('date_of_birth')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>

                        <div class="col-md-4 form-group">
                            <x-jet-label>Gender</x-jet-label>
                            <select class="form-control" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            @error('gender')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>

                            <div class="col-md-6 form-group">
                            <x-jet-label>Academic Year</x-jet-label>
                            <select class="form-control" name="session">
                            <option value="">Select Academic Year</option>
                            @foreach ($session as $academic_session)
                            <option value={{$academic_session->id}}>{{$academic_session->academic_session}}</option>
                            @endforeach
                            </select>
                            @error('session')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <x-jet-label>Class</x-jet-label>
                                <select class="form-control" name="grade">
                                <option value="">Select Class</option>
                                @foreach ($class as $student_class)
                                <option value={{$student_class->id}}>{{$student_class->grade_name}}</option>
                                @endforeach
                                </select>
                                @error('grade')
                                <span class="text-danger">{{$message}}</span>  
                                @enderror
                                </div>
                         
                     

                        <!--contacts--->
                        <div class="col-md-6 form-group">
                        <x-jet-label>Student Cell Number <small>Optional</small></x-jet-label>
                        <x-jet-input name="cell_number" value="{{ old('cell_number') }}" readonly  type="number" maxlength="8"   placeholder="Cellphone Number" ></x-jet-input>
                        @error('cell_number')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                        <div class="col-md-6 form-group">
                        <x-jet-label>Student Email Address</x-jet-label>
                        <x-jet-input name="email_address" type="email" value="{{ old('email_address') }}" readonly  placeholder="Email Address" ></x-jet-input>
                        @error('email_address')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                      </div>

                       <hr>
                      
{{-- <p class="lead strong">Parent Contact Information</p>

<div class="form-row">
<div class="col-md-6 form-group">
    <x-jet-label>Parent Cell</x-jet-label>
    <x-jet-input name="parent_cell" type="number" maxlength="8" value="{{ old('parent_cell') }}"  placeholder="Parent cell" ></x-jet-input>
    @error('parent_surname')
    <span class="text-danger">{{$message}}</span>  
    @enderror
    </div>

    
<div class="col-md-6 form-group">

    <x-jet-label>Parent Email</x-jet-label>
    <x-jet-input name="parent_email" type="email" value="{{ old('parent_email') }}"    placeholder="Parent Email" ></x-jet-input>
    @error('parent_email')
    <span class="text-danger">{{$message}}</span>  
    @enderror
    </div>

 </div> --}}
                                
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

          
    
</x-app-layout>

 