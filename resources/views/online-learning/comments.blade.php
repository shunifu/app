@foreach ($comments as $comment_item)

<!-- Post -->
<div class="post clearfix">
 <div class="user-block">
  
   @if (!empty($comment_item->profile_photo_path))
   <img class="img-circle img-bordered-sm" src="/storage/{{$comment_item->profile_photo_path}}" alt="User Image">
       
   @else
   <img class="img-circle img-bordered-sm" src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1613141854/default-profile-picture-avatar-photo-placeholder-vector-illustration-vector-id1214428300_urpxk5.jpg" alt="User Image">
   @endif

  
   <span class="username">
     <a href="#">{{$comment_item->name}} {{$comment_item->lastname}}</a>

   </span>
   <span class="description">Shared {{$comment_item->created_at}}</span>
 </div>
 <!-- /.user-block -->
 <p>
  {{$comment_item->comment}}
 
 </p>


 

</div>

@endforeach

<form action="{{route('lesson-comments.store')}}" method="post">
    @csrf
   <input type="hidden" name="lesson_id" value="{{$item->id}}" /> 
   <input type="hidden" name="user_id" value="{{ Auth::user()->id}}" /> 
  
    <img class="img-fluid img-circle img-sm" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name}}">
    <!-- .img-push is used to add margin to elements next to floating images -->
    <div class="img-push">
      <div class="input-group input-group-sm mb-0">
        <input type="text" name="comment" class="form-control form-control-sm" placeholder="Press enter to post comment">
        {{-- <div class="input-group-append"> --}}

          <input type="file" name="comment_file"/>

          <button  class="btn btn-danger">Send</button>
        {{-- </div> --}}
      </div>
      
    </div>

    
  </form>