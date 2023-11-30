<x-app-layout>
    <x-slot name="header">
  
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Report Templates</h3>
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
    
  <div class="col">
  
    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">Update Report Template</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('report_template.update')}}" method="post">
          <div class="card-body">
            
            @csrf
          <div class="form-group">
              <x-jet-label>Select Template</x-jet-label>
              <input type="text" class="form-control" value="{{$template->template_name}}" name="template_name" placeholder="Enter Template Name"/>
              @error('template_name')
              <span class="text-danger">{{$message}}</span>  
              @enderror
          </div>

        
        <div class="form-group">
          <x-jet-label>Report Columns</x-jet-label>
        <select class="form-control" name="report_columns" id="report_columns">
          <option value="{{$template->report_colums}}">{{$template->report_colums}}</option>
          <option value="">---------------------------------------------</option>
          <option value="ca_only">Show CA Column Only</option>
          <option value="exam_only">Show Examination Column Only</option>
          <option value="ca_exam"> Show Exam & Assessement Columns</option>
          <option value="term_assessement_categorization">Show Term Assessment Categorization</option>
          <option value="custom">Custom Template</option>
        </select>
      
          @error('report_columns')
          <span class="text-danger">{{$message}}</span>  
          @enderror
      </div>

      <input type="hidden" name="template_id" value="{{$template->id}}" >
         
          </div>
          <!-- /.card-body -->
  
          <div class="card-footer">
            <x-jet-button>Update Template </x-jet-button>
          </div>
       
      </div>
    </form>
  
  </div>
  

  
  </div>
      
    </div>   

     
    
  </x-app-layout>