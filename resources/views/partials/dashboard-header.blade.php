
<style>
    /* Cards */
.card {
  border: 0;
  background: #fff;

  border-radius: 0.375rem;
}
  .card .card-body {
    padding: 1rem 1rem; }
    .card .card-body + .card-body {
      padding-top: 1rem; }
   .card .card-title {
    color: #343a40;
    text-transform: capitalize;
    font-size: 1.125rem; }



  .card.card-rounded {
    border-radius: 5px; }
  .card.card-faded {
    background: #b5b0b2;
    border-color: #b5b0b2; }

  .card.card-img-holder {
    position: relative; }
    .card.card-img-holder .card-img-absolute {
      position: absolute;
      top: 0;
      right: 0;
      height: 100%; }


  .text-warning {
    color: #f5803e!important;
}

.font-weight-normal {
    font-weight: 350!important;
}

  .card-deck .card {
    margin-bottom: .5rem
}

@media (min-width: 576px) {
    .card-deck {
        display:-webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: horizontal;

        -ms-flex-flow: row wrap;
        flex-flow: row wrap;
        margin-right: -.5rem;
        margin-left: -.5rem;
    }

    .card-deck .card {
        -webkit-box-flex: 1;
        -ms-flex: 1 0 0%;
        flex: 1 0 0%;
        margin-right: .5rem;
        margin-bottom: 0;
        margin-left: .5rem
    }
}
</style>


<div class="container-fluid bg-white ">



    <div class="card-box  pl-2 pr-3  ">
        <div class="row align-items-center">
            <div class="col-md-4">
                <img width="75%" height="75%" src="https://res.cloudinary.com/doramr0cr/image/upload/v1705173367/Screenshot_2024-01-13_at_21.09.35-removebg-preview_huqlel.png" alt="" />
            </div>
            <div class="col-md-8">
                <h4 class="font-20 weight-500 mb-10 text-capitalize">
                    Welcome back
                    <div class="weight-600 font-30 text-blue">Johnny Brown!</div>
                </h4>
                <p class="font-18 max-width-600">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde
                    hic non repellendus debitis iure, doloremque assumenda. Autem
                    modi, corrupti, nobis ea iure fugiat, veniam non quaerat
                    mollitia animi error corporis.
                </p>
            </div>
        </div>
    </div>

</div>




<div class="mb-4">



</div>


<div class="container">
{{-- <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
       <div class="col">
		 <div class="card radius-10 border-start border-0 border-3 border-info">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div>

						<p class="mb-0 text-secondary">Total Students</p>
						<h4 class="my-1 text-info">{{$total_students}}</h4>
						<a href="/users/student/management"><p class="mb-0 font-13 text-info " >View Student</p></a>
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
					   <p class="mb-0 text-secondary">Total </p>
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
					   <h4 class="my-1 text-info">{{$total_departments}}</h4>
					   <a href="/academic-admin/department"><p class="mb-0 font-13 text-info " >View Departments </p></a>
				   </div>
				   <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class="fas fa-building    "></i>
				   </div>
			   </div>
		   </div>
		</div>
	  </div>
</div> --}}

<div class="card bg-white mb-3">
    <div class="card-body p-3">
      <p class="fs--1 mb-0">
        Teachers,  Students & Parents

      </p>
    </div>
  </div>
<div class="row">
    <div class="col-md-4 col-xl-4 cols-1 stretch-card grid-margin">
      <div class="card bg-gradient-white card-img-holder text-secondary card-rounded card-faded">
        <div class="card-body">
            <img src="https://res.cloudinary.com/doramr0cr/image/upload/v1705247636/coner3_x8nkjy.png" class="card-img-absolute" alt="circle-image">
          <h4 class="font-weight-normal ">Total Students <i class="mdi mdi-chart-line mdi-20px float-right"></i>
          </h4>
          <strong><h3 class="fs-4 mb-2 font-weight-normal text-sans-serif text-warning" >345</h3></strong>
          <div class="table-responsive">
            <table class="table table-sm table-compact table-bordered ">
               <thead>
                   <tr>
                     <th>M</th>
                     <th>F</th>
                     <th>OVC</th>
                     <th>N-OVC</th>
                     <th>Prefects</th>
                     <th>Hostel</th>
                   </tr>
               </thead>
               <tbody>
                   <tr>

                       <td>89</td>
                       <td>12</td>
                       <td>100</td>
                       <td>100</td>
                       <td>100</td>
                       <td>100</td>
                   </tr>

               </tbody>
            </table>
           </div>
        </div>
      </div>
    </div>


    <div class="col-md-4 col-xl-4 cols-1 stretch-card grid-margin">
        <div class="card bg-gradient-white card-img-holder text-secondary card-rounded card-faded">
          <div class="card-body">
              <img src="https://res.cloudinary.com/doramr0cr/image/upload/v1705247863/Shuni4_qzsgow.png" class="card-img-absolute" alt="circle-image">
            <h4 class="font-weight-normal ">Total Teachers <i class="mdi mdi-chart-line mdi-20px float-right"></i>
            </h4>
            <strong><h3 class="fs-4 mb-2 font-weight-normal text-sans-serif text-warning" >345</h3></strong>
            <div class="table-responsive">
                <table class="table table-sm table-compact table-bordered ">
                   <thead>
                       <tr>
                         <th>Male</th>
                         <th>Female</th>
                         <th>HOD's</th>
                         <th>Class Teacher</th>

                       </tr>
                   </thead>
                   <tbody>
                       <tr>

                           <td>89</td>
                           <td>12</td>
                           <td>100</td>
                           <td>100</td>

                       </tr>

                   </tbody>
                </table>
               </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 col-xl-4 cols-1 stretch-card grid-margin">
        <div class="card bg-gradient-white card-img-holder text-secondary card-rounded card-faded">
          <div class="card-body">
              <img src="https://prium.github.io/falcon/v2.8.2/default/assets/img/illustrations/corner-1.png" class="card-img-absolute" alt="circle-image">
            <h4 class="font-weight-normal ">Total Parents <i class="mdi mdi-chart-line mdi-20px float-right"></i>
            </h4>
            <strong><h3 class="fs-4 mb-2 font-weight-normal text-sans-serif text-warning" >345</h3></strong>
            <div class="table-responsive">
                <table class="table table-sm table-compact table-bordered ">
                   <thead>
                       <tr>
                         <th>Male</th>
                         <th>Female</th>

                       </tr>
                   </thead>
                   <tbody>
                       <tr>

                           <td>89</td>
                           <td>12</td>

                       </tr>

                   </tbody>
                </table>
               </div>
          </div>
        </div>
      </div>
  </div>

@role('principal')
  <div class="card bg-white mb-3">
    <div class="card-body p-3">
      <p class="fs--1 mb-0">
        Financial Indicators

      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4 col-xl-4 cols-3 stretch-card grid-margin ">
      <div class="card bg-gradient-white card-img-holder text-secondary card-rounded card-faded">
        <div class="card-body">
            <img src="https://prium.github.io/falcon/v2.8.2/default/assets/img/illustrations/corner-1.png" class="card-img-absolute" alt="circle-image">
          <h4 class="font-weight-normal ">Income <i class="mdi mdi-chart-line mdi-20px float-right"></i>
          </h4>
          <strong><h3 class="fs-4 mb-2 font-weight-normal text-sans-serif text-warning" >Today: <strong>SZL 345</strong></h3></strong>

          <div class="table-responsive">
         <table class="table table-sm table-compact table-bordered ">
            <thead>
                <tr>
                    <th>C Month</th>
                    <th>Term</th>
                    <th>YTD</th>
                </tr>
            </thead>
            <tbody>
                <tr>

                    <td>E34556,56</td>
                    <td>E4563,90</td>
                    <td>E2563,90</td>
                </tr>

            </tbody>
         </table>
        </div>
        </div>
      </div>
    </div>


    <div class="col-md-4 col-xl-4 cols-1 stretch-card grid-margin ">
        <div class="card bg-gradient-white card-img-holder text-secondary card-rounded card-faded">
          <div class="card-body">
              <img src="https://prium.github.io/falcon/v2.8.2/default/assets/img/illustrations/corner-1.png" class="card-img-absolute" alt="circle-image">
            <h4 class="font-weight-normal ">Expenditure <i class="mdi mdi-chart-line mdi-20px float-right"></i>
            </h4>
            <strong><h3 class="fs-4 mb-2 font-weight-normal text-sans-serif text-warning" >Today: <strong>SZL 345</strong></h3></strong>

            <div class="table-responsive">
           <table class="table table-sm table-compact table-bordered ">
              <thead>
                  <tr>
                      <th>C Month</th>
                      <th>C Term</th>
                      <th>YTD</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>

                      <td>E34556,56</td>
                      <td>E4563,90</td>
                      <td>E2563,90</td>
                  </tr>

              </tbody>
           </table>
          </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 col-xl-4 cols-1 stretch-card grid-margin ">
        <div class="card bg-gradient-white card-img-holder text-secondary card-rounded card-faded">
          <div class="card-body">
              <img src="https://prium.github.io/falcon/v2.8.2/default/assets/img/illustrations/corner-1.png" class="card-img-absolute" alt="circle-image">
            <h4 class="font-weight-normal ">Total Fees Paid <i class="mdi mdi-chart-line mdi-20px float-right"></i>
            </h4>
            <strong><h3 class="fs-4 mb-2 font-weight-normal text-sans-serif text-warning" >Today: <strong>SZL 345</strong></h3></strong>

            <div class="table-responsive">
           <table class="table table-sm table-compact table-bordered ">
              <thead>
                  <tr>
                      <th>C Month</th>
                      <th>Term</th>
                      <th>YTD</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>

                      <td>E34556,56</td>
                      <td>E4563,90</td>
                      <td>E2563,90</td>
                  </tr>

              </tbody>
           </table>
          </div>
          </div>
        </div>
      </div>
  </div>

  <div class="card bg-white mb-3">
    <div class="card-body p-3">
      <p class="fs--1 mb-0">
        Attendance &  Disciplinary Cases

      </p>
    </div>
  </div>
  <div class="row">

      <div class="col-md-6 col-xl-6 cols-1 stretch-card grid-margin ">
        <div class="card bg-gradient-white card-img-holder text-secondary card-rounded card-faded">
          <div class="card-body">
              <img src="https://prium.github.io/falcon/v2.8.2/default/assets/img/illustrations/corner-1.png" class="card-img-absolute" alt="circle-image">
            <h4 class="font-weight-normal ">Disciplinary Cases <i class="mdi mdi-chart-line mdi-20px float-right"></i>
            </h4>
            <strong><h3 class="fs-4 mb-2 font-weight-normal text-sans-serif text-warning" >Today: <strong>0</strong></h3></strong>

            <div class="table-responsive">
           <table class="table table-sm table-compact table-bordered ">
              <thead>
                  <tr>
                    <th>Current Month</th>
                    <th>Current Term</th>
                      <th>YTD</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>

                      <td>89</td>
                      <td>12</td>
                      <td>100</td>
                  </tr>

              </tbody>
           </table>
          </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-xl-6 cols-1 stretch-card grid-margin ">
        <div class="card bg-gradient-white card-img-holder text-secondary card-rounded card-faded">
          <div class="card-body">
              <img src="https://prium.github.io/falcon/v2.8.2/default/assets/img/illustrations/corner-1.png" class="card-img-absolute" alt="circle-image">
            <h4 class="font-weight-normal ">Attendance <i class="mdi mdi-chart-line mdi-20px float-right"></i>
            </h4>
            <strong><h3 class="fs-4 mb-2 font-weight-normal text-sans-serif text-warning" >Today: <strong>89%</strong></h3></strong>

            <div class="table-responsive">
           <table class="table table-sm table-compact table-bordered ">
              <thead>
                  <tr>
                    <th>Current Month</th>
                    <th>Current Term</th>
                      <th>YTD</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>

                      <td>70%</td>
                      <td>90%</td>
                      <td>76%</td>
                  </tr>

              </tbody>
           </table>
          </div>
          </div>
        </div>
      </div>


  </div>

  @endrole


</div>
