<x-app-layout>
    <x-slot name="header">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Add Teaching Loads</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('teacher.loadstudents')}}" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-row">
                      <div class="col-md-4 form-group">
                        <x-jet-label> Class Name</x-jet-label>
                       <select class="form-control" name="grade_id">
                        <option value="">Select Class</option>
                        @foreach ($classes as $class)
                        <option value="{{$class->id}}">{{$class->grade_name}}</option>
                            
                        @endforeach
                       </select>
                        @error('grade_id')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                        <div class="col-md-4 form-group">
                            <x-jet-label>Subject Name</x-jet-label>
                           <select class="form-control" name="subject_id">
                            <option value="">Select Subject</option>
                            @foreach ($subjects as $subject_item)
                            <option value="{{$subject_item->id}}">{{$subject_item->subject_name }}</option>
                            @endforeach
                           </select>
                            @error('subject_id')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                            <div class="col-md-4 form-group">
                                <x-jet-label> Academic Year</x-jet-label>
                               <select class="form-control" name="academic_session">
                                <option value="">Select Academic Year</option>
                                @foreach ($sessions as $session)
                                <option value="{{$session->id}}">{{$session->academic_session }}</option>
                                @endforeach
                               </select>
                                @error('academic_session')
                                <span class="text-danger">{{$message}}</span>  
                                @enderror
                            </div>
                </div>
                </div>
                <!-- /.card-body -->
      
                <div class="card-footer">
                  <x-jet-button>Load Students</x-jet-button>
                </div>
            </form>


            </div>
      
      
        </div>
        <div class="col-md-12 mt-4">

          <div class="card bg-white">
           
          
            <div class="card-body">
        
        <p>Hi {{Auth::user()->name}}, you are adding  <span class="text-bold"> {{$load_subject->subject_name}} </span> for students in <span class="text-bold">{{$load_class->grade_name}}</span> for academic year <span class="text-bold">{{$load_session->academic_session}}</span> 
        to continue, please select the students that you teach, if you teach all of them click on select all, but if you teach <span class="text-italics">some of them</span> click only on those that you teach. Siyabonga! </p>
              <p class="card-text">
                <form action="{{route('teachingloads.store')}}" method="post">  
                  @csrf
                  <div class="student_list">
        
          @if ($load_session->active==1)
            <input type="checkbox" id="select_all" name="select_all">
          <label for="students">Select All</label>
          <hr>
          
          @foreach ($result_students as $item)
		  
          <div>
           <input type="checkbox" class="students" name="students[]" value="{{$item->id}}" >
           <input type="hidden" id="teacher_id" name="teacher_id" value="{{Auth::user()->id}}">
           <input type="hidden" id="subject_id" name="subject_id" value="{{$load_subject->id}}">
           <input type="hidden" id="class_id" name="class_id" value="{{$load_class->id}}">
           <input type="hidden" id="academic_session" name="academic_session" value="{{$item->academic_session}}">
           <label for="students">{{$item->lastname}} {{$item->name}} {{$item->middlename}} </label>
          </div>
              
           @endforeach    
          @else
          Select Active Academic Year 
          @endif
         
        </div>
<hr>
              <div class=" m-0">
                <x-jet-button>Add Teaching Load</x-jet-button>
              </div>
            </form>
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
    
      
      
    
    </div>
            
          </div>  
    
</x-app-layout>

 