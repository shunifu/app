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



    @include('partials.parent-link-header')

    <div class="mb-4">


    </div>
    <div class="col-md-12 ">
        <div class="card card-light   elevation-3">

            <div class="card-body">
                <form action="{{ route('classteacher_parent_link_show') }}" method="post">

                    @csrf
                    <div class="form-row">

                        <div class="col-md-12 form-group">
                            <x-jet-label>Select Class</x-jet-label>
                            <select class="form-control" name="class_id" id="class_id">
                                <option value="">Select My Class</option>
                                @foreach($class as $myclass)
                                    <option value="{{ $myclass->grade_id }}"> {{ $myclass->grade_name }}</option>
                                @endforeach
                            </select>
                            @error('class_id')
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
