<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-12">
            @role('student')
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>
                                    @foreach ($card_class as $item)
                                    {{$item->grade_name}}</h3>
                                    @endforeach
                                <p>Class</p>
                            </div>
                            <div class="icon">
                                <i class="ion-ios-people"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{$card_assessement}}</h3>

                                <p>Assessement</p>
                            </div>
                            <div class="icon">
                                <i class="ion-android-people"></i>
                            </div>
                            <a href="/users/students/online-learning/assessements" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{$card_lesson}}</h3>

                                <p>Lessons</p>
                            </div>
                            <div class="icon">
                                <i class="albums-outline"></i>
                              
                            </div>
                            <a href="/users/students/online-learning" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{$card_loads}}</h3>

                                <p>Subjects</p>
                            </div>
                            <div class="icon">
                                <i class="ion-navicon-round"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

            @endrole

            <div class="mt-10 mb-25">
                <hr>

            </div>
            <div class="card  ">
                <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:{{Auth::user()->name}}'s Online Learning Portal,w_0.3,y_0.18/v1613224829/pexels-photo-5076531_bk5pkb.jpg" alt="">
              
                <div class="card-body">
                  <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
                 <div class="text-muted">
                    <p class="card-text">  Welcome to your elearning portal. <br>
                        <hr>
                        <ul>
                            <li>Below is  list of lessons for your class</li>
                        </ul>
                  
                    </p>
                  
                 </div>
                
                </div>
                
              </div>
                
            <div class="row">
          
                <!-- Left col -->
                @foreach ($lessons as $item)
                   
                <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                  
                        <div class="card border-top border-primary">
                            <div class="card-header">
                                <h4>{{$item->subject_name}}</h4>
                                <hr>
                               <p class="card-title">
                                   <span class="text-bold">Lesson Title:</span> 
                                   {{$item->lesson_title}}
                               <br>
                               <span class="text-bold">Class:</span> 
                               {{$item->grade_name}}
                               </p>
                                <p class="card-text"><span class="text-bold">Lesson Created:</span> {{\Carbon\Carbon::parse($item->created_at)->diffForhumans()}}</p>
                            </div>
                            <div class="card-body">
                             
                            </div>
                            <div class="card-footer text-muted">
                       
                             
        <a href="/users/student/online-learning/view/{{$item->lesson_id}}"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View </button></a>
        <a href="https://api.whatsapp.com/send?text=Hi, this is *{{Auth::user()->name}}* check out this lesson about {{$item->lesson_title}} here {{Request::url()}}"><button type="button" class="btn btn-success btn-sm"><i class="fab fa-whatsapp"></i> Whatsapp </button></a>
                             
                            </div>
                        </div>
                       
                               
                </div>
            @endforeach
        </div>
    </div>
    </div>

</x-app-layout>
