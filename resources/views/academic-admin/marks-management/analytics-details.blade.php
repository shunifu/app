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

            <script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js">
            </script>
            <script type = "text/javascript">
               google.charts.load('current', {packages: ['corechart']});     
            </script>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-12">

{{-- <div class="card text-left">
 
  <div class="card-body">
    <h4 class="card-title">Subject Analysis</h4>
    <p class="card-text">{{$assessement_data->assessement_name}}, {{$assessement_data->subject_name}}</p>
  </div>
</div> --}}
{{-- <div class="card">
  <img class="card-img-top" src="holder.js/100px180/" alt="">
  <div class="card-body">
    <h4 class="card-title"> {{$assessement_data->grade_name}} {{$assessement_data->subject_name}} {{$assessement_data->assessement_name}} </h4>
    <p class="card-text">This is an analyisis for   {{$assessement_data->subject_name}} in {{$assessement_data->assessement_name}} as taught by  {{$assessement_data->salutation}}  {{$assessement_data->name}} {{$assessement_data->lastname}}   </p>
  </div>
</div> --}}

<div class="bg-white shadow rounded overflow-hidden">
    <div class="px-4 pt-4 pb-4 elevation-2 cover">
        <div class="media align-items-end profile-head">
            <div class="profile mr-2">
                @if(empty(Auth::user()->profile_photo_url))
                <img src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1633582520/bg2_woyyl4.jpg" alt="..." width="180" class="rounded mt-8 rounded-circle">
                @else

                <img class="user-image img-circle " width="128" height="128" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                @endif
            </div>
           
        </div>
    </div>
    
    <div class="bg-white p-4 mb-5 mt-5 d-flex justify-content-end">
        <div class="col">
            <h3 class="mb-1">{{Auth::user()->name}} {{Auth::user()->middlename}} {{Auth::user()->lastname}}<svg class="ml-1"  xmlns="http://www.w3.org/2000/svg"
                    width="26" height="25.19" viewBox="0 0 24 23.25">
                    <path
                        d="M23.823,11.991a.466.466,0,0,0,0-.731L21.54,8.7c-.12-.122-.12-.243-.12-.486L21.779,4.8c0-.244-.121-.609-.478-.609L18.06,3.46c-.12,0-.36-.122-.36-.244L16.022.292a.682.682,0,0,0-.839-.244l-3,1.341a.361.361,0,0,1-.48,0L8.7.048a.735.735,0,0,0-.84.244L6.183,3.216c0,.122-.24.244-.36.244L2.58,4.191a.823.823,0,0,0-.48.731l.36,3.412a.74.74,0,0,1-.12.487L.18,11.381a.462.462,0,0,0,0,.732l2.16,2.437c.12.124.12.243.12.486L2.1,18.449c0,.244.12.609.48.609l3.24.735c.12,0,.36.122.36.241l1.68,2.924a.683.683,0,0,0,.84.244l3-1.341a.353.353,0,0,1,.48,0l3,1.341a.786.786,0,0,0,.839-.244L17.7,20.035c.122-.124.24-.243.36-.243l3.24-.734c.24,0,.48-.367.48-.609l-.361-3.413a.726.726,0,0,1,.121-.485Z"
                        fill="#0D6EFD"></path>
                    <path data-name="Path" d="M4.036,10,0,5.8,1.527,4.2,4.036,6.818,10.582,0,12,1.591Z"
                        transform="translate(5.938 6.625)" fill="#fff"></path>
                </svg>
            </h3>
            <hr>
           
            <p class="text-gray-700 mb-1 2h-base"> Sawubona  {{Auth::user()->salutation}} {{Auth::user()->name}} {{Auth::user()->lastname}} {{\Spatie\Emoji\Emoji::grinningFace()}}, this is an analysis of your  <span class="text-bold">{{$assessement_data->grade_name}} 
                {{$assessement_data->assessement_name}}  {{$assessement_data->subject_name}}</span> Assessement. A total of <span class="text-bold">{{$total}}</span> students sat for this assessement and below is how they performed. For a detailed breakdown of each students individual performance continue to scroll down.<p>

             

              </p>



             

          
             
            
              </p>
             
              
     
        </div>
    </div>

</div>
      


            <hr>
            <div class="mb-4">

            </div>

            <section class="content">
                <div class="container-fluid">


                    <div class="row">
                        {{-- <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-warning">
                            <div class="inner">
                              <h3>{{$total}}</h3>
                
                              <p>Students who sat for assessement</p>
                            </div>
                            <div class="icon">
                              <i class="ion-ios-people"></i>
                            </div>
                            <a href="/users/teachers/manage" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div> --}}
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-success">
                            <div class="inner">
                              <h3>{{$total_passed}}</h3>
                
                              <p>Total Passed</p>
                            </div>
                            <div class="icon">
                              <i class="ion-android-people"></i>
                            </div>
                            <a href="/users/student/manage" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-danger">
                            <div class="inner">
                              <h3>{{$total_failed}}</h3>
                
                              <p>Failed Students</p>
                            </div>
                            <div class="icon">
                              <i class="ion-android-people"></i>
                            </div>
                            <a href="/users/student/manage" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                          <!-- small box -->
                          <div class="small-box bg-success">
                            <div class="inner">
                              <h3>{{$subject_pass_rate}}%</h3>
                
                              <p>Pass Rate</p>
                            </div>
                            <div class="icon">
                              <i class="ion-android-people"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                              <div class="inner">
                                <h3>{{$subject_fail_rate}}%</h3>
                  
                                <p>Fail Rate</p>
                              </div>
                              <div class="icon">
                                <i class="ion-android-people"></i>
                              </div>
                              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                          </div>
                        <!-- ./col -->
                      </div>


       
            






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
                                    <span class="text-bold text-danger">{{ $total_failed }} </span> students got an
                                    average
                                    that is less than the passing mark.</span></li>

                            </ul>

                    </div>

                </div>

                <div class="card text-left">
                    <img class="card-img-top" src="holder.js/100px180/" alt="">
                    <div class="card-body">
                      <h4 class="card-title">Data Visualization</h4>
                      <p class="card-text">
                          <div id="container">

                          </div>
                          <div class="container-fluid">
                            <div class="row">
                                <div class="col" id="jcontainer">
                                    FusionCharts XT will load here!
                                </div>

                                <div class="col-6" id="chart-container2">
                                    FusionCharts XT will load here!
                                </div>
                            </div>
                          </div>
                         

                          </div>
                      </p>
                    </div>
                  </div>
    </div>


  




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
                                            <th>No.</th>
                                            <th>Student Name</th>
                                            <th>Mark</th>
                                        </thead>
                                        <tbody>


                                            @forelse($failed as $student)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
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
    <script language = "JavaScript">
        function drawChart() {
           // Define the chart to be drawn.
           var daresults = {
            !!json_encode($results, JSON_HEX_TAG) !!
        };
           var data = google.visualization.arrayToDataTable([
              ['Year', 'Asia'],
              ['2012',  900],
              ['2013',  1000],
              ['2014',  1170],
              ['2015',  1250],
              ['2016',  1530]
           ]);

           var options = {title: 'Population (in millions)'}; 

           // Instantiate and draw the chart.
           var chart = new google.visualization.ColumnChart(document.getElementById('container'));
           chart.draw(data, options);
        }
        google.charts.setOnLoadCallback(drawChart);
     </script>
    {{-- <script type="text/javascript">
        //STEP 2 - Chart Data

        var data = {
            !!json_encode($results, JSON_HEX_TAG) !!
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
                    "subCaption": "Learners who passed",
                    "xAxisName": "Results",
                    "yAxisName": "Number of Students",
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

    </script> --}}

    {{-- <script>
        FusionCharts.ready(function () {
            FusionCharts.options.SVGDefinitionURL = 'absolute';
            var data = {
                !!json_encode($results, JSON_HEX_TAG) !!
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

    </script> --}}

</x-app-layout>
