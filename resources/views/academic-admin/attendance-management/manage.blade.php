<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                    <h3 class="card-title">Manage Attendance Data</h3>
                </div>

                <img class="card-img-top"
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_220,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:Manage Attendance Data,w_0.3,y_0.28/v1613303961/pexels-photo-5212359_ukdzdz.jpg"
                    alt="">
                <div class="card-body">
                    <h3 class="lead">Hi, {{ Auth::user()->name }}</h3>
                    <div class="text-muted">
                        <p class="card-text"> Use this section to manage the attendance data of your class. <br>
                            <span class="text-italic"></span> 

                        </p>

                    </div>

                </div>



                <!-- /.card-header -->
                <!-- form start -->
                <form action="/attendance/manage/view" method="post">
                    <div class="card-body">
                        @csrf
                        <div class="form-row">
                            <div class="col form-group">
                                <x-jet-label> Select Date</x-jet-label>
                                <input type="date" class="form-control" name="date" id="date">
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                       

                          <input type="hidden" name="teacher_id" value="{{Auth::user()->id}}">
                       
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <x-jet-button>Load Attendance Data</x-jet-button>
                    </div>
                </form>
            </div>


        </div>


    </div>

</x-app-layout>
