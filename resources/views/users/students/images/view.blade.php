<x-app-layout>
    <x-slot name="header">
      <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/r-2.2.7/datatables.min.css" />
            @cloudinaryJS

    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title"><a href="#"><i class="fas fa-arrow-circle-left"></i></a> Add Student Images</h3>
              </div>



              {{-- <form action="/student/image/upload" method="POST" enctype="multipart/form-data">
                @csrf<input id="upload" name="student_image" type="file"/> <input type="hidden" name="student_id[]" value='+item.id+'><button type="submit" class="btn"><i class="fa fa-check"></i></button></form> --}}


              <!-- /.card-header -->
         
                <div class="card-body">
                  
<div class="table-responsive">

                <table class="table table-hover table-bordered " id="customers">

   
                  <thead class="thead-light">
                    <tr>
                      <th>No.</th>
                      <th>Current Image</th>
                      <th>Student Surname</th>
                      <th>Student Names</th>
                      <th>Manage</th>
                    </tr>
                    </thead>
                    <tbody>
                     

                            @foreach ($students as $item)
                            <tr>
                            <td>
                              {{$loop->iteration}}
                          
                            </td>
                            <td><img src="{{$item->profile_photo_path}}" class="profile-user-img img-responsive img-circle img-small" alt="">  </td>
                            <td>{{$item->lastname}}  </td>
                            <td>{{$item->name}} {{$item->middlename}}</td>
                        <td>

                            {{-- <x-cld-upload-button>
                                Upload Files
                            </x-cld-upload-button> --}}
                            <form action="/student/image/upload" method="POST" enctype="multipart/form-data">
                                @csrf
                            <input id="upload" name="student_image"  placeholder="Choose files" type="file"/> 
                            <input type="hidden" name="student_id" value="{{$item->id}}">
                            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                        </form>
                        </td>
                      


                            </tr>
                           
                          
                            @endforeach
                             
                           
                         

                    
                    </tbody>
               <tr>
                 <td><button type="submit" class="btn btn-primary" id="submit">Submit</button></td>
               </tr>
                     
                                  
                      
             
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

            $(document).on('click', '.edit_cell', function (event) {
                
            event.preventDefault();
            var edit_id = $(this).attr('id');

            // alert(edit_id);
            $("#editData").modal('show');
            $.ajax({
                    url: '/parents-student/link/edit/' + edit_id,
                    type: 'GET',
                    data: {
                        edit_id: edit_id
                    },
                })
                .done(function (data) {
                    //   alert(data.id);
                    $("#old_mark").val(data.mark);
                    $("#cell_number").val(data.cell_number);
                    $("#name").html(data.name);

                    $("#info_update").html(data);
                    $("#editData").modal('show');

                })
                .fail(function (data) {
                    console.log(data);
                })
                .always(function () {
                    console.log("complete");
                });

        });

        })

    </script>

    <script type="text/javascript">

        $(document).on('click', '#update', function (event) {
            event.preventDefault();
            //Do checks if field is empty
            $.ajax({
                    url: '/marks/update/',
                    type: 'POST',
                    data: $("#updateForm").serialize(),
                })
                .done(function (data) {
                    $("#editData").modal('hide');
                    location.reload();
                    alert('Mark successfully  updated');
                    //    $('.toast').toast('show');


                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    console.log("complete");
                });


        });

    </script>
    
</x-app-layout>

 