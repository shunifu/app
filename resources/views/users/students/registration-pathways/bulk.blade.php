<x-app-layout>
    <x-slot name="header">
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


      <style>
        table th{
            text-align: center;
         }

      </style>
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Student Registration Portal</h3>
      </div>

        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1709015410/rtivhy8olqrzezyqzot2.png">
        <div class="card-body">
          <h4 class="lead">Student Registration Portal</h4>

          <hr>
         <div class="text-muted">
          Hi, <span class="text-bold">{{Auth::user()->salutation}} {{Auth::user()->lastname}}</span>. Welcome to the  bulk-student registration pathway. This is where you add multiple students at a time. Below is a form where you will add the needed student details. <br>
          To go back click <a href="/users/student">here</a>
         </div>

        </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Bulk Registration Pathway</h3>
      </div>
    <div class="card-body">


                             <!-- form start -->
              <form action="{{route('pathway.bulk_store')}}" method="post">
                 @csrf
<div class="row">

    <div class="col" >

        <div class="form-group">
            <label> Student Class <span style="color: red">*</span></label>
            <select class="form-control" name="student_class">
            <option value=""> Select Class</option>

            @foreach ($classes as $class)
            <option value="{{$class->id}}">{{$class->grade_name}}</option>
            @endforeach

            </select>
            @error('student_class')
            <span class="text-danger">{{$message}}</span>
            @enderror
           </div>
    </div>


</div>


    <div class="row table-responsive">
<table class="table " id="registration_table">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>lastname</th>
            <th>Name</th>
            <th>Middlename</th>
            <th>Gender</th>

            <th>Action</th>
        </tr>
    </thead>

    <tbody id='dynamic_field'>

    </tbody>
</table>


</div>
<button class="btn btn-success"  type="button" id="addRow"> <i class="fa fa-plus-circle"></i>  More Students</button>







              <!-- /.end of form row -->

                  <div  id="slave-div">

                  </div>

              <div class="card-footer">
                <x-jet-button>Register Student</x-jet-button>
              </div>
            </form>


              </div>
              {{-- end of row --}}

            </div>
{{-- end of card  body--}}

        </div>
        {{-- end of card --}}

        <script>
          $(document).ready(function () {

         $('#registration_table').hide();
            var i = 0;
$('#addRow').click(function() {
  i++;
  $('#registration_table').show();
  $('#dynamic_field').append('<tr><td id="row_num' + i + '">' + i + '<input type="hidden" name="student_number[]" value=' + i + '></td>' +
    '<td><input class="form-control" type="text" required name="student_lastname[]" required  ></td>' +
    '<td><input class="form-control" type="text" required name="student_name[]" required  ></td>' +
    '<td><input class="form-control" type="text" name="student_middlename[]"   ></td>' +
    '<td><right><select name="student_gender[]" required  class="form-control">' +
    '<option value="">Select Gender</option><option value="Male">Male</option><option value="Female">Female</option></select></center></td>' +
    '<td><button type="button" name="remove" class="btn btn-danger btn_remove">X</button></td></tr>');
});
$(document).on('click', '.btn_remove', function() {
  $(this).closest("tr").remove(); //use closest here
  $('tbody tr').each(function(index) {
    //change id of first tr
    $(this).find("td:eq(0)").attr("id", "row_num" + (index + 1))
    //change hidden input value
    $(this).find("td:eq(0)").html((index + 1) + '<input type="hidden" name="student_number[]" value=' + (index + 1) + '>')
  });
  i--;
});

          });

      </script>

</x-app-layout>


