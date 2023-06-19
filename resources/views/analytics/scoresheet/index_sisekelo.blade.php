<x-app-layout>
    <x-slot name="header">
        <style>
   table, tr, td, th {
  border: 1px solid #000;
  position: relative;
  padding: 16px;
}

th span {
    position: absolute;
  top: 100%;
  left: 50%;
  transform: rotate(-90deg) translateY(-50%);
  transform-origin: 0 0;
}
.red {
  background-color: red !important;
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
                <h3 class="card-title">Stream Analytics</h3>
              </div>
            
            <div class="card-body">
             
              <hr>
              <div class="p-4"></div>
  
         
              <div class="table-responsive">
 
  
  
  
  </div>
  
  <div class="table-responsive">
    <table class="table table-sm table-hover mx-auto table-bordered " style="width:100%" id="customers">
        <div class="col-md-12 mx-auto">

            @foreach (\App\Models\School::all() as $item)
            <div class="mx-auto text-center" style="display:block">

          
          
                <div class="col"><img src={{$item->school_letter_head}}  class="img-responsive img-fluid" /></div>
            
          
          
                    <p>
                        <h3 class="text-bold">{{$stream_title}}  {{$assessement_name}} Scoresheet</h3>
                    </p>
                Student Average calculation criteria
                <ul>
                    <li>
                        Passing Subject Rule: @if ($passing_subject_rule==1)
                            <strong>Passing Subject Rule APPLIES</strong>
                        @else
                        <strong>Passing Subject Rule DOES NOT APPLY </strong>
                        @endif 

                        <li>
                           Student Average: @if ($term_average_rule=="default")
                             <strong>  Average of ALL Subjects</strong>
                            @else
                          Best {{$number_of_subjects}} subjects @if($passing_subject_rule==1)including English  @endif
                            @endif 
                        </li>
                    </li>
                </ul>
            </div>
           
            @endforeach
          
            </div>
                         
            <hr>
        <thead class="thead-light hidden-md-up">
        <th><span>Position</span></th> 
        <th><span>Student</span></th>
        <th><span>Class</span></th>
        <th><span>Average</span></th>
         <th><span>Ratio</span></th>
        <th><span>Comment</span></th>
        <th><span>English Lang</span> </th>
        <th><span>Maths</span></th>
        <th><span>NaturalScience</span></th>
        <th><span>PhysicalScience</span></th>
        <th><span>Biology</span></th>
        <th><span>Siswati</span></th>
        <th><span>French</span></th>
        <th><span>Geo</span></th>
        <th><span>ConsumerStudies</span></th>
        <th><span>History</span></th>
        <th><span>BS</span></th>
        <th><span>Accounting</span></th>
        <th><span>Economics</span></th>
        <th><span>FS-Maths</span></th>
        <th><span>Computer Studies</span></th>
        <th><span>ICT</span></th>
        <th><span>FS-CS</span></th>
        <th><span>EGT</span></th>
        <th><span>QR</span></th>
        <th><span>EMS</span></th>
        <th><span>AC</span></th>
        <th><span>FS-ENG</span></th>
        <th><span>Music</span></th>
      
        </thead>
        <tbody>

            @forelse($scoresheet as $student)
                <tr>

                  
                  
                    
                    <td class="align-middle p-2">
                        @if ($tie_type=="share")

                        @if ($key=="class_based")

                        @php
                        $sql_piece="WHERE sc.student_class=".$classofstudent."  AND sc.assessement_id=".$assessement_id."";
                        @endphp
                        
                        @endif
    
                        @if ($key=="stream_based")
                       
                        @php
                        $sql_piece="WHERE sc.student_stream=".$streamofstudent."  AND sc.assessement_id=".$assessement_id."";
                        @endphp

                        @endif
                        @php
                        $student_position=\DB::select(\DB::raw("SELECT * FROM (SELECT st.id as student_id,
                        sc.student_average,
                        CASE 
                        WHEN @grade = COALESCE(sc.student_average, 0) THEN @rownum 
                        ELSE @rownum := @rownum + 1 
                        END AS student_position,
                        @grade := COALESCE(sc.student_average, 0) as avg
                        
                        FROM users st
                        LEFT JOIN assessement_progress_reports sc ON sc.student_id = st.id
                        JOIN (SELECT @rownum := 0, @grade := NULL) r  
                        ".$sql_piece."
                        ORDER BY sc.student_average DESC ) as sub
                        WHERE sub.student_id=".$student->learner_id.""));
                        foreach ($student_position as $key) {
                        echo $key->student_position;
                        }
                        @endphp
                        @endif


                        @if ($tie_type=="share_n_+_1")
                    

                        @if ($key=="class_based")

                        @php
                       $sql_piece="where assessement_progress_reports.assessement_id=".$assessement_id." AND assessement_progress_reports.student_class=".$classofstudent."";
                        @endphp
                      
                        @endif

                        @if ($key=="stream_based")

                        @php
                        $sql_piece="where assessement_progress_reports.assessement_id=".$assessement_id." AND assessement_progress_reports.student_stream=".$streamofstudent."";
                        @endphp

                        @endif


                        @php


                    
                    $student_position=\DB::select(\DB::raw("select t.*
from (select assessement_progress_reports.student_id,assessement_progress_reports.student_average, rank() over (order by assessement_progress_reports.student_average desc) as student_position
from assessement_progress_reports ".$sql_piece.") t
where student_id = ".$student->learner_id.""));
                        foreach ($student_position as $key) {
                        echo $key->student_position;
                        }
 
                        @endphp
                    
                
                        @endif

                        @if ($tie_type=="sequential") 
                        @php
                        
                        $student_position=\DB::select(\DB::raw("SELECT * FROM
                        (SELECT
                        (@rownum := @rownum + 1) AS student_position,
                        student_id,
                        student_average, 
                        assessement_id
                        FROM assessement_progress_reports a
                        CROSS JOIN (SELECT @rownum := 0) params
                        WHERE student_stream =".$streamofstudent." AND assessement_id=".$assessement_id."
                        ORDER BY student_average DESC) as sub
                        WHERE sub.student_id=".$student->learner_id.""));
                        foreach ($student_position as $key) {
                        echo $key->student_position;
                        }
                        
                        
                        @endphp
                        @endif
                    
                    </td>
                    {{-- <td class="align-middle p-2">
                    {{$student->learner_id}} 
                    
                    </td> --}}
                    <td class="align-middle p-2">
                      {{ $student->lastname }} {{ $student->name }}
                        {{ $student->middlename }}
                    </td>
                    <td class="align-middle p-2">
                        {{ $student->grade_name }}
                    </td>
                    
                     <td class="align-middle p-2">
                        @if ($student->student_average<$pass_rate)
                        <span class="text-danger">{{ $student->student_average}}% </span>
                        @else
                        <span class="text-secondary">{{ $student->student_average}}%</span>
                        @endif
                    </td>

                   
                    <td class="align-middle p-2">
                        @if ($student->loads_count>$student->marks_count)
                        <a href="/analytics/loads/check/{{$student->student_id}}/{{$assessement_id}}/"><span class="text-warning"> {{$student->loads_count}}:{{$student->marks_count}} </span></a>
                        @endif
                        @if ($student->loads_count<$student->marks_count)
                        
                        <a href="/analytics/loads/check/{{$student->student_id}}/{{$assessement_id}}/"><span class="text-danger"> {{$student->loads_count}}:{{$student->marks_count}} </span></a>
                        @endif
                        @if ($student->loads_count==$student->marks_count)
                            
                        <a href="/analytics/loads/check/{{$student->student_id}}/{{$assessement_id}}/"><span class="text-success"> {{$student->loads_count}}:{{$student->marks_count}}</span></a>
                       @endif
                       @if ($student->loads_count<7)
                            
                        <a href="/analytics/loads/check/{{$student->student_id}}/{{$assessement_id}}/"><span class="bg-danger"> {{$student->loads_count}}:{{$student->marks_count}}</span></a>
                       @endif
                    </td>


                    <td class="align-middle p-2">
                        @if ($student->remark =="Passed")
                        <i class="fas fa-check-circle text-success"></i> {{$student->remark}}
                            @else
                            <i class="fas fa-times-circle text-danger"></i>  {{$student->remark}}
                        @endif
                        
                    </td> 


                

                    <td class="align-middle p-2">
                        @if ($student->EnglishLanguage>=$pass_rate)
                        <span class="text-secondary">{{ $student->EnglishLanguage}}% </span>
                       
                   
                        @elseif(is_null($student->EnglishLanguage))
                        -
                        @elseif($student->EnglishLanguage<$pass_rate )
                        <span class="text-danger">{{ $student->EnglishLanguage}}% </span>
                        @endif
                        
                    </td>
                

                    <td class="align-middle p-2">
                       
                        @if ($student->Mathametics>=$pass_rate)
                        <span class="text-secondary">{{ $student->Mathametics}}% </span>
                        @elseif(is_null($student->Mathametics))
                        -
                        @elseif($student->Mathametics<$pass_rate )
                        <span class="text-danger">{{ $student->Mathametics}}% </span>
                        @endif
                        
                    </td>
                  
                      <td>  
                      
                        @if ($student->NaturalScience>=$pass_rate)
                        <span class="text-secondary">{{ $student->NaturalScience}}% </span>
                        @elseif(is_null($student->NaturalScience))
                        -
                        @elseif($student->NaturalScience<$pass_rate )
                        <span class="text-danger">{{ $student->NaturalScience}}% </span>
                        @endif
                    </td>
              
                    <td class="align-middle p-2">
                        
                     
                        @if ($student->PhysicalScience>=$pass_rate)
                        <span class="text-secondary">{{ $student->PhysicalScience}}% </span>
                        @elseif(is_null($student->PhysicalScience))
                        -
                        @elseif($student->PhysicalScience<$pass_rate )
                        <span class="text-danger">{{ $student->PhysicalScience}}% </span>
                        @endif
                    </td>    
                  
                    
                   
                    <td class="align-middle p-2">
         
                     
                        @if ($student->Biology>=$pass_rate)
                        <span class="text-secondary">{{ $student->Biology}}% </span>
                        @elseif(is_null($student->Biology))
                        -
                        @elseif($student->Biology<$pass_rate )
                        <span class="text-danger">{{ $student->Biology}}% </span>
                        @endif
                    </td>

                   

                    <td class="align-middle p-2">
                        @if ($student->Siswati>=$pass_rate)
                        <span class="text-secondary">{{ $student->Siswati}}% </span>
                        @elseif(is_null($student->Siswati))
                        -
                        @elseif($student->Siswati<$pass_rate )
                        <span class="text-danger">{{ $student->Siswati}}% </span>
                        @endif
                    </td>

                   


                    <td class="align-middle p-2">
                        @if ($student->French>=$pass_rate)
                        <span class="text-secondary">{{ $student->French}}% </span>
                        @elseif(is_null($student->French))
                        -
                        @elseif($student->French<$pass_rate )
                        <span class="text-danger">{{ $student->French}}% </span>
                        @endif
                    </td>
                  

                    <td class="align-middle p-2">
                        @if ($student->Geography>=$pass_rate)
                        <span class="text-secondary">{{ $student->Geography}}% </span>
                        @elseif(is_null($student->Geography))
                        -
                        @elseif($student->Geography<$pass_rate )
                        <span class="text-danger">{{ $student->Geography}}% </span>
                        @endif
                    </td>

              


        
                    <td class="align-middle p-2">
                        @if ($student->ConsumerStudies>=$pass_rate)
                        <span class="text-secondary">{{ $student->ConsumerStudies}}% </span>
                        
                        @elseif(is_null($student->ConsumerStudies))
                        -
                        @elseif($student->ConsumerStudies<$pass_rate )
                        <span class="text-danger">{{ $student->ConsumerStudies}}% </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->History>=$pass_rate)
                        <span class="text-secondary">{{ $student->History}}% </span>
                        @elseif(is_null($student->History))
                        -
                        @elseif($student->History<$pass_rate )
                        <span class="text-danger">{{ $student->History}}% </span>
                        @endif
                    </td>
                    <td class="align-middle p-2">
                        @if ($student->BusinessStudies>=$pass_rate)
                        <span class="text-secondary">{{ $student->BusinessStudies}}% </span>
                        @elseif(is_null($student->BusinessStudies))
                        -
                        @elseif($student->BusinessStudies<$pass_rate )
                        <span class="text-danger">{{ $student->BusinessStudies}}% </span>
                        @endif
                    </td>
                    <td class="align-middle p-2">
                        @if ($student->Accounting>=$pass_rate)
                        <span class="text-secondary">{{ $student->Accounting}}% </span>
                        @elseif(is_null($student->Accounting))
                        -
                        @elseif($student->Accounting<$pass_rate )
                        <span class="text-danger">{{ $student->Accounting}}% </span>
                        @endif
                    </td>
                    <td class="align-middle p-2">
                        @if ($student->Economics>=$pass_rate)
                        <span class="text-secondary">{{ $student->Economics}}% </span>
                        @elseif(is_null($student->Economics))
                        -
                        @elseif($student->Economics<$pass_rate )
                        <span class="text-danger">{{ $student->Economics}}% </span>
                        @endif
                    </td>
                    <td class="align-middle p-2">
                        @if ($student->FS_Maths>=$pass_rate)
                        <span class="text-secondary">{{ $student->FS_Maths}}% </span>
                        @elseif(is_null($student->FS_Maths))
                        -
                        @elseif($student->FS_Maths<$pass_rate )
                        <span class="text-danger">{{ $student->FS_Maths}}% </span>
                        @endif
                    </td>

                  
                    <td class="align-middle p-2">
                        @if ($student->ComputerStudies>=$pass_rate)
                        <span class="text-secondary">{{ $student->ComputerStudies}}% </span>
                        @elseif(is_null($student->ComputerStudies))
                        -
                        @elseif($student->ComputerStudies<$pass_rate )
                        <span class="text-danger">{{ $student->ComputerStudies}}% </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->ICT>=$pass_rate)
                        <span class="text-secondary">{{ $student->ICT}}% </span>
                        @elseif(is_null($student->ICT))
                        -
                        @elseif($student->ICT<$pass_rate )
                        <span class="text-danger">{{ $student->ICT}}% </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->FS_CS>=$pass_rate)
                        <span class="text-secondary">{{ $student->FS_CS}}% </span>
                        @elseif(is_null($student->FS_CS))
                        -
                        @elseif($student->FS_CS<$pass_rate )
                        <span class="text-danger">{{ $student->FS_CS}}% </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->EGT>=$pass_rate)
                        <span class="text-secondary">{{ $student->EGT}}% </span>
                        @elseif(is_null($student->EGT))
                        
                        @elseif($student->EGT<$pass_rate )
                        <span class="text-danger">{{ $student->EGT}}% </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->QR>=$pass_rate)
                        <span class="text-secondary">{{ $student->QR}}% </span>
                        @elseif(is_null($student->QR))
                        -
                        @elseif($student->QR<$pass_rate )
                        <span class="text-danger">{{ $student->QR}}% </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->EMS>=$pass_rate)
                        <span class="text-secondary">{{ $student->EMS}}% </span>
                        @elseif(is_null($student->EMS))
                        -
                        @elseif($student->EMS<$pass_rate )
                        <span class="text-danger">{{ $student->EMS}}% </span>
                        @endif
                    </td>
                        
                
                    
                    <td class="align-middle p-2">
                        @if ($student->ActiveCitizenry>=$pass_rate)
                        <span class="text-secondary">{{ $student->ActiveCitizenry}}% </span>
                        @elseif(is_null($student->ActiveCitizenry))
                        -
                        @elseif($student->ActiveCitizenry<$pass_rate )
                        <span class="text-danger">{{ $student->ActiveCitizenry}}% </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->FS_English>=$pass_rate)
                        <span class="text-secondary">{{ $student->FS_English}}% </span>
                        @elseif(is_null($student->FS_English))
                        -
                        @elseif($student->FS_English<$pass_rate )
                        <span class="text-danger">{{ $student->FS_English}}% </span>
                        @endif
                    </td>


                    <td class="align-middle p-2">
                        @if ($student->Music>=$pass_rate)
                        <span class="text-secondary">{{ $student->Music}}% </span>
                        @elseif(is_null($student->Music))
                        -
                        @elseif($student->Music<$pass_rate )
                        <span class="text-danger">{{ $student->Music}}% </span>
                        @endif
                    </td>


                  

               
                </tr>
            @empty
                No Data
            @endforelse

        </tbody>

    </table>
  </div>
              </div>
        
        </div>
            
        </div>     
            
        </div>  

        

        <script>
            $(document).ready(function () {
                $.noConflict();
                var assessement = @json($assessement_name);
                var stream = @json($stream_title);
                var base64=@json($base64);
                var dateNow = new Date();
                var docDefinition = {
  watermark: { text: 'test watermark', color: 'blue', opacity: 0.3, bold: true, italics: false },
  content: [
    '...'
  ]
};

$('#customers').append('<caption style="margin-bottom:30px; fontSize:23px;">Shunifu a product of Innovazania. Proudly Made in Eswatini, Africa</caption>');
var color = '#626262';
                

                $('#customers').DataTable({
                    // scrollY:auto,
                    scrollCollapse: true,
                    paging: false,
                    //scrollX: true,
                    info: true,
                    dom: 'Bfrtip',
                    select: true,

                    "createdRow": function( row, data, dataIndex ) {
                       var str = data[3].replace(/<\/?span[^>]*>/g,"");
                       
    if ( str == "81" ) {
        console.log(str);
      $(row).addClass( 'red' );
    }
  },
                    stateSave: true,
        autoWidth: true,
   
        buttons: [

            {
                extend: 'colvis',
                collectionLayout: 'fixed columns',
                collectionTitle: 'Column visibility control'
            },

            {
            extend: "print",
            customize: function(win)
            {
 
                var last = null;
                var current = null;
                var bod = [];

              
                $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', '10px' );
                     var medias = win.document.querySelectorAll('[media="screen"]');
                     for(var i=0; i < medias.length;i++){ medias.item(i).media="all" };
 
                var css = '@page { size: landscape; }',
                    head = win.document.head || win.document.getElementsByTagName('head')[0],
                    style = win.document.createElement('style');
 
                style.type = 'text/css';
                style.media = 'print';
 
                if (style.styleSheet)
                {
                  style.styleSheet.cssText = css;
                }
                else
                {
                  style.appendChild(win.document.createTextNode(css));
                }
 
                head.appendChild(style);
         }
      },


          {

        extend: 'pdfHtml5',
        exportOptions: {
                columns: ':visible',
                alignment: 'center'
               },
             
               "createdRow": function( row, data, dataIndex ) {
                       var str = data[3].replace(/<\/?span[^>]*>/g,"");
                       
    // if ( str == "81" ) {
    //     console.log(str);
    //   $(row).addClass( 'red' );
    // }
  },
              
            // extend: 'pdfHtml5',  
         //   'colvis',
            title: assessement+' '+stream+' '+'Scoresheet',  
            customize: function (doc) {
                doc.defaultStyle.alignment = 'center';


                var table = $('#customers').DataTable();
                var tbody =  table.data().rows().count();
               
            
                for(var i=0;i<tbody.length;i++){
                 
                }

        //     var titlesi = [];
        
        // $(thead).find('td').each(function(){
        //   titlesi.push($(this).text());
        // });

        console.log(tbody);
    doc.styles.title = {
        color: 'grey',
        fontSize: '30',
        alignment: 'center',
        // font-weight: bold;

    },
    // doc.styles.tableHeader = {
    //     // fillColor: 'red',
       
    //     // font-weight: bold;

    // }

    // doc.styles.tableBodyOdd={
    //     fillColor: 'white',
    //     border:'1px black',
    // }

    doc.styles.message={
        color: '#FFC0CB',
    }
            },  
            orientation: 'landscape',
            pageSize: 'A3',
            header: true,
            text:'Generate PDF',
           
            filename:assessement+'_'+stream+'_scoresheet',
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
        
        $(thead).find('td').each(function(){
          titles.push($(this).text());
        });

        console.log(thead);

    //     $(thead).find('th').each(function(){
    //         $(this).attr('s', '40');
    // });
        
       // console.log(titles);
        
        
         
     
            },
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
  
  