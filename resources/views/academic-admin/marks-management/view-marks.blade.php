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


    </x-slot>

    @include('partials.marks-header')


    <div class="mb-4">

    </div>

    <div class="col-md-12 ">
        <div class="card card-light   elevation-3">
            <div class="card-header">
                View Marks
            </div>
            <div class="card-body">
                <form action="{{ route('marks.show_marks') }}" method="post">

                    @csrf
                    <div class="form-row">

                        <div class="col-md-6 form-group">
                            <x-jet-label>Select Class</x-jet-label>
                            <select class="form-control" name="teaching_load" id="teaching_load">
                                <option value="0">Select Class</option>
                                @foreach($teaching_loads as $teaching_load_item)
                                    <option value="{{ $teaching_load_item->teaching_load_id }}">
                                        {{ $teaching_load_item->grade_name }} -
                                        {{ $teaching_load_item->subject_name }}</option>
                                @endforeach
                            </select>
                            @error('teaching_load')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <x-jet-label>Select Assessement</x-jet-label>
                            <select class="form-control" name="assessement_id">
                                <option value="">Select Assessement</option>
                                @foreach($assessements as $assessement)
                                    <option value="{{ $assessement->assessement_id }}">
                                        {{ $assessement->assessement_name }}

                                @endforeach
                            </select>
                            @error('assessement_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer col-auto">
                        <x-jet-button id="btnSelector">Show Students</x-jet-button>
                    </div>
                </form>


                <hr>
                <p class="text-gray-700 mb-1 2h-base">
                    These are <span class="text-bold">{{ $assessement_name }}</span> marks, for <span
                        class="text-bold">{{ $loads->grade_name }}, </span> </li>
                    <span class="text-bold">{{ $loads->subject_name }}</span>
                    <hr>
                    <div class="table-responsive">

                        <form action={{route('marks.destroy')}} method="POST">
                            @csrf
                            @method('delete')
                        <table class="table table-sm table-hover mx-auto">

                            <thead class="thead-light hidden-md-up">

                                <th>Name</th>
                                <th>Mark</th>
                             

                            </thead>
                            <tbody>
                                
                                <input type="checkbox" id="select_all" class="mr-2" name="select_all">
                                <label for="students">Delete All</label>
                                @foreach($marks as $student)
                                    <tr>
                                       
                                           
                                          
                                            <td class="align-middle p-2">
                                                <input type="checkbox" class="students" name="marks[]" value="{{$student->mark_id}}" >
                                                {{ $student->lastname }} {{ $student->name }}
                                                {{ $student->middlename }}

                                            </td>


                                            <td class="align-middle"><input type="number" min="0" max="100" id="marks"
                                                    class="form-control" value="{{ $student->mark }}"
                                                    placeholder="Mark" >
                                            </td>

                                         
                                      

                                    </tr>
                               
                                @endforeach

                               
                            </tbody>


                        </table>
                        <hr>
                        <div class=" m-0">
                            <x-jet-button >Delete Marks</x-jet-button>
                          </div>
                       
                    </form>


                    </div>
            </div>
        </div>
    </div>

    </div>
    </div>
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
