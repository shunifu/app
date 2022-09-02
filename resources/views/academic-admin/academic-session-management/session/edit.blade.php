<x-app-layout>
    <x-slot name="header">
  
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Academic Session</h3>
      </div>
  
        <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.60/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_35_style_light_align_center:Edit Session,w_0.2,y_0.28/v1615231896/Untitled_design_7_bahmem.png" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to manage the school's academic sessions. <br>
          
            </p>
          
         </div>
        
        </div>
    </div> 
  <div class="row">
    
  <div class="col">
  
    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title"><a href="/academic-admin/session"><i class="fas fa-hand-point-left"></i></a> Edit Academic Session</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('session.update')}}" method="post">
          <div class="card-body">
            
            @csrf
          <div class="form-group">
              <x-jet-label> Academic Year</x-jet-label>
        <x-jet-input name="academic_year" value="{{$session->academic_session}}" class="col-4" type="text"  ></x-jet-input>
              @error('academic_year')
              <span class="text-danger">{{$message}}</span>  
              @enderror
             
          </div>
          <input type="hidden" name="session_id" value="{{$session->id}}" >
         <div class="form-check form-check-inline">
           <label class="form-check-label">
               @if ($session->active==1)
               <p>
                {{$session->academic_session}} is  active. To make the year {{$session->academic_session}} inactive,  go back and select another year and then make that year active. 
                </p>
               
               @else
               <p>
               {{$session->academic_session}} is not active. To make the year {{$session->academic_session}} active,  check the check-box below, and then click update.
               {{$active=" "}}
               {{$active_status="true"}}


               </p>
               <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" name="status" id="status" value="{{$active_status}}" {{$active}}> Make <span class="text-bold">{{$session->academic_session}}</span> Active
                </label>
              </div>
               
               @endif

               {{-- <div class="form-check">
                   <label class="form-check-label">
    <input type="radio" class="form-check-input" name="status" id="status" value="{{$active_status}}" {{$active}}>
                  Make Active
                 </label>
               </div> --}}
            
               {{-- <div class="form-check">
                <label class="form-check-label">
                <input type="radio" class="form-check-input" name="status" id="status" value="{{$active_status}}"  {{$active}} >
               Make Inactive
              </label>
            </div> --}}


         
       

           </label>
         </div>
  
  
  
               
          </div>
          <!-- /.card-body -->
  
          <div class="card-footer">
            <x-jet-button>Update Academic Session </x-jet-button>
          </div>
       
      </div>
    </form>
  
  </div>
  

      
    </div>   
   
     
    
  </x-app-layout>