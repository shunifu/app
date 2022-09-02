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

        <!-- Include fusioncharts core library -->
        <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
        <!-- Include fusion theme -->
        <script type="text/javascript"
            src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>


    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-12">

{{-- <div class="card text-left">
 
  <div class="card-body">
    <h4 class="card-title">Subject Analysis</h4>
    <p class="card-text">{{$assessement_data->assessement_name}}, {{$assessement_data->subject_name}}</p>
  </div>
</div> --}}
            <h2 class="lead text-muted">{{$assessement_data->assessement_name}}, {{$assessement_data->subject_name}} Analysis</h2>


            <hr>
            <div class="mb-4">

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

                                    <span class="info-box-number">{{ $total_failed }}</span>
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
                                    <span class="info-box-text"> Pass Rate</span>
                                    <span class="info-box-number">{{ $subject_pass_rate }}<small>%</small></span>

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
                                    <span class="info-box-number">{{ $subject_fail_rate }}<small>%</small></span>

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
                        <div class="pb-3 ">

                            {{-- <h2 class="card-title"> Analysis for <span class="text-bold">{{ $subject }},
                            {{ $name_of_assessement }}</span> </h2> --}}
                        </div>
                        <p class="card-text pt-3">

                            <ul>


                                <li>Out of the {{ $total }}</span> who sat for the assessement, a total of
                                    <span class="text-bold text-success">{{ $total_passed }} </span> students got an
                                    average
                                    equal or above the passing mark.</span></li>

                                <li>Out of the {{ $total }}</span> who sat for the assessement, a total of
                                    <span class="text-bold text-success">{{ $total_failed }} </span> students got an
                                    average
                                    that is less than the passing mark.</span></li>

                            </ul>

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

                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <h4 class="card-title text-bold  pb-3  ">Those who passed</h4>
                                    <table class="table table-sm table-hover mx-auto">

                                        <thead class="thead-light hidden-md-up">
                                            <td>No.</td>
                                            <th>Student Name</th>
                                            <th>Mark</th>
                                        </thead>
                                        <tbody>


                                            @forelse($passed as $student)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td class="align-middle p-2">
                                                        {{ $student->lastname }} {{ $student->name }}</td>
                                                    <td class="align-middle">{{ $student->mark }}%</td>
                                                </tr>
                                            @empty
                                                No Analytics
                                            @endforelse

                                        </tbody>


                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <h4 class="card-title text-bold  pb-3 ">Those who failed</h4>
                                    <table class="table table-sm table-hover mx-auto">

                                        <thead class="thead-light hidden-md-up">
                                            <th>Student Name</th>
                                            <th>Mark</th>
                                        </thead>
                                        <tbody>


                                            @forelse($failed as $student)
                                                <tr>

                                                    <td class="align-middle p-2">
                                                        {{ $student->lastname }} {{ $student->name }} </td>

                                                    <td class="align-middle"><span
                                                            class="text-danger">{{ $student->mark }}%</span>
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
    <script type="text/javascript">
        //STEP 2 - Chart Data

        var data = {
            !!json_encode($class_breakdown_clean_passes, JSON_HEX_TAG) !!
        };

        const chartData = data;

        //STEP 3 - Chart Configurations
        const chartConfig = {
            type: 'column2d',
            renderAt: 'chart-container',
            width: '100%',
            height: '400',
            dataFormat: 'json',
            dataSource: {
                // Chart Configuration
                "chart": {
                    "caption": "Clean Pass Factor Breakdown Chart",
                    "subCaption": "Learners who passed on all triple factors",
                    "xAxisName": "Classes",
                    "yAxisName": "Number of Learners",
                    "numberSuffix": "",
                    "theme": "fusion",
                    "showValues": "1",
                    "placeValuesInside": "1",
                    "rotateValues": "0",
                    "valueFont": "Arial",
                    "valueFontColor": "#ffffff",
                    "valueFontSize": "12",
                    "valueFontBold": "1",
                    "valueFontItalic": "0",
                    "valueFontAlpha": "90"
                },
                // Chart Data
                "data": chartData
            }
        };

        FusionCharts.ready(function () {
            var fusioncharts = new FusionCharts(chartConfig);
            fusioncharts.render();
        });

    </script>

    <script>
        FusionCharts.ready(function () {
            FusionCharts.options.SVGDefinitionURL = 'absolute';
            var data = {
                !!json_encode($class_breakdown_clean_passes, JSON_HEX_TAG) !!
            };
            var demographicsChart = new FusionCharts({
                type: 'pie2d',
                renderAt: 'chart-container2',
                width: '100%',
                height: '400',
                dataFormat: 'json',
                dataSource: {
                    "chart": {
                        "caption": "Clean Passes",
                        "subCaption": "Students who passed on all factors",
                        "startingAngle": "120",
                        "showLabels": "0",
                        "showLegend": "1",
                        "enableMultiSlicing": "0",
                        "slicingDistance": "15",
                        "showPercentValues": "1",
                        "showPercentInTooltip": "0",
                        "plotTooltext": "Class : $label<br>Students who passed well : $datavalue",
                        "theme": "fusion",
                    },

                    "data": data
                }
            });
            demographicsChart.render();
        });

    </script>

</x-app-layout>
