<x-app-layout>
    <x-slot name="header">


    </x-slot>
   
    @include('partials.report_header')


{{-- Beginning of Stream Card --}}

   <div class="card ">
      

       <form action="{{route('cbe_report.create')}}" method="post">
         @csrf

       <div class="card-body">
       
         <input type="hidden" name="p_class" value="stream_based">

         <div class="form-row">

            <div class="col-md-6 form-group">
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



            <div class="col-md-6 form-group">
         <x-jet-label>Choose Stream</x-jet-label>
         <select class="form-control " name="stream">
             <option value="">Select Stream</option>
             @foreach($streams as $stream)
                 <option value="{{ $stream->id }}">
                     {{ $stream->stream_name }}
                 </option> 
             @endforeach
         </select>
         @error('stream')
             <span class="text-danger">{{ $message }}</span>
         @enderror
     </div>
   
    
     {{-- <div class="col-md-4 form-group">
        <x-jet-label>Choose Report Template</x-jet-label>
       
        <select name="report_template" id="report_template" class="form-control">
            <option value="">Select Template</option>
          @foreach ($templates as $item)
         
          <option value="{{$item->id}}">{{$item->template_name}}</option>
          @endforeach
        </select>

    </div> --}}
       </div>

       <div class="card-footer text-muted">
         <x-jet-button id="btnSelector" onclick="callAjax();">Generate Stream Report</x-jet-button>
       </div>
       </form>
       </div>
   </div>



</x-app-layout>
