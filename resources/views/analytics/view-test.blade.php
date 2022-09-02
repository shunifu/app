<ul>

    @foreach($student_average as $key)
    <li>
        {{$key[0]->student_id}}-{{$key[0]->name}}-{{$key[0]->lastname}}---{{$key[0]->average_mark}}
    </li>
   
    {{-- {{ $key[0]['student_id'] }} --}}
  {{-- dd($data[1][0]['student_id']); --}}
@endforeach


   
</ul>



<ul>


    {{-- @foreach ($student_average as $k => $v)
    <li>
         @foreach (current($v) as $y[0] => $x)
            
                {{$x}}
           
        @endforeach 
    </li>
    @endforeach --}}