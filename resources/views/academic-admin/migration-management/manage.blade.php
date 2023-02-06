<x-app-layout>
    <x-slot name="header">
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/r-2.2.7/datatables.min.css" />
    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                    <h3 class="card-title">Student Migration Management</h3>
                </div>

                <img class="card-img-top"
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_220,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:Student Migration,w_0.3,y_0.28/v1613303961/pexels-photo-5212359_ukdzdz.jpg"
                    alt="">
                <div class="card-body">
                    <h3 class="lead">Hi, {{ Auth::user()->name }}</h3>
                    <div class="text-muted">
                        <p class="card-text"> Use this section to migrate students to new academic session/year.<br>
                            Students will be migrated to thier respective classes based on thier performance. 
                            <ul>
                                <li>Those that <span class="text-bold">passed</span> in the previous academic year will proceed to the  class. </li>
                                <li>Those that got <span class="text-bold">promoted</span> in the previous academic year will proceed to the  class. </li>
                                <li>Those that <span class="text-bold">passed</span> in the previous academic year will remain in that class. </li>
                                <li>Those with <strong>Try Another School</strong> in the previous academic year will be archived. </li>
                            </ul>

                        </p>
                        <hr>
Please note that if you want to change a students status, please go back to Insights Dashboard and select Term Insights and use Summerized Scoresheet and select the appropiate status for that student.
                    </div>

                </div>

            </div>

     

            <form action="{{route('transition.store')}}" method="post" name="migration" id="migration_form">
                @csrf
            <div class="card text-left">
              
              <div class="card-body">

            
             
                
             <table id="migration_table" class="table table-hover table-centered align-middle table-nowrap mb-0 table-responsive-md table-bordered" >
                    <thead class="thead-light">
                        <tr>
                         
                            <th>Last Name</th>
                            <th>Name</th>
                            <th>Middlename</th>
                            <th>Current Class</th>
                            @if ($scope=="external")
                            <th>Migration Status</th>
                            @endif
                          
                                
                           
                            <th>Next Class <i class="fas fa-info-circle " data-toggle="tooltip" data-placement="top" title="The class the student will migrate to when you click on Migrate Students"></th>

                                @if ($scope=="internal")
                            <th>Result  <i class="fas fa-info-circle " data-toggle="tooltip" data-placement="top" title="If you want to change the result of the student, go to Insights Dashboard, then go Term Insights"></th>
                             @endif
                             
                            
                        </tr>
                    </thead>


                    @if ($scope=="internal")
                        
                   
                   
                    <tbody class="response_data">

                        @foreach ($students as $item)
                     
                      
                        <tr>
                         
                     
                            <td>{{$item->lastname}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->middlename}}</td>
                            <td>{{$item->grade_name}}</td>
                            <td>
                            <?php
                            $next_class_qry=\DB::select(\DB::raw("SELECT grades.id as origin_id, grades.grade_name as origin, b.grade_name as destination_class, b.id as destination_id FROM class_sequences INNER JOIN grades ON grades.id=class_sequences.origin INNER JOIN grades b ON b.id=class_sequences.destination where class_sequences.origin=".$item->grade_id.""));

                           

                            foreach ($next_class_qry as $key) {
                          
                           
                               

                                if($item->result=="Repeat"){
                                    echo $key->origin;
                                    ?>
                                    <input type="hidden" name="destination_class[]" value="{{$key->origin_id}}"> 

                                    <?php
                                }

                                if( $item->result=="Try Another School"){
                                    echo "<strong>Akabuyi</strong>";
                                    ?>
                                    <input type="hidden" name="destination_class[]" value="0"> 

                                    <?php
                                }
                                
                                

                                if($item->result=="Proceed" OR $item->result=="Promoted"){
                                    echo $key->destination_class;
                                    ?>
                                    <input type="hidden" name="destination_class[]" value="{{$key->destination_id}}"> 

                                    <?php
                                }
                                   
                                
                            
                               
                            }
                            ?>
                            </td>
                            

                            <td>

                                @if ($item->result=="Proceed")
                                    <span class="bg-green"> {{$item->result}}</span>
                                @endif

                                @if ($item->result=="Promoted")
                                <span class="bg-yellow"> {{$item->result}}</span>
                            @endif

                            @if ($item->result=="Repeat")
                            <span class="bg-red"> {{$item->result}}</span>
                        @endif

                        @if ($item->result=="Try Another School")
                        <span class="bg-gray"> {{$item->result}}</span>
                    @endif
                                
                               </td>
                          
                            <input type="hidden" name="student_id[]" value="{{$item->student_id}}"> 
                            <input type="hidden" name="student_name[]" value="{{$item->name}}"> 
                            <input type="hidden" name="student_result[]" value="{{$item->result}}"> 
                            <input type="hidden" name="from_session[]" value="{{$from_session}}"> 
                            <input type="hidden" name="to_session[]" value="{{$to_session}}"> 
                            <input type="hidden" name="current_class[]" value="{{$current_class}}"> 
                            <input type="hidden"  name="final_stream_status" value="{{$final_stream_status}}">
                            <input type="hidden"  name="scope" value="internal">
                          
                        </tr>
                        @endforeach
                    </tbody>
               @elseif($scope=="external")

              
             

               <tbody class="response_data">

                   @foreach ($students as $item)
                
                 
                   <tr>
                    
                
                       <td>{{$item->lastname}}</td>
                       <td>{{$item->name}}</td>
                       <td>{{$item->middlename}}</td>
                       <td>{{$item->grade_name}}</td>
                       <td>

                    
                   
                       
                        <select class="form-control" name="destination_class[]" required id="">
                            <option value="">Choose Class</option>
                        
                            @foreach ($stream_sequence as $new_class)
                          <option value="{{$new_class->id}}">{{$new_class->grade_name}}</option>
                          @endforeach
                          <option value="0">Did not return</option>
                        </select>
                     
                     
                      
                       </td>
                       

                       <td>

                        
                           
                     </td>
                     
                       <input type="hidden" name="student_id[]" value="{{$item->student_id}}"> 
                       <input type="hidden" name="student_name[]" value="{{$item->name}}"> 
                       
                       <input type="hidden" name="from_session[]" value="{{$from_session}}"> 
                       <input type="hidden" name="to_session[]" value="{{$to_session}}"> 
                       <input type="hidden" name="current_class[]" value="{{$current_class}}"> 
                       <input type="hidden"  name="final_stream_status" value="{{$final_stream_status}}">
                       <input type="hidden"  name="scope" value="external">
                     
                   </tr>
                   @endforeach
               </tbody>



               @endif
                
                </table>

              </div>
              <div class="card-footer">
                <x-jet-button>Migrate Students </x-jet-button>
              </div>
            </div>
        </form>


        </div>


    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/r-2.2.7/datatables.min.js">
    </script>

    <script>
        $(document).ready(function () {
            $.noConflict();

            $('#migration_table').DataTable({
                // scrollY:auto,
                scrollCollapse: true,
                paging: false,
                //scrollX: true,
                info: true,
                dom: 'Bfrtip',
                select: true,
            });


        })

    </script>

  
 

</x-app-layout>
