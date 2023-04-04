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
            <div class="mx-auto text-center">

          
          
                <div class="col"><img src={{$item->school_letter_head}}  /></div>
                <div class="col">  <h4 class="text-center  text-bold lead">{{$item->school_name}}</h4></div>
           
            <i class="fas fa-envelope mx-2"></i> {{$item->school_email}} | <i class="fas fa-phone-square    "></i> {{$item->school_telephone}}</i>
                    <p>
                        <h3 class="text-bold">{{$stream_title}}  {{$assessement_name}} Scoresheet</h3>
                    </p>
                
            </div>
           
            @endforeach
          
            </div>

            <hr>
            <span class="text-small">Criteria is as follows;</span>   
            <ul>
             @if ($term_average_rule=="default")
                 Student average is the average of all subjects.
             @else
             Student average is best {{$number_of_subjects}} subjects @if ($passing_subject_rule=="1")
                 inclusive of {{$passing_subject_name}}
 
             @endif
             @endif
            
         
         </ul>          
             <hr>
                         
            <hr>
        <thead class="thead-light hidden-md-up">

        <th><span>Position</span></th> 
        <th><span>Student</span></th>
        <th><span>Class</span></th>
        <th><span>Average</span></th>
         <th><span>Ratio</span></th>
        {{-- <th><span>Comment</span></th> --}}
        @foreach (\App\Models\School::all() as $item)

        @if ($item->school_type=="high-school")
        <th><span>Computer</span> </th>
        <th><span>Eng Lang</span> </th>
        <th><span>Eng Lit</span></th>
        <th><span>Maths</span></th>
        <th><span>Siswati</span></th>
        <th><span>French</span></th>

        @if ($section_id=='2')
        <th><span>Science</span></th> 
        <th><span>HE</span></th>
        <th><span>BK</span></th>
        <th><span>Computer</span></th>
       
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
        @foreach (\App\Models\School::all() as $item)

        @if ($item->school_code=="0083")
       
        <th><span>DTS</span></th>
        @endif
        @endforeach
       @elseif ($item->type=="primary-school")

    <th><span>English Language</span> </th>
    <th><span>Maths</span></th>
    <th><span>Siswati</span></th>
    <th><span>French</span></th>
    <th><span>Science</span></th> 
    <th><span>R.E</span></th>
    <th><span>History</span></th>
    <th><span>SocialStudies</span></th>
    <th><span>PracticalArts</span></th>
    <th><span>GeneralStudies</span></th>
    <th><span>Agriculture</span></th>
    <th><span>ExpressiveArts</span></th>
    <th><span>ICT</span></th>
    <th><span>HPE</span></th>
    <th><span>FineArts</span></th>
    <th><span>SoapCraft</span></th>
    <th><span>ShoeCraft</span></th>
    <th><span>HandCraft</span></th>

        @endif
        @endforeach
        
    
      
        </thead>
        <tbody>

            @forelse($scoresheet as $student)
                <tr>
                  
                    
                    <td class="align-middle p-2">
                        @if ($tie_type=="share")
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
                        WHERE sc.student_stream=".$streamofstudent."  AND sc.assessement_id=".$assessement_id."
                        ORDER BY sc.student_average DESC ) as sub
                        WHERE sub.student_id=".$student->learner_id.""));
                        foreach ($student_position as $key) {
                        echo $key->student_position;
                        }
                        @endphp
                        @endif


                        @if ($tie_type=="share_n_+_1")
                    
                        @php


                    
                    $student_position=\DB::select(\DB::raw("select t.*
from (select assessement_progress_reports.student_id,assessement_progress_reports.student_average, rank() over (order by assessement_progress_reports.student_average desc) as student_position
from assessement_progress_reports where assessement_progress_reports.assessement_id=".$assessement_id." AND assessement_progress_reports.student_stream=".$streamofstudent."
     ) t
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
                        student_average
                        FROM term_averages a
                        CROSS JOIN (SELECT @rownum := 0) params
                        WHERE student_stream =".$streamofstudent." AND term_id=".$term."
                        ORDER BY student_average DESC) as sub
                        WHERE sub.student_id=".$student->learner_id.""));
                        foreach ($student_position as $key) {
                        echo $key->student_position;
                        }
                        
                        
                        @endphp
                        @endif
                    
                    </td>
                  {{-- /  <td class="align-middle p-2">
                        {{ $student->added_marks }} /{{ $student->total_loads }}
                    
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
                        <span class="text-secondary">{{ $student->student_average}}% </span>
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

{{-- 
                    <td class="align-middle p-2">
                        @if ($student->remark =="Passed")
                        <i class="fas fa-check-circle text-success"></i> {{$student->remark}}
                            @else
                            <i class="fas fa-times-circle text-danger"></i>  {{$student->remark}}
                        @endif
                        
                    </td>
                     --}}


                    @foreach (\App\Models\School::all() as $item)

                    @if ($item->schoo_type=="high-school")

                    <td class="align-middle p-2">
                        @if ($student->Computer>=$pass_rate)
                        <span class="text-secondary">{{ $student->Computer}}% </span>
                       
                   
                        @elseif(is_null($student->Computer))
                        -
                        @elseif($student->Computer<$pass_rate )
                        <span class="text-danger">{{ $student->Computer}}% </span>
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
                     
                        @if ($student->EnglishInLiterature>=$pass_rate)
                        <span class="text-secondary">{{ $student->EnglishInLiterature}}% </span>
                        @elseif(is_null($student->EnglishInLiterature))
                        -
                        @elseif($student->EnglishInLiterature<$pass_rate )
                        <span class="text-danger">{{ $student->EnglishInLiterature}}% </span>
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
                    @if ($section_id=="2")
                    <td class="align-middle p-2">
                        
                     
                        @if ($student->Science>=$pass_rate)
                        <span class="text-secondary">{{ $student->Science}}% </span>
                        @elseif(is_null($student->Science))
                        -
                        @elseif($student->Science<$pass_rate )
                        <span class="text-danger">{{ $student->Science}}% </span>
                        @endif
                    </td>    
                  
                    
                   
                    <td class="align-middle p-2">
         
                     
                        @if ($student->HomeEconomics>=$pass_rate)
                        <span class="text-secondary">{{ $student->HomeEconomics}}% </span>
                        @elseif(is_null($student->HomeEconomics))
                        -
                        @elseif($student->HomeEconomics<$pass_rate )
                        <span class="text-danger">{{ $student->HomeEconomics}}% </span>
                        @endif
                    </td>

                   

                    <td class="align-middle p-2">
                        @if ($student->BookKeeping>=$pass_rate)
                        <span class="text-secondary">{{ $student->BookKeeping}}% </span>
                        @elseif(is_null($student->BookKeeping))
                        -
                        @elseif($student->BookKeeping<$pass_rate )
                        <span class="text-danger">{{ $student->BookKeeping}}% </span>
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

                  

                    @endif

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
                        @if ($student->Agriculture>=$pass_rate)
                        <span class="text-secondary">{{ $student->Agriculture}}% </span>
                        @elseif(is_null($student->Agriculture))
                        -
                        @elseif($student->Agriculture<$pass_rate ) 
                        <span class="text-danger">{{ $student->Agriculture}}% </span>
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
                        @if ($student->RE>=$pass_rate)
                        <span class="text-secondary">{{ $student->RE}}% </span>
                        @elseif(is_null($student->RE))
                        -
                        @elseif($student->RE<$pass_rate )
                        <span class="text-danger">{{ $student->RE}}% </span>
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
                        @if ($student->Geography>=$pass_rate)
                        <span class="text-secondary">{{ $student->Geography}}% </span>
                        @elseif(is_null($student->Geography))
                        -
                        @elseif($student->Geography<$pass_rate )
                        <span class="text-danger">{{ $student->Geography}}% </span>
                        @endif
                    </td>

                    @if ($section_id=="1")
                    <td class="align-middle p-2">
                        @if ($student->FoodNutrition>=$pass_rate)
                        <span class="text-secondary">{{ $student->FoodNutrition}}% </span>
                        @elseif(is_null($student->FoodNutrition))
                        -
                        @elseif($student->FoodNutrition<$pass_rate )
                        <span class="text-danger">{{ $student->FoodNutrition}}% </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->FashionFabrics>=$pass_rate)
                        <span class="text-secondary">{{ $student->FashionFabrics}}% </span>
                        @elseif(is_null($student->FashionFabrics))
                        -
                        @elseif($student->FashionFabrics<$pass_rate )
                        <span class="text-danger">{{ $student->FashionFabrics}}% </span>
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
                        
                        @elseif($student->Economics<$pass_rate )
                        <span class="text-danger">{{ $student->Economics}}% </span>
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
                        
                    @endif
                    
                    <td class="align-middle p-2">
                        @if ($student->AdditionalMathametics>=$pass_rate)
                        <span class="text-secondary">{{ $student->AdditionalMathametics}}% </span>
                        @elseif(is_null($student->AdditionalMathametics))
                        -
                        @elseif($student->AdditionalMathametics<$pass_rate )
                        <span class="text-danger">{{ $student->AdditionalMathametics}}% </span>
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

                   
                    @foreach (\App\Models\School::all() as $item)

                    @if ($item->school_code=="0083")
                   
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
                  

               
                </tr>
   

             

                    @elseif($item->schoo_type=="primary-school")

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
                    @if ($section_id=="2")
                    <td class="align-middle p-2">
                        
                     
                        @if ($student->Science>=$pass_rate)
                        <span class="text-secondary">{{ $student->Science}}% </span>
                        @elseif(is_null($student->Science))
                        -
                        @elseif($student->Science<$pass_rate )
                        <span class="text-danger">{{ $student->Science}}% </span>
                        @endif
                    </td>    
                  
                  
                 
                  
                  
                  
                    <td class="align-middle p-2">
         
                     
                        @if ($student->SocialStudies>=$pass_rate)
                        <span class="text-secondary">{{ $student->SocialStudies}}% </span>
                        @elseif(is_null($student->SocialStudies))
                        -
                        @elseif($student->SocialStudies<$pass_rate )
                        <span class="text-danger">{{ $student->SocialStudies}}% </span>
                        @endif
                    </td>

                   

                    <td class="align-middle p-2">
                        @if ($student->PracticalArts>=$pass_rate)
                        <span class="text-secondary">{{ $student->PracticalArts}}% </span>
                        @elseif(is_null($student->PracticalArts))
                        -
                        @elseif($student->PracticalArts<$pass_rate )
                        <span class="text-danger">{{ $student->PracticalArts}}% </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->GeneralStudies>=$pass_rate)
                        <span class="text-secondary">{{ $student->GeneralStudies}}% </span>
                        @elseif(is_null($student->GeneralStudies))
                        -
                        @elseif($student->GeneralStudies<$pass_rate )
                        <span class="text-danger">{{ $student->GeneralStudies}}% </span>
                        @endif
                    </td>

                  

                    @endif

                    <td class="align-middle p-2">
                        @if ($student->ICT>=$pass_rate)
                        <span class="text-secondary">{{ $student->Agriculture}}% </span>
                        
                        @elseif(is_null($student->Agriculture))
                        -
                        @elseif($student->Agriculture<$pass_rate )
                        <span class="text-danger">{{ $student->Agriculture}}% </span>
                        @endif
                    </td>
                    MAX(CASE WHEN subjects.subject_code=109 THEN mark END) AS 'ICT',
                    MAX(CASE WHEN subjects.subject_code=110 THEN mark END) AS 'HPE',
                    MAX(CASE WHEN subjects.subject_code=111 THEN mark END) AS 'FineArts',
                    MAX(CASE WHEN subjects.subject_code=112 THEN mark END) AS 'SoapCraft',
                    MAX(CASE WHEN subjects.subject_code=113 THEN mark END) AS 'ShoeCraft',
                    MAX(CASE WHEN subjects.subject_code=114 THEN mark END) AS 'HandCraft' 
                   
                    <td class="align-middle p-2">
                        @if ($student->ExpressiveArts>=$pass_rate)
                        <span class="text-secondary">{{ $student->ExpressiveArts}}% </span>
                        @elseif(is_null($student->ExpressiveArts))
                        -
                        @elseif($student->ExpressiveArts<$pass_rate )
                        <span class="text-danger">{{ $student->ExpressiveArts}}% </span>
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
                        @if ($student->RE>=$pass_rate)
                        <span class="text-secondary">{{ $student->RE}}% </span>
                        @elseif(is_null($student->RE))
                        -
                        @elseif($student->RE<$pass_rate )
                        <span class="text-danger">{{ $student->RE}}% </span>
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
                        @if ($student->Geography>=$pass_rate)
                        <span class="text-secondary">{{ $student->Geography}}% </span>
                        @elseif(is_null($student->Geography))
                        -
                        @elseif($student->Geography<$pass_rate )
                        <span class="text-danger">{{ $student->Geography}}% </span>
                        @endif
                    </td>

                    @if ($section_id=="1")
                    <td class="align-middle p-2">
                        @if ($student->FoodNutrition>=$pass_rate)
                        <span class="text-secondary">{{ $student->FoodNutrition}}% </span>
                        @elseif(is_null($student->FoodNutrition))
                        -
                        @elseif($student->FoodNutrition<$pass_rate )
                        <span class="text-danger">{{ $student->FoodNutrition}}% </span>
                        @endif
                    </td>

                    <td class="align-middle p-2">
                        @if ($student->FashionFabrics>=$pass_rate)
                        <span class="text-secondary">{{ $student->FashionFabrics}}% </span>
                        @elseif(is_null($student->FashionFabrics))
                        -
                        @elseif($student->FashionFabrics<$pass_rate )
                        <span class="text-danger">{{ $student->FashionFabrics}}% </span>
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
                        
                        @elseif($student->Economics<$pass_rate )
                        <span class="text-danger">{{ $student->Economics}}% </span>
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
                        
                    @endif
                    
                
                 
                  

               
                </tr>


                    @endif
                    @endforeach


                    
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
   
        buttons: [

            {
                extend: 'colvis',
                collectionLayout: 'fixed columns',
                collectionTitle: 'Column visibility control'
            },
          {

            

           

            extend: 'pdfHtml5',
           
           exportOptions: {
                   columns: ':visible',
                    alignment: 'center'
               },
             
           
              
            // extend: 'pdfHtml5',  
         //   'colvis',
            title: assessement+' '+stream+' '+'Scoresheet',  
            customize: function (doc) {
    //             doc.content[1].table.body[0].forEach(function (h) {
    //     h.fillColor = 'green';
    //     alignment: 'center'
    // });
    doc.styles.title = {
        color: '#2D1D10',
        fontSize: '30',
        alignment: 'center',
        // font-weight: bold;

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
        
        $(thead).find('th').each(function(){
          titles.push($(this).text());
        });

    //     $(thead).find('th').each(function(){
    //         $(this).attr('s', '40');
    // });
        
        console.log(titles);
        
        
         
     
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


           
    
                $(document).on('click', '.edit_cell', function (event) {
                    
                event.preventDefault();
                var edit_id = $(this).attr('id');
    
                // alert(edit_id);
                $("#editData").modal('show');
                $.ajax({
                        url: '/parents-student/link/edit/' + edit_id,
                        type: 'GET',
                        data: {
                            edit_id: edit_id
                        },
                    })
                    .done(function (data) {
                        //   alert(data.id);
                        $("#old_mark").val(data.mark);
                        $("#cell_number").val(data.cell_number);
                        $("#name").html(data.name);
    
                        $("#info_update").html(data);
                        $("#editData").modal('show');
    
                    })
                    .fail(function (data) {
                        console.log(data);
                    })
                    .always(function () {
                        console.log("complete");
                    });
    
            });
    
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
  
  