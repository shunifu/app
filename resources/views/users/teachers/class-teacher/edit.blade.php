<x-app-layout>
    <x-slot name="header">
      
    </x-slot>



    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title p4"><a href="/users/teacher/assign/classteacher"><i class="fas fa-hand-point-left mr-2"></i> </a>Edit Class Teacher </h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.80/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_34_style_light_align_center:Edit Class Teacher ,w_0.2,y_0.14/v1615202389/Untitled_design_1_oaroft.png" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to edit  <span class="text-bold">Class Teacher</span> <br>
          
            </p>
          
         </div>
        
        </div>
    </div> 
<div class="row">
    
  <div class="col-md-12">

    <div class="card card-light">
        <div class="card-header">
         

       
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/users/teacher/class-teacher/update" method="post">
        <!-- /beginning of card-body -->
          <div class="card-body">
                @csrf
               
    

                <div class="form-group">
                    <x-jet-label>Class</x-jet-label>
                    <x-jet-input name="grade" value="{{$class_data->grade_name}}" readonly></x-jet-input>
                    @error('grade')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div>
                <input type="hidden" value="{{$class_data->grade_id}}" name="grade_id">

                <div class="form-group">
                    <x-jet-label>  Class Teacher</x-jet-label>

                      <select class="form-control" name="class_teacher" id="class_teacher">
                        <option value="{{$class_data->teacher_id}}">{{$class_data->lastname}} {{$class_data->name}}</option>
                        <option value="">----------------------</option>
                        @foreach ($teachers as $item)
                        <option value="{{$item->id}}">{{$item->lastname}} {{$item->name}}</option>
                        @endforeach
                      </select>
                
                
                    @error('class_teacher')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div>

                <input type="hidden" name="id" value="{{$class_data->id}}">

          </div>
          <!-- /end of card-body -->

          <div class="card-footer">
            <x-jet-button>Update Class Teacher</x-jet-button>
          </div>
        </form>
      </div>

  </div>




  </div>


      
    </div>   
            
     
    
</x-app-layout>