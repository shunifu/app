@if(empty(\App\Models\School::all('school_logo')))

no logo

@else

@foreach (\App\Models\School::all('school_logo') as $item)
<img src={{asset('storage/'.$item->school_logo) }} width="64" height="64" class=" brand-image img-circle"  />
@endforeach

@endif