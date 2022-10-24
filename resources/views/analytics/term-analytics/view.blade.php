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
                <h3 class="card-title">Stream Analytics for {{$term_name}}</h3>
              </div>
            
            <div class="card-body">
             
              <hr>
              <div class="p-4"></div>
  
         
              <div class="table-responsive">
 
  
  
  
  </div>
  
  <div class="table-responsive">
    <form action="/promote/students" method="POST">
        @csrf
    <table class="table table-sm table-hover mx-auto table-bordered " style="width:100%" id="customers">
        <div class="col-md-12 mx-auto">

            @foreach (\App\Models\School::all() as $item)
            <div class="mx-auto text-center">

          
            <div class="row mx-auto" style="width:auto; display:block">

                {{-- @if($item->school_code=='0387') --}}
                    <div class="col"><img src="{{$item->school_letter_head}}" width="1000px" /></div>
                {{-- @elseif($item->school_code=='1077')
                <div class="col"><img src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1647866756/shunifu/letter_head_1077.jpg" width="1000px" /></div> --}}
             
                
            </div>
               
            
                
                    {{-- <i class="fas fa-envelope mx-2"></i> {{$item->school_email}} | <i class="fas fa-phone-square    "></i> {{$item->school_telephone}}</i> --}}
                    <p>
                        <h3 class="text-bold">{{$stream_title}}  {{$term_name}} Scoresheet</h3>
                    </p>
                
            </div>
           
            @endforeach
          
            </div>
                         
            <hr>
        
        <thead class="thead-light hidden-md-up">
        {{-- <th>Action</th>
        <th>Status</th> --}}
        
        <th><span>Student</span></th>
        <th><span>Class</span></th>
       
      
        <th><span>English Language</span> </th>
        <th><span>English Lit</span></th>
        <th><span>Maths</span></th>
        <th><span>Siswati</span></th>
        <th><span>French</span></th>

        @if ($section_id=='2')
        <th><span>Science</span></th> 
        <th><span>HE</span></th>
        <th><span>BK</span></th>
        @endif

        <th><span>BS</span></th>  
        <th><span>Agri</span></th>
        <th><span>ICT</span></th>
        <th><span>R.E</span></th>
        <th><span>History</span></th>
        <th><span>Geo</span></th>

        @if ($section_id=='1')
        <th><span>FN</span></th>
        <th><span>FF</span></th>
       
        <th><span>Accounting</span></th>
        <th><span>Economics</span></th>
        <th><span>Physical Science</span></th>
        <th><span>Biology</span></th>
        @endif
        <th><span>Add Maths</span></th>
        <th><span>D&T</span></th>
        <th><span>Average</span></th>
        <th><span>Position</span></th> 
        <th><span>Comment</span></th>
        </thead>
        <tbody>
           
           
            @forelse($scoresheet as $student)
                <tr>
                    
                   
                    <td class="align-middle p-2">
                        {{ $student->lastname }} {{ $student->name }}
                        {{-- {{ $student->middlename }} --}}
                    </td>
                    <td class="align-middle p-2">
                        {{ $student->grade_name }}
                    </td>
                    
                    
                    <td class="align-middle p-2">
                        @if ($student->EnglishLanguage>=$pass_rate)
                        <span class="text-secondary">{{ round($student->EnglishLanguage)}} </span>
                       
                   
                        @elseif(is_null($student->EnglishLanguage))
                        -
                        @elseif($student->EnglishLanguage<$pass_rate )
                        <span class="text-danger">{{round($student->EnglishLanguage)}} </span>
                        @endif
                        
                    </td>
                    <td class="align-middle p-2">
                     
                        @if ($student->EnglishInLiterature>=$pass_rate)
                        <span class="text-secondary">{{ round($student->EnglishInLiterature)}} </span>
                        @elseif(is_null($student->EnglishInLiterature))
                        -
                        @elseif($student->EnglishInLiterature<$pass_rate )
                        <span class="text-danger">{{round ($student->EnglishInLiterature)}} </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                       
                        @if ($student->Mathametics>=$pass_rate)
                        <span class="text-secondary">{{ round($student->Mathametics)}} </span>
                        @elseif(is_null($student->Mathametics))
                        -
                        @elseif($student->Mathametics<$pass_rate )
                        <span class="text-danger">{{ round($student->Mathametics)}} </span>
                        @endif
                        
                    </td>
                    <td class="align-middle p-2">
                       
                        @if ($student->Siswati>=$pass_rate)
                        <span class="text-secondary">{{round ($student->Siswati)}} </span>
                        @elseif(is_null($student->Siswati))
                        -
                        @elseif($student->Siswati<$pass_rate )
                        <span class="text-danger">{{round($student->Siswati)}} </span>
                        @endif
                    </td>
                    
                    <td class="align-middle p-2">
                        
                      
                        @if ($student->French>=$pass_rate)
                        <span class="text-secondary">{{ round($student->French)}} </span>
                        @elseif(is_null($student->French))
                        -
                        @elseif($student->French<$pass_rate )
                        <span class="text-danger">{{ round($student->French)}} </span>
                        @endif
                    </td>
                    @if ($section_id=="2")
                    <td class="align-middle p-2">
                        
                     
                        @if ($student->Science>=$pass_rate)
                        <span class="text-secondary">{{ round($student->Science)}} </span>
                        @elseif(is_null($student->Science))
                        -
                        @elseif($student->Science<$pass_rate )
                        <span class="text-danger">{{ round($student->Science)}} </span>
                        @endif
                    </td>    
                  
                    
                   
                    <td class="align-middle p-2">
         
                     
                        @if ($student->HomeEconomics>=$pass_rate)
                        <span class="text-secondary">{{ round($student->HomeEconomics)}} </span>
                        @elseif(is_null($student->HomeEconomics))
                        -
                        @elseif($student->HomeEconomics<$pass_rate )
                        <span class="text-danger">{{ round($student->HomeEconomics)}} </span>
                        @endif
                    </td>

                   

                    <td class="align-middle p-2">
                        @if ($student->BookKeeping>=$pass_rate)
                        <span class="text-secondary">{{ round($student->BookKeeping)}} </span>
                        @elseif(is_null($student->BookKeeping))
                        -
                        @elseif($student->BookKeeping<$pass_rate )
                        <span class="text-danger">{{round($student->BookKeeping)}} </span>
                        @endif
                    </td>

                  

                    @endif

                    <td class="align-middle p-2">
                        @if ($student->BusinessStudies>=$pass_rate)
                        <span class="text-secondary">{{ round($student->BusinessStudies)}} </span>
                        
                        @elseif(is_null($student->BusinessStudies))
                        -
                        @elseif($student->BusinessStudies<$pass_rate )
                        <span class="text-danger">{{ round($student->BusinessStudies)}} </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->Agriculture>=$pass_rate)
                        <span class="text-secondary">{{ round($student->Agriculture)}} </span>
                        @elseif(is_null($student->Agriculture))
                        -
                        @elseif($student->Agriculture<$pass_rate )
                        <span class="text-danger">{{ round($student->Agriculture)}} </span>
                        @endif
                    </td>
                    <td class="align-middle p-2">
                        @if ($student->ICT>=$pass_rate)
                        <span class="text-secondary">{{round($student->ICT)}} </span>
                        @elseif(is_null($student->ICT))
                        -
                        @elseif($student->ICT<$pass_rate )
                        <span class="text-danger">{{ round($student->ICT)}} </span>
                        @endif
                    </td>
                    <td class="align-middle p-2">
                        @if ($student->RE>=$pass_rate)
                        <span class="text-secondary">{{ round($student->RE)}} </span>
                        @elseif(is_null($student->RE))
                        -
                        @elseif($student->RE<$pass_rate )
                        <span class="text-danger">{{ round($student->RE)}} </span>
                        @endif
                    </td>
                    <td class="align-middle p-2">
                        @if ($student->History>=$pass_rate)
                        <span class="text-secondary">{{ round($student->History)}} </span>
                        @elseif(is_null($student->History))
                        -
                        @elseif($student->History<$pass_rate )
                        <span class="text-danger">{{ round($student->History)}} </span>
                        @endif
                    </td>
                    <td class="align-middle p-2">
                        @if ($student->Geography>=$pass_rate)
                        <span class="text-secondary">{{ round($student->Geography)}} </span>
                        @elseif(is_null($student->Geography))
                        -
                        @elseif($student->Geography<$pass_rate )
                        <span class="text-danger">{{round($student->Geography)}} </span>
                        @endif
                    </td>

                    @if ($section_id=="1")
                    <td class="align-middle p-2">
                        @if ($student->FoodNutrition>=$pass_rate)
                        <span class="text-secondary">{{ round($student->FoodNutrition)}} </span>
                        @elseif(is_null($student->FoodNutrition))
                        -
                        @elseif($student->FoodNutrition<$pass_rate )
                        <span class="text-danger">{{ round($student->FoodNutrition)}} </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->FashionFabrics>=$pass_rate)
                        <span class="text-secondary">{{ round($student->FashionFabrics)}} </span>
                        @elseif(is_null($student->FashionFabrics))
                        -
                        @elseif($student->FashionFabrics<$pass_rate )
                        <span class="text-danger">{{ round($student->FashionFabrics)}} </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->Accounting>=$pass_rate)
                        <span class="text-secondary">{{round($student->Accounting)}} </span>
                        @elseif(is_null($student->Accounting))
                        -
                        @elseif($student->Accounting<$pass_rate )
                        <span class="text-danger">{{ round($student->Accounting)}} </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->Economics>=$pass_rate)
                        <span class="text-secondary">{{ round($student->Economics)}} </span>
                        @elseif(is_null($student->Economics))
                        
                        @elseif($student->Economics<$pass_rate )
                        <span class="text-danger">{{ round($student->Economics)}} </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->PhysicalScience>=$pass_rate)
                        <span class="text-secondary">{{ round($student->PhysicalScience)}} </span>
                        @elseif(is_null($student->PhysicalScience))
                        -
                        @elseif($student->PhysicalScience<$pass_rate )
                        <span class="text-danger">{{ round($student->PhysicalScience)}} </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->Biology>=$pass_rate)
                        <span class="text-secondary">{{round($student->Biology)}} </span>
                        @elseif(is_null($student->Biology))
                        
                        @elseif($student->Biology<$pass_rate )
                        <span class="text-danger">{{ round($student->Biology)}} </span>
                        @endif
                    </td>
                        
                    @endif
                    
                    <td class="align-middle p-2">
                        @if ($student->AdditionalMathametics>=$pass_rate)
                        <span class="text-secondary">{{ round($student->AdditionalMathametics)}} </span>
                        @elseif(is_null($student->AdditionalMathametics))
                        
                        @elseif($student->AdditionalMathametics<$pass_rate )
                        <span class="text-danger">{{ round($student->AdditionalMathametics)}} </span>
                        @endif
                    </td>
                    <td class="align-middle p-2">
                        @if ($student->DesignTechnology>=$pass_rate)
                        <span class="text-secondary">{{ $student->DesignTechnology}}% </span>
                        @elseif(is_null($student->DesignTechnology))
                        -
                        @elseif($student->DesignTechnology<$pass_rate )
                        <span class="text-danger">{{ $student->DesignTechnology}}% </span>
                        @endif
                    </td>
                    

                    

                    <td class="align-middle p-2">
                        @if ($student->student_average>= $pass_rate)
                        <span class="text-secondary">{{ ($student->student_average)}} </span>
                        
                        @else
                        <span class="text-danger">{{ ($student->student_average)}} </span>
                        @endif
                    </td>

                   
                    <td class="align-middle p-2">


                    
                        @php
                      
 //    if tie type is share, i.e ties share the same position run the query below


      // $sql_piece="where term_averages.term_id=".$term." AND term_averages.student_stream=".$stream."";

//  dd($ter);

$student_position=\DB::select(\DB::raw("select t.*
from (select term_averages.student_id,term_averages.student_average, rank() over (order by term_averages.student_average desc) as student_position
from term_averages where term_averages.term_id=".$term." AND term_averages.student_stream=".$stream.") t
where student_id = ".$student->learner_id.""));

foreach ($student_position as $key) {


echo $key->student_position ;



}



@endphp
             
                    
                     

                    
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->remark =="Passed")
                        <i class="fas fa-check-circle text-success"></i> {{$student->remark}}
                            @else
                            <i class="fas fa-times-circle text-danger"></i>  {{$student->remark}}
                        @endif
                        
                    </td> 
            


                </tr>
                

            </form>

            @empty
                No Data
            @endforelse
           
        </tbody>

    </table>
    <tr>

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
                var base64=@json($base64);
                var dateNow = new Date();
                // var class=@json($student->grade_name);
 

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
    //                 image: @json($base64)
    //             });
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
  
  