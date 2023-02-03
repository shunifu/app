<x-app-layout>
    <x-slot name="header">
        <style>
            .profile-head {
                transform: translateY(5rem)
            }

            .cover {
                background-image: url(https://res.cloudinary.com/innovazaniacloud/image/upload/v1637780425/pexels-photo-5905710_pjgdj9.jpg);
                background-size: cover;
                background-repeat: no-repeat
            }

        </style>
 
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/colreorder/1.5.6/css/colReorder.bootstrap4.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.bootstrap4.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.css"/>

    </x-slot>

            @include('partials.marks-header')


            <div class="mb-4">

            </div>

            <div class="col-md-12 ">
                <div class="card card-light   elevation-3">
                    <div class="card-header">
                        <a href="/marks/">
                            <h3 class="card-title p4"><i class="fas fa-hand-point-left mr-2"></i> Back </h3>
                        </a>
                    </div>
                    <div class="card-body">
                        <p class="text-gray-700 mb-1 2h-base">
                           {{\Spatie\Emoji\Emoji::waving_hand()}}{{ Auth::user()->name }}.  You are adding <span class="text-bold">{{ $loads_description['0']->subject_name }} {{ $assessement_description->assessement_name }}</span> marks for students in the following class(es).
                            <ul>
                            @foreach ($loads_description as $item)
                            <li><span class="text-bold">{{ $item->grade_name }}</span></li>
                            @endforeach
                         
                            </ul>
                       {{-- //    .text-gray-700 mb-1 2h-base --}}

                            <hr>

                             <p class="text-gray-700 mb-1 2h-base">
                                <strong>Important Note:</strong><br>
                                <ul>

                     <li>         
                    Please ensure that the data you are entering reflects the data in your official scheme book. 
                    Siyabonga  {{\Spatie\Emoji\Emoji::hugging_face()}}
                </li>  
<p></p> 
                <li>
                    If you want to <span class="text-bold">CHANGE or edit a mark </span> , click on the green button. After clicking on the green button a pop up will show where you will be able to change/edit the mark of the student.
                </li>
                </ul>
             
                                    <hr>
                                </p> 
                            
                            
                            <div class="table-responsive">

                                <form action="{{ route('marks.store') }}" method="post" id="marksform">
                                    @csrf
                                    <table class="table table-sm table-hover mx-auto table-bordered " id="marks_table">

                                        <thead class="thead-light hidden-md-up">

                                            {{-- <th width="3px">Remove</th> --}}
                                            <th>Surname</th>
                                            <th>Name</th>
                                            <th>Mark</th>

                                        </thead>
                                        <tbody>

                                          
                                            @forelse($students as $student)
                                                <tr>

                                                    <input type="hidden" id="student_id"  name="student_id[]"
                                                        value="{{ $student->student_id }} ">
                                                    <input id="teaching_load_id" type="hidden" name="teaching_load_id[]"
                                                        value="{{ $student->teaching_load_id }}">
                                                    <input type="hidden" name="teacher_id[]"
                                                        value="{{ Auth::user()->id }}">

                                                    <input type="hidden" name="assessement_id[]"
                                                        value="{{ $assessement_id }} ">

                                                         {{-- <td width="3px">    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x text-danger remove_load" id="{{$student->student_id}}" viewBox="0 0 16 16">
                                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                          </svg></td> --}}

                                                          <td class="align-middle p-2">
                                                            {{ $student->lastname }} 
                                                          </td>
                                                            <td class="align-middle p-2">
                                                            
                           {{ $student->name }}
                            {{ $student->middlename }} 
                            <span class="text-bold text-italic">{{trim(strstr($student->grade_name," "));}}</span>
                                                            </td>


<td class="align-middle">
   @if (is_null($student->mark))
   <div class="input-group">
    <input type="number" min="0" max="100"   id="marks" class="form-control" placeholder="Mark" name="marks[]">  
   <div class="input-group-append">
    </div>  
</div>
   @else
<div class="input-group">
<input type="number" readonly  min="0" max="100"  id="marks" class="form-control" placeholder="Mark" name="marks[]" value="{{$student->mark}}"> 
<div class="input-group-append">
<button class="btn btn-success edit_marks" id="{{$student->mark_id}}" type="button"> <i class="fas fa-edit"></i></button>
</div>
{{-- <div class="input-group-append">
    <button class="btn btn-danger remove_student" id="{{$student->student_id}}" type="button"> <i class="fas fa-user-times"></i></button>
    
    </div>  --}}
</div>
  
   @endif

</td>
</td>
</tr>
                                            @empty
                                              No mark
                                            @endforelse

                                        </tbody>


                                    </table>
                                    <x-jet-button class="float-right col-sm-2" id="add_mark_btn">Add Marks</x-jet-button>
                                </form>

                            </div>
                    </div>
                </div>
            </div>

            
    <!-- Button trigger modal -->
  
    
    <!-- Modal -->
    <div class="modal fade" id="response" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">System Response</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body msg">
                   
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button type="button"  id="close" class="btn btn-primary">OK</button>
                </div>
            </div>
        </div>
    </div>
    
      
      <!-- Modal -->
      <div class="modal fade" id="deleteLoad" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Remove Student From Teaching Load</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                  </div>
                  <div class="modal-body">
        You are about to remove <span class="text-bold" id="student_fullname"></span> <span class="text-bold" id="student_middlename"></span>  <span class="text-bold" id="student_lastname"></span>  from your <span class="text-bold" id="teaching_load_class"></span>-<span class="text-bold" id="teaching_load"></span> teaching load. To continue click on the yes button  
                  </div>
                  <form action="#" method="POST" id="removeForm">
                    @csrf
                    <input type="hidden" id="student_load_id" name="student_load_id">
                    <input type="hidden" id="student_id_is" name="student_id_is">
                    <input type="hidden" id="teaching_load_id_is" name="teaching_load_id_is">
                    
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" id="removeLoadBtn" class="btn btn-danger">Yes, Susa!</button>
                  </div>
                  </form>
              </div>
          </div>
      </div>

           
            <div class=" modal fade" id="editData">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form action="#" method="POST" id="updateForm">
                        @csrf
                    <!-- Modal Header -->
                    <div class="modal-header">
                    
                     <h5 class=" text-muted lead">Update Student Mark</h5>
                    </div>
              
                    <!-- Modal body -->
                   <div class="modal-body">
                    
                        You are about to change  <span class="text-bold" id="name"> </span>'s   <span id="subject"> </span> <span id="assessement"> </span> mark. To continue to change the current mark, enter the new mark in new mark field and then click update.
                        <hr>
                     {{-- <div id="info_update" class="text-bold"> --}}
                         <label class="label-control">Current Mark</label>
                        <input type="text" class="form-control" id="old_mark" name="old_mark"  readonly placeholder="New Mark">

                     {{-- </div> --}}
                     <p></p>
                     
                     
                        <label class="label-control">New Mark</label>
                        <input type="number" class="form-control" id="new_mark" name="new_mark" required placeholder="Enter New Mark">


                        <input type="hidden" id="mark_id" name="id">
                   

              
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary" id="update">Update</button>
              
                      </div>
                  
              </form>
                  </div>
              
                </div>
              </div>
        </div>

    </div>
    </div>
  
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.5.6/js/dataTables.colReorder.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.js"></script>
    
    <script type="text/javascript">

    $(document).ready(function () {
      jQuery.noConflict();

        $('#marks_table').DataTable({
    // scrollY:auto,
    scrollCollapse: true,
    "columnDefs": [
        {
            "width": "10%",
            "targets": 0
        }
    ],
    paging: false,
    //scrollX: true,
    info: true,
    dom: 'Bfrtip',
    select: true,
});

// document.addEventListener('DOMContentLoaded', function () {
//     let table = new DataTable('#marks_table');
// });

        
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});





        $(".remove_load").click(function (e) { 
            e.preventDefault();
            var  student_id=$(this).attr('id');
           
            var data={
                    'student_id':student_id,
                    'teaching_load_id':$('#teaching_load_id').val(),
                }

            //$("#deleteLoad").modal('show');

            $.ajax({
                type: "POST",
            url: "/get/load",
                data: data,
                dataType: "json",
            }).done(function(data) {

                console.log(data);

                $("#student_load_id").val(data.student_load_id);
                $("#teaching_load_id_is").val(data.teaching_load);
                $("#student_id_is").val(data.user_id);

                $("#student_fullname").html(data.name);
                $("#student_middlename").html(data.middlename);
                $("#student_lastname").html(data.lastname);
                $("#teaching_load").html(data.subject_name);
                $("#teaching_load_class").html(data.grade_name);

       
               $("#deleteLoad").modal('show');
                    
                }).fail(function(data) {
                    
            });

          

        });


        $(document).on('click', '.edit_marks', function(event) {
            event.preventDefault();
        //    var token = $('meta[name="csrf-token"]').attr('content');
             var  edit_id=$(this).attr('id');
     
             $.ajax({
                 url: '/marks/edit/'+edit_id,

                 type: 'GET',
        //          header:{
        //   'X-CSRF-TOKEN': token
        // },
                 data: {edit_id:edit_id},
             })
             .done(function(data) {
              //   alert(data.id);
            $("#old_mark").val(data.mark);
            $("#mark_id").val(data.mark_id);
            $("#name").html(data.name);
            $("#subject").html(data.subject_name);
            $("#assessement").html(data.assessement_name);
            $("#info_update").html(data);
            $("#editData").modal('toggle');
          
             })
             .fail(function(data) {
                 console.log(data);
             })
             .always(function() {
                 console.log("complete");
             });
             
        });

      
    
        $(document).on('click', '#update', function(event) {

            event.preventDefault();
            var token = $('meta[name="csrf-token"]').attr('content');

            
if ( $("#new_mark").val().length ==0 || $("#new_mark").val()==" " || $("#new_mark").val()>100 || $("#new_mark").val()<0 ){
        alert('Sorry. Please enter valid student score');
    }else{

    
            $.ajax({
                header:{
          'X-CSRF-TOKEN': token
        },
                url: '/marks/update',
                type: 'PATCH',
                data: $("#updateForm").serialize(),
            })
            .done(function(data) {
               $("#editData").modal('hide'); 
        
               alert('Mark successfully updated. The page will reload after a few seconds, after you press OK ');
               location.reload();   
            })
            .fail(function(data) {
                console.log(data);
            })
            .always(function() {
                console.log("complete");
            });
            
    } 
        });


        $("#removeLoadBtn").click(function (e) { 
            e.preventDefault();
            $.ajax({
        
                url: '/loads/update',
                type: 'PATCH',
                data: $("#removeForm").serialize(),
            })
            .done(function(data) {

                console.log(data);
               $("#deleteLoad").modal('hide'); 
               $("#response").modal('show'); 
               $(".msg").text(data.message); 


            })
            .fail(function(data) {
                console.log(data);
            })
            .always(function() {
                console.log("complete");
            });
            
        });

        $("#close").click(function (e) { 
            e.preventDefault();
            location.reload();   
            
        });

    });

  

    $('#marksform').submit(function(){
    $(this).find(':#add_mark_btn').prop('disabled', true);
});

    </script>

</x-app-layout>
