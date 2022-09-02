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
        <form action="{{route('comments.store')}}" method="post">
          <div class="card-body">
            
                @csrf
                <div class="form-group">
                <x-jet-label>Section</x-jet-label>
                <select class="form-control" name="section" >
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
                  <x-jet-label>Comment Category</x-jet-label>
                  <select class="form-control" name="comment_category" id="comment_category">
                      <option value="">Select Comment Category</option>
                      <option value="subject_comment">Subject Comments</option>
                      <option value="principal_comment">Head-Teacher Comment</option>
                      <option value="class_teacher_comment">Class-Teacher Comment</option>
                  </select>
                  @error('comment_category')
                  <span class="text-danger">{{$message}}</span>  
                  @enderror
                  </div>

              <div class="form-group">
                <div class="row">
                <div class="col">
                <x-jet-label>Minimum Mark</x-jet-label>
               <x-jet-input name="from" type="number" placeholder="from" ></x-jet-input>
              @error('to')
              <span class="text-danger">{{$message}}</span>  
              @enderror
              </div>
              <div class="col">
              <x-jet-label>Maximum Mark</x-jet-label>
              <x-jet-input name="to" type="number" placeholder="to" ></x-jet-input>
              @error('from')
              <span class="text-danger">{{$message}}</span>  
              @enderror
              </div>
              </div> 
              </div>

                <div class="form-group" id="symbol">
                    <x-jet-label>Symbol</x-jet-label>
                    <select class="form-control" name="symbol">
                        <option value="">Select Symbol</option>
                        
                        <option value="A*">A*</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                        <option value="H">H</option>
                        <option value="U">U</option>
                      
                    </select>
                    @error('symbol')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div>

                    
                <div class="form-group">
                    <x-jet-label>Comment</x-jet-label>
                    <textarea class="form-control" name="comment"></textarea>
                    @error('comment')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div>
    
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <x-jet-button>Add Comment</x-jet-button>
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