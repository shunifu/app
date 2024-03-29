<x-app-layout>
    <x-slot name="header">
      <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
     
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light  ">
         
              <!-- /.card-header -->
           
  
           
       
             



                  @if ($int==0)
              
<lottie-player src="https://assets6.lottiefiles.com/packages/lf20_dyrstm8f.json"  background="transparent"  speed="1"  style=" display: block;
margin-left: auto;
margin-right: auto;
margin-top: -100px;
width: 60%; "  loop  autoplay></lottie-player>
                  @else
                       <div class="card-header">
                <h3 class="card-title"><a href="/users/teacher/loads/"><i class="fas fa-arrow-circle-left"></i> Back</a> </h3>
              </div>
                  <div class="card-body">

                <img class="card-img-top" src=" https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_190,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_30_style_light_align_center:Manage Teaching Loads,w_0.3,y_0.28/v1613334423/pexels-photo-5965544_fhctzy.jpg" alt="">
                  <div class="card-body">
                    <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
                   <div class="text-muted">
                      <p class="card-text">  Use this section to manage your <span class="text-bold">{{$activeSessionYear}} </span>teaching loads. <br>

                    
                      </p>
                    
                   </div>
                  
                  </div>

                  <table class="table table-hover mx-auto table-bordered">
                    <thead class="thead-light">
                    <tr>
                      <th>Class</th>
                      <th>Subject</th>
                      <th>Manage</th>
                    </tr>
                    </thead>
                    <tbody>
              
                      
                        @foreach ($result_loads as $item)
                        <tr>
                        <td>{{$item->grade_name}}</td>
                        <td>{{$item->subject_name}}</td>


      <td class="py-0 align-middle">
        <div class="btn-group btn-group-sm">
          <a href="{{route('teaching_loads.view',$item->id)}}" class="btn btn-info"><i class="fas fa-eye mr-1"></i>View</a>
          <a href="{{route('teaching_loads.destroy',$item->id)}}" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Delete</a>
        </div>
      </td>


                        </tr>
                        
                        @endforeach
                      
                        
                    
                    </tbody>
                </table>
                      
                  @endif



                  
                  
                </div>
                <!-- /.card-body -->
      
            </div>
      
      
        </div>

            
          </div>  
    
</x-app-layout>

 