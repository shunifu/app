<x-app-layout>
    <x-slot name="header">
<style>
    .profile-head {
    transform: translateY(5rem)
}

.cover {
    background-image: url(https://res.cloudinary.com/innovazaniacloud/image/upload/v1615309153/Untitled_design_8_bavvcr.png);
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
                            <img src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1613141854/default-profile-picture-avatar-photo-placeholder-vector-illustration-vector-id1214428300_urpxk5.jpg" alt="..." width="180" class="rounded mt-8 rounded-circle">
                            @else

                            <img src="/storage/{{$result_user->profile_photo_path}}" alt="..." width="180" class="rounded mt-8 rounded-circle">
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
                        <p class="text-gray-700 mb-1 lh-base">Use this section to edit,
                             <span class="text-bold">{{$result_user->name}}'s</span> profile</p>
                 
                    </div>
                </div>
            
            </div>
        </div>
        <div class="col-md-12 pt-4">
            
        </div>


        @if (Auth::user()->id==$result_user->id)

        <div class="col-md-3 mx-auto">  
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
         
          <h3 class="profile-username text-center">Password Center</h3>

                <p class="text-muted text-center">Manage Password<br>
                <small>Your new password must have;
                    <ul>
                        <li>Minimum of 6 characters</li>
                        <li>Must contain uppercase characters</li>
                        <li>Must contain lowercase characters</li>
                        <li>Must include numerical characters</li>
                        <li>Must include special characters</li>
                    </ul>
                </small>
                </p>

                <form action="{{route('password.change')}}" method="POST">
                    @csrf
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <small>If you are registering for the first time, please use the OTP that you used to login.</small>
                        <b>Old Password <small>or OTP</small></b> <x-jet-input  type="password" name="old_password" 
                            placeholder="Old Password"></x-jet-input>
                        @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </li>
                      <li class="list-group-item">
                        <b>New Password</b>         <small>Your new password.</small> <x-jet-input type="password" name="new_password" 
                            placeholder="New Password"></x-jet-input>
                    
                        @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </li>
                      <li class="list-group-item">
                        <b>Confirm Password</b> 
                        <small>Confirm your new password.</small>
                         <x-jet-input type="password" name="confirm_password" 
                            placeholder="Confirm Password"></x-jet-input>

                        @error('confirm_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </li>
                
                
                  <li class="list-group-item">
                    <button type="submit" class="btn btn-primary btn-block">Update Password</button>
                    {{-- <a href="#" class="btn btn-primary btn-block"><b>Update Password</b></a> --}}
                  </li>
                </ul>
                </form>
        </div>
    </div>
        </div>
       

 <div class="col-md-8 mx-auto">  
        
        @else
           
        @endif

        </div>
    </div>




      
    
</x-app-layout>
