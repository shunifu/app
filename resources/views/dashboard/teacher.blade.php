<x-app-layout>

    <x-slot name="header">

      @include('partials.cards-style')


    </x-slot>



<div class="container-fluid bg-white ">

    <div class="card-box  pl-2 pr-3  ">
        <div class="row align-items-center">
            <div class="col-md-4">
                <img width="100%" height="100%" src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1708988938/lzrrkkgcuutvreeqhsub.png" alt="" />
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


<div class="container-fluid">


<div class="card bg-white mb-3">
    <div class="card-body p-3">
      <p class="fs--1 mb-0">
       {{Auth::user()->name}}'s Shunifu Portal

      </p>
    </div>
  </div>
<div class="row">
    <div class="col-md-4 col-xl-4 cols-1 stretch-card grid-margin">
      <div class="card bg-gradient-white card-img-holder text-secondary card-rounded card-faded">
        <div class="card-body">
            <img src="https://res.cloudinary.com/doramr0cr/image/upload/v1705247636/coner3_x8nkjy.png" class="card-img-absolute" alt="circle-image">
          <h4 class="font-weight-normal ">My Students <i class="mdi mdi-chart-line mdi-20px float-right"></i>
          </h4>
          <strong><h3 class="fs-4 mb-2 font-weight-normal text-sans-serif text-warning" >345</h3></strong>
          <div class="table-responsive">
            <table class="table table-sm table-compact table-bordered ">
               <thead>
                   <tr>
                     <th>Male students</th>
                     <th>Female students</th>

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
           <div class="card-footer text-muted">
            <a href="#">View More</a>
        </div>
        </div>
      </div>
    </div>


    <div class="col-md-4 col-xl-4 cols-1 stretch-card grid-margin">
        <div class="card bg-gradient-white card-img-holder text-secondary card-rounded card-faded">
          <div class="card-body">
              <img src="https://res.cloudinary.com/doramr0cr/image/upload/v1705247863/Shuni4_qzsgow.png" class="card-img-absolute" alt="circle-image">
            <h4 class="font-weight-normal ">My Teaching Loads  <i class="mdi mdi-chart-line mdi-20px float-right"></i>
            </h4>
            <strong><h3 class="fs-4 mb-2 font-weight-normal text-sans-serif text-warning" >345</h3></strong>
            <div class="table-responsive">
                <table class="table table-sm table-compact table-bordered ">
                   <thead>
                       <tr>
                         <th>Subjects</th>
                         <th>Classes</th>

                         <th>Week Periods</th>
                       </tr>
                   </thead>
                   <tbody>
                       <tr>

                           <td>89</td>
                           <td>12</td>
                           <td>28</td>

                       </tr>

                   </tbody>
                </table>
               </div>
               <div class="card-footer text-muted">
                <a href="#">View More</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 col-xl-4 cols-1 stretch-card grid-margin">
        <div class="card bg-gradient-white card-img-holder text-secondary card-rounded card-faded">
          <div class="card-body">
              <img src="https://prium.github.io/falcon/v2.8.2/default/assets/img/illustrations/corner-1.png" class="card-img-absolute" alt="circle-image">
            <h4 class="font-weight-normal ">My Marks <i class="mdi mdi-chart-line mdi-20px float-right"></i>
            </h4>
            <strong><h3 class="fs-4 mb-2 font-weight-normal text-sans-serif text-warning" >0  <span class="text-sm">Today</span></h3></strong>
            <div class="table-responsive">
                <table class="table table-sm table-compact table-bordered ">
                   <thead>
                       <tr>
                         <th>This Month</th>
                         <th>This Term</th>
                         <th>YTD</th>

                       </tr>
                   </thead>
                   <tbody>
                       <tr>

                           <td>89</td>
                           <td>12</td>
                           <td>12</td>
                       </tr>

                   </tbody>
                </table>
               </div>
               <div class="card-footer text-muted">
                <a href="#">View More</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-xl-4 cols-1 stretch-card grid-margin">
        <div class="card bg-gradient-white card-img-holder text-secondary card-rounded card-faded">
          <div class="card-body">
              <img src="https://prium.github.io/falcon/v2.8.2/default/assets/img/illustrations/corner-1.png" class="card-img-absolute" alt="circle-image">
            <h4 class="font-weight-normal ">My Assessements <i class="mdi mdi-chart-line mdi-20px float-right"></i>
            </h4>
            <strong><h3 class="fs-4 mb-2 font-weight-normal text-sans-serif text-warning" >0  <span class="text-sm">Today</span></h3></strong>
            <div class="table-responsive">
                <table class="table table-sm table-compact table-bordered ">
                   <thead>
                       <tr>
                         <th>This Month</th>
                         <th>This Term</th>
                         <th>YTD</th>

                       </tr>
                   </thead>
                   <tbody>
                       <tr>

                           <td>89</td>
                           <td>12</td>
                           <td>12</td>
                       </tr>

                   </tbody>
                </table>
               </div>
               <div class="card-footer text-muted">
                <a href="#">View More</a>
            </div>
          </div>
        </div>
      </div>



      <div class="col-md-4 col-xl-4 cols-1 stretch-card grid-margin">
        <div class="card bg-gradient-white card-img-holder text-secondary card-rounded card-faded">
          <div class="card-body">
              <img src="https://prium.github.io/falcon/v2.8.2/default/assets/img/illustrations/corner-1.png" class="card-img-absolute" alt="circle-image">
            <h4 class="font-weight-normal ">Class Attendance
            </h4>
            <strong><h3 class="fs-4 mb-2 font-weight-normal text-sans-serif text-warning" >0  <span class="text-sm">Today</span></h3></strong>
            <div class="table-responsive">
                <table class="table table-sm table-compact table-bordered ">
                   <thead>
                       <tr>
                         <th>This Month</th>
                         <th>This Term</th>
                         <th>YTD</th>

                       </tr>
                   </thead>
                   <tbody>
                       <tr>

                           <td>89%</td>
                           <td>12%</td>
                           <td>12%</td>
                       </tr>

                   </tbody>
                </table>
               </div>
               <div class="card-footer text-muted">
                <a href="#">View More</a>
            </div>
          </div>
        </div>
      </div>


      <div class="col-md-4 col-xl-4 cols-1 stretch-card grid-margin">
        <div class="card bg-gradient-white card-img-holder text-secondary card-rounded card-faded">
          <div class="card-body">
              <img src="https://prium.github.io/falcon/v2.8.2/default/assets/img/illustrations/corner-1.png" class="card-img-absolute" alt="circle-image">
            <h4 class="font-weight-normal ">My Profile <i class="mdi mdi-chart-line mdi-20px float-right"></i>
            </h4>
            <strong><h3 class="fs-4 mb-2 font-weight-normal text-sans-serif text-warning" >My Profile  <span class="text-sm"></span></h3></strong>
            <div class="table-responsive">
                <table class="table table-sm table-compact table-bordered ">
                   <thead>
                       <tr>
                         <th>PP</th>
                         <th>Details</th>
                         <th>Contact</th>

                       </tr>
                   </thead>
                   <tbody>
                       <tr>

                           <td>0%</td>
                           <td>0%</td>
                           <td>0%</td>
                       </tr>

                   </tbody>
                </table>
               </div>
               <div class="card-footer text-muted">
                <a href="#">View More</a>
            </div>

          </div>
        </div>
      </div>

  </div>

@role('hod')
  <div class="card bg-white mb-3">
    <div class="card-body p-3">
      <p class="fs--1 mb-0">
        Department Indicators

      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4 col-xl-4 cols-3 stretch-card grid-margin ">
      <div class="card bg-gradient-white card-img-holder text-secondary card-rounded card-faded">
        <div class="card-body">
            <img src="https://prium.github.io/falcon/v2.8.2/default/assets/img/illustrations/corner-1.png" class="card-img-absolute" alt="circle-image">
          <h4 class="font-weight-normal ">Total Teachers
          </h4>
          <strong><h3 class="fs-4 mb-2 font-weight-normal text-sans-serif text-warning" > <strong> 345</strong></h3></strong>

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

                    <td>12</td>
                    <td>46</td>

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
                    <th>This Month</th>
                    <th>This Term</th>
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
                    <th>This Month</th>
                    <th>This Term</th>
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





<?php
if (empty(\App\Models\TeachingLoad::where('teacher_id', Auth::user()->id))){
  ?>
  <script>
    $(document).ready(function () {
      $('#notice').modal('show');
    });


</script>
<?php
}else{

  ?>
  <script>
    $(document).ready(function () {
      $('#notice').modal('show');
    });



</script>

<?php

}

?>

</x-app-layout>
