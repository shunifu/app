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
      @include('partials.parents-header')
        <div class="col-md-12">

          @if (empty($kid->name))
             no data 
          @else
              
        
         
          <h2 class="lead text-muted">{{$kid->name}}'s {{$assessement_data->assessement_name}} Analysis</h2>   
        

           <hr>
            <div class="mb-4">

            </div>

            <section class="content">
                <div class="container-fluid">
                  <!-- Info boxes -->
                  <div class="row">
        

                 
                    <div class="col-12 col-sm-8 col-md-4">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i> </i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">{{$kid->name}}'s Average</span>
                          <span class="info-box-number">{{$kid->student_average}}%</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
          
                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>
          
                    <div class="col-12 col-sm-8 col-md-4">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-check-circle text-white"></i> </span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Number of Passed Subjects</span>
                          <span class="info-box-number">{{$kid->number_of_passed_subjects}}</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <div class="col-12 col-sm-8 col-md-4">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-percentage text-white"></i></span>
          
                        <div class="info-box-content">
                            <span class="info-box-text">Passing Subject Status</span>
                          <span class="info-box-number">
                              @if ($kid->passing_subject_status==0)
                                  Failed
                                  @else
                                  Passed
                              @endif
                              
                            </span>
                         
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                   
                  </div>
                  <!-- /.row -->
           
                  
                        
                   

                </div><!--/. container-fluid -->
              </section>


            <div class="mt-10 mb-25">
                <hr>

            </div>
<section>
 

      <div class="card text-left">
        <div class="card-body">
        <h2 class="card-title pb-3 text-bold">Break Down of {{$kid->name}}'s performance</span> </h2>
       
  <table class="table table-sm table-hover mx-auto">
    <thead class="thead-light ">
    <tr>
    
      <th>Subject</th>
      <th>Average</th>
     
    </tr>
  </thead>
  <tbody>
   

      @foreach ($marks as $item)
      <tr>
        
      <td>{{$item->label}} </td>
      
        <td>{{$item->value}}%</td>
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
   


  
</div>
</div>


    
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

      var data = {!! json_encode($marks, JSON_HEX_TAG) !!};
     
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
              "caption": "Performance Breakdown",
              "subCaption": "Student Performance Breakdown",
              "xAxisName": "Subjects",
              "yAxisName": "Mark in %",
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
  var data = {!! json_encode($marks, JSON_HEX_TAG) !!};
  var demographicsChart = new FusionCharts({
    type: 'pie2d',
    renderAt: 'chart-container2',
    width: '100%',
    height: '400',
    dataFormat: 'json',
    dataSource: {
      "chart": {
        "caption": "Performance Breakdown",
        "subCaption": "Student Performance Breakdown",
        "startingAngle": "120",
        "showLabels": "0",
        "showLegend": "1",
        "enableMultiSlicing": "0",
        "slicingDistance": "15",
        "showPercentValues": "1",
        "showPercentInTooltip": "0",
        "plotTooltext": "Class : $label<br>got : $datavalue",
        "theme": "fusion",
      },

      "data": data
    }
  });
  demographicsChart.render();
});

  </script>
  @endif
</x-app-layout>
