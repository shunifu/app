<x-app-layout>
    <x-slot name="header">
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js">
        </script>
    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                    <h3 class="card-title">Manage Parents</h3>
                </div>

                <img class="card-img-top"
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1673575215/Manage_Parents_ydbwmk.png"
                    alt="">

                <div class="card-body">
                    <h3 class="lead"> Hi, {{ Auth::user()->name }}</h3>
                    <div class="text-muted">
                        <p class="card-text">
                            <span class="text-bold">Use this section to manage parents</span><br>
                            

                        </p>

                    </div>

                </div>


                <!-- /.card-header -->
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-light">

                <div class="card-header">
                    <h3 class="card-title">View Parents</h3>
                </div>

                <div class="card-body">


                    @if($getParent->isEmpty())
                        <h3 class="small lead text-muted text-center ">No Parent found this class.</h3>
                      
                        <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_x62chJ.json" mode="bounce"
                            background="transparent" speed="1"
                            style="width: 300px; height: 300px; margin-left:auto; margin-right:auto" loop autoplay>
                        </lottie-player>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm table-hover table-bordered">
                                <thead class="thead-light ">
                                    <tr>
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th >Email</th>
                                        <th>Cell Number</th>
                                        <th>Manage</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($getParent as $item)
                                        <tr>
                                            <td >
                                                @if(empty($item->profile_photo_path))

                                                    <img class="user-image img-circle " width="32" height="32"
                                                        src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1613141854/default-profile-picture-avatar-photo-placeholder-vector-illustration-vector-id1214428300_urpxk5.jpg"
                                                        alt="{{ $item->name }}" />

                                                @else
                                                    <img class="user-image img-circle " width="32" height="32"
                                                        src="{{ $item->profile_photo_path }}"
                                                        alt="{{ $item->name }}" />

                                                @endif
                                            </td>
                                            <td class="vertical-middle">{{ $item->salutation }} {{ $item->name }} {{ $item->middlename }}
                                                {{ $item->lastname }}</td>
                                            <td class="vertical-middle">{{ $item->email }}</td>
                                            <td class="vertical-middle">{{ $item->cell_number }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                                      Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                      <a class="dropdown-item" href="/parent/view/{{ $item->id }}">View Parent</a>
                                                      <a class="dropdown-item" href="/teacher/reset/{{Crypt::encryptString($item->id)}}"> Reset Password</a>
                                                      <a class="dropdown-item" href="/teacher/archive/{{Crypt::encryptString($item->id)}}">Remove</a>
                                                      
                                                    </div>
                                                  </div>
                                                </td>
                                        </tr>
                                    @endforeach
                                   
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>



            </div>


        </div>

</x-app-layout>
