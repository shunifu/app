<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/r-2.2.7/datatables.min.css" />
        <style>
            .profile-head {
                transform: translateY(5rem)
            }

            .cover {
                background-image: url(https://res.cloudinary.com/innovazaniacloud/image/upload/v1615409473/Pngtree_colorful_geometric_flat_business_card_1068655_sp9zix.jpg);
                background-size: cover;
                background-repeat: no-repeat
            }

        </style>


    </x-slot>

    @include('partials.parent-link-header')


    <div class="mb-4">

    </div>

    <div class="col-md-12 ">
        <div class="card card-light   elevation-3">
            <div class="card-header">
                <a href="/class/student-management/link-parents">
                    <h3 class="card-title p4"><i class="fas fa-hand-point-left mr-2"></i> Back </h3>
                </a>
            </div>
            <div class="card-body">
                <p class="text-gray-700 mb-1 2h-base">
                    kgkjhkhjkjhj

                    <div class="table-responsive">

                        <form action="{{ route('classteacher_parent_link.store') }}" method="post">
                            @csrf
                            <table class="table table-sm table-hover mx-auto table-bordered " id="customers">

                                <thead class="thead-light hidden-md-up">

                                    <th class="col-3">Student</th>
                                
                                    <th style="5px">Parent Cell</th>
                                    <th style="5px">Parent Email Address</th>

                                </thead>
                                <tbody>

                                    @forelse($students as $student)
                                        <tr>

                                            <input type="hidden" name="student_id[]"
                                                value="{{ $student->student_id }} ">
                                            <input type="hidden" name="parent_id[]" value="{{ $student->parent_id }}">

                                            <td class="align-middle p-2">
                                                {{ $student->lastname }} {{ $student->name }}
                                                {{ $student->middlename }}
                                            </td>
                                         


                                            <td class="align-middle">
                                                @if($student->cell_number==NULL)
                                                    <input type="number" id="parent_cell" class="form-control"
                                                        placeholder="Parent Cell" name="parent_cell[]">
                                                @else
                                                    <div class="input-group">
                                                        <input type="number" readonly id="parent_cell"
                                                            class="form-control" placeholder="Enter Parent Cell"
                                                            name="parent_cell[]" value="{{ $student->cell_number }}">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-success edit_cell"
                                                                id="{{ $student->cell_number }}" type="button"> <i
                                                                    class="fas fa-edit"></i></button>
                                                        </div>
                                                    </div>

                                                @endif

                                            </td>


                                            <td class="align-middle">
                                                @if($student->cell_number==NULL)
                                                    <input type="email" id="parent_email" class="form-control"
                                                        placeholder="Parent Email" name="parent_cell[]">
                                                @else
                                                    <div class="input-group">
                                                        <input type="email" readonly id="parent_email"
                                                            class="form-control" placeholder="Enter Parent Email"
                                                            name="parent_cell[]" value="{{ $student->cell_number }}">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-success edit_cell"
                                                                id="{{ $student->cell_number }}" type="button"> <i
                                                                    class="fas fa-edit"></i></button>
                                                        </div>
                                                    </div>

                                                @endif

                                            </td>

                                            </td>
                                        </tr>
                                    @empty
                                        No Data
                                    @endforelse

                                </tbody>


                            </table>
                            <x-jet-button class="float-right col-sm-2">Link Parents-Students</x-jet-button>
                        </form>

                    </div>
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

                        <center>
                            <h5 class=" text-muted lead">Update Parent Cell</h5>
                        </center>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        You are about to change <span class="text-bold" id="name"> </span>'s parent's number. To
                        continue to change the cell number, enter the new cell number in new cell field and then click
                        update.
                        <hr>
                        {{-- <div id="info_update" class="text-bold"> --}}
                        <label class="label-control">Current Cell Number</label>
                        <input type="text" class="form-control" id="old_cell" name="old_cell" readonly>

                        {{-- </div> --}}
                        <p></p>


                        <label class="label-control">New Mark</label>
                        <input type="text" class="form-control" name="new_cell_number" required
                            placeholder="Enter New Cell Number">


                        <input type="hidden" id="cell_number" name="id">



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
