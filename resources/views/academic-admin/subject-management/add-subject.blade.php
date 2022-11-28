<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Add Subject</h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_320,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_32_style_light_align_center:Subjects Management,w_0.3,y_0.20/v1617761938/pexels-tima-miroshnichenko-6549340_lhnivg.jpg" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->salutation}} {{Auth::user()->lastname}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to manage subjects in your school <br>
          
            </p>
          
         </div>
        
        </div>
    </div>  
<div class="row">


    
  <div class="col-md-4">

    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">Add Subject</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('subject.store')}}" method="post">
          <div class="card-body">
            
                @csrf
                <div class="form-group">
                <x-jet-label>Subject Name</x-jet-label>
                <x-jet-input name="subject_name" placeholder="e.g English Language" ></x-jet-input>
                @error('subject_name')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

                <div class="form-group">
                  <x-jet-label>ECESWA Code</x-jet-label>
                  <x-jet-input name="subject_code" placeholder="Enter ECESWA code" ></x-jet-input>
                  @error('subject_code')
                  <span class="text-danger">{{$message}}</span>  
                  @enderror
                </div>

                <div class="form-group">
                <x-jet-label>Subject Type</x-jet-label>
               <select class="form-control" name="subject_type">
                <option value="0">Select Subject Type</option>
                <option value="4">Passing Subject</option>
                <option value="1">Core Subject</option>
                <option value="2">Elective Subject</option>
                <option value="3">Non Contributing Subject</option>
               </select>
                @error('subject_type')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

                <div class="form-group">
                  <x-jet-label>Section</x-jet-label>
                 <select class="form-control" name="subject_section">
                  <option value="">Select Level</option>
                  <option value="0">All Levels</option>
                @foreach ($sections as $section_item)
                    <option value="{{$section_item->id}}">{{$section_item->section_name}}</option>
                @endforeach
                
                 </select>
                  @error('subject_section')
                  <span class="text-danger">{{$message}}</span>  
                  @enderror
                  </div>

         

               
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <x-jet-button>Add Subject</x-jet-button>
          </div>
       
      </div>
    </form>

  </div>

  <div class="col-md-8">

    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Manage Subjects</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      
        <div class="card-body">
          
          <table class="table table-bordered table table-hover table-responsive-md ">
            <thead class="thead-light">
              <tr>
                <th>Subject Name</th>
                <th>ECESWA Code</th>
                <th>Subject Type</th>
                <th>Level</th>
                <th>Manage</th>
              </tr>
            </thead>
            <tbody>
              <tr>
               @foreach ($collection_subject as $subject_item)
               <tr>
                   <td>{{$subject_item->subject_name}}</td>
                   <td>{{$subject_item->subject_code}}</td>
                   <td>{{$subject_item->subject_type}}</td>
                
                   <td>
                     <?php
                   if($subject_item->section_level==0){
                   echo 'All Levels';
                   }else
                   echo $subject_item->section_name;
                   ?>
                      </td>
               

                    <td class="text-left py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="subject/edit/{{$subject_item->id}}" class="btn btn-info"><i class="fas fa-edit mr-1"></i>Edit</a>
                        <a href="subject/delete/{{$subject_item->id}}" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Delete</a>
                      </div>
                    </td>
                   
                </tr>
               
               
               @endforeach
              </tr>
              
            </tbody>
          </table>
        </div>

     
    </div>

  </div>
      
    </div>   
            
     
    
</x-app-layout>