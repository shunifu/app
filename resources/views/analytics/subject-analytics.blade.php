<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">View Analytics</h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_320,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_32_style_light_align_center:Assessement-Based Analytics,w_0.3,y_0.20/v1617555284/carlos-muza-hpjSkU2UYSU-unsplash_l61hlq.jpg" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to view subject analytics <br>
          
            </p>
          
         </div>
        
        </div>
    </div> 
  <div class="row">
    
  <div class="col-md-12">
  
  
  <div class="tab-content" id="pills-tabContent">
  
  <!---Beginning of Assessement Types---->
  <div class="tab-pane fade show active" id="pills-stream-analysis" role="tabpanel" aria-labelledby="pills-stream-analysis-tab">
    <div class="row">
        <div class="col-md-12">
  
            <div class="card card-light">
                <div class="card-header">
                  <h3 class="card-title">Subject Analysis</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('analytics.subject')}}" method="post">
                  <div class="card-body">
                        @csrf
                        <div class="form-row">
                        <div class="col-md-4 form-group">
                          <x-jet-label>Stream Name</x-jet-label>
                         <select class="form-control" name="stream_name">
                          <option value="">Select Stream</option>
                          @foreach ($streams as $stream)
                          <option value="{{$stream->id}}">{{$stream->stream_name}}</option>
      
                          @endforeach
                         </select>
                          @error('stream')
                          <span class="text-danger">{{$message}}</span>  
                          @enderror
                          </div>
  
                         
<div class="col-md-4 form-group">
    <x-jet-label>Assessement Name</x-jet-label>
    <select class="form-control" name="assessement">
    <option value="">Select Name</option>
    @foreach ($assessements as $assessement)
    <option value="{{$assessement->id}}">{{$assessement->assessement_name}}</option>
    @endforeach
    </select>
    @error('assessement')
    <span class="text-danger">{{$message}}</span>  
    @enderror
</div>

<div class="col-md-4 form-group">
    <x-jet-label>Subject</x-jet-label>
   <select class="form-control" name="subject">
    <option value="">Select Subject</option>
    @foreach ($subjects as $subject)
    <option value="{{$subject->id}}">{{$subject->subject_name}}</option> 
    @endforeach
   
   </select>
    @error('subject')
    <span class="text-danger">{{$message}}</span>  
    @enderror
</div>
                           
                  </div>
                  </div>
                  <!-- /.card-body -->
        
                  <div class="card-footer">
                    <x-jet-button>Load Analytics</x-jet-button>
                  </div>
              </form>
              </div>
  
          </div>
    
  
  
  
     </div>
  </div>

  
  
  </div>
          </div>
  
         
       
      </div>
   
  
  </div>
  
  
      
    </div>   
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   
    <script>
        
  
  $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
  });
  
  // Acá guarda el index al cual corresponde la tab. Lo podés ver en el dev tool de chrome.
  var activeTab = localStorage.getItem('activeTab');
  
  // En la consola te va a mostrar la pestaña donde hiciste el último click y lo
  // guarda en "activeTab". Te dejo el console para que lo veas. Y cuando refresques
  // el browser, va a quedar activa la última donde hiciste el click.
  console.log(activeTab);
  
  if (activeTab) {
   $('a[href="' + activeTab + '"]').tab('show');
  }
  
  
  
        </script>
    
  </x-app-layout>