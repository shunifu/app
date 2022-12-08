<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light">
              <div class="card-header">
                @foreach ($school_info as $item)
                <h3 class="card-title">{{$item->school_name}} Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
           
              <form action="{{route('school.edit')}}" method="post" enctype="multipart/form-data">
               
                <div class="card-body">
                      @csrf
                     
                      <div class="form-group">
                        <x-jet-label>School Name</x-jet-label>
                        <x-jet-input name="school_name" value="{{$item->school_name}}"></x-jet-input>
                        @error('school_name')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>
            
                        <div class="form-group">
                            <x-jet-label>School Slogan</x-jet-label>
                            <x-jet-input name="school_slogan" value="{{$item->school_slogan}}" ></x-jet-input>
                            @error('school_slogan')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>
            
                        <div class="form-group">
                            <x-jet-label>School Code</x-jet-label>
                            <x-jet-input name="school_code" value="{{$item->school_code}}" ></x-jet-input>
                            @error('school_code')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>
            
                        <div class="form-group">
                            <x-jet-label>School Type</x-jet-label>
                            <select class="form-control" name="school_type">
            
                            <option value="{{$item->school_type}}">{{$item->school_type}}</option>
                            <option value="0">Kindergerten</option>
                            <option value="1">Primary School</option>
                            <option value="2">Secondary School</option>
                            <option value="3">High School</option>
                            </select>
                            @error('school_type')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>
            
                    
            
                        <div class="form-group">
                            <x-jet-label>Contact Number</x-jet-label>
                            <x-jet-input name="school_number"  value="{{$item->school_telephone}}" ></x-jet-input>
                            @error('school_number')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>
            
                        <div class="form-group">
                            <x-jet-label>Email Address</x-jet-label>
                            <x-jet-input name="school_email" value="{{$item->school_email}}"></x-jet-input>
                            @error('school_email')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>
            
                        
                    
                        <div class="form-group">
                            <x-jet-label>School Logo</x-jet-label><br>
                            <img src={{$item->school_logo}} width="36" class=" brand-image img-circle" style="opacity: .8" />
                            <input name="school_logo" type="file" />
                            @error('school_logo')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>
            
                        <div class="form-group">
                            <x-jet-label>School LetterHead</x-jet-label><br>
                            <img src={{$item->school_letter_head }} width="36" class=" brand-image img-thumbnail" style="opacity: .8" />
                            <input name="school_letter_head" type="file" />
                            @error('school_letter_head')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>
                        <div class="form-group">
                            <x-jet-label>Background Image</x-jet-label><br>
                            <img src={{$item->school_background_image }} width="36" class=" brand-image img-thumbnail" style="opacity: .8" />
                            <input name="background_image" type="file" />
                            @error('background_image')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label>Principal Signature</x-jet-label><br>
                            <img src={{$item->base64 }} width="36" class=" brand-image img-thumbnail" style="opacity: .8" />
                            <input name="principal_signature" type="file" />
                            @error('principal_signature')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label>School Stamp</x-jet-label><br>
                            <img src={{$item->school_stamp }} width="36" class=" brand-image img-thumbnail" style="opacity: .8" />
                            <input name="school_stamp" type="file" />
                            @error('school_stamp')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                </div>
                <input type="hidden" name="id" value="{{$item->id}}"/>
                
                <!-- /.card-body -->
            
                <div class="card-footer">
                  <x-jet-button>Edit {{$item->school_name}} data</x-jet-button>
                </div>
            </form>
            @endforeach
            </div>
      
      
        </div>
    
            
          </div>  
    
</x-app-layout>

 