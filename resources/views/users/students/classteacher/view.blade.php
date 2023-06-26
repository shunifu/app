<x-app-layout>
    <x-slot name="header">
      <link rel="stylesheet" type="text/css"
      href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/r-2.2.7/datatables.min.css" />
  

      
    </x-slot>
    
    <div class="row">
      
        <div class="col-md-12 mt-4">

          <div class="card bg-white">
           
         

              <img class="card-img-top"
                  src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1687624917/shunifu_header_5_yjwlrl.png"
                  alt="">
          
     
        
                <div class="card-body">
                    <h3 class="lead">Hi, {{ Auth::user()->name }}</h3>
                    <span class="text-muted"> Use this section to manage data for students in your class. Through this section you will be able to update the student's information.</span>

                <hr>
                <!-- form start -->

                <form action="{{ route('student.removal_selection') }}"  method="POST" enctype="multipart/form-data" >  
                  @csrf
             
                        <div class="table-responsive">
                        
                                        <table class="table table-hover table-bordered " id="customers">
                                          <thead class="thead-light">
                                            <tr>
                                              {{-- <th style="width: 1px;"><input type="checkbox" id="select_all" name="select_all"> --}}
                                                {{-- <label for="students"> All</label></th> --}}
                                                <th>Profile</th>
                                              {{-- <th style="width: 2px;">Status</th> --}}
                                              <th>Surname</th>
                                              <th>Name</th>  
                                              <th>Middlename</th>
                                              <th>Personal Identification Number </th>
                                              <th>Gender</th>
                                           
                                              
                                             <th>View</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            
              @foreach ($students as $item)
            <input type="hidden" name="session" value="{{$item->academic_session_id}}">
              <tr>
              {{-- <td><input type="checkbox" class="students" name="students[]" value="{{$item->user_id}}" ></td> --}}
              <td>  
                {{-- <span style="display:block;width:60px; height:30px;" onclick="document.getElementById('getFile').click()">Image</span>
                <input type='file' id="getFile" style="display:none"> --}}

                <img src="" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
            </td> 
              {{-- <td>
                @if ($item->active==1)
                    <span class="bg-success">Active</span>
                    @else
                    <span class="bg-danger">Inactive</span>
                @endif
                
              </td> --}}
            
              <td><input type="text" name="lastname[]" class="form-control" value="{{$item->lastname}}"/> </td>
              <td> <input type="text" name="name[]" class="form-control" value="{{$item->name}}"/>  </td>
              <td><input type="text" name="name[]" class="form-control" value="{{$item->middlename}} "/> </td>
              <td> <input type="text" name="name[]" class="form-control" value="{{$item->national_id}}"/> </td>
              <td>{{$item->gender}}</td>
          
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

 