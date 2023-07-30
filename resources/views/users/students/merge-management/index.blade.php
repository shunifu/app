<x-app-layout>
    <x-slot name="header">
<style>
    label {
    width: 100%;
}

.card-input-element {
    display: none;
}

.card-input {
    margin: 20px;
    padding: 0px;
}

.card-input:hover {
    cursor: pointer;
}

.card-input-element:checked + .card-input {
     box-shadow: 0 0 1px 4px #2ecc71;
}
</style>
    </x-slot>
    <div class="row">
        <div class="col">
            <div class="card card-light  ">
                <img class="card-img-top"
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1687620219/shunifu_header_4_ve76m9.png"
                    alt="">
                <div class="card-body">
                    <h3 class="lead">Hi, {{ Auth::user()->name }}</h3>
                    <span class="text-muted"> Use this section to merge students </span>. 
                    <p>
                        <span class="text-muted">Please select the student you want to keep from the list below</span> 
                        </p> 

                <hr>
                <!-- form start -->
                <form action="{{ route('student.merge') }}" method="post">
                
                        @csrf
                        <div class="row">

                            

                            @foreach ($student_data as $student)


                          

                            <div class="col">
        
                                <label class="text-normal">
                                  <input type="radio" name="chosen"  value="{{$student->student_id}}"  class="card-input-element" />

                         
                                    <div class="card card-default card-input">
                                      <div class="card-header">{{$student->student_id}} {{$student->middlename}} {{$student->name}}</div>
                                      <div class="card-body text-normal">
                                      List of Subjects
<hr>

                                      @php
                                                $student_loads=\DB::select(\DB::raw("SELECT subjects.id as subject_id, subjects.subject_name FROM student_loads INNER JOIN teaching_loads ON teaching_loads.id=student_loads.teaching_load_id INNER JOIN subjects ON subjects.id=teaching_loads.subject_id WHERE student_loads.student_id=".$student->student_id." AND teaching_loads.session_id=".$student->session_id." AND student_loads.active=1 AND teaching_loads.active=1 "));

                                                echo '<ul>';

                                                foreach ($student_loads as $student_load) {

                                                    echo '<li>'.$student_load->subject_name.'</li>';
                                                   // echo 
                                                    // echo '<input type=""'

                                                }

                                                echo '</ul>';
                                      @endphp
                                   

                                      </div>
                                    </div>
                        
                                </label>
                                  <input type="hidden" name="students[]" id="{{$student->student_id}}" value="{{$student->student_id}}">
                         
                              </div>
                            
                            @endforeach

                         

                         
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <x-jet-button>Merge Students</x-jet-button>
                    </div>
                </form>
            </div>


        </div>


    </div>

    <script>

$("input[type=radio]").on("click",function(){   
    $("input[type=radio]").prop("checked",false);
     $(this).prop("checked",true);
});

    </script>

</x-app-layout>
