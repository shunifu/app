<x-app-layout>
    <x-slot name="header">
  
    </x-slot>

    <div class="row">
        <div class="col-md-12">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Add Lesson Assessement</h3>
              </div>
<div class="card-body">

            
              <form action="{{route('online-learning.store_assesement_teacher')}}" method="post">
                @csrf

                      <div class="form-row">
<input type="hidden" value="{{$lesson->id}}" name="lesson_id">
                            <div class="col-md-4 form-group">
                                <x-jet-label>Select Class</x-jet-label>
                                <select class="form-control" name="teaching_load_id" >
                                <option value="{{$lesson->teaching_load_id}}">{{$lesson->grade_name}} - {{$lesson->subject_name}}</option>
                               
                                </select>
                                @error('teaching_load')
                                <span class="text-danger">{{$message}}</span>  
                                @enderror
                                </div>


                                
                                <div class="col-md-4 form-group">
                                  <x-jet-label> Assessement Title</x-jet-label>
                                  <x-jet-input name="title"  ></x-jet-input>
                                  @error('title')
                                  <span class="text-danger">{{$message}}</span>  
                                  @enderror
                                  </div>

                                <div class="col-md-4 form-group">
                                  <x-jet-label> Lesson Title</x-jet-label>
                                  <x-jet-input name="lesson_title" value="{{$lesson->lesson_title}}" readonly ></x-jet-input>
                                  @error('lesson_title')
                                  <span class="text-danger">{{$message}}</span>  
                                  @enderror
                                  </div>

                                  <div class="col-md-4 form-group">
                                    <x-jet-label> Due Date</x-jet-label>
                                    <x-jet-input name="due_date" required  type="datetime-local"></x-jet-input>
                                    @error('due_date')
                                    <span class="text-danger">{{$message}}</span>  
                                    @enderror
                                    </div>
                      </div>


<x-jet-label>Add Questions</x-jet-label>
<br>
<small>Use this section to add questions </small>

  
<div class="col-md-12 form-group">
  @include('online-learning.js.tiny')
<textarea name="lesson_content" class="form-control my-editor" style="min-height: 80vh;"></textarea>

  
    </div>

 
                                
            
      
                <div class="card-footer">
                  <x-jet-button>Add Assessement</x-jet-button>
                </div>
            </form>
            </div>
          </div>
      
      
        </div>

            
          </div>  

   
    
</x-app-layout>

 