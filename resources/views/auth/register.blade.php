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
                    <img src={{asset('storage/'.$item->school_logo) }} width="50" class=" brand-image  img-square"  />
                    @endforeach
              
                </div>
                <p class="login-box-msg small">Sign in to start your session</p> 
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('Email') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <x-jet-input-error for="email"></x-jet-input-error>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               name="password" required autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <x-jet-input-error for="password"></x-jet-input-error>
                    </div>

                    <div class="row">
                     
                        <!-- /.col -->
                        <div class="col-12">
                            <x-jet-button class="btn btn-block">
                                {{ __('Login') }}
                            </x-jet-button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mt-2 mb-3">
                   
                    <a href="{{ url('/auth/google') }}" class="btn btn-block btn-danger">
                        <i class="fab fa-google mr-2"></i></i> Sign in using Gmail
                    </a>
                  </div>

                @if (Route::has('password.request'))
                    <p class="mb-1">
                        <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                    </p>
                @endif
              
            </div>
        </x-jet-authentication-card>
    </div>
</x-guest-layout>