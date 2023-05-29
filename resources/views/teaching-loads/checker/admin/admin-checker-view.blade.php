<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" type="text/css"
              href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/r-2.2.7/datatables.min.css" />
        
      </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light  ">
              <div class="card-header">
                <h3 class="card-title"><a href="admin/check/loads/"><i class="fas fa-arrow-circle-left"></i> Back to Teaching Loads <i class="fas fa-check-circle    "></i> </a> </h3>
              </div>
              <!-- /.card-header -->
           
  
                  <img class="card-img-top" src=" https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_290,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:Manage Teaching Loads,w_0.3,y_0.28/v1613334423/pexels-photo-5965544_fhctzy.jpg" alt="">
                  <div class="card-body">
                    <h3 class="lead">Hi, {{Auth::user()->salutation}} {{Auth::user()->name}} {{Auth::user()->lastname}}</h3>
                   <div class="text-muted">
                    <hr>
                      <p class="card-text"> Below are teaching loads for the whole of {{$stream->stream_name}}. You can filter the results by subject, teacher and class.<br> If you want to view the students in each teaching load, you can click on the <strong>view students link</strong>, under the <strong>Manage</strong> column.
                        
                    
                      </p>
                    
                   </div>
                  
                  </div>
           
       
                <div class="card-body">

                    

                  <table class="table table-sm table-hover " id="view_loads">
                  <thead class="thead-light">
                    <tr>
                      {{-- <th>Select</th> --}}
                    <th>Class</th>
                    <th>Subject</th>
                    <th>Teacher</th>
                    <th>Manage</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($getLoad as $item)
                    <tr>
                   {{-- <td><input type="checkbox" name="item" id="item"></td> --}}
                    <td>{{$item->grade_name}}</td>
                    <td>{{$item->subject_name}}</td>
                    <td>{{$item->salutation}} {{$item->lastname}} {{$item->name}} {{$item->middlename}}  </td>
                    
    <td> 
      <a href="{{route('teaching_loads.view-checker',$item->id)}}"><i class="fas fa-eye mr-1"></i> View Students</a> 
      <span class="m-4 "></span>

      <a href="{{route('teaching_loads.view-checker',$item->id)}}"><i class="fas fa-eye mr-1"></i> Subject Register</a> 
      <span class="m-4 "></span>
      
                        </tr>
                        
                        @endforeach
                      
                        
                    
                    </tbody>
                </table>
                  
                </div>
                <!-- /.card-body -->
      
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

            $('#view_loads').DataTable({
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

 