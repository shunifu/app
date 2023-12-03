<x-app-layout>
    <x-slot name="header">
      
    </x-slot>



    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title p4"><a href="/settings/assessement/"><i class="fas fa-hand-point-left mr-2"></i> </a>Edit Assessement Type </h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.80/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_34_style_light_align_center:Edit Assessment Weight ,w_0.2,y_0.14/v1615202389/Untitled_design_1_oaroft.png" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to edit  <span class="text-bold">Assessment Weights</span> <br>
          
            </p>
          
         </div>
        
        </div>
    </div> 
<div class="row">
    
  <div class="col-md-12">

    <div class="card card-light">
        <div class="card-header">
         

       
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/assessement/weight/update" method="post">
        <!-- /beginning of card-body -->
          <div class="card-body">
                @csrf
               
                @foreach ($assessement_weight as $item)
                    
                @endforeach

                {{-- <div class="form-group">
                    <x-jet-label> Term</x-jet-label>
                    <x-jet-input name="term" value="{{$item->term_name}}" readonly ></x-jet-input>
                    @error('term_name')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div> --}}

                <div class="form-group">
                    <x-jet-label> Continous Assessement Weight</x-jet-label>
                    <x-jet-input name="ca_weight" value="{{$item->ca_percentage}}" ></x-jet-input>
                    @error('ca_weight')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div>

                <div class="form-group">
                  <x-jet-label> Mock  Weight</x-jet-label>
                  <x-jet-input name="mock_weight" value="{{$item->mock_percentage}}" ></x-jet-input>
                  @error('mock_weight')
                  <span class="text-danger">{{$message}}</span>  
                  @enderror
              </div>

                <div class="form-group">
                    <x-jet-label> Examination Assessement Weight</x-jet-label>
                    <x-jet-input name="exam_weight" value="{{$item->exam_percentage}}" ></x-jet-input>
                    @error('exam_weight')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div>

                <input type="hidden" name="id" value="{{$item->id}}">

          </div>
          <!-- /end of card-body -->

          <div class="card-footer">
            <x-jet-button>Update Assessement Weight</x-jet-button>
          </div>
        </form>
      </div>

  </div>




  </div>


      
    </div>   
            
     
    
</x-app-layout>