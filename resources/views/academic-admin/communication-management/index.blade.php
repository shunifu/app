<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                    <h3 class="card-title"> Stakeholder Communication Portal </h3>
                </div>
<img class="card-img-top" src=" https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_260,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_50_style_light_align_center:Communication Portal,w_0.4,y_0.20/v1663377965/pexels-photo-5387282_i3n2dk.jpg"
                    alt="">

                
                    
                    <!-- Modal -->
                    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="confirm" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Send Message</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    You are about to send a message. To continue click <strong>Yes Send</strong>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" id="send" class="btn btn-success">Yes Send</button>
                                </div>
                            </div>
                        </div>
                    </div>

                
                    
                    <!-- Modal -->
                    <div class="modal fade" id="return" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">System Response</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    <div class="msg">

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                <div class="card-body">
                    <h3 class="lead">Hi, {{ Auth::user()->name }}</h3>
                   
                <span class="card-text text-muted"> Use this section to send SMS's to the school stakeholders. </span>
                   <hr> 
                <!-- form start -->
                <form action="#" id="com_form" >
                   
                        @csrf
                     
                        {{-- <div class="form-row"> --}}
                            <div class="col form-group">
                                <x-jet-label>Select Recipient</x-jet-label>
                                <select class="form-control"  id="recipient" name="recipient">
                                    <option value="">Select Recipient </option>
                                    <option value="parents">Parents</option>  
                                    <option value="teachers">Teachers</option>   
                                </select>
                                @error('recipient')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col form-group">
                                <x-jet-label> Select Channels</x-jet-label>
                              <br>
                                <input type="checkbox" id="channel" name="channel" value="sms">
                                SMS
                                <br>
                                <input type="checkbox" disabled  id="channel" name="channel" value="push">
                                 Push Notification
                                <br>
                                <input type="checkbox" disabled id="channel" name="channel" value="Email">
                                Email
                                @error('channel')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col  form-group">
                                <x-jet-label>Write Message</x-jet-label>
                                <textarea name="message" id="message" class="form-control" maxlength="160"></textarea>
                                @error('message')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- <div class="col-md-3  form-group">
                                <x-jet-label> Baseline</x-jet-label>
                                <select class="form-control baseline" name="baseline" id="baseline">
                                    <option value="">Select Baseline</option>
                                    <option value="assessement">Assessement-Based</option>
                                    <option value="term">Term-Based</option>
                               
                                </select>
                                @error('baseline')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}

                            {{-- <div class="col-md-3 form-group baseline_group" id="baseline_group">
                                <x-jet-label class="baseline_group_label"></x-jet-label>
                                <select class="form-control" name="baseline_group" id="baseline_group_select" >
                                <option value="">Select Option</option>
                                </select>
                                @error('baseline_group')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}

                            {{-- <div class="col-md-3 form-group">
                                <x-jet-label>Section</x-jet-label>
                                <select class="form-control" name="category" id="category">
                                    <option value="">Select Section</option>
                                    <option value="stream">Stream-Based</option>
                                    <option value="class">Class-Based</option>         
                                </select>
                                @error('category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}

                            {{-- <div class="col-md-3 form-group">
                                <x-jet-label>Sub-Section</x-jet-label>
                                <select class="form-control" name="category_result" id="category_result">
                                    <option value="">Select Sub-Section</option>
                                   
                                </select>
                                @error('category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}
                          
                        {{-- </div> --}}
                    </div>

                 
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <x-jet-button id="submit">Send Message</x-jet-button>
                    </div>
                </form>
            
            </div>

            {{-- <div class="card text-left">
              <img class="card-img-top" src="holder.js/100px180/" alt="">
              <div class="card-body">
                <h4 class="card-title">Title</h4>
                <p class="card-text">
                    <form action="#" method="post" name="result" id="result">
                        
                    </form>
                </p>
              </div>
            </div> --}}
           
        </div>


    </div>

    {{-- <script>
        $(function () {
 
})
    </script> --}}
    <script>

        $(document).ready(function () {

            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$("#submit").click(function (e) { 
    e.preventDefault();
    
    $("#confirm").modal('show'); 
});


     
        $("#send").click(function (e) { 


            e.preventDefault();

//validations





            $.ajax({
            type: "POST",
            url: "/communication/send",
            data: $('#com_form').serialize(),
            dataType: "json",
        }).done(function(data) {
            $("#confirm").modal('hide'); 
            $("#return").modal('show'); 
            $("#msg").html(data);
            
            }).fail(function(data) {
                $("#confirm").modal('hide'); 
                $("#return").modal('show');   
                $("#msg").append(data);  
        });
        });




    $(".baseline_group").hide();
    $(".baseline_group_label").html(" ");
    $("#baseline_group_select").html(" ");

    $("#baseline").on('change', function(e) {
        e.preventDefault();
        $(".baseline_group_label").html(" ");
    $("#baseline_group_select").html(" ");
    $(".baseline_div").html(" ");

        var data={
                    'session':$('select[name="session"] :selected').val(),
                    'baseline':$('select[name="baseline"] :selected').val(),
                    'baseline_group':$('select[name="baseline_group"] :selected').val(),
                    'category':$('select[name="category"] :selected').val(),
                    'outcome':$('select[name="outcome"] :selected').val(),
                }

        var baseline= $('select[name="baseline"] :selected').val();
        // alert(baseline);
        $.ajax({
            type: "GET",
            url: "{{route('baseline.fetch_group')}}",
            data: data,
            dataType: "json",
        }).done(function(data) {

            //console.log(data);
        
        $(".baseline_group").show();
            if (baseline=="term") {

                $("#baseline_group_select").append('<option value='+0+'>Select Term</option>');
                $(".baseline_group_label").append("Term");
                $.each(data.result, function (key, value) { 
                    $(".baseline_div").append('<input type="hidden"  name="term_is" value='+value.term_id+'>');
                    $("#baseline_group_select").append("<option>"+value.term_name+"-"+value.session_name+"</option>");
});
            } 
            
            if (baseline=="assessement") {
                console.log(data)
                $(".baseline_group_label").append("Assessement");
             
                $("#baseline_group_select").append('<option>Select Assessement</option>');
                $.each(data.result, function (key, value) { 
                    $("#baseline_group_select").append('<option value='+value.assessement_id+'>'+value.assessement_name+'</option>');
                  
});
            } 

            if (baseline==" ") {
                $(".baseline_group_label").append(" ");
                $(".baseline_group").hide();
               
            } 

            
          

                
            }).fail(function(data) {
                
        });
      
    });

    $("#category").change(function (e) { 
        e.preventDefault();
        var category=$('select[name="category"] :selected').val();

        $("#category_result").html(" ");
     

        $.ajax({
            type: "GET",
            url: "{{route('category.fetch_group')}}",
            data: {category:category},
            dataType: "json",
        }).done(function(data) {

            $("#category_result").html("<option value=''>Select Subcategory</option>");

            if(data.int=="school"){

            }
           
           if(data.int=="section"){

            $.each(data.category_result, function (index, element) { 
                 
                 $("#category_result").append('<option value='+element.id+'>'+element.section_name+'</option>');
             });
            }

           if(data.int=="stream"){

            $.each(data.category_result, function (index, element) { 
                 
                $("#category_result").append('<option value='+element.id+'>'+element.stream_name+'</option>');
            });
            // $.each(data.category_result, function (key, value) { 
            // $("#category_result").append("<option value="">Select Sub-Category Category</option> <option value="+value.+stream_id+">jksd</option>");
                 
            // });

            }

            if(data.int=="class"){
                $.each(data.category_result, function (index, element) { 
                 
                 $("#category_result").append('<option value='+element.id+'>'+element.grade_name+'</option>');
             });

            }

            if(data.int=="student"){

            }

            if(data.int=="teacher"){

                $.each(data.category_result, function (index, element) { 
                 
                 $("#category_result").append('<option value='+element.id+'> '+element.lastname+' '+element.name+'</option>');
             });

            }

            if(data.int=="subject"){

$.each(data.category_result, function (index, element) { 
 
 $("#category_result").append('<option value='+element.id+'> '+element.subject_name+'</option>');
});

}

          
                
            }).fail(function(data) {
                
        });

    });
    
            
   
        });
        
    </script>

</x-app-layout>
