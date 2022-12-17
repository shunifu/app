<x-app-layout>
  <x-slot name="header">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/r-2.2.7/datatables.min.css" />
    
  </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Check Marks</h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.80/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_34_style_light_align_center:Check Marks,w_0.2,y_0.14/v1615202389/Untitled_design_1_oaroft.png" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to check teachers that have or have not added marks<br>
          
            </p>
          
         </div>
        
        </div>
    </div> 
<div class="row">
    
    {{-- <div class="col-md-12"> --}}

        {{-- <div class="card card-light"> --}}
          {{-- <div class="card-header">
            <h3 class="card-title">Select  Assessement</h3>
          </div> --}}
          <!-- /.card-header -->
          <!-- form start -->
          
            {{-- <div class="card-body"> --}}
              
                {{-- <form action="{{route('marks.check_search')}}" method="post">
                    <div class="card-body">
                      
                          @csrf
                         
          
                          <div class="form-group">
                          <x-jet-label>Select Assessement</x-jet-label>
                          <select class="form-control" name="assessement_id">
                            <option value="">Select Assessement</option>
                            @foreach($assessements as $assessement)
                                <option value="{{ $assessement->assessement_id }}">
                                {{ $assessement->assessement_name }}
                                </option>
                            @endforeach
                        </select>
                          @error('assessement')
                          <span class="text-danger">{{$message}}</span>  
                          @enderror
                          </div>
          
          
                         
                    </div>
                    <!-- /.card-body -->
          
                    <div class="card-footer">
                      <x-jet-button>Load Results</x-jet-button>
                    </div>
                 
                </div>
              </form> --}}
              
            {{-- </div> --}}
    
         
        {{-- </div> --}}
    
      {{-- </div> --}}

  <div class="col-md-12">

    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Check Marks</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      
        <div class="card-body">
          
          <table class="table table-responsive" id="check_marks">
            <thead class="bg-light">
              <tr>
               <th>No.</th> 
                <th>Class</th>
                <th>Subject</th>
                <th>Teacher</th>
                <th>Marks Status</th>
                <th>Marks Missing</th>
                <th>Total Learners</th>
              </tr>
          </thead>
          <tbody>

             
               @foreach ($check as $item)

             @foreach ($item as $check_data)
                 
            <?php

           


            ?>

               
               <tr>
                 <td>{{$loop->iteration}}</td>
                <td>{{$check_data->grade_name}}</td>
                <td>{{$check_data->subject_name}}</td>
                <td>{{$check_data->salutation}} {{$check_data->name}} {{$check_data->lastname}} </td>
               
                @if ($check_data->total_loads==0)
                <td>
                NO Students in load
                </td>

                <td>
                 -
                  </td>
                  <td>
                    {{$check_data->total_loads}} leaners
                     </td>

                @else

                <td>

       
                  @if ((($check_data->total_loads)-($check_data->marks_count))==0)
                  <i class="fas fa-check-circle text-success"></i> Completed
                
                  @else
                  <i class="fas fa-exclamation-triangle text-danger"></i> Not Completed
                  @endif
               
              </td>

              <td>
                @if ((($check_data->total_loads)-($check_data->marks_count))==0)
                <i class="fas fa-check-circle text-success"></i> None
              
                @else
                <i class="fas fa-exclamation-triangle text-danger"></i> {{($check_data->total_loads-$check_data->marks_count)}} missing
                @endif
              </td>

              <td>
                {{$check_data->total_loads}} Leaners
              </td>
            @endif
                
                
                {{-- <td>
                 <a href="/academic-admin/class/view/" class="link"><i class="fas fa-eye"></i> View Student(s)</a>
                
                 </td> --}}
                
             </tr>
                   
               @endforeach
               
               @endforeach

              </tr>
              
            </tbody>
          </table>
        </div>

     
    </div>

  </div>
      
    </div>   
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/r-2.2.7/datatables.min.js">
    </script>
    
    <script>
      $(document).ready(function () {
          $.noConflict();

          $('#check_marks').DataTable({
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