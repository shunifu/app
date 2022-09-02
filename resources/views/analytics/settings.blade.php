<x-app-layout>
    <x-slot name="header">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">View School Analytics</h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_25_style_light_align_center:Analytics,w_0.5,y_0.18/v1617531400/photo-1542744173-05336fcc7ad4_sadssw.jpg" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to view school analytics <br>
          
            </p>
          
         </div>
        
        </div>
    </div> 
<div class="row">
    
  <div class="col-md-12">

    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">Assessement Management Menu</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
      
          <div class="card-body">

         <ul class="nav nav-pills mb-5 flex-column flex-sm-row  nav-fill" id="pills-tab" role="tablist">
<div class="p3">
    
</div>
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="pills-assessement-type-tab" data-toggle="pill" href="#pills-assessement-type" role="tab" aria-controls="pills-assessement-type" aria-selected="true">Assessement Type</a>
  </li>

  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-assessement-management-tab" data-toggle="pill" href="#pills-assessement-management" role="tab" aria-controls="pills-assessement-management" aria-selected="false">Assessements Management</a>
  </li>

  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-ca-exam-assignment-tab" data-toggle="pill" href="#pills-ca-exam-assignment" role="tab" aria-controls="pills-ca-exam-assignment" aria-selected="false">CA & Exam Assignment</a>
  </li>

  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-weight-tab" data-toggle="pill" href="#pills-weight" role="tab" aria-controls="pills-weight" aria-selected="false">Assessement Weight</a>
  </li>

  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-pass-rates-tab" data-toggle="pill" href="#pills-pass-rates" role="tab" aria-controls="pills-pass-rates" aria-selected="false">Passing Criteria</a>
  </li>

</ul>
<div class="tab-content" id="pills-tabContent">

<!---Beginning of Assessement Types---->
  <div class="tab-pane fade show active" id="pills-assessement-type" role="tabpanel" aria-labelledby="pills-assessement-type-tab">
    <div class="row">
        <div class="col-md-4">

            <div class="card card-light">
                <div class="card-header">
                  <h3 class="card-title">Add Assessement Type</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('assessement-type.store') }}" method="post">
                <!-- /beginning of card-body -->
                  <div class="card-body">
                        @csrf
                        <div class="form-group">
                        <x-jet-label> Assessement Type Name</x-jet-label>
                        <x-jet-input name="assessement_type" placeholder="Example Test" ></x-jet-input>
                        @error('assessement_type')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>
      
                  </div>
                  <!-- /end of card-body -->
        
                  <div class="card-footer">
                    <x-jet-button>Add Assessement Type</x-jet-button>
                  </div>
                </form>
              </div>
 
          </div>
    
     <div class="col-md-8">
        <div class="card card-light">
            <div class="card-header">
              <h3 class="card-title">Add Assessement Type</h3>
            </div>
            <!-- /.card-header -->
          
            <!-- /beginning of card-body -->
              <div class="card-body">
                 <table class="table">
                      <thead >
                          <tr>
                              <th>Assessement Type</th>
                              <th>Manage Assessements</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($assessement_types as $assessement_type)
                          <tr>
                            <td>{{$assessement_type->assessement_type_name}}</td>
    <td>
<a href="/assessement/type/edit/{{$assessement_type->id}}"><i class="fas fa-edit text-primary mr-4 pr-2"> <span>Edit</span> </i></a>
<a href="/assessement/type/delete/{{$assessement_type->id}}"><i class="fas fa-trash-alt text-danger mr-4 pr-2"><span class="ml-1">Delete</span></i></a>  
    </td>
                        </tr>  
                          @endforeach
                          
                          <tr>
                              <td scope="row"></td>
                              <td></td>
                              <td></td>
                          </tr>
                      </tbody>
                  </table>
  
              </div>
              <!-- /end of card-body -->
          </div>

      </div>


     </div>
  </div>
<!---End  of Assessement Types---->

<!---Beginning of Assessement Assignment---->
  <div class="tab-pane fade" id="pills-ca-exam-assignment" role="tabpanel" aria-labelledby="pills-ca-exam-assignment-tab">
    <div class="row">
        <div class="col-md-4">

            <div class="card card-light">
                <div class="card-header">
                  <h3 class="card-title">Assign CA & Exam</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('CA_Exam.store') }}" method="post">
                <!-- /beginning of card-body -->
                  <div class="card-body">
                        @csrf

                        <div class="form-group">
                            <x-jet-label>Term</x-jet-label>
                            <select class="form-control" name="assessement_term">
                            <option value="">Select Term</option>
                            @foreach ($assessement_terms as $term)
                            <option value="{{$term->term_id}}">{{$term->term_name}}-{{$term->academic_session}} </option>
                            @endforeach
                            </select>
                            @error('assessement_term')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label>Assessement Name</x-jet-label>
                            <select class="form-control" name="assessement_name">
                            <option value="">Select Name</option>
                            @foreach ($assessements as $assessement)
                            <option value="{{$assessement->assessement_id}}">{{$assessement->assessement_name}}</option>
                            @endforeach
                            </select>
                            @error('assessement_name')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                      

                        <div class="form-group">
                            <x-jet-label>Assign As</x-jet-label>
                            <select class="form-control" name="assign_as">
                            <option value="">Select Assignment</option>
                            <option value="CA">Continuous Assessement</option>
                            <option value="Examination">Examination</option>
                            </select>
                            @error('assign_as')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                        
      
                  </div>
                  <!-- /end of card-body -->
        
                  <div class="card-footer">
                    <x-jet-button>Assign Assessement</x-jet-button>
                  </div>
                </form>
              </div>
 
          </div>
    
     <div class="col-md-8">
        <div class="card card-light">
            <div class="card-header">
              <h3 class="card-title">List of CA:Exam Assignment</h3>
            </div>
            <!-- /.card-header -->
          
            <!-- /beginning of card-body -->
              <div class="card-body">

              

                 <table class="table table">
                      <thead >
                          <tr>
                           
                             
                              <th>Assessement Name</th>
                              <th>Assigned As</th>
                              <th>Manage</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($ca_exam_assignments as $ca_exam_item)
                          <tr>
                            <td>{{$ca_exam_item->assessement_name}}</td>
                            <td>{{$ca_exam_item->assign_as}}</td>

    <td>
<a href="/assessements/ca_exam/edit/{{$ca_exam_item->assignment_id}}"><i class="fas fa-edit text-primary mr-4 pr-2"> <span>Edit</span> </i></a>
<a href="/assessements/ca_exam/delete/{{$ca_exam_item->assignment_id}}"><i class="fas fa-trash-alt text-danger mr-4 pr-2"><span class="ml-1">Delete</span></i></a>  
    </td>
                        </tr>  
                          @endforeach
                          
                          
                      </tbody>
                  </table>
  
              </div>
              <!-- /end of card-body -->
          </div>

      </div>

      
     </div>
  </div>
<!---End of Assessement Assignment---->

<!---Beginning of Assessement Management ---->
<div class="tab-pane fade" id="pills-assessement-management" role="tabpanel" aria-labelledby="pills-assessement-management-tab">
    <div class="row">
        <div class="col-md-4">

            <div class="card card-light">
                <div class="card-header">
                  <h3 class="card-title">Add Assessement</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('assessement.store') }}" method="post">
                <!-- /beginning of card-body -->
                  <div class="card-body">
                        @csrf


                        <div class="form-group">
                            <x-jet-label>Assessement Type</x-jet-label>
                            <select class="form-control" name="assessement_type">
                            <option value="">Select Assessement Type</option>
                            @foreach ($assessement_types as $assessement_type)
                            <option value="{{$assessement_type->id}}">{{$assessement_type->assessement_type_name}}</option>
                            @endforeach
                            </select>
                            @error('assessement_type')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label>Term</x-jet-label>
                            <select class="form-control" name="assessement_term">
                            <option value="">Select Assessement Type</option>
                            @foreach ($assessement_terms as $term)
                            <option value="{{$term->term_id}}">{{$term->term_name}}-{{$term->academic_session}} </option>
                            @endforeach
                            </select>
                            @error('assessement_term')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label> Assessement Name</x-jet-label>
                            <x-jet-input name="assessement_name" placeholder="Enter Assessement Name" ></x-jet-input>
                            @error('assessement_name')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>

                        
      
                  </div>
                  <!-- /end of card-body -->
        
                  <div class="card-footer">
                    <x-jet-button>Add Assessement</x-jet-button>
                  </div>
                </form>
              </div>
 
          </div>
    
     <div class="col-md-8">
        <div class="card card-light">
            <div class="card-header">
              <h3 class="card-title">List of Assessements</h3>
            </div>
            <!-- /.card-header -->
          
            <!-- /beginning of card-body -->
              <div class="card-body">

              

                 <table class="table table">
                      <thead >
                          <tr>
                           
                              <th>Assessement Term</th>
                              <th>Assessement Name</th>
                           
                              <th>Manage</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($assessements as $assessement)
                          <tr>
                           
                            <td>{{$assessement->term_name}}</td>
                            <td>{{$assessement->assessement_name}}</td>
                           
                            
    <td>
<a href="/assessement/type/edit/{{$assessement->assessement_id}}"><i class="fas fa-edit text-primary mr-4 pr-2"> <span>Edit</span> </i></a>
<a href="/assessements/assessement/delete/{{$assessement->assessement_id}}"><i class="fas fa-trash-alt text-danger mr-4 pr-2"><span class="ml-1">Delete</span></i></a>  
    </td>
                        </tr>  
                          @endforeach
                          
                          
                      </tbody>
                  </table>
  
              </div>
              <!-- /end of card-body -->
          </div>

      </div>

      
     </div>
   </div>
 <!---End of Assessment Management ---->



 <!---Beginning of Pass Rates ---->
<div class="tab-pane fade" id="pills-pass-rates" role="tabpanel" aria-labelledby="pills-pass-rates-tab">
    <div class="row">
        <div class="col-md-4">

            <div class="card card-light">
                <div class="card-header">
                  <h3 class="card-title">Add Passing Rate</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('pass-rates.store') }}" method="post">
                <!-- /beginning of card-body -->
                  <div class="card-body">
                        @csrf

                        <div class="form-group">
                            <x-jet-label>Section</x-jet-label>
                            <select class="form-control" name="section">
                            <option value="">Select Section</option>
                            @foreach ($sections as $section)
                            <option value="{{$section->id}}">{{$section->section_name}}</option>
                            @endforeach
                            </select>
                            @error('section')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label> Number of Subjects</x-jet-label>
                            <input type="text" name="number_of_subjects" class="form-control" aria-label="">
                            @error('number_of_subjects')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>

                            <div class="form-group">
                                <x-jet-label> Passing Rate</x-jet-label>
                                <div class="input-group mb-3">
                                    <input type="text" name="passing_rate" class="form-control" aria-label="">
                                    <div class="input-group-append">
                                      <span class="input-group-text">%</span>
                                    </div>
                                  </div>
                                @error('passing_rate')
                                <span class="text-danger">{{$message}}</span>  
                                @enderror
                                </div>

                                <div class="form-group">
                                    <x-jet-label>Passing Subject Rule</x-jet-label>
                                    <select class="form-control" name="passing_subject_rule">
                                    <option value="">Select Option</option>
                                    <option value="1">Applies</option>
                                    <option value="0">Does Not Apply</option>
                                    </select>
                                    @error('passing_subject_rule')
                                    <span class="text-danger">{{$message}}</span>  
                                    @enderror
                                </div>
                      

                    
                        
      
                  </div>
                  <!-- /end of card-body -->
        
                  <div class="card-footer">
                    <x-jet-button>Add Rates</x-jet-button>
                  </div>
                </form>
              </div>
 
          </div>
    
     <div class="col-md-8">
        <div class="card card-light">
            <div class="card-header">
              <h3 class="card-title">Pass Rates</h3>
            </div>
            <!-- /.card-header -->
          
            <!-- /beginning of card-body -->
              <div class="card-body">

              

                 <table class="table table-hover ">
                      <thead >
                          <tr>
                           
                             
                              <th>Section</th>
                              <th>Passing Rate</th>
                              <th>Number of Subjects</th>
                              <th>Passing Subject Rule</th>
                              <th>Manage</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($pass_rates as $pass_rate)
                          <tr>
                            <td>{{$pass_rate->section_name}}</td>
                            <td>{{$pass_rate->passing_rate}}%</td>
                            <td>{{$pass_rate->number_of_subjects}}</td>
                            <td>
                                @if ($pass_rate->number_of_subjects=0)
                                    {{'Does not apply'}}
                                @else
                                {{'Applies'}}
                                @endif
                               
                            </td>

    <td>
<a href="/assessements/pass-rates/edit/{{$pass_rate->pass_rate_id}}"><i class="fas fa-edit text-primary mr-4 pr-2"> <span>Edit</span> </i></a>
<a href="/assessements/pass-rates/delete/{{$pass_rate->pass_rate_id}}"><i class="fas fa-trash-alt text-danger mr-4 pr-2"><span class="ml-1">Delete</span></i></a>  
    </td>
                        </tr>  
                          @endforeach
                          
                          
                      </tbody>
                  </table>
  
              </div>
              <!-- /end of card-body -->
          </div>

      </div>

      
     </div>
   </div>
 <!---End of Pass Rates---->









  <div class="tab-pane fade" id="pills-weight" role="tabpanel" aria-labelledby="pills-weight-tab">
    <div class="row">
        <div class="col-md-4">

            <div class="card card-light">
                <div class="card-header">
                  <h3 class="card-title">Add Assessement Weight</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('assessement_weight.store') }}" method="post">
                <!-- /beginning of card-body -->
                  <div class="card-body">
                        @csrf

                        <div class="form-group">
                            <x-jet-label>Term</x-jet-label>
                            <select class="form-control" name="assessement_term">
                            <option value="">Select Term</option>
                            @foreach ($assessement_terms as $term)
                            <option value="{{$term->term_id}}">{{$term->term_name}}-{{$term->academic_session}} </option>
                            @endforeach
                            </select>
                            @error('assessement_term')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>

                        <div class="form-group">
                            <x-jet-label> Continuous Assessement Percentage</x-jet-label>
                            <div class="input-group mb-3">
                                <input type="text" name="ca_percentage" class="form-control" aria-label="">
                                <div class="input-group-append">
                                  <span class="input-group-text">%</span>
                                </div>
                              </div>
                            @error('ca_percentage')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                            </div>

                            <div class="form-group">
                                <x-jet-label> Examination Percentage</x-jet-label>
                                <div class="input-group mb-3">
                                    <input type="text" name="exam_percentage" class="form-control" aria-label="">
                                    <div class="input-group-append">
                                      <span class="input-group-text">%</span>
                                    </div>
                                  </div>
                                @error('exam_percentage')
                                <span class="text-danger">{{$message}}</span>  
                                @enderror
                                </div>
                      

                    
                        
      
                  </div>
                  <!-- /end of card-body -->
        
                  <div class="card-footer">
                    <x-jet-button>Add Assessement Weight</x-jet-button>
                  </div>
                </form>
              </div>
 
          </div>
    
     <div class="col-md-8">
        <div class="card card-light">
            <div class="card-header">
              <h3 class="card-title">Assessement Weights</h3>
            </div>
            <!-- /.card-header -->
          
            <!-- /beginning of card-body -->
              <div class="card-body">

              

                 <table class="table table-hover ">
                      <thead >
                          <tr>
                           
                             
                              <th>Term</th>
                              <th>Continuous Assessement</th>
                              <th>Examination</th>
                              <th>Manage</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($assessement_weight as $weight)
                          <tr>
                            <td>{{$weight->term_name}}</td>
                            <td>{{$weight->ca_percentage}}%</td>
                            <td>{{$weight->exam_percentage}}%</td>

    <td>
<a href="/assessements/assessement-weight/edit/{{$weight->assessement_weight_id}}"><i class="fas fa-edit text-primary mr-4 pr-2"> <span>Edit</span> </i></a>
<a href="/assessements/assessement-weight/delete/{{$weight->assessement_weight_id}}"><i class="fas fa-trash-alt text-danger mr-4 pr-2"><span class="ml-1">Delete</span></i></a>  
    </td>
                        </tr>  
                          @endforeach
                          
                          
                      </tbody>
                  </table>
  
              </div>
              <!-- /end of card-body -->
          </div>

      </div>

      
     </div>
  </div>
</div>
          </div>

         
       
      </div>
   

  </div>


      
    </div>   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        

  $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
});

// Acá guarda el index al cual corresponde la tab. Lo podés ver en el dev tool de chrome.
var activeTab = localStorage.getItem('activeTab');

// En la consola te va a mostrar la pestaña donde hiciste el último click y lo
// guarda en "activeTab". Te dejo el console para que lo veas. Y cuando refresques
// el browser, va a quedar activa la última donde hiciste el click.
console.log(activeTab);

if (activeTab) {
   $('a[href="' + activeTab + '"]').tab('show');
}



        </script>
    
</x-app-layout>