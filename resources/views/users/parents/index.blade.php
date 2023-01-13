<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                    <h3 class="card-title">Add Parents</h3>
                </div>

                <img class="card-img-top"
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_350,w_970/b_rgb:000000,e_gradient_fade,y_-0.80/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_32_style_light_align_center:Manage Parents,w_0.2,y_0.30/v1616512061/pexels-photo-4260475_alskcw.jpg"
                    alt="">

                <div class="card-body">
                    <h3 class="lead"> Hi, {{ Auth::user()->name }}</h3>
                    <div class="text-muted">
                        <p class="card-text">
                            <span class="text-bold">Use this section add parents</span><br>
                            You can use either the form or if you have a spreadsheet you can upload the spreadsheet.

                        </p>

                    </div>

                </div>


                <!-- /.card-header -->
            </div>
        </div>


        <div class="col-md-9">
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Add Teacher</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('parents.store') }}" method="post">
                    <div class="card-body">
                        @csrf
                        <div class="form-row">

                            <div class="col-md-3 form-group">
                                <x-jet-label>Salutation</x-jet-label>
                                <select class="form-control" name="salutation">
                                    <option>Select Salutation</option>
                                    <option value="Mr.">Mr.</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Miss.">Miss.</option>
                                </select>
                                @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3 form-group">
                                <x-jet-label>First Name</x-jet-label>
                                <x-jet-input name="first_name" value="{{old('first_name')}}" required placeholder="First Name"></x-jet-input>
                                @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3  form-group">
                                <x-jet-label>Middle Name <small>optional</small></x-jet-label>
                                <x-jet-input name="middle_name" required value="{{old('middle_name')}}" placeholder="Middle Name"></x-jet-input>
                                @error('middle_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3 form-group">
                                <x-jet-label>Last Name</x-jet-label>
                                <x-jet-input name="last_name" value="{{old('last_name')}}"  required placeholder="Last Name"></x-jet-input>
                                @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>




                            <!--contacts--->
                            <div class="col-md-6 form-group">
                                <x-jet-label>Parent Cell Number</x-jet-label>
                                <x-jet-input name="cell_number"  value="{{old('cell_number')}}"  type="number" placeholder="Cellphone Number">
                                </x-jet-input>
                                @error('cell_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <x-jet-label>Parent Email Address <small>optional</small></x-jet-label>
                                <x-jet-input name="email_address" value="{{old('email_address')}}"  type="email" placeholder="Email Address">
                                </x-jet-input>
                                @error('email_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <hr>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <x-jet-button>Add Parent</x-jet-button>
                    </div>
                </form>
            </div>


        </div>

        <div class="col-md-3">
            <div class="card card-light">

                <div class="card-header">
                    <h3 class="card-title">Upload Spreadsheet</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('parents.import') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="import">
                        <p></p>
                        <x-jet-button>Upload Spreadsheet</x-jet-button>
                    </form>
                </div>

            </div>

        </div>

    </div>

</x-app-layout>
