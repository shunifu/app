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
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-12">
         

    @include('partials.dashboard-header')
             
    
    <div class="mt-10 mb-25">
    <hr>
    
    </div>

   
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
        {{-- <div class="col">
          <div class="card text-left">
            <img class="card-img-top" src="holder.js/100px180/" alt="">
            <div class="card-body">
              <h4 class="card-title">Teachers</h4>
              <p class="card-text"> --}}
                
                  
                   
                  
                  {{-- <div class="col">
                   <table class="table">
                     <thead>
                       <tr>
                         <th>Teacher</th>
                         <th>Last Seen</th>
                         <th>View</th>
                       </tr>
                     </thead>
                     <tbody>
                       @foreach ($students as $item)
      
                       <tr>
                         <td>{{$item->name}} {{$item->lastname}}</td>
                         
                       </tr>
                       @endforeach
                     </tbody>
                   </table>
                  </div> --}}
                 
              {{-- </p>
            </div>
          </div>
        </div> --}}

        {{-- <div class="col">
          <div class="card text-left">
            <img class="card-img-top" src="holder.js/100px180/" alt="">
            <div class="card-body">
              <h4 class="card-title">Teachers</h4>
              <p class="card-text">
                
               
                  
                  <div class="col">
                   <table class="table">
                     <thead>
                       <tr>
                         <th>Students</th>
                         <th>Last Seen</th>
                         <th>View</th>
                       </tr>
                     </thead>
                     <tbody>
                       @foreach ($teachers as $item)
      
                       <tr>
                         <td>{{$item->name}} {{$item->lastname}}</td>
                         <td>3 hours ago</td>
                         <td>View</td>
                       </tr>
                       @endforeach
                     </tbody>
                   </table>
                  </div>
                 
              </p>
            </div>
          </div>
        </div> --}}
      </div>
     
     
    </div>
   
             
        </div>
    </div>
    
</x-app-layout>