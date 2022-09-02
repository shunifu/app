<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light  ">
              <div class="card-header">
                <h3 class="card-title">Add Teaching Loads</h3>
              </div>

                <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_320,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:Transfer Students,w_0.3,y_0.28/v1613303961/pexels-photo-5212359_ukdzdz.jpg" alt="">
                <div class="card-body">
                  <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
                 <div class="text-muted">
                    <p class="card-text">  Use this section to transfer students. <br>
                  
                    </p>
                  
                 </div>
                
                </div>
                
              
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('students.gets_students')}}" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-row">
                      <div class="col-md-12 form-group">
                        <x-jet-label> Stream Name</x-jet-label>
                       <select class="form-control" name="grade">
                        <option value="">Select Stream</option>
                        @foreach ($grades as $grade)
                        <option value="{{$grade->id}}">{{$grade->grade_name}}</option>
                            
                        @endforeach
                       </select>
                        @error('stream')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>


                </div>
                </div>
                <!-- /.card-body -->
      
                <div class="card-footer">
                  <x-jet-button>Load Students</x-jet-button>
                </div>
            </form>
            </div>
      
        </div>
     
            
          </div>  
    
</x-app-layout>

 