<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Manage Teaching Loads</h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.80/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_34_style_light_align_center:View Teaching Loads,w_0.2,y_0.14/v1615202389/Untitled_design_1_oaroft.png" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to manage school-level teaching loads. <br>
                <ul>
                    <ol>Select the stream you want to view teaching loads for</ol>
                    <ol>Click on View Loads</ol>
                </ul>
          
            </p>
          
         </div>
        
        </div>
    </div> 
<div class="row">
    
  <div class="col-md-12">

    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">School Level Teaching Loads Management</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('admin_check_loads_process')}}" method="post">
          <div class="card-body">
            
                @csrf
              

                <div class="form-group">
                <x-jet-label>Select Stream</x-jet-label>
               <select class="form-control" name="stream">
                <option value="">Select Stream</option>
                @foreach ($streams as $stream)
                <option value="{{$stream->id}}">{{$stream->stream_name}}</option>
                @endforeach
               </select>
                @error('stream')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>
               
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <x-jet-button>View Teaching Loads</x-jet-button>
          </div>
       
      </div>
    </form>

  </div>


      
    </div>   
            
     
    
</x-app-layout>