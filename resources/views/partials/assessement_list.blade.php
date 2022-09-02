<div class="col-auto form-group">
    <x-jet-label>Select Assessement</x-jet-label>
    <select class="form-control" name="assessement">
        <option value="">Select Assessement</option>
        @foreach($assessements as $assessement)
            <option value="{{ $assessement->assessement_id }}">
                {{ $assessement->assessement_name }}-{{ $assessement->academic_session }}
             
        @endforeach
    </select>
    @error('assessment')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>