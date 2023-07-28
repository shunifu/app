<x-app-layout>
    <x-slot name="header">
      <link rel="stylesheet" type="text/css"
      href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/r-2.2.7/datatables.min.css" />
      
    </x-slot>
    
    <div class="row">
        {{-- <div class="col-md-12">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Remove Students </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('student.removal_index')}}" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-row">
                      <div class="col-md-6 form-group">
                        <x-jet-label> Class Name</x-jet-label>
                       <select class="form-control" name="grade_id">
                        <option value="0">Select Class</option>
                        @foreach ($classes as $class)
                        <option value="{{$class->id}}">{{$class->grade_name}}</option>
                            
                        @endforeach
                       </select>
                        @error('class')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                        

                            <div class="col-md-6 form-group">
                                <x-jet-label> Academic Year</x-jet-label>
                               <select class="form-control" name="academic_session">
                                <option value="">Select Academic Year</option>
                                @foreach ($sessions as $session)
                                <option value="{{$session->id}}">{{$session->academic_session }}</option>
                                @endforeach
                               </select>
                                @error('session')
                                <span class="text-danger">{{$message}}</span>  
                                @enderror
                            </div>
                </div>
                </div>
                <!-- /.card-body -->
      
                <div class="card-footer">
                  <x-jet-button>Load Students</x-jet-button>
                </div>
            </form>


            </div>
      
      
        </div> --}}
        <div class="col-md-12 mt-4">

          <div class="card bg-white">
           
              <div class="card-header">
                  <h3 class="card-title">Solve Student Issues</h3>
              </div>

              <img class="card-img-top"
                  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_220,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:Student Issues,w_0.3,y_0.28/v1613303961/pexels-photo-5212359_ukdzdz.jpg"
                  alt="">
          
            <div class="card-body">
        
        <p>Hi {{Auth::user()->name}}, This is where you will sort student issues ranging from transfers to deleting and archiving of students from the system. <span class="text-bold"> 
            <br>
            <ol>
              <li>Transfer </li>
              <ul><li>This is used when you want to transfer students from one class to another</li></ul>

              <p></p>
                <li>Archive </li>
                <ul><li>This is used when you want to remove the students from the active repository</li></ul>

                <p></p>
                <li>Un-Archive </li>
                <ul><li>This is used when you want to restore an archived student</li></ul>

                <p></p>
                <li>Full Deletion Method</li>
                <ul><li>This is used when you want to remove the student from system permanently</li></ul>
                <p></p>
                <li>Partial Deletion Method</li>
                <ul><li>This is used when you want to remove the student from the grade he/she is in permanently</li></ul>
            </ol>
             </p>
              <p class="card-text">

                <form action="{{ route('student.removal_selection') }}" method="POST">  
                  @csrf
                 
                    <div class="card-body">
                        <div class="table-responsive">
                        
                                        <table class="table table-hover table-bordered " id="customers">
                                          <thead class="thead-light">
                                            <tr>
                                              <th><input type="checkbox" id="select_all" name="select_all">
                                                <label for="students">Select All</label></th>
                                                <th>Student Status</th>
                                              <th>Student Surname</th>
                                              <th>Student Names</th>
                                              
                                              <th>Student Class</th>
                                             <th>Manage</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            
              @foreach ($students as $item)
            <input type="hidden" name="session" value="{{$item->academic_session_id}}">
              <tr>
              <td><input type="checkbox" class="students" name="students[]" value="{{$item->user_id}}" ></td>
              <td>
                @if ($item->active==1)
                    <span class="bg-success">Active</span>
                    @else
                    <span class="bg-danger">Inactive</span>
                @endif
                
              </td>
              <td>{{$item->lastname}} </td>
              <td>{{$item->name}} {{$item->middlename}}  </td>
              <td>{{$item->grade_name}}</td>
              <td><a href="/users/profile/student/{{$item->user_id}}">Check Profile</a></td>
              <input type="hidden" name="current_class" value="{{$item->current_class}}">
              </tr>
              @endforeach
                                              
                                                
                                            
                                            </tbody>
                                        </table>
                        </div>
                                          
                                        </div>
                                        <!-- /.card-body -->
         
          
          
        
        
    
<hr> 
<div class="input-group mb-3">

    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Select Action</button>
    <div class="dropdown-menu">
      <button  id="btn_transfer"  value="transfer"   class="btn btn-warning dropdown-item" >Transfer</button>
      <div role="separator" class="dropdown-divider"></div>
      <button type="submit" name="btn" id="btn"  value="merge" class="btn btn-warning dropdown-item" >Merge</button>
      <div role="separator" class="dropdown-divider"></div>
      <button type="submit" name="btn" id="btn"  value="archive" class="btn btn-warning dropdown-item" >Archive</button>
      <button type="submit" name="btn" id="btn"  value="unarchive" class="btn btn-warning dropdown-item" >Unarchive</button>
      <button type="submit" name="btn" id="btn"  value="partial_delete" class="btn btn-danger dropdown-item" >Partial Delete</button> 
      <button type="submit" name="btn" id="btn"  value="delete" class="btn btn-danger dropdown-item" >Delete</button> 
    </div>
 
</div>
{{-- <div class="row">
  <div class="col">
    <button type="submit" name="btn" id="btn"  value="archive" class="btn btn-warning" >Archive</button>
  </div>

<div class="col">
  <button type="submit" name="btn" id="btn"  value="delete" class="btn btn-danger" >Delete</button> 
</div>
</div> --}}


<div class="form-group transfer_div">
 
  <label for="">Transfer To</label>
  <select class="form-control" name="transfer_to" id="transfer_to">
    <option value="">Select Class</option>
    @foreach ($classes as $item)
    <option value="{{$item->id}}">{{$item->grade_name}}</option> 
    @endforeach
  </select>

<button type="submit" value="transfer" name="btn" class="btn btn-secondary">Transfer</button>

</div>
             
            </form>
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


      $(".transfer_div").hide();

      $("#btn_transfer").click(function (e) { 
      e.preventDefault();
      
        $(".transfer_div").show();
      });


     
      $('#select_all').change(function() {


$('.students').prop("checked", this.checked);

});

$('.students').change(function() {

if ($('input:checkbox:checked.students').length === $("input:checkbox.students").length) {
  $('#select_all').prop("checked", true);
} else {
  $('#select_all').prop("checked", false);
}

})

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

 