<x-app-layout>
    <x-slot name="header">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    
    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                    <h3 class="card-title">Add Assessement</h3>
                </div>

                <img class="card-img-top"
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_28_style_light_align_center:{{ Auth::user()->name }}'s Lesson Portal,w_0.4,y_0.18/v1613305894/pexels-photo-5905555_itigi3.jpg"
                    alt="">

                <div class="card-body">
                    <h3 class="lead"> Hi, {{ Auth::user()->name }}</h3>
                    <div class="text-muted">
                        <p class="card-text">
                            <span class="text-bold">Use this section to create an assessement <br>
                                {{-- <ul>
                                    <li>First select the class you want to create the lesson for.</li>
                                    <li>Secondly add the title of the lesson.</li>
                                    <li>Add the objectives of the lesson</li>
                                    <li>Add the summary of the lesson</li>
                                </ul> --}}


                        </p>

                    </div>

                </div>


                <!-- /.card-header -->
            </div>
            <hr>
            <!-- form start -->
            <form action="{{ route('online-learning.assessement_store') }}" method="post">
                <div class="card card-light  ">
                    <div class="card-body">



                        @csrf
                        <div class="form-row">

                            <div class="col-md-3 form-group">
                                <x-jet-label>Select Class</x-jet-label>
                                <select class="form-control" name="teaching_load" id="teaching_load">
                                    <option value="0">Select Class</option>
                                    @foreach($my_teaching_loads as $teaching_load_item)
                                        <option value="{{ $teaching_load_item->id }}">
                                            {{ $teaching_load_item->grade_name }} -
                                            {{ $teaching_load_item->subject_name }}</option>
                                    @endforeach
                                </select>
                                @error('teaching_load')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3 form-group sub_div" >
                                <x-jet-label>Select Subject</x-jet-label>
                                <select class="form-control" name="subject" id="subject">
                                    
                                </select>
                                @error('subject')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3 form-group">
                                <x-jet-label>Assessement Type</x-jet-label>
                                <select class="form-control" name="assessement_type" id="assessement_type">
                                    <option value="0">Select Assessement Type</option>
                                        @if(empty(\App\Models\AssessementType::all()))
                                        <a href="/settings/assessement">Add Assessement Type</a>
                                         @else
                                         @foreach (\App\Models\AssessementType::all() as $item)
                                 
                                         <option value="{{$item->id}}">{{ $item->assessement_type_name }}</option>
                                         @endforeach
                                         @endif
                                   
                                </select>
                                @error('question_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3 form-group">
                                <x-jet-label id="title">  Title</x-jet-label>
                                <x-jet-input name="assessement_title" required></x-jet-input>
                                @error('assessement_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-3 form-group">
                                <x-jet-label>Lesson Topic</x-jet-label>
                                <x-jet-input name="lesson_topic" required></x-jet-input>
                                @error('lesson_topic')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            


                            <div class="col-md-3 form-group">
                                <x-jet-label>Due Date</x-jet-label>
                                <x-jet-input name="assignment_due_date" id="assignment_due_date" type="datetime-local" required></x-jet-input>
                                @error('assignment_due_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3 form-group">
                                <x-jet-label>Timed </x-jet-label>
                                <select class="form-control" name="timed_status" id="timed_status">
                                    <option value="0">Select Timed Status</option>
                                    <option value="true">Timed</option>
                                    <option value="false">Infinite</option>
                                </select>
                                @error('timed_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                          

                            <input type="hidden" name="teacher_id" id="teacher_id" value="{{Auth::user()->id}}" >
          

                        </div>
                        <p>
                            <hr>
                        </p>



                        <!-- Button trigger modal -->

  


                        {{-- <x-jet-label> Lesson Content</x-jet-label>
                        <div class="form-row">

                            <div class="col-md-12 form-group">

                                <textarea name="content" class="form-control my-editor"
                                    style="min-height: 60vh;"></textarea>
                                @include('online-learning.js.tiny')

                            </div>

                        </div> --}}


                        {{-- <div class="col-md-4 form-group">
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
                        </div> --}}

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <x-jet-button><i class="fas fa-paper-plane"></i> Add</x-jet-button>
                    </div>
            </form>
        </div>
    </div>


    </div>


    </div>

    <script>
        $(document).ready(function () {
            var i = 1;
            $('#submit').hide();
            $(".sub_div").hide();
            $('#add_input').click(function () {
                i++;
                $("#dynamic").append('<p></p>  <div class="input-group" id="row' + i +
                    '"><input type="text" class="form-control" name="lesson_objectives[]" placeholder="Lesson Objective"><div class="input-group-append"><button class="btn btn-danger btn_remove" name="remove" id="' +
                    i +
                    '"  type="button"><i class="fas fa-times"></i></button></div></div></div> <p></p>'
                    );
                $('#submit').show();
            });




            $(document).on('click', '.btn_remove', function () {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

           
            $("#assessement_type").change(function () {
                var label=$(this).find('option:selected').text()+' '+'Title';
                $("#title").html(label);
            });

            $("#teaching_load").change(function () {
        var load = this.value;
        // var selectedSubject = {{json_decode($teaching_load_item->subject_name)}};
        var sub=$(this).find('option:selected').val();
        
      


if(sub!=="37"){
    $(".sub_div").hide();
    
  }else{
    $(".sub_div").show();

        if(load){
    $.ajax({
      type:"GET",
      url:"{{url('getSubject')}}?subject_id="+load,
      success:function(res){        
      if(res){
        $("#subject").empty();
     //   $("#subject").append('<option>'+res+'</option>');
        $.each(res,function(key,value){
          $("#subject").append('<option value="'+value+'">'+value+'</option>');
        });
      
      }else{
        $("#subject").empty();
      }
      }
    });
  
  } 
            }

    
    });



        });

    </script>

</x-app-layout>
