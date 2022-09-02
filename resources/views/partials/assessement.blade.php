
<div class="col form-group">
    <x-jet-label>Assessement </x-jet-label>
    <select class="form-control" name="assessement">
    <option value="">Select Name</option>
    @foreach ($assessements as $assessement)
    <option value="{{$assessement->id}}">{{$assessement->assessement_name}}</option>
    @endforeach
    </select>
    @error('assessement')
    <span class="text-danger">{{$message}}</span>  
    @enderror
</div>

<div class="col form-group">
    <x-jet-label>Indicator</x-jet-label>
   <select class="form-control" name="analysis_indicator" id="analysis_indicator">
    <option value="">Select Indicator</option>
    <option value="stream_scoresheet">Stream Scoresheet</option>
    <option value="stream_summary">Stream Summary</option>
    <option value="subject_analysis">Subject Analysis</option>
    <option value="pass_analysis">Pass Analysis</option><!---1---->
    <option value="failure_analysis">Failure Analysis</option><!---2---->
    </select>
    @error('analysis_indicator')
    <span class="text-danger">{{$message}}</span>  
    @enderror
</div>

