<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <img class="card-img-top"
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1687620219/shunifu_header_4_ve76m9.png"
                    alt="">
                <div class="card-body">
                    <h3 class="lead">Hi, {{ Auth::user()->name }}</h3>
                    <span class="text-muted"> Use this section to manage data for students in your class </span>

                <hr>
                <!-- form start -->
                <form action="{{ route('student.class_teacher_view') }}" method="post">
                
                        @csrf
                        <div class="form-row">
                            <div class="col form-group">
                                <x-jet-label> Class Name</x-jet-label>
                                <select class="form-control" name="grade_id">
                              
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->grade_name }}</option>

                                    @endforeach
                                </select>
                                @error('class')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col form-group">
                                <x-jet-label> Academic Year</x-jet-label>
                                <select class="form-control" name="academic_session">
                          
                                    @foreach($sessions as $session)
                               
                        <option value="{{ $session->id }}">{{ $session->academic_session }}</option>
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
                        <x-jet-button>Load Students</x-jet-button>
                    </div>
                </form>
            </div>


        </div>


    </div>

</x-app-layout>
