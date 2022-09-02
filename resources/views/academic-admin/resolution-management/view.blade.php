<x-app-layout>
    <x-slot name="header">
        <style>
            .profile-head {
                transform: translateY(5rem)
            }

            .cover {
                background-image: url(https://res.cloudinary.com/innovazaniacloud/image/upload/v1613303961/pexels-photo-5212359_ukdzdz.jpg);
                background-size: cover;
                background-repeat: no-repeat
            }

            p {
	display: inline;
	line-height: 2;
}

input, input-group {
	display: block;
	width: 100%;
	margin-bottom: .5rem;
}

select {
	display: block;
	width: 100%;
    padding:10px;
	margin-bottom: .5rem;
}

.inline {
	display: inline;
	width: auto;
	max-width: 5rem;
}

        </style>
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="lead text-muted">Promotions Management</h2>
            <hr>
            <div class="mb-4">
                <h4>{{$grade_name}}</h4>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <!-- Info boxes -->
                    <div class="row">
                        <div class="col">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total Students</span>
                                    <span class="info-box-number">
                                        {{ $total }}

                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <div class="col">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Class Average</span>
                                    <span class="info-box-number">
                                        {{ $class_average }}%

                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <div class="col">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i>
                                    </i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Passed Students</span>
                                    <span class="info-box-number">{{ $total_passed }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>

                        <div class="col">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i
                                        class="fas fa-check-circle text-white"></i> </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Failed Students</span>

                                    <span class="info-box-number">{{$total_failed}}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><i
                                        class="fas fa-percentage text-white"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text"> Promoted</span>
                                    <span class="info-box-number">{{round($class_pass_rate)}}<small>%</small></span>

                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning text-white elevation-1"><i
                                        class="fas fa-percentage text-white"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Failure Rate</span>
                                    <span class="info-box-number">{{round($class_fail_rate)}}<small>%</small></span>

                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <div class="col">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning text-white elevation-1"><i
                                        class="fas fa-percentage text-white"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Pass Rate</span>
                                    <span class="info-box-number">{{round($class_fail_rate)}}<small>%</small></span>

                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->





                </div>
                <!--/. container-fluid -->
            </section>


            <div class="mt-10 mb-25">
                <hr>

            </div>
            <section>
                <div class="card text-left">

                    <div class="card-body">
                       
                        <p class="card-text pt-3">
<form action="/promotions/processing" method="POST" name="promotions_form">
    @csrf
<input type="hidden" value="{{$grade_id}}" name="grade_id">
<input type="hidden" value="{{$term_id}}" name="term_id">
<input type="hidden" value="{{$number_of_subjects}}" name="number_of_subjects">
<input type="hidden" value="{{$passing_rate}}" name="passing_rate">
   Student should have an average of at least <input type="text" name="term_average" id="term_average" class="form-control inline" placeholder="%"> and pass at least the following number of subjects <input type="text" class="form-control inline" name="number_of_subjects" id="number_of_subjects"> at <input type="text" name="subject_average" id="subject_average" class="form-control inline" placeholder="%"> <p></p> <select class="form-control inline " name="passing_subject_criteria" id="passing_subject_criteria">
        <option>Select Option</option>
        <option value="including">Including Passing Subject </option>
        <option value="excluding">Excluding Passing Subject</option>
      </select>

    
      
      <p>

      </p>
      <div class="form-group">
        <label for=""></label>
        <button type="submit"  class="btn btn-primary" >Proccess Promotion</button>

      </div>
     
</form>
                          
                            
                           
                           
                        </p>

                    </div>

                </div>


                <div class="card">

                    <div class="card-body">



                        <div class="row">

                            <div class="col-12">
                                <div class="table-responsive">
                                    <h4 class="card-title text-bold  pb-3  ">Class Information</h4>                                   
                                    <table class="table table-sm table-hover mx-auto">

                                        <thead class="thead-light hidden-md-up">
                                            <td>Position</td>
                                            <th>Student Name</th>
                                            <th>Student Average</th>
                                            <th>Status</th>
                                            <th>Passing Subject</th>
                                            <th>Number of Passed Subject</th>
                                          <th>Manage</th>
                                        </thead>
                                        <tbody>


                @forelse($students as $student)
                <tr>
    <td>{{$loop->iteration}}</td>
    <td class="align-middle p-2">{{ $student->lastname }} {{ $student->name }}</td>
    <td class="align-middle">{{ $student->student_average }}%</td>
    <td class="align-middle p-2">
    @if ($student->student_average>=$passing_rate AND $student->number_of_passed_subjects>=$number_of_subjects AND $student->passing_subject_status==1)
    <span class="text-success">Passed</span>
    @else
        <span class="text-danger">Failed</span>
    @endif
    </td>
    <td class="align-middle p-2">
        @if ( $student->passing_subject_status==1)
           Passed 
           @else
           Failed 
        @endif
        
    </td>

    <td class="align-middle p-2">

        @if ($student->number_of_passed_subjects<$number_of_subjects)
            <span class="text-danger"> {{$student->number_of_passed_subjects}}</span>
        @else
        {{$student->number_of_passed_subjects}}
        @endif
      
          
    </td>

    <td class="align-middle p-2"> 
        Upgrade
    </td>

                </tr>
                                            @empty
                                                No Analytics
                                            @endforelse

                                        </tbody>


                                    </table>
                                </div>
                            </div>

                           
                        </div>
                    </div>
                </div>
        </div>
    </div>


    </p>

    </div>
    </section>




    <!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-md-12 bg-white">


        <!-- /.card -->
    </section>
    <!-- right col -->


    </div>
    </div>
  

 

</x-app-layout>
