<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">View Analytics</h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_230,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_32_style_light_align_center:Term-Based Analytics,w_0.3,y_0.20/v1617555284/carlos-muza-hpjSkU2UYSU-unsplash_l61hlq.jpg" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to view term analytics <br>
          
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
                  <h3 class="card-title">Term Analysis</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('term_analytics.show')}}" method="post">
                  <div class="card-body">
                        @csrf
                        <div class="form-row">
                        <div class="col form-group">
                          <x-jet-label>Stream Name</x-jet-label>
                         <select class="form-control" name="grade_id">
                          <option value="">Select Class</option>
                          @foreach ($grades as $class)
                          <option value="{{$class->id}}">{{$class->grade_name}}</option>
      
                          @endforeach
                         </select>
                          @error('stream')
                          <span class="text-danger">{{$message}}</span>  
                          @enderror
                          </div>
                       

                     
                            <div class="col form-group">
                              <x-jet-label>Term</x-jet-label>
                             <select class="form-control" name="term">
                              <option value="">Select Term</option>
                              @foreach ($terms as $term)
                              <option value="{{$term->id}}">{{$term->term_name}}</option>
          
                              @endforeach
                             </select>
                              @error('term')
                              <span class="text-danger">{{$message}}</span>  
                              @enderror
                              </div>



                              <div class="col form-group">
                                <x-jet-label>Indicator</x-jet-label>
                               <select class="form-control" name="indicator">
                                <option value="">Select Indicator</option>
                               
                                <option value="scoresheet">Scoresheet</option>
                                <option value="summary_scoresheet">Summerized Scoresheet</option>
                                <option value="manual_promotion">Manual Promotion</option>
                               
            
                             
                               </select>
                                @error('indicator')
                                <span class="text-danger">{{$message}}</span>  
                                @enderror
                                </div>


                                <input type="hidden" name="key" value="class_based ">


                            </div>
  
                        

                        
                        
                     
                           
                  </div>
                  </div>
                  <!-- /.card-body -->
        
                  <div class="card-footer">
                    <x-jet-button>Load Term Data</x-jet-button>
                  </div>
              </form>
              </div>
  
          </div>
    
  
  
  
     </div>
  </div>
  <!---End  of Assessement Types---->
  
  <!---Beginning of Section Analytics---->
  {{-- <div class="tab-pane fade" id="pills-section_analysis" role="tabpanel" aria-labelledby="pills-section_analysis-tab">
    <div class="row">
        <div class="col-md-12">
  
            <div class="card card-light">
                <div class="card-header">
                  <h3 class="card-title">Section Analysis</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('analytics.section') }}" method="post">
                <!-- /beginning of card-body -->
                  <div class="card-body">
                        @csrf
  
                        <div class="form-row">
  
                          <div class="col-md-3 form-group">
                          <x-jet-label>Section Name</x-jet-label>
                          <select class="form-control" name="stream_name">
                          <option value="">Select Section</option>
                          @foreach ($sections as $section)
                          <option value="{{$section->id}}">{{$section->section_name}}</option>
                              
                          @endforeach
                         </select>
                          @error('stream')
                          <span class="text-danger">{{$message}}</span>  
                          @enderror
                          </div>
  
                          @include('partials.assessement')
  
    
                  </div>
                  <!-- /end of card-body -->
        
                  <div class="card-footer">
                    <x-jet-button>Load Section Analytics</x-jet-button>
                  </div>
                  </div>
                </form>
              </div>
  
          </div>
     
     </div>
  </div> --}}
  <!---End of Section Analytics---->
  
  <!---Beginning of Class Based Analytics ---->
  {{-- <div class="tab-pane fade" id="pills-class-analysis" role="tabpanel" aria-labelledby="pills-class-analysis-tab"> --}}
    {{-- <div class="row">
        <div class="col-md-12">
  
            <div class="card card-light">
                <div class="card-header">
                  <h3 class="card-title">Class Analysis</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('analytics.grade') }}" method="post">
                <!-- /beginning of card-body -->
                  <div class="card-body">
                        @csrf
                        <div class="form-row">
                          <div class="col-md-6 form-group">
                            <x-jet-label>Class</x-jet-label>
                            <select class="form-control" name="grade">
                            <option value="">Select Class</option>
                            @foreach ($grades as $grade)
                            <option value="{{$grade->id}}">{{$grade->grade_name}}</option>
                            @endforeach
                            </select>
                            @error('grade')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>
  
                        
                        @include('partials.assessement')
                        
      
                  </div>
                  <!-- /end of card-body -->
        
                  <div class="card-footer">
                    <x-jet-button>Load Class Analytics</x-jet-button>
                  </div>
                </form>
              </div>
  
          </div>
    
  
  
      
     </div>
   </div> --}}
  <!---End of Class Based Analytics ---->
  
  
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
  
  <script>
    $(document).ready(function () {
      $('#subject_div').hide();
         
     $("#analysis_indicator").change(function () {
                 var indicator=$(this).val();
  
             if (indicator=="subject_analysis") {
  
                 //Show list of subjects
                 $('#subject_div').show();
                 
  
                
                 
             }else{
                 $('#subject_div').hide();
             }
               
             });
  
     });
  
  </script>
    
  </x-app-layout>