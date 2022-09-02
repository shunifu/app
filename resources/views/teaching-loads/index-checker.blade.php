<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Teaching Loads Checker</h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.80/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_34_style_light_align_center:View Teaching Loads,w_0.2,y_0.14/v1615202389/Untitled_design_1_oaroft.png" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to check teaching loads. <br>
                <ul>
                    <li>select the class you want to view teaching loads for;</li>
                </ul>
          
            </p>
          
         </div>
        
        </div>
    </div> 
<div class="row">
    
  <div class="col-md-12">

    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">View Teaching Loads</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('check_loads_process')}}" method="post">
          <div class="card-body">
            
                @csrf
              

                <div class="form-group">
                <x-jet-label>Select Class</x-jet-label>
               <select class="form-control" name="grade">
                <option value="0">Select Class</option>
                @foreach ($gradesList as $item_class)
                <option value="{{$item_class->id}}">{{$item_class->grade_name}}</option>
                @endforeach
               </select>
                @error('stream')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>
               
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <x-jet-button>Check Teaching Load</x-jet-button>
          </div>
       
      </div>
    </form>

  </div>


      
    </div>   
            
     
    
</x-app-layout>