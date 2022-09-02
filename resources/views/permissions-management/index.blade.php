<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Permissions</h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_320,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_32_style_light_align_center:Subjects Management,w_0.3,y_0.20/v1617761938/pexels-tima-miroshnichenko-6549340_lhnivg.jpg" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to create permissions <br>
          
            </p>
          
         </div>
        
        </div>
    </div>  
<div class="row">


    
  <div class="col-md-4">

    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">Add Permission</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/permissions/add/" method="post">
          <div class="card-body">
            
                @csrf
                <div class="form-group">
                <x-jet-label>Permission Name</x-jet-label>
                <x-jet-input name="name" placeholder="e.g print-academic-report" ></x-jet-input>
                @error('name')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

                <div class="form-group">
                  <x-jet-label>Display Name</x-jet-label>
                  <x-jet-input name="display_name" placeholder=" " ></x-jet-input>
                  @error('display_name')
                  <span class="text-danger">{{$message}}</span>  
                  @enderror
                </div> 

                <div class="form-group">
                    <x-jet-label>Description</x-jet-label>
                    <x-jet-input name="description" placeholder=" " ></x-jet-input>
                    @error('description')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                </div> 
    
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <x-jet-button>Add Role</x-jet-button>
          </div>
       
      </div>
    </form>

  </div>

  <div class="col-md-8">

    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Manage Roles</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      
        <div class="card-body">
          
          <table class="table table-bordered table table-hover ">
            <thead class="">
              <tr>
                <th>Name</th>
                <th>Display Name</th>
                <th>Description</th>
                <th>Manage</th>
              </tr>
            </thead>
            <tbody>
              {{-- <tr>
             @foreach ($roles as $role)
               <tr>
                <td>{{$role->name}}</td>
                  <td>{{$role->display_name}}</td>
                   <td>{{$role->description}}</td>
                  <td>
                     <a href="subject/edit/{{$role->id}}" class="link"><i class="fas fa-edit mr-1"></i>Edit</a>
<span class="m-3"></span>
                    <a href="subject/delete/{{$role->id}}"><i class="fas fa-trash mr-1"></i>Delete</a>
                    </td>
                   
                </tr> 
               
               
              {{-- @endforeach --}}
              {{-- </tr> --}}
               
            </tbody>
          </table>
        </div>

     
    </div>

  </div>
      
    </div>   
            
     
    
</x-app-layout>