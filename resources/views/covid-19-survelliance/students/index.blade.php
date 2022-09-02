
<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light  ">
              <div class="card-header">
                <h3 class="card-title">Add Student Temperature Data</h3>
              </div>

                <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_320,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:COVID-19 Temperature,w_0.3,y_0.28/v1613303961/pexels-photo-5212359_ukdzdz.jpg" alt="">
                <div class="card-body">
                  <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
                 <div class="text-muted">
                    <p class="card-text">  Use this section to add your add student temperature data. <br>
                  
                    </p>
                  
                 </div>
                
                </div>
                
              
              <!-- /.card-header -->
              <!-- form start -->
           
              <livewire:covid-student-list/>
            </div>
      
      
        </div>
     
            
          </div>  
    
</x-app-layout>

 