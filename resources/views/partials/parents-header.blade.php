<div class="col-md-12 ">
    <div class="card card-light   elevation-3">
       
        <div class="card-body">
            <form action="{{ route('parents.child_performance') }}" method="post">

                        @csrf
                        <div class="form-row">

                            <div class="col-md-6 form-group">
                                <x-jet-label>Select Your Child</x-jet-label>
                                <select class="form-control" name="student_id" id="student_id">
                                    <option value="">Select Child</option>
                                    @foreach($mychildren as $child)
                                        <option value="{{ $child->student_id }}">
                                {{ $child->name}} {{ $child->middlename}}  {{ $child->lastname}}</option>
                                    @endforeach
                                </select>
                                @error('student_id')
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
                        <x-jet-button id="btnSelector">View  Child's Performance</x-jet-button>
                    </div>
            </form>
   

        </div>

    </div>
</div>