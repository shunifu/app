<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light  ">
              <div class="card-header">
                <h3 class="card-title">Time Based Restriction</h3>
              </div>

      
                <div class="card-body">
                  <h3 class="lead">Hi, {{Auth::user()->salutation}} {{Auth::user()->name}} {{Auth::user()->lastname}}</h3>
                 <div class="text-muted">
                    <p class="card-text">  Use this section to set the time for the viewing of reports by parents<br>
                  
                    </p>
                  
                 </div>
                
                </div>
                
              
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/parent/restriction/time-based/store" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-row">
                      <div class="col form-group">
                        <x-jet-label> Select Term</x-jet-label>
                       <select class="form-control" name="term_id">
                        <option value="">Select Term</option>
                        @foreach ($terms as $term)
                        <option value="{{$term->id}}">{{$term->term_name}}</option>
                        @endforeach
                       </select>
                        @error('term_id')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                       

                        <div class="col form-group">
                            <x-jet-label>From</x-jet-label>
                            <x-jet-input name="from" type="datetime-local" ></x-jet-input>
                            @error('from')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                        <div class="col form-group">
                            <x-jet-label>Till</x-jet-label>
                            <x-jet-input name="to" type="datetime-local" ></x-jet-input>
                            @error('to')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                       
                </div>
                </div>
                <!-- /.card-body -->
      
                <div class="card-footer">
                  <x-jet-button>Next</x-jet-button>
                </div>
            </form>
            </div>
      
      
        </div>
     
            
          </div>  
    
</x-app-layout>

 