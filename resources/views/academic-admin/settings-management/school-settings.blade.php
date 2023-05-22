<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Add School</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            
             <form action="{{route('school.store')}}" method="post"  enctype="multipart/form-data">
                <div class="card-body">
                      @csrf
                      <div class="form-group">
                        <x-jet-label>School Name</x-jet-label>
                        <x-jet-input name="school_name" placeholder="Name of School" ></x-jet-input>
                        @error('school_name')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label>School Slogan</x-jet-label>
                            <x-jet-input name="school_slogan" placeholder="Slogan of School" ></x-jet-input>
                            @error('school_slogan')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>

                        <div class="form-group">
                            <x-jet-label>School Code</x-jet-label>
                            <x-jet-input name="school_code" placeholder="Government Code" ></x-jet-input>
                            @error('school_code')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label>School Type</x-jet-label>
                            <select class="form-control" name="school_type">
                            <option value="">Select School Type</option>
                            <option value="0">Kindergerten</option>
                            <option value="primary-school">Primary School</option>
                            <option value="2">Secondary School</option>
                            <option value="high-school">High School</option>
                            <option value="Prevoc">Prevocational School</option>
                            <option value="tvet">TVET</option>
                            <option value="college">College</option>
                            <option value="university">University</option>
                            </select>
                            @error('school_type')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                    

                        <div class="form-group">
                            <x-jet-label>Contact Number</x-jet-label>
                            <x-jet-input name="school_number"  placeholder="School Line" ></x-jet-input>
                            @error('school_contact_number')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label>Email Address</x-jet-label>
                            <x-jet-input name="school_email"  placeholder="school@school.shunifu.app" ></x-jet-input>
                            @error('school_email')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label>School Logo</x-jet-label><br>
                            <input name="school_logo" type="file" />
                            @error('school_logo')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label>School LetterHead</x-jet-label><br>
                            <input name="school_letter_head" type="file" />
                            @error('school_letter_head')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label>Background Image</x-jet-label><br>
                            <input name="background_image" type="file" />
                            @error('background_image')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label>Principal Signature</x-jet-label><br>
                            <input name="principal_signature" type="file" />
                            @error('principal_signature')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label>School Stamp</x-jet-label><br>
                            <input name="school_stamp" type="file" />
                            @error('school_stamp')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>
                </div>
                <!-- /.card-body -->
      
                <div class="card-footer">
                  <x-jet-button>Add School</x-jet-button>
                </div>
            </form> 

            </div>
      
      
        </div>
    
            
          </div>  
    
</x-app-layout>

 