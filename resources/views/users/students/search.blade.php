<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<div class="form-row no-print">

    <div class="col-md-12 form-group ">
    <form action="{{route('student.load')}}" method="post">
    @csrf
    <x-jet-label> Class Name</x-jet-label>
    <select class="form-control" name="grade_id" onchange="getstudent(this.value);">
    <option value="0">Select Class</option>
    @foreach ($class as $class_item)
    <option value="{{$class_item->id}}">{{$class_item->grade_name}}</option>
    @endforeach
    </select>
    @error('class')
    <span class="text-danger">{{$message}}</span>  
    @enderror
    <div class="pt-2"> 
      <x-jet-button>Load Students</x-jet-button>
    </div>
    
  </form>
      </div>

      </div>


      