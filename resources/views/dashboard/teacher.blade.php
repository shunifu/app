<x-app-layout>
  
    <x-slot name="header">
      
      @include('partials.dashboard-css')

      <style>
        
body{
  color:gray;

}

.small-text{
  font-size:15px;
}


      </style>
      
    </x-slot>

<div class="card text-left">


    <!-- Modal -->
    <div class="modal fade" id="notice" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{$greetings}} {{\Spatie\Emoji\Emoji::waving_hand()}} {{Auth::user()->salutation}} {{Auth::user()->name}} {{Auth::user()->lastname}} </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
             Welcome to the Shunifu Platform @if (Auth::user()->salutation=="Mr" OR Auth::user()->salutation=="MR")
                 <span class="text-bold">Sir</span>
             @elseif(Auth::user()->salutation=="Mrs" OR Auth::user()->salutation=="Miss" OR Auth::user()->salutation=="Ms" OR Auth::user()->salutation=="MRS" OR Auth::user()->salutation=="MS" OR  Auth::user()->salutation=="MISS")
                 <span class="text-bold">Ma'am</span>. We hope you had enough time to rest. Now that you are back at work, we at Shunifu  would like to wish you a productive & successful term. All the best to you and your students
               
             @endif !<br>

             <?php
if (!(\App\Models\TeachingLoad::where('teacher_id', Auth::user()->id)->where('active', 1))->exists()){
  ?>

            
                        Clueless about the system? No worries, below are the 2 basic steps to follow to start working.
                       <hr>
                        <span class="text-bold">Step 1<br>
                        Adding Teaching Loads</span>- <br><span class="text-justify"> You first need to tell the system which subjects you teach and in which class you teach them as well as the students that you teach. To do that, go to <a href="/users/teacher/loads">Add Teaching Loads</a>. Or click on Teaching Loads in the menu bar and select add teaching loads. <br>After adding teaching loads, you can then start adding marks. Please note that teaching loads are added once a year or unless there is a change in your teaching loads. </span>
                      
                        <?php

                        }else{

                        }
                        ?>
                        

                        <hr>
                        <p class="text-justify">

<?php
if (empty(\App\Models\Mark::where('teacher_id', Auth::user()->id))){
  ?>

  <span class="text-bold">Step 2<br>
                        Adding Marks</span><br>
                       Once teaching loads have been added you can now start adding marks. To add marks go to  <a href="/marks">Add Marks</a>, or click on the Marks icon in the menu bar.
                        When adding marks you will first select the teaching load you want to add marks for and after adding the teaching load you will then select the assessement you want to add marks for.
            
                        <br>
                        If you happen to teach a subject whereby you group students, lets say for example you teach English Literature in Form 4 and you teach 4 students in Form 4A, 8 in Form 4B and 10 Form 4C, you can NOW select each of the classes  when you are adding the marks (multiple selection).You just need to select the checkboxes next to the classes you want to add the marks for (as a group).
                        <?php
}else{
  ?>
  
Welcome back to Shunifu, <span class="text-bold">Eswatini's leading school management platform</span>'. This platform has been specially designed to help you, <span class="text-bold">{{Auth::user()->name}}</span>, do your work quickly, effeciently and effectively. Shunifu is here for YOU!

  <?php

}

                         ?>
            
                 
                     
                    </p>
            
          </div>
          <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            <button type="button" class="btn btn-primary" data-dismiss="modal">Ok Thanks! Let me try</button>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      
        <div class="col">
          <img class="card-img-top"
          src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1688801834/nzso5cmiuu2rmk1lvbsm.jpg"
          alt="">
          <div class="bg-white shadow rounded overflow-hidden cover">
          
            
            <div class="bg-white p-3  ">


                <div class="col text-justify">
                    <h4 class="mb-1 text-secondary" >{{Auth::user()->name}} {{Auth::user()->middlename}} {{Auth::user()->lastname}}<svg class="ml-1"  xmlns="http://www.w3.org/2000/svg"
                            width="20" height="20" viewBox="0 0 24 23.25">
                            <path
                                d="M23.823,11.991a.466.466,0,0,0,0-.731L21.54,8.7c-.12-.122-.12-.243-.12-.486L21.779,4.8c0-.244-.121-.609-.478-.609L18.06,3.46c-.12,0-.36-.122-.36-.244L16.022.292a.682.682,0,0,0-.839-.244l-3,1.341a.361.361,0,0,1-.48,0L8.7.048a.735.735,0,0,0-.84.244L6.183,3.216c0,.122-.24.244-.36.244L2.58,4.191a.823.823,0,0,0-.48.731l.36,3.412a.74.74,0,0,1-.12.487L.18,11.381a.462.462,0,0,0,0,.732l2.16,2.437c.12.124.12.243.12.486L2.1,18.449c0,.244.12.609.48.609l3.24.735c.12,0,.36.122.36.241l1.68,2.924a.683.683,0,0,0,.84.244l3-1.341a.353.353,0,0,1,.48,0l3,1.341a.786.786,0,0,0,.839-.244L17.7,20.035c.122-.124.24-.243.36-.243l3.24-.734c.24,0,.48-.367.48-.609l-.361-3.413a.726.726,0,0,1,.121-.485Z"
                                fill="#0D6EFD"></path>
                            <path data-name="Path" d="M4.036,10,0,5.8,1.527,4.2,4.036,6.818,10.582,0,12,1.591Z"
                                transform="translate(5.938 6.625)" fill="#fff"></path>
                        </svg>
                    </h4>
                    <hr>
                   
                    {{-- <p class="text-gray-700 mb-1 2h-base">{{$greetings}} {{\Spatie\Emoji\Emoji::waving_hand()}}{{Auth::user()->name}}<p> --}}
                     
                         {{-- <br> --}}
               <span class="text-gray-700 mb-1 2h-base">
                {{$greetings}}  {{\Spatie\Emoji\Emoji::waving_hand()}}{{Auth::user()->name}}, welcome back to Shunifu <span class="text-bold">Eswatini's most efficient, convenient and reliable school management platform</span>. This platform has been specially designed to help you, <span class="text-bold">{{Auth::user()->salutation}} {{Auth::user()->lastname}}</span> to do your work quickly, efficiently and effectively. Shunifu is here for you, to simplify your work as an educator.
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


        <div class="container">
          <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                 <div class="col">
               <div class="card radius-10 border-start border-0 border-3 border-info">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div>
                      
                      <p class="mb-0 text-secondary">Total Students</p>
                      <h4 class="my-1 text-info">{{$teacher_total_students}}</h4>
                      <a href="/users/teacher/loads/manage"><p class="mb-0 font-13 text-info " >View Students </p></a>
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
                       <p class="mb-0 text-secondary"> Teaching Loads</p>
                       <h4 class="my-1 text-danger">{{$teacher_teaching_loads}}</h4>
                       <a href="/users/teacher/loads/manage"><p class="mb-0 font-13 text-danger">View Teaching Loads </p></a> 
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
                       <p class="mb-0 text-secondary">Total Marks</p>
                       <h4 class="my-1 text-success">{{$total_marks}}<small class="small-text"> marks added</small></h4>
                       <a href="/marks/"><p class="mb-0 font-13 text-success">View Marks</p></a> 
                    
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
                       <p class="mb-0 text-secondary">My Profile</p>
                       <h4 class="my-1 text-warning">{{Auth::user()->name}}</h4>
                      <a href="/teacher/view/{{Crypt::encryptString(Auth::user()->id)}}"> <p class="mb-0 font-13 text-secondary ">View My Profile</p></a>
                     </div>
                     <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class="fa fa-users"></i>
                     </div>
                   </div>
                 </div>
              </div>
              </div> 
          
         
          
            </div>
          </div>




    
             
    
    <div class="mt-10 mb-25">
    <hr>
    
    </div>


    
              <div class="row">
                <!-- Left col -->
             
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-md-12 bg-white">


                
                  <!-- /.card -->
                </section>
                <!-- right col -->
              </div>
             
        </div>
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