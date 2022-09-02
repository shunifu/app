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
                <p class="login-box-msg small">Enter the 5 digit code sent via SMS</p> 
                <form method="POST" action="{{ route('otp.process') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="cell" value="{{ old('cell') }}" placeholder="Enter cell">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-mobile-alt"></span>
                            </div>
                        </div>
                        <x-jet-input-error for="cell"></x-jet-input-error>
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" name="otp" value="{{ old('otp') }}" placeholder="Enter OTP">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-mobile-alt"></span>
                            </div>
                        </div>
                        <x-jet-input-error for="otp"></x-jet-input-error>
                    </div>

               

                    <div class="row">
                     
                        <!-- /.col -->
                        <div class="col-12">
                            <x-jet-button class="btn btn-block">
                                {{ __('Enter OTP') }}
                            </x-jet-button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

               
                    <p class="mt-3 align-items-center">
                        <a href="{{ route('password.request') }}">{{ __('Request Another OTP?') }}</a>
                    </p>
               
              
            </div>
        </x-jet-authentication-card>
    </div>
</x-guest-layout>