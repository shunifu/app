<x-app-layout>
    <x-slot name="header">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    </x-slot>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                    <h3 class="card-title">  <a href="/online-learning/assessement/create/without-lesson/" ><x-jet-button><i class="fas fa-arrow-circle-left"></i> Back</x-jet-button></a> Edit Assessement</h3>
                </div>

                <img class="card-img-top"
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_287,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_32_style_light_align_center:Edit Assessement,w_0.3,y_0.13/v1637781316/pexels-photo-3825462_om73ik.jpg">

                <div class="card-body">
                    <p class="card-text"> Sawubona, {{ Auth::user()->name }} {{ Auth::user()->lastname }} </p>
                    <div class="text-muted">
                        <p class="card-text">
                            This section is where you will edit the assessement.

                        </p>
                      
                    </div>

                </div>

            </div>  <!-- /.end of card -->
        </div> <!-- /.end of col-md-12 -->
       
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-body">
                    <!-- form start -->
                    <form action="/online-learning/assessements/update" method="post">
                        @csrf

                    <div class="form-row">
                        <div class="col-md-3 form-group">
                            <x-jet-label>Select Class</x-jet-label>
                            <select class="form-control" name="teaching_load" id="teaching_load">

                                <option value="{{ $assessement_details->teaching_load_id }}">
                                    {{ $assessement_details->grade_name }} -{{ $assessement_details->subject_name }}
                                </option>


                                @foreach($my_teaching_loads as $teaching_load_item)
                                    <option value="{{ $teaching_load_item->id }}">
                                        {{ $teaching_load_item->grade_name }}
                                        -{{ $teaching_load_item->subject_name }}</option>
                                @endforeach
                            </select>
                            @error('teaching_load')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3 form-group sub_div">
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


                                <option value="{{ $assessement_details->assessement_type_id }}">
                                    {{ $assessement_details->assessement_type_name }}</option>
                            </select>
                            @error('assessement_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 form-group">
                            <x-jet-label id="title"> Title</x-jet-label>
                            <x-jet-input name="assessement_title"
                                value="{{ $assessement_details->assessement_title }}"> </x-jet-input>
                            @error('assessement_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-md-3 form-group">
                            <x-jet-label>Lesson Topic</x-jet-label>
                            <x-jet-input name="lesson_topic" value="{{ $assessement_details->lesson_topic }}"
                                required></x-jet-input>
                            @error('lesson_topic')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 form-group">
                            <x-jet-label>Due Date</x-jet-label>
                            <x-jet-input name="assignment_due_date" value="{{ $assessement_details->due_date }}"
                                id="assignment_due_date" type="datetime" required></x-jet-input>
                            @error('assignment_due_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <div class="col-md-3 form-group">
                            <x-jet-label>Timed </x-jet-label>
                            <select class="form-control" name="timed_status" id="timed_status">
                                <option value="0">Select Timed Status</option>
                                <option value="true">Timed</option>
                                <option value="false">Infinite</option>
                            </select>
@error('timed_status')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    <input type="hidden" name="teacher_id" id="teacher_id" value="{{ Auth::user()->id }}"/>
                    <input type="hidden" name="id" id="id" value="{{$assessement_details->id}}"/>


                </div>

                <div class="card-footer">
                    <x-jet-button><i class="fas fa-paper-plane"></i> Edit Assessement</x-jet-button> 
                   
                </div>
            </form><!-- /.end of form -->
           
            </div> <!-- /.card-body -->


            </div><!-- /.end of card -->
        
        </div><!-- /.end of col -->
    </div><!-- /.end of row -->
    </div> <!-- /.end of container -->







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
