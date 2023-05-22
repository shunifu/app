<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">In Service Education & Training Workshp Request Form</h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_32_style_light_align_center:Single-Student%20Registration Form,w_0.4,y_0.18/v1650135733/pexels-rodnae-productions-10375992_1_shjypq.jpg">
        <div class="card-body">
          <h4 class="lead">Shunifu Inset Portal</h4>
         
          <hr>
         <div class="text-muted">
          Hi, <span class="text-bold">{{Auth::user()->salutation}} {{Auth::user()->lastname}}</span>. Welcome to the IN-Service Education & Training Workshop Management section. You will use this section to send workshop requests to the Ministry of Education's Inservice Education & Training Team <br>
          To go back click <a href="/users/student">here</a> 
         </div>
       
        </div>
    </div> 
    <div class="row">
        <div class="col">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Workshop Request Form</h3>
              </div>


              <div class="card-body">
              
                             <!-- form start -->
              <form action="{{route('insetworkshop.store')}}" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-row">

                       <div class="col-md-6 form-group">
                        <x-jet-label>Workshop Type</x-jet-label>
                         <select name="workshop_type" class="form-control"  id="workshop_type"> 
                            <option value="">Select Workshop</option>
                            {{-- @foreach ($workshop_types as $type)

                            <option value="{{$type->id}}">{{$type->workshop_type}}</option>
                                
                            @endforeach --}}
                         </select>
                        @error('workshop_type')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                       </div>

                       <div class="col-md-6  form-group">
                        <x-jet-label>Name of Workshop </x-jet-label>
                        <x-jet-input name="workshop_name" value="{{ old('workshop_name') }}" placeholder="Name of Workshop" ></x-jet-input>
                        @error('workshop_name')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                       </div>


                       <div class="col-md-10  form-group">
                        <x-jet-label>Objectives of Workshop </x-jet-label>
                        <x-jet-input name="workshop_objectives" value="{{ old('workshop_name') }}" placeholder="Objectives of Workshop" ></x-jet-input>
                        @error('workshop_objectives')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                       </div>

                       <div class="col-md-4 form-group">
                        <x-jet-label>Proposed starting date & time</x-jet-label>
                        <input type="datetime-local" name="start_datetime" class="form-control"  required value="{{ old('start_datetime') }}" placeholder="Starts" />
                        @error('start_datetime')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                        <div class="col-md-4 form-group">
                            <x-jet-label>Proposed ending date & time</x-jet-label>
                            <input type="datetime-local" name="end_datetime" class="form-control"  required value="{{ old('end_datetime') }}" placeholder="Ends§" />
                            @error('end_datetime')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>
                        
                        <div class="col-md-4 form-group">
                            <x-jet-label>Venue</x-jet-label>
                            <x-jet-input name="venue" type="text" value="{{ old('venue') }}"    ></x-jet-input>
                            @error('venue')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>

                        <div class="col-md-4 form-group">
                            <x-jet-label>Participating Schools</x-jet-label>
                            <select class="form-control" name="participating_schools">
                                <option value="">Select Schools</option>
                                <option value="{{$ourschool->school_code}}">{{$ourschool->school_name}}</option>
                               
                            </select>
                            @error('participating_schools')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>

                            <div class="col-md-4 form-group">
                            <x-jet-label>Total Teachers Attending</x-jet-label>
                            <input type="text" name="teachers_to_attend" id="teachers_to_attend" class="form-control" placeholder="Total Teachers">
                            @error('teachers_to_attend')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>


                            <div class="col-md-4 form-group">
                            <x-jet-label>Training Areas </x-jet-label>
                            <select class="form-control" name="training_areas" id="training_areas">
                            <option value="">Select Areas of Training</option>
                            </select>
                            @error('training_areas')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>
                         

                            <div class="col-md-12 form-group">
                            <x-jet-label>Workshop Description</x-jet-label>
                            <textarea name="workshop_description" class="form-control" id="workshop_description" cols="30" rows="10"></textarea>
                            @error('workshop_description')
                            <span class="text-danger">{{$message}}</span>  
                             @enderror
                            </div>
                        
                      </div>

              
                      
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
                  <x-jet-button>Send Workshop Request</x-jet-button>
                </div>
            </form>

                
              </div>

            </div>
      
      
        </div>

     

     
            
          </div>  

          
    
</x-app-layout>

 