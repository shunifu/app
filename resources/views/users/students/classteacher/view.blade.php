<x-app-layout>
    <x-slot name="header">
      <link rel="stylesheet" type="text/css"
      href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/r-2.2.7/datatables.min.css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  

      
    </x-slot>
   
    <div class="row">
        @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
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
                <img id="preview-image" width="300px">
             
                 
             
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
        
         
              <tr>
                <form action="{{ route('student.store_student_updates') }}"  id="{{$item->user_id}}" method="post"  enctype="multipart/form-data" >  
                    @csrf
              <td>  
       
                    @if (is_null($item->profile_photo_path))
                    <img id="icon" class="img-responsive img-rounded" style="max-height: 100px; max-width: 100px;" src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1687803676/Screenshot_2023-06-26_at_8.20.45_PM_xc7daq.png">   
                    @else
                    <img  class="img-responsive img-rounded" style="max-height: 100px; max-width: 100px;" src="{{$item->profile_photo_path}}">
                    @endif
                  
                 
                  <input id="fileInput" type="file" class="inputImage"  name="student_image">
                  <span class="text-danger" id="image-input-error"></span>
            </td> 
            <input type="hidden" name="student_i" value="{{$item->user_id}}" id="student_i">
              <input type="hidden" name="student_id" value="{{$item->user_id}}" id="student_id">
              <input type="hidden" name="class_id" value="{{$item->current_class}}" id="class_id">
              <input type="hidden" name="academic_session" value="{{$session_id}}" id="academic_session">
            
              <td><input type="text" name="lastname" class="form-control" value="{{$item->lastname}}"/> </td>
              <td> <input type="text" name="name" class="form-control" value="{{$item->name}}"/>  </td>
              <td><input type="text" name="middlename" class="form-control" value="{{$item->middlename}} "/> </td>
              <td> <input type="text" name="national_id" class="form-control" value="{{$item->national_id}}"/> </td>
              <td>
              
                <select class="form-control" name="gender" id="gender">
                  <option>{{$item->gender}}</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </td>
          
               <td><button type="submit"  id="image-upload" class="btn btn-secondary btn-sm">Update</button></td> 
            </form>  
              </tr>
          
              @endforeach
                                              
                                        
                                            
                                            </tbody>
                                        </table>
                        </div>
                    
               
              
                                          
                                        </div>
                                        <!-- /.card-body -->
         
          
          
        
        
    
{{-- <hr>  --}}
{{-- <div class="input-group mb-3">

    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Select Action</button>
    <div class="dropdown-menu">
      <button  id="btn_transfer"  value="transfer"   class="btn btn-warning dropdown-item" >Transfer</button>
      <div role="separator" class="dropdown-divider"></div>
      <button type="submit" name="btn" id="btn"  value="archive" class="btn btn-warning dropdown-item" >Archive</button>
      <button type="submit" name="btn" id="btn"  value="unarchive" class="btn btn-warning dropdown-item" >Unarchive</button>
      <button type="submit" name="btn" id="btn"  value="partial_delete" class="btn btn-danger dropdown-item" >Partial Delete</button> 
      <button type="submit" name="btn" id="btn"  value="delete" class="btn btn-danger dropdown-item" >Delete</button> 
    </div>
 
</div> --}}
{{-- <div class="row">
  <div class="col">
    <button type="submit" name="btn" id="btn"  value="archive" class="btn btn-warning" >Archive</button>
  </div>

<div class="col">
  <button type="submit" name="btn" id="btn"  value="delete" class="btn btn-danger" >Delete</button> 
</div>
</div> --}}

{{-- 
<div class="form-group transfer_div">
 
  <label for="">Transfer To</label>
  <select class="form-control" name="transfer_to" id="transfer_to">
    <option value="">Select Class</option>
    @foreach ($classes as $item)
    <option value="{{$item->id}}">{{$item->grade_name}}</option> 
    @endforeach
  </select>



</div> --}}
             
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



      $('#customers').DataTable({
          // scrollY:auto,
          scrollCollapse: true,
          paging: false,
          //scrollX: true,
          info: true,
          dom: 'Bfrtip',
          select: true,
          "info": false
      });

  
      $(window).scrollTop($(window).height()/2);
    $(window).scrollLeft($(window).width()/2);
 //   $(document).scrollTop(100);

    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  
  
  
    $("#").submit(function(e) {
           e.preventDefault();
           let formData = new FormData(this);

          
           $('#image-input-error').text('');
  
           $.ajax({
              type:'POST',
              url: "{{ route('student.store_student_updates') }}",
               data: formData,
               contentType: false,
               processData: false,
               success: (response) => {
                 if (response) {
                   this.reset();
                   alert('Image has been uploaded successfully');
                 }
               },
               error: function(response){
                    $('#image-input-error').text(response.responseJSON.message);
               }
           });
    });
      



  })

</script>



      
      
    
  
    
</x-app-layout>

 