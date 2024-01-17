<x-app-layout>
    <x-slot name="header">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Student Registration Portal</h3>
      </div>

        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_32_style_light_align_center:Single-Student%20Registration Form,w_0.4,y_0.18/v1650135733/pexels-rodnae-productions-10375992_1_shjypq.jpg">
        <div class="card-body">
          <h4 class="lead">Student Registration Portal</h4>

          <hr>
         <div class="text-muted">
          Hi, <span class="text-bold">{{Auth::user()->salutation}} {{Auth::user()->lastname}}</span>. Welcome to the  bulk-student registration pathway. This is where you add multiple students at a time. Below is a form where you will add the needed student details. <br>
          To go back click <a href="/users/student">here</a>
         </div>

        </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Bulk Registration Pathway</h3>
      </div>
    <div class="card-body">
      <div class="row">




                             <!-- form start -->
              <form action="{{route('pathway.bulk_store')}}" method="post">

                      @csrf
<div class="row">

    <div class="col" >

        <div class="form-group">
            <label> Student Class <span style="color: red">*</span></label>
            <select class="form-control" name="student_class[]">
            <option value=""> Select Class</option>

            @foreach ($classes as $class)
            <option value="{{$class->id}}">{{$class->grade_name}}</option>
            @endforeach

            </select>
            @error('student_class')
            <span class="text-danger">{{$message}}</span>
            @enderror
           </div>
    </div>

    <div class="col" >

     <div class="pb-4 mb-2"></div>

<button class="btn btn-success"  type="button" id="add_more"> <i class="fa fa-plus-circle"></i> Add More Student Rows</button>

    </div>


</div>
<hr>
                      <div class="form-row" id="master-div">



                        <div class="col-12 col-sm-6 col-md-auto">
                          <div class="form-group">
                        <label> Name</label>
    <x-jet-input name="first_name[]" required value="{{ old('first_name') }}" placeholder="First Name" ></x-jet-input>
                        @error('first_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                       </div>

                        </div>


                        <div class="col-12 col-sm-6 col-md-auto">
                          <div class="form-group">
                        <label>Middle Name</label>
                        <x-jet-input name="middle_name[]" value="{{ old('middle_name') }}" placeholder="Middle Name" ></x-jet-input>
                        @error('middle_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                       </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-auto">
                          <div class="form-group">
                        <label>Last Name</label>
                        <x-jet-input name="last_name[]" required value="{{ old('last_name') }}" placeholder="Last Name" ></x-jet-input>
                        @error('last_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div>
                        </div>



                            <div class="col-12 col-sm-6 col-md-auto">
                                <label> Status <span style="color: red">*</span></label></label>
                                <select class="form-control" name="student_status[]">
                                <option value=""> Status</option>
                                <option value="ovc">OVC</option>
                                <option value="non_ovc">NON-OVC</option>
                                </select>
                                @error('student_status')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                               </div>

                               <div class="col-12 col-sm-6 col-md-auto">
                                <label> Gender <span style="color: red">*</span></label></label>
                                <select class="form-control" name="student_gender[]">
                                <option value=""> Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                </select>
                                @error('student_gender')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                               </div>


                               <div class="col-12 col-sm-6 col-md-auto">
                                <label> Sponsor <span style="color: red">*</span></label></label>
                                <select class="form-control" name="student_sponsor[]">
                                <option value=""> Sponsor</option>
                                @foreach ($sponsors as $sponsor)

                                <option value="{{$sponsor->id}}"> {{$sponsor->sponsor_name}}</option>
                                @endforeach

                                </select>
                                @error('student_sponsor')
                                <span class="text-danger">{{$message}}</span>
                                @enderror



                               </div>

                               <div class="col-12 col-sm-6 col-md-auto">
                                <label class="pb-3" for=""></label>

                                <div class="remove-btn">
<button class="btn btn-danger btn_remove" id="remove" name="remove" type="button"><i class="fas fa-times"></i>  </button>
                                </div>



                               </div>

















</div>



              <!-- /.end of form row -->

                  <div  id="slave-div">

                  </div>

              <div class="card-footer">
                <x-jet-button>Register Student</x-jet-button>
              </div>
            </form>


              </div>
              {{-- end of row --}}

            </div>
{{-- end of card  body--}}





          </div>
        {{-- end of card --}}

        <script>
          $(document).ready(function () {


              $('#add_more').click(function (e) {


                $('#master-div').clone().find("label").text("").end().appendTo('#slave-div');
                // <div class="d-flex  btn btn-link" id="remove-div" type="button" ></div>
              });


              $(document).on('click', '#remove', function (e) {

              });



            //   <button class="btn-danger btn_remove" name="remove" id="' +i+ '"  type="button">



          });

      </script>

</x-app-layout>


