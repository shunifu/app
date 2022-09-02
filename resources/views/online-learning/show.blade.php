<x-app-layout>
    <x-slot name="header">
     
      
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light card  ">
              <div class="card-header">
                <h3 class="card-title">Lessons by {{Auth::user()->name}} {{Auth::user()->lastname}}</h3>
              </div>
              
                <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_270,w_970/b_rgb:000000,e_gradient_fade,y_-0.90/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_37_style_light_align_center:Lessons,w_0.2,y_0.12/v1615061941/Untitled_design_6_vd6i3k.png" alt="">
            
                                <div class="card-body">
                                  <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
                                 <div class="text-muted">
                                    <p class="card-text">
                                        <span class="text-bold">Use this section to view a list of lessons you created.<hr>
                                          <span class="text-bold">Also, use this section to manage the lessons you have created.</span><br>
                                          <ul>
                                            <li>
                                             To view in detail a specific lesson, click on the <span class="text-success">green</span> eye icon.
                                            </li>
                                            <li>
                                              To edit  a specific lesson, click on the  <span class="text-primary">blue</span> edit icon.
                                            </li>

                                            <li>
                                              To delete a specific lesson, click on the  <span class="text-danger">red</span> delete icon.
                                            </li>

                                          </ul>
                                      
                                  
                                    </p>
                                  
                                 </div>
                                
                                </div>

                                <hr>
                                
                              

              <!-- /.card-header -->
           
       
                <div class="card-body">
                  <div class="table-responsive">

                 

                  <table class="table table-hover mx-auto">
                    <thead class="thead-light hidden-md-up mx-auto">
                    <tr>
                      <th>Class</th>
                      <th>Subject</th>
                      <th>Title</th>
                      <th>Added</th>
                      <th>State</th>
                      <th>Manage</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                      
                        @foreach ($data as $item)
                        <tr>
                        <td>{{$item->grade_name}}</td>
                        <td>{{$item->subject_name}}</td>
                        <td>{{$item->lesson_title}}</td>
                        
                  <td>{{ \Carbon\Carbon::parse($item->lesson_date)->diffForhumans(['options' => \Carbon\Carbon::JUST_NOW]) }}</td>
                  <td>
                    @if ($item->status=="draft")
                    <i class="fas fa-file-alt mr-1 text-danger"></i>Draft
                    @else

                    <i class="fas fa-check-circle mr-1 text-success"></i> Published
                    @endif
                  </td>
                        <td> 

                          <a href="{{route('online-learning.view',$item->id)}}"><i class="fas fa-eye text-success mr-1"></i>View</a>
                          <span class="m-3 "></span>
                          <a href="{{route('online-learning.update',$item->id)}}"><i class="fas fa-edit text-primary mr-1"></i>Edit</a>
                          <span class="m-3 "></span>
                          <a href="{{route('online-learning.destroy',$item->id)}}"><i class="fas fa-trash text-danger mr-1"></i>Delete</a>

                        </td>
                        </tr>
                        
                        @endforeach
                      
                        
                    
                    </tbody>
                </table>
              </div>
                  
                </div>
                <!-- /.card-body -->
      
            </div>
      
      
        </div>

            
          </div>  
    
</x-app-layout>

 