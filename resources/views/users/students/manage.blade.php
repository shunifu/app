<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                    <h3 class="card-title">Students Management</h3>
                </div>

                <img class="card-img-top"
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_220,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:Students Management,w_0.3,y_0.28/v1613303961/pexels-photo-5212359_ukdzdz.jpg"
                    alt="">
                <div class="card-body">
                    <h3 class="lead">Hi, {{ Auth::user()->name }}</h3>
                    <div class="text-muted">
                        <p class="card-text"> Please select the stream you want to view students from. If you want to view or see former students, select the last option.  <br>

                        </p>

                    </div>

                </div>



                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('students.management')}}" method="post">
                    <div class="card-body">
                        @csrf
                        <div class="form-row">
                            <div class="col-md form-group">
                                <x-jet-label> Stream Name</x-jet-label>
                                <select class="form-control" name="stream">
                                    <option value="">Select Stream</option>
                                    @foreach($streams as $stream)
                                        <option value="{{ $stream->id }}">{{ $stream->stream_name }}</option>

                                    @endforeach
                                    <option value="former_students">Former Students</option>
                                </select>
                                @error('class')
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
