<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="csrf-token" content="{{ csrf_token() }}">
         <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 

   

         <style>
          .main-sidebar, .sidebar-dark-warning { background-color: rgb(49, 49, 49) !important }

          /* .sidebar-dark-warning{background-color: rgb(49, 49, 49) !important} */
         </style>

         
   
         {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
         {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}">  --}}
   
    <link href="https://cdn.statically.io/gh/innovazania/assets/f6025c7d/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href=' https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css' rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.x/dist/alpine.min.js" defer></script>
         

           <!-- Step 1 - Include the fusioncharts core library -->
          
           <!-- FusionCharts -->
           <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
           <!-- jQuery-FusionCharts -->
           <script type="text/javascript" src="https://rawgit.com/fusioncharts/fusioncharts-jquery-plugin/develop/dist/fusioncharts.jqueryplugin.min.js"></script>
           <!-- Fusion Theme -->
           <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
     
        @livewireStyles
          <!-- Google Font: Source Sans Pro -->
          <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

        @if(empty(\App\Models\School::all()))
        <title>Shunifu</title>
        @else
        @foreach (\App\Models\School::all() as $item)

        <title>{{ ($item->school_name) }}</title>
        @endforeach
        @endif
       
    
        
 
        
       
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
     
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                  
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="/dashboard" class="nav-link">Home</a>
                      </li>
                      <li class="nav-item d-none d-sm-inline-block">
                        <a href="https://api.whatsapp.com/send?phone=26876890726&text=Hi, this is, {{Auth::user()->name}}  Please help with the school app, my email is {{Auth::user()->email}}" class="nav-link">Contact</a>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="/help" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Help
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="/faq">FAQ</a>
                          <a class="dropdown-item" href="/support">Support</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="/contact">Contact</a>
                        </div>
                      </li>
                    </ul>
                  
                    <!-- SEARCH FORM -->
                    <form action ="/search" method="POST" class="form-inline ml-3 d-none d-sm-inline-block d-none d-md-inline-block">
                      <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                          <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </form>
                  
                    <!-- Right navbar links -->
                    <ul class="navbar-nav ml-auto">
                      <!-- Messages Dropdown Menu -->
  
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                          <i class="far fa-comments"></i>
                          <span class="badge badge-danger navbar-badge">0</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                          
                          <div class="dropdown-divider"></div>
                          <a href="#" class="dropdown-item dropdown-footer">No Messages</a>
                        </div>
                      </li>

  <!-- Notifications Dropdown Menu -->
  <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-bell"></i>
      <span class="badge badge-warning navbar-badge">0</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <span class="dropdown-header">No Notifications</span>

    </div>
  </li>
                    <!-- Authentication Links -->
                    @auth
                        <x-jet-dropdown id="navbarDropdown" class="user-menu">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <img class="user-image img-circle elevation-1" width="64" height="64" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                @endif
                                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <h6 class="dropdown-header">
                                    {{ __('Manage Account') }}
                                </h6>

                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                  {{-- <x-jet-dropdown-link href="/teacher/view/{{Crypt::encryptString(Auth::user()->id)}}"> --}}
                                  
                                    {{ __('Profile') }}
                                </x-jet-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-jet-dropdown-link>
                                @endif

                            <!-- Team Management -->
                                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())

                                    <hr class="dropdown-divider">

                                    <h6 class="dropdown-header">
                                        {{ __('Manage Team') }}
                                    </h6>

                                    <!-- Team Settings -->
                                    <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-jet-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-jet-dropdown-link>
                                    @endcan

                                    <hr class="dropdown-divider">

                                    <!-- Team Switcher -->
                                    <h6 class="dropdown-header">
                                        {{ __('Switch Teams') }}
                                    </h6>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team :team="$team" />
                                    @endforeach
                                @endif

                                <hr class="dropdown-divider">

                                <!-- Authentication -->
                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                                     onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </x-jet-dropdown-link>
                                <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                    @csrf
                                </form>
                            </x-slot>
                        </x-jet-dropdown>
                    @endauth
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-2">
                <!-- Brand Logo -->
                <a href="/" class="brand-link">
                 

                    @foreach (\App\Models\School::all() as $item)
                    <span class="brand-text small font-weight-light">{{ $item->school_name }}</span>
                    @endforeach
                  
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="image">
                                <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
                            </div>
                        @endif
                        <div class="info">
                            <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->lastname }} {{ Auth::user()->name }}</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

             
              
              
               <li class="nav-header">{{Auth::user()->name}}'s Dashboard</li>
              

               <li class="nav-item">
                <a href="/dashboard" class="nav-link">
                  <i class="nav-icon fas fa-home"></i>
                  <p>
                    Home
                  </p>
                </a>
              </li>

            

               {{-- <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="fas fa-stethoscope nav-icon"></i>
                  <p>
                   Shunifu Health
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('index.students') }}" class="nav-link">
                      <i class="nav-icon fas fa-check-circle"></i>
                      <p>Students</p>
                    </a>
                  </li>
     --}}
                  {{-- <li class="nav-item">
                    <a href="{{ route('index.teachers') }}" class="nav-link">
                      <i class="nav-icon fas fa-check-circle"></i>
                      <p>Teachers</p>
                    </a>
                  </li> --}}

                  {{-- <li class="nav-item">
                    <a href="{{ route('index.support-staff') }}" class="nav-link">
                      <i class="nav-icon fas fa-check-circle"></i>
                      <p>Support Staff</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ route('index.visitors') }}" class="nav-link">
                      <i class="nav-icon fas fa-check-circle"></i>
                      <p>Visitors</p>
                    </a>
                  </li> --}}
    
                
    
                {{-- </ul>
              </li>  --}}
               
               @role('teacher')      

       
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book-reader"></i>
              <p>
               Teaching Loads
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
           
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('teacher.teaching_loads')}}" class="nav-link">
                   <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Add Teaching Loads</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('teaching_loads.show')}}" class="nav-link">
                   <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Manage Loads</p>
                </a>
              </li>
            </ul>


            @role('admin_teacher')
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin_check.loads') }}" class="nav-link">
                   <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Manage Loads (Admin)</p>
                </a>
              </li>
            </ul>
            @endrole

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/teaching-loads/transfer/" class="nav-link">
                   <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Transfer Loads</p>
                </a>
              </li>
            </ul>
 
 
          </li>

         @endrole

@role('parent')
<li class="nav-item has-treeview">
  <a href="#" class="nav-link">
    <i class="fas fa-user-friends nav-icon"></i>
    <p>
     Parent Center
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
 
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/view/school-news/" class="nav-link">
        <i class="far fa-newspaper nav-icon"></i>
        <p>School News</p>
      </a>
    </li>
  </ul>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/view/school-events/" class="nav-link">
        <i class="fas fa-calendar-check nav-icon"></i>
        <p>School Events</p>
      </a>
    </li>
  </ul>

  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="/view/school-announcements/" class="nav-link">
        <i class="fas fa-bullhorn nav-icon"></i>
        <p>School Announcements</p>
      </a>
    </li>
  </ul>

  
</li>

@endrole
        


         {{-- <!----Beginning of Online Learning---------->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>
               Online Learning
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
           
            <ul class="nav nav-treeview">
              @role('student')
              <li class="nav-item">
                <a href="{{ route('online-learning.students')}}" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>View Lessons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('online-learning.view-assessement')}}" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>View Assesements</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('online-learning.virtual_class')}}" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Virtual Class</p>
                </a>
              </li>
              @endrole


              @role('parent')
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>View Lessons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>View Assesements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>View Results</p>
                </a>
              </li>
            
             
              @endrole

              @role('teacher')
           <li class="nav-item">
                <a href="{{ route('online-learning.create')}}" class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Add Lesson</p>
                </a>
              </li>
{{-- 
              <li class="nav-item">
                <a href="{{ route('online-learning.virtual_class')}}" class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Virtual Class</p>
                </a>
              </li> --}}
              {{-- <li class="nav-item">
                <a href="{{route('online-learning.manage')}}" class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Manage Lessons</p>
                </a>
              </li> --}}

              {{-- <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="fas fa-pen nav-icon"></i>
                  <p>
                    Add Assessments 
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('online-learning.create_assessement_teacher')}}" class="nav-link">
                      <i class="nav-icon fas fa-chevron-circle-right"></i>
                      <p>With Lesson</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/online-learning/assessement/create/without-lesson/" class="nav-link">
                      <i class="nav-icon fas fa-chevron-circle-right"></i>
                      <p>Without Lesson</p>
                    </a>
                  </li>
  
                </ul>
              </li>
              
              
             
              <li class="nav-item">
                <a href="/online-learning/lessons/assessement/manage/" class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Manage Assesements</p>
                </a>
              </li> --}}
           
              {{-- @endrole --}}


              

              {{-- @role('school-administrator')
           <li class="nav-item">
                <a href="{{ route('online-learning.create')}}" class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>View Lessons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('online-learning.manage')}}" class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>View Assessements</p>
                </a>
              </li> --}}
              
              {{-- <li class="nav-item">
                <a href="{{ route('online-learning.create_assessement_teacher')}}" class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>View Results</p>
                </a>
              </li>
             
            
           
              @endrole
            </ul> --}}
            {{-- <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-video nav-icon"></i>
                <p>Virtual Class </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-handshake nav-icon"></i>
                <p>Virtual Meeting</p>
              </a>
            </li> --}}
        <!---end of Online Learning----->  



        @role('parent')
                   

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-coins nav-icon"></i>
            <p>School Fees</p>
          </a>
        </li>

        @endrole


                <!----Beginning of Analytics Management---------->
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="fas fa-chart-bar nav-icon"></i>
                    <p>
                     Insights Dashboard
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                 
                  <ul class="nav nav-treeview">
                    {{-- Logged in Student Performance link --}}
                    @role('student')
                    <li class="nav-item">
                      <a href="/my/performance" class="nav-link">
                        <i class="nav-icon fas fa-chevron-circle-right"></i>
                        <p>My Performance</p>
                      </a>
                    </li>                   
                    @endrole

   {{-- Logged in Class teacher Performance link --}} 
                 @role('class_teacher')
                  

                     {{-- <li class="nav-item">
                      <a href="/analytics/class-based/" class="nav-link">
                        <i class="nav-icon fas fa-check-circle"></i>
                        <p>Class Insights</p>
                      </a>
                    </li> --}}

                    @endrole
     {{-- end of logged in class-teacher Performance link --}}


                    @if (Auth::user()->hasRole(['admin_teacher', 'school_administrator', 'class_teacher']))
                    <li class="nav-item">
                      <a href="/insights" class="nav-link">
                        <i class="nav-icon fas fa-check-circle"></i>
                        <p>Academic Insights</p>
                      </a>
                    </li>

                    

                     <li class="nav-item">
                      <a href="/insights/subject" class="nav-link">
                        <i class="nav-icon fas fa-check-circle"></i>
                        <p>Subject Insights</p>
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="/insights/teacher" class="nav-link">
                        <i class="nav-icon fas fa-check-circle"></i>
                        <p>Teacher Insights</p>
                      </a>
                    </li> 

                     {{-- <li class="nav-item">
                      <a href="/analytics/assessement-based" class="nav-link">
                        <i class="nav-icon fas fa-check-circle"></i>
                        <p>Scoresheet</p>
                      </a>
                    </li>  --}}
                    <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="fas fa-chart-bar nav-icon"></i>
                      <p>
                       Assessement Insights 
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>

                 
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="/analytics/assessement-based" class="nav-link">
                          <i class="nav-icon fas fa-check-circle"></i>
                          <p>Stream Based</p>
                        </a>
  
                      </li>

                      <li class="nav-item">
                        <a href="/analytics/assessement-based/class" class="nav-link">
                          <i class="nav-icon fas fa-check-circle"></i>
                          <p>Class Based</p>
                        </a>
                      </li> 

                    </ul>
                    </li>


                     <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                        <i class="fas fa-chart-bar nav-icon"></i>
                        <p>
                         Term Insights 
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a> 
  
                       <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="/analytics/term-based" class="nav-link">
                            <i class="nav-icon fas fa-check-circle"></i>
                            <p>Stream Based</p>
                          </a>
    
                        </li>
                 
  
                        <li class="nav-item">
                          <a href="/analytics/term-based/class" class="nav-link">
                            <i class="nav-icon fas fa-check-circle"></i>
                            <p>Class Based</p>
                          </a>
                        </li> 
  
                      </ul> 
                      </li>

                  

                   
                    @endif  

                    @role('hod')
                     <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-check-circle"></i>
                        <p>Department Insights</p>
                      </a>
                    </li>
                    @endrole

         
      
                    @role('teacher')
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-check-circle"></i>
                        <p>My Insights</p>
                      </a>
                    </li>
                    @endrole
                    

                  </ul>
               
                  
              <!---end of analytics-----> 

              @role('admin_teacher')

              <li class="nav-item">
                <a href="/communication" class="nav-link">
                  <i class="fas fa-comments nav-icon"></i>
                  <p>
                    Communication
                  </p>
                </a>
              </li>

          

              <li class="nav-item">
                <a href="/disciplinary-cases" class="nav-link">
                  <i class="fas fa-chalkboard-teacher  nav-icon  "></i>
                  <p>
                    Disciplinary Cases
                  </p>
                </a>
              </li>
          @endrole
            


              <!----Beginning of Reports Management---------->
              <li class="nav-item has-treeview">
                @role('admin_teacher')
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-chart-line"></i>
                  <p>
                   Reports
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
               @endrole
                <ul class="nav nav-treeview">
                  @role('student')
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-chevron-circle-right"></i>
                      <p>My Termly Report</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-chevron-circle-right"></i>
                      <p>My Assessement Report</p>
                    </a>
                  </li>
                  @endrole

             
    
    
                  @role('parent')
                  <li class="nav-item">
                    <a href="/reports/parent/assessement-based/" class="nav-link">
                      <i class="nav-icon fas fa-chevron-circle-right"></i>
                      <p>Assessement Report</p>
                    </a>
                  </li>  

                  {{-- <li class="nav-item">
                    <a href="/reports/parent/term-based/" class="nav-link">
                      <i class="nav-icon fas fa-chevron-circle-right"></i>
                      <p>Term Report</p>
                    </a>
                  </li>  --}}

                  @endrole

                  @if (Auth::user()->hasRole(['admin_teacher', 'school-administrator']))
                 {{-- <li class="nav-item">
                     <a href="/report/assessement-based/" class="nav-link">
                      <i class="nav-icon fas fa-check-circle"></i>
                      <p>Assessement Based</p>
                    </a>
                  </li>   --}}

                  <li class="nav-item has-treeview">
                  
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-chart-line"></i>
                      <p>
                       Term Based
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>

                    <ul class="nav nav-treeview">
                      {{-- <a href="/report/term-based/" class="nav-link"> --}}
                        {{-- /report/term-based/class --}}
                      <li class="nav-item">
                        <a href="/report/term-based/" class="nav-link">
                          <i class="nav-icon fas fa-chevron-circle-right"></i>
                          <p>Stream Report</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/report/term-based/class" class="nav-link">
                          <i class="nav-icon fas fa-chevron-circle-right"></i>
                          <p>Class Report</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="/report/term-based/individual" class="nav-link">
                          <i class="nav-icon fas fa-chevron-circle-right"></i>
                          <p>Individual Report</p>
                        </a>
                      </li>
                    </ul>
                  </li>

                

                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-check-circle"></i>
                      <p>Past Reports</p>
                    </a>
                  </li>

                   <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-check-circle"></i>
                      <p>Transcripts</p>
                    </a>
                  </li>   

                  @endif
    
                  @role('teacher')
                  {{-- <li class="nav-item">
                    <a href="/report/openday/" class="nav-link">
                      <i class="nav-icon fas fa-check-circle"></i>
                      <p>OpenDay</p>
                    </a>
                  </li> --}}

                  @endrole
                  

                </ul>
             
                
            <!---end of reports-----> 

 



   <!-----End of Promotions Management------------->
         
       
      
         
          @if (Auth::user()->hasRole(['class_teacher']))
        
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                My Class
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">



              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-building"></i>
                  <p>
                    Attendance Management
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/class/student-attendance" class="nav-link">
                      <i class="nav-icon fas fa-check-circle"></i>
                      <p>Daily Attendance</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/class/student-attendance/cumulative" class="nav-link">
                      <i class="nav-icon fas fa-check-circle"></i>
                      <p>Cummulative Attendance</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="/class/student-attendance/manage" class="nav-link">
                      <i class="nav-icon fas fa-check-circle"></i>
                      <p>Manage Attendance</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="/class/student-attendance/history" class="nav-link">
                      <i class="nav-icon fas fa-check-circle"></i>
                      <p> Attendance History</p>
                    </a>
                  </li>


                </ul>
              </li>

              <li class="nav-item">
                <a href="/class/student-management" class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Student Management</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/class/student-management/link-parents" class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Link Parents</p>
                </a>
              </li>
            

              <li class="nav-item">
                <a href="/class/class-noticeboard" class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Class Noticeboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/class/class-list" class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Class List</p>
                </a>
              </li>
            

              <li class="nav-item">
                <a href="/class/class-performance" class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Class Performance</p>
                </a>
              </li>
              <li class="nav-item">
                {{-- /report/term-based/class/teacher --}}
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Class Report</p>
                </a>
              </li>

            

            </ul>
          </li>
         @endif


         
          @role('teacher')

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Check Center
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('check.loads') }}" class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Loads Checker</p>
                </a>
              </li>

              <li class="nav-item">
              <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Ratio Checker</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/marks/check" class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Marks Checker</p>
                </a>
              </li>

            

            </ul>
          </li>

          @endrole

          @role('teacher')

          

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Marks
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/marks"  class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Enter Marks</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/marks/analytics"  class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Mark Analysis</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/marks/manage"  class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Manage Marks</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/marks/transfer"  class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Transfer Marks</p>
                </a>
              </li>

             
            </ul>
          </li>


          @endrole

          @role('admin_teacher')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chalkboard"></i>
              <p>
                Academic Configurations
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('grade.index')}}"  class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Class Management</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('subject.create') }}" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>
                    Subjects Management
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('allocation.create') }}" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>
                    Subjects Allocations
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('grade.class_lists_index')}}"  class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Class Lists</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/academic-admin/section" class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Section Management</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/academic-admin/stream" class="nav-link">
                  <i class="nav-icon fas fa-check-circle"></i>
                  <p>Stream Management</p>
                </a>
              </li>
            
              
            </ul>
          </li>
          @endrole
          @if (Auth::user()->hasRole(['admin_teacher', 'school-administrator']))
           <!----Beginning of Promotions Management--------->
   {{-- <li class="nav-item has-treeview">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-book-reader"></i>
      <p>
       Resolution Management
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
   
    <ul class="nav nav-treeview">
      <li class="nav-item">
      <a href="{{route('resolutions.index')}}" class="nav-link">
           <i class="nav-icon fas fa-chevron-circle-right"></i>
          <p>Manage Resolutions</p>
        </a>
      </li>
    </ul>
  
 
  </li> --}}

  <li class="nav-item has-treeview">
    <a href="#" class="nav-link">
  
<i class="fas fa-forward  nav-iconf   "></i>

      <p>
       Migration Management
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
   
    <ul class="nav nav-treeview">
     

      <li class="nav-item">
        <a href="{{route('transition.index')}}" class="nav-link">
             <i class="nav-icon fas fa-chevron-circle-right"></i>
            <p>Student Migration</p>
          </a>
        </li>

    
      <li class="nav-item">
        <a href="{{route('sequence.index')}}" class="nav-link">
             <i class="nav-icon fas fa-chevron-circle-right"></i>
            <p>Class Sequencing</p>
          </a>
        </li>
    </ul>
  
 
  </li>

  

  <li class="nav-item has-treeview">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-edit"></i>
      <p>
       Timetable Management
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
   
    <ul class="nav nav-treeview">
      <li class="nav-item">
      <a href="{{route('timetable.index')}}" class="nav-link">
           <i class="nav-icon fas fa-chevron-circle-right"></i>
          <p>Add Timetable</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('timetable.show')}}" class="nav-link">
             <i class="nav-icon fas fa-chevron-circle-right"></i>
            <p>Manage Timetable</p>
          </a>
        </li>
    </ul>
  
 
  </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('school.create') }}" class="nav-link">
                  <i class="fas fa-school nav-icon"></i>
                  <p>School Settings </p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="{{ route('school.create') }}" class="nav-link">
                  <i class="fas fa-school nav-icon""></i>
                  <p>Front Page Settings </p>
                </a>
              </li> --}}
             
                
              </li>
            

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="fas fa-calendar-alt nav-icon    "></i>

                  <p>
                    Session Management
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('session.create')}}" class="nav-link">
                      <i class="nav-icon fas fa-chevron-circle-right"></i>
                      <p>Manage Session</p>
                    </a>
                  </li>
              
                 
                </ul>
              </li>
              <li class="nav-item">
                <a href="/marks/settings" class="nav-link">
                  <i class="fas fa-newspaper nav-icon"></i>
                  <p>Marks Settings</p>
              
                </a>
                
              </li>
              <li class="nav-item">
                <a href="{{route('assessement_settings.index')}}" class="nav-link">
                  <i class="fas fa-newspaper nav-icon"></i>
                  <p>Assessement Settings</p>
              
                </a>
                
              </li>
              <li class="nav-item has-treeview">
              
                <a href="#" class="nav-link">
                  <i class="fas fa-newspaper nav-icon"></i>
                  <p>Report Settings</p>
                  <i class="fas fa-angle-left right"></i>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('report_template.index')}}" class="nav-link">
                      <i class="nav-icon fas fa-chevron-circle-right"></i>
                      <p>Report Templates</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="/report/variables" class="nav-link">
                      <i class="nav-icon fas fa-chevron-circle-right"></i>
                      <p>Report Variables</p>
                    </a>
                  </li>
                
                </ul>
                
              </li>

            

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  
                  <i class="nav-icon fas fa-comments"></i>
                  <p>
                    Comments Settings
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('comments.index')}}" class="nav-link">
                      <i class="nav-icon fas fa-chevron-circle-right"></i>
                      <p>Add Comment</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{route('comments.show')}}" class="nav-link">
                      <i class="nav-icon fas fa-chevron-circle-right"></i>
                      <p>Manage Comments</p>
                    </a>
                  </li>
                  {{-- <li class="nav-item">
                    <a href="{{route('session.create')}}" class="nav-link">
                      <i class="nav-icon fas fa-chevron-circle-right"></i>
                      <p>Symbols Management</p>
                    </a>
                  </li> --}}
                  {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-chevron-circle-right"></i>
                      <p>Comment Types</p>
                    </a>
                  </li> --}}
                </ul>
              </li>
             
           

             
              
            </ul>
          </li>
{{-- 
          <li class="nav-header">Roles & Permissions</li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Roles Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/roles" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Roles</p>
                </a>
              </li>
            </ul>
          </li> --}}

              {{-- <li class="nav-item has-treeview"> --}}
                {{-- <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-user-graduate"></i>
                  <p>
                    Permissions Management
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a> --}}
                {{-- <ul class="nav nav-treeview"> --}}
                  {{-- <li class="nav-item">
                    <a href="/permissions" class="nav-link">
                      <i class="nav-icon fas fa-chevron-circle-right"></i>
                      <p>Permissions</p>
                    </a>
                  </li> --}}

                  {{-- <li class="nav-item">
                    <a href="/permissions" class="nav-link">
                      <i class="nav-icon fas fa-chevron-circle-right"></i>
                      <p>Assign Permissions</p>
                    </a>
                  </li> --}}

         
                {{-- </ul> --}}
             
          


          <li class="nav-header">User Management</li>
        

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Students Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/users/student" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Student Admissions</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/users/student/manage/removal/" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p> Student Issues</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('students.management')}}" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>View Students</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p> Fees</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('student.images')}}" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Student Images</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/students/online-registrations" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Online Registration</p>
                </a>
              </li> 
            
             
              <li class="nav-item">
                <a href="{{ route('student.manage')}}" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Class List</p>
                </a>
              </li> 

              <li class="nav-item">
                <a href="/testimonial/create" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Testimonial</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="/link/students-parents/" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Link Parents</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Parents Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('parents.create')}}" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Add Parents</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('parents.manage')}}" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Manage Parents</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Teacher Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/users/teacher" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Teacher Registration</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/users/teacher/assign/classteacher" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Class Teacher</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/academic-admin/department" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>HOD Management</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/users/teacher/assign/headofdepartment" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Commitees</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/users/teachers/manage" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Manage Teachers</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
             
              <i class="nav-icon fas fa-hospital-user"></i>
              <p>
                Admin Staff
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/users/support" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="users/support/assign" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Assign User</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="users/teachers/manage" class="nav-link">
                  <i class="nav-icon fas fa-chevron-circle-right"></i>
                  <p>Manage User</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          @role('bursar')
     
          <li class="nav-header">School Accounting</li>

          <li class="nav-item">
            <a href="{{ route('accounts.create')}}" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
              School Accounts
              </p>
            </a>
          </li>   
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
         
              <i class="nav-icon fas fa-money-check-alt"></i>
              <p>
                Partners
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('partner_type.create')}}" class="nav-link">
                  <i class="nav-icon fas fa-chart-line"></i>
                  <p>
                  Partner Types
                  </p>
                </a>
              </li>
                <li class="nav-item">
                    <a href="{{ route('partner.create')}}" class="nav-link">
                      <i class="nav-icon fas fa-chart-line"></i>
                      <p>
                       Manage School Partners
                        
                      </p>
                    </a>
                  </li>
                 
          
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
         
              <i class="nav-icon fas fa-money-check-alt"></i>
              <p>
                Petty Cash
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('pettycash.create')}}" class="nav-link">
                  <i class="nav-icon fas fa-chart-line"></i>
                  <p>
                  Add Petty Cash
                  </p>
                </a>
              </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-chart-line"></i>
                      <p>
                       Manage Petty Cash
                        
                      </p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="/accounting/petty-cash/report/" class="nav-link">
                      <i class="nav-icon fas fa-chart-line"></i>
                      <p>
                      Petty Cash Report
                        
                      </p>
                    </a>
                  </li>

                  
            </ul>
          </li>
          

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
         
              <i class="nav-icon fas fa-money-check-alt"></i>
              <p>
                Income & Expenditure
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('partner_type.create')}}" class="nav-link">
                  <i class="nav-icon fas fa-chart-line"></i>
                  <p>
                    Income & Expenditure
                  </p>
                </a>
              </li>
                <li class="nav-item">
                    <a href="{{ route('partner.create')}}" class="nav-link">
                      <i class="nav-icon fas fa-chart-line"></i>
                      <p>
                       Manage Income & Expenditure
                        
                      </p>
                    </a>
                  </li>

            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
         
              <i class="nav-icon fas fa-money-check-alt"></i>
              <p>
                Fees Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('fee_structure.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-chart-line"></i>
                  <p>
                   Fee Structure
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/add/fees" class="nav-link">
                  <i class="nav-icon fas fa-chart-line"></i>
                  <p>
                   Quick Fees
                    
                  </p>
                </a>
              </li>
                <li class="nav-item">
                    <a href="/users/student/management" class="nav-link">
                      <i class="nav-icon fas fa-chart-line"></i>
                      <p>
                       Add Fees
                        
                      </p>
                    </a>
                  </li>
          
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/accounts/reports/fees" class="nav-link">
                      <i class="nav-icon fas fa-chart-line"></i>
                      <p>
                       Fees Report
                        
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/accounts/reports/fees" class="nav-link">
                      <i class="nav-icon fas fa-chart-line"></i>
                      <p>
                     Income & Expenditure
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/accounts/reports/fees" class="nav-link">
                      <i class="nav-icon fas fa-chart-line"></i>
                      <p>
                     Petty Cash
                      </p>
                    </a>
                  </li>
          
            </ul>
          </li>
        
         
         @endrole
          
        </ul>
      </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                      @include('flash::message')
                        <div class="row mb-2">
                            <div class="col">
                                <h1>{{ $header ?? '' }}</h1>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <x:notify-messages />
                <section class="content">
                    <div class="container-fluid">
        
                      
                        <div class="row">
                            <div class="col">
                                {{ $slot }}
                            </div>

                            @if (isset($aside))
                                <div class="col-lg-3">
                                    {{ $aside }}
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
  
            {{-- <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                  @if(empty(\App\Models\School::all()))
  
                  <b><a href="#">{{ config('app.name', 'Shunifu') }}</a></b>
                  @else
                  @foreach (\App\Models\School::all() as $item)
                  <b><a href="#">{{ ($item->school_name) }}</a></b>
                  <title>{{ ($item->school_name) }}</title>
                  @endforeach
                  @endif
                </div>
                
            </footer> --}}
        </div>

        @stack('modals')
           <!-- Scripts -->
           <script src="https://cdn.statically.io/gh/innovazania/assets/master/app.js"></script>
           <script src="https://cdn.statically.io/gh/innovazania/assets/7f444680/admin-lte.js"></script>
           <script src="https://cdn.statically.io/gh/innovazania/assets/9ec219d9/notify.js"></script> 

        {{-- <script src="https://cdn.statically.io/gist/innovazania/b8793c83a804e280c38ddcfe14d23f20/raw/d22fe37eb7ca6cdcbb3def5761244fae4dca450c/livewire.js" ></script>  
           @livewireScripts

         
        
          
          {{-- <script  src="/js/app.js" ></script>  --}}
          {{-- <script  src="/js/dist/jquery.js" ></script>  --}}
      
          <script src="{{asset('js/app.js')}}"></script> 
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
           {{-- <script src="https://code.highcharts.com/highcharts.js"></script> --}}
           {{-- <script src="https://cdn.jsdelivr.net/npm/@wiris/mathtype-tinymce5@7.24.6/plugin.min.js"></script> --}}
           <script src="https://cdn.jsdelivr.net/npm/d3@7"></script>
           <script>
           
           const div = d3.selectAll("div");
           
           </script>
          
        
        <script>
          $('#flash-overlay-modal').modal();
      </script>
      @notifyJs
      
       
        @stack('scripts')
        <script>
          $(window).load(function(){
    $.ajaxSetup({
        statusCode: {
            419: function(){
                    location.reload(); 
                }
        }
    });
});
        </script>
 
 <!-- Smartsupp Live Chat script -->

 <div class="no-print">


{{-- <!-- Start of innovazaniahelp Zendesk Widget script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=a6e3def3-7f61-499f-8bac-dadabdeddd69"> </script>
<!-- End of innovazaniahelp Zendesk Widget script --> --}}

{{-- <script>
	window.fwSettings={
	'widget_id':151000001568
	};
	!function(){if("function"!=typeof window.FreshworksWidget){var n=function(){n.q.push(arguments)};n.q=[],window.FreshworksWidget=n}}() 
</script>
<script type='text/javascript' src='https://widget.freshworks.com/widgets/151000001568.js' async defer></script> --}}

</div>
    </body>
</html>
