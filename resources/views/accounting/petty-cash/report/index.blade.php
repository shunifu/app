<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light  ">
              <div class="card-header">
                <h3 class="card-title">Petty Cash Report </h3>
              </div>

                <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_320,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:View Petty Cash Report,w_0.3,y_0.28/v1613303961/pexels-photo-5212359_ukdzdz.jpg" alt="">
                <div class="card-body">
                  <h3 class="lead">Hi, {{Auth::user()->salutation}} {{Auth::user()->name}} {{Auth::user()->middlename}} {{Auth::user()->middlename}}</h3>
                 <div class="text-muted">
                    <p class="card-text">  Use this section to view petty cash reports. <br>
                  
                    </p>
                  
                 </div>
                
                </div>
                
              
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('pettycash.report')}}" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-row">
                      <div class="col-md-4 form-group">
                        <x-jet-label> Select Report Type</x-jet-label>
                       <select class="form-control" name="report_type">
                        <option value="">Select Report Type</option>
                        
                        <option value="consolidated">Consolidated Report</option>
                        <option value="transactional">Transactional Report</option>
                            
                        
                       </select>
                        @error('report_type')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                       

                            <div class="col-md-4 form-group">
                                <x-jet-label> Financial Year</x-jet-label>
                               <select class="form-control" name="financial_year">
                                <option value="">Select Financial Year</option>
                                @foreach ($sessions as $session_item)
                                <option value="{{$session_item->id}}">{{$session_item->academic_session }}</option>
                                @endforeach
                               </select>
                                @error('financial_year')
                                <span class="text-danger">{{$message}}</span>  
                                @enderror
                            </div>


                            <div class="col-md-4 form-group">
                                <x-jet-label>Month</x-jet-label>
                               <select class="form-control" name="month">
                                <option value="">Select Month</option>
                                <option value="1">January</option>
                                <option value="2">Febuary</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                              
                               </select>
                                @error('month')
                                <span class="text-danger">{{$message}}</span>  
                                @enderror
                            </div>
                </div>
                </div>
                <!-- /.card-body -->
      
                <div class="card-footer">
                  <x-jet-button>Generate Report</x-jet-button>
                </div>
            </form>
            </div>
      
      
        </div>
     
            
          </div>  
    
</x-app-layout>

 