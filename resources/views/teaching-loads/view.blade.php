<x-app-layout>
    <x-slot name="header">
      <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/cr-1.5.3/r-2.2.7/datatables.min.css" />
      
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title"><a href="/users/teacher/loads/manage"><i class="fas fa-arrow-circle-left"></i></a> Teaching Loads for {{Auth::user()->name}} {{Auth::user()->lastname}}</h3>
              </div>
              <!-- /.card-header -->

              <div class="card text-left">
                <img class="card-img-top" src="holder.js/100px180/" alt="">
                <div class="card-body">
                  
                  <p class="card-text">   Hi, this is where you will be able to select students that you either want to archive or remove from this teaching load.</p>
                </div>
              </div>
      
            

              
       <form action="/teaching-loads/archive" method="POST">
        @csrf
                <div class="card-body">
<div class="table-responsive">


                <table class="table table-hover table-bordered " id="customers">
                  <thead class="thead-light">
                    <tr>
                        <th><input type="checkbox" id="select_all" name="select_all">
                            <label for="students">Select All</label></th>
                      <th>Student Surname</th>
                      <th>Student Names</th>
                      {{-- <th>Manage</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                    
                      
                        @foreach ($view_loads as $item)
                        <tr>
                        <td>
                    <input type="hidden" name="student_load_id[]" value="{{$item->student_load_id}}">
                    <input type="checkbox" class="students" name="students[]" value="{{$item->student_id}}" >
                    <input type="hidden" name="teaching_load_id[]" value="{{$item->teaching_load_id}}">
                      
                        </td>
                        <td>{{$item->lastname}}  </td>
                        <td>{{$item->name}} {{$item->middlename}}</td>
                    
    {{-- <td>  <a href="/users/teacher/loads/student/delete/{{$item->id}}/{{$item->student_id}}"><i class="fas fa-trash mr-2"></i>Delete</a>
    </td> --}}
                        </tr>
                      
                        @endforeach
                      
                        
                    
                    </tbody>
                  
                </table>
                <br>

                <div class="form-group">
                 
                  <label for="">Choose Action</label>
                <select name="action" id="action" class="form-control">
                    <option value="">Select Action</option>
                    <option value="archive">Archive</option>
                    <option value="delete">Delete</option>
                </select>
                
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success col-md-2">Submit</button>
                 
                  </div>
                </form>
                
                {{-- <div class="input-group mb-3">

                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Select Action</button>
                    <div class="dropdown-menu">
                      <button type="submit" id="btn_archive"  value="archive"   class="btn btn-warning dropdown-item" >Archive</button>
                      <div role="separator" class="dropdown-divider"></div>
                     
                      <button type="submit" name="btn" id="btn"  value="delete" class="btn btn-danger dropdown-item" >Delete</button> 
                    </div>
                 
                </div> --}}
</div>
                  
                </div>
            </form>
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
                info: false,
                dom: 'Bfrtip',
                "bSort": false,
                "bInfo": false,
                select: true,
                
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

            $(document).on('click', '.btn_archive', function (event) {
                
            event.preventDefault();
         
            //get all the checkbox values
            // alert(edit_id);
            $("#confirmation").modal('show');
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

    {{-- <script type="text/javascript">

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

    </script> --}}
    
</x-app-layout>

 