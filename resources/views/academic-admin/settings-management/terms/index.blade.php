<x-app-layout>
    <x-slot name="header">
      <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Manage School Calendar</h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.60/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_35_style_light_align_center:Academic Calendar,w_0.2,y_0.28/v1615231896/Untitled_design_7_bahmem.png" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to manage the school's terms. <br>
          
            </p>
          
         </div>
        
        </div>
    </div> 
  <div class="row">
    
  <div class="col-sm-4 col-md-4">
  
    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">Add Term</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('terms.store')}}" method="post">
          <div class="card-body">
            
            @csrf
            <div class="form-group">
              <x-jet-label>Term</x-jet-label>
              <x-jet-input name="term_name"  type="text" placeholder="Term Name" ></x-jet-input>
              @error('term_name')
              <span class="text-danger">{{$message}}</span>  
              @enderror
             
          </div>
  
               
          </div>
          <!-- /.card-body -->
  
          <div class="card-footer">
            <x-jet-button>Add Term  </x-jet-button>
          </div>
       
      </div>
    </form>
  
  </div>
  
  <div class="col-md-8">
  
    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Manage Terms</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      
        <div class="card-body">
        
          <table class="table table-bordered table table-hover table-responsive-md ">
            <thead class="thead-light">
              <tr>
                <th>Term Name</th>
                <th>Manage Term</th>
              </tr>
            </thead>
            <tbody>
              <tr>
               @foreach ($academic_session as $calendar)
               <tr>
                   <td>{{$calendar->term_name}}</td>
                   <td>{{$calendar->start_date}}</td>
                   <td>{{$calendar->end_date}}</td>
                   

                    <td class="text-left py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="/academic-admin/term/view/{{$calendar->id}}" class="btn btn-success"><i class="fas fa-edit mr-1"></i>View</a>
                        <a href="/academic-admin/term/edit/{{$calendar->id}}" class="btn btn-info"><i class="fas fa-edit mr-1"></i>Edit</a>
                        <a href="/academic-admin/term/delete/{{$calendar->id}}" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Delete</a>
                      </div>
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
    <script>
      $(document).ready(function () {
          var i = 1;
          $('#submit').hide();
          $('#add_input').click(function () {
          
              i++;
              $("#dynamic").append('<p></p>  <div class="input-group" id="row' + i +
                  '"><input type="text" class="form-control" name="lesson_objectives[]" placeholder="Lesson Objective"><div class="input-group-append"><button class="btn btn-danger btn_remove" name="remove" id="' +
                  i +
                  '"  type="button"><i class="fas fa-times"></i></button></div></div></div> <p></p>'
                  );
              $('#submit').show();
          });
  
  
          $(document).on('click', '.btn_remove', function () {
              var button_id = $(this).attr("id");
              $('#row' + button_id + '').remove();
          });
  
  
  
      });
  
  </script>
            
     
    
  </x-app-layout>