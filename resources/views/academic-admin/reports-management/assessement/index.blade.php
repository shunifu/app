<x-app-layout>
    <x-slot name="header">


    </x-slot>
    <div class="card  ">
        <img class="card-img-top"
            src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,q_auto,w_970/b_rgb:000000,e_gradient_fade,y_-0.5/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_40_style_light_align_center:Report Management,w_0.3,y_0.18/v1612793225/shunifu/pexels-photo-4143800_vqecd5.jpg"
            alt="">
        <div class="card-body">
            <h3 class="lead">Hi,  {{ Auth::user()->salutation }} {{ Auth::user()->name }}  {{ Auth::user()->lastname }}</h3>
            <div class="text-muted">
                <p class="card-text">Assessement Based Report Management </p>
            </div>
            <hr>
            <p class="text-muted">Please use this section to generate a school report for students based on assessment</p>
          

        </div>

    </div>
    <div class="row ">

{{-- Beginning of Section Card --}}
        <div class="col-md-3 pb-5">
            <div class="card border-top border-primary">
                <div class="card-header">
                    <h4 class="lead">Section Based Report</h4>
                    <small> If you want to print or view reports for a section then use section.</small>
                </div>
                {{-- <form action="/report/term-based/section/" method="POST"> --}}
               <form action="{{route('report.section')}}" method="post">
                  @csrf
                <div class="card-body">
                 

                @include('partials.assessement_list')
                

            <div class="col-auto  form-group">
                  <x-jet-label>Select Section</x-jet-label>
                  <select class="form-control" name="section">
                      <option value="">Section</option>
                      @foreach($sections as $section)
                          <option value="{{ $section->id }}">
                              {{ $section->section_name }}
                          </option>
                           
                      @endforeach
                  </select>
                  @error('section')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
            </div>

              <div class="col-auto  form-group">
               <x-jet-label>Position Type</x-jet-label>
               <select class="form-control" name="position_type">
                   <option value="">Select Position Type</option>
                   <option value="stream_based">Stream Based</option>
                   <option value="class_based">Class Based</option>    
               </select>
               @error('position_type')
                   <span class="text-danger">{{ $message }}</span>
               @enderror
           </div>

                </div>
                <div class="card-footer text-muted">
                   
                  <x-jet-button id="btnSelector">Generate Section Report</x-jet-button>

                </div>
                </form>
            </div>

        </div>
{{-- End of Section Card --}}



{{-- Beginning of Stream Card --}}
<div class="col-md-3 pb-5">
   <div class="card border-top border-primary">
       <div class="card-header">
           <h4 class="lead">Stream Based Report</h4>
           <small> If you want to print or view reports for a stream then use section.</small>
       </div>
       <form action="{{route('report.stream-assessement-based')}}" method="post">
         @csrf
       <div class="card-body">
         @include('partials.assessement_list')

        <div class="col-auto form-group">
         <x-jet-label>Stream</x-jet-label>
         <select class="form-control" name="stream">
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
     <div class="col-auto  form-group">
        <x-jet-label>Position Type</x-jet-label>
        <select class="form-control" name="position_type">
            <option value="">Select Position Type</option>
            <option value="stream_based">Stream Based</option>
            <option value="class_based">Class Based</option>    
        </select>
        @error('position_type')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
       </div>
       <div class="card-footer text-muted">
         <x-jet-button id="btnSelector">Generate Stream Report</x-jet-button>
       </div>
       </form>
   </div>

</div>
{{-- End of Stream Card --}}


{{-- Beginning of Class Card --}}
<div class="col-md-3 pb-5">
   <div class="card border-top border-primary">
       <div class="card-header">
           <h4 class="lead">Class Based Report</h4>
           <small> If you want to print or view reports for a stream then use section.</small>
       </div>
       <form action="{{route('report.class')}}" method="post">
         @csrf
       <div class="card-body">
         @include('partials.assessement_list')

        <div class="col form-group">
         <x-jet-label>Class</x-jet-label>
         <select class="form-control" name="section">
             <option value="">Select Class</option>
             @foreach($classes as $class)
                 <option value="{{ $class->id }}">
                     {{ $class->grade_name }}
                 </option>
             @endforeach
         </select>
         @error('class')
             <span class="text-danger">{{ $message }}</span>
         @enderror
     </div>
     <div class="col-auto  form-group">
        <x-jet-label>Position Type</x-jet-label>
        <select class="form-control" name="position_type">
            <option value="">Select Position Type</option>
            <option value="stream_based">Stream Based</option>
            <option value="class_based">Class Based</option>    
        </select>
        @error('position_type')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
       </div>
       <div class="card-footer text-muted">
         <x-jet-button id="btnSelector">Generate Class Report</x-jet-button>
       </div>
      </form>
   </div>

</div>
{{-- End of Stream Card --}}



{{-- Beginning of Student Card --}}
<div class="col-md-3 pb-5">
   <div class="card border-top border-primary">
       <div class="card-header">
           <h4 class="lead">Student Based Report</h4>
           <small> If you want to print or view reports for a stream then use section.</small>
       </div>
       <form action="{{route('report.student')}}" method="post">
         @csrf
       <div class="card-body">
         @include('partials.assessement_list')

        <div class="col-auto form-group">
         <x-jet-label>Class</x-jet-label>
         <select class="form-control" name="section">
             <option value="">Select Class</option>
             @foreach($classes as $class)
                 <option value="{{ $class->id }}">
         {{ $class->grade_name }}
                 </option>
                  
             @endforeach
         </select>
         @error('class')
             <span class="text-danger">{{ $message }}</span>
         @enderror
     </div>
     <div class="col-auto  form-group">
        <x-jet-label>Position Type</x-jet-label>
        <select class="form-control" name="position_type">
            <option value="">Select Position Type</option>
            <option value="stream_based">Stream Based</option>
            <option value="class_based">Class Based</option>    
        </select>
        @error('position_type')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
       </div>
       <div class="card-footer text-muted">
          
         <x-jet-button id="btnSelector">Generate Student Report</x-jet-button>

       </div>
      </form>
   </div>

</div>
{{-- End of Stream Card --}}

    </div>


</x-app-layout>
