<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Class Sequencing</h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_320,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_32_style_light_align_center:Class Mapping,w_0.3,y_0.20/v1617761938/pexels-tima-miroshnichenko-6549340_lhnivg.jpg" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to map classes. This is what the system will use to transition students to the next class. <br>
          
            </p>
          
         </div>
        
        </div>
    </div>  

<div class="row">


    
  <div class="col-md-4">

    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">Class Mapping</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <div class="errList">

        </div>

        

        <form action="{{route('sequence.store')}}" method="post">
            @csrf
          <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <x-jet-label>Origin</x-jet-label>
                            <select class="form-control" name="from">
                                <option value="">Select Class</option>
                                @foreach ($classes as $from)
                              
                                <option value="{{$from->id}}">{{$from->grade_name}}</option>
                                @endforeach
                                </select>
                            @error('from')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <x-jet-label>Destination</x-jet-label>
                           <select class="form-control" name="destination">
                            <option value="">Select Class</option>
                           @foreach ($classes as $to)
                           <option value="{{$to->id}}">{{$to->grade_name}}</option>
                           @endforeach
                           <option value="0">End of School</option>
                           </select>
                            @error('to')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>
                    </div>
                </div>
               
        
               
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <x-jet-button>Map Class</x-jet-button>
          </div>
       
      </div>
    </form>

  </div>

  <div class="col-md-8">

    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title"> Class Mapping List</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      
        <div class="card-body">
          <div id="success">

          </div>
          <table class="table table-bordered table table-hover table w-100 d-print-block d-print-table ">
            <thead class="thead-light">
              <tr>
                <th>Maps From</th>
                <th>Maps To</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <tr>
               @foreach ($class_data as $item)
               <tr>
                   <td>{{$item->origin_name}}</td>
                   <td>{{$item->destination_name}}</td>     
                   <td><a href="#" class="btn btn-danger delete" id="{{$item->id}}">Delete</td>                 
                </tr>
               @endforeach
              </tr>
            </tbody>
          </table>
        </div>

     
    </div>

  </div>
      
    </div> 
   
    <script>
      $(document).ready(function () {

       
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(".delete").click(function (e) { 
  e.preventDefault();

  //var id=$('#delete').attr('id');
  var id = $(this).attr("id");
  //var id2=($id);



  if (confirm("Are you sure you want to delete the selected mapping")) {
    $.ajax({
      type: "GET",
      url: "/class-sequencing/delete/"+id,
      data: {id},
      dataType: "json",
    }).done(function(data) {

     
      if (data.status==400) {

        $(".errList").html(" ");
        $('.errList').addClass('alert alert-danger');

      $('.errList').append("Error, could not delete");
        
      } else {

        $(".errList").html(" ");
        $('#success').addClass('alert alert-success');
      $('#success').text(data.message);
      
     // $("#success").removeClass('alert alert-success').setTimeout((345));
      

    //  location.reload();
        
      }
    
      }).fail(function(data) {
        
    });
  }
  
});
      });
    </script>
            
     
    
</x-app-layout>