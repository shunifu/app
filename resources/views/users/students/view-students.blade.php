76890726Mnotfo<x-app-layout>
    <x-slot name="header">
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

   
    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                    <h3 class="card-title">Students Management</h3>
                </div>

                <img class="card-img-top"
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_220,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:Student Management,w_0.3,y_0.28/v1613303961/pexels-photo-5212359_ukdzdz.jpg"
                    alt="">
               <div class="card-body">
                   Please use this section to manage studens
                   <hr>
            </div> 
                <div class="card-body">
                
            <!-- Modal -->
<div class="modal fade" id="paymodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Student Fee Collector</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <ul id="add_fees_form_errList"></ul>
          <form action="">
            <input type="text" name="add_payment_student_id">
            <div class="form-group">

                <div class="col form-group">
                 <x-jet-label>Current Balance</x-jet-label>


                 <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">SZL</span>
                    </div>
                    <input type="text" disabled class="form-control" aria-label="Amount (to the nearest dollar)">
                    
                  </div>
                </div>

                <div class="col form-group">
                 <x-jet-label>Enter Amount</x-jet-label>
                 <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">SZL</span>
                    </div>
                    <input type="text" name="amount" class="form-control" aria-label="Amount (to the nearest lilangeni)">
                    
                  </div>
                  
                 @error('amount')
                 <span class="text-danger">{{$message}}</span>  
                 @enderror
                </div>

                <div class="col form-group">
                 <x-jet-label>Enter Reference</x-jet-label>
                 <x-jet-input name="reference" required  placeholder="Reference" ></x-jet-input>
                 @error('reference')
                 <span class="text-danger">{{$message}}</span>  
                 @enderror
                 </div>

              
               
                 <div class="col form-group">
                 <x-jet-label>Enter Payment Date</x-jet-label>
                 <x-jet-input name="payment_date" type="date" ></x-jet-input>
                 @error('payment_date')
                 <span class="text-danger">{{$message}}</span>  
                 @enderror
                 </div>

               </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Add Payment</button>
        </div>
      </div>
    </div>
  </div>



              <!-- Modal -->
<div class="modal fade " id="multiple_items" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form action="/add/student/payments/test" method="POST" id="payment_form">
      @csrf
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="title"></h5>
<hr>
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
      <div class="modal-body">
          <ul id="add_fees_form_errList"></ul>
       
        
          <div class="form-group">

            
            <div class="row" id="multishunifu">
           <input type="hidden" name="student_id[]" id="student_id">
              <div class="col form-group">
                <x-jet-label>Item</x-jet-label>
              <select class="form-control" name="item[]" >
                  <option >Select Item</option>
                  <option value="school_fee">School Fees</option>
                  <option value="book_fee">Book Fee</option>
                  <option value="examination">Examination</option>
                  <option value="registration">Registration</option>
                  <option value="hostel">Hostel</option>
                </select>
                 
                @error('item')
                <span class="text-danger">{{$message}}</span>  
                @enderror
               </div>

               <div class="col form-group">
                <x-jet-label>Amount</x-jet-label>
              
                   <input type="text" name="amount[]"  id="amount" class="form-control" aria-label="Amount (to the nearest lilangeni)">
         
                @error('amount')
                <span class="text-danger">{{$message}}</span>  
                @enderror
               </div>

               <div class="col">
                <x-jet-label>Ref</x-jet-label>
                <x-jet-input name="reference[]" required  placeholder="Reference" ></x-jet-input>
                @error('reference')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

                <div class="col">
                  <x-jet-label>Date</x-jet-label>
                  <x-jet-input name="payment_date[]" required type="date" ></x-jet-input>
                  @error('payment_date')
                  <span class="text-danger">{{$message}}</span>  
                  @enderror
                </div>

                <div class="col">
                  <x-jet-label>Financial Year</x-jet-label>
                  <select class="form-control" id="fy" name="fy[]">
                    <option value="">Select FY</option>
                    @foreach ($sessions as $session)
                    <option value={{$session->id}}>{{$session->academic_session}}</option>
                    @endforeach
                  </select>
                  @error('fy')
                  <span class="text-danger">{{$message}}</span>  
                  @enderror
                </div>

             

            </div>


            <div id="yebo">

            </div>


         

             </div>
      
        
        <div class="col" id="dynamic">
          {{-- <x-jet-label>Add More</x-jet-label> --}}
          <button type="button" class="btn btn-success" name="add"
              id="add_input" type="button"><i class="fas fa-plus-circle"></i></button>
     
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Payment</button>
      </div>
    </div>
    </form>
  </div>
</div>
                
  
  <!-- form start -->
                <form action="{{route('students.management')}}" method="post">
                   
                        
                        @csrf
                        <div class="form-row">
                            <div class="col form-group">
                                <x-jet-label> Stream Name</x-jet-label>
                                <select class="form-control" name="stream" id="stream">
                                    <option value="">Select Stream</option>
                                    @foreach($streams as $stream)
                                        <option value="{{ $stream->id }}">{{ $stream->stream_name }}</option>

                                    @endforeach
                                    <option value="former_students">Former Students</option>
                                </select>
                                @error('stream')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col form-group">
                                <x-jet-label> Class Name</x-jet-label>
                                <select class="form-control" name="grades" id="grades">
                                    <option value="">Select Class</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->grade_name }}</option>

                                    @endforeach
                                 
                                </select>
                                @error('grade')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                    <div class="col form-group">
                    <label for="">Search Student</label>
                    <input type="text" class="form-control" name="query" id="query" placeholder="Enter Student Name">
                    </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>


        </div>

       

        <div class="card text-left">
       
          <div class="card-body">
        
            <p class="card-text">
              @role('bursar')
              <form action="/add/student/payments" method="post">
                @csrf
                <table class="table table-sm table-hover mx-auto table-bordered " style="width:100%" id="students_table">
                  <div class="table_header"></div>
                    <thead class="thead-light">
                        <tr>
                           
                            <th>Student Details</th>
                            <th>Class</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Ref</th>
                            <th>Date</th>
                            <th>FY</th>
                            <th>View</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                     
                      
                    </tbody>
                </table>
                <x-jet-button>Submit</x-jet-button>
              </form>
                @endrole

                @role('admin_teacher')
                <table class="table table-sm table-hover mx-auto table-bordered " style="width:100%" id="students_table">
                  <thead class="thead-light">
                      <tr>
                          <th>Select</th>
                          <th>Lastname</th>
                          <th>Name</th>
                          <th>Middlename</th>
                          <th>Class</th>
                          <th>Student Cell</th>
                          <th>Photo</th>
                          <th>Manage</th>

                      </tr>
                  </thead>
                  <tbody>
                    
                 
                  </tbody>
              </table>

                @endrole

              </p>
          </div>
        </div>


    </div>

    <script>


        $(document).ready(function () {
          $.noConflict();
         
          
          $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


         $('#students_table').hide();
         var query= $('#query').val(" ");

         //student class search
         $("#grades").change(function (e) { 
             e.preventDefault();
             $("tbody").html(" ");
             $('#students_table').show();
           var grade_id=  $('select[name="grades"] :selected').val();

        
           $("#add_input").click(function (e) { 
            e.preventDefault();

            $("#multishunifu").clone().find("input").val("").end().appendTo("#yebo");
            

            
           });


           var payment_data=$('#payment_form').serialize();
           $("#add_payment").click(function (e) { 
            e.preventDefault();

           

            $.ajax({
              type: "POST",
              url: "/add/payment",
              data: payment_data,
              dataType: "json",
            }).done(function(data) {

              console.log(payment_data);

              
                
              }).fail(function(data) {
                
            });
            
           });

           $.ajax({
               type: "POST",
               url: "{{route('student.class_search')}}",
               data: {grade_id:grade_id},
               dataType: "json",
           }).done(function(data) {

        
            $('.table_header').append(data.students);
 
            $.each(data.students, function (key, item) { 
                var name=item.name;
                    var middlename=item.middlename;
                    var lastname=item.lastname;
                    var cell=item.cell_number;
                    var grade_name=item.grade_name;
                    // var student_idi=item.id;
                 

                  
       
       @role('bursar')
    
    

       $('tbody').append('<tr>\
                    <td>'+lastname+' '+name+' '+middlename+'</td>\
                    <input type="hidden" name="student_id[]" value='+item.id+'>\
                    <input type="hidden" name="grade_id[]" value='+item.grade_id+'>\
                    <td>'+grade_name+'</td>\
                    <td><select name="category[]" class="form-control"><option value="">Select Category</option><option value="school_fees">School Fees</option><option value="books">Book Fee</option><option value="exam">Examination</option><option value="registration">Registration</option></select></td>\
                    <td><input type="number" step="any" name="amount[]" class="form-control" placeholder="Amount"></td>\
                      <td><input type="text" name="ref[]" class="form-control" placeholder="Ref"></td>\
                        <td><input type="date" name="payment_date[]" class="form-control" placeholder="Amount"></td>\
                          <td><select name="session[]" class="form-control"><option value="">Select Academic Year</option><option value="">2021</option><option value="">2022</option></select></td>\
                          <td><button type="button" value="'+item.id+'" class=" '+item.id+' btn btn-secondary btn-sm" id="'+item.grade_id+'" >Multiple Items</button></td>\
                    </tr>'  );  

                    $('.'+item.id+'').click(function (e) { 
                     e.preventDefault();
                      var student_id=$(this).val();
                      var grade_id=$('#'+item.grade_id).val();
                     
                  //  
                 // $('.k').append('<input type="hidden" name="student_is" value='+student_id+'');
                     

                      $('#student_id').each(function(){
                        $('#student_id').val(student_id);
        ///$("#student_id").html("<input type=hidden id="+student_id+" name='student_id[]' value="+student_id+"/>");
});
                    

                     $('#multiple_items').modal('show');
                     $('#title').append(name+' '+lastname+' '+"'s"+' '+'Fees Collector');
                     $('#multiple_items').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
    $("#title").html(" ");
});




                    // alert(student_id);

                     $.ajax({
                        type: "GET",
                        url: "/get/student/payment/"+student_id+"/"+item.grade_id,
                        dataType: "json",
                     }).done(function(data) {


                      console(data);

                     
                            
                        }).fail(function(data) {
                            
                     });
            
        });
          
       
       @endrole
       

       @role('admin_teacher')

       $('tbody').append('<tr>\
                    <td> <input type="checkbox"  name="" id="" value="checkedValue"></td>\
                    <td>'+lastname+'</td>\
                    <td>'+name+'</td>\
                    <td>'+middlename+'</td>\
                    <td>'+item.grade_name+'-'+item.academic_session+'</td>\
                    <td>'+cell+'</td>\
                    <td> <form action="/student/image/upload" method="POST" enctype="multipart/form-data">@csrf<input id="upload" name="student_image" type="file"/> <input type="hidden" name="student_id" value='+item.id+'><button type="submit" class="btn"><i class="fa fa-check"></i></button></form></td>\
                    <td><a href=/users/profile/student/'+item.id+'>Visit Profile</a></td>\
                    </tr>'  );  


       @endrole
      
              
           
           

                            
            });
                   
               }).fail(function(data) {
                   
           });
            
         });

         //end of student class search

         $('#query').keyup(function (e) { 
             e.preventDefault();

           var query= $('#query').val();
           
           

        //    if (empty(query)) {
        //     $("tbody").html(" ");
        //    } 

           $('#students_table').show();
           $.ajax({
                type: "POST",
                url: "{{route('student.student_search')}}",
                data:{query},
                dataType: "json",
            }).done(function(data) {

                 $("tbody").html(" ");

                $.each(data.students, function (key, item) { 

                    var name=item.name;
                    var middlename=item.middlename;
                    var lastname=item.lastname;
                    var cell=item.cell_number;

                    // if (name==="null") {
                    //     var name=" ";
                    // } 

                    $('tbody').append('<tr>\
                    <td> <input type="checkbox"  name="" id="" value="checkedValue"></td>\
                    <td>'+lastname+'</td>\
                    <td>'+name+'</td>\
                    <td>'+middlename+'</td>\
                    <td>'+item.grade_name+'-'+item.academic_session+'</td>\
                    <td>'+cell+'</td>\
                    <td><a href=/users/profile/student/'+item.id+'>Visit Profile</a></td>\
                    </tr>'  );
                });

                
                    
                }).fail(function(data) {
                    
            });


             
         });
 
          $('#stream').on('change', function(e) {
              e.preventDefault();
              $('#students_table').show();

           // var stream_id = $(this).attr('id');
            var stream_id = $("#stream").val();

          
            
            $.ajax({
                type: "GET",
                url: "/students/management/stream/"+stream_id,
                dataType: "json",
            }).done(function(data) {

                $("tbody").html(" ");

                $.each(data.students, function (key, item) { 

                    var name=item.name;
                    var middlename=item.middlename;
                    var lastname=item.lastname;
                    var cell=item.cell_number;
                    var id=item.id;
                    var stu_id = $(this).attr('id');
                   var grade_id=item.grade_id;

               
                    $('tbody').append('<tr>\
                      <input type="hidden" value='+grade_id+' name="grade_id">\
                    <td> <input type="checkbox"  name="" id="" value="checkedValue"></td>\
                    <td>'+lastname+'</td>\
                    <td>'+name+'</td>\
                    <td>'+middlename+'</td>\
                    <td>'+item.grade_name+'-'+item.academic_session+'</td>\
                    <td>'+cell+'</td>\
                    <td><a href=/users/profile/student/'+item.id+'>Visit Profile</a> | <button type="button" value="'+item.id+'" class=" '+item.id+' btn btn-secondary btn-sm" id="'+item.grade_id+'" >Quick Pay</button> </td>\
                    \
                    </tr>'  );


                    $('.'+item.id+'').click(function (e) { 
                     e.preventDefault();
                      var student_id=$(this).val();
                      var grade_id=$('#'+item.grade_id).val();
                     
                     $('#paymodal').modal('show');
                   

                     $.ajax({
                        type: "GET",
                        url: "/get/student/payment/"+student_id+"/"+item.grade_id,
                        dataType: "json",
                     }).done(function(data) {


                      console(data);

                     
                            
                        }).fail(function(data) {
                            
                     });
            
        });

                });

          
                    
                }).fail(function(data) {
                    
            });
            
          });
     
      

        });
     
  </script>
</x-app-layout>
