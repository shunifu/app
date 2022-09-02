<x-app-layout>
    <x-slot name="header">
      
    </x-slot>



    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title p4"><a href="/settings/assessement/"><i class="fas fa-hand-point-left mr-2"></i> </a>Edit Assessement Type </h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.80/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_34_style_light_align_center:Edit Assessment Type ,w_0.2,y_0.14/v1615202389/Untitled_design_1_oaroft.png" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to edit  <span class="text-bold">Assessment Type</span> <br>
          
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
        <form action="{{ route('assessement-type.update') }}" method="post">
        <!-- /beginning of card-body -->
          <div class="card-body">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <x-jet-label> Assessement Type Name</x-jet-label>
                    <x-jet-input name="assessement_type" value="{{$assessement->assessement_type_name}}" placeholder="Example Test" ></x-jet-input>
                    @error('assessement_type')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                    </div>

                <input type="hidden" name="id" value="{{$id}}">

          </div>
          <!-- /end of card-body -->

          <div class="card-footer">
            <x-jet-button>Update Assessement Type</x-jet-button>
          </div>
        </form>
      </div>

  </div>




  </div>


      
    </div>   
            
     
    
</x-app-layout>