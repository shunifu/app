<x-app-layout>
    <x-slot name="header">
       
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light  ">
              <div class="card-header">
                <h3 class="card-title">Add School Partner</h3>
              </div>

                <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_370,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_34_style_light_align_center:Partners,w_0.2,y_0.14/v1614966738/pexels-photo-1181357_qua3ve.jpg" alt="">
                <div class="card-body">
                  <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
                 <div class="text-muted">
                    <p class="card-text"> Use this section to add the school partners <br>
                       
                  
                    </p>
                  
                 </div>
                
                </div>
            </div>     
              
              <!-- /.card-header -->
              <!-- form start -->
              <div class="row">
                <div class="col-md-4">
       
                    <div class="card card-light">
                    
                        <div class="card-header">
                          <h3 class="card-title"> School Partners Management</h3>
                        </div>
    <form action="{{route('partner.store')}}" method="post">
        <div class="card-body">
              @csrf
            

                <div class="form-group">
                    <x-jet-label>Partner Type</x-jet-label>
                    <select class="form-control" name="partner_type">
                      <option value="">Select Partner</option>
                      @foreach ($partner_type as $partner_type_item)
                          <option value="{{$partner_type_item->id}}">{{$partner_type_item->type_name}}</option>
                      @endforeach
                    </select>
                    @error('partner_type')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                    </div>

                <div class="form-group">
                    <x-jet-label> Partner Name</x-jet-label>
                    <x-jet-input name="partner_name" required class="col-auto" placeholder="Enter name of Partner" ></x-jet-input>
                    @error('partner_name')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div>

                    <div class="form-group">
                        <x-jet-label> Partner Phone Contact</x-jet-label>
                        <x-jet-input name="partner_contact" required class="col-auto"  required placeholder="Enter Partner Contact" ></x-jet-input>
                        @error('partner_contact')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                    </div>

                    <div class="form-group">
                        <x-jet-label> Partner Email Address</x-jet-label>
                        <x-jet-input name="partner_email" required type="email" class="col-auto" placeholder="Enter Partner Address" ></x-jet-input>
                        @error('partner_email')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                    </div>

                    <div class="form-group">
                        <x-jet-label> Partner Physical Address</x-jet-label>
                        <textarea name="partner_physical_address" required  placeholder="Enter Physical Address"  class="form-control"></textarea>
                        @error('partner_physical_address')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                    </div>
       
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <x-jet-button>Add Partner</x-jet-button>
        </div>
    </form>
    </div>
</div>

<div class="col-md-8">
    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">List of Partners</h3>
        </div>
        <!-- /.card-header -->
      
        <!-- /beginning of card-body -->
          <div class="card-body">
            <div class="responsive">
            <table class="table table-hover table-bordered table-responsive">
              <thead class="thead-light">
            <tr>
                <th>Partner Type</th>
                <th>Partner Name</th>
                <th>Partner Contact</th>
                <th>Partner Email</th>
               
                <th>Manage</th>
                
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($partners as $item)
                <tr>
                    <td>{{$item->type_name}}</td>
                    <td>{{$item->partner_name}}</td>
                  
                    <td>{{$item->partner_phone_contact}}</td>
                    <td>{{$item->partner_email}}</td>
                   
                   
                     <td class="">
                        <div class="btn-group btn-group-md">
                          <a href="/accounting/partners/edit/{{encrypt($item->partner_id)}}" class="btn btn-info"><i class="fas fa-edit mr-1"></i>Edit</a>
                          <a href="/accounting/partners/delete/{{encrypt($item->partner_id)}}" class="btn btn-danger exam_assignment_delete"><i class="fas fa-trash mr-1"></i>Delete</a>
                        </div>


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
     
            
          </div>  
    
</x-app-layout>

 