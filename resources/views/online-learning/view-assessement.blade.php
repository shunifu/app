<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light">
              <div class="card-header card-light">
                <h3 class="card-title">View Assessement</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            
                  @foreach ($assessement as  $item)
            <div class="card  ">
    <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_280,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_25_style_light_align_center:{{Auth::user()->name}}'s Assesement Portal,w_0.5,y_0.18/v1613303961/pexels-photo-5212359_ukdzdz.jpg" alt="">

                    <div class="card-body">
                      <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
                     <div class="text-muted">
                        <p class="card-text">
                            <span class="text-bold">Subject:</span> {{$item->subject_name}} <br>
                            <span class="text-bold">Lesson:</span> {{$item->lesson_title}} <br>
                            <span class="text-bold">Class:</span> {{$item->grade_name}} <br>
                            <span class="text-bold">Assesement Date:</span> {{$item->due_date}} <br>
                      
                        </p>
                      
                     </div>
                    
                    </div>
                    
                  </div>      
                 
                
                <div class="card-body">

<x-jet-label> Assessement Content</x-jet-label>
<div class="form-row">
  
<div class="col-md-12 form-group border p-3">

    {!! $item->content !!}

  
    </div>

 </div>
                                
                </div>
                <!-- /.card-body -->
      
                <div class="card-footer">
                <a href="/online-learning/lessons/assessement/manage/"><x-jet-button>Back</x-jet-button></a>
                </div>
                @endforeach
          
            </div>
      
      
        </div>

            
          </div>  
    
</x-app-layout>

 