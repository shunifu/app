<x-app-layout>
    <x-slot name="header">
      
    </x-slot>



    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Edit   {{$term->term_name}} </h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.80/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_34_style_light_align_center:Edit {{$term->term_name}} ,w_0.2,y_0.14/v1615202389/Untitled_design_1_oaroft.png" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to edit  <span class="text-bold">{{$term->term_name}} </span> <br>
          
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
        <form action="{{ route('term.update') }}" method="POST" >

          @method('PATCH');
            @csrf
            {{-- @method('patch') --}}
        <!-- /beginning of card-body -->
        <input type="hidden" value="{{$term->id}}" name="term_id">
        <input type="hidden" value="{{$term->academic_session}}" name="academic_session">
          <div class="card-body">
            
                <div class="form-group">
                    <x-jet-label>Term Name</x-jet-label>
                   
                    <input type="text" name="term_name" class="form-control" value="{{$term->term_name}}">
                    @error('term_name')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div>

                <div class="form-group">
                    <x-jet-label>Opening Date</x-jet-label>
                   
                    <input type="date" name="opening_date" class="form-control" value="{{$term->start_date}}">
                    @error('opening_date')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div>

                <div class="form-group">
                    <x-jet-label>Closing Date</x-jet-label>
                   
                    <input type="date" name="closing_date" class="form-control" value="{{$term->end_date}}">
                    @error('closing_date')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div>

                <div class="form-group">
                    <x-jet-label>Borders Return</x-jet-label>
                   
                    <input type="date" name="borders_return" class="form-control" value="{{$term->borders_return_date}}">
                    @error('borders_return')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div>

                <div class="form-check">
                  <label class="form-check-label">
                      @if ($term->final_term==1)
                      <input type="checkbox" class="form-check-input" name="final_term" id="" value="1" checked>
                      @else
                      <input type="checkbox" class="form-check-input" name="final_term" id="" value="0" >
                      @endif
                     
                    Final Term
                  </label>
                </div>

                   

                     
              
            
              

          </div>
          <!-- /end of card-body -->

          <div class="card-footer">
            <x-jet-button>Update Term</x-jet-button>
          </div>
        </form>
      </div>

  </div>




  </div>


      
    </div>   
            
     
    
</x-app-layout>