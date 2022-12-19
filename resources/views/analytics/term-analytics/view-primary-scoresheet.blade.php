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
                <h3 class="card-title">{{$title}} Stream Analytics for {{$term_name}}</h3>
            
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

            <div class="col"><img src="{{$item->school_letter_head}}" width="1000px" /></div>
            
            </div>
        
                    <p>
                        <h3 class="text-bold">{{$title}}  {{$term_name}} Scoresheet</h3>
                    </p>
                
            </div>
           
            @endforeach
          
            </div>
                         
            <hr>
        
        <thead class="thead-light hidden-md-up">

           
            @if ($indicator=="manual_promotion" OR $indicator=="scoresheet")
            
           <th>Status</th> 
         @endif
            <th><span>Position</span></th> 
            <th><span>Student</span></th>
            <th><span>Average</span></th>
            <th><span>Comment</span></th>
            <th><span>Class</span></th>

            <th><span>English Language</span></th>
            <th><span>Maths</span></th>
            <th><span>Siswati</span></th>
            <th><span>Science</span></th>
            <th><span>Social Studies</span></th>
            <th><span>RE</span></th>
            <th><span>Agriculture</span></th>
            <th><span>French</span></th>
            <th><span>Consumer</span></th>
            <th><span>PA</span></th>

         
  
         

            @foreach (\App\Models\School::all() as $item)

            @if ($item->school_code=="0563")
            <th><span>Fine Arts</span></th>
            <th><span>Soap Craft</span></th>
            <th><span>Shoe Craft</span></th>
            <th><span>Hand Craft</span></th>
            @endif
            @endforeach
          
    

        </thead>
        <tbody>
           
           
            @forelse($scoresheet as $student)
                <tr>
            @if ($indicator=="manual_promotion" OR $indicator=="scoresheet")
            <td> {{$student->final_term_status}}  </td>
            @endif



            @if ($type_key=="class_based")
            <td class="align-middle p-2">
                @php
                //    if tie type is share, i.e ties share the same position run the query below
                $student_position=\DB::select(\DB::raw("select t.*
                from (select term_averages.student_id,term_averages.student_average, rank() over (order by term_averages.student_average desc) as student_position
                from term_averages where term_averages.term_id=".$term." AND term_averages.student_class=".$int.") t
                where student_id = ".$student->learner_id.""));
                
                foreach ($student_position as $key) {
                echo $key->student_position;
                }
                @endphp
                </td>

                @else

                <td class="align-middle p-2">

                    @php
                  
    $student_position=\DB::select(\DB::raw("select t.*
    from (select term_averages.student_id,term_averages.student_average, rank() over (order by term_averages.student_average desc) as student_position
    from term_averages where term_averages.term_id=".$term." AND term_averages.student_stream=".$stream.") t
    where student_id = ".$student->learner_id.""));
    
    foreach ($student_position as $key) {
    echo $key->student_position ;

    }
    
    @endphp
           
                </td>

            @endif


        
                   
                    <td class="align-middle p-2">
                        {{ $student->lastname }} {{ $student->name }}
                        {{-- {{ $student->middlename }} --}}
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->student_average>= $pass_rate)
                        <span class="text-secondary">{{ ($student->student_average)}} </span>
                        
                        @else
                        <span class="text-danger">{{ ($student->student_average)}} </span>
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
                       
                        @if ($student->Maths>=$pass_rate)
                        <span class="text-secondary">{{ round($student->Maths)}} </span>
                        @elseif(is_null($student->Maths))
                        -
                        @elseif($student->Maths<$pass_rate )
                        <span class="text-danger">{{ round($student->Maths)}} </span>
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
                        
                      
                        @if ($student->Science>=$pass_rate)
                        <span class="text-secondary">{{ round($student->Science)}} </span>
                        @elseif(is_null($student->Science))
                        -
                        @elseif($student->Science<$pass_rate )
                        <span class="text-danger">{{ round($student->Science)}} </span>
                        @endif
                    </td>

                
                    <td class="align-middle p-2">
                        @if ($student->SocialStudies>=$pass_rate)
                        <span class="text-secondary">{{ round($student->SocialStudies)}} </span>
                        @elseif(is_null($student->SocialStudies))
                        -
                        @elseif($student->SocialStudies<$pass_rate )
                        <span class="text-danger">{{ round($student->SocialStudies)}} </span>
                        @endif
                    </td>
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
                        @if ($student->SocialStudies>=$pass_rate)
                        <span class="text-secondary">{{ round($student->SocialStudies)}} </span>
                        @elseif(is_null($student->SocialStudies))
                        -
                        @elseif($student->SocialStudies<$pass_rate )
                        <span class="text-danger">{{ round($student->SocialStudies)}} </span>
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
                        @if ($student->Agriculture>=$pass_rate)
                        <span class="text-secondary">{{ round($student->Agriculture)}} </span>
                        @elseif(is_null($student->Agriculture))
                        -
                        @elseif($student->Agriculture<$pass_rate )
                        <span class="text-danger">{{ round($student->Agriculture)}} </span>
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

                    <td class="align-middle p-2">
                        @if ($student->ICT>=$pass_rate)
                        <span class="text-secondary">{{ round($student->ICT)}} </span>
                        @elseif(is_null($student->ICT))
                        -
                        @elseif($student->ICT<$pass_rate )
                        <span class="text-danger">{{ round($student->ICT)}} </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->Consumer>=$pass_rate)
                        <span class="text-secondary">{{ round($student->Consumer)}} </span>
                        @elseif(is_null($student->Consumer))
                        -
                        @elseif($student->Consumer<$pass_rate )
                        <span class="text-danger">{{ round($student->Consumer)}} </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->PracticalArts>=$pass_rate)
                        <span class="text-secondary">{{ round($student->PracticalArts)}} </span>
                        @elseif(is_null($student->PracticalArts))
                        -
                        @elseif($student->PracticalArts<$pass_rate )
                        <span class="text-danger">{{ round($student->PracticalArts)}} </span>
                        @endif
                    </td>
                   


                    @foreach (\App\Models\School::all() as $item)

                    @if ($item->school_code=="0563")
                    <td class="align-middle p-2">
                        @if ($student->FineArts>=$pass_rate)
                        <span class="text-secondary">{{ $student->FineArts}}% </span>
                        @elseif(is_null($student->FineArts))
                        -
                        @elseif($student->FineArts<$pass_rate )
                        <span class="text-danger">{{ $student->FineArts}}% </span>
                        @endif
                    </td>

              <td class="align-middle p-2">
                        @if ($student->SoapCraft>=$pass_rate)
                        <span class="text-secondary">{{ $student->SoapCraft}}% </span>
                        @elseif(is_null($student->SoapCraft))
                        -
                        @elseif($student->SoapCraft<$pass_rate )
                        <span class="text-danger">{{ $student->SoapCraft}}% </span>
                        @endif
                </td>
                   

                <td class="align-middle p-2">
                    @if ($student->ShoeCraft>=$pass_rate)
                    <span class="text-secondary">{{ $student->ShoeCraft}}% </span>
                    @elseif(is_null($student->ShoeCraft))
                    -
                    @elseif($student->ShoeCraft<$pass_rate )
                    <span class="text-danger">{{ $student->ShoeCraft}}% </span>
                    @endif
            </td>
            <td class="align-middle p-2">
                @if ($student->HandCraft>=$pass_rate)
                <span class="text-secondary">{{ $student->HandCraft}}% </span>
                @elseif(is_null($student->HandCraft))
                -
                @elseif($student->HandCraft<$pass_rate )
                <span class="text-danger">{{ $student->HandCraft}}% </span>
                @endif
             </td>
                    @endif
                    @endforeach
           

                </tr>
                

            

            @empty
                No Data
            @endforelse
           
        </tbody>

    </table>
    <tr>
        <td><button type="submit" name="action" id="promote" value="promote" class="btn btn-primary">Promote Students</button></td>
        <td><button type="submit" name="action" id="another_school" value="another_school" class="btn btn-black">Another School</button></td>
        <td><button type="submit" name="action" id="repeat" value="repeat" class="btn btn-danger">Force Repeat</button></td>
        <td><button type="submit" name="action" id="reset" value="reset" class="btn btn-warning">Reset Statuses</button></td>
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
                var stream = @json($title);
             
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
  
  