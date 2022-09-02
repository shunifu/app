<x-app-layout>
    <x-slot name="header">
<style>
    .profile-head {
    transform: translateY(5rem)
}

.cover {
    background-image: url(https://fabrx.co/preview/muse-dashboard/assets/img/placeholder16.svg);
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
                            @if(empty($teacher->profile_photo_path))
                            <img src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1613141854/default-profile-picture-avatar-photo-placeholder-vector-illustration-vector-id1214428300_urpxk5.jpg" alt="..." width="180" class="rounded mt-8 rounded-circle">
                            @else

                            
                            <img src="/storage/{{$item->profile_photo_path}}" alt="..." width="180" class="rounded mt-8 rounded-circle">
                            @endif
                        </div>
                       
                    </div>
                </div>
                <div class="bg-white p-4 mb-5 mt-5 d-flex justify-content-start ">
                    <div class="col-12 col-sm-6 col-lg-8">
                        <h3 class="mb-1">{{$teacher->name}} {{$teacher->middlename}} {{$teacher->lastname}}<svg class="ml-1"  xmlns="http://www.w3.org/2000/svg"
                                width="26" height="25.19" viewBox="0 0 24 23.25">
                                <path
                                    d="M23.823,11.991a.466.466,0,0,0,0-.731L21.54,8.7c-.12-.122-.12-.243-.12-.486L21.779,4.8c0-.244-.121-.609-.478-.609L18.06,3.46c-.12,0-.36-.122-.36-.244L16.022.292a.682.682,0,0,0-.839-.244l-3,1.341a.361.361,0,0,1-.48,0L8.7.048a.735.735,0,0,0-.84.244L6.183,3.216c0,.122-.24.244-.36.244L2.58,4.191a.823.823,0,0,0-.48.731l.36,3.412a.74.74,0,0,1-.12.487L.18,11.381a.462.462,0,0,0,0,.732l2.16,2.437c.12.124.12.243.12.486L2.1,18.449c0,.244.12.609.48.609l3.24.735c.12,0,.36.122.36.241l1.68,2.924a.683.683,0,0,0,.84.244l3-1.341a.353.353,0,0,1,.48,0l3,1.341a.786.786,0,0,0,.839-.244L17.7,20.035c.122-.124.24-.243.36-.243l3.24-.734c.24,0,.48-.367.48-.609l-.361-3.413a.726.726,0,0,1,.121-.485Z"
                                    fill="#0D6EFD"></path>
                                <path data-name="Path" d="M4.036,10,0,5.8,1.527,4.2,4.036,6.818,10.582,0,12,1.591Z"
                                    transform="translate(5.938 6.625)" fill="#fff"></path>
                            </svg>
                        </h3>
                        <p class="text-gray-700 mb-1 lh-base"><span class="text-bold">{{$teacher->grade_name}}</span> class teacher</p>
                 
                    </div>
                </div>
            
            </div>
        </div>
    </div>
<div class="col mb-3"></div>
    <div class="col-md-12 mx-auto  overflow-hidden">
        <div class="card">
          <div class="card-header p-3 mx-auto">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Students</a></li>
              <li class="nav-item"><a class="nav-link " href="#class_list" data-toggle="tab">Class List</a></li>
              <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Analytics</a></li>
     
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane" id="class_list">

        <div class="lead text-grey">
Class: <span class="text-bold">{{$teacher->grade_name}}</span><br>
Total:  <span class="text-bold">{{$total}}</span> Students <br>
Class Teacher: <span class="text-bold">{{$teacher->name}} {{$teacher->middlename}} {{$teacher->lastname}}</span>

        </div>
                   <hr>
                   <div class="d-flex justify-content-end mb-4">
                    <a class="btn btn-primary" href="/academic-admin/class/pdf/{{$teacher->grade_id}}">Export to PDF</a>
                </div>
        
<table class="table table-bordered mb-5">
    <thead class="table-dark">
        <tr>
       
            <th>Student Name </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student_item)
        <tr>
        
            <td>{{$student_item->lastname}} {{$student_item->middlename}} {{$student_item->name}}</td>
        
        </tr>  
        @endforeach
      
      
    </tbody>
</table>

                </div>
              <div class="tab-pane active" id="activity">
           
                <div class="card rounded-12 shadow-dark-80 border border-gray-50 mb-4">
                    <div class="d-flex align-items-center px-3 px-md-4 py-3 border-bottom border-gray-200">
                        <h5 class="card-header-title mb-0 my-md-2 ps-md-3 font-weight-semibold">Students ({{$total}})</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="pt-3 pt-md-4 pb-md-2 px-3 px-md-4">
                            <div class="p-md-3">
                                <form>
                                    <div class="input-group bg-white border border-gray-300 rounded py-1 px-3">
                                        <button type="button" class="border-0 bg-transparent p-1"><img
                                                src="https://fabrx.co/preview/muse-dashboard/assets/svg/icons/search@14.svg" alt="Search"></button>
                                        <input type="search" class="form-control fs-16 border-0" placeholder="Search Students...">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="pt-3 pt-md-4">
                            @foreach ($students as $item)
                            <div class="px-3 px-md-4 pb-3 pb-md-4">
                                <div class="row align-items-center px-md-3">
                                    <div class="col-auto">
                                        <span class="avatar avatar-lg avatar-circle">
                                        @if(empty($item->profile_photo_path))
                                        <img  class="user-image img-circle "  width="64" height="64" src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1613141854/default-profile-picture-avatar-photo-placeholder-vector-illustration-vector-id1214428300_urpxk5.jpg">
                                        @else
                                            <img  class="user-image img-circle "  width="64" height="64" src="/storage/{{$item->profile_photo_path}}">
                                        @endif

                                        </span>
                                    </div>
                                   
                                    <div class="col ps-0 ps-md-1">
                                        <h6 class="mb-1">
                                            <a href="/users/profile/student/{{$item->id}}"  class="text-black-600">{{$item->lastname}} {{$item->middlename}} {{$item->name}}</a>
                                        </h6>
              <p class="card-text small text-gray-600 lh-sm">
                @if(empty($item->gender))No Gender @else{{$item->gender}}@endif, {{\Carbon\Carbon::parse($item->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y years old')}}
                                        
                                        </p>
                                       
                                    </div>
                                    <div class="col-auto">
                                        <div class="dropdown ">
                                            <a href="/users/profile/student/{{$item->id}}" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                                class="btn btn-soft-primary btn-sm"><span>View Profile </span> 
                                                   
                                            </a>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            @endforeach
                           
   
                        </div>
                     
                    </div>
                </div>
               
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
               
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane " id="settings">
                <form class="form-horizontal">
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName2" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>

</x-app-layout>
