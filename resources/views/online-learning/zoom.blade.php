<x-app-layout>
    <x-slot name="header">
      <script src="https://cdn.tiny.cloud/1/anqtj7pm0x1m618dm8p3mh2lr2l0roao0o2z1kbht1928q4q/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
      
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Add Lesson</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="#" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-row">

                            <div class="col-md-4 form-group">
                                <x-jet-label>Select Class</x-jet-label>
                                <select class="form-control" name="teaching_load">
                                <option value="0">Select Class</option>
                                @foreach ($result_load as $teaching_load_item)
                                <option value={{$teaching_load_item->id}}>{{$teaching_load_item->grade_name}} - {{$teaching_load_item->subject_name}}</option>
                                @endforeach
                                </select>
                                @error('teaching_load')
                                <span class="text-danger">{{$message}}</span>  
                                @enderror
                                </div>

                                <div class="col-md-4 form-group">
                                  <x-jet-label>Zoom Lesson Title</x-jet-label>
                                  <x-jet-input name="lesson_title" required ></x-jet-input>
                                  @error('lesson_title')
                                  <span class="text-danger">{{$message}}</span>  
                                  @enderror
                                  </div>

                                  <div class="col-md-4 form-group">
                                    <x-jet-label> Zoom Lesson Date</x-jet-label>
                                    <x-jet-input name="lesson_date" required type="datetime"></x-jet-input>
                                    @error('lesson_date')
                                    <span class="text-danger">{{$message}}</span>  
                                    @enderror
                                    </div>
                      </div>


                                
                </div>
                <!-- /.card-body -->
      
                <div class="card-footer">
                  <x-jet-button>Add Lesson</x-jet-button>
                </div>
            </form>
            </div>
      
      
        </div>

            
          </div>  
    
</x-app-layout>

 