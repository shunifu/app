<x-app-layout>
    <x-slot name="header">


    </x-slot>
   
    @include('partials.report_header')


{{-- Beginning of Stream Card --}}

   <div class="card ">
      

       <form action="{{route('report.stream')}}" method="post">
         @csrf

       <div class="card-body">
       
        <input type="hidden" name="p_class" value="class_based">

         <div class="form-row">

           

            <div class="col-md-4 form-group">
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



            <div class="col-md-4 form-group">
         <x-jet-label>Choose Class</x-jet-label>
         <select class="form-control" name="grade">
            <option value="">Select Class</option>
            @foreach($classes as $class)
                <option value="{{ $class->id }}">
                    {{ $class->grade_name }}
                </option> 
            @endforeach
        </select>
        @error('grade')
            <span class="text-danger">{{ $message }}</span>
        @enderror
     </div>
   
    
     <div class="col-md-4 form-group">
        <x-jet-label>Choose Report Template</x-jet-label>
       
        <select name="report_template" id="report_template" class="form-control">
            <option value="">Select Template</option>
          @foreach ($templates as $item)
         
          <option value="{{$item->id}}">{{$item->template_name}}</option>
          @endforeach
        </select>

    </div>
       </div>

       <div class="card-footer text-muted">
         <x-jet-button id="btnSelector" onclick="callAjax();">Generate Class Report</x-jet-button>
       </div>
       </form>
       </div>
   </div>



</x-app-layout>
