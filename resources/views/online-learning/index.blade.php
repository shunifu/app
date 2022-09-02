<x-app-layout>
    <x-slot name="header">
       

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
            <script src="https://cdn.tiny.cloud/1/anqtj7pm0x1m618dm8p3mh2lr2l0roao0o2z1kbht1928q4q/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

            <script src="https://cdn.jsdelivr.net/npm/@wiris/mathtype-tinymce5@7.24.6/plugin.min.js"></script>
    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                    <h3 class="card-title">Add Lesson</h3>
                </div>

                <img class="card-img-top"
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_28_style_light_align_center:{{ Auth::user()->name }}'s Lesson Portal,w_0.4,y_0.18/v1613305894/pexels-photo-5905555_itigi3.jpg"
                    alt="">

                <div class="card-body">
                    <h3 class="lead"> Hi, {{ Auth::user()->name }}</h3>
                    <div class="text-muted">
                        <p class="card-text">
                            <span class="text-bold">Use this section to add a lesson <br>
                                <ul>
                                    <li>First select the class you want to create the lesson for.</li>
                                    <li>Secondly add the title of the lesson.</li>
                                    <li>Add the objectives of the lesson</li>
                                    <li>Add the summary of the lesson</li>
                                </ul>


                        </p>

                    </div>

                </div>


                <!-- /.card-header -->
            </div>
            <hr>
            <!-- form start -->
            <form action="{{ route('online-learning.store') }}" method="post">
                <div class="card card-light  ">
                    <div class="card-body">


                        @csrf
                        <div class="form-row">

                            <div class="col-md-12 form-group">
                                <x-jet-label>Select Class</x-jet-label>
                                <select class="form-control" name="teaching_load">
                                    <option value="0">Select Class</option>
                                    @foreach($result_load as $teaching_load_item)
                                        <option value="{{ $teaching_load_item->teaching_load_id }}">
                                            {{ $teaching_load_item->grade_name }} -
                                            {{ $teaching_load_item->subject_name }}</option>
                                    @endforeach
                                </select>
                                @error('teaching_load')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <x-jet-label> Lesson Title</x-jet-label>
                                <x-jet-input name="lesson_title" required></x-jet-input>
                                @error('lesson_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-12 form-group">

                                <x-jet-label> Lesson Objectives</x-jet-label><br>
<small>By the end of the lesson, students should be able to:</small>
                                <div class="col-md-8" id="dynamic">
                                    <div class="input-group"><input type="text" class="form-control"
                                            name="lesson_objectives[]" placeholder="Lesson Objective">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-success" name="add"
                                                id="add_input" type="button"><i class="fas fa-plus-circle"></i></button>
                                        </div>
                                    </div>
                                </div>

                                @error('lesson_objectives')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <x-jet-label> Lesson Overview</x-jet-label>
                                <textarea name="lesson_overview" class="form-control" required></textarea>
                                @error('lesson_overview')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                        </div>
                        <p>
                            <hr>
                        </p>

                        <x-jet-label> Lesson Content</x-jet-label>
                        <div class="form-row">

                            <div class="col-md-12 form-group">

                                <textarea name="content" class="form-control my-editor"
                                    style="min-height: 60vh;"></textarea>
                                @include('online-learning.js.tiny')

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
                        <x-jet-button><i class="fas fa-paper-plane"></i> Add Lesson</x-jet-button>
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



        });

    </script>

</x-app-layout>
