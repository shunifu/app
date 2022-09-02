<x-app-layout>
    <x-slot name="header">
       
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light  
              <div class="card-header">
                <h3 class="card-title">Add School Partner Type</h3>
              </div>

                <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_350,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_34_style_light_align_center:Types of Partners,w_0.3,y_0.18/v1614966941/pexels-photo-4427957_emjxeb.jpg" alt="">
                <div class="card-body">
                  <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
                 <div class="text-muted">
                    <p class="card-text"> Use this section to add the school partners <br>
                        A school partner could be a sponsor, creditor or service provider.
                  
                    </p>
                  
                 </div>
                
                </div>
            </div>     
              
              <!-- /.card-header -->
              <!-- form start -->
              <div class="row">
<div class="col-md-6">
    <div class="card card-light  ">
    <form action="{{route('partner_type.store')}}" method="post">
        <div class="card-body">
              @csrf
              <div class="form-row">

                <div class="form-group">
                    <x-jet-label> Partner Type Name</x-jet-label>
                    <x-jet-input name="partner_type" class="col-auto" placeholder="Example Service Provider" ></x-jet-input>
                    @error('partner_type')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                    </div>
        </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <x-jet-button>Add Type</x-jet-button>
        </div>
    </form>
    </div>
</div>

<div class="col-md-6">
    <div class="card card-light  ">
    
    <table class="table">
        <thead>
            <tr>
                <th>Partner Type</th>
                <th>Manage</th>
                
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($partner_types as $item)
                <tr>
                    <td>{{$item->type_name}}</td>
                  
                     <td>
                       <a href="/accounting/partners/type/edit/{{$item->id}}" class="link"><i class="fas fa-edit"></i></a>
                       <a href="/accounting/partners/type/delete/{{$item->id}}"><i class="fas fa-trash"></i></a>
                     </td>
                 </tr>

                @endforeach
               </tr>
          
        </tbody>
    </table>
    
    </div>
</div>
                
              </div>
              
           
      
      
        </div>
     
            
          </div>  
    
</x-app-layout>

 