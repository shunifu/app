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
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i> </i></span>
          
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
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-check-circle text-white"></i> </span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Average Based Passes</span>
                          <em><span class="info-box-number small text-muted">inclusive of clean-pass students</span></em>
                          <span class="info-box-number">{{$flex_mode_count}}</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-percentage text-white"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Clean Pass Rate</span>
                          <span class="info-box-number">{{$clean_pass_rate}}<small>%</small></span>
                         
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    {{-- <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning text-white elevation-1"><i class="fas fa-percentage text-white"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Average-Based Pass Rate</span>
                          <span class="info-box-number">{{$avg_pass_rate }}<small>%</small></span>
                          
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
        @if ($key==1)
 <ul>

 
        <li>A total of <span class="text-bold">{{$total_students}}</span> students, wrote <span class="text-bold">{{$name_of_assessement}}</span>. Out of the {{$total_students}}</span> who sat for the assessement, a total of <span class="text-bold text-success">{{$assessement_data_passed_students_count}}  students got clean passes.</span> A clean pass is one where the student gets an average equal or above the passing mark, passes the passing subject and passes a certain number of subjects</li>

        <li>Out of the {{$total_students}}</span> who sat for the assessement, a total of <span class="text-bold text-success">{{$assessement_data_passed_students_count}} </span> students got an average equal or above the passing mark.</span></li>
 
      </ul>

    </div>

      </div>

      <div class="card text-left">
        <div class="card-body">
        <h2 class="card-title pb-3 text-bold">Class Break Down of Clean Passes</span> </h2>
       
  <table class="table table-sm table-hover mx-auto">
    <thead class="thead-light ">
    <tr>
    
      <th>Class</th>
      <th>Number of Clean Passes</th>
     
    </tr>
  </thead>
  <tbody>
   

      @foreach ($class_breakdown_clean_passes as $item)
      <tr>
        
      <td>{{$item->label}} </td>
      
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
     
      
  
<div class="row">
   
    <div class="col-md-6">
        <div class="table-responsive">
            <h4 class="card-title text-bold  pb-3  ">Clean Passes (Strict Mode)</h4>
        <table class="table table-sm table-hover mx-auto">

            <thead class="thead-light hidden-md-up">
                <th>Position</th>
                <th>Class</th>
                <th>Student Name</th>
                <th>Mark</th>
            </thead>
            <tbody>
      
      
                @forelse($assessement_data_passed_students as $student)
                    <tr>
                      <td>{{$loop->iteration}} </td>
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

<div class="col-md-6">
    <div class="table-responsive">
        <h4 class="card-title text-bold  pb-3  ">Average Based Passes (Flex Mode)</h4>
        <table class="table table-sm table-hover mx-auto">

            <thead class="thead-light hidden-md-up">
                <th>Position</th>
                <th>Class</th>
                <th>Student Name</th>
                <th>Passed Subjects</th>
                <th>Passing Subject</th>
                <th>Mark</th>
            </thead>
            <tbody>
      
      
                @forelse($flex_mode as $student)
                    <tr>
                      <td>{{$loop->iteration}} </td>
                        <td class="align-middle p-2">{{ $student->grade_name }}</td>
                        <td class="align-middle p-2"> {{ $student->name }}
                            {{ $student->lastname }}</td>
                            

                            <td class="align-middle">
                                @if ($student->number_of_passed_subjects>=$number_of_subjects)
                                <i class="fas fa-caret-up text-success mr-1"></i>{{$student->number_of_passed_subjects}}    
                                @else
                                <i class="fas fa-caret-down text-danger mr-1"></i>{{$student->number_of_passed_subjects }}  
                                @endif
                                {{-- {{ $student->number_of_passed_subjects }} --}}
                            </td>
                            <td class="align-middle">
                                @if ($student->passing_subject_status==0)
                                    <span class="text-danger"><i class="fas fa-times-circle mr-1"></i> failed </span>
                                @else
                                <span class="text-success"><i class="fas fa-check-circle mr-1"></i> passed</span>
                                @endif
                                
                            </td>
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

      var data = {!! json_encode($class_breakdown_clean_passes, JSON_HEX_TAG) !!};
     
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

      FusionCharts.ready(function(){
      var fusioncharts = new FusionCharts(chartConfig);
      fusioncharts.render();
      });
  
  </script>

  <script>
  FusionCharts.ready(function() {
  FusionCharts.options.SVGDefinitionURL = 'absolute';
  var data = {!! json_encode($class_breakdown_clean_passes, JSON_HEX_TAG) !!};
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
