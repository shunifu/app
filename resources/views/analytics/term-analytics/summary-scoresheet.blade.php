<x-app-layout>
    <x-slot name="header">
        <style>
   table, tr, td, th {
  border: 1px solid #000;
  position: relative;
  padding: 16px;
}

th span {
  transform-origin: 0 50%;
  transform: rotate(-90deg); 
 
  display: block;
  position: absolute;
  bottom: 0;
  top:5;
  left: 50%;
}
        </style>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.6.0/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/r-2.3.0/sb-1.3.3/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.6.0/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/r-2.3.0/sb-1.3.3/datatables.min.js"></script>
  
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light">
              <div class="p-3 no-print">
                <a href="javascript:history.back()" class="btn btn-success">Back </a>
              </div>
              
              <div class="card-header no-print">
                <h3 class="card-title">{{$stream_title}} Summary Scoresheet  {{$term_name}}</h3>
            
              </div>
            
            <div class="card-body">
             
                
  
         
    
  
  <div class="table-responsive">
    <form action="/promote/students" method="POST">
        @csrf
    <table class="table table-sm table-hover mx-auto table-bordered " style="width:100%" id="customers">
        <div class="col-md-12 mx-auto">

            @foreach (\App\Models\School::all() as $item)
            <div class="mx-auto text-center">

          
            <div class="row mx-auto" style="width:auto; display:block">

        <div class="col"><img src="{{$item->school_letter_head}}"  class="img-fluid mx-auto d-block" /></div>
             
             
                
            </div>
               
        
                    <p>
                        <h3 class="text-bold">{{$stream_title}} Summerized {{$term_name}} Scoresheet</h3>
                    </p>
                
            </div>
           
            @endforeach
          
            </div>
            <p class="text-muted">Stream Statistics</p>
            <div class="row">
                


                    
                <div class="col-10 col-sm-6 col-md-4">
                  <div class="info-box mb-3 bg-gray">
                
      
                    <div class="info-box-content ">
                      <span class="info-box-text">Total Learners</span>
                      <span class="info-box-number">{{$total_students}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
      
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
      
                <div class="col-8 col-sm-4 col-md-2">
                    <div class="info-box mb-3 bg-success">
              
      
                    <div class="info-box-content">
                      <span class="info-box-text">Total Passed</span>
                      <span class="info-box-number">{{$total_passed}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <div class="col-8 col-sm-4 col-md-2">
                    <div class="info-box mb-3 bg-danger">
                   
      
                    <div class="info-box-content">
                      <span class="info-box-text">Total Failed</span>
                      <span class="info-box-number">{{$total_failed}}</span>
                     
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>

                <div class="col-8 col-sm-4 col-md-2">
                    <div class="info-box mb-3 bg-success">
                 
        
                      <div class="info-box-content">
                        <span class="info-box-text">Pass Rate</span>
                        <span class="info-box-number">{{round($pass_rate_percentage)}}%</span>
                       
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>


                
                  <div class="col-8 col-sm-4 col-md-2">
                    <div class="info-box mb-3 bg-danger">
        
                      <div class="info-box-content">
                        <span class="info-box-text">Failure Rate</span>
                        <span class="info-box-number">{{round($fail_rate_percentage)}}%</span>
                       
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
        
             
       
              </div> 

<hr>
<p class="text-muted">Progression Statistics</p>
              <div class="row">
                


                    
                <div class="col-10 col-sm-6 col-md-4">
                  <div class="info-box mb-3 bg-success">
                
      
                    <div class="info-box-content ">
                      <span class="info-box-text">Clean Passes (Proceed)</span>
                      <span class="info-box-number">{{$total_progression}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
      
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
      
                <div class="col-8 col-sm-4 col-md-2">
                    <div class="info-box mb-3 bg-warning">
              
      
                    <div class="info-box-content">
                      <span class="info-box-text">Total Promoted</span>
                      <span class="info-box-number">{{$total_promoted}}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <div class="col-8 col-sm-4 col-md-2">
                    <div class="info-box mb-3 bg-danger">
                   
      
                    <div class="info-box-content">
                      <span class="info-box-text">Total Repeating</span>
                      <span class="info-box-number">{{$total_repeat}}</span>
                     
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>

                <div class="col-8 col-sm-4 col-md-2">
                    <div class="info-box mb-3 bg-purple">
                 
        
                      <div class="info-box-content">
                        <span class="info-box-text">Total Expelled</span>
                        <span class="info-box-number">{{$total_expelled}}</span>
                       
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>


                
                  <div class="col-8 col-sm-4 col-md-2">
                    <div class="info-box mb-3 bg-danger">
        
                      <div class="info-box-content">
                        <span class="info-box-text">Repeat Rate</span>
                        <span class="info-box-number">
                            @if ($total_repeat==0 or is_null($total_repeat))
                                
                            @else
                            {{round(($total_repeat/$total_students)*100)}}%   
                            @endif
                           
                        </span>
                       
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
        
             
       
              </div> 

              <hr>

              
                         
          
        
        <thead class="thead-light hidden-md-up">

           
        @if ($indicator=="summary_scoresheet")
        <th><span>Select</span></th>
        <th><span> Status</span></th> 
         @endif
        <th><span>Position</span></th> 
        <th><span>Student</span></th>
        <th><span>Class</span></th>
        <th><span>Comment</span></th>
        <th><span>Average</span></th>
        <th><span>Passed Subjects</span></th>
        <th><span>Failed Subjects</span></th>
        <th><span>Passing Subject</span></th>
        </thead>
        <tbody>

        @forelse($scoresheet as $student)
        <tr>
        @if ($indicator=="summary_scoresheet")
        <td><input type="checkbox" class="students" name="students[]" value="{{$student->student_id}}" ></td>
        <td class="align-middle p-2">
            @if ($student->final_term_status =="Proceed")
            <span class="text-success text-bold">{{$student->final_term_status}}</span>
            @elseif($student->final_term_status =="Repeat")
            <span class="text-danger text-bold">{{$student->final_term_status}} </span>
            @elseif($student->final_term_status =="Promoted")
            <span class="text-warning text-bold">{{$student->final_term_status}} </span>
            @elseif($student->final_term_status =="Try Another School")
            <span class=" text-bold">{{$student->final_term_status}} </span>
            @endif 
            </td> 
        @endif


<td class="align-middle p-2">
@php
//    if tie type is share, i.e ties share the same position run the query below
$student_position=\DB::select(\DB::raw("select t.*
from (select term_averages.student_id,term_averages.student_average, rank() over (order by term_averages.student_average desc) as student_position
from term_averages where term_averages.term_id=".$term." AND term_averages.student_stream=".$stream.") t
where student_id = ".$student->learner_id.""));

foreach ($student_position as $key) {
echo $key->student_position;
}
@endphp
</td>

        
 <td class="align-middle p-2">{{ $student->lastname }} {{ $student->name }} </td>
 <td class="align-middle p-2">{{ $student->grade_name }}</td>
 
<td class="align-middle p-2">
@if ($student->remark =="Passed")
<i class="fas fa-check-circle text-success"></i> {{$student->remark}}
@else
<i class="fas fa-times-circle text-danger"></i>  {{$student->remark}}
@endif 
</td> 

<td class="align-middle p-2">
@if ($student->student_average>= $pass_rate)
<span class="text-secondary">{{ ($student->student_average)}} </span>
 @else
<span class="text-danger">{{ ($student->student_average)}} </span>
 @endif
</td>

<td class="align-middle p-2">{{ ($student->number_of_passed_subjects)}} subjects </td>

    
    <td class="align-middle p-2">
        @php
        
        $student_loads=\DB::select(\DB::raw("SELECT COUNT(student_id) as total from student_loads 
        where student_loads.active=1 AND student_id = ".$student->learner_id.""));
        
        foreach ($student_loads as $key) {
        echo (($key->total)-($student->number_of_passed_subjects).' subjects');
        }
        @endphp
        </td>

        <td class="align-middle p-2">
            @if ($student->passing_subject_status =="1")
            <i class="fas fa-check-circle text-success"></i> Passed
            @else
            <i class="fas fa-times-circle text-danger"></i>  Failed
            @endif 
            </td> 
            

  </tr>
                

            

            @empty
               No Data to Display
            @endforelse
           
        </tbody>

    </table>
    <input type="hidden"name="term_id" value="{{$term}}">
    <tr>
<td><button type="submit" name="action" id="promote" value="promote" class="btn btn-primary">Promote Students</button></td>
<td><button type="submit" name="action" id="another_school" value="another_school" class="btn btn-danger">Another School</button></td>
<td><button type="submit" name="action" id="repeat" value="repeat" class="btn btn-danger">Force Repeat</button></td>
    </tr>
    
</form>
  </div>
              </div>
        
        </div>
            
        </div>     
            
        </div>  

      

        <script>
            $(document).ready(function () {
                $.noConflict();
                var term = @json($term_name);
                var stream = @json($stream_title);
            
                var dateNow = new Date();
              
 

$('#customers').append('<caption style="margin-bottom:30px;color:red; fontSize:23px;">Shunifu a product of Innovazania. Proudly Made in Eswatini, Africa</caption>');
   
                $('#customers').DataTable({
                    // scrollY:auto,
                    scrollCollapse: true,
                    paging: false,
                    //scrollX: true,
                    info: true,
                    dom: 'Bfrtip',
                    select: true,

                    stateSave: true,
        autoWidth: true,
        "columnDefs": [
    { "searchable": true, "targets": 1 }
  ],
   
        buttons: [
          {
            extend: 'pdfHtml5',  
            exportOptions: {
                    columns: ':visible',
                     alignment: 'center'
                },
            title: @json($stream_title)+' '+ @json($term_name)+' '+'Scoresheet',  
            customize: function (doc) {
    //             doc.content[1].table.body[0].forEach(function (h) {
    //     h.fillColor = 'green';
    //     alignment: 'center'
    // });
    doc.styles.title = {
        color: '#2D1D10',
        fontSize: '35',
        alignment: 'center',
        // font-weight: bold;

    }

    // doc.styles.thead = {
    //    background-color:'red';
        
    // // },
    //             doc.content.splice(0, 0, {

                  
     
                    
    //                 alignment: 'center',
    //               
    //             });

    var objLayout = {};
						objLayout['hLineWidth'] = function(i) { return 2; };
						objLayout['vLineWidth'] = function(i) { return 2; };
						objLayout['hLineColor'] = function(i) { return '#00000'; };
						objLayout['vLineColor'] = function(i) { return '#00000'; };
						objLayout['paddingLeft'] = function(i) { return 4; };
						objLayout['paddingRight'] = function(i) { return 4; };
						doc.content[0].layout = objLayout;
                        console.log(objLayout['hLineColor']);

            },  

            
            orientation: 'landscape',
            pageSize: 'A3',
            header: true,
            text:'Generate'+' '+@json($stream_title)+' '+'Scoresheet PDF',
           
            filename:@json($stream_title)+'-'+@json($term_name)+'-'+'scoresheet',
            messageTop:dateNow,
            pageMargins: [ 0, 0, 0, 0 ],
            margin: [ 0, 0, 0, 0 ],
            
            pageBreakBefore: function(currentNode, followingNodesOnPage, nodesOnNextPage, previousNodesOnPage) {
     return currentNode.headlineLevel === 1 && followingNodesOnPage.length === 0;
  },
            
           
   
           
  
          },
         
          {
             extend: 'excel',
             exportOptions: {
                    columns: ':visible',
                     alignment: 'center'
                },
                customize: function ( xlsx ){
                var sheet = xlsx.xl.worksheets['sheet1.xml'];
 
                // jQuery selector to add a border
                // $('row:first c', sheet).attr('s', '7');
                // $('c[r=A1] t', sheet).text( stream );

       

        var table = $('#customers').DataTable();
        var thead = table.table().header();
        
        var titles = [];
        
        $(thead).find('th').each(function(){
          titles.push($(this).text());
        });

    //     $(thead).find('th').each(function(){
    //         $(this).attr('s', '40');
    // });
        
        console.log(titles);
        
        
         
     
            },
        },

            {
                extend: 'colvis',
                collectionLayout: 'fixed columns',
                collectionTitle: 'Column visibility control'
            },
          
        ],

                });
                {
//    extend: 'pdfHtml5',
//    orientation: 'landscape',
//    pageSize: 'TABLOID', // TABLOID OR LEGAL
//    footer: true,
 }


           
  
    
            })
    
        </script>
      
      <script>
        $(function() {
 var header_height = 0;
 $('table th span').each(function() {
     if ($(this).outerWidth() > header_height) header_height = $(this).outerWidth();
 });

 $('table th').height(header_height);
});
    </script>
        
  
  </x-app-layout>
  
  