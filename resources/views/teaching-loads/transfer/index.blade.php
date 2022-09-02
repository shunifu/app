<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light  ">
              <div class="card-header">
                <h3 class="card-title">Transfer Teaching Loads</h3>
              </div>

                <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_320,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:Transfer Teaching Loads,w_0.3,y_0.28/v1613303961/pexels-photo-5212359_ukdzdz.jpg" alt="">
                <div class="card-body">
                  <h3 class="lead">Hi, {{Auth::user()->salutation}} {{Auth::user()->name}} {{Auth::user()->lastname}}</h3>
                 <div class="text-muted">
                    <p class="card-text">  Use this section to transfer teaching loads <br>
                  
                    </p>
                  
                 </div>
                
                </div>
                
              
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('teaching_loads_transfer.step2')}}" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-row">
                      <div class="col-md-4 form-group">
                        <x-jet-label> Select Teaching Load to transfer</x-jet-label>
                       <select class="form-control" name="my_teaching_load">
                        <option value="">Select Teaching Loads</option>
                        @foreach ($my_teaching_loads as $teaching_load)
                        <option value="{{$teaching_load->id}}-{{$teaching_load->teacher_id}} ">{{$teaching_load->grade_name}}-{{$teaching_load->subject_name}}</option>
                        @endforeach
                       </select>
                        @error('my_teaching_load')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                       

                        <div class="col-md-4 form-group">
                            <x-jet-label>Transfer To</x-jet-label>
                           <select class="form-control" name="transfer_to">
                            <option value="">Transfer To</option>
                            @foreach ($teachers as $teacher)
                            <option value="{{$teacher->id}}">{{$teacher->lastname }} {{$teacher->name }} {{$teacher->middlename }}</option>
                            @endforeach
                           </select>
                            @error('transfer_to')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                        <div class="col-md-4 form-group">
                          <x-jet-label>Transfer Type</x-jet-label>
                         <select class="form-control" name="transfer_type">
                          <option value="">Transfer Type</option>
                          <option value="all">All Students</option>
                          {{-- <option value="some">Some Students</option> --}}
                         </select>
                          @error('transfer_type')
                          <span class="text-danger">{{$message}}</span>  
                          @enderror
                      </div>

                       
                </div>
                </div>
                <!-- /.card-body -->
      
                <div class="card-footer">
                  <x-jet-button>Next</x-jet-button>
                </div>
            </form>
            </div>
      
      
        </div>
     
            
          </div>  
    
</x-app-layout>

 