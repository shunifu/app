<x-app-layout>
  <x-slot name="header">
   
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

  </x-slot>
<div class="card  ">
  <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:{{Auth::user()->name}}'s Assessement Portal,w_0.3,y_0.18/v1613224829/pexels-photo-5076531_bk5pkb.jpg" alt="">
  <div class="card-body">
    <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
   <div class="text-muted">
      <p class="card-text">  Use this section to add assessements for your students. <br>
    
      </p>
    
   </div>
  
  </div>
  
</div>
  <div class="row ">

   @if (empty($lesson))
   <div class="row justify-content-center mx-auto align-self-center">
    <img src="" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">

</div>
{{-- <div class="justify-content-center align-self-center">
    <span class="lead display-3 text-muted">No Lessons Found</span>
    <br>
    {{-- <a href="/users/teacher/online-learning"><button class="btn btn-success">Add Lesson</button></a> --}}
{{-- </div> --}}
{{-- <div class="row justify-content-center align-self-center"> 

   
</div> --}}
   @else

   @foreach ($lesson as $item)
      <div class="col-md-4 pb-5">
<div class="card border-top border-primary">
   <div class="card-header">
      <p class="card-title">
          <span class="text-bold">Lesson Title:</span> 
          {{$item->lesson_title}}
      <br>
      <span class="text-bold">Class:</span> 
      {{$item->grade_name}}
      </p>
       <p class="card-text"><span class="text-bold">Lesson Posted:</span> {{\Carbon\Carbon::parse($item->created_at)->diffForhumans()}}</p>
   </div>
   <div class="card-body">
    
   </div>
   <div class="card-footer text-muted">
      <a href="{{route('online-learning.view',$item->id)}}"><button type="button" class="btn btn-success btn-sm"><i class="fas fa-eye "></i> View Lesson</button></a>
      <a href="/online-learning/lessons/assessement/add/{{$item->id}}"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-folder-plus"></i> Add Assessement</button></a>
      <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-share "></i> Share</button>
      
   </div>
</div>

      </div>

      @endforeach
       
   @endif
      
      

          
        </div>  

   
</x-app-layout>

