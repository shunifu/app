<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                  
                </div>

                <img class="card-img-top"
                src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1689527001/ircmjalujakjo1i1bjy4.png"
                    alt="">
                <div class="card-body">
                    <h3 class="lead">Hi, {{ Auth::user()->name }}</h3>
                    <div class="text-muted">
                        <p class="card-text"> Use this section to add <span class="text-bold">strands</span>, on Shunifu.</span> 

                        </p>

                    </div>

                </div>



                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('strands.show') }}" method="post">
                    <div class="card-body">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-4 form-group">
                                <x-jet-label> Stream Name</x-jet-label>
                                <select class="form-control" name="stream_id">
                                    <option value="">Select Stream</option>
                                    @foreach($streams as $stream)
                                        <option value="{{ $stream->id }}">{{ $stream->stream_name }}</option>

                                    @endforeach
                                </select>
                                @error('stream_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <x-jet-label>Subject Name</x-jet-label>
                                <select class="form-control" name="subject_id">
                                    <option value="">Select Subject</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->subject_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <x-jet-label> Term Name</x-jet-label>
                                <select class="form-control" name="term_id">
                            <option value="">Select Term Name</option>
                                    @foreach($terms as $term)
                               
                        <option value="{{ $term->term_id }}">{{ $term->term_name }}</option>
                                    @endforeach
                                </select>
                                @error('term_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            


                        </div>



                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <x-jet-button>View Strands</x-jet-button>
                    </div>
                </form>
            </div>


        </div>


    </div>

 

</x-app-layout>
