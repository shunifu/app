<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                  
                </div>

                <img class="card-img-top"
                src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1673693197/Manage_Teachers_5_ubwtrg.png"
                    alt="">
                <div class="card-body">
                    <h3 class="lead">Hi, {{ Auth::user()->name }}</h3>
                    <div class="text-muted">
                        <p class="card-text"> Use this section to tell <span class="text-bold">Shunifu</span>, which subjects you teach and in which classes you teach those subjects.
                            <span class="text-italic">You will do it one class at a time.</span> 

                        </p>

                    </div>

                </div>



                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('teacher.loadstudents') }}" method="post">
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
                                <x-jet-label>Subject Name</x-jet-label>
                                <select class="form-control" name="subject_id">
                                    <option value="">Select Subject</option>
                                    @foreach($subjects as $subject_item)
                                        <option value="{{ $subject_item->id }}">{{ $subject_item->subject_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <x-jet-label> Academic Year</x-jet-label>
                                <select class="form-control" name="academic_session">
                            <option value="">Select Academic Year</option>
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
