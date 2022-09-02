<x-guest-layout class=" col-md-6 mx-auto elevation-2 rounded-2 mt-4 ">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>  
  
        @if (session('status'))
            <div class="alert alert-success mt-3 rounded-0" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger mb-3 rounded-0" role="alert">
                {{ session('error') }}
            </div>
        @endif
  
  
      
     

            <div class="card-body login-card-body mt-6">
                <div class="login-logo mt-4">
                    @foreach (\App\Models\School::all('school_logo') as $item)
                    <img src={{asset('storage/'.$item->school_logo) }} width="50" class=" brand-image  img-square"  />
                    @endforeach
              
                </div>
                <p class="login-box-msg small">Student Digital Registration</p> 
                <form method="POST" action="{{ route('student_registration.show') }}">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-4 form-group">
                            <x-jet-label>Class</x-jet-label>
                            <select class="form-control" name="student_class">
                                <option value="">Select Class</option>
                                @foreach ($classes as $item)
                                <option value="{{$item->id}}">{{$item->grade_name}}</option>
                                @endforeach
                            </select>
                            @error('student_class')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                        <div class="col-md-4 form-group">
                            <x-jet-label>Name</x-jet-label>
                            <x-jet-input name="name" placeholder="Enter Name" ></x-jet-input>
                            @error('name')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                            <div class="col-md-4 form-group">
                                <x-jet-label>Surname</x-jet-label>
                                <x-jet-input name="lastname"  placeholder="Enter Surname"></x-jet-input>
                                @error('lastname')
                                <span class="text-danger">{{$message}}</span>  
                                @enderror
                            </div>

                        

                          
                  
                  
                    </div>
                    <x-jet-button class="float-left ">Go<i class="fas fa-arrow-circle-right ml-1"></i></x-jet-button>
                </form>

            </div>


</x-guest-layout>