<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light">
                <div class="card-header card-light">
                    <h3 class="card-title">View Assessement</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                @foreach($assessement as  $item)
                    <div class="card  ">
                        <img class="card-img-top"
                            src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_280,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_25_style_light_align_center:{{ Auth::user()->name }}'s Assesement Portal,w_0.5,y_0.18/v1613303961/pexels-photo-5212359_ukdzdz.jpg"
                            alt="">

                        <div class="card-body">
                            <h3 class="lead">Hi, {{ Auth::user()->name }}</h3>
                            <div class="text-muted">
                                <p class="card-text">

                                    <span class="text-bold">Subject:</span> {{ $item->subject_name }} <br>
                                    <span class="text-bold">Lesson:</span> {{ $item->lesson_title }} <br>
                                    <span class="text-bold">Class:</span> {{ $item->grade_name }} <br>
                                    <span class="text-bold">Assesement Date:</span> {{ $item->due_date }} <br>

                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="card-body">

                        <x-jet-label> Assessement Content</x-jet-label>
                        <div class="form-row">

                            <div class="col-md-12 form-group border p-3">

                                {!! $item->content !!}


                            </div>


                            <x-jet-label> Student Response</x-jet-label>
                            <div class="col-md-12 form-group border p-3">
                                {{ $view_student_assessement['response'] }}
                            </div>
                            <x-jet-label>Your Response</x-jet-label>


                            <div class="col-md-12 form-group ">

                                @if(empty($assessement_result['mark']))
                                    <form action="{{ route('online-learning.save_student_result') }}"
                                        method="post">
                                        @csrf
                                        <x-jet-label>Enter Mark</x-jet-label>

                                        <x-jet-input name="mark" required type="number"
                                            placeholder="Enter Student Mark"></x-jet-input>
                                        <p>
                                            <input type="hidden" name="teacher_id" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="assessement_id" value="{{ $item->id }}">
                                            <input type="hidden" name="student_id"
                                                value="{{ $view_student_assessement['student_id'] }}">
                                        </p>
                                        <x-jet-label>Enter Comment</x-jet-label>
                                        <textarea name="comment" class="form-control" id="" cols="30"
                                            rows="10"></textarea>
                                        <div class="card-footer">
                                            <x-jet-button>Add Result</x-jet-button>
                                        </div>
                                    </form>

                                @else

                                    <form action="{{ route('online-learning.edit_student_result') }}"
                                        method="post">
                                        @csrf
                                        <x-jet-label>Enter Mark</x-jet-label>
                                  
                                        <x-jet-input name="mark" required type="number"
                                            value="{{ $assessement_result['mark'] }}"
                                            placeholder="Enter Student Mark"></x-jet-input>


                                        <p>
                                            <input type="hidden" name="teacher_id" value="{{ Auth::user()->id }}">
                                            <input type="hidden" name="assessement_id" value="{{ $item->id }}">
                                            <input type="hidden" name="student_id"
                                                value="{{ $view_student_assessement['student_id'] }}">
                                                <input type="hidden" name="result_id" value="{{$assessement_result['id']}}"/>
                                        </p>
                                        <x-jet-label>Enter Comment</x-jet-label>

                                        <textarea name="comment" class="form-control" id="" cols="30"
                                            rows="10">{{ $assessement_result['comment'] }}</textarea>

                                        <div class="card-footer">
                                            <x-jet-button>Update Result</x-jet-button>
                                        </div>
                                    </form>
                                @endif








                            </div>


                        </div>
                        <!-- /.card-body -->


                @endforeach

            </div>


        </div>


    </div>

</x-app-layout>
