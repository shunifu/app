<x-app-layout>
    <x-slot name="header">
      <style>
        .profile-head {
        transform: translateY(5rem)
    }
    
    .cover {
        background-image: url(https://res.cloudinary.com/innovazaniacloud/image/upload/v1673577116/Manage_Parents_1_ofbifm.png);
      background-size: cover;
        background-repeat: no-repeat
    }


.number1 {
    font-weight: 500
}

.followers {
    font-size: 10px;
    color: #a1aab9
}


    
    </style>
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-12">
          @role('parent')
          <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 pt-4 pb-4 elevation-2 cover">
                <div class="media align-items-end profile-head">
                    <div class="profile mr-2">
                        @if(empty(Auth::user()->profile_photo_url))
                        <img src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1613141854/default-profile-picture-avatar-photo-placeholder-vector-illustration-vector-id1214428300_urpxk5.jpg" alt="..." width="180" class="rounded mt-8 rounded-circle">
                        @else

                        <img class="user-image img-circle " width="128" height="128" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        @endif
                    </div>
                   
                </div>
            </div>
            
            <div class="bg-white p-4 mb-5 mt-5 d-flex justify-content-start ">
                <div class="col-12 col-sm-6 col-lg-12">
                    <h3 class="mb-1">{{Auth::user()->name}} {{Auth::user()->middlename}} {{Auth::user()->lastname}}<svg class="ml-1"  xmlns="http://www.w3.org/2000/svg"
                            width="26" height="25.19" viewBox="0 0 24 23.25">
                            <path
                                d="M23.823,11.991a.466.466,0,0,0,0-.731L21.54,8.7c-.12-.122-.12-.243-.12-.486L21.779,4.8c0-.244-.121-.609-.478-.609L18.06,3.46c-.12,0-.36-.122-.36-.244L16.022.292a.682.682,0,0,0-.839-.244l-3,1.341a.361.361,0,0,1-.48,0L8.7.048a.735.735,0,0,0-.84.244L6.183,3.216c0,.122-.24.244-.36.244L2.58,4.191a.823.823,0,0,0-.48.731l.36,3.412a.74.74,0,0,1-.12.487L.18,11.381a.462.462,0,0,0,0,.732l2.16,2.437c.12.124.12.243.12.486L2.1,18.449c0,.244.12.609.48.609l3.24.735c.12,0,.36.122.36.241l1.68,2.924a.683.683,0,0,0,.84.244l3-1.341a.353.353,0,0,1,.48,0l3,1.341a.786.786,0,0,0,.839-.244L17.7,20.035c.122-.124.24-.243.36-.243l3.24-.734c.24,0,.48-.367.48-.609l-.361-3.413a.726.726,0,0,1,.121-.485Z"
                                fill="#0D6EFD"></path>
                            <path data-name="Path" d="M4.036,10,0,5.8,1.527,4.2,4.036,6.818,10.582,0,12,1.591Z"
                                transform="translate(5.938 6.625)" fill="#fff"></path>
                        </svg>
                    </h3>
                    <hr>
                   
                    <p class="text-gray-700 mb-1 2h-base">{{$greetings}} {{\Spatie\Emoji\Emoji::grinningFace()}}{{Auth::user()->name}}<p class="p3">
                      <h5 class="bg-light p3">Notice Board</h5>
                      <hr>
                      Nothing currently posted on notice board
                      </p>
                         
             
                </div>
            </div>
        
        </div>
        <div class="mb-4">

        </div>
            <div class="row">
                {{-- <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3>{{$children}}</h3>
                        @if($children>1)
                        <p>My Kids</p>
                        @else
                        <p>My Kid</p>
                        @endif
                     
                    </div>
                    <div class="icon">
                      <i class="ion-ios-people"></i>
                    </div>
                    <a href="/users/parent/kids/manage" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col --> --}}

                <!----------Fees------------>

                {{-- <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3>34</h3>
      
                      <p>Assignments</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-money-check"></i>
                    </div>
                    <a href="/users/parent/kids/fees" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div> --}}
                <!-- ./col -->

                  <!----------End of Fees------------>



                {{-- <!------------Assignment------------>
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                    <div class="inner">
                      <h3>3</h3>
      
                      <p>Kids Lessons</p>
                    </div>
                    <div class="icon">
                      <i class="ion-person-stalker"></i>
                    </div>
                    <a href="/users/parents/kids/lessons" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div> --}}
                <!-- ./col -->
<!------------End of Assignment------------>


                {{-- <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-danger">
                    <div class="inner">
                      <h3>23</h3>
      
                      <p>Kids Assessements</p>
                    </div>
                    <div class="icon">
                      <i class="ion-navicon-round"></i>
                    </div>
                    <a href="/users/parents/kids/assessements" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div> --}}
                <!-- ./col -->
              </div>
    
              @endrole
    
  


    <div class="mb-4">
     
    </div>
  
              <div class="row bg-white shadow rounded overflow-hidden">

      @include('partials.parents-header')

            {{-- <div class="col-md-12 mt-4">
              @if($children>1)
              <h3 class="text-muted  ml-3">My Children</h3>
              @else
              <h3 class="text-muted  ml-3">My Child</h3>
              @endif
                <hr>
            </div> --}}
       
   
               
                  {{-- @foreach ($mychildren as $children)
                  <div class="card col-sm  max-auto mr-3 ml-3">
                    <div class="pb-1 m-4 ">
                      <div class="image "> 
                        
                       
            @if(empty($children->profile_photo_url))
            <img src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1613141854/default-profile-picture-avatar-photo-placeholder-vector-illustration-vector-id1214428300_urpxk5.jpg" alt="{{ $children->name }}" class="rounded" width="73">
            @else

            <img class="rounded" width="73" src="{{ $children->profile_photo_url }}" alt="{{ $children->name }}" />
            @endif
                       </div>
                      <div class="w-100">
                          <h4 class="mb-0 mt-0">{{$children->name}} {{$children->middlename}} {{$children->lastname}}</h4>
                          <div class="bg-light ">
                          <span class="text-bold">Class:</span> <span>{{$children->grade_name}}</span><br>
                          <span class="text-bold">Age:</span> <span>{{\Carbon\Carbon::parse($children->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y years old')}}</span>
                          </div>
                           <hr>
                          <div class="button mt-1 d-flex flex-row align-items-center"> 
                          <a href="/kids/data/performance/{{$children->student_id}}"><button class="btn btn-success w-100"> <i class="fa fa-line-chart ml-1" aria-hidden="true"></i>View Performance</button> </a>
                          {{-- <a href="/kids/data/attendance/{{$children->student_id}}"><button class="btn btn-sm btn-info w-100 ml-2">Attendance</button></a> --}}
                         
                          {{-- </div>
                      </div>
                  </div>
                    </div>
                    
       
                  @endforeach --}} 
         
                  <!-- /.card -->
              
                <!-- right col -->
              </div>
            </div>
        </div>
    </div>
    
</x-app-layout>