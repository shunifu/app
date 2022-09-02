<x-app-layout>
    <x-slot name="header">
     
      
    </x-slot>
  <div class="card  ">
    <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:{{Auth::user()->name}}'s Assessement Portal,w_0.3,y_0.18/v1613224829/pexels-photo-5076531_bk5pkb.jpg" alt="">
    <div class="card-body">
      <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
     <div class="text-muted">
        <p class="card-text">  Use this section to manage assessements your assessements. <br>
      
        </p>
      
     </div>
    
    </div>
    
  </div>
    <div class="row ">
        
        @foreach ($assessement as $item)
        <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
 <div class="card border-top border-primary">
     <div class="card-header">
        <p class="card-title">

          <span class="text-bold">Title:</span> 
          {{$item->title}}
      <br>
            <span class="text-bold">Lesson</span> 
            {{$item->lesson_title}}
        <br>
        <span class="text-bold">Class:</span> 
        {{$item->grade_name}}
        </p>
         <p class="card-text"><span class="text-bold">Assessement Due:</span> {{\Carbon\Carbon::parse($item->due_date)->diffForhumans()}}</p>
     </div>
     <div class="card-body">
      
     </div>
     <div class="card-footer text-muted">

        <a href="/online-learning/lessons/assessement/view/{{$item->id}}"><button type="button" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> View </button></a>
        <a href="/online-learning/lessons/assessement/feedback/{{$item->id}}"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i>My Work</button></a>
        <a href="/online-learning/lessons/assessement/feedback/results/{{Auth::user()->id}}/{{$item->id}}"><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-eye"></i>My Results</button></a>
      

     </div>
 </div>

        </div>

        @endforeach

          </div>  
</x-app-layout>