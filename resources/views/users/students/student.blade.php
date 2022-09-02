<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="row">
        <div class="col-md-10">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Student Admission</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('student.edit')}}" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-row">

                       <div class="col-md-4 form-group">
                        <x-jet-label>First Name</x-jet-label>
                        <x-jet-input name="first_name" value="{{}}" placeholder="First Name" ></x-jet-input>
                        @error('first_name')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                       </div>

                       <div class="col-md-4  form-group">
                        <x-jet-label>Middle Name</x-jet-label>
                        <x-jet-input name="middle_name" required  placeholder="Middle Name" ></x-jet-input>
                        @error('middle_name')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                       </div>

                       <div class="col-md-4 form-group">
                        <x-jet-label>Last Name</x-jet-label>
                        <x-jet-input name="last_name" required  placeholder="Last Name" ></x-jet-input>
                        @error('last_name')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                        <div class="col-md-4 form-group">
                            <x-jet-label>National ID</x-jet-label>
                            <x-jet-input name="national_id"  type="number" placeholder="National ID" ></x-jet-input>
                            @error('national_id')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>
                        
                        <div class="col-md-4 form-group">
                            <x-jet-label>Date of Birth</x-jet-label>
                            <x-jet-input name="date_of_birth" type="date" required  ></x-jet-input>
                            @error('date_of_birth')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>

                        <div class="col-md-4 form-group">
                            <x-jet-label>Gender</x-jet-label>
                            <select class="form-control" name="gender">
                                <option value="0">Select Gender</option>
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
                            <option value="0">Select Academic Year</option>
                            @foreach ($session as $academic_session)
                            <option value={{$academic_session->id}}>{{$academic_session->academic_session}}</option>
                            @endforeach
                            </select>
                            @error('grade')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <x-jet-label>Class</x-jet-label>
                                <select class="form-control" name="grade">
                                <option value="0">Select Class</option>
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
                        <x-jet-label>Student Cell Number</x-jet-label>
                        <x-jet-input name="cell_number"  type="number"   placeholder="Cellphone Number" ></x-jet-input>
                        @error('cell_number')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                        <div class="col-md-6 form-group">
                        <x-jet-label>Student Email Address</x-jet-label>
                        <x-jet-input name="email_address" type="email"  placeholder="Email Address" ></x-jet-input>
                        @error('email_address')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                      </div>

                       <hr>
                      
<p class="lead strong">Parent Contact Information</p>

<div class="form-row">
<div class="col-md-6 form-group">
    <x-jet-label>Parent Cell</x-jet-label>
    <x-jet-input name="parent_cell" type="number" required  placeholder="Parent cell" ></x-jet-input>
    @error('parent_surname')
    <span class="text-danger">{{$message}}</span>  
    @enderror
    </div>

    
<div class="col-md-6 form-group">
    <x-jet-label>Parent Email</x-jet-label>
    <x-jet-input name="parent_email" type="email"  required placeholder="Parent Email" ></x-jet-input>
    @error('parent_email')
    <span class="text-danger">{{$message}}</span>  
    @enderror
    </div>

 </div>
                                
                </div>
                <!-- /.card-body -->
      
                <div class="card-footer">
                  <x-jet-button>Add Student</x-jet-button>
                </div>
            </form>
            </div>
      
      
        </div>

            
          </div>  
    
</x-app-layout>

 