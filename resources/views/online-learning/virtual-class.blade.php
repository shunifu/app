<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Manage Virtual Classes</h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.80/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_34_style_light_align_center:Add Classes,w_0.2,y_0.14/v1615202389/Untitled_design_1_oaroft.png" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to add virtual classes <br>
          
            </p>
          
         </div>
        
        </div>
    </div> 
<div class="row">
    
  <div class="col-md-4">

    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">Add Virtual Class</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('virtual-class.store')}}" method="post">
          <div class="card-body">
            
                @csrf
                <div class="form-group">
                <x-jet-label>Meeting Topic</x-jet-label>
                <x-jet-input name="meeting_name" placeholder=" e.g Revision" ></x-jet-input>
                @error('meeting_name')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

              <input type="hidden" name="meeting_type" value="2"/>
              <input type="hidden" name="timezone" value="Africa/Mbabane"/>

                <div class="form-group">
                <x-jet-label>Class</x-jet-label>
               <select class="form-control" name="teaching_load">
                <option value="">Select Class</option>
                @foreach ($teaching_loads as $teaching_load)
                <option value="{{$teaching_load->id}}">{{$teaching_load->grade_name}}-{{$teaching_load->subject_name}}</option>
                @endforeach
               </select>
                @error('teaching_load')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

                <div class="form-group">
                <x-jet-label>Start Time</x-jet-label>
              
                @error('start_time')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

                <div class="form-group">
                  <x-jet-label>End Time</x-jet-label>
                  @error('end_time')
                  <span class="text-danger">{{$message}}</span>  
                  @enderror
                  </div>

               
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <x-jet-button>Add Class</x-jet-button>
          </div>
       
      </div>
    </form>

  </div>

  <div class="col-md-8">

    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Manage Classes</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      
        <div class="card-body">
          
          <table class="table">
            <thead>
              <tr>
                <th>Class Name</th>
                <th>Class Stream</th>
                <th>Class Section</th>
                <th>Manage</th>
              </tr>
            </thead>
            <tbody>
              <tr>
            
              </tr>
              
            </tbody>
          </table>
        </div>

     
    </div>

  </div>
      
    </div>   
            
     
    
</x-app-layout>