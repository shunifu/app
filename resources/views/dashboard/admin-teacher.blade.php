<x-app-layout>
    <x-slot name="header">
      <style>
        .profile-head {
        transform: translateY(5rem);
         margin: auto;
         /* width: 200px; */
    }
    

    .rt{
      height: 70%;
    }
    
    .cover {
        background-image: url(https://res.cloudinary.com/innovazaniacloud/image/upload/v1673586667/Manage_Teachers_3_h53dex.png);
      
        background-repeat: no-repeat;
      /* //  height: 0; */
  background-size: cover;
  padding-top: 50%;
  padding-bottom: 80%;
    }
    
    </style>
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


        <style>
          body{
margin-top:20px;
background-color: #f7f7ff;
}
.radius-10 {
    border-radius: 10px !important;
}

.border-info {
    border-left: 5px solid  #0dcaf0 !important;
}
.border-danger {
    border-left: 5px solid  #fd3550 !important;
}
.border-success {
    border-left: 5px solid  #15ca20 !important;
}
.border-warning {
    border-left: 5px solid  #ffc107 !important;
}


.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0px solid rgba(0, 0, 0, 0);
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.bg-gradient-scooter {
    background: #17ead9;
    background: -webkit-linear-gradient( 
45deg
 , #17ead9, #6078ea)!important;
    background: linear-gradient( 
45deg
 , #17ead9, #6078ea)!important;
}
.widgets-icons-2 {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ededed;
    font-size: 27px;
    border-radius: 10px;
}
.rounded-circle {
    border-radius: 50%!important;
}
.text-white {
    color: #fff!important;
}
.ms-auto {
    margin-left: auto!important;
}
.bg-gradient-bloody {
    background: #f54ea2;
    background: -webkit-linear-gradient( 
45deg
 , #f54ea2, #ff7676)!important;
    background: linear-gradient( 
45deg
 , #f54ea2, #ff7676)!important;
}

.bg-gradient-ohhappiness {
    background: #00b09b;
    background: -webkit-linear-gradient( 
45deg
 , #00b09b, #96c93d)!important;
    background: linear-gradient( 
45deg
 , #00b09b, #96c93d)!important;
}

.bg-gradient-blooker {
    background: #ffdf40;
    background: -webkit-linear-gradient( 
45deg
 , #ffdf40, #ff8359)!important;
    background: linear-gradient( 
45deg
 , #ffdf40, #ff8359)!important;
}
          </style>
      
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-12">
         

    @include('partials.dashboard-header')
             
    
  

   
    <div class="row">
      @role('admin_teacher')
   
      <div class="col-12 col-sm-8 col-md-4">
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

      <div class="col-12 col-sm-8 col-md-4">
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
      <div class="col-12 col-sm-8 col-md-4">
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
      @endrole
    </div>
   


    <div class="mb-2">
      <hr>
      <div class="row">
 
      </div>
     
     
    </div>
   
             
        </div>
    </div>
    
</x-app-layout>