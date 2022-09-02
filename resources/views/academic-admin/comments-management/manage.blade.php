<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Report Comments Management</h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_290,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_25_style_light_align_center:Manage Comments,w_0.4,y_0.28/v1619444117/pexels-photo-1111368_coxluw.jpg" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> This is the section where you can manage report card comments. <br>
          
            </p>
          
         </div>
        
        </div>
    </div>  
<div class="row">


    
  <div class="col">

    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">Manage Comment</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('comments.list')}}" method="post">
          <div class="card-body">
            
                @csrf
                <div class="form-group">
                <x-jet-label>Section</x-jet-label>
                <select class="form-control" name="section">
                <option value="">Select Section</option>
                @foreach ($sections as $section)
                <option value="{{$section->id}}">{{$section->section_name}}</option>
                @endforeach
                </select>
                @error('section')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

                <div class="form-group">
                  <x-jet-label>Select Comment Category</x-jet-label>
                  <select class="form-control" name="comment_category">
                      <option value="">Select Comment Category</option>
                      <option value="1">Subject Comments</option>
                      <option value="2">Headteacher Comments</option>
                      <option value="3">Classteacher Comments</option>
                  </select>
                  @error('comment_category')
                  <span class="text-danger">{{$message}}</span>  
                  @enderror
                  </div>

          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <x-jet-button>View Comment</x-jet-button>
          </div>
       
      </div>
    </form>

  </div>


  </div>   
            
 
    
</x-app-layout>