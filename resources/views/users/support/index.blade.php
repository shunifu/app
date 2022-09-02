<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Add Support Staff </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('support.store')}}" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-row">

                        <div class="col-md-3 form-group">
                          <x-jet-label>Salutation</x-jet-label>
                         <select class="form-control" name="salutation">
                           <option>Select Salutation</option>
                           <option value="Mr.">Mr.</option>
                           <option value="Mrs.">Mrs.</option>
                           <option value="Miss.">Miss.</option>
                         </select>
                          @error('first_name')
                          <span class="text-danger">{{$message}}</span>  
                          @enderror
                         </div>

                       <div class="col-md-3 form-group">
                        <x-jet-label>First Name</x-jet-label>
                        <x-jet-input name="first_name" required  placeholder="First Name" ></x-jet-input>
                        @error('first_name')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                       </div>

                       <div class="col-md-3  form-group">
                        <x-jet-label>Middle Name</x-jet-label>
                        <x-jet-input name="middle_name" required  placeholder="Middle Name" ></x-jet-input>
                        @error('middle_name')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                       </div>

                       <div class="col-md-3 form-group">
                        <x-jet-label>Last Name</x-jet-label>
                        <x-jet-input name="last_name" required  placeholder="Last Name" ></x-jet-input>
                        @error('last_name')
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

                            <div class="col-md-4 form-group">
                              <x-jet-label>National ID</x-jet-label>
                              <x-jet-input name="national_id"  type="number" placeholder="National ID" ></x-jet-input>
                              @error('national_id')
                              <span class="text-danger">{{$message}}</span>  
                              @enderror
                              </div>

          <div class="col-md-4 form-group">
            <x-jet-label>Role</x-jet-label>
              <select class="form-control" name="role_id" required>
                <option>Select Role</option>
                   @foreach ($bursar as $bursar_item)  
                    <option value="{{$bursar_item->id}}">{{$bursar_item->display_name}}</option>
                       @endforeach
                          @foreach ($office_administrator as $office_administrator_item)
                                   <option value="{{$office_administrator_item->id}}">{{$office_administrator_item->display_name}}</option>
                               @endforeach
                               @foreach ($admin_bursar as $admin_bursar_item)
                               <option value="{{$admin_bursar_item->id}}">{{$admin_bursar_item->display_name}}</option>
                           @endforeach
                               </select>
                                @error('role_id')
                                <span class="text-danger">{{$message}}</span>  
                                @enderror
                                </div>

                        <!--contacts--->
                        <div class="col-md-4 form-group">
                        <x-jet-label> Cell Number</x-jet-label>
                        <x-jet-input name="cell_number"  type="number"   placeholder="Cellphone Number" ></x-jet-input>
                        @error('cell_number')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                        <div class="col-md-4 form-group">
                        <x-jet-label>Email Address</x-jet-label>
                        <x-jet-input name="email_address" type="email"  placeholder="Email Address" ></x-jet-input>
                        @error('email_address')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                      </div>

                       <hr>
      
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <x-jet-button>Add User</x-jet-button>
                </div>
            </form>
            </div>
      
      
        </div>

            
          </div>  
    
</x-app-layout>

 