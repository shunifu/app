<x-app-layout>
    <x-slot name="header">
<style>
    .profile-head {
    transform: translateY(5rem)
}

.cover {
    background-image: url(https://png.pngtree.com/thumb_back/fw800/background/20191015/pngtree-abstract-gradient-geometric-shapes-background-image_319672.jpg);
    background-size: cover;
    background-repeat: no-repeat
}

</style>
    </x-slot>



    <div class="row">
        <div class="col-md-12 mx-auto">
            <!-- Profile widget -->
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 cover">
                    <div class="media align-items-end profile-head">
                        <div class="profile mr-3">
                            @if(empty($result_user->profile_photo_path))
                            <img src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1613141854/default-profile-picture-avatar-photo-placeholder-vector-illustration-vector-id1214428300_urpxk5.jpg" alt="..." width="90" class="rounded mt-8 rounded-circle">
                            @else

                            <img src="/storage/{{$result_user->profile_photo_path}}" alt="..." width="90" class="rounded mt-8 rounded-circle">
                            @endif
                        </div>
                       
                    </div>
                </div>
                <div class="bg-white p-4 mb-5 mt-5 d-flex justify-content-start ">
                    <div class="col-12 col-sm-6 col-lg-8">
                        <h3 class="mb-1">{{$result_user->name}} {{$result_user->middlename}} {{$result_user->lastname}}<svg class="ml-1"  xmlns="http://www.w3.org/2000/svg"
                                width="26" height="25.19" viewBox="0 0 24 23.25">
                                <path
                                    d="M23.823,11.991a.466.466,0,0,0,0-.731L21.54,8.7c-.12-.122-.12-.243-.12-.486L21.779,4.8c0-.244-.121-.609-.478-.609L18.06,3.46c-.12,0-.36-.122-.36-.244L16.022.292a.682.682,0,0,0-.839-.244l-3,1.341a.361.361,0,0,1-.48,0L8.7.048a.735.735,0,0,0-.84.244L6.183,3.216c0,.122-.24.244-.36.244L2.58,4.191a.823.823,0,0,0-.48.731l.36,3.412a.74.74,0,0,1-.12.487L.18,11.381a.462.462,0,0,0,0,.732l2.16,2.437c.12.124.12.243.12.486L2.1,18.449c0,.244.12.609.48.609l3.24.735c.12,0,.36.122.36.241l1.68,2.924a.683.683,0,0,0,.84.244l3-1.341a.353.353,0,0,1,.48,0l3,1.341a.786.786,0,0,0,.839-.244L17.7,20.035c.122-.124.24-.243.36-.243l3.24-.734c.24,0,.48-.367.48-.609l-.361-3.413a.726.726,0,0,1,.121-.485Z"
                                    fill="#0D6EFD"></path>
                                <path data-name="Path" d="M4.036,10,0,5.8,1.527,4.2,4.036,6.818,10.582,0,12,1.591Z"
                                    transform="translate(5.938 6.625)" fill="#fff"></path>
                            </svg>
                        </h3>
                        <hr>
                        @if(Auth::user()->id==$result_user->id)
                        <p class="text-gray-700 mb-1 lh-base">Hi, 
                            <span class="text-bold">{{$result_user->name}} </span>manage your profile here</p>
                        @else
                        <p class="text-gray-700 mb-1 lh-base">Use this section to manage,
                             <span class="text-bold">{{$result_user->name}}'s</span> profile</p>
                 @endif
                    </div>
                </div>
            
            </div>
        </div>
        <div class="col-md-12 pt-4">
            
        </div>
        <div class="col-md-12 mx-auto ">
            <div class="card card-light  ">
                <div class="m-3">
                    <ul class="nav nav-pills nav-justified flex-column flex-sm-row" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active bg-light" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">Parent Profile</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link  bg-light" id="pills-children-tab" data-toggle="pill" href="#pills-children" role="tab" aria-controls="pills-children" aria-selected="false">@if(Auth::user()->id==$result_user->id)My Children @else Children @endif</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link  bg-light" id="pills-payments-tab" data-toggle="pill" href="#pills-payments" role="tab" aria-controls="pills-payments" aria-selected="false">Payments</a>
                        </li>
                      </ul>
                </div>
              <hr>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="card-body">
                            <form action="{{route('parent.edit')}}" method="post">
                                @csrf
                               
                                <div class="form-row">
                        <input type="hidden" name="id" value="{{ $result_user->national_id }}">
                                    
                                    <div class="col-md-4 form-group">
                                        <x-jet-label>First Name</x-jet-label>
                                        <x-jet-input name="first_name" value="{{ $result_user->name }}"
                                            placeholder="First Name"></x-jet-input>
                                        @error('first_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
        
                                    <div class="col-md-4 form-group">
                                        <x-jet-label>Middle Name</x-jet-label>
                                        <x-jet-input name="middle_name" required
                                            value="{{ $result_user->middlename }}" placeholder="Middle Name">
                                        </x-jet-input>
                                        @error('middle_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
        
                                    <div class="col-md-4 form-group">
                                        <x-jet-label>Last Name</x-jet-label>
                                        <x-jet-input name="last_name" value="{{ $result_user->lastname }}"
                                            required>
                                        </x-jet-input>
                                        @error('last_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
        
                                    
                                <div class="col-md-4 form-group">
                                    <x-jet-label>National ID</x-jet-label>
                                    <x-jet-input name="national_id" type="number"
                                        value="{{ $result_user->national_id }}"></x-jet-input>
                                    @error('national_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                    
                                <div class="col-md-4 form-group">
                                    <x-jet-label>Date of Birth</x-jet-label>
                                    <x-jet-input name="date_of_birth"
                                        value="{{ $result_user->date_of_birth }}" type="date">
                                    </x-jet-input>
                                    @error('date_of_birth')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                    
                                <div class="col-md-4 form-group">
                                    <x-jet-label>Gender</x-jet-label>
                                    <select class="form-control" name="gender">
                    
                                        <option>{{ $result_user->gender }} </option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
        
                                <div class="col-md-6 form-group">
                                    <x-jet-label>Email</x-jet-label>
                                    <x-jet-input name="email"
                                    value="{{ $result_user->email }}" type="email" required>
                                </x-jet-input>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                    
                                <div class="col-md-6 form-group">
                                    <x-jet-label>Cell</x-jet-label>
                                    <x-jet-input name="cell"
                                    value="{{ $result_user->cell_number }}" type="number" required>
                                </x-jet-input>
                                    @error('cell')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="hidden" value="{{$result_user->id}}" name="id">
                    
                      
                                <x-jet-button>Update Parent</x-jet-button>
        
                            </form>
                        <!-- /.form row -->
         
                        </div>
                    </div>
                  
                  </div>

                  <div class="tab-pane fade" id="pills-children" role="tabpanel" aria-labelledby="pills-children-tab">
                    children
                                        </div>
                                        <div class="tab-pane fade" id="pills-payments" role="tabpanel" aria-labelledby="pills-payments-tab">Payments</div>
      

            </div>
        </div>
    </div>




      
    
</x-app-layout>
