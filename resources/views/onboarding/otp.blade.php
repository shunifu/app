<x-guest-layout class="login-page">
    
    <div class="login-box">
        @if (session('status'))
            <div class="alert alert-success mb-3 rounded-0" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger mb-3 rounded-0" role="alert">
                {{ session('error') }}
            </div>
        @endif
  

      
        <x-jet-authentication-card>
            

         
    
            <div class="card-body login-card-body">
                <div class="login-logo mt-4">
                    @foreach (\App\Models\School::all('school_logo') as $item)
                    <img src={{asset('storage/'.$item->school_logo) }} width="120" height="120" class=" brand-image  img-square"  />
                    @endforeach

                
              
                </div>
                <p class="login-box-msg small">Enter the OTP sent to your number <span class="text-bold">{{$user_cell}}</span> </p> 
                <form method="POST" action="{{ route('onboarding.step_2') }}">
                    @csrf
                    <div class="input-group mb-3">
                       
                        <input type="number" class="form-control{{ $errors->has('otp') ? ' is-invalid' : '' }}" name="otp" value="{{ old('otp') }}" placeholder="Enter OTP">

                        <input type="hidden" name="cell_number" value="{{$user_cell}}">
                       
                        <x-jet-input-error for="otp"></x-jet-input-error>
                    </div>
                    <div class="row">
    
                        <!-- /.col -->
                        <div class="col-12">
                        <button class="btn btn-block bg-maroon">Enter OTP</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


          

              
              
            </div>
        </x-jet-authentication-card>
    </div>
</x-guest-layout>