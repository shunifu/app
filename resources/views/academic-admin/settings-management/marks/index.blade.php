<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title"> Mark Settings</h3>
      </div>
      <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_270,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_50_style_light_align_center:Mark Settings,w_0.4,y_0.20/v1651865443/pexels-lukas-669613_oo6fno.jpg"
      alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->salutation}} {{Auth::user()->lastname}}</h3>
         <div class="text-muted">
            <div class="py-1">
                <h4 class="text-bold text-muted">Guidelines for Mark Settings</h4> 
                This section is where you set the mode for mark entering<br>
                There are two modes;
                <ol>
                    <li><span class="text-bold">Strict Mode</span>-This is the mode whereby when the teachers add marks, the system will not allow the teacher to save the list of marks if some marks are missing.</li>

                    <li><span class="text-bold">Flex Mode</span>-This is the mode whereby when the teachers add marks, the system will  allow them to  submit the list of marks even when some marks are missing. This is the default mode.</li>
                
                </ol> 

                
               
              </div>
          
         </div>
        
        </div>
    </div>  
<div class="row">


  <div class="col-md-4">

    <div class="card ">
      <div class="card-header">
        Add Mark Settings
      </div>

          <div class="card-body">

          
            <form action="{{route('marks_settings.store')}}" method="post"> 
              @csrf
             

              <div class="form-group">
                <x-jet-label>Marks Mode</x-jet-label>
                <small id="imageHelp" class="form-text text-muted">Set the mode of entering of marks.</small>
                <select name="marks_mode" id="marks_mode" class="form-control">
                  <option value="">Select Option</option>
                  <option value="1">Strict Mode</option>
                  <option value="2">Flex Mode</option>
                </select>
                @error('marks_mode')
                <span class="text-danger">{{$message}}</span>  
                @enderror
              </div>


              <div class="form-group">
                <x-jet-label>Effort Grades</x-jet-label>
                <small id="imageHelp" class="form-text text-muted">Effort grades when entering marks</small>
                <select name="effort_grade_status" id="effort_grade_status" class="form-control">
                  <option value="">Select Option</option>
                  <option value="1">Show Effort Grades</option>
                  <option value="0">Hide Effort Grades</option>
                </select>
                @error('effort_grade_status')
                <span class="text-danger">{{$message}}</span>  
                @enderror
              </div>

             
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <x-jet-button>Add Settings</x-jet-button>
        </div>
     
   
  </form>
           


  

  </div>
    </div>

  <div class="col-md-8">

    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Current Mark Settings</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      
        <div class="card-body">

      <ul>
          @foreach ($markSettings as $item)
         
        

               <li>Mark Mode: 
                <span class="text-bold">
                  
                  @if ($item->marks_mode=="1")
                    Strict Mode  
                  @endif

                  @if ($item->marks_mode=="2")
                  Flex Mode  
              
               
                @endif
                  </span>
               </li>



               <li>Effort Grade Status: 
                <span class="text-bold">
                  
                  @if ($item->effort_grade_status=="1")
                   ON
                  @endif

                  @if ($item->effort_grade_status=="0")
                 OFF
              
               
                @endif
                  </span>
               </li>

        
          @endforeach
              </ul>
        
        </div>

     
    </div>

  </div>
      
    </div>   
            
     
    
</x-app-layout>