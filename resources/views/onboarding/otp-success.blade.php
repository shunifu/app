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
                <p class="login-box-msg small"><i class="fas check-circle-o text-success"></i> OTP Validation was successful</p> 
                <hr>
                <p class="login-box-msg small">
                    Please enter your details
                </p>
                <form method="POST" action="{{ route('onboarding.step_3') }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$user_id}}">
                    <div class="input-group mb-3">

                        <select class="form-control" name="salutation">
                            <option value="">Select Title</option>
                            <option value="Mr">Mr.</option>
                            <option value="Mrs">Mrs.</option>
                            <option value="Miss">Miss.</option>
                        </select>
    
                        <x-jet-input-error for="salutation"></x-jet-input-error>
                    </div>
                    <div class="input-group mb-3">
                        
                        <input type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required placeholder="Enter Your First Name">
                       
                        <x-jet-input-error for="firstname"></x-jet-input-error>
                    </div>

                    <div class="input-group mb-3">
                        
                        <input type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('firstname') }}" required placeholder="Enter Your Surname">
                       
                        <x-jet-input-error for="lastname"></x-jet-input-error>
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Enter Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <x-jet-input-error for="email"></x-jet-input-error>
                    </div>

                    <div class="input-group mb-3">
                        
                        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Create Password">
                       
                        <x-jet-input-error for="password"></x-jet-input-error>
                    </div>
                    <div class="input-group mb-3">
                        
                        <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required placeholder="Confirm Password">
                       
                        <x-jet-input-error for="password_confirmation"></x-jet-input-error>
                    </div>
                    <div class="row">
    
                        <!-- /.col -->
                        <div class="col-12">
                        <button class="btn btn-block bg-maroon">Continue to Dashboard</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
   
            </div>
        </x-jet-authentication-card>
    </div>
</x-guest-layout>