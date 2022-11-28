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
                You can choose which template the report card is going to use. 
          
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
              <input type="text" class="form-control" name="template_name" placeholder="Enter Template Name"/>
              @error('template_name')
              <span class="text-danger">{{$message}}</span>  
              @enderror
          </div>

          {{-- <div class="form-group">
            <x-jet-label>Select Section</x-jet-label>
     
          <select class="form-control" name="class_type" id="class_type">
            <option value="">Select Class Type</option>
            <option value="internal_classes">Internal Classes</option>
            <option value="external_classes">External Classes</option>
          </select>
        
            @error('class_type')
            <span class="text-danger">{{$message}}</span>  
            @enderror
        </div> --}}
        <div class="form-group">
          <x-jet-label>Report Columns</x-jet-label>
        <select class="form-control" name="report_columns" id="report_columns">
          <option value="">Columns To Show</option>
          <option value="ca_only">CA Only</option>
          <option value="exam_only">Exam Only</option>
          <option value="ca_exam"> CA & Exam</option>
          <option value="term_assessements">Term Assessements</option>
          <option value="year_assessements">Year Assessements</option>
        </select>
      
          @error('report_columns')
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
        <h3 class="card-title"> Report Templates</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      
        <div class="card-body">
        <div class="responsive">

          <table class="table table-bordered table table-hover table-responsive-md ">
            <thead class="thead-light">
              <tr>
                <th>Template Name</th>
                <th>Columns</th>
                
              </tr>
            </thead>
            <tbody>
              <tr>
              @foreach ($template as $item)
              <td>{{$item->template_name}}</td>
              <td>{{$item->report_colums}}</td>
            @endforeach
       
              </tr>
            
            </tbody>
          </table>

         
           
           
     
          
       
        </div>
         
        </div>
  
     
    </div>
  
  </div>
      
    </div>   

     
    
  </x-app-layout>