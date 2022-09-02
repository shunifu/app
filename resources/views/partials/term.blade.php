<div class="col form-group">
    <x-jet-label>Select Term</x-jet-label>
    <select class="form-control" name="term">
        <option value="">Term</option>
        @foreach($terms as $term)
            <option value="{{ $term->term_id }}">
                {{ $term->term_name }}-{{ $term->academic_session }}
             
        @endforeach
    </select>
    @error('term')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>