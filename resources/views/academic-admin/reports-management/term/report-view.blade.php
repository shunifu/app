<x-app-layout>
    <x-slot name="header">
        <style type="text/css">
            i {
            margin-right: 5px;
            }
            
            textarea {
            border: none;
            background-color: transparent;
            resize: none;
            outline: none;
            height: auto;
            
            }
            input,select{
            color:black;
            }
            #img{
            width: 100px;
            height:auto;
            }
            th {
            background-color: #A9A9A9;
            color: white;
            text-align: center;
            } 
            @media print {
            tr {
            
            }}
            
            @media print {
            th.background {
            background-color: #A9A9A9 !important;
            -webkit-print-color-adjust: exact; 
            color: #FFFFFF !important;
            }}
            
            
            @media all {
            .page-break { display: none; }
            }
            
            @media print {
            .page-break { display: block; page-break-before: always; }
            }
            </style>
    </x-slot>


    @foreach($students as $student_id)
    
       
  
        <div class="card text-left">

            <div class="card-body">
                @foreach($school_info as $school_data)
                    <img src={{ asset('storage/'.$school_data->school_letter_head) }}
                        class="mx-auto d-block" />
                @endforeach

                <hr>
                <table class="table table-bordered">

                    <thead class="btn-secondary">

                        <tr>
                            <th class="background text-center">Student Details</th>
                            <th class="background text-center">Student Photo</th>
                            <th class="background text-center">Term Details</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Student Name: <span class="text-bold">Mnotfo</span>
                                <br>
                                Student Class: <span class="text-bold">Form 1</span>
                                <br>
                                Student Average: <span class="text-bold">23%</span>
                                <br>
                                Student Position: <span class="text-bold"> 1/1 </span>
                                <br>
                                Result: <span class="text-bold">
                                    @if (
                                    $item->student_average>=$pass_rate AND $item->number_of_passed_subjects>=$number_of_subjects AND 
                                    $item->passing_subject_status=1)
                                    
                                    <span class="text-success text-bold">Passed</span> <i class="fas fa-check-circle text-success"></i> 

                                    {{-- @else --}}

                                   <span class="text-danger text-bold">Failed</span> 
                                    <br>
                                </span>

Why {{ $item->name }} didn't make it:<span class="text-bold"></span>
    
<ul>
    
        @if ($item->student_average<$pass_rate)
        <li>
           Low Average 
        </li>
        @endif

       
        @if ($item->number_of_passed_subjects==0)
        <li>
            Failed <span class="text-danger">all</span> subjects
         </li>

         @endif
         @if ($item->number_of_passed_subjects<$number_of_subjects)
 <li>
           Passed only <span class="text-danger">{{$item->number_of_passed_subjects}}</span> subjects
        </li>
        @endif
       
    

        @if ($item->passing_subject_status==0)
        <li>
          Failed Passing Subject
        </li>
        @endif

</ul>
  
    
                                        
                                    @endif
                                
                               
                
                            <td>
                                <center><img class=" img-thumbnail img-fluid mx-auto center" width="200px"
                                        height="200px"
                                        src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1613141854/default-profile-picture-avatar-photo-placeholder-vector-illustration-vector-id1214428300_urpxk5.jpg">
                                </center>

                            </td>

                            <td>
                                Term: <span class="text-bold">k</span>

                                <br>
                                
                                Term Began: <span class="text-bold">
                                    {{ date('d F Y', strtotime($item->start_date))}}
                                </span>
                                <br>
                                Term Ends: 
                                <span class="text-bold">
                                   
                         {{ date('d F Y', strtotime($item->end_date))}}
                                   
                                </span>


                                <br>
                                Next Term Begins: <span class="text-bold">13 December 2020</span>

                                <br>


                            </td>

                        </tr>
                    </tbody>
                </table>

             
                <hr>
                foreah
                <table class="table table-sm table-bordered">
                    <thead class="btn-secondary">
                        <tr class="hope">
                            <th class="background">Subject Name</th>
                            <th class="background">Subject Average</th>
                            <th class="background">Symbol</th>
                            <th class="background">Comment</th>
                           

                        </tr>
                    </thead>
               

                    <tr>
                        <td>{{$item->subject_name}}</td>

                        <td> 
                            @if ($item->mark<$pass_rate)
                            <span class="text-danger">{{$item->mark}}%</span>
                            @else
                            {{$item->mark}}%
                            @endif
                        </td>

                       
                        <td>
                            {{-- @foreach ($comments as $comment_symbol) --}}
                              
                            {{-- @if( in_array($subject->student_average, range($comment_symbol->from,$comment_symbol->to)) ) {
                            
                              {!! $comment_symbol->symbol !!}
                               }
                               @endif --}}
                              
                            
                            </td>
                          <td>
{{-- @foreach ($comments as $comment)
   

@if( in_array($subject->student_average, range($comment->from,$comment->to)) ) {
   {{$comment->comment}}
   }
   @endif
   @endforeach     --}}

</td>
                    </tr>
   
                    {{-- @endforeach --}}

                </table>

                <div class="row">
                    <div class="card col-md-6">
                         
                      <div class="card-body">
                       
                        <p class="card-text">

                            {{-- {{dd($marks[0]->student_id)}} --}}
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



  
    @endforeach
</x-app-layout>