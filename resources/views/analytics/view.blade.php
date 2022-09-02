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
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>


    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-12">

          @if ($key==1)
          <h2 class="lead text-muted">Pass Analysis</h2>   
          @endif
       
          @if ($key==2)
          <h2 class="lead text-muted">Failure Analysis</h2> 
          @endif

           
           <hr>
            <div class="mb-4">

            </div>


            <section class="content">
                <div class="container-fluid">
                  <!-- Info boxes -->
                  <div class="row">
                    {{-- <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Total Students</span>
                          <span class="info-box-number">
                            {{$total_students}}
                           
                          </span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div> --}}
                    <!-- /.col -->

                    @if ($key==1)
                    <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Clean Passes</span>
                          <span class="info-box-number">{{$assessement_data_passed_students_count}}</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
          
                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>
          
                    <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="far fa-frown"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Average Based Passes</span>
                          <span class="info-box-number">{{$flex_mode_count}}</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="far fa-frown"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Clean Pass Rate</span>
                          <span class="info-box-number">{{$clean_pass_rate}}<small>%</small></span>
                         
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Average-Based Pass Rate</span>
                          <span class="info-box-number">{{$avg_pass_rate }}<small>%</small></span>
                          
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
           
                  
                        
                    @endif

                    @if ($key==2)
                    <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-exclamation-circle"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Triple Factor Failures</span>
                          <span class="info-box-number">{{$assessement_data_failed_students_triple_count}}</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
          
                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>
          
                    <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-exclamation-triangle"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Average Based Failures</span>
                          <span class="info-box-text"><small>(including triple factor failures)</small></span>
                          <span class="info-box-number">{{$assessement_data_failed_students_average_only_count}}</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-percentage"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Failure Rate (Triple Factor)</span>
                          
                          <span class="info-box-number">{{$triple_factor_fail_rate}}<small>%</small></span>
                         
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    {{-- <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-percentage"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Failure Rate (Average Based Factor)</span>
                          <span class="info-box-text"><small>(including triple factor failures)</small></span>
                          <span class="info-box-number">{{$average_fail_rate }}<small>%</small></span>
                          
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div> --}}

                    {{-- <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-exclamation-circle text-light"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Failed Passing Subject Only</span>
                          <span class="info-box-text"><small>(Failed because of passing subject ONLY)</small></span>
                          <span class="info-box-number">{{$assessement_data_failed_students_passing_subject_only_count }}<small></small></span>
                          
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div> --}}
                    <!-- /.col -->


                    {{-- <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-exclamation-circle"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Failed Number of  Subjects Only</span>
                          <span class="info-box-text"><small>(Failed because of number of subjects ONLY)</small></span>
                          <span class="info-box-number">{{$assessement_data_failed_students_number_of_subjects_only_count }}<small></small></span>
                          
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div> --}}

                    
                    <!-- /.col -->

                    {{-- <div class="col-12 col-sm-8 col-md-6">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-exclamation-circle"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Failed passing subject & number of subjects</span>
                          <span class="info-box-text"><small>(Failed because of passing subject & number of subjects)</small></span>
                          <span class="info-box-number">{{$assessement_data_failed_students_number_of_subjects_only_number_of_subjects_count }}</span>
                          
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div> --}}
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
          
                        
                    @endif
           
                 
              
          
                
              
                </div><!--/. container-fluid -->
              </section>


            <div class="mt-10 mb-25">
                <hr>

            </div>
<section>
  <div class="card text-left">
 
    <div class="card-body">
      <div class="pb-3 ">

      <h2 class="card-title"> Analysis for <span class="text-bold">{{$name_of_stream}}, {{$name_of_assessement}}</span> </h2>
    </div>
      <p class="card-text pt-3">
        @if ($key==2)
 <ul>

 
        <li>A total of <span class="text-bold">{{$total_students}}</span> students, wrote <span class="text-bold">{{$name_of_assessement}}</span>. Out of the {{$total_students}}</span> who sat for the assessement, a total of <span class="text-bold text-danger">{{$assessement_data_failed_students_triple_count}}  students failed dismally.</span></li>
      
        <li>{{$assessement_data_failed_students_average_only_count}} students failed based on average. These are students whose average is below the passing average. <small class="text-bold">(this number is inclusive of the students under the triple factor category)</small></li>

        {{-- <li>
          There are {{$assessement_data_failed_students_average_only_count-$assessement_data_failed_students_triple_count}} students who are <em> outside the triple factor category</em>, whose average is below the pass rate
        </li> --}}

      
      </ul>

    </div>

      </div>

      <div class="card text-left">
        <div class="card-body">
        <h2 class="card-title pb-3 text-bold">Class Break Down of Triple Factor Failures</span> </h2>
       
  <table class="table table-sm table-hover mx-auto">
    <thead class="thead-light ">
    <tr>
      <th>Class</th>
      <th>Number of Failures</th>
     
    </tr>
  </thead>
  <tbody>
   

      @foreach ($class_breakdown as $item)
      <tr>
      <td scope="row">{{$item->label}} </td>
      
        <td>{{$item->value}} learners</td>
      </tr>
      @endforeach

   
  
  </tbody>
</table>
        </div>

      </div>
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
</div>
   


  <div class="card">

    <div class="card-body">
      <h4 class="card-title text-bold  pb-3  ">Triple Factor Student Failure Breakdown</h4>
      
  

<div class="table-responsive">
  <table class="table table-sm table-hover mx-auto">

      <thead class="thead-light hidden-md-up">

          <th>Class</th>
          <th>Student Name</th>
          <th>Mark</th>
      </thead>
      <tbody>


          @forelse($assessement_data_failed_students_triple as $student)
              <tr>
                  <td class="align-middle p-2">{{ $student->grade_name }}</td>
                  <td class="align-middle p-2"> {{ $student->name }}
                      {{ $student->lastname }}</td>
 
                <td class="align-middle">{{ $student->student_average }}%</td>
                 
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

        @endif
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

      var data = {!! json_encode($class_breakdown, JSON_HEX_TAG) !!};
     
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
              "caption": "Triple Failure Factor Breakdown Chart",
              "subCaption": "Learners who failed on all triple factors",
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

      FusionCharts.ready(function(){
      var fusioncharts = new FusionCharts(chartConfig);
      fusioncharts.render();
      });
  
  </script>

  <script>
  FusionCharts.ready(function() {
  FusionCharts.options.SVGDefinitionURL = 'absolute';
  var data = {!! json_encode($class_breakdown, JSON_HEX_TAG) !!};
  var demographicsChart = new FusionCharts({
    type: 'pie2d',
    renderAt: 'chart-container2',
    width: '100%',
    height: '400',
    dataFormat: 'json',
    dataSource: {
      "chart": {
        "caption": "Triple Factor Failures",
        "subCaption": "Students who failed on all factors",
        "startingAngle": "120",
        "showLabels": "0",
        "showLegend": "1",
        "enableMultiSlicing": "0",
        "slicingDistance": "15",
        "showPercentValues": "1",
        "showPercentInTooltip": "0",
        "plotTooltext": "Class : $label<br>Students who failed dismally : $datavalue",
        "theme": "fusion",
      },

      "data": data
    }
  });
  demographicsChart.render();
});

  </script>

</x-app-layout>
