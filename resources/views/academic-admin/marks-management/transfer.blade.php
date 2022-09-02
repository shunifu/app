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
   
      
    </x-slot>


 
@include('partials.marks-header')

   <p>
       If you want to transfer marks from one assessement to another, use this section.
   </p>
    <div class="mb-4">
  
     
    </div>
    <div class="col-md-12 ">
        <div class="card card-light   elevation-3">
           
            <div class="card-body">
                <form action="{{ route('marks.transfering') }}" method="post">

                            @csrf
                            <div class="form-row">
    
                                <div class="col form-group">
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
    
                                <div class="col form-group">
                                    <x-jet-label>Transfer from</x-jet-label>
                                    <select class="form-control" name="transfer_from">
                                        <option value="">Select Assessement</option>
                                        @foreach($assessements as $assessement)
                                            <option value="{{ $assessement->assessement_id }}">
                                                {{ $assessement->assessement_name }}
                                             
                                        @endforeach
                                    </select>
                                    @error('transfer_from')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col form-group">
                                    <x-jet-label>Transfer to</x-jet-label>
                                    <select class="form-control" name="transfer_to">
                                        <option value="">Select Assessement</option>
                                        @foreach($assessements as $assessement)
                                            <option value="{{ $assessement->assessement_id }}">
                                                {{ $assessement->assessement_name }}
                                             
                                        @endforeach
                                    </select>
                                    @error('transfer_to')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
    
                            </div>

                        <div class="card-footer col-auto">
                            <x-jet-button id="btnSelector">Transfer Marks</x-jet-button>
                        </div>
                </form>
       

            </div>

        </div>
    </div>

    <div class="mb-4">
  
     
    </div>
 
 
    
</x-app-layout>