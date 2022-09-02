<x-app-layout>
    <x-slot name="header">
      
    </x-slot>

    <div class="card  ">
        <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:{{Auth::user()->name}}Add Topic,w_0.3,y_0.18/v1613224829/pexels-photo-5076531_bk5pkb.jpg" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> This is where you can edit a topic <br>
                <hr>
                <ul>
                    <li>You can only edit the topic name</li>
                   
                </ul>
          
            </p>
          
         </div>
        
        </div>
        
      </div>
<div class="row">
    
  <div class="col-md-12">

    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">Edit Topic</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <div class="card-body">
        <form action="{{route('topics.edit')}}" method="post">
          
                @csrf
                <div class="form-group">
                    <x-jet-label>Choose Stream</x-jet-label>
                    <select class="form-control" name="stream_id">
                      <option value="0">Select Stream</option>
                      @foreach ($streams as $stream)
                          <option value="{{$stream->id}}">{{$stream->stream_name}}</option>
                      @endforeach
                    </select>
                    @error('stream_id')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                    </div>

                    <div class="form-group">
                        <x-jet-label>Choose Subject</x-jet-label>
                        <select class="form-control" name="subject_id">
                          <option value="0">Select Subject</option>
                          @foreach ($subjects as $subject)
                              <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                          @endforeach
                        </select>
                        @error('subject_id')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label> Topic Name</x-jet-label>
                            <x-jet-input name="topic_name" class="pl-1 pb-5 pt-4" ></x-jet-input>
                            @error('topic_name')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>
                            <div class="card-footer">
                                <x-jet-button>Add Topic</x-jet-button>
                              </div>
        </form>
    </div>
          <!-- /.card-body -->

         
       
      </div>


  </div>

  <div class="col-md-8">

    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Manage Topics</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      
        <div class="card-body">
          @if (empty($streams))
              No data
          @else
              
          
          <table class="table">
            <thead>
              <tr>
                <th>Stream Name</th>
                <th>Topic</th>
                <th>Subject Name</th>
                <th>Manage</th>
              </tr>
            </thead>
            <tbody>
              <tr>
               @foreach ($topics as $topic)
               <tr>
                   <td>{{$topic->stream_name}}</td>
                   <td>{{$topic->topic_name}}</td>
                   <td>{{$topic->subject_name}}</td>
                   
                <td>
                  
                    <a href="/topics/edit/{{$topic->topic_id}}" class="link"><i class="fas fa-edit text-info"></i></a>
                    <a href="/topics/delete/{{$topic->topic_id}}" class="link"><i class="fas fa-trash text-danger"></i></a>
                   
                </td>
                   
                </tr>
               
               
               @endforeach
              </tr>
              
            </tbody>
          </table>
          @endif
        </div>

     
    </div>

  </div>
      
    </div>   
            
</x-app-layout>