<x-app-layout>
    <x-slot name="header">
      
    </x-slot>



    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Edit {{$class_info->grade_name}} </h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.80/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_34_style_light_align_center:Edit {{$class_info->grade_name}},w_0.2,y_0.14/v1615202389/Untitled_design_1_oaroft.png" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to edit <span class="text-bold">{{$class_info->grade_name}}</span> <br>
          
            </p>
          
         </div>
        
        </div>
    </div> 
<div class="row">
    
  <div class="col-md-12">

    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">Edit Class </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('grade.update')}}" method="post">
          <div class="card-body">
            
                @csrf
                <div class="form-group">
                <x-jet-label> Class Name</x-jet-label>
                <x-jet-input name="grade_name" value="{{$class_info->grade_name}}"></x-jet-input>
                @error('grade_name')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

                <div class="form-group">
                <x-jet-label>Class Stream</x-jet-label>
               <select class="form-control" name="stream">
                <option value="{{$class_info->stream_id}}">{{$class_info->stream_name}}</option>
                @foreach ($streams as $item_stream)
                <option value="{{$item_stream->id}}">{{$item_stream->stream_name}}</option>
                @endforeach
               </select>
                @error('stream')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

                <div class="form-group">
                <x-jet-label>Class Section</x-jet-label>
                <select class="form-control" name="section">
                <option value="{{$class_info->section_id}}">{{$class_info->section_name}}</option>
                @foreach ($sections as $item_section)
                <option value="{{$item_section->id}}">{{$item_section->section_name}}</option>
                @endforeach
                </select>
                @error('stream')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>
<input type="hidden" value="{{$class_info->grade_id}}" name="id">
               
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <x-jet-button>Update {{$class_info->grade_name}} </x-jet-button>
          </div>
       
      </div>
    </form>

  </div>


      
    </div>   
            
     
    
</x-app-layout>