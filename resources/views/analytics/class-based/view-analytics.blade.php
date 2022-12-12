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
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.css"/>
 
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

        {{-- <!-- Include fusioncharts core library -->
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
<!-- Include fusion theme -->
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script> --}}


    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-12">

        
        {{-- <div class="card" style="background-color:rgb(255, 255, 255); border-color:rgb(255, 255, 255);">
          <img class="card-img-top" src="holder.js/100x180/" alt="">
          <div class="card-body">
            <h4 class="card-title">{{$title->grade_name}}</h4>
            <p class="card-text">{{$title->assessement_name}}</p>
          </div>
        </div> --}}

        

        <div class="bg-white shadow rounded overflow-hidden">
          <div class="px-4 pt-4 pb-4 elevation-2 cover">
              <div class="media align-items-end profile-head">
                  <div class="profile mr-2">
                      @if(empty(Auth::user()->profile_photo_url))
                      <img src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1613141854/default-profile-picture-avatar-photo-placeholder-vector-illustration-vector-id1214428300_urpxk5.jpg" alt="..." width="180" class="rounded mt-8 rounded-circle">
                      @else
      
                      <img class="user-image img-circle " width="128" height="128" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                      @endif
                  </div>
                 
              </div>
          </div>
          
          <div class="bg-white p-4 mb-5 mt-5 d-flex justify-content-start ">
              <div class="col-12 col-sm-6 col-lg-8">
                  <h3 class="mb-1">{{$title->grade_name}} {{$title->assessement_name}} Analysis  <svg class="ml-1"  xmlns="http://www.w3.org/2000/svg"
                          width="26" height="25.19" viewBox="0 0 24 23.25">
                          <path
                              d="M23.823,11.991a.466.466,0,0,0,0-.731L21.54,8.7c-.12-.122-.12-.243-.12-.486L21.779,4.8c0-.244-.121-.609-.478-.609L18.06,3.46c-.12,0-.36-.122-.36-.244L16.022.292a.682.682,0,0,0-.839-.244l-3,1.341a.361.361,0,0,1-.48,0L8.7.048a.735.735,0,0,0-.84.244L6.183,3.216c0,.122-.24.244-.36.244L2.58,4.191a.823.823,0,0,0-.48.731l.36,3.412a.74.74,0,0,1-.12.487L.18,11.381a.462.462,0,0,0,0,.732l2.16,2.437c.12.124.12.243.12.486L2.1,18.449c0,.244.12.609.48.609l3.24.735c.12,0,.36.122.36.241l1.68,2.924a.683.683,0,0,0,.84.244l3-1.341a.353.353,0,0,1,.48,0l3,1.341a.786.786,0,0,0,.839-.244L17.7,20.035c.122-.124.24-.243.36-.243l3.24-.734c.24,0,.48-.367.48-.609l-.361-3.413a.726.726,0,0,1,.121-.485Z"
                              fill="#0D6EFD"></path>
                          <path data-name="Path" d="M4.036,10,0,5.8,1.527,4.2,4.036,6.818,10.582,0,12,1.591Z"
                              transform="translate(5.938 6.625)" fill="#fff"></path>
                      </svg>
                  </h3>
                  
              </div>
          </div>
      
      </div>
     
          <div class="row">
     
            </div>

         
            <div class="mb-4">

            </div>

            <section class="content">
                <div class="container-fluid">
                  <!-- Info boxes -->
                  <p>

                  </p>
                  <h4 class="text-muted">Pass Analysis</h4>
                  <div class="row">
                


                    
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
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-thumbs-up"></i></span>
          
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
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-percentage"></i></span>
          
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
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Average-Based Pass Rate</span>
                          <span class="info-box-number">{{$avg_pass_rate }}<small>%</small></span>
                          
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col --> --}}
                 
           
                  </div>

                  <hr>

                  <h4 class="text-muted">Failure Analysis</h4>
                  <div class="row">

               
                        
                   
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
          
                    {{-- <div class="col-12 col-sm-6 col-md-3">
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
                    </div> --}}
                    {{-- <div class="col-12 col-sm-6 col-md-3">
                      <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-percentage"></i></span>
          
                        <div class="info-box-content">
                          <span class="info-box-text">Failure Rate (Triple Factor)</span>
                          
                          <span class="info-box-number">{{$triple_factor_fail_rate}}<small>%</small></span>
                         
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div> --}}
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
      
 <ul>


  A total of <span class="text-bold">{{$total_students}}</span> students, in {{$title->grade_name}} who wrote {{$name_of_assessement}}. 
    
    <li>A total of <span class="text-bold text-success">{{$assessement_data_passed_students_count}} students got clean passes.</span></li>
    <li>A total of <span class="text-bold text-danger">{{$assessement_data_failed_students_triple_count}}</span> students failed dismally.</li>
      
  <li> A total of <span class="text-bold text-danger">{{$assessement_data_failed_students_average_only_count}}</span> students failed based on average. These are students whose average is below the passing average. <small class="text-bold">(this number is inclusive of the students under the triple factor category)</small></li>
 

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
      <h4 class="card-title text-bold  pb-3  ">{{$title->grade_name}}, {{$title->assessement_name}} Clean Passes</h4>
      
  

<div class="table-responsive">
  <table class="table table-sm table-hover mx-auto" id="list">

      <thead class="thead-light hidden-md-up">
      
         
          <th>Student Name</th>
          <th>Number of Subjects</th>
          <th>Passing Subject Status</th>
          <th>Mark</th>
      </thead>
      <tbody>


          @forelse($assessement_data_passed_students as $student)
              <tr>
                
         
                  <td class="align-middle p-2"> {{ $student->name }}
                      {{ $student->lastname }}</td>
 
                      <td class="align-middle">
                        @if ($student->number_of_passed_subjects>$number_of_subjects)
                        <i class="fas fa-caret-up text-success mr-1"></i>{{$student->number_of_passed_subjects}}    
                        @elseif($student->number_of_passed_subjects=$number_of_subjects)
                        <i class="fas fa-caret-right text-warning mr-1"></i>{{$student->number_of_passed_subjects}} 
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
              <td class="align-middle">
                @if($student->student_average>=$pass_rate)
                <span class="text-success">{{ $student->student_average }}%</span>
                @else
                <span class="text-danger">{{ $student->student_average }}%</span>
                @endif
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



<div class="card">

  <div class="card-body">
    <h4 class="card-title text-bold  pb-3  ">{{$title->grade_name}}, {{$title->assessement_name}} Failed </h4>
    


<div class="table-responsive">
<table class="table table-sm table-hover mx-auto" id="list">

    <thead class="thead-light hidden-md-up">
    
       
        <th>Student Name</th>
        {{-- <th>Number of Subjects</th> --}}
        <th>Passing Subject Status</th>
        <th>Mark</th>
    </thead>
    <tbody>


        @forelse($assessement_data_failed_students_average_only as $student)
            <tr>
       
       
                <td class="align-middle p-2"> {{ $student->name }}
                    {{ $student->lastname }}</td>

                    <td class="align-middle">
                      @if ($student->number_of_passed_subjects>$number_of_subjects)
                      <i class="fas fa-caret-up text-success mr-1"></i>{{$student->number_of_passed_subjects}}    
                      @elseif($student->number_of_passed_subjects=$number_of_subjects)
                      <i class="fas fa-caret-right text-warning mr-1"></i>{{$student->number_of_passed_subjects}} 
                     @else
                      <i class="fas fa-caret-down text-danger mr-1"></i>{{$student->number_of_passed_subjects }}  
                      @endif
                      {{ $student->number_of_passed_subjects }}
                  </td> 
                  <td class="align-middle">
                      @if ($student->passing_subject_status==0)
                          <span class="text-danger"><i class="fas fa-times-circle mr-1"></i> failed </span>
                      @else
                      <span class="text-success"><i class="fas fa-check-circle mr-1"></i> passed</span>
                      @endif
                      
                  </td>
            <td class="align-middle">
              @if($student->student_average>=$pass_rate)
              <span class="text-success">{{ $student->student_average }}%</span>
              @else
              <span class="text-danger">{{ $student->student_average }}%</span>
              @endif
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
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.js"></script>
    <script>
      
      $(document).ready( function () {
    $('#list').DataTable();
} )
    </script>
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
