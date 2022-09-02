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

    <div class="mb-4">


    </div>
    <div class="col-md-12 ">
        <div class="card card-light   elevation-3">

            <div class="card-body">
                <form action="{{ route('marks.analysis_store') }}" method="post">

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
                                    </option>
                                @endforeach
                            </select>
                            @error('assessement_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer col-auto">
                        <x-jet-button id="btnSelector">Show Analytics</x-jet-button>
                    </div>
                </form>


            </div>

        </div>
    </div>

    <div class="mb-4">


    </div>



</x-app-layout>
