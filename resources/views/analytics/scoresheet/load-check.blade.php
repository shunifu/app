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

        </style>
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

        {{-- <!-- Include fusioncharts core library -->
        <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
        <!-- Include fusion theme -->
        <script type="text/javascript"
            src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script> --}}

            <link rel="stylesheet" type="text/css"
href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/r-2.2.7/datatables.min.css" />
    


    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-12">

{{-- <div class="card text-left">
 
  <div class="card-body">
    <h4 class="card-title">Subject Analysis</h4>
    <p class="card-text">{{$assessement_data->assessement_name}}, {{$assessement_data->subject_name}}</p>
  </div>
</div> --}}


<a href="javascript:history.back()" class="btn btn-success">Back To Ratio Checker</a>
<p></p>

            <h2 class="lead text-muted">{{$grades->lastname}} {{$grades->name}} {{$grades->grade_name}}</h2>

            

            
            <div class="mb-4">

            </div>



            <div class="mt-10 mb-25">
                <hr>

            </div>
            <section>
                <div class="card text-left">

                    <div class="card-body">
                        <div class="pb-3 ">

                            {{-- <h2 class="card-title"> Analysis for <span class="text-bold">{{ $subject }},
                            {{ $name_of_assessement }}</span> </h2> --}}
                        </div>
                        <p class="card-text pt-3">

                            {{-- <ul>
{}

                                <li>Out of the {{ $total }}</span> who sat for the assessement, a total of
                                    <span class="text-bold text-success">{{ $total_passed }} </span> students got an
                                    average
                                    equal or above the passing mark.</span></li>

                                <li>Out of the {{ $total }}</span> who sat for the assessement, a total of
                                    <span class="text-bold text-success">{{ $total_failed }} </span> students got an
                                    average
                                    that is less than the passing mark.</span></li>

                            </ul> --}}

                    </div>

                </div>

                {{-- 
<div class="row">
  <div class="card col-md-6">
       
    <div class="card-body">
     
      <p class="card-text">
        <div id="chart-container">FusionCharts XT will load here!</div>
      </p>
    </div>
  </div>
  <div class="card col-md-6">
       
    <div class="card-body">
     
      <p class="card-text">
        <div id="chart-container2">FusionCharts XT will load here!</div>
      </p>
    </div>
  </div>
</div> --}}



                <div class="card">

                    <div class="card-body">



                        <div class="row">

                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <h4 class="card-title text-bold  pb-3  ">Teaching Loads</h4>
                                    <table class="table table-sm table-hover mx-auto table-bordered" id="students">

                                        <thead class="thead-light ">
                                            <td>No.</td>
                                            <td>Subject</td>
                                            <th>Teacher</th>
                                        </thead>
                                        <tbody>


                @forelse($loads as $load)
                <tr>
                <td>{{$loop->iteration}}</td>
                <td class="align-middle p-2"> {{ $load->subject_name }}</td>
                <td class="align-middle p-2"> {{ $load->salutation }} {{ $load->name }} {{ $load->lastname }}</td>
        
                </tr>
                                            @empty
                                                No Analytics
                                            @endforelse

                                        </tbody>


                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6">
      
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
