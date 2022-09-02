<x-app-layout>
    <x-slot name="header">
      <script src="https://cdn.tiny.cloud/1/anqtj7pm0x1m618dm8p3mh2lr2l0roao0o2z1kbht1928q4q/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
      
    </x-slot>
    @foreach ($lesson as $item)
        
 
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">   <a href="/users/teacher/online-learning/manage"><x-jet-button> <i class="fas fa-hand-point-left"></i> Back to Lessons</x-jet-button></a></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('online-learning.edit')}}" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-row">
<input type="hidden" value="{{$item->id}}" name="id">
                            <div class="col-md-6 form-group">
                                <x-jet-label>Select Class</x-jet-label>
                                <select class="form-control" name="teaching_load">
                                <option value="{{$item->class_id}}">{{$item->grade_name}}</option>
                               
                                </select>
                                @error('teaching_load')
                                <span class="text-danger">{{$message}}</span>  
                                @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                  <x-jet-label> Lesson Title</x-jet-label>
                                  <x-jet-input name="lesson_title" value="{{$item->lesson_title}}" required ></x-jet-input>
                                  @error('lesson_title')
                                  <span class="text-danger">{{$message}}</span>  
                                  @enderror
                                  </div>

                                  <div class="col-md-12 form-group">
                                    <x-jet-label> Lesson Overview</x-jet-label>
                                    <textarea name="lesson_overview" class="form-control" >{{$item->lesson_overview}}</textarea>
                                    @error('lesson_overview')
                                    <span class="text-danger">{{$message}}</span>  
                                    @enderror
                                    </div>
                                 
                      </div>
<p>
  <hr>
</p>

<x-jet-label> Lesson Content</x-jet-label>
<div class="form-row">
  
<div class="col-md-12 form-group">

<textarea name="lesson_content" class="form-control my-editor" style="min-height: 80vh;">{!! old('content', $item->lesson_content) !!}</textarea>
<script>
  var editor_config = {
    path_absolute : "/",
    selector: 'textarea.my-editor',
    relative_urls: false,
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table directionality",
      "emoticons template paste textpattern youtube"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    file_picker_callback : function(callback, value, meta) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
      if (meta.filetype == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.openUrl({
        url : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no",
        onMessage: (api, message) => {
          callback(message.content);
        }
      });
    }
  };

  tinymce.init(editor_config);
</script>
  
    </div>

 </div>
 <div class="col-md-12 form-group">
  <x-jet-label>Status</x-jet-label>
  <div class="form-group">
      <div class="form-check">
        <input class="form-check-input" type="radio" value="publish" name="status">
        <label class="form-check-label">Publish Now</label>
      </div>
    
      <div class="form-check">
        <input class="form-check-input" type="radio" value="draft" name="status" >
        <label class="form-check-label">Save as Draft</label>
      </div>
    </div>
  @error('status')
      <span class="text-danger">{{ $message }}</span>
  @enderror
</div>
                                
                </div>
                <!-- /.card-body -->
                
     
                <div class="card-footer">
               
                  <x-jet-button>Update Lesson</x-jet-button>
                </div>
            </form>
           
            </div>
      
      
        </div>

            
          </div>  

          @endforeach
    
</x-app-layout>

 