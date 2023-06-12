<x-app-layout>
    <x-slot name="header">
      <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/r-2.2.7/datatables.min.css" />

          
            <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css" rel="stylesheet"/>
            <script>$.fn.poshytip={defaults:null}</script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>
      
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title"><a href="/comments/manage/index"><i class="fas fa-arrow-circle-left"></i></a> Back to Comments </h3>
              </div>
              <!-- /.card-header -->
            

            <img class="card-img-top"
                src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_220,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:Update Comments,w_0.3,y_0.28/v1613303961/pexels-photo-5212359_ukdzdz.jpg"
                alt="">
        
          <div class="card-body">
      
      <p>Hi {{Auth::user()->name}}, This is where you will edit <span class="text-bold">{{$name}}</span>  for <span class="text-bold">{{$section->section_name}}</span> <span class="text-bold"> 
          <br>
          <ol>
              <li>Click on the comment </li>
              <li>Type the data you want</li>
              <li>Click on OK</li>
        
          </ol>
          </span></p>
          You can sort by clicking on the column you want to sort.
       
              <hr>
<div class="table-responsive">


                <table class="table table-hover table-bordered " id="customers">
                  <thead class="thead-light">
                    <tr>
                     
                    <th>Comment</th>
                    <th>Symbol</th>
                    <th>From</th>
                    <th>To</th>
                    
                    <th>Manage</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                      
                        @foreach ($comments as $item)
                        
                        <tr>
                        {{-- {{$item->comment}}  --}}
                        <td><a href="" class="update" data-name="name" data-type="text" data-pk="{{ $item->id }}" data-title="Enter Comment">{{ $item->comment }}</a></td>
                        <td>{{$item->symbol}} </td>
                        <td>{{$item->from}} </td>
                        <td>{{$item->to}} </td>
                       
                       
                    
    <td>  <a href="/comment/manage/delete/{{encrypt($item->id)}}"><i class="fas fa-trash mr-2"></i>Delete</a>
</td>
                        </tr>
                      
                        @endforeach
                      
                        
                    
                    </tbody>
                </table>
</div>
                  
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

<script type="text/javascript">
    $.fn.editable.defaults.mode = 'inline';
  
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{csrf_token()}}'
        }
    }); 
  
    $('.update').editable({
           url: "{{ route('comments.update') }}",
           type: 'text',
           pk: 1,
           name: 'name',
           title: 'Enter Comment'
    });
</script>

    <script>
        $(document).ready(function () {
            $.noConflict();

            $('#customers').DataTable({
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

 