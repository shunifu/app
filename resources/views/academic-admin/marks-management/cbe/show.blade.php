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
                        <a href="/marks/cbe">
                            <h3 class="card-title p4"><i class="fas fa-hand-point-left mr-2"></i> Back </h3>
                        </a>
                    </div>
                    <div class="card-body">
                        <p class="text-gray-700 mb-1 2h-base">
                           {{\Spatie\Emoji\Emoji::waving_hand()}}{{ Auth::user()->name }}.  You are adding <span class="text-bold">{{ $loads_description['0']->subject_name }} </span> marks for students in the following class(es).
                            <ul>
                            @foreach ($loads_description as $item)
                            <li><span class="text-bold">{{ $item->grade_name }}</span></li>
                            @endforeach
                         
                            </ul>

                            
                       {{-- //    .text-gray-700 mb-1 2h-base --}}

                            <hr>

                             <p class="text-gray-700 mb-1 2h-base">
                                <strong>Strand you adding grades for is</strong><br>
                                <ul>

                     <li>         
                          {{$strand_description->strand}} {{\Spatie\Emoji\Emoji::hugging_face()}}
                </li>  
<p></p> 
                {{-- <li>
                    If you want to <span class="text-bold">CHANGE or edit a mark </span> , click on the green button. After clicking on the green button a pop up will show where you will be able to change/edit the mark of the student.
                </li> --}}
                </ul>
             
                                    <hr>
                                </p> 
                            
                            
                            <div class="table-responsive">

                                <form action="{{ route('marks.cbe_store') }}" method="post" id="marksform">
                                    @csrf
                                    <table class="table table-sm table-hover mx-auto table-bordered col-sm " id="marks_table">

                                        <thead class="thead-light hidden-md-up">

                                      
                                            <th >Student</th>
                                          
                                            <th  >Grade</th>
                                         

                                        </thead>
                                        <tbody>

                                            @foreach ($students as $key=>$student)

                                      
                                           
                                                <tr>

                                                  
                                                    <input id="teaching_load_id" type="hidden" name="teaching_load_id"
                                                        value="{{ $student->teaching_load_id }}">
                                                    <input type="hidden" name="teacher_id"
                                                        value="{{ Auth::user()->id }}">

                                                    <input type="hidden" name="strand_id"
                                                        value="{{ $strand_id }} ">
                                                        <input type="hidden" name="term_id"
                                                        value="{{ $term_id }} ">
                                                     

                                                          <td class="align-middle"  >
                                                            {{ $student->lastname }}  {{ $student->name }} 
                                                          </td>
                                                           


<td class="align-middle ">
 
    @if (is_null($student->grade_description))


    <div class="form-check ">
        <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"   value="Excellent">
        <label class="form-check-label" for="{{$key}}">
        Excellent
        </label>
      
     </div>
    
     <div class="form-check ">
        <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}"   value="Very Good">
        <label class="form-check-label" for="{{$key}}">
        Very Good
        </label>
      
     </div>
    
    
     <div class="form-check ">
        <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"   value="Good">
        <label class="form-check-label" for="{{$key}}">
        Good
        </label>
      
     </div>
       
    
     <div class="form-check ">
        <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"   value="Sufficient">
        <label class="form-check-label" for="{{$key}}">
        Sufficient
        </label>
      
     </div>
    
    
     <div class="form-check ">
        <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}" id="{{$key}}"   value="Not Sufficient">
        <label class="form-check-label" for="{{$key}}">
        Not Sufficient
        </label>
      
     </div>

@else


@if ($student->grade_description==="Excellent")

<div class="form-check ">
    <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"  checked   value="Excellent">
    <label class="form-check-label" for="{{$key}}">
        Excellent
        </label>
    </div>

<div class="form-check ">
<input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"    value="Very Good">
<label class="form-check-label" for="{{$key}}">
    Very Good
    </label>
</div>



<div class="form-check ">
<input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"    value="Good">
<label class="form-check-label" for="{{$key}}">
    Good
    </label>
</div>


<div class="form-check ">
    <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"    value="Sufficient">
    <label class="form-check-label" for="{{$key}}">
        Sufficient
        </label>
    </div>



    <div class="form-check ">
        <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"    value="Not Sufficient">
        <label class="form-check-label" for="{{$key}}">
            Not Sufficient
            </label>
        </div>





@endif




    @if ($student->grade_description==="Very Good")

    <div class="form-check ">
        <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"    value="Excellent">
        <label class="form-check-label" for="{{$key}}">
            Excellent
            </label>
        </div>

    <div class="form-check ">
    <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"  checked  value="Very Good">
    <label class="form-check-label" for="{{$key}}">
        Very Good
        </label>
    </div>
    

  
    <div class="form-check ">
    <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"    value="Good">
    <label class="form-check-label" for="{{$key}}">
        Good
        </label>
    </div>


    <div class="form-check ">
        <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"    value="Sufficient">
        <label class="form-check-label" for="{{$key}}">
            Sufficient
            </label>
        </div>



        <div class="form-check ">
            <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"    value="Not Sufficient">
            <label class="form-check-label" for="{{$key}}">
                Not Sufficient
                </label>
            </div>


    @endif



    @if ($student->grade_description==="Good")

    <div class="form-check ">
        <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"    value="Excellent">
        <label class="form-check-label" for="{{$key}}">
            Excellent
            </label>
        </div>

    <div class="form-check ">
    <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"    value="Very Good">
    <label class="form-check-label" for="{{$key}}">
        Very Good
        </label>
    </div>
    

  
    <div class="form-check ">
    <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"  checked   value="Good">
    <label class="form-check-label" for="{{$key}}">
        Good
        </label>
    </div>


    <div class="form-check ">
        <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"    value="Sufficient">
        <label class="form-check-label" for="{{$key}}">
            Sufficient
            </label>
        </div>



        <div class="form-check ">
            <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"    value="Not Sufficient">
            <label class="form-check-label" for="{{$key}}">
                Not Sufficient
                </label>
            </div>


    @endif
  
  
    @if ($student->grade_description==="Sufficient")

    <div class="form-check ">
        <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"    value="Excellent">
        <label class="form-check-label" for="{{$key}}">
            Excellent
            </label>
        </div>

    <div class="form-check ">
    <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"    value="Very Good">
    <label class="form-check-label" for="{{$key}}">
        Very Good
        </label>
    </div>
    

  
    <div class="form-check ">
    <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"     value="Good">
    <label class="form-check-label" for="{{$key}}">
        Good
        </label>
    </div>


    <div class="form-check ">
        <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"  checked   value="Sufficient">
        <label class="form-check-label" for="{{$key}}">
            Sufficient
            </label>
        </div>



        <div class="form-check ">
            <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"    value="Not Sufficient">
            <label class="form-check-label" for="{{$key}}">
                Not Sufficient
                </label>
            </div>


    @endif



    @if ($student->grade_description==="Not Sufficient")

    <div class="form-check ">
        <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"    value="Excellent">
        <label class="form-check-label" for="{{$key}}">
            Excellent
            </label>
        </div>

    <div class="form-check ">
    <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"    value="Very Good">
    <label class="form-check-label" for="{{$key}}">
        Very Good
        </label>
    </div>
    

  
    <div class="form-check ">
    <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"     value="Good">
    <label class="form-check-label" for="{{$key}}">
        Good
        </label>
    </div>


    <div class="form-check ">
        <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}"     value="Sufficient">
        <label class="form-check-label" for="{{$key}}">
            Sufficient
            </label>
        </div>



        <div class="form-check ">
            <input class="form-check-input" type="radio" name="grade[{{$key}}-{{$student->student_id}}]" id="{{$key}}" id="{{$key}}" checked   value="Not Sufficient">
            <label class="form-check-label" for="{{$key}}">
                Not Sufficient
                </label>
            </div>


    @endif





  



@endif

</td>



</tr>
                                          
                                            @endforeach

                                        </tbody>


                                    </table>
                                    <x-jet-button class="float-right col-sm-2" id="add_mark_btn">Add CBE Grades</x-jet-button>
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
