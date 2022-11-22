<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light  ">
              <div class="card-header">
                <h3 class="card-title">Transfer Teaching Loads</h3>
              </div>

                <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_320,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:Transfer Teaching Loads,w_0.3,y_0.28/v1613303961/pexels-photo-5212359_ukdzdz.jpg" alt="">
                <div class="card-body">
                  <h3 class="lead">Hi, {{Auth::user()->salutation}} {{Auth::user()->name}} {{Auth::user()->lastname}}</h3>
                 <div class="text-muted">
                    <p class="card-text">  Use this section to transfer teaching loads.  <br> Select the students you want to transfer to the new teacher
                  
                    </p>
                  
                 </div>
                
                </div>
                
              
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('teaching_loads_transfer.step3')}}" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-row">
                      <div class="col-md-4 form-group">
                        <x-jet-label> Transfer To</x-jet-label>
<select class="form-control">
<option value="0">{{$transfer_to_qry_user->lastname}} {{$transfer_to_qry_user->name}}</option>
                       </select>
                        @error('transfer_to')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                        <div class="col-md-4 form-group">
                          <x-jet-label> Teaching Load</x-jet-label>
                         <select class="form-control" >
                        
                          <option value="0"> {{$transfer_to_qry->grade_name}} {{$transfer_to_qry->subject_name}}  </option>
                          
                         </select>
                          @error('transfer_to')
                          <span class="text-danger">{{$message}}</span>  
                          @enderror
                          </div>

                        <div class="col-md-4 form-group">
                            <x-jet-label> Transfer Type</x-jet-label>
                           <select class="form-control" name="transfer_type">
                            <option value="some">Transfer Some Students</option>
                           </select>
                            @error('transfer_type')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>

                          </div>  
                          <div class="text-muted">List of Students</div>     <br>Below is a list of students. Please select the ones that you want to transfer to the other teacher.          
                          <hr>
<div class="student_list">

  <input type="checkbox" id="select_all" name="select_all">
  <label for="students">Transfer All</label>
  <p>
  
  </p>
  
  @foreach ($student_loads as $item)

 <div>
  <input type="checkbox" class="students" name="students[]" value="{{$item->id}}" >
  <input type="hidden" id="teacher_id" name="teacher_id" value="{{$transfer_to_qry_user->id}}">
  <input type="hidden" id="teaching_load" name="teaching_load" value="{{$transfer_to_qry->id}}"
  <input type="hidden" id="subject_id" name="subject_id" value="{{$transfer_to_qry->subject_id}}">
  <input type="hidden" id="class_id" name="class_id" value="{{$transfer_to_qry->grade_id}}">
 
  <label for="students">{{$item->lastname}} {{$item->name}} {{$item->middlename}} </label>
 </div>
     
  @endforeach
</div>
                       
                
                </div>
                <!-- /.card-body -->
      
                <div class="card-footer">
                  <x-jet-button>Next</x-jet-button>
                </div>
            </form>
            </div>
      
      
        </div>
     
            
          </div>  
          <script>
            $('#select_all').change(function() {
       
       
       $('.students').prop("checked", this.checked);
       
       });
       
       $('.students').change(function() {
       
       if ($('input:checkbox:checked.students').length === $("input:checkbox.students").length) {
         $('#select_all').prop("checked", true);
       } else {
         $('#select_all').prop("checked", false);
       }
       
       })
       
          </script>
           
</x-app-layout>

 