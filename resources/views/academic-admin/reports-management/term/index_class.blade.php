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
                <p class="card-text">Term-Based Report Management </p>
            </div>
            <hr>
            <p class="text-muted">Please use this section to generate a school report for students</p>
          

        </div>

    </div>
    <div id="loaderIcon" class="spinner-border text-primary" style="display:none" role="status">
        <span class="sr-only">Loading...</span>
    </div>

   
    <div class="row ">

{{-- Beginning of Section Card --}}
        {{-- <div class="col">
            <div class="card border-top border-primary">
                <div class="card-header">
                    <h4 class="lead">Section Based Report</h4>
                    <small> If you want to print or view reports for a section then use section.</small>
                </div> --}}
                {{-- <form action="/report/term-based/section/" method="POST"> --}}
               {{-- <form action="{{route('report.section')}}" method="post">
                  @csrf
                <div class="card-body">
                 

                @include('partials.term')
                

            <div class="col  form-group">
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

              <div class="col  form-group">
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
                   
                  <x-jet-button class="disable" id="btnSelector">Generate Section Report</x-jet-button>

                </div>
                </form>
            </div>

        </div> --}}
{{-- End of Section Card --}}



{{-- Beginning of Stream Card --}}
<div class="col">
   <div class="card border-top border-primary">
       <div class="card-header">
           <h4 class="lead">School  Report</h4>
           <small> If you want to print or view reports for a stream then use section.</small><br>
           <small><span class="text-bold">The loading of the report may take a few minutes depending on the speed of the network and the number of students in the stream. </span></small>
       </div>
       <form action="{{route('report.stream')}}" method="post">
         @csrf
       <div class="card-body">
         @include('partials.term')

         <input type="hidden" name="p_class" value="class_based">

        <div class="col-auto form-group">
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
     <div class="col-auto  form-group">
        <x-jet-label>Choose Column Color</x-jet-label><br>
        <input type="color"  name="column_color" id="column_color">
        @error('column_color')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-auto  form-group">
        <x-jet-label>Choose Report Template</x-jet-label>
       
        <select name="report_template" id="report_template" class="form-control">
            <option value="">Select Template</option>
            <option value="default">Shunifu Default</option>
            <option value="plus">Shunifu Plus</option>
            <option value="lite">Shunifu Lite</option>
           

        </select>

       
    </div>

    <div class="form-group col-auto" id="lite_report">
      <label for="">Lite template</label>
      <select name="lite_report_template" id="lite_report_template" class="form-control">
        <option value="">Select Template</option>
        <option value="plus">Exam Only</option>
        <option value="lite">CA Only</option>
       

    </select>

    @error('report_template')
        <span class="text-danger">{{ $message }}</span>
    @enderror
    </div>


    
       </div>
       <div class="card-footer text-muted">
         <x-jet-button id="btnSelector" onclick="callAjax();">Generate Report</x-jet-button>
       </div>
       </form>
   </div>

</div>
{{-- End of Stream Card --}}








    <script>
        $(document).ready(function () {
            $("#lite_report").hide();
            $("#report_template").on('change', function() {

                var item= $(this).find(":selected").val();
            if (item=="lite") {
                $("#lite_report").show();
            }else{
                $("#lite_report").hide();
            }
               
            });

           
        });
    </script>


</x-app-layout>
