<x-app-layout>
    <x-slot name="header">
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light  ">
              <div class="card-header">
                <h3 class="card-title">Add School Accounts</h3>
              </div>

                <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_32_style_light_align_center:School Accounts,w_0.3,y_0.18/v1614853167/calculator-calculation-insurance-finance-53621_gbamjd.jpg" alt="">
                <div class="card-body">
                  <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
                 <div class="text-muted">
                    <p class="card-text"> Use this section to add the school accounts <br>
                  
                    </p>
                  
                 </div>
                
                </div>
            </div>     
              
              <!-- /.card-header -->
              <!-- form start -->
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3">

                    <div class="card card-light">
                        <div class="card-header">
                          <h3 class="card-title">Add School Accounts</h3>
                        </div>
    <form action="{{route('accounts.store')}}" method="post">
        <div class="card-body">
              @csrf
              <div class="form-row">

                <div class="form-group">
                    <x-jet-label> Account Name</x-jet-label>
                    <x-jet-input name="account_name" required placeholder="Example School Fund" ></x-jet-input>
                    @error('account_name')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                    </div>
        </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <x-jet-button>Add Account</x-jet-button>
        </div>
    </form>
    </div>
</div>

<div class="col-sm-12 col-xs-12 col-md-9 ">
    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">List of School Accounts</h3>
        </div>
        <!-- /.card-header -->
      
        <!-- /beginning of card-body -->
          <div class="card-body">

         
<div class="table-responsive">


             <table class="table table-hover table-bordered table-compact">
                  <thead class="thead-light" >
            <tr>
                <th>Account Name</th>
                <th>Manage</th>
                
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($accounts as $item)
                <tr>
                    <td>{{$item->account_name}}</td>
                 

                     <td class="py-0 align-middle">
                        <div class="btn-group btn-group-md">
                          <a href="account/edit/{{encrypt($item->id)}}" class="btn btn-info"><i class="fas fa-edit mr-1"></i>Edit</a>
                          <a href="account/delete/{{encrypt($item->id)}}" class="btn btn-danger exam_assignment_delete"><i class="fas fa-trash mr-1"></i>Delete</a>
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
    
</x-app-layout>

 