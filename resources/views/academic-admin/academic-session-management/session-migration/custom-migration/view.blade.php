<x-app-layout>
    <x-slot name="header">
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/r-2.2.7/datatables.min.css" />
    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                    <h3 class="card-title">Custom Student Migration </h3>
                </div>

                <img class="card-img-top"
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_220,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:Student Migration,w_0.3,y_0.28/v1613303961/pexels-photo-5212359_ukdzdz.jpg"
                    alt="">
                <div class="card-body">
                    <h3 class="lead">Hi, {{ Auth::user()->name }}</h3>
                    <div class="text-muted">
                        <p class="card-text"> You are about to migrate students to <span class="text-bold">the next selected class</span>. If you want to migrate all the students to the destination class, select the "select all" option. However, if you only want to migrate specific students, click on the desired individuals.

                        </p>


                    </div>

                </div>

            </div>

<form action="{{route('transition.store')}}" method="post" name="migration" id="migration_form">
@csrf
    <div class="card text-left">
        <div class="card-body">

             <table id="migration_table" class="table table-hover table-centered align-middle table-nowrap mb-0 table-responsive-md table-bordered" >
                    <thead class="thead-light">
                        <tr>
                            <th>Action</th>
                            <th>Last Name</th>
                            <th>Name</th>
                            <th>Middlename</th>
                            <th>Current Class</th>
                        </tr>
                    </thead>

                    <tbody class="response_data">

                        @foreach ($students as $item)

                        <tr>

                           <td> <input type="checkbox" class="students" name="students[]" value="{{$item->student_id}}" ></td>
                            <td>{{$item->lastname}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->middlename}}</td>
                            <td>{{$item->grade_name}}</td>

        <input type="hidden" name="student_id[]" value="{{$item->student_id}}">
        <input type="hidden" name="student_name[]" value="{{$item->name}}">
        <input type="hidden" name="student_result[]" value="{{$item->result}}">
        <input type="hidden" name="from_session[]" value="{{$from_session}}">
        <input type="hidden" name="to_session[]" value="{{$to_session}}">
        <input type="hidden" name="current_class[]" value="{{$current_class}}">
        <input type="hidden"  name="final_stream_status" value="{{$final_stream_status}}">
        <input type="hidden"  name="scope" value="internal">

                        </tr>
                        @endforeach
                    </tbody>

                </table>

              </div>
              <div class="card-footer">
                <x-jet-button>Migrate Students </x-jet-button>
              </div>
            </div>
        </form>


        </div>


    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/r-2.2.7/datatables.min.js">
    </script>

    <script>
        $(document).ready(function () {
            $.noConflict();

            $('#migration_table').DataTable({
                // scrollY:auto,
                scrollCollapse: true,
                paging: false,
                //scrollX: true,
                info: true,
                dom: 'Bfrtip',
                select: true,
            });


        })

    </script>


<script>
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

  </script>



</x-app-layout>
