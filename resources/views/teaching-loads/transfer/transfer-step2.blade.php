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
              <form action="{{route('teaching_loads_transfer.step3')}}" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-row">
                      <div class="col-md-6 form-group">
                        <x-jet-label> Transfer To</x-jet-label>
                       <select class="form-control" name="transfer_to">
                        <option value="">Select Teaching Loads</option>
                        @foreach ($match as $teaching_load)
                        <option value="{{$teaching_load->id}}">{{$teaching_load->lastname}} {{$teaching_load->name}}--{{$teaching_load->subject_name}}--{{$teaching_load->grade_name}}</option>
                        @endforeach
                       </select>
                        @error('transfer_to')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <x-jet-label> Transfer Type</x-jet-label>
                           <select class="form-control" name="transfer_type">
                            <option value="">Select Transfer Type</option>
                            <option value="all">Transfer All Students</option>
                            <option value="some">Transfer Some Students</option>
                           </select>
                            @error('transfer_type')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>

                        {{-- <div class="col-md-6 form-group">
                            <x-jet-label>Transfer To</x-jet-label>
                           <select class="form-control" name="transfer_to">
                            <option value="">Transfer To</option>
                            @foreach ($all_teaching_loads as $all)
                            <option value="{{$all->id}}">{{$all->lastname }} {{$all->name }}-{{$all->grade_name }} {{$all->subject_name}}</option>
                            @endforeach
                           </select>
                            @error('transfer_to')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div> --}}

                       
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

 