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
                <h3 class="card-title">{{$stream_title}} Stream Analytics for {{$term_name}}</h3>
            
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

           
            @if ($indicator=="manual_promotion" OR $indicator=="scoresheet")
            <th>Action</th>
           <th>Status</th> 
         @endif
            <th><span>Position</span></th> 
            <th><span>Student</span></th>
            <th><span>Average</span></th>
            <th><span>Comment</span></th>
            <th><span>Class</span></th>
          
      
        <th><span>Eng Lan</span> </th>
        <th><span>Eng Lit</span></th>
        <th><span>Maths</span></th>
        <th><span>Siswati</span></th>
        <th><span>French</span></th>

        @if ($section_id=='2')
        <th><span>Sci</span></th> 


        @foreach (\App\Models\School::all() as $item)

        @if ($item->school_code=="0083" OR $item->school_code=="1037")
        <th><span>DS</span></th> 
        @endif
        @endforeach

     
        <th><span>HE</span></th>
        <th><span>BK</span></th>
        @endif

        <th><span>BS</span></th>  
        <th><span>Agri</span></th>
        <th><span>ICT</span></th>
        <th><span>R.E</span></th>
        <th><span>His</span></th>
        <th><span>Geo</span></th>

        @if ($section_id=='1')
        <th><span>FN</span></th>
        <th><span>FF</span></th>
       
        <th><span>ACC</span></th>
        <th><span>ECON</span></th>
        <th><span>Phy-Science</span></th>
        <th><span>Bio</span></th>
        <th><span>BioCore</span></th>
        @endif

        @foreach (\App\Models\School::all() as $item)

        @if ($item->school_code=="0315" OR $item->school_code=="1037" )
        <th><span>RM</span></th>
        <th><span>GP</span></th>
        @endif
        @endforeach
        <th><span>Add Maths</span></th>
        <th><span>D&T</span></th>
        <th><span>Comp</span></th>


        @foreach (\App\Models\School::all() as $item)

        @if ($item->school_type=="Prevoc")

        <th><span>PrevocICT</span></th>
        <th><span>FT Tech</span></th>
        <th><span>TechStudies</span></th>
        <th><span>Entrep</span></th>
        <th><span>AgcriTech</span></th>
        {{-- <th><span>AS</span></th> --}}
        <th><span>BA</span></th>
        @endif
        @endforeach
    
        </thead>
        <tbody>
           
           
            @forelse($scoresheet as $student)
                <tr>
                  
                    @if ($indicator=="manual_promotion" OR $indicator=="scoresheet")

            <td><input type="checkbox" class="students" name="students[]" value="{{$student->student_id}}" ></td>
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
    from term_averages INNER JOIN users ON users.id=term_averages.student_id where term_averages.term_id=".$term." AND term_averages.student_stream=".$stream.") t
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


                     @foreach (\App\Models\School::all() as $item)

                    @if ($item->school_code=="0083" OR $item->school_code=="1037")
                   
                    <td class="align-middle p-2">
                        @if ($student->DS>=$pass_rate)
                        <span class="text-secondary">{{ $student->DS}}% </span>
                        @elseif(is_null($student->DS))
                        -
                        @elseif($student->DS<$pass_rate )
                        <span class="text-danger">{{ $student->DS}}% </span>
                        @endif
                    </td>
                    @endif
                    @endforeach
                  
                    
                   
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

                    <td class="align-middle p-2">
                        @if ($student->Biocore>=$pass_rate)
                        <span class="text-secondary">{{round($student->Biocore)}} </span>
                        @elseif(is_null($student->Biocore))
                        
                        @elseif($student->Biocore<$pass_rate )
                        <span class="text-danger">{{ round($student->Biocore)}} </span>
                        @endif
                    </td>

                    
                        
                    @endif


                    @foreach (\App\Models\School::all() as $item)

                  @if ($item->school_code=="0315" OR $item->school_code=="1037" )
                   
                   
                    <td class="align-middle p-2">
                        @if ($student->RM>=$pass_rate)
                        <span class="text-secondary">{{ $student->RM}}% </span>
                        @elseif(is_null($student->RM))
                        -
                        @elseif($student->RM<$pass_rate )
                        <span class="text-danger">{{ $student->RM}}% </span>
                        @endif
                    </td>
                    <td class="align-middle p-2">
                        @if ($student->GP>=$pass_rate)
                        <span class="text-secondary">{{ $student->GP}}% </span>
                        @elseif(is_null($student->GP))
                        -
                        @elseif($student->GP<$pass_rate )
                        <span class="text-danger">{{ $student->GP}}% </span>
                        @endif
                    </td>
                    
                    @endif
                    @endforeach
                    
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
                        @if ($student->Computer>=$pass_rate)
                        <span class="text-secondary">{{ $student->Computer}}% </span>
                        @elseif(is_null($student->Computer))
                        -
                        @elseif($student->Computer<$pass_rate )
                        <span class="text-danger">{{ $student->Computer}}% </span>
                        @endif
                    </td>


                    @foreach (\App\Models\School::all() as $item)

                    @if ($item->school_type=="Prevoc")
                    <td class="align-middle p-2">
                        @if ($student->PrevocICT>=$pass_rate)
                        <span class="text-secondary">{{ $student->PrevocICT}}% </span>
                        @elseif(is_null($student->PrevocICT))
                        -
                        @elseif($student->PrevocICT<$pass_rate )
                        <span class="text-danger">{{ $student->PrevocICT}}% </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->FoodTextileTechnology>=$pass_rate)
                        <span class="text-secondary">{{ $student->FoodTextileTechnology}}% </span>
                        @elseif(is_null($student->PrevocICT))
                        -
                        @elseif($student->FoodTextileTechnology<$pass_rate )
                        <span class="text-danger">{{ $student->FoodTextileTechnology}}% </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->TechnicalStudies>=$pass_rate)
                        <span class="text-secondary">{{ $student->TechnicalStudies}}% </span>
                        @elseif(is_null($student->TechnicalStudies))
                        -
                        @elseif($student->TechnicalStudies<$pass_rate )
                        <span class="text-danger">{{ $student->TechnicalStudies}}% </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->Entreprenuership>=$pass_rate)
                        <span class="text-secondary">{{ $student->Entreprenuership}}% </span>
                        @elseif(is_null($student->Entreprenuership))
                        -
                        @elseif($student->Entreprenuership<$pass_rate )
                        <span class="text-danger">{{ $student->Entreprenuership}}% </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->AgiculturalTechnology>=$pass_rate)
                        <span class="text-secondary">{{ $student->AgiculturalTechnology}}% </span>
                        @elseif(is_null($student->AgiculturalTechnology))
                        -
                        @elseif($student->AgiculturalTechnology<$pass_rate )
                        <span class="text-danger">{{ $student->AgiculturalTechnology}}% </span>
                        @endif
                    </td>  
                    {{-- <td class="align-middle p-2">
                        @if ($student->AS>=$pass_rate)
                        <span class="text-secondary">{{ $student->AS}}% </span>
                        @elseif(is_null($student->AS))
                        -
                        @elseif($student->AS<$pass_rate )
                        <span class="text-danger">{{ $student->AS}}% </span>
                        @endif
                    </td>  --}}

                    <td class="align-middle p-2">
                        @if ($student->BusinessAccounting>=$pass_rate)
                        <span class="text-secondary">{{ $student->BusinessAccounting}}% </span>
                        @elseif(is_null($student->BusinessAccounting))
                        -
                        @elseif($student->BusinessAccounting<$pass_rate )
                        <span class="text-danger">{{ $student->BusinessAccounting}}% </span>
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
  
  