<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/r-2.2.7/datatables.min.css" />
    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                    <h3 class="card-title">Manage Students</h3>
                </div>

                {{-- <img class="card-img-top"
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_32_style_light_align_center:Manage Students,w_0.3,y_0.13/v1643669913/266349857_3131946540375341_4881687858622913378_n_yhrqwu.jpg"
                    alt=""> --}}

                <div class="card-body">
                    <h3 class="lead"> Hi, {{ Auth::user()->salutation }} {{ Auth::user()->lastname }}</h3>
                    <div class="text-muted">
                        <p class="card-text">
                            <span class="text-bold">Use this section manage student information</span>

                        </p>

                    </div>

                </div>


                <!-- /.card-header -->
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-light">
                <div class="card-header">
                    <h3 class="card-title">Streams</h3>
                </div>

                <div class="card-body">
                    <div class="list-group " id="list-tab" role="tablist">
                        @foreach($streams as $stream)
<a class="list-group-item list-group-item-action stream_link " id="{{ $stream->id }}" data-toggle="list" href="#pr" role="tab" aria-controls="stream">{{ $stream->stream_name }}</a>
                        @endforeach

<a class="list-group-item list-group-item-action " id="list-inactive-list" data-toggle="list" href="#list-inactive" role="tab" aria-controls="home">Inactive Students</a>

                    </div>
                </div>
            </div>
        </div>


        <div class="col-9">
            <div class="card text-left card-light">
                <div class="card-header ">
                    <h3 class="card-title">Classes</h3>
                </div>
                <div class="card-body">
                    <h4 class="card-title">

                    </h4>
                    <p class="card-text">

<div class="tab-content" id="nav-tabContent">

<div class="tab-pane fade show " id="pr" role="tabpanel" aria-labelledby="pr">
  
    <div class="table-responsive">
        <table class="table table-sm table-bordered   table-hover mx-auto" id="students_table">
            <thead class="thead-light">
                <tr>
                <th>Profile</th>
                <th>Lastname</th>
                <th>Name</th>
                <th>Class</th>
                <th>Manage</th>
                </tr>
            </thead>

            <tbody class="pr">
               
           
          
            </tbody>
        </table>                          
    </div>
</div>



<div class="tab-pane fade" id="list-inactive" role="tabpanel" aria-labelledby="list-inactive-list">
       
    <div class="table-responsive">
        <table class="table table-sm table-hover table-bordered mx-auto">
            <thead class="thead-light">
                <tr>
                <th>Profile</th>
                <th>Name</th>
                <th>Lastname</th>
                <th>Manage</th>
                </tr>
            </thead>

            <tbody>
                @foreach($inactive_students as $inactive)
            <tr>
                <td>image</td>
                <td>{{ $inactive->name }} {{ $inactive->lastname }} {{ $inactive->middlename }}.</td>
                <td>{{ $inactive->lastname }}</td>
               
            </tr>
                @endforeach
            </tbody>
        </table>                          
    </div>

        </div>
    </div>
                </p>
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
            
   //     $('#students_table').DataTable();
        $(document).on('click', '.stream_link', function (event) {
            event.preventDefault();
            var token = $('meta[name="csrf-token"]').attr('content');
            var stream_id = $(this).attr('id');


           

            $.ajax({
                    url: '/students/manage/stream/' + stream_id,

                    type: 'GET',
                    //          header:{
                    //   'X-CSRF-TOKEN': token
                    // },
                    data: {
                        stream_id: stream_id
                    },
                })
                .done(function (data) {
        
$(".pr").empty();
for(var i=0; i<data.length; i++){
   
   var student_id=data[i].id;
   var student_name=data[i].name;
   var student_lastname=data[i].lastname;
   var student_class=data[i].grade_name;
   
    $(".pr").append('<tr><td></td><td>'+student_lastname+'</td><td>'+student_name+'</td><td>'+student_class+'</td><td><a href="//studeusersnt/manage/view/'+student_id+'">Edit '+student_name+'</a><select class="form-control" id='+student_id+' name="student_select"><option value="">Select Option</option><option>Reports</option><option>'+student_name+'"s Parent </option><option class="profile" value='+student_id+'>Student Profile</option><option value=deactivate>Deactivate'+' '+student_name+'</option><option>Transfer'+' '+student_name+'</option><option>Transcript</option><option>Password Reset</option></select></td></tr>');

  
    $('#'+student_id).on('change', function (e) {
     //   e.preventDefault();


       // $('select[name="platform"] :selected').attr('class')
        if ($('select[name="student_select"]:selected').attr('class')=="profile") {

            //window.location.href = '/users/student/manage/view/'+this.value;
            alert(this.value);
        }
     
    // alert(data[i].name);
});  
}

                })
                .fail(function (data) {
                    console.log(data);
                })
                .always(function (data) {
                    console.log(data);
                });

        });
       

          });

    </script>

   

</x-app-layout>
