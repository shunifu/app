<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Custom Student Migration </h3>
      </div>

        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_32_style_light_align_center:Custom Migration Pathway,w_0.4,y_0.18/v1650135733/pexels-rodnae-productions-10375992_1_shjypq.jpg">
        <div class="card-body">
          <h4 class="lead">Custom  Migration</h4>

          <hr>
         <div class="text-muted">
          Hi, <span class="text-bold">{{Auth::user()->salutation}} {{Auth::user()->lastname}}</span>. Welcome to the  custom student migration pathway.  This is where you will migrate students from  one academic year to another academic year, without sequence mapping. In order to migrate the students successfully, you need to first ensure that the following has been done properly. <p></p>

          @include('partials.migration-checklist')

         </div>
         To go back to the migration home page click <a href="/migration">here</a>

        </div>
    </div>
    <div class="row">
        <div class="col">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Custom Migration Pathway</h3>
              </div>


              <div class="card-body">

                             <!-- form start -->
                             <form action="/migration/process" method="post">
                                <div class="card-body">
                                    @csrf
                                    <div class="form-row">

                                        <input type="hidden"  value="custom" name="migration_type" id="migration_type" >


                                        <div class="col-md-3  form-group">
                                            <x-jet-label> Origin Class </x-jet-label>
                                            <select class="form-control" name="class_id" id="class_id">
                                                <option value="">Select Class</option>
                                                @foreach ($grades as $class)

                                                <option value="{{$class->id}}">{{$class->grade_name}}</option>

                                                @endforeach
                                            </select>
                                            @error('class_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3  form-group">
                                            <x-jet-label> Destination Class </x-jet-label>
                                            <select class="form-control" name="destination_class" id="destination_class">
                                                <option value="">Select Class</option>
                                                @foreach ($grades as $class)

                                                <option value="{{$class->id}}">{{$class->grade_name}}</option>

                                                @endforeach
                                            </select>
                                            @error('class_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <x-jet-label>From Year</x-jet-label>
                                            <select class="form-control" name="from_academic_session" id="from_academic_session">
                                                <option value="">Select From Academic Year</option>
                                                @foreach($from as $from_academic_year)
                <option value="{{ $from_academic_year->id }}">{{ $from_academic_year->academic_session }}</option>
                                                @endforeach
                                            </select>
                                            @error('from_academic_year')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3  form-group">
                                            <x-jet-label>To Year</x-jet-label>
                                            <select class="form-control" name="to_academic_session" id="to_academic_session">
                                                <option value="">Select New Academic Year</option>
                                                @foreach($to as $to_academic_year)
                <option value="{{$to_academic_year->id }}">{{$to_academic_year->academic_session }}</option>
                                                @endforeach
                                            </select>
                                            @error('to_academic_year')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <x-jet-button id="submit">Next</x-jet-button>
                                </div>
                            </form>

              </div>

            </div>


        </div>





          </div>



</x-app-layout>

