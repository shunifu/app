<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
<div class="row">
    
  <div class="col-md-12">

    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">Edit Account</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

      
        
        <form action="{{route('accounts.update')}}" method="get">
          <div class="card-body">
            
                @csrf
                <input type="hidden" value="{{$account->id}}" name="account_id"/>
                <div class="form-group">
                <x-jet-label>Account Name</x-jet-label>
                <x-jet-input name="account_name" value="{{$account->account_name}}" ></x-jet-input>
                @error('account_name')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>
  
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <x-jet-button>Update Account</x-jet-button>
          </div>
       
      </div>
    </form>
    
  </div>

 
      
    </div>   
            
     
    
</x-app-layout>