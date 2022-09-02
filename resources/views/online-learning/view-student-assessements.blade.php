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
                            <span class="text-bold">Assesement Date:</span> {{ \Carbon\Carbon::parse($item->due_date)->diffForhumans(['options' => \Carbon\Carbon::JUST_NOW]) }}<br>
                           
                        </p>
                      
                     </div>
                    
                    </div>
                    
                  </div>      
                  @endforeach 
                
                <div class="card-body">

<x-jet-label> Students</x-jet-label>
<div class="form-row">
  
<table class="table table-hover table-inverse">
    <thead class="thead-inverse">
        <tr>
            <th>Student Name</th>
            <th>Submitted</th>
            <th>Action</th>
          
        </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr>
                <td>{{$student->name}} {{$student->middlename}} {{$student->lastname}} </td>
                <td>{{ \Carbon\Carbon::parse($student->created_at)->diffForhumans(['options' => \Carbon\Carbon::JUST_NOW]) }}</td>
              
                <td>
                    <a href="/online-learning/lessons/assessement/teacher/feedback/add/{{$item->id}}/{{$student->response_id}}/{{$student->student_id}}/"><button type="button" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> View Assessement</button></a>
                    <a href="/online-learning/lessons/assessement/teacher/feedback/edit/{{$item->id}}/{{$student->response_id}}/{{$student->student_id}}/"><button type="button" class="btn btn-danger btn-sm"><i class="fas fa-edit"></i> Edit Assessement</button></a>
                    <a href="/online-learning/lessons/assessement/feedback/{{$item->id}}"><button type="button" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Message {{$student->name}}</button></a>
                
                </td>
            </tr>  
            @endforeach

        </tbody>
</table>

 </div>
                                
                </div>
                <!-- /.card-body -->
      
                <div class="card-footer">
                <a href="/online-learning/lessons/assessement/manage/"><x-jet-button>Back</x-jet-button></a>
                </div>
             
          
            </div>
      
      
        </div>

            
          </div>  
    
</x-app-layout>

 