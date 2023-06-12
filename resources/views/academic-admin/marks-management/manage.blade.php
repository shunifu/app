<x-app-layout>
    <x-slot name="header">
      <style>
        .profile-head {
        transform: translateY(5rem)
    }
    
    .cover {
        background-image: url(https://images.pexels.com/photos/5965705/pexels-photo-5965705.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940);
      background-size: cover;
        background-repeat: no-repeat
    }
    
    </style>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/js/bootstrap-multiselect.min.js" integrity="sha512-fp+kGodOXYBIPyIXInWgdH2vTMiOfbLC9YqwEHslkUxc8JLI7eBL2UQ8/HbB5YehvynU3gA3klc84rAQcTQvXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/css/bootstrap-multiselect.min.css" integrity="sha512-jpey1PaBfFBeEAsKxmkM1Yh7fkH09t/XDVjAgYGrq1s2L9qPD/kKdXC/2I6t2Va8xdd9SanwPYHIAnyBRdPmig==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  
    </x-slot>


 
@include('partials.marks-header')
    
   
    <div class="mb-4">
  
     
    </div>
    <div class="col-md-12 ">
        <div class="card card-light   elevation-3">
           
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
       

            </div>

        </div>
    </div>

    <div class="mb-4">
  
     
    </div>
 
 
    
</x-app-layout>