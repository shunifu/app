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
    
    <div class="bg-white p-4 mb-5 mt-5 d-flex justify-content-start rt">
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
            <p class="text-gray-700 mb-1 2h-base">{{$greetings}} {{\Spatie\Emoji\Emoji::grinningFace()}} {{Auth::user()->salutation}}. {{Auth::user()->name}}<p> 

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
						<h4 class="my-1 text-info">4805</h4>
						<p class="mb-0 font-13">+2.5% from last week</p>
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
					   <h4 class="my-1 text-danger">84,245</h4>
					   <p class="mb-0 font-13">+5.4% from last week</p>
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
					   <h4 class="my-1 text-success">34.6%</h4>
					   <p class="mb-0 font-13">-4.5% from last week</p>
				   </div>
				   <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class="fa fa-bar-chart"></i>
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
					   <p class="mb-0 text-secondary">Total Classes</p>
					   <h4 class="my-1 text-warning">8.4K</h4>
					   <p class="mb-0 font-13">+8.4% from last week</p>
				   </div>
				   <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fa fa-users"></i>
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
					   <p class="mb-0 text-secondary"> Teaching Loads</p>
					   <h4 class="my-1 text-warning">8.4K</h4>
					   <p class="mb-0 font-13">+8.4% from last week</p>
				   </div>
				   <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fa fa-users"></i>
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
					   <h4 class="my-1 text-warning">8.4K</h4>
					   <p class="mb-0 font-13">+8.4% from last week</p>
				   </div>
				   <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fa fa-users"></i>
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
					   <p class="mb-0 text-secondary">Disciplinary Cases</p>
					   <h4 class="my-1 text-warning">8.4K</h4>
					   <p class="mb-0 font-13">+8.4% from last week</p>
				   </div>
				   <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fa fa-users"></i>
				   </div>
			   </div>
		   </div>
		</div>
	  </div> 
	</div>
</div>