<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                    <h3 class="card-title">Promotions Management</h3>
                </div>

                <img class="card-img-top"
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_320,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:Progression Management,w_0.3,y_0.28/v1613303961/pexels-photo-5212359_ukdzdz.jpg"
                    alt="">
                <div class="card-body">
                    <h3 class="lead">Hi, {{ Auth::user()->name }}</h3>
                    <div class="text-muted">
                        <p class="card-text"> Use this section to manage student promotions <br>

                        </p>

                    </div>

                </div>


                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('progression.store') }}" method="post">
                    <div class="card-body">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-4 form-group">
                                <x-jet-label> Class Name</x-jet-label>
                                <select class="form-control" name="grade_id">
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->grade_name }}</option>

                                    @endforeach
                                </select>
                                @error('class')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <x-jet-label>Students</x-jet-label>
                                <select class="form-control" name="student_type">
                                    <option value="">Select Students</option>
                                    <option value="2">All Students</option>
                                    <option value="1">Passed Students</option>
                                    <option value="0">Failed Students</option>
                                </select>
                                @error('subject_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <x-jet-label> Academic Year</x-jet-label>
                                <select class="form-control" name="academic_session">
                                    <option value="">Select Academic Year</option>
                                    @foreach($session as $session_item)
                                        <option value="{{ $session_item->term_id }}">
                                            {{ $session_item->term_name }}-{{ $session_item->academic_session }}</option>
                                    @endforeach
                                </select>
                                @error('academic_session')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <x-jet-button>Load Data</x-jet-button>
                    </div>
                </form>
            </div>


        </div>


    </div>
    <script>
        
    </script>

</x-app-layout>
