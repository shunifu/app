<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light  ">
              <div class="card-header">
                <h3 class="card-title">View Student Comments</h3>
              </div>

                <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_320,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:Manage Comment Management,w_0.3,y_0.28/v1613303961/pexels-photo-5212359_ukdzdz.jpg" alt="">
                <div class="card-body">
                  <h2 class="lead text-bold">Hi, {{Auth::user()->name}}</h3>
                 <div class="text-muted">
      <p class="card-text"> Please use this section to manage student comments for your <span class="text-bold">{{$classteacher_list->grade_name}} class</span> <br>
        Your current role: @if ($classteacher_list->class_manager_status=="1")
            <span class="text-bold">Home Room Teacher</span>
        @else
        <span class="text-bold">Class Tutor</span>
            
        @endif

       
                  
                    </p>
                  
                 </div>
                
                </div>
                
          
    
                <div class="card-body">
                      @csrf
                      <input type="hidden" name="teacher_id"  value="{{$classteacher_list->teacher_id}}">
               


         
             
        
      
      
    
        <form action="{{route('custom-comment-class.store')}}" method="post">
          @csrf
        <table class="table table-bordered table table-hover table-responsive-md ">
            <thead class="thead-light">
                <tr>
               
                    <th class="col-3">Student Name </th>
                    <th>Term Average </th>
               
                    <th>Comment </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($student_list as $key=>$student_item)
 
                <tr>
                  <td>{{$student_item->lastname}} {{$student_item->middlename}} {{$student_item->name}}</td>
                  <td>{{$student_item->student_average}}%</td>
   
                  <td>
                    <div class="row" id="comment_data">
                <textarea name="comment[]" class="form-control  text-area small" id="" cols="10" rows="10"  required>{{$student_item->comment}}</textarea>
                    
                     <input type="hidden" name="student_id[{{$key}}]" value="{{$student_item->student_id}}">
                     <input type="hidden" name="manager_type[{{$key}}]" value="{{$manger_type}}">
                     <input type="hidden" name="grade_id[{{$key}}]" value="{{$grade_id}}">
                     <input type="hidden" name="teacher_id[{{$key}}]" value="{{$teacher_id}}">
                     <input type="hidden" name="term[{{$key}}]" value="{{$term}}">
                     
                   
                
                    </div>
              
                  </td>
              
              </tr> 
          
              @endforeach
                    
                    
            </tbody>
        </table>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <x-jet-button>Add {{$classteacher_list->grade_name}} Comment </x-jet-button>
          </div>
      </form>

            
          </div>  
        </div>
    </div>
    
</x-app-layout>

 