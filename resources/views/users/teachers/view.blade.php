<x-app-layout>
  <x-slot name="header">

  </x-slot>
  <div class="row">
    <div class="col-md-12">
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Manage Teachers</h3>
      </div>
      
        <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1673574541/Manage_Teachers_tmwzjt.png">
    
                        <div class="card-body">
                          <h3 class="lead"> Hi,  {{Auth::user()->name}}</h3>
                         <div class="text-muted">
                            <p class="card-text">
                                <span class="text-bold">Use this section manage teachers<br>
                                  
                              
                          
                            </p>
                          
                         </div>
                        
                        </div>
                       
                       
      <!-- /.card-header -->
  </div>
    </div>
      <div class="col-md-12">
        <div class="card card-light">
<div class="table-responsive">


<table class="table table-sm table-hover mx-auto table-bordered">
              <thead class="thead-light">
                  <tr>
                      <th>Profile</th>
                      <th>Name</th>
                      <th>Cell </th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Login Status </th>
                      <th>Last Seen </th>
                      <th>Manage</th>
                      
                  </tr>
                  </thead>
                  <tbody>
                      
                          @foreach ($result as $item)
                          <tr>
                          <td>
                            @if (empty($item->profile_photo_path))

                            <img class="user-image img-circle " width="63" height="64" src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1613141854/default-profile-picture-avatar-photo-placeholder-vector-illustration-vector-id1214428300_urpxk5.jpg" alt="{{ $item->name }}" />
                          
                            @else
                            <img class="user-image img-circle " width="64" height="64" src="{{ $item->profile_photo_path }}" alt="{{ $item->name }}" /> 
                         
                            @endif
                          </td>
                          <td class="text-left py-0 align-middle">{{$item->salutation}} {{$item->lastname}} {{$item->name}} {{$item->middlename}} </td>
                          <td class="text-left py-0 align-middle"><a href="tel:{{$item->cell_number}}">{{$item->cell_number}}</a></td> 
                          <td class="text-left py-0 align-middle">{{$item->email}}</td> 

                          <td class="text-left py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                              @if ($item->active==1)
                              <a href="#" class="btn btn-success">Active</a> 
                              @else
                              <a href="#" class="btn btn-danger">Inactive</a>     
                              @endif
                            </div>
                          </td>
                          <td class="text-left py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                              @if ($item->status==1)
                              <a href="#" class="btn btn-success"><i class="fas fa-check-circle    "></i></a> 
                              @else
                              <a href="#" class="btn btn-danger"><i class="fas fa-times-circle    "></i></a>     
                              @endif
                            </div>
                          </td>

                          <td>
                          
                            @if(Cache::has('user-is-online-' . $item->id))
                            <span class="text-success">{{Carbon::parse($item->last_seen)->diffForHumans()}}</span>
                        @else
                        <span class="text-success">
                          {{-- {{ \Carbon\Carbon::parse($item->last_seen)->diffForHumans() }} --}}
                          {{-- {{ \Carbon\Carbon::parse($item->last_seen)->diffForHumans() }} --}}
                          <span class="text-secondary">-</span>


                          
                          </span>
                        @endif

{{-- if (Cache::has('user-is-online-' . $item->id)){
                echo $item->name . " is online. Last seen: " . \Carbon::parse($user->last_seen)->diffForHumans() . " <br>";
            
        } --}}
    



                          
                          </td>

                          <td class="text-left py-0 align-middle">


                            <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                Action
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="/teacher/view/{{Crypt::encryptString($item->id)}}">View</a>
                                <a class="dropdown-item" href="/teacher/login/{{Crypt::encryptString($item->id)}}">Login</a>

                                <a class="dropdown-item" href="/teacher/reset/{{Crypt::encryptString($item->id)}}"> Reset Password</a>

                                <a class="dropdown-item" href="/teacher/archive/{{Crypt::encryptString($item->id)}}">Remove</a>
                                <a class="dropdown-item" href="/teacher/reactivate/{{Crypt::encryptString($item->id)}}">Reactivate</a>

                                
                              </div>
                            </div>
                          
                          </td>
                          {{-- <td>

                            
                            
                <a href="/teacher/view/{{$item->id}}" class="link"><i class="fas fa-eye px-2"></i>View</a>
                <span class="mr-3"></span>
                <a href="/teacher/login/{{$item->id}}"><i class="fas fa-sign-in-alt px-2"></i>Login</a>
              <span class="mr-3"></span>
                <a href="/teacher/reset/{{$item->id}}"> <i class="fas fa-sync-alt px-2"></i>OTP</a>

               
               
                          </td> --}}
                      </tr>
                          @endforeach
                  </tbody>
          </table>
      
        </div>
      </div>

   
          
      </div>

        </div>  
  
</x-app-layout>

