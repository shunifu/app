<div>
<form action="#" method="post">
    <div class="card-body">
          @csrf
          <div class="form-row">
          <div class="col-md-4 form-group">
            <x-jet-label> Class Name</x-jet-label>
           <select class="form-control" name="grade_id" wire:model="selectedClass">
            <option value="">Select Class</option>
            @foreach ($classes as $class)
            <option value="{{$class->id}}">{{$class->grade_name}}</option>
                
            @endforeach
           </select>
            @error('class')
            <span class="text-danger">{{$message}}</span>  
            @enderror
            </div>

            @if (!is_null($students))

            <div class="col-md-4 form-group">
                <x-jet-label> Student Name</x-jet-label>
               <select class="form-control" name="student_id" >
                <option value="">Select Student</option>
                @foreach ($students as $student)
                <option value="{{$student->id}}">{{$student->lastname}} {{$student->name}} {{$student->middlename}}</option>
                    
                @endforeach
               </select>
                @error('students')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

                <div class="col-md-4 form-group">
                    <x-jet-label> Student Temperature</x-jet-label>
                    <div class="row">
                      <div class="col">
                        <input type="text" maxlength="2"  id="student_temperature"  class="form-control input-sm col-sm" placeholder="Enter Temperature" name="student_temperature">
                      </div>
                      <div class="col-0">
                          .
                      </div>
                      <div class="col">
                        <input type="text" maxlength="1"  id="student_temperature"  class="form-control input-sm col-sm" placeholder="Enter Temperature" name="student_temperature">
                      </div>
                    </div>
                    
                    @error('temperature')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
               
    
                  
                
              </div>


                
            @endif

    </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <x-jet-button wire:Loading.attr="disabled">Add Temperature</x-jet-button>
      <div wire:loading>
          Hold On...
      </div>
    </div>
</form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>



  $("#student_temperatures").keyup(function () {
    if (this.value.length == 2) {
      $(this).next('#student_temperature2').focus();
    }
});
</script>