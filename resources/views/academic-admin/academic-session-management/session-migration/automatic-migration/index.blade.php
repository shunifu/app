<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Automatic Student Migration </h3>
      </div>

        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1709014911/fsuj0wj9ywaffqgugwqv.png">
        <div class="card-body">
          <h4 class="lead">Automatic  Migration</h4>

          <hr>
         <div class="text-muted">
          Hi, <span class="text-bold">{{Auth::user()->salutation}} {{Auth::user()->lastname}}</span>. Welcome to the  automatic student migration pathway.  This is where you will migrate students from  one academic year to another academic year, based on the student(s) academic performance and sequence maps . In order to migrate the students successfully, you need to first ensure that the following has been done properly. <p></p>

          @include('partials.migration-checklist')

         </div>
         To go back to the migration home page click <a href="/migration">here</a>

        </div>
    </div>
    <div class="row">
        <div class="col">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Automatic Migration Pathway</h3>
              </div>


              <div class="card-body">

                             <!-- form start -->
                             <form action="/migration/process" method="post">
                                <div class="card-body">
                                    @csrf


                                    <div class="form-row">

                                        <input type="hidden"  value="automatic" name="migration_type" id="migration_type" >


                                        <div class="col-md-4  form-group">
                                            <x-jet-label> Class Name</x-jet-label>
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

                                        <div class="col-md-4 form-group">
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
                                        <div class="col-md-4  form-group">
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

