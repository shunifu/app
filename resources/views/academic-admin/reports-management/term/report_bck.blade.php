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


  

@foreach ($report as $item)
    

      {{-- {{print_r($item)}} --}}
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
                            Student Name: <span class="text-bold">{{$item['0']->lastname}} {{$item['0']->middlename}} {{$item['0']->name}} {{$item['0']->student_id}}</span>
                            <br>
                            Student Average: <span class="text-bold">{{$item['0']->student_average}}%</span>
                            <br>
                            Student Position: <span class="text-bold"> {{$loop->iteration}} </span>
                            <br>
                            Result: <span class="text-bold">
@if ($item['0']->student_average>=$pass_rate AND $item['0']->number_of_passed_subjects>=$number_of_subjects AND $item['0']->passing_subject_status=1)
                                
<span class="text-success text-bold">Passed</span> <i class="fas fa-check-circle text-success"></i> 

@else

<span class="text-danger text-bold">Failed</span> 
                                <br>
                            </span>

Why {{ $item['0']->name }} didn't make it:<span class="text-bold"></span>

<ul>

    @if ($item['0']->student_average<$pass_rate)
    <li>
       Low Average 
    </li>
    @endif

   
    @if ($item['0']->number_of_passed_subjects==0)
    <li>
        Failed <span class="text-danger">all</span> subjects
     </li>

     @endif
     @if ($item['0']->number_of_passed_subjects<$number_of_subjects)
     <li>
       Passed only <span class="text-danger">{{$item['0']->number_of_passed_subjects}}</span> subjects
    </li>
    @endif
   


    @if ($item['0']->passing_subject_status==0)
    <li>
      Failed Passing Subject
    </li>
    @endif

</ul>

@endif

                        </td>
                                    
                            
                            
                           
            
                        <td>
                            <center><img class=" img-thumbnail img-fluid mx-auto center" width="200px"
                                    height="200px"
                                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1613141854/default-profile-picture-avatar-photo-placeholder-vector-illustration-vector-id1214428300_urpxk5.jpg">
                            </center>

                        </td>

                        <td>
                           
                    
                            Student Class: <span class="text-bold">{{$item['0']->grade_name}}</span>
                            <br>
                            Student Stream: <span class="text-bold">{{$item['0']->stream_name}}</span>
                           
                            <br>
                            Student Section: <span class="text-bold">{{$item['0']->section_name}}</span>
                           
                            <br>
                            Report Generated: <span class="text-bold">{{date('d F Y H:i')}}</span>

                            <br>
                          


                        </td>

                    </tr>
                        
                 
 
                       
                    </tbody>
                </table>
              

                <table class="table table-sm table-bordered">
                    <thead class="btn-secondary">
                        <tr class="hope">
                            <th class="background">Subject Name</th>
                            <th class="background">Subject Average</th>
                            <th class="background">Symbol</th>
                            <th class="background">Comment</th>
                           

                        </tr>
                    </thead>

    
                    @foreach($item as $index=>$item2)
                    @if($index != 0)
                      <tr>
                         <td> {{ $item2->subject_name }}  </td>
                         <td> 
                            @if ($item2->student_average<$pass_rate)
                            <span class="text-danger">{{$item2->student_average}}%</span>
                            @else
                            {{$item2->student_average}}%
                            @endif
                        </td>

                        <td>
                            @foreach ($comments as $comment_symbol)
                              
                            @if( in_array($item2->student_average, range($comment_symbol->from,$comment_symbol->to)) ) {
                            
                              {{$comment_symbol->symbol }}
                               }
                               @endif

                               @endforeach
                              
                            </td>

                            <td>
                                @foreach ($comments as $comment)
                                
                                
                                @if( in_array($item2->student_average, range($comment->from,$comment->to)) ) {
                                {{$comment->comment}}
                                }
                                @endif
                                
                                </td>

                                @endforeach

                      </tr>
                    @endif
                  @endforeach
                 
                       
   
                    </tr>
                   
               </table> 
               
       
    

            </div>
        </div>

      
        @endforeach
  
</x-app-layout>