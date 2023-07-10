<x-app-layout>
    <x-slot name="header">
      <style>
     

      </style>
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
    
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1688933646/c6mw5isku7asaukgghlu.jpg">
        <div class="card-body">
          <h4 class="lead"> Article Feed</h4>
         
          <hr>
         <div class="text-muted">
          Hi, <span class="text-bold">{{Auth::user()->salutation}} {{Auth::user()->lastname}}</span>. Welcome to the IN-Service Education & Training Article section. You will use this section to access content curated by the INSET Team to help improve as a teacher.<br>
          To go back click <a href="/users/student">here</a> 
         </div>
       
        </div>
    </div> 
    <div class="row">
        <div class="col">
          <div class="card card-light">
            <div class="row">
              <div class="col-lg-10 mx-auto">
                  <div class="career-search mb-60">

                      <form action="#" class="career-form mb-60">
                          <div class="row">
                              <div class="col-md-6 col-lg-3 my-3">
                                  <div class="input-group position-relative">
                                      <input type="text" class="form-control" placeholder="Enter Your Keywords" id="keywords">
                                  </div>
                              </div>
                              <div class="col-md-6 col-lg-3 my-3">
                                  <div class="select-container">
                                      <select class="custom-select">
                                          <option selected="">Topic</option>
                                          <option value="1">School Administration</option>
                                          <option value="2">Lesson Developement</option>
                                          <option value="3">Competency Based Education</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6 col-lg-3 my-3">
                                  <div class="select-container">
                                      <select class="custom-select">
                                          <option selected="">Date</option>
                                          <option value="1">Latest Articles</option>
                                          <option value="2">Oldest Articles</option>
                                        
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6 col-lg-3 my-3">
                                  <button type="button" class="btn btn-lg btn-block btn-light btn-custom" id="contact-submit">
                                      Search
                                  </button>
                              </div>
                          </div>
                      </form>
          </div>
        </div>
    </div>
      
   

              <div class="card-body">

           
             

                <div class="row  ">
  <div class="col-3">
    <div class="bg-image hover-overlay ripple shadow-2-strong rounded-5 "  >
      <img style="width: 320px; height:200px" src="https://images.unsplash.com/photo-1667844141324-61585c18b0df?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2940&q=50" class="img-fluid" />
      
    </div>
  </div>

  <div class="col">

    <h4><strong>Enhancing content focus and mastery in Math</strong></h4>
    <span class="mt-2 ">Author: FK Dlamini</span>
    <br>
    <span class="mt-2 ">Published: 3 hours ago</span>
    <p class="text-muted">
     Content Mastery addresses whether students are achieving at the level necessary to be prepared for the next grade
Mastery learning ensures students obtain mastery in a given topic before moving on to the next It assumes any student can reach high levels of achievement given sufficient instruction, time and perseverance. 
    </p>
   <a href="#">Read more</a>
  </div>
</div>
<hr>

<div class="row ">
  <div class="col-3">
    <div class="bg-image hover-overlay ripple shadow-2-strong rounded-5 "  >
      <img style="width: 320px; height:190px"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1688937621/c8slsrdxks6cr5r0jf0a.png" class="img-fluid" />
      
    </div>
  </div>

  <div class="col">

    <h4><strong>Supervision</strong></h4>
    <span class="mt-2 ">Author: M Sihlongonyane</span>
    <br>
    <span class="mt-2 ">Published: 14 Days ago</span>
    <p class="text-muted">
      Head teachers as education managers, are expected to provide the professional support and guidance that teachers need so that they can approach classroom instruction with confidence. 
Teachers as instructional leaders are expected to collaborate with each other and with supervisors in a kind of mutual and cooperative search for answers. 
    </p>
    <a href="/inset/article/view/1">Read more</a>
  </div>
</div>

<hr>

<div class="row ">
  <div class="col-3">
    <div class="bg-image hover-overlay ripple shadow-2-strong rounded-5 "  >
      <img style="width: 320px; height:190px"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1688949237/vznjgpkzntpyu78x9dwb.jpg" class="img-fluid" />
      
    </div>
  </div>

 
  <div class="col">

    <h4><strong>Effective Lesson Delivery</strong></h4>
    <span class="mt-2 ">Author: INSET Author</span>
    <br>
    <span class="mt-2 ">Published: 14 Days ago</span>
    <p class="text-muted">
      Students may have different backgrounds, abilities, behaviours, and personalities. Teaching strategies and teaching materials need to be adapted to the students. For example, if most of the students cannot learn too fast, teaching materials need to be delivered more detail, one step at a time and slow.
    </p>
    <a href="#">Read more</a>
  </div>
</div>

<!--Section: News of the day-->

              
                {{-- <div class="card" id="card" >
                  <img src="https://images.unsplash.com/photo-1667844141324-61585c18b0df?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2940&q=50"  width="320px" height="320px"  class="card-img-top img-fluid" alt="...">
                  <div class="card-body">
                    <h2 class="card-title ">Enhancing content focus and mastery in Math</h2>
          <br>
                    <h6 class="text-muted" > <i class="fa-regular fa-clock"></i> 10 Minutes ago</h6>
                    <h6 class="text-muted"><i class="fa-regular fa-user"></i>  Mary Sihlongonyane</h6>
                   <hr>
                    <p class="card-text">Content Mastery addresses whether students are achieving at the level necessary to be prepared for the next grade.
                      Mastery learning ensures students obtain mastery in a given topic before moving on to the next.<br> It assumes any student can reach high levels of achievement given sufficient instruction, time and perseverance.</p>
                    <a href="#" class="btn btn-primary">Read More</a>
                  </div>
                </div> --}}
                <hr>

                {{-- <div class="card" id="card" >
                  <img src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1688937621/c8slsrdxks6cr5r0jf0a.png" width="320px" height="320px"  class="card-img-top img-fluid" alt="...">
                  <div class="card-body">
                    <h2 class="card-title">Supervision</h2>
                    
                    <br>
                              <h6 class="text-muted" > <i class="fa-regular fa-clock"></i> 10 Minutes ago</h6>
                              <h6 class="text-muted"><i class="fa-regular fa-user"></i>  Mary Sihlongonyane</h6>
                    <p class="card-text">Head teachers as education managers, are expected to provide the professional support and guidance that teachers need so that they can approach classroom instruction with confidence. <br>
                      Teachers as instructional leaders are expected to collaborate with each other and with supervisors in a kind of mutual and cooperative search for answers. The principal of a successful school is not only the instructional leader but the coordinator of teachers as instructional leaders (Glickman, 1991, p.7). </p>
                    <a href="#" class="btn btn-primary">Read More</a>
                  </div>
                </div>
       --}}


     

     
            
          </div>  

          

          
    
</x-app-layout>

 