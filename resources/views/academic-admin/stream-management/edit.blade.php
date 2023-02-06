<x-app-layout>
    <x-slot name="header">
      
    </x-slot>



    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title p4"><a href="/academic-admin/stream"><i class="fas fa-hand-point-left mr-2"></i> </a>Edit Stream</h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.80/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_34_style_light_align_center:Edit Stream  ,w_0.2,y_0.14/v1615202389/Untitled_design_1_oaroft.png" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to edit  <span class="text-bold">{{$stream->stream_name}}</span> <br>
          
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
        <form action="{{ route('stream.update') }}" method="post">
        <!-- /beginning of card-body -->
          <div class="card-body">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <x-jet-label> Stream Name</x-jet-label>
                    <x-jet-input name="stream_name" value="{{$stream->stream_name}}" ></x-jet-input>
                    @error('stream_name')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
               
                </div>
                <div class="form-group">
                    <x-jet-label> Stream Type</x-jet-label>
                 
                    <label for="stream_type"></label>
                    <select class="form-control" name="stream_type" id="stream_type">
                      <option value="{{$stream->stream_type}}">{{$stream->stream_type}}</option>
                      <option value="internal">Internal</option>
                      <option value="external">External</option>
                    </select>
                 
                    @error('stream_type')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div>

                
                <div class="form-group">
                  <x-jet-label>Final Stream Status </x-jet-label>
               
                  <label for="final_stream"></label>
                  <select class="form-control" name="final_stream" id="final_stream">
                    <option value="{{$stream->final_stream}}">
                    @if ($stream->final_stream==1)
                        Final Stream
                    @else
                    
                       Progressive Stream 
                    @endif
                    
                    </option>
                    <option value="">-------------------</option>
                    <option value="0">Progressive Stream</option>
                    <option value="1">Final Stream</option>
                  </select>
             
                  @error('final_stream')
                  <span class="text-danger">{{$message}}</span>  
                  @enderror
              </div>

              <div class="form-group">
                <x-jet-label> Next Stream Sequence</x-jet-label>
             
                <label for="next_stream"></label>
                <select class="form-control" name="next_stream" id="next_stream">
                  @if ($stream->sequence==0)
                  <option value="">----Not Set---</option>  
                    @else
                   
                   
                    @endif
                    <option value="">Select Below</option>  
                
                  @foreach ($streams as $item)
                  <option value="{{$item->id}}">{{$item->stream_name}}</option>  
                  @endforeach
                  <option value="0">End of School </option>    
                </select>
      
                @error('next_stream')
                <span class="text-danger">{{$message}}</span>  
                @enderror
            </div>

                <input type="hidden" name="id" value="{{$stream->id}}">

          </div>
          <!-- /end of card-body -->

          <div class="card-footer">
            <x-jet-button>Update Stream </x-jet-button>
          </div>
        </form>
      </div>

  </div>




  </div>


      
    </div>   
            
     
    
</x-app-layout>