<x-app-layout>
    <x-slot name="header">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    </x-slot>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card card-light  
                <div class="card-header">
                    <h3 class="card-title"></h3>
                </div>

                <img class="card-img-top"
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_287,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_34_style_light_align_center:Online Learning Assessements,w_0.4,y_0.18/v1637781316/pexels-photo-3825462_om73ik.jpg">

                <div class="card-body">
                    <p class="py-2"> Hi, <span class="text-bold">{{ Auth::user()->salutation }} {{ Auth::user()->name }}  {{ Auth::user()->lastname }}</span> , this section shows you all the online-learning assessements you have created. <ul>
                      <li>If you want to create another assessement, click on the <span class="text-bold">Create Assessement</span> button on the bottom right.</li>

                      <li> If you want to view or attach questions to the assessement click on the <span class="text-bold">view questions link </span> the table below under the questions header</li>

                      <li> And  if you want to edit or delete the assessement, click the buttons for the desired action in the table below under the Manage header</li>
                      
                    </ul> 
                  </p>
                    <div class="text-muted">
                        <p class="card-text">
                           
                                {{-- <ul>
                                    <li>First select the class you want to create the lesson for.</li>
                                    <li>Secondly add the title of the lesson.</li>
                                    <li>Add the objectives of the lesson</li>
                                    <li>Add the summary of the lesson</li>
                                </ul> --}}


                        </p>

                    </div>

                </div>

  
                <!-- /.card-header -->
            </div>
            <hr>
          <div class="card ">
       
            <div class="card-body">
              <h4 class="card-title">List of Assessements</h4>
              <p class="card-text">
            
                <div class="float-right"><a href="/online-learning/assessement/create/assessement/"><button class="btn btn-success">Create Assessement</button></a></div>
              
 
<div class="table-responsive py-4">
<table class="table table-bordered table-hover " id="assessement_table">
    <thead class="thead-light">
        <tr>
            <th>Type</th>
            <th>Title</th>
            <th>Topic</th>
            <th>Due Date</th>
            <th>Load</th>
            <th>Questions</th>
            <th>Manage</th>

        </tr>
    </thead>
    <tbody>

        

        @foreach ($assessements as $item)
        <tr>
            <td>{{$item->assessement_type_name}}</td>
            <td>{{$item->assessement_title}}</td>
            <td>{{$item->lesson_topic}}</td> 
            <td>{{ \Carbon\Carbon::parse($item->due_date)->diffForhumans() }}</td>
            <td>{{$item->grade_name}}-{{$item->subject_name}}</td> 
            <td class="text-xs-center"><a href="/online-learning/assessements/attach-questions/{{$item->id}}">View Questions</a></td> 
            <td>
              <div class="row">
                <div class="pt-3 col-auto ">
                  <a  href="/online-learning/assessements/view/edit/{{$item->id}}">Edit</a>
                </div>
                <div class="pt-3 col-auto">
                <a data-toggle="modal" data-target="#exampleModal" href="#">Delete</a>
                </div>
              </div>
             
            </td> 
        </tr>

        <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Assessement?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete {{$item->assessement_title}} {{$item->assessement_type_name}}?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
          <a href="/online-learning/assessements/delete/{{$item->id}}"><button type="button" class="btn btn-danger">Yes, Delete</button></a>
        </div>
      </div>
    </div>
  </div>
        @endforeach
        
      
    </tbody>
</table>
</div>
                  
              </p>
            </div>
          </div> <!--end of card body--->
         
        </div><!---end of col----->

    </div><!----end of row---->

</div><!----end of container----->
    
    <script>
        $(document).ready(function () {
        


        });

    </script>

</x-app-layout>
