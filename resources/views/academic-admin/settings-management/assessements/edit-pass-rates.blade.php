<x-app-layout>
    <x-slot name="header">
      
    </x-slot>



    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Edit  Pass Rates </h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.80/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_34_style_light_align_center:Edit Pass Rates for {{$passrates->section_name}} Section,w_0.2,y_0.14/v1615202389/Untitled_design_1_oaroft.png" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to edit  <span class="text-bold">Pass Rates for {{$passrates->section_name}} </span> <br>
          
            </p>
          
         </div>
        
        </div>
    </div> 
<div class="row">
    
  <div class="col-md-12">

    <div class="card card-light">
        <div class="card-header">
         
    <a href="javascript:history.back()"><x-jet-button>Back</x-jet-button></a>
       
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('pass-rates.update') }}" method="post">
        <!-- /beginning of card-body -->
          <div class="card-body">
                @csrf

                <div class="form-group">
                    <x-jet-label>Section</x-jet-label>
                    <select class="form-control" name="section">
                    <option value="{{$passrates->section_id}}">{{$passrates->section_name}}</option>
                    </select>
                    @error('section')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div>

                <div class="form-group">
                    <x-jet-label> Number of Subjects</x-jet-label>
                    <input type="text" name="number_of_subjects" value="{{$passrates->number_of_subjects}}" class="form-control" aria-label="">
                    @error('number_of_subjects')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                    </div>

                    <div class="form-group">
                        <x-jet-label> Passing Rate</x-jet-label>
                        <div class="input-group mb-3">
                            <input type="text" name="passing_rate" value="{{$passrates->passing_rate}}"  class="form-control" aria-label="">
                            <div class="input-group-append">
                              <span class="input-group-text">%</span>
                            </div>
                          </div>
                        @error('passing_rate')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label>Passing Subject Rule</x-jet-label>
                            <select class="form-control" name="passing_subject_rule">
                                @if ($passrates->passing_subject_rule==0)
                                <option value="{{$passrates->passing_subject_rule}}">Does Not Apply</option>    
                                @elseif ($passrates->passing_subject_rule==1)
                                <option value="{{$passrates->passing_subject_rule}}">Applies</option>   
                                @endif
                               
                            <option value="1">Applies</option>
                            <option value="0">Does Not Apply</option>
                            </select>
                            @error('passing_subject_rule')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>
              
                        <div class="form-group">
                          <x-jet-label>Average Calculation Rule</x-jet-label>
                          <select class="form-control" name="average_calculation">
                          @if ($passrates->average_calculation=="default")
                                <option value="{{$passrates->average_calculation}}">Count all subjects</option>    
                                @elseif ($passrates->average_calculation=="custom")
                                <option value="{{$passrates->average_calculation}}">Pick best number of subjects</option>   
                                @endif
                             
                                <option value="custom">Pick best number of subjects</option>
                                <option value="default">Count all subjects</option>
                            </select>
                          @error('average_calculation')
                          <span class="text-danger">{{$message}}</span>  
                          @enderror
                      </div>

                      <div class="form-group">
                        <x-jet-label> Ties </x-jet-label>
                        <select class="form-control" name="tie_type">
                          @if  ($passrates->tie_type=="share_n_+_1")
                          <option value="{{$passrates->average_calculation}}">Ties share position but skip</option>  
                          @endif
                        <option value="share_n_+_1">Ties share position but skip </option>
                        </select>
                        @error('tie_type')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                    </div>

                    <div class="form-group">
                      <x-jet-label>Term Average Type</x-jet-label>
                      <select class="form-control" name="term_average_type" id="term_average_type">

                        <option value="{{$passrates->term_average_type}}">{{$passrates->term_average_type}}</option>   

                      <option value="decimal">Decimal Number</option>
                      <option value="whole">Whole Number</option>
                      </select>
                      @error('term_average_type')
                      <span class="text-danger">{{$message}}</span>  
                      @enderror
                  </div>

                  @if (($passrates->term_average_type=="decimal"))
                  <div class="form-group" id="decimal_places">
                    <x-jet-label>Number of Decimal Places</x-jet-label>
                    <input type="number" class="form-control" id="decimal_number" value="{{$passrates->number_of_decimal_places}}" name="number_of_decimal_places">
                    @error('number_of_decimal_places')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div>
                  @else

                  <div class="form-group" id="decimal_places">
                    <x-jet-label>Number of Decimal Places</x-jet-label>
                    <input type="number" class="form-control" id="decimal_number" value="0"  readonly name="number_of_decimal_places">
                    @error('number_of_decimal_places')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div>

                  <input type="hidden" name="number_of_decimal_places" value="0">
                      
                  @endif
            
                  {{-- <div class="form-group" id="decimal_places">
                    <x-jet-label>Number of Decimal Places</x-jet-label>
                    <input type="number" class="form-control" id="decimal_number" name="number_of_decimal_places">
                    @error('number_of_decimal_places')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div> --}}
                <input type="hidden" name="pass_rate_id" value="{{$passrates->id}}">

          </div>
          <!-- /end of card-body -->

          <div class="card-footer">
            <x-jet-button>Update Passing Rates</x-jet-button>
          </div>
        </form>
      </div>

  </div>




  </div>


      
    </div>   
    <script>
    $(document).ready(function() {
      $('#decimal_places').hide();
        if (location.hash) {
            $("a[href='" + location.hash + "']").tab("show");
        }
        $(document.body).on("click", "a[data-toggle='tab']", function(event) {
            location.hash = this.getAttribute("href");
        });
    });
    $(window).on("popstate", function() {
        var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
        $("a[href='" + anchor + "']").tab("show");
    });
    
    
    $("#term_average_type").change(function (e) { 
      e.preventDefault();
    
      var item=$(this).val();
    
    if (item=="decimal") {
    
        //Show list of subjects
        $('#decimal_places').show();
        
        
    }else{
      $('#number_of_decimal_places').val("0");
        $('#decimal_places').show();
    }
      
    });
          </script>
            
     
    
</x-app-layout>