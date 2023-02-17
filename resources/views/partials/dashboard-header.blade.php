


<div class="bg-white shadow rounded overflow-hidden cover">
    {{-- <div class="px-4 pt-4 pb-4 elevation-2 cover">
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
     --}}
	 <img class="card-img-top"
	 src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_190,w_970/b_rgb:000000,e_gradient_fade,y_-0.0/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_100_style_light_align_center:{{Auth::user()->name}},w_0.0,y_0.0/v1613303961/shunifu_header_3_yw7ou0.png"
	 alt="">
	 
	
	
            
		<div class="bg-white p-3  ">

			

			<div class="col text-justify">
            <h4 class="mb-1">{{Auth::user()->name}} {{Auth::user()->middlename}} {{Auth::user()->lastname}}<svg class="ml-1"  xmlns="http://www.w3.org/2000/svg"
                    width="20" height="20" viewBox="0 0 24 23.25">
                    <path
                        d="M23.823,11.991a.466.466,0,0,0,0-.731L21.54,8.7c-.12-.122-.12-.243-.12-.486L21.779,4.8c0-.244-.121-.609-.478-.609L18.06,3.46c-.12,0-.36-.122-.36-.244L16.022.292a.682.682,0,0,0-.839-.244l-3,1.341a.361.361,0,0,1-.48,0L8.7.048a.735.735,0,0,0-.84.244L6.183,3.216c0,.122-.24.244-.36.244L2.58,4.191a.823.823,0,0,0-.48.731l.36,3.412a.74.74,0,0,1-.12.487L.18,11.381a.462.462,0,0,0,0,.732l2.16,2.437c.12.124.12.243.12.486L2.1,18.449c0,.244.12.609.48.609l3.24.735c.12,0,.36.122.36.241l1.68,2.924a.683.683,0,0,0,.84.244l3-1.341a.353.353,0,0,1,.48,0l3,1.341a.786.786,0,0,0,.839-.244L17.7,20.035c.122-.124.24-.243.36-.243l3.24-.734c.24,0,.48-.367.48-.609l-.361-3.413a.726.726,0,0,1,.121-.485Z"
                        fill="#0D6EFD"></path>
                    <path data-name="Path" d="M4.036,10,0,5.8,1.527,4.2,4.036,6.818,10.582,0,12,1.591Z"
                        transform="translate(5.938 6.625)" fill="#fff"></path>
                </svg>

				
            </h4>
			<span class="text-small text-secondary">Current Session is {{$activeSessionName}}</span>
            <p></p>
            <span class="text-gray-700 mb-1 2h-base">
                {{$greetings}}  {{\Spatie\Emoji\Emoji::waving_hand()}}{{Auth::user()->name}}, welcome back to Shunifu which is <span class="text-bold">Eswatini's most efficient, convenient and reliable school management platform</span>. This platform has been specially designed to help you, <span class="text-bold">{{Auth::user()->salutation}} {{Auth::user()->lastname}}</span> to do your work quickly, efficiently and effectively. Shunifu is here for you, to simplify and enhance your work at @foreach (\App\Models\School::all() as $item)
				<b>{{ ($item->school_name) }}</b>
				
				@endforeach.
           <hr>
  
                 The Shunifu team, is on stand-by to help you in the event you need assistance. To get assisted  you can
                 send us a message on WhatsApp  using the number
                  <a href="https://api.whatsapp.com/send?phone=26876890726&text='Hi Shunifu, this is, {{Auth::user()->name}}  {{Auth::user()->lastname}}, from @foreach (\App\Models\School::all() as $item) {{$item->school_name }} @endforeach I need assistance, my email is {{Auth::user()->email}} and cell number is {{Auth::user()->cell_number}} "><i class="fab fa-whatsapp "></i> 76890726</a> or call  <a href="tel:+26876890726">7689 0726  </a><small>(MTN)</small> /
                   <a href="tel:+26879890726">7989 0726 </a><small>(Eswatini Mobile)</small>. Thank you and have a splendid Shunifu experience.

        </div>
   
    </div>

</div>
<div class="mb-4">



</div>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="container">
<div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
       <div class="col">
		 <div class="card radius-10 border-start border-0 border-3 border-info">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>
						
						<p class="mb-0 text-secondary">Total Students</p>
						<h4 class="my-1 text-info">{{$total_students}}</h4>
						<a href="/users/student/management"><p class="mb-0 font-13 text-info " >View Students </p></a>
					</div>
					<div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="fa-solid fa-users-between-lines"></i>
					</div>
				</div>
			</div>
		 </div>
	   </div>
	   <div class="col">
		<div class="card radius-10 border-start border-0 border-3 border-danger">
		   <div class="card-body">
			   <div class="d-flex align-items-center">
				   <div>
					   <p class="mb-0 text-secondary">Total Teachers</p>
					   <h4 class="my-1 text-danger">{{$total_teachers}}</h4>
					   <a href="/users/teachers/manage"><p class="mb-0 font-13 text-danger">View Teachers </p></a> 
				   </div>
		
				   <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class="fas fa-user-graduate    "></i>
				   </div>
			   </div>
		   </div>
		</div>
	  </div>
	  <div class="col">
		<div class="card radius-10 border-start border-0 border-3 border-success">
		   <div class="card-body">
			   <div class="d-flex align-items-center">
				   <div>
					   <p class="mb-0 text-secondary">Total Parents</p>
					   <h4 class="my-1 text-success">{{$total_parents}}</h4>
					   <a href="/users/parents/manage"><p class="mb-0 font-13 text-success">View Parents </p></a> 
					
				   </div>
				   <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class="fas fa-user-friends    "></i>
				   </div>
			   </div>
		   </div>
		</div>
	  </div>

	  <div class="col">
		<div class="card radius-10 border-start border-0 border-3 border-warning">
		   <div class="card-body">
			   <div class="d-flex align-items-center">
				   <div>
					   <p class="mb-0 text-secondary">Student Attendance</p>
					   <h4 class="my-1 text-warning">0</h4>
					  <a href="/student/attendance"> <p class="mb-0 font-13 text-secondary ">Total Absent Today</p></a>
				   </div>
				   <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fa fa-users"></i>
				   </div>
			   </div>
		   </div>
		</div>
	  </div> 

	  <div class="col">
		<div class="card radius-10 border-start border-0 border-3 border-danger">
		   <div class="card-body">
			   <div class="d-flex align-items-center">
				   <div>
					   <p class="mb-0 text-secondary">Disciplinary Cases</p>
					   <h4 class="my-1 text-danger">0</h4>
					   <a href="/disciplinary/cases"><p class="mb-0 font-13 text-danger">View Cases </p></a> 
				   </div>
				   <div class="widgets-icons-2 rounded-circle bg-gradient-bloody  text-white ms-auto"><i class="fa fa-edit"></i>
				   </div>
			   </div>
		   </div>
		</div>
	  </div> 

	  <div class="col">
		<div class="card radius-10 border-start border-0 border-3 border-success">
		   <div class="card-body">
			   <div class="d-flex align-items-center">
				   <div>
					   <p class="mb-0 text-secondary">Active Teaching Loads</p>
					   <h4 class="my-1 text-success">{{$teaching_loads}}</h4>
					   <a href="/admin/check/loads"><p class="mb-0 font-13 text-success">View Loads </p></a> 
				   </div>
				   <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class="fas fa-chalkboard-teacher    "></i>

				
				   </div>
			   </div>
		   </div>
		</div>
	  </div> 

	

	  <div class="col">
		<div class="card radius-10 border-start border-0 border-3 border-warning">
		   <div class="card-body">
			   <div class="d-flex align-items-center">
				   <div>
					   <p class="mb-0 text-secondary">Class Teachers</p>
					   <h4 class="my-1 text-warning">{{$class_teachers}}</h4>
					   <a href="/users/teacher/assign/classteacher"><p class="mb-0 font-13 text-secondary">View Class Teachers</p></a>
				   </div>
				   <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fa fa-user-edit"></i>
				   </div>
			   </div>
		   </div>
		</div>
	  </div> 

	  <div class="col">
		<div class="card radius-10 border-start border-0 border-3 border-info">
		   <div class="card-body">
			   <div class="d-flex align-items-center">
				   <div>
					   
					   <p class="mb-0 text-secondary">Departments</p>
					   <h4 class="my-1 text-info">{{$departments}}</h4>
					   <a href="/academic-admin/department"><p class="mb-0 font-13 text-info " >View Departments </p></a>
				   </div>
				   <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="fas fa-building    "></i>
				   </div>
			   </div>
		   </div>
		</div>
	  </div>
	</div>
</div>