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
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_280,w_970/b_rgb:000000,e_gradient_fade,y_-0.80/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_32_style_light_align_center:Manage Parents,w_0.2,y_0.30/v1616512061/pexels-photo-4260475_alskcw.jpg"
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
                            <table class="table table-sm table-hover mx-auto">
                                <thead class="thead-light ">
                                    <tr>
                                        <th class="d-none d-sm-block">Profile</th>
                                        <th>Name</th>
                                        <th class="d-none d-sm-block">Email</th>
                                        
                                        <th>Manage</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($getParent as $item)
                                        <tr>
                                            <td class="d-none d-sm-block">
                                                @if(empty($item->profile_photo_path))

                                                    <img class="user-image img-circle " width="32" height="32"
                                                        src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1613141854/default-profile-picture-avatar-photo-placeholder-vector-illustration-vector-id1214428300_urpxk5.jpg"
                                                        alt="{{ $item->name }}" />

                                                @else
                                                    <img class="user-image img-circle " width="32" height="32"
                                                        src="/storage/{{ $item->profile_photo_path }}"
                                                        alt="{{ $item->name }}" />

                                                @endif
                                            </td>
                                            <td class="vertical-middle">{{ $item->name }} {{ $item->middlename }}
                                                {{ $item->lastname }}</td>
                                            <td class="vertical-middle d-none d-sm-block">{{ $item->email }}</td>
                                            <td><a href="/parent/view/{{ $item->id }}" class="link"><i
                                                        class="fas fa-eye 2x mr-2"></i>View</a></td>
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
