<x-app-layout>
    <x-slot name="header">
      <style>
        .profile-head {
        transform: translateY(5rem)
    }
    
    .cover {
        background-image: url(https://res.cloudinary.com/innovazaniacloud/image/upload/v1613303961/pexels-photo-5212359_ukdzdz.jpg);
      background-size: cover;
        background-repeat: no-repeat
    }
    
    </style>
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-12">
         
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
                <div class="col-12 col-sm-6 col-lg-8">
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
                   
                    <p class="text-gray-700 mb-1 2h-base">{{$greetings}} {{\Spatie\Emoji\Emoji::grinningFace()}}{{Auth::user()->name}}<p>
                      </p>
                         
             
                </div>
            </div>
        
        </div>
        <div class="mb-4">

        </div>
            <div class="row">
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  {{-- <div class="small-box bg-info">
                    <div class="inner">
                      <h3>{{$total_students}}</h3>
      
                      <p>Total Students</p>
                    </div>
                    <div class="icon">
                      <i class="ion-ios-people"></i>
                    </div>
                    <a href="/students/list/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div> --}}
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                    <div class="inner">
                      <h3>{{$total_students}}</h3>
      
                      <p>Students</p>
                    </div>
                    <div class="icon">
                      <i class="ion-android-people"></i>
                    </div>
                    <a href="/users/student/manage" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
                <!-- ./col -->
    
              </div>
    
      
    
    <div class="mt-10 mb-25">
    <hr>
    
    </div>
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Your Students</span>
            <span class="info-box-number">{{$my_students}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-book-open"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Your Loads</span>
            <span class="info-box-number">{{$total_loads}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-chalkboard-teacher"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Your Lessons</span>
            <span class="info-box-number">{{$total_lessons}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-fuchsia elevation-1"><i class="far fa-edit"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Your Assessements</span>
            <span class="info-box-number">{{$total_assessements}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>

    <div class="mb-4">
      <hr>
      <h4>School Daily Calendar</h4>
    </div>
              <div class="row">
                <!-- Left col -->
             
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-md-12 bg-white">
=
                  <div class="embed-responsive embed-responsive-1by1">
                    <iframe class="embed-responsive-item" src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=Africa%2FJohannesburg&amp;src=ZXR1Z2hzMGxxN2w0bHR0dmwzam5qZ2ExbmtAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;src=ZW4uc3ojaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&amp;color=%23EF6C00&amp;color=%230B8043&amp;showTitle=0&amp;showPrint=0&amp;showTabs=1&amp;title=St%20Michaels%20High%20School" style="border-width:0" width="auto" height="600" frameborder="0" scrolling="no"></iframe>
                  </div>
                  <!-- /.card -->
                </section>
                <!-- right col -->
              </div>
             
        </div>
    </div>
    
</x-app-layout>