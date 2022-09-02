<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                    <h3 class="card-title">Migration Management</h3>
                </div>

                <img class="card-img-top"
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_220,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:Academic Session Migration,w_0.3,y_0.28/v1613303961/pexels-photo-5212359_ukdzdz.jpg"
                    alt="">
                <div class="card-body">
                    <h3 class="lead">Hi, {{ Auth::user()->name }}</h3>
                    <div class="text-muted">
                        <p class="card-text"> Use this section to migrate to new academic session/year.<br>
                            Students will be migrated to thier respective classes based on thier performance. Those that failed in the previous academic year will remain in that class. 
                            {{-- <p>If a student has left school , that is, did not return to school for the new academic year,  please click on the checkbox which is under the <span class="text-bold"> School Column header on the row of that particular student. </span>The system will then archive those students. </p>
                            If the student did comeback, <span class="text-danger text-bold">please do not click on the checkbox of that student</span> under the Left school column header.<br> 
                            Please make sure that you <span class="text-danger text-bold">CHECK those WHO HAVE NOT RETURNED!</span> --}}

                        </p>
                        <hr>

                    </div>

                </div>


                <!-- /.card-header -->
                <!-- form start -->
                <form action="#" method="post">
                    <div class="card-body">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-3 form-group">
                                <x-jet-label> Class Type</x-jet-label>
                                <select class="form-control"  id="class_type" name="class_type">
                                    <option value="">Select Class Type</option>
                                    <option value="internal">Internal Classes</option>
                                    <option value="external">External Classes</option>
                                </select>
                                @error('class_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3  form-group">
                                <x-jet-label> Stream Name</x-jet-label>
                                <select class="form-control" name="stream_id" id="stream_id">
                                    <option value="">Select Stream</option>
                                </select>
                                @error('stream_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3 form-group">
                                <x-jet-label>From Year</x-jet-label>
                                <select class="form-control" name="from_academic_session" id="from_academic_session">
                                    <option value="">Select From Academic Year</option>
                                    @foreach($from as $from_academic_year)
    <option value="{{ $from_academic_year->id }}">{{ $from_academic_year->academic_session }}</option>
                                    @endforeach
                                </select>
                                @error('from_academic_year')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3  form-group">
                                <x-jet-label>To Year</x-jet-label>
                                <select class="form-control" name="to_academic_session" id="to_academic_session">
                                    <option value="">Select New Academic Year</option>
                                    @foreach($to as $to_academic_year)
    <option value="{{$to_academic_year->id }}">{{$to_academic_year->academic_session }}</option>
                                    @endforeach
                                </select>
                                @error('to_academic_year')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <x-jet-button id="submit">Next</x-jet-button>
                    </div>
                </form>
            </div>
            <form action="{{route('transition.store')}}" method="post" name="migration" id="migration_form">
                @csrf
            <div class="card text-left">
              
              <div class="card-body">

                <div class="new_class"></div>

                <div class="next_class_message"></div>
             
                
             <table class="table table-hover table-centered align-middle table-nowrap mb-0 table-responsive-md table-bordered" >
                    <thead class="thead-light">
                        <tr>
                            <th class="transfer_th">Transfer</th>
                            <th>Last Name</th>
                            <th>Name</th>
                            <th>Middlename</th>
                            <th>Current Class</th>
                             <th>Result</th>
                            {{-- <th>Left School? <i class="fas fa-info-circle " data-toggle="tooltip" data-placement="top" title="Select only those students that have left school.">
                            </th> --}}
                            
                        </tr>
                    </thead>
                   
                    <tbody class="response_data">
                       
                    </tbody>
                   {{-- <div class="form-check form-check-inline">
                       <label class="form-check-label">
                          
                       </label>
                   </div> --}}
                
                </table>

              </div>
              <div class="card-footer">
                <x-jet-button>Migrate Students </x-jet-button>
              </div>
            </div>
        </form>


        </div>


    </div>

    {{-- <script>
        $(function () {
 
})
    </script> --}}
    <script>

        $(document).ready(function () {
            $("#external_checkbox_td").hide();
    $("#transfer_th").hide();
    $(".external_class").hide();

    
            
            $('[data-toggle="tooltip"]').tooltip();
            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

            // $('.th_result').hide();
            // $('.th_next_class').hide();

            $("#migration_form").hide();

            $('#stream_id').on('change', function(e) {
                e.preventDefault();
               var stream_id= $('select[name="stream_id"] :selected').val();
               
               $.ajax({
                   type: "POST",
                   url: "/session-management/migration/"+stream_id,
                   data: {stream_id:stream_id},
                   dataType: "json",
               }).done(function(data) {
             
                //Show list of students in thes class
     
                   }).fail(function(data) {
                       
               });

            });


            $('#class_type').on('change', function(e) {
                e.preventDefault();
               var class_type= $('select[name="class_type"] :selected').val();

            
               $.ajax({
                   type: "GET",
                   url: "/session-management/migration/class-type",
                   data:{class_type:class_type},
                   
               }).done(function(data) {

                $("#stream_id").html("<option value=''>Select Stream</option>");

               $.each(data, function (key, value) { 
                var stream=value.stream_name;
                var id=value.id;
                $('#stream_id').append('<option value='+id+'>'+stream+'</option>');      
               });
            
                       
            
            }).fail(function(data) {
                       
               });
              

            });


        
            
            $('#submit').click(function (e) { 
                e.preventDefault();
                $("tbody").html(" ");
                $("#migration_form").show();

                //disable button

                var data={
                    'class_type':$('#class_type').val(),
                    'from_academic_session':$('#from_academic_session').val(),
                    'to_academic_session':$('#to_academic_session').val(),
                    'stream_id':$('#stream_id').val(),
                }

                
                var type_of_class= $('#class_type').val();
                var from= $('#from_academic_session').val();
                var to= $('#to_academic_session').val();
                var stream_id= $('#stream_id').val();

                if(type_of_class=="external"){

                    $(".external_checkbox").show();
            $("#external_checkbox_td").show();
            $(".external_class").show();

$('.new_class').append('<div class="form-group external_class"><div class="form-group"><label for="as">Select Class</label><select class="form-control" id="next_class_select" name="next_class" ><option>Select Class</option></select></div><small id="helpId" class="form-text text-muted">Select the class you are transfering the students to</small></div>');



}

$("#next_class_select").on('change', function(e) {
    e.preventDefault();

    $(".next_class_message").html(" ");
  
    var selectedClass = $('#next_class_select').find(":selected").text();
    
    $(".next_class_message").append("<h4 class='lead'>Please click the checkbox for those students that you want to transfer to "+selectedClass+" </h4><hr>");
});

                $.ajax({
                    type: "GET",
                    url: "/next/class/"+stream_id,
                    data: {stream_id:stream_id},
                    dataType: "json",
                    success: function (response) {

                        // console.log(response);

                        $.each(response.grade, function (key, item) { 

                            // console.log(item.next_grade_name);

                            $("#next_class_select").append('<option value='+item.next_grade_id+'>'+item.next_grade_name+'</option>');
                             
                        });
                        
                    }
                });
                
                $.ajax({
                    type: "POST",
                    url: '/migration/process',
                    data: data,
                    dataType: "json",
                }).done(function(data) {

                    if(data.status==200){

                       

$.each(data.students, function (key, value) { 


if(type_of_class=="internal"){

    $("#transfer_th").hide();
    $(".external_class").hide();
    $('.response_data').append('<tr><input type="hidden" name="student_id[]" value='+value.student_id+'><input type="hidden" name="result[]" value='+value.result+'> <input type="hidden" name="from_session" value='+from+'><input type="hidden" name="to_session" value='+to+'><input type="hidden" name="current_class[]" value='+value.grade_id+'><input type="hidden" name="current_stream" value='+stream_id+'><td name="lastname">'+value.lastname+'</td><td>'+value.name+'</td><td>'+value.middlename+'</td><td>'+value.grade_name+'-'+value.academic_session+'</td><td class='+value.student_id+'>'+value.result+'</td></tr>');


    if (value.result=="Proceed") {
        $('.'+value.student_id).addClass("bg-success"); 
    }

    if (value.result=="Promoted") {
        $('.'+value.student_id).addClass("bg-warning"); 
    }

    if (value.result=="Repeat") {
        $('.'+value.student_id).addClass("bg-danger"); 
    }
    
    

}else if(type_of_class=="external"){
    $('.response_data').append('<tr> <input type="hidden" name="from_session" value='+from+'><input type="hidden" name="to_session" value='+to+'><input type="hidden" name="current_class[]" value='+value.grade_id+'><td id="external_checkbox_td"><input type="checkbox"  name="transfer_checkbox[]" id="transfer_checkbox" value='+value.student_id+' ></td><td name="lastname">'+value.lastname+'</td><td>'+value.name+'</td><td>'+value.middlename+'</td><td>'+value.grade_name+'-'+value.academic_session+'</td><td class='+value.student_id+'>'+value.result+'</td></tr>');

    $('.'+value.student_id).text("ECESWA");
    $("#external_checkbox_td").show();
    $("#transfer_th").show();
}

  
});


}else{
    //Display errors
}
                                                   
                    }).fail(function(data) {
                        
                });
                
            });
        });
        
    </script>

</x-app-layout>
