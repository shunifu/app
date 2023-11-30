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
              <x-jet-label>Enter Template Name</x-jet-label>
              <input type="text" class="form-control" name="template_name" placeholder="Enter Template Name"/>
              @error('template_name')
              <span class="text-danger">{{$message}}</span>  
              @enderror
          </div>

          
        <div class="form-group">
          <x-jet-label>Choose Report Table Columns</x-jet-label>
        <select class="form-control" name="report_columns" id="report_columns">
          <option value="">Choose Columns to Show</option>
          <option value="ca_only">Show CA Column Only</option>
          <option value="exam_only">Show Examination Column Only</option>
          <option value="ca_exam"> Show Exam & CA Columns</option>
          <option value="ca_exam_p"> Show Exam with Position & CA with Position </option>
          <option value="term_assessement_categorization">Show Term Assessment Categorization</option>
          <option value="custom">Custom Template</option>
        </select>
          @error('report_columns')
          <span class="text-danger">{{$message}}</span>  
          @enderror
      </div>

      <div class="form-group">
        <x-jet-label>Subject Positioning</x-jet-label>
        <select class="form-control" name="subject_positioning" id="subject_positioning">
            <option value="">Select Subject Positioning</option>
            <option value="class_based">Class Based</option>
            <option value="stream_based">Stream Based</option>
            <option value="teacher_load_based">Teaching Load Based</option>
        </select>
        @error('report_branding')
        <span class="text-danger">{{$message}}</span>  
        @enderror
        </div>

 <div class="form-group">
  <x-jet-label>Comments To Show</x-jet-label>
  <select class="form-control" name="comment_category" id="comment_category">
      <option value="">Select Comment Category</option>
      <option value="1">Subject Comments</option>
      <option value="2">Class Teacher Comment</option>
      <option value="5">Home Room Teacher Comment</option>
      <option value="6">Class Coodinator Comment</option>
      <option value="3">Head Teacher Comment</option>
      <option value="4">Effort Grade</option>
  </select>
  @error('comment_category')
  <span class="text-danger">{{$message}}</span>  
  @enderror
  </div>


  <div class="form-group">
    <x-jet-label>School Branding</x-jet-label>
    <select class="form-control" name="school_branding" id="school_branding">
        <option value="">Select School Brand Option</option>
        <option value="1">Enable</option>
        <option value="0">Disable</option>
    </select>
    @error('report_branding')
    <span class="text-danger">{{$message}}</span>  
    @enderror
    </div>

  


         
          </div>
          <!-- /.card-body -->
  
          <div class="card-footer">
            <x-jet-button>Add Report Template </x-jet-button>
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
                <th>Action</th>
                
              </tr>
            </thead>
            <tbody>
              @foreach ($template as $item)
              <tr>
              
  <td>{{$item->template_name}}</td>
  <td>{{$item->report_colums}}</td>
  <td class="py-0 align-middle">
  <div class="btn-group btn-group-md">
  <a href="/report/templates/edit/{{encrypt($item->id)}}" class="btn btn-info"><i class="fas fa-edit mr-1"></i>Edit</a>
  <a href="/report/templates/delete/{{encrypt($item->id)}}" class="btn btn-danger delete_template"><i class="fas fa-trash mr-1"></i>Delete</a></td>
  </div>

  </tr>
  @endforeach
  </tbody>
  </table>

         
           
           
     
          
       
        </div>
         
        </div>
  
     
    </div>
  
  </div>
      
    </div>   

     
    
  </x-app-layout>