<x-app-layout>
    <x-slot name="header">
  
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">report Templates</h3>
      </div>
  
      
        <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_280,w_980/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:Report Templates,w_0.5,y_0.20/v1660349166/pexels-antony-trivet-12840331_itu0ou.jpg" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to manage report templates. <br>
                You can choose which template the report card is going to use. Shunifu currently has three report templates.
                <ul>
                    <li><span class="text-bold">Default Template</span>-This is the default report template. It shows continious assessment, examination, subject average, symbol, comment, and teacher initials columns.</li>
                    
                    <li><span class="text-bold">Lite Template</span>-This is the lite report template. It shows the subject average,  symbol, comment, and teacher initials columns</li>

                    <li><span class="text-bold">Detailed Template</span>-This is the detailed report template. It all assessemets of the term as well as Subject Average,  Symbol, Comment, and Teacher Initials colums</li>
                </ul>
          
            </p>
          
         </div>
        
        </div>
    </div> 
  <div class="row">
    
  <div class="col-sm-4 col-md-4">
  
    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">Choose Report Template</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('report_template.store')}}" method="post">
          <div class="card-body">
            
            @csrf
          <div class="form-group">
              <x-jet-label>Select Template</x-jet-label>
              <select class="form-control" name="template_name">
                <option value="">Choose Template</option>
                <option  value="default">Default</option>
                <option value="lite">Lite</option>
                <option  value="detailed">Detailed</option>
              </select>
              @error('template_name')
              <span class="text-danger">{{$message}}</span>  
              @enderror
             
          </div>
         
          </div>
          <!-- /.card-body -->
  
          <div class="card-footer">
            <x-jet-button>Add Template </x-jet-button>
          </div>
       
      </div>
    </form>
  
  </div>
  
  <div class="col-md-8">
  
    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Current Report Template</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      
        <div class="card-body">
        <div class="responsive">

         
              <ul>
                @foreach ($template as $item)
              
                <li>{{$item->template_name}}</li>
             
            @endforeach
              </ul>
           
     
          
       
        </div>
         
        </div>
  
     
    </div>
  
  </div>
      
    </div>   

     
    
  </x-app-layout>