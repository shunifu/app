<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
  
    <div class="card card-light  ">
        <div class="card-header">
          <h3 class="card-title">Subject Allocations</h3>
        </div>
    
        
          <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_210,w_970/b_rgb:000000,e_gradient_fade,y_-0.60/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_35_style_light_align_center:Subject Allocations,w_0.2,y_0.28/v1615231896/Untitled_design_7_bahmem.png" alt="">
          <div class="card-body">
            <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
           <div class="text-muted">
              <p class="card-text"> Use this section to manage School Academic Allocations. <br>
                To remove a subject from the list, click on delete
            
              </p>
            
           </div>
          
          </div>
      </div> 


<div class="row">
    


  <div class="col">

    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Manage Allocations</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      
        <div class="card-body">
          
          <table class="table table-hover table-bordered">
            <thead class="thead-light">
              <tr>
                <th>Subject Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
               @foreach ($allocation as $item)
               <tr>
                   <td>{{$item->subject_name}}</td>
                  
                    <td class="py-0 ">
                    

                        <a class="dropdown-item" href="allocation/delete/{{encrypt($item->allocation_id)}}"><i class="fas fa-trash-alt text-danger"></i> <span class="text-secondary">Delete Subject</span> </a>
                    </td>

                   

                  
                   
                </tr>
               
               
               @endforeach
              </tr>
              
            </tbody>
          </table>
        </div>

     
    </div>

  </div>
      
    </div>   
            
     
    
</x-app-layout>