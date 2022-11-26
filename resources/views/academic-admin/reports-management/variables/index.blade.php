<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Add Report Variables</h3>
      </div>
      <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_270,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_50_style_light_align_center:Report Card Variables,w_0.4,y_0.20/v1651865443/pexels-lukas-669613_oo6fno.jpg"
      alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->salutation}} {{Auth::user()->lastname}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to manage report variables  <br>
          
            </p>
          
         </div>
        
        </div>
    </div>  
<div class="row">


    
  <div class="col-md-4">

    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">Add Variables</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('report_template.variable_store')}}" method="post">
          <div class="card-body">
            
                @csrf
                <div class="form-group">
                <x-jet-label>Column Color</x-jet-label>
                <small id="colorHelp" class="form-text text-muted">Select the column color here. Click on the color.</small>
                <x-jet-input name="color" type="color" value="#0000ff" ></x-jet-input>
                
                @error('color')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

                <div class="form-group">
                  <x-jet-label>Student Image</x-jet-label>
                  <small id="imageHelp" class="form-text text-muted">Enable or disable student image in report.</small>
                  <select name="student_image" id="student_image" class="form-control">
                    <option value="">Select Option</option>
                    <option value="1">Show Image</option>
                    <option value="0">No Student Image</option>
                  </select>
                  @error('student_image')
                  <span class="text-danger">{{$message}}</span>  
                  @enderror
                </div>

                <div class="form-group">
                    <x-jet-label>Student Attendance Data</x-jet-label>
                    <small id="imageHelp" class="form-text text-muted">Enable or disable student image in report.</small>
                    <select name="attendance_data" id="attendance_data" class="form-control">
                      <option value="">Select Option</option>
                      <option value="1">Show Attendance</option>
                      <option value="0">Remove Student Attendance</option>
                    </select>
                    @error('student_image')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                  </div>

                <div class="form-group">
                    <x-jet-label>Data Visualization</x-jet-label>
                    <select name="data_visualization" id="data_visualization" class="form-control">
                      <option value="">Select Option</option>
                      <option value="1">Show Data Visualization</option>
                      <option value="0">Hide Data Visualization</option>
                    </select>
                    @error('data_visualization')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                  </div>


                  <div class="form-group">
                    <x-jet-label>Font Size</x-jet-label>
                   <input type="text" name="font_size" class="form-control">
                    @error('font_size')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                  </div>

                <div class="form-group">
                <x-jet-label>Principal Signature</x-jet-label>
               <select class="form-control" name="principal_signature">
                <option value="">Select Option</option>
                <option value="1">Digital Signature</option>
                <option value="0">Manual Signature</option>
            
               </select>
                @error('principal_signature')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

                <div class="form-group">
                    <x-jet-label>School Stamp</x-jet-label>
                   <select class="form-control" name="school_stamp">
                    <option value="">Select Option</option>
                    <option value="1">Digital Stamp</option>
                    <option value="0">Manual Stamp</option>
                
                   </select>
                    @error('school_stamp')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div>

                <div class="form-group">
                    <x-jet-label>Page Orientation</x-jet-label>
                   <select class="form-control" name="page_orientation">
                    <option value="">Select Option</option>
                    <option value="1">Potrait</option>
                    <option value="0">Landscape</option>
                
                   </select>
                    @error('page_orientation')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div>

         

               
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <x-jet-button>Add Report Variables</x-jet-button>
          </div>
       
      </div>
    </form>

  </div>

  <div class="col-md-8">

    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Manage Variables</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      
        <div class="card-body">
          
          <table class="table table-bordered table table-hover table-responsive-md ">
            <thead class="thead-light">
              <tr>
                <th>Variable Name</th>
                <th>Manage</th>
              </tr>
            </thead>
            <tbody>
              <tr>
               {{-- @foreach ($collection_subject as $subject_item) --}}
               <tr>
                   <td></td>
                  
               

                    <td class="text-left py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="subject/edit/" class="btn btn-info"><i class="fas fa-edit mr-1"></i>Edit</a>
                        <a href="subject/delete/" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Delete</a>
                      </div>
                    </td>
                   
                </tr>
               
               
               {{-- @endforeach --}}
              </tr>
              
            </tbody>
          </table>
        </div>

     
    </div>

  </div>
      
    </div>   
            
     
    
</x-app-layout>