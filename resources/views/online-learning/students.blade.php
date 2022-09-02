<x-app-layout>
    <x-slot name="header">
     
      
    </x-slot>
  <div class="card  ">
    <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,q_auto,w_970/b_rgb:000000,e_gradient_fade,y_-0.5/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_40_style_light_align_center:{{Auth::user()->name}}'s Lessons,w_0.3,y_0.18/v1612793225/shunifu/pexels-photo-4143800_vqecd5.jpg" alt="">
    <div class="card-body">
      <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
     <div class="text-muted">
        <p class="card-text">Welcome to your e-learning portal. </p>
     </div>
    
    </div>
    
  </div>
    <div class="row ">
        
        @foreach ($lesson as $item)
            
   
        <div class="col-md-4 pb-5">
 <div class="card border-top border-primary">
     <div class="card-header">
        <h4 class="lead">{{$item->subject_name}}</h4>
        <small> {{$item->salutation}} {{$item->name}} {{$item->lastname}}</small>
     </div>
     <div class="card-body">
         <p class="card-title">
            <span class="text-bold">Lesson Title:</span> 
            {{$item->lesson_title}}</p>
         <p class="card-text"><span class="text-bold">Lesson Posted:</span> {{\Carbon\Carbon::parse($item->created_at)->diffForhumans()}}</p>
     </div>
     <div class="card-footer text-muted">
        <a href="/users/student/online-learning/view/{{$item->lesson_id}}"><button type="button" class="btn btn-default btn-sm"><i class="fas fa-eye"></i> View Lesson</button></a>
        <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
        
     </div>
 </div>
      
        </div>

        @endforeach

            
          </div>  
  
     
</x-app-layout>

 