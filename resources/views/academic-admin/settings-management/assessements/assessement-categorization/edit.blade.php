<x-app-layout>
    <x-slot name="header">
      
    </x-slot>



    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title p4"><a href="/settings/assessement/"><i class="fas fa-hand-point-left mr-2"></i> </a>Edit Assessement Categorization </h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.80/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_34_style_light_align_center:Edit Assessment Categorization ,w_0.2,y_0.14/v1615202389/Untitled_design_1_oaroft.png" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to edit  <span class="text-bold">Assessment Categorization</span> <br>
          
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
        <form action="{{ route('CA_Exam.update') }}" method="post">
        <!-- /beginning of card-body -->
          <div class="card-body">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <x-jet-label> Term</x-jet-label>
                    <x-jet-input name="term" value="{{$categorizations->term_name}}" readonly ></x-jet-input>
                    @error('term_name')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div>

                <div class="form-group">
                    <x-jet-label> Assessement</x-jet-label>
                    <x-jet-input name="term" value="{{$categorizations->assessement_name}}" readonly ></x-jet-input>
                    @error('assessement_name')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div>

                <div class="form-group">
                    <x-jet-label> Assign As</x-jet-label>
                  
                   
                     <select class="form-control" name="assign_as" id="assign_as">
                        <option value="{{$categorizations->catergorization_id}}">{{$categorizations->assign_as}}</option>
                       <option value="">---------------</option>
                       <option value="CA">Continous Assessement </option>
                       <option value="EXAM">Examination</option>
                     </select>
                   
                    @error('assign_as')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                    </div>



                <input type="hidden" name="id" value="{{$categorization_id->id}}">

          </div>
          <!-- /end of card-body -->

          <div class="card-footer">
            <x-jet-button>Update Assessement Categorization</x-jet-button>
          </div>
        </form>
      </div>

  </div>




  </div>


      
    </div>   
            
     
    
</x-app-layout>