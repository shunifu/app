<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Report Comments Management</h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_290,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_25_style_light_align_center:Comments Management,w_0.4,y_0.28/v1619444117/pexels-photo-1111368_coxluw.jpg" alt="">
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
          <h3 class="card-title">Add Comment</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('comments.admin_view')}}" method="post">
          <div class="card-body">
            
                @csrf


                <div class="row">
                  
                    <div class="col">
                        <div class="form-group">
                            <x-jet-label>Select Term</x-jet-label>
                            <select class="form-control" name="section" >
                                <option value="">Select Term</option>
                                @foreach ($terms as $term)
                                <option value="{{$term->id}}">{{$term->term_name}}</option>
                                @endforeach
                            </select>
                            @error('term')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>
                    </div>


                    <div class="col">
                        <div class="form-group">
                            <x-jet-label>Class </x-jet-label>
                            <select class="form-control" name="class" id="class">
                              @foreach ($grades as $grade)
          
                              <option value="{{$grade->id}}">{{$grade->grade_name}}</option>
                                  
                              @endforeach
                            </select>
                            @error('class')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>
                    </div>

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
            
<script>
  $(document).ready(function () {
    $("#comment_category").change(function (e) { 
      e.preventDefault();

      // alert(e.val());
      // if (e.val()) {
      //   selector
      // } else {
        
      // }
      
    });
  });
</script>

    
</x-app-layout>