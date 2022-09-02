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
            @error('class')
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
                    @foreach ($session as $session_item)
                    <option value="{{$session_item->id}}">{{$session_item->academic_session }}</option>
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