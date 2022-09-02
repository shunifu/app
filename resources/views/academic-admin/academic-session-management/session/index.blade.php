<x-app-layout>
  <x-slot name="header">

  </x-slot>
  <div class="card card-light  ">
    <div class="card-header">
      <h3 class="card-title">Academic Session</h3>
    </div>

    
      <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.60/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_35_style_light_align_center:Academic Calendar,w_0.2,y_0.28/v1615231896/Untitled_design_7_bahmem.png" alt="">
      <div class="card-body">
        <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
       <div class="text-muted">
          <p class="card-text"> Use this section to manage the school's academic sessions. <br>
        
          </p>
        
       </div>
      
      </div>
  </div> 
<div class="row">
  
<div class="col-sm-4 col-md-4">

  <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Add Academic Session</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{route('session.store')}}" method="post">
        <div class="card-body">
          
          @csrf
        <div class="form-group">
            <x-jet-label>Select Academic Year</x-jet-label>
            <x-jet-input name="academic_year"  type="text" placeholder="Add Academic Year" ></x-jet-input>
            @error('academic_year')
            <span class="text-danger">{{$message}}</span>  
            @enderror
           
        </div>
       
       <div class="form-check form-check-inline">
         <label class="form-check-label">
           <input class="form-check-input" type="checkbox" name="make_active" id="make_active" value="true"> Make Active
         </label>
       </div>



             
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <x-jet-button>Add Academic Session </x-jet-button>
        </div>
     
    </div>
  </form>

</div>

<div class="col-md-8">

  <div class="card card-light">
    <div class="card-header">
      <h3 class="card-title">Manage Academic Sessions</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    
      <div class="card-body">
      <div class="responsive">
        <table class="table  table-hover table-responsive-sm">
          <thead class="thead-light">
            <tr>
              <th>Academic Year</th>
              <th>Terms</th>
              <th>Status</th>
              <th>Manage</th>
            </tr>
          </thead>
          <tbody>
            <tr>
             @foreach ($academic_sessions as $academic_session)
             <tr>
                 <td>{{$academic_session->academic_session}}</td>
                 <td><a href="/view/terms/{{$academic_session->id}}">View Terms</a></td>
                 <td>
                   @if ($academic_session->active==1)
                       <button class="btn btn-sm btn-success">Active</button>

                       @else
                       <button class="btn btn-sm btn-danger ">Inactive</button>
                   @endif
                   
                  </td>
                 
                 
                 <td>
                  
                  {{-- <a href="/academic-admin/session/view/{{$academic_session->id}}"><button  class="btn btn-light "><i class="fas fa-eye"> </i> View</button></a> --}}
                  <a href="/academic-admin/session/edit/{{$academic_session->id}}"><button class="btn btn-light"><i class="fas fa-edit"> </i> Edit</button></a>
                  {{-- <a href="/academic-admin/terms/delete/{{$academic_session->id}}"><button  class="btn btn-light"><i class="fas fa-trash"> </i> Delete</button></a> --}}
                  {{-- <a href="/academic-admin/terms/delete/" class="link px-3 mx-2"><i class="fas fa-trash "></i>Delete</a> --}}
                   
                  
                  </td>
                 
              </tr>
             
             
             @endforeach
            </tr>
            
          </tbody>
        </table>
      </div>
       
      </div>

   
  </div>

</div>
    
  </div>   
  <script>
    $(document).ready(function () {
        var i = 1;
        $('#submit').hide();
        $('#add_input').click(function () {
        
            i++;
            $("#dynamic").append('<p></p><label>Term Name</label><div class="input-group" id="row' + i +
                '"><div class="col" id="dynamic"><div class="form-group"><input type="text" class="form-control" name="term_name[]" placeholder="Term Name"></div><div class="form-group"><label>Term Opening Date</label><input type="date" class="form-control" name="opening_date[]" placeholder="Opening Date"></div><div class="form-group"><label>Term Closing Date</label><input type="date" class="form-control" name="closing_date[]" placeholder="Closing Date"></div><hr class="btn-danger"></div> '
                );
            $('#submit').show();
        });


        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });



    });

</script>
          
   
  
</x-app-layout>