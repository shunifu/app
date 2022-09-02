<x-app-layout>
  <x-slot name="header">
    
  </x-slot>
  <div class="row">
    <div class="col-md-12">
      <div class="card card-light  ">
        <div class="card-header">
          <h3 class="card-title">Manage Teachers</h3>
        </div>
        
          <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_290,w_970/b_rgb:000000,e_gradient_fade,y_-0.60/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_35_style_light_align_center:Teacher Management,w_0.3,y_0.32/v1617765072/pexels-tima-miroshnichenko-5427870_f987ry.jpg" alt="">
      
                          <div class="card-body">
                            <h3 class="lead"> Hi,  {{Auth::user()->name}}</h3>
                           <div class="text-muted">
                              <p class="card-text">
                                  <span class="text-bold">Use this section add teachers</span><br>
You can use either the form or if you have a spreadsheet, you can upload the spreadsheet.
                                    <ul></ul>
                                    
                                
                            
                              </p>
                            
                           </div>
                          
                          </div>
                         
                         
        <!-- /.card-header -->
    </div>
      </div>

    
      <div class="col-md-9">
        <div class="card card-light">
          <div class="card-header">
              <h3 class="card-title">Add Teacher</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('teacher.store')}}" method="post">
              <div class="card-body">
                    @csrf
                    <div class="form-row">

                      <div class="col-md-3 form-group">
                        <x-jet-label>Salutation <small class="text-danger">*</small></x-jet-label>
                       <select class="form-control" name="salutation">
                         <option value="">Select Salutation</option>
                         <option value="Mr.">Mr.</option>
                         <option value="Mrs.">Mrs.</option>
                         <option value="Miss.">Miss.</option>
                       </select>
                        @error('first_name')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                       </div>

                       <div class="col-md-4 form-group">
                        <x-jet-label>First Name <small class="text-danger">*</small></x-jet-label>
                        <x-jet-input name="first_name" required  placeholder="First Name" ></x-jet-input>
                        @error('first_name')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                       </div>

                       <div class="col-md-4  form-group">
                        <x-jet-label>Middle Name <small class="text-danger">*</small></x-jet-label>
                        <x-jet-input name="middle_name" placeholder="Middle Name" ></x-jet-input>
                        
                        @error('middle_name')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                       </div>

                       <div class="col-md-4 form-group">
                        <x-jet-label>Surname <small class="text-danger">*</small></x-jet-label>
                        <x-jet-input name="last_name" required  placeholder="Last Name" ></x-jet-input>
                        @error('last_name')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                       

                        <div class="col-md-4 form-group">
                        <x-jet-label>National ID <small class="text-muted">optional</small></x-jet-label>
                         <x-jet-input name="national_id"  type="number" maxlength="13" placeholder="National ID" ></x-jet-input>
                         
                            @error('national_id')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                          </div>

                          <div class="col-md-4 form-group">
                            <x-jet-label>TSC Number<small class="text-muted">optional</small></x-jet-label>
                             <x-jet-input name="tsc_number"  type="number" maxlength="13" placeholder="TSC Number" ></x-jet-input>
                             
                                @error('national_id')
                                <span class="text-danger">{{$message}}</span>  
                                @enderror
                              </div>
                        
                        <div class="col-md-4 form-group">
                            <x-jet-label>Date of Birth <small class="text-muted">optional</small></x-jet-label>
                            <x-jet-input name="date_of_birth" type="date"   ></x-jet-input>
                            <small class="form-text text-muted">Optional</small>
                            @error('date_of_birth')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>

                        <div class="col-md-4 form-group">
                            <x-jet-label>Gender <small class="text-danger">*</small></x-jet-label>
                            <select class="form-control" name="gender">
                                <option value="0">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            @error('gender')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>

                      <!--contacts--->
                      <div class="col-md-6 form-group">
                      <x-jet-label>Teacher Cell Number <small class="text-danger">*</small></x-jet-label>
                      <x-jet-input name="cell_number"  type="number" maxlength="8" required placeholder="Cellphone Number" ></x-jet-input>
                      
                      @error('cell_number')
                      <span class="text-danger">{{$message}}</span>  
                      @enderror
                      </div>

                      <div class="col-md-6 form-group">
                      <x-jet-label>Teacher Email Address <small class="text-danger">*</small></x-jet-label>
                      <x-jet-input name="email_address" type="email" required placeholder="Email Address" ></x-jet-input>
                      @error('email_address')
                      <span class="text-danger">{{$message}}</span>  
                      @enderror
                      </div>

                    </div>

                     <hr>
    
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <x-jet-button>Add Teacher</x-jet-button>
              </div>
          </form>
          </div>
    
    
      </div>

      <div class="col-md-3">
        <div class="card card-light">

          <div class="card-header">
              <h3 class="card-title">Upload Spreadsheet</h3>
            </div>

          <div class="card-body">
          <form action="{{route('teacher.import')}}" method="post"  enctype="multipart/form-data">
            @csrf
          <input type="file"  name="import">
          <p></p>
          <x-jet-button>Upload Spreadsheet</x-jet-button>
          </form>
        </div>

      </div>

      </div>
          
        </div>  
  
</x-app-layout>

