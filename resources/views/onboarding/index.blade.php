<x-guest-layout class="login-page">

    <div class="login-box">
        @if(session('status'))
            <div class="alert alert-success mb-3 rounded-0" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if(session('error'))
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
                <p class="login-box-msg small">Enter your cell number to continue</p>
                <form method="POST" action="{{ route('onboarding.step_1') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text btn btn-secondary">+268</div>
                        </div>
                        <input type="number"
                            class="form-control{{ $errors->has('cell_number') ? ' is-invalid' : '' }}"
                            name="cell_number" value="{{ old('cell_number') }}"
                            placeholder="Enter Cell Number">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-mobile"></span></div>
                        </div>
                        <x-jet-input-error for="cell_number"></x-jet-input-error>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-block btn-info">Continue</button>
                        </div>

                    </div>
                </form>

                <hr>
                <div class="row">

                    <!-- /.col -->
                    <div class="col-6">
                        <a href="/create/account/"><button class="btn btn-block bg-secondary"><i
                                    class="fas fa-user-plus"></i> Create Account</button></a>
                    </div>

                </div>

            </div>
        </x-jet-authentication-card>
    </div>
</x-guest-layout>
