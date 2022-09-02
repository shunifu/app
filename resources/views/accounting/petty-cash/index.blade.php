<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light  ">
              <div class="card-header">
                <h3 class="card-title">Add Petty Cash</h3>
              </div>

                <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_270,w_970/b_rgb:000000,e_gradient_fade,y_-0.60/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_36_style_light_align_center:Petty Cash,w_0.3,y_0.12/v1615033111/Untitled_design_5_kc8wew.png" alt="">
                <div class="card-body">
                  <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
                 <div class="text-muted">
                    <p class="card-text">  Use this section to add Petty Cash. <br>
                  
                    </p>
                  
                 </div>
                
                </div>
          </div>
                
          <div class="card card-light  ">
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('pettycash.store')}}" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-row">
                      <div class="col-md-4 form-group">
                        <x-jet-label>Partner</x-jet-label>
                       <select class="form-control" name="partner">
                        <option value="0">Select Partner</option>
                        @foreach ($partners as $partner)
                        <option value="{{$partner->id}}">{{$partner->partner_name}}</option>
                            
                        @endforeach
                       </select>
                        @error('partner')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>

                        <div class="col-md-4 form-group">
                            <x-jet-label>Account</x-jet-label>
                           <select class="form-control" name="account">
                            <option value="0">Select Account</option>
                            @foreach ($accounts as $account)
                            <option value="{{$account->id}}">{{$account->account_name }}</option>
                            @endforeach
                           </select>
                            @error('account')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>
                        <div class="col-md-4 form-group">
                            <x-jet-label>Date</x-jet-label>
                            <x-jet-input name="date" type="date" class="col-auto" placeholder="Date" ></x-jet-input>
                            @error('date')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>
                      
              

                <div class="col-md-4 form-group">
                            <x-jet-label>Item</x-jet-label>
                            <x-jet-input name="item" class="col-auto" placeholder="Enter Item" ></x-jet-input>
                            @error('item')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                        <div class="col-md-4 form-group">
                            <x-jet-label>Reference</x-jet-label>
                            <x-jet-input name="reference" class="col-auto" placeholder="Enter Reference" ></x-jet-input>
                            @error('reference')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                        <div class="col-md-4 form-group">
                            <x-jet-label>Amount</x-jet-label>
                            <x-jet-input name="amount" class="col-auto" placeholder="Enter Amount" ></x-jet-input>
                            @error('amount')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                      
                </div>
                </div>
                <!-- /.card-body -->
      
                <div class="card-footer">
                  <x-jet-button>Add Petty Cash</x-jet-button>
                </div>
            </form>
            </div>
      
      
        </div>
     
            
          </div>  
    
</x-app-layout>

 