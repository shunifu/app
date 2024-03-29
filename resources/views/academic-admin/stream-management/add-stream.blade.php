<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="row">

    </div>
<div class="row">
    
  <div class="col-md-4">

    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">Add Stream</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('stream.store')}}" method="post">
          <div class="card-body">
            
                @csrf
                <div class="form-group">
                <x-jet-label> Stream Name</x-jet-label>
                <x-jet-input name="stream_name" placeholder="e.g Form 1 or Grade 3" ></x-jet-input>
                @error('stream_name')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

                <div class="form-group">
                  <x-jet-label> Stream Type</x-jet-label>
                 <div class="form-group">
  
                   <select class="form-control" name="stream_type" id="stream_type">
                     <option class="">Select Stream Type</option>
                     <option value="internal">Internal Class</option>
                     <option value="external">External Class</option>
                   
                   </select>
                  
                 </div>
                  @error('stream_type')
                  <span class="text-danger">{{$message}}</span>  
                  @enderror
                  </div>

                  <div class="form-group">
                    <x-jet-label> Final Stream Status</x-jet-label>
                    <select class="form-control" name="final_stream" id="final_stream">
                      <option class="">Select Final Stream Status</option>
                      <option value="0">Progressive Stream</option>
                      <option value="1">Final Stream</option>
                    </select>
                    @error('final_stream')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                    </div>

                    <div class="form-group">
                      <x-jet-label> Next Stream is?</x-jet-label>
                      <select class="form-control" name="next_stream" id="next_stream">
                        <option class="">Select Next Stream Sequence</option>
                       @foreach ($stream_collection as $item)

                      <option class="{{$item->stream_id}}">{{$item->stream_name}}</option>  
                       @endforeach
                       <option class="0">End of School</option>
                      </select>
                      @error('next_stream')
                      <span class="text-danger">{{$message}}</span>  
                      @enderror
                      </div>
                  
                 
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <x-jet-button>Add Stream</x-jet-button>
          </div>
      
      </div>
    </form>

  </div>

  <div class="col-md-8">

    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Manage Stream</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      
        <div class="card-body">
          
          <table class="table table-hover table-bordered">
            <thead class="thead-light">
              <tr>
                <th>Stream Name</th>
                <th>Stream Type</th>
                <th>Final Stream Status</th>
                <th>Next Stream Sequence</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
               @foreach ($stream_collection as $stream_item)
               <tr>
                   <td>{{$stream_item->stream_name}}</td>
                   <td>{{$stream_item->stream_type}}</td>
                 
                   <td>
                     @if ($stream_item->final_stream==1)
                        <button type="button" class="btn btn-success">Final Stream</button>  
                     @else
                         Progressive Stream
                     @endif
                   
                    </td>

                    <td>
                      @if ($stream_item->sequence==0)
                 
                      Not Set
                   @else

                   <?php
                   $stream=\DB::select(\DB::raw("SELECT * from streams where id=".$stream_item->sequence.""));

                   foreach ($stream as $next) {
                   echo $next->stream_name;

                   }

                   ?>
                   @endif
                    </td>
                  

                    <td class="text-center py-0 align-middle">
                      {{-- <div class="btn-group btn-group-sm">
                        <a href="stream/edit/{{encrypt($stream_item->id)}}" class="btn btn-info"><i class="fas fa-eye"></i>Edit</a>
                        <a href="stream/delete/{{encrypt($stream_item->id)}}" class="btn btn-danger"><i class="fas fa-trash">Delete</i></a>
                      </div> --}}

                      <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                          Action
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="stream/edit/{{encrypt($stream_item->id)}}"><i class="fas fa-eye"></i> Edit </a>
                          <a class="dropdown-item" href="stream/delete/{{encrypt($stream_item->id)}}"><i class="fas fa-trash-alt"></i> Delete</a>
                        </div>
                      </div>
                    </td>

                   

                  
                   
                </tr>
               
               
               @endforeach
              </tr>
              
            </tbody>
          </table>
        </div>

     
    </div>

  </div>
      
    </div>   
            
     
    
</x-app-layout>