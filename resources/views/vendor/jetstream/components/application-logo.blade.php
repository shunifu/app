@foreach (\App\Models\School::all('school_logo') as $item)
@if(empty(asset('storage/'.$item->school_logo)))
    <img src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1616620933/african_savanna-t2_la8phu.jpg" width="58" class=" brand-image img-circle"  />  
@else
<img src={{asset('storage/'.$item->school_logo) }} width="58" class=" brand-image img-circle"  />
@endif
@endforeach
