<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
              
<img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1673715332/Manage_Teachers_9_pnai8r.png"
                    alt="">
                <div class="card-body">
                    <h3 class="lead">Hi, {{ Auth::user()->name }}</h3>
                    
                        <div class="card-text text-muted"> Use this section to view school insights. Through this module you will be able to view 
                            <ul>
                            <li>Report Cards</li>    
                            <li>Mark Sheets/Scoresheets</li>
                            <li>Student Performance Data</li>
                            <li>Subject Performance Data</li>
                            </ul>  
                        </div>   
                            
                    <hr>


                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('insights.generate')}}" method="post">
                    <div class="card-body">
                        @csrf
                        <div class="baseline_div">
                            
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 form-group">
                                <x-jet-label> Academic Year</x-jet-label>
                                <select class="form-control"  id="session" name="session">
                                    <option value="">Select Academic Year</option>
                                    @foreach ($sessions as $session)
                                    <option value="{{$session->id}}">{{$session->academic_session}}</option>   
                                    @endforeach
                                   
                                </select>
                                @error('session')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-3  form-group">
                                <x-jet-label> Reporting Scope</x-jet-label>
                                <select class="form-control baseline" name="baseline" id="baseline">
                                    <option value="">Select Reporting Scope</option>
                                    <option value="assessement">Assessement-Based</option>
                                    <option value="term">Term-Based</option>
                               
                                </select>
                                @error('baseline')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3 form-group baseline_group" id="baseline_group">
                                <x-jet-label class="baseline_group_label"></x-jet-label>
                                <select class="form-control" name="baseline_group" id="baseline_group_select" >
                                <option value="">Select Option</option>
                                </select>
                                @error('baseline_group')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3 form-group">
                                <x-jet-label>Scope</x-jet-label>
                                <select class="form-control" name="category" id="category">
                                    <option value="">Select Scope</option>
                                    <option value="stream">Stream-Based</option>
                                    <option value="class">Class-Based</option>         
                                    <option value="teacher">Teacher</option>      
                                    <option value="subject">Subject</option>  
                                </select>
                                @error('category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3 form-group">
                                <x-jet-label>Scope Group</x-jet-label>
                                <select class="form-control" name="category_result" id="category_result">
                                    <option value="">Select Scope Group</option>
                                   
                                </select>
                                @error('category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3  form-group">
                                <x-jet-label>Data Output</x-jet-label>
                                <select class="form-control outcome" name="outcome" id="outcome">
                                    <option value="">Select Output</option>
                                    {{-- <option value="summary_performance">Summerized Performance</option> --}}
                                    <option value="scoresheet">Mark Sheets</option>
                                    <option value="report_card"> Report Cards</option>
                                    <option value="analysis">Academic Performance Data</option>
                                  
                                
                                   
                                  
                                </select>
                                @error('outcome')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-md-3  form-group template">
                                <x-jet-label>Report Template</x-jet-label>
                                <select class="form-control " name="outcome" id="template">
                                    <option value="">Select Template</option>
                                  
                                   @foreach ($templates as $template)
                                      <option value="{{$template->template_name}}">{{$template->template_name}}</option> 
                                   @endforeach
                                  
                                
                                   
                                  
                                </select>
                                @error('template')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        

                       
                          
                        </div>
                    </div>

                 
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <x-jet-button id="submit">Generate Data</x-jet-button>
                    </div>
                </form>
            </div>

           
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
    $(".baseline_group").hide();
    $(".template").hide();
    $(".baseline_group_label").html(" ");
    $("#baseline_group_select").html(" ");
   // $(".template").html(" ");



    $("#outcome").change(function (e) { 
        e.preventDefault();

    //      $("#template").html(" ");

        var outcome=$('select[name="outcome"] :selected').val();

        if (outcome=="report_card") {
           //1. show template
           //2.
           $(".template").show();
        }else{
         //   $("#template").html(" ");
            $(".template").hide();
        }
        
    });

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

            $("#category_result").html("<option value=''>Select Scope Group</option>");

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

                $("#category_result").append('<option>All Teachers</option>');

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
