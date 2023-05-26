<x-app-layout>
    <x-slot name="header">
<style>
    /* table {
        /* border: none;
    border-collapse: separate;
    border-spacing: 1.5em; */
  
    
table{
   
    border-spacing: 1.5em; 
}

  td {
  border: 1px solid;
 
}

</style>

        {{-- <div class="card border-primary">
          <img class="card-img-top" src="holder.js/100px180/" alt="">
          <div class="card-body"> --}}
              {{-- <table class="table t table-responsive">

              
                  
                      <tbody>
                          
                          <tr>
                            
                              <td width="25%"><br>
                            <img class="user-image img-circle "  src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </td>

                              <td width="25%"> <br>
                                  <h6 class="font-weight-light text-bold text-muted" >Student Name</h6>
                                  
                                  <div class="row">
                <div class="col"><h5 class="small text-bold text-muted" >{{$result_user->lastname}} {{$result_user->name}} {{$result_user->middlename}}</h5></div>
                                    </div>

                <h6 class="font-weight-light text-muted" >Student Class</h6>
                                    <div class="row">
                            <div class="col">
                            <h6 class="small text-bold text-muted" >{{$result_class->grade_name}}-{{$result_class->academic_session}}</h6>
                            </div>
                            </div>

                            </td>

                            <td width="25%"><br>
                                <h6 class="font-weight-light text-muted">Status</h6>
                               @if ($result_user->active==1)
                                   <h5 class="text-success text-bold">Active</h5>
                               @else
                               <h6 class="text-danger text-bold">Inactive</h6>
                               @endif
                                {{-- <div class="row">
                                <div class="col"><span class="small text-bold text-muted" >Class</span></div>
                                <div class="col"><span class="small text-bold text-muted" >Session</span></div>
                                </div> --}}
                            {{-- </td>
                          
                          </tr>

                         
                      </tbody>
              </table>  --}}
           
        
          {{-- </div>
        </div> --}}


        <div class="row">
            
            <!-- /.col -->
            <div class="col">
              <!-- Widget: user widget style 1 -->
              <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{$result_user->lastname}} {{$result_user->name}} {{$result_user->middlename}}</h3>
                <h5 class="widget-user-desc"></h5>
                </div>
                <div class="widget-user-image">
                @if (!is_null($result_user->profile_photo_path))
                <img class="img-circle elevation-2" src="{{$result_user->profile_photo_path}}" alt="{{$result_user->name}}">   
                @else
                <img class="img-circle elevation-2" src="https://ui-avatars.com/api/?name={{$result_user->name}}+&color=7F9CF5&background=EBF4FF" alt="{{$result_user->name}}">   
                 @endif
               
                </div>
                <div class="card-footer bg-white">
                  <div class="row">
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">Class</h5>
                        <span class="description-text">{{$result_class->grade_name}}</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">Year</h5>
                        <span class="description-text">{{$result_class->academic_session}}</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header">Status</h5>
                        <span class="description-text">@if ($result_user->active==1)
                            <h5 class="text-success text-bold">Active</h5>
                        @else
                        <h6 class="text-danger text-bold">Inactive</h6>
                        @endif</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
              </div>
              <!-- /.widget-user -->
            </div>
            <!-- /.col -->
           
          </div>
        
        {{-- <div class="card">
          <img class="card-img-top" src="holder.js/100px180/" alt="">
          <div class="card-body">
            {{-- <h4 class="card-title">{{$result_user->name}}'s Profile</h4> --}}
            {{-- <p class="card-text"> --}}
{{-- <div class="row"> --}}
{{-- details --}}
{{-- <div class="col" > --}}

    {{-- <div class="card border-light">
     
      <div class="card-body">
          <div class="row">
            <div class="col"> --}}

                {{-- <p class="card-text"><img class="user-image img-circle "  width="64" height="64" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </p> --}}
        
            {{-- </div> 
            <div class="col">

                <p class="card-text"><img class="user-image img-circle "  width="64" height="64" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </p>
        
            </div>  --}}

            {{-- <div class="col border-light">

                <p class="card-text"><img class="user-image img-circle "  width="64" height="64" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </p>
        
            </div> 
          </div>
   
       
      </div>
    </div>
     --}}
    
{{-- end of details --}}
    {{-- <div class="col"></div>
    <div class="col"></div> --}}
{{-- </div>
            </p>
          </div>
        </div> --}} 
    </x-slot>
    <div class="container-fluid"></div>
    <div class="row ">

        {{-- <div class="col-md-4 ">
            <div class="card card-default card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        @if(is_null($result_user->profile_photo_path))
                        @else
                            <img src="/storage/{{ $result_user->profile_photo_path }}"
                                class="user-image img-circle elevation-1" width="128" height="128"
                                alt="{{ $result_user->name }} {{ $result_user->lastname }} " />
                        @endif



                    </div>
                    <h3 class="profile-username text-center">{{ $result_user->name }} {{ $result_user->middlename }}
                        {{ $result_user->lastname }}</h3>
                    <p class="text-muted text-center">{{ $result_class->grade_name }}</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">

                            <b>Gender</b> <a class="float-right">

                                @if(is_null($result_user->gender))
                                    <?php //echo "Gender not set" ?>
                                @else
                                    {{ $result_user->gender }}
                                @endif

                            </a>
                        </li>

                        <li class="list-group-item">
                            <b>Age</b> <a class="float-right">
                                @if(is_null($result_user->date_of_birth))
                                    <?php// echo "DOB not set" ?>
                                @else
                                    {{ $result_user->date_of_birth }}
                                @endif

                            </a>
                        </li>

                        {{-- <li class="list-group-item">
                            <b>National ID</b> <a class="float-right">{{ $result_user->national_id }}</a>
                        </li> --}}
                        {{-- <li class="list-group-item">
                            <b>Email Address</b> <a class="float-right">

                                @if(is_null($result_user->email))
                                 ///   <?php //echo "Email not set" ?>
                                @else
                                    {{ $result_user->date_of_birth }}
                                @endif

                                {{ $result_user->email }}
                            </a>
                        </li>

                        
                    </ul>
                    <div class="row">
                        <div class="col">



                            <a href="password/reset/{{ $result_user->id }}"><button
                                    class="btn form-control btn-primary "><i class="fa fa-file-text"></i>Reset
                                    Password</button></a>
                        </div> --}}
                        {{-- <div class="col">
                            
                            <a href="student/delete/{{ $result_user->id }}"><button
                            class="btn form-control btn-info "><i class="fa fa-file-text"></i>Delete</button></a>
                    </div> --}}


                {{-- </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div> --}} 

    <div class="col">

        <div class="card card-default card-outline">

            <div class="card-header p-2">
                <ul class="nav nav-pills nav-fill nav-justified flex-column flex-sm-row">
                <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Bio</a></li>
                <li class="nav-item"><a class="nav-link" href="#fees" data-toggle="tab">Fees</a></li>
                <li class="nav-item"><a class="nav-link" href="#parents" data-toggle="tab">Parents</a></li>
                <li class="nav-item"><a class="nav-link" href="#attendence" data-toggle="tab">Attendance</a></li>
                <li class="nav-item"><a class="nav-link" href="#reports" data-toggle="tab">Report Cards</a></li>
                <li class="nav-item"><a class="nav-link" href="#analytics" data-toggle="tab">Analytics</a></li>
                <li class="nav-item"><a class="nav-link" href="#discipline" data-toggle="tab">Disciplinary Cases</a></li> 
                <li class="nav-item"><a class="nav-link" href="#access_control" data-toggle="tab">Communication</a></li> 
                </ul>
            </div>

       

            <div class="card-body ">
                <div class="tab-content ">

                    <div class=" tab-pane" id="access_control">
                        {{-- <form action="/send/single/parent" method="post">
                            @csrf
                            <input type="hidden" value="{{ $result_parent->cell_number }}" name="parent_number">


                            <div class="col-md-6 form-group">
                                <x-jet-label>Message </x-jet-label>
                                <textarea class="form-control" maxlength="160" name="parent_msg" id="" placeholder="parent message" cols="30" rows="10"></textarea>
                                @error('parent_msg')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


            
                            

                            <div class="col-md-6 form-group">
                                <button class="btn btn-success">Send Message</button>
                            </div>

                           
                        </form> --}}
                    </div>
                    <div class="active tab-pane" id="profile">


                        <form action="{{ route('student.update') }}" method="post">

                            <div class="card-body">
                                @csrf
                                <input type="hidden" value="{{ $result_user->id }}" name="id">
                                <div class="form-row">

                                    {{-- <div class="col-md-2 form-group">
                                            <x-jet-label>School ID</x-jet-label>
                                            <x-jet-input name="user_code" readonly value="{{ $result_user->user_code }}"
                                    ></x-jet-input>
                                    @error('user_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> --}}

                                <div class="col-md-4 form-group">
                                    <x-jet-label>First Name</x-jet-label>
                                    <x-jet-input name="first_name" value="{{ $result_user->name }}"
                                        placeholder="First Name"></x-jet-input>
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4  form-group">
                                    <x-jet-label>Middle Name</x-jet-label>
                                    <x-jet-input name="middle_name" value="{{ $result_user->middlename }}"
                                        placeholder="Middle Name">
                                    </x-jet-input>
                                    @error('middle_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 form-group">
                                    <x-jet-label>Last Name</x-jet-label>
                                    <x-jet-input name="last_name" value="{{ $result_user->lastname }}">
                                    </x-jet-input>
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <x-jet-label>Cell Number </x-jet-label>
                                    <x-jet-input name="cell_number" type="number"
                                        value="{{ $result_user->cell_number }}"></x-jet-input>
                                    @error('cell_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <x-jet-label>Email </x-jet-label>
                                    <x-jet-input name="email" type="email" value="{{ $result_user->email }}">
                                    </x-jet-input>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 form-group">
                                    <x-jet-label>National ID</x-jet-label>
                                    <x-jet-input name="national_id" type="number"
                                        value="{{ $result_user->national_id }}"></x-jet-input>
                                    @error('national_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 form-group">
                                    <x-jet-label>Date of Birth</x-jet-label>
                                    <x-jet-input name="date_of_birth" value="{{ $result_user->date_of_birth }}"
                                        type="date">
                                    </x-jet-input>
                                    @error('date_of_birth')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 form-group">
                                    <x-jet-label>Gender</x-jet-label>
                                    <select class="form-control" name="gender">

                                        <option>{{ $result_user->gender }} </option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <hr>
                                </div>

                                <div class="form-group col-md-12">

                                    <h4 class="lead">{{ $result_user->name }}'s parent details</h4>
                                </div>
                                <div class="form-group col-md-12">
                                    <hr>
                                </div>
                                @if(empty($result_parent))

                                    <div class="col-md-2 form-group">
                                        <x-jet-label>Salutation</x-jet-label>
                                        <select class="form-control" name="parent_salutation">
                                            <option value="">Salutation</option>
                                            <option value="Mr.">Mr.</option>
                                            <option value="Mrs.">Mrs.</option>
                                            <option value="Miss.">Miss.</option>
                                        </select>


                                        @error('parent_salutation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-5 form-group">
                                        <x-jet-label>Parent Name</x-jet-label>
                                        <x-jet-input name="parent_name" placeholder="Name of Parent"
                                            value="{{ old('parent_name') }}"></x-jet-input>
                                        @error('parent_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-md-5 form-group">
                                        <x-jet-label>Parent Surname</x-jet-label>
                                        <x-jet-input name="parent_surname"
                                            value="{{ old('parent_surname') }}"
                                            placeholder="Surname of Parent"></x-jet-input>
                                        @error('parent_lastname')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-md-6 form-group">
                                        <x-jet-label>Parent Cell Number</x-jet-label>
                                        <x-jet-input name="parent_cell" placeholder="Parent CellNumber"
                                            value="{{ old('parent_cell') }}" type="number">
                                        </x-jet-input>
                                        @error('parent_cell')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <x-jet-label>Parent Email</x-jet-label>
                                        <x-jet-input name="parent_email"
                                            value="{{ old('parent_email') }}"
                                            placeholder="Parent Email" type="email"></x-jet-input>
                                        @error('parent_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                @else

                                    <div class="col-md-2 form-group">
                                        <x-jet-label>Salutation</x-jet-label>
                                        <select class="form-control" name="parent_salutation">

                                            <option>{{ $result_parent->salutation }} </option>
                                            <option value="Mr.">Mr.</option>
                                            <option value="Mrs.">Mrs.</option>
                                            <option value="Miss.">Miss.</option>
                                        </select>


                                        @error('parent_salutation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <x-jet-label>Parent Name</x-jet-label>
                                        <x-jet-input name="parent_name" value="{{ $result_parent->name }}">
                                        </x-jet-input>
                                        @error('parent_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <x-jet-label>Parent Middle Name</x-jet-label>
                                        <x-jet-input name="parent_middlename"
                                            value="{{ $result_parent->middlename }}"></x-jet-input>
                                        @error('parent_middlename')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <x-jet-label>Parent Surname</x-jet-label>
                                        <x-jet-input name="parent_surname" value="{{ $result_parent->lastname }}">
                                        </x-jet-input>
                                        @error('parent_lastname')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-md-6 form-group">
                                        <x-jet-label>Parent Cell Number</x-jet-label>
                                        <x-jet-input name="parent_cell" value="{{ $result_parent->cell_number }}"
                                            type="number"></x-jet-input>
                                        @error('parent_cell')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <x-jet-label>Parent Email</x-jet-label>
                                        <x-jet-input name="parent_email" value="{{ $result_parent->email }}"
                                            type="email"></x-jet-input>
                                        @error('parent_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                @endif

                            </div>





                            <!-- /.form row -->


                            <x-jet-button>Update Student</x-jet-button>
                    </div>
                    <!-- /.card row -->

                </div>
                <!-- /.end of tab-->


                <div class=" tab-pane" id="fees">
                    Fees
                </div>

                <div class=" tab-pane" id="attendence">
                    Attendenc
                </div>
                <div class=" tab-pane" id="report_cards">
                    Report Cards
                </div>
                <div class=" tab-pane" id="analytics">
                    Analytics
                </div>
                <div class=" tab-pane" id="parents">
                    Parents
                </div>
                <div class=" tab-pane" id="reports">
                    reports
                </div>
                <div class=" tab-pane" id="discipline">
                   Disciplinary Cases
                </div>

            </div>

            <!-- /.tab-pane -->


        </div>

    </div>
    </div>

</x-app-layout>
