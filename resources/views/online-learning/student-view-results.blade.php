<x-app-layout>
    <x-slot name="header">
     

      
    </x-slot>
  <div class="card  ">
    <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:{{Auth::user()->name}}'s ssessement Result,w_0.3,y_0.18/v1613224829/pexels-photo-5076531_bk5pkb.jpg" alt="">
    <div class="card-body">
  
     @foreach ($results as $item)
     <div class="row justify-content-center  col-12 d-flex justify-content-center">
         <div class="col-12  ml-2">

                 <div class="col-12 d-flex justify-content-center my-2"> <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                     <lottie-player src="https://assets3.lottiefiles.com/datafiles/U1I3rWEyksM9cCH/data.json"  background="transparent"  speed="1"  style="width: 180px; height: 180px;"  loop  autoplay></lottie-player> </div>
                 <h5 class="my-4 text-center heading">Hey, {{Auth::user()->name}}, you got <span class="text-bold">{{$item->mark}}%</span>, in this assessement and below is what your teacher had to say about your perfrormance </h5>

                @foreach ($teacher as $teacher_item)    
                 <div class="direct-chat-messages">
                    <!-- Message. Default to the left -->
                    <div class="direct-chat-msg">
                      <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">{{$teacher_item->salutation}} {{$teacher_item->name}} {{$teacher_item->lastname}}</span>
                        <span class="direct-chat-timestamp float-right">{{\Carbon\Carbon::parse($teacher_item->created_at)->diffForhumans()}}</span>
                      </div>
                      <!-- /.direct-chat-infos -->
                      @if (!empty($comment_item->profile_photo_path))
                      <img class="direct-chat-img" src="/storage/{{$teacher_item->profile_photo_path}}" alt="Message User Image">
                      @else
                      <img class="direct-chat-img" src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1613141854/default-profile-picture-avatar-photo-placeholder-vector-illustration-vector-id1214428300_urpxk5.jpg" alt="Message User Image">
                      @endif
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        {{$item->comment}}
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                 </div>
                    <!-- /.direct-chat-msg -->
                @endforeach   
                 <p class="text-center px-4 mb-5 font-weight-bold">  </p>
                 <div class="circ d-flex justify-content-center mt-2 mb-4"> <i class="fa fa-circle mx-4 gr" aria-hidden="true"></i> <i class="fa fa-circle gr" aria-hidden="true"></i> <i class="fa fa-circle mx-4 activ" aria-hidden="true"></i> </div>

            
         </div>
     </div>
 
     @endforeach
    
    </div>
    
  </div>

  

          </div>  
</x-app-layout>