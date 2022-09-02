<x-app-layout>
  <x-slot name="header">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.5/pdfobject.min.js" integrity="sha512-K4UtqDEi6MR5oZo0YJieEqqsPMsrWa9rGDWMK2ygySdRQ+DtwmuBXAllehaopjKpbxrmXmeBo77vjA2ylTYhRA==" crossorigin="anonymous"></script>
    <link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />
<style>
  .profile-head {
  transform: translateY(5rem)
}
img {
    max-width: 100%;
    height: auto;
}

#pdf-viewer{
  max-width: 100%;
    height: auto;
}

.cover {
  background-image: url(https://res.cloudinary.com/innovazaniacloud/image/upload/v1616623675/6-61503_material-design-wallpaper-google_zfwmih.png);
  background-size: cover;
  background-repeat: repeat-x
}


</style>
  </x-slot>



  <div class="row">
      <div class="col-auto col-md-12 ">
        <div class="card card-light  ">
          <div class="card-header">
            <h3 class="card-title"><a href="/users/teacher/online-learning/manage"><i class="fas fa-arrow-circle-left"></i> Back</a> </h3>
          </div>
          <!-- /.card-header -->
       

          <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 py-6 pt-4 pb-4 elevation-2 cover">
                <div class="media align-items-end profile-head">
                    <div class="profile mr-2">
                        @if(empty(Auth::user()->profile_photo_url))
                        <img src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1613141854/default-profile-picture-avatar-photo-placeholder-vector-illustration-vector-id1214428300_urpxk5.jpg" alt="..." width="180" class="rounded mt-8 rounded-circle">
                        @else
        
                        <img class="user-image img-circle " width="128" height="128" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        @endif
                    </div>
                   
                </div>
            </div>
            
            <div class="bg-white p-4 mb-2 mt-5 d-flex justify-content-start ">
                <div class="col-12 col-sm-6 col-lg-8">
                    <h2 class="mb-1">Lesson: <span class="text-bold"></span>{{$lesson->lesson_title}}<svg class="ml-1"  xmlns="http://www.w3.org/2000/svg"
                            width="26" height="25.19" viewBox="0 0 24 23.25">
                            <path
                                d="M23.823,11.991a.466.466,0,0,0,0-.731L21.54,8.7c-.12-.122-.12-.243-.12-.486L21.779,4.8c0-.244-.121-.609-.478-.609L18.06,3.46c-.12,0-.36-.122-.36-.244L16.022.292a.682.682,0,0,0-.839-.244l-3,1.341a.361.361,0,0,1-.48,0L8.7.048a.735.735,0,0,0-.84.244L6.183,3.216c0,.122-.24.244-.36.244L2.58,4.191a.823.823,0,0,0-.48.731l.36,3.412a.74.74,0,0,1-.12.487L.18,11.381a.462.462,0,0,0,0,.732l2.16,2.437c.12.124.12.243.12.486L2.1,18.449c0,.244.12.609.48.609l3.24.735c.12,0,.36.122.36.241l1.68,2.924a.683.683,0,0,0,.84.244l3-1.341a.353.353,0,0,1,.48,0l3,1.341a.786.786,0,0,0,.839-.244L17.7,20.035c.122-.124.24-.243.36-.243l3.24-.734c.24,0,.48-.367.48-.609l-.361-3.413a.726.726,0,0,1,.121-.485Z"
                                fill="#0D6EFD"></path>
                            <path data-name="Path" d="M4.036,10,0,5.8,1.527,4.2,4.036,6.818,10.582,0,12,1.591Z"
                                transform="translate(5.938 6.625)" fill="#fff"></path>
                        </svg>
                    </h2>
                    <hr>
                   
                    <p class="text-gray-700 mb-1 2h-base"> 
                      <i class="fas fa-calendar mr-2"></i>Posted: 
                      {{\Carbon\Carbon::parse($lesson->created_at)->diffForhumans()}}
                      {{-- Hi {{\Spatie\Emoji\Emoji::grinningFace()}}{{Auth::user()->name}}<p> --}}
                      </p>
        
                      <p class="text-gray-700 mb-1 2h-base">
        
                        {{-- <li class="list-inline-item">
                          <h4 class="font-weight-bold mb-0 d-block">{{$lesson->lesson_title}}</h4>
                          <small class="text-muted"> 
                            <i class="fas fa-calendar mr-2"></i>Posted: 
                            {{\Carbon\Carbon::parse($lesson->created_at)->diffForhumans()}}
                            </small>

                         
                      </li> --}}

        
                      </p>
        
                </div>
            </div>
        
        </div>

              <div class="card-body">
              
               <div class="text-muted">
                  

                    {{-- <div class="bg-light p-4 d-flex justify-content-start text-left">
                      <ul class="list-inline mb-0">
                          <li class="list-inline-item">
                            
                            <div class="user-block">
                              <img class="user-image img-circle elevation-1" width="64" height="64" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </div>
                          </li>
                      

                          
                         
                      </ul>
                  </div> --}}
                  </p>
                
               </div>
              
              </div>
        </div>
 
    <div class="row">
        <div class="col-md-12">

  
          <div class="card card-light">
            
            
                <div class="card-body">
                  <div class="content">
               
                   
                    <hr>
<div class="bg-light pl-2 pt-2 d-flex justify-content-start text-left mb-3">
  <h4>Lesson Overview</h4>                 
</div>

                       {{$lesson->lesson_overview}} 

                    </p>
                   
                   <hr>
                   <div class="bg-light pl-2 pt-2 d-flex justify-content-start text-left mb-3">
                     
                        <h4>Lesson Objectives</h4>
                   </div>
                   <small>By the end of the lesson, students should be able to:</small><br>
                          <ul>
                          @foreach(json_decode(implode($objectives)) as $lesson_objective_item)
                          <li> {{$lesson_objective_item}}</li>
                         
                           
                         @endforeach

                         
                          </ul>
                          <hr>
                         
    <div class="bg-light pl-2 pt-2 d-flex justify-content-justify mx-auto text-left mb-3">
                      <h4>Lesson Content</h4>               
    </div>
    <div id="video">
     
       
          {!! $lesson->lesson_content !!}
        
    
    </div>
                    
                  
                     
</div>
<hr>

<div class="bg-light pl-2 pt-2 d-flex justify-content-justify mx-auto text-left mb-3">
  <h4>Lesson Comments</h4>               
</div>
@foreach ($comments as $comment_item)
<div class="post">
  <div class="user-block">
    @if (!empty($comment_item->profile_photo_path))
          <img class="img-circle img-bordered-sm" src="/storage/{{$comment_item->profile_photo_path}}" alt="User Image">
              
          @else
          <img class="img-circle img-bordered-sm" src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1613141854/default-profile-picture-avatar-photo-placeholder-vector-illustration-vector-id1214428300_urpxk5.jpg" alt="User Image">
          @endif
    <span class="username">
      <a href="#">{{$comment_item->name}} {{$comment_item->lastname}}</a>
      <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
    </span>
    <span class="description">Shared publicly - {{ \Carbon\Carbon::parse($comment_item->comment_time)->diffForhumans(['options' => \Carbon\Carbon::JUST_NOW]) }}</span>
  </div>
  <!-- /.user-block -->
  <p>
    {{$comment_item->comment}}
     @if (pathinfo($comment_item->path, PATHINFO_EXTENSION) == 'jpg' OR (pathinfo($comment_item->path, PATHINFO_EXTENSION) == 'jpeg'))

     <div class="col-sm-6">
      <div class="row">
        <div class="col-sm-6">
          <img class="img-fluid mb-3" src="/storage/{{$comment_item->path}}" alt="Photo">
         
        </div>
      </div>
     </div>

         
              
          @elseif(pathinfo($comment_item->path, PATHINFO_EXTENSION) == 'pdf')
          <div id="pdf-viewer"></div>
          <script>
            PDFObject.embed("/storage/{{$comment_item->path}}", "#pdf-viewer");
            </script>
              
    @elseif(pathinfo($comment_item->path, PATHINFO_EXTENSION) == 'mp4')

    <video
    id="my-video"
    class="video-js"
    controls
    preload="auto"
    width="640"
    height="264"
    data-setup="{}"
  >
    <source src="/storage/{{$comment_item->path}}" type="video/mp4" />
  
  </video>

  <script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script>
  <script>
    var player = videojs('my-video');
      player.nuevo({ video_id:"my-video", donwloadButton:true })
    </script>

         @endif
  </p>

  <p>
    

    <div class="bg-light pl-2 pt-2 d-flex justify-content-justify mx-auto text-left mb-3">
                 
</div>
  </p>
  
 
</div>
@endforeach      

{{-- start of lesson comments --}}

<div class="bg-light pl-2 pt-2 d-flex justify-content-start text-left mb-3">
  <h4>Add your comment</h4>                 
</div>
<form action="{{route('lesson-comments.store')}}" method="post" name="comment-form" enctype="multipart/form-data">
  @csrf
 <input type="hidden" name="lesson_id" value="{{$lesson->id}}" /> 
 <input type="hidden" name="user_id" value="{{ Auth::user()->id}}" /> 

  <img class="img-fluid img-circle img-sm" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name}}">
  <!-- .img-push is used to add margin to elements next to floating images -->
  <div class="img-push">
    
    <div class="input-group input-group-sm mb-0">
      <input type="text" name="comment" class="form-control form-control p5" placeholder="Type Comment">
     
    </div>
    {{-- <div class="row">
      <div class="mt-2 mr-2">
        <input type="file" name="file"/>
      </div>
    
      <div class="mt-2 ml-2">
        <a href="/online-learning/lessons/comment/delete/{{$lesson->id}}">Delete Comment</a>
       </div>
    </div> --}}
  
    <div class="form-group">
      <div class="btn btn-default btn-file">
        <i class="fas fa-paperclip"></i> Add Attachment
        <input type="file" name="file">
      </div>

      
     
    </div>
    

  <button  class="btn btn-info"><i class="fas fa-paper-plane mr-1"></i>Send Comment</button>
  </div>

</form>


                                
                </div>
                <!-- /.card-body -->
      
               
            </form>
            <div class="card-footer">
               
              <a href="/users/teacher/online-learning/manage"><x-jet-button> <i class="fas fa-hand-point-left"></i> Back to Lessons</x-jet-button></a>

            </div>
            
            </div>
      
      
        </div>

      
          </div>  

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fitvids/1.2.0/jquery.fitvids.min.js"></script>
<script>
  
    $("#video").fitVids();
  
</script>     
    
</x-app-layout>
