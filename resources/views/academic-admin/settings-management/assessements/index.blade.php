<x-app-layout>
  <x-slot name="header">
 
         
  </x-slot>
  <div class="container-fluid">

    <div id="ajax-alert"></div>
  <div class="card card-light  ">
    <div class="card-header">
      <h3 class="card-title">Manage Assessement</h3>
    </div>

      <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_290,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_24_style_light_align_center:Assessement Settings,w_0.3,y_0.20/v1617532805/campaign-creators-pypeCEaJeZY-unsplash_igbrbr.jpg" alt="">
      <div class="card-body">
        <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
       <div class="text-muted">
          <p class="card-text"> Use this section to manange assesement settings <br>
        
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

      

       <ul class="nav nav-pills mb-5 flex-column flex-sm-row  nav-fill" id="myTab" role="tablist">
<div class="p3">
  
</div>
<li class="nav-item" role="presentation">
  <a class="nav-link active" id="pills-assessement-type-tab" data-toggle="tab" href="#pills-assessement-type" role="tab" aria-controls="pills-assessement-type" aria-selected="true">Assessement Type</a>
</li>

<li class="nav-item" role="presentation">
  <a class="nav-link" id="pills-assessement-management-tab" data-toggle="tab" href="#pills-assessement-management" role="tab" aria-controls="pills-assessement-management" aria-selected="false">Assessements Management</a>
</li>

<li class="nav-item" role="presentation">
  <a class="nav-link" id="pills-ca-exam-assignment-tab" data-toggle="tab" href="#pills-ca-exam-assignment" role="tab" aria-controls="pills-ca-exam-assignment" aria-selected="false">Assessement Categorization</a>
</li>

<li class="nav-item" role="presentation">
  <a class="nav-link" id="pills-weight-tab" data-toggle="tab" href="#pills-weight" role="tab" aria-controls="pills-weight" aria-selected="false">Assessement Weight</a>
</li>


<li class="nav-item" role="presentation">
  <a class="nav-link" id="pills-pass-rates-tab" data-toggle="tab" href="#pills-pass-rates" role="tab" aria-controls="pills-pass-rates" aria-selected="false"> Criteria</a>
</li>



</ul>
<div class="tab-content" id="pills-tabContent">

<!---Beginning of Assessement Types---->
<div class="tab-pane fade show active" id="pills-assessement-type" role="tabpanel" aria-labelledby="pills-assessement-type-tab">
  <div class="py-1">
    <h4 class="text-bold text-muted">Guidelines for Assessement Type Section</h4> 
    This section is where you create an assessement type. There are different types of assessments, i.e Tests, Examinations, Classwork etc.
 
  </div>
  <hr>

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
              <table class="table table-hover table-bordered">
                <thead class="thead-light">
                        <tr>
                            <th>Assessement Type</th>
                            <th>Manage Assessements</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assessement_types as $assessement_type)
                        <tr>
                          <td>{{$assessement_type->assessement_type_name}}</td>


                          <td class="py-0 align-middle">
                            <div class="btn-group btn-group-md">
                              <a href="/assessement/type/edit/{{encrypt($assessement_type->id)}}" class="btn btn-info"><i class="fas fa-eye mr-1"></i>Change</a>
                              <a href="/assessement/type/delete/{{encrypt($assessement_type->id)}}" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Delete</a>
                            </div>


                          </td>
{{-- <a href="/assessement/type/edit/{{encrypt($assessement_type->id)}}"><i class="fas fa-edit text-primary mr-4 pr-2"> <span>Change</span> </i></a>
<a href="/assessement/type/delete/{{encrypt($assessement_type->id)}}"><i class="fas fa-trash-alt text-danger mr-4 pr-2"><span class="ml-1">Delete</span></i></a>  
                             </td> --}}
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
<!---End  of Assessement Types---->


<!---Beginning of Assessement Assignment---->

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="assessement_categorization_delete_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Delete Assessement Categorization?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
      Are you sure you want to delete Assessement Categorization?
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-danger" id="delete_categorization">Yes Delete</button>
    </div>
  </div>
</div>
</div>


<div class="tab-pane fade" id="pills-ca-exam-assignment" role="tabpanel" aria-labelledby="pills-ca-exam-assignment-tab">
  <div class="py-1">
    <h4 class="text-bold text-muted">Guidelines for Assessement Categorization Section</h4> 
    This section is where you categorize or group assessments into either Continuous Assessement (CA) or Examination <span class="text-bold">for a specific term.</span> <br>
    To group an assessement into a category, You select a term and after selecting the term,  you then select the assessement, after selecting the assessement you then select the category you want to place that  assessement under, then click on Assign Categorization. <br>
    
    The categorization will help Shunifu know which assessements are to be considered CA and which ones are to be considered Exam. 
   
  </div>
  <hr>
  <div class="row">
      <div class="col-md-4">

          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Assessement Categorization</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('CA_Exam.store') }}" method="post">
              <!-- /beginning of card-body -->
                <div class="card-body">
                      @csrf
                      <div class="form-group">
                        <x-jet-label>Section</x-jet-label>
                        <select class="form-control" name="section">
                        <option value="">Select Section</option>
                        <option value="internal">Internal Classes</option>
                        <option value="external">External Classes</option>
                        </select>
                        @error('assessement_name')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                    </div>

                      <div class="form-group">
                          <x-jet-label>Assessement Term</x-jet-label>
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
            <h3 class="card-title">List of CA-Exam Assignment</h3>
          </div>
          <!-- /.card-header -->
        
          <!-- /beginning of card-body -->
            <div class="card-body">

              @foreach ($ca_exam_assignments_ as $ca_exam_term => $ca_exam_item)
               @foreach (\App\Models\Term::where('id', $ca_exam_term)->get() as $term)
               <h4>{{$term->term_name }}</h4>
               <small>{{$term->term_name}} continuous assessement & examination categorization.</small>
                @endforeach
         
             <table class="table table-bordered table-hover " >
               <thead class="thead-light">
                 <tr>
                   <th>Assessement</th>
                   <th>Assessement Categorization</th>
                   <th>Manage</th>
                 </tr>
               </thead>
               <tbody>
               @foreach($ca_exam_item as $ca_exam_data)
                 <tr>
                   <td>{{$ca_exam_data->assessement_name}}</td>
                   <td>{{$ca_exam_data->assign_as}}</td>
               

                      <td class="py-0 align-middle">
                        <div class="btn-group btn-group-md">
                          <a href="/assessements/ca_exam/edit/{{encrypt($ca_exam_data->assignment_id)}}" class="btn btn-info"><i class="fas fa-edit mr-1"></i>Edit</a>
                          <a href="/assessements/ca_exam/delete/{{encrypt($ca_exam_data->assignment_id)}}" class="btn btn-danger exam_assignment_delete"><i class="fas fa-trash mr-1"></i>Delete</a>
                        </div>


                      </td>

                      
                 </tr>
               @endforeach
               </tbody>
             </table>
    <hr>   
           
           
           @endforeach

               {{-- <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                         
                           
                            <th>Test</th>
                            <th>Assigned As</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ca_exam_assignments as $ca_exam_item)
                        <tr>
                          <td>{{$ca_exam_item->assessement_name}}</td>
                          <td>{{$ca_exam_item->assessement_name}} is part of  {{$ca_exam_item->assign_as}} in {{$ca_exam_item->term_name}}</td>

  <td>
<a href="/assessements/ca_exam/edit/{{$ca_exam_item->assignment_id}}"><i class="fas fa-edit text-primary mr-4 pr-2"> <span>Edit</span> </i></a>
<a href="/assessements/ca_exam/delete/{{$ca_exam_item->assignment_id}}"><i class="fas fa-trash-alt text-danger mr-4 pr-2"><span class="ml-1">Delete</span></i></a>  
  </td>
                      </tr>  
                        @endforeach
                        
                        
                    </tbody>
                </table> --}}

            </div>
            <!-- /end of card-body -->
        </div>

    </div>

    
   </div>
</div>
<!---End of Assessement Assignment---->

<!---Beginning of Assessement Management ---->
<div class="tab-pane fade" id="pills-assessement-management" role="tabpanel" aria-labelledby="pills-assessement-management-tab">

<div class="py-1">
  <h4 class="text-bold text-muted">Guidelines for the Assessement Management Section</h4> 
  This section is where you create an assessement that will be written in a specific term. For example you can create an assessement called <em>Test 1</em> and assign it to Term 1 etc.;
  <ol>
    <li>Select the assessement type</li>
    <li>Select the term you want to attach the assessement to</li>
    <li>Enter the name for the assessement </li>
    <li>Enter the month the assessement will be written in </li>
    <li>Enter the deadline for the entering of the marks of the assessement in the system </li>
  </ol>
</div>
<hr>
  <div class="row">
    
      <div class="col-md-4">


   
   <!-- Modal -->
   <div class="modal fade" id="delete_assessement_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title">Delete Assessement</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <div class="modal-body">
           <input type="hidden"  name="delete_entry_val" id="delete_entry_val">
           <div class="verification">
            Are you sure you want to delete this assessement?
           </div>

           <div class="response"></div>
         
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
           <button type="button" class="btn btn-danger yes_delete_assessement">Yes Delete Assessement</button>
         </div>
       </div>
     </div>
   </div>


        
        <!-- Modal -->
        <div class="modal fade" id="edit_assessement_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Assessement</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">

                <ul id="updateForm_errList"></ul>
                <ul id="updateForm_successList"></ul>

                <input type="hidden"  id="edit_assessement_id">
                          <div class="form-group">
                              <x-jet-label>Assessement Type</x-jet-label>
                              <select class="form-control" name="edit_assessement_type" id="edit_assessement_type">
                              <option value="">Select Assessement Type</option>
                              @foreach ($assessement_types as $assessement_type)
                              <option value="{{$assessement_type->id}}">{{$assessement_type->assessement_type_name}}</option>
                              @endforeach
                              </select>
                              @error('edit_assessement_type')
                              <span class="text-danger">{{$message}}</span>  
                              @enderror
                          </div>
  
                          <div class="form-group">
                              <x-jet-label>Assessment Term</x-jet-label>
                              <select class="form-control" name="edit_assessement_term" id="edit_assessement_term">
                              <option value="">Select Assessement Term</option>
                              @foreach ($assessement_terms as $term)
                              <option value="{{$term->term_id}}">{{$term->term_name}}-{{$term->academic_session}} </option>
                              @endforeach
                              </select>
                              @error('edit_assessement_term')
                              <span class="text-danger">{{$message}}</span>  
                              @enderror
                          </div>
  
                          <div class="form-group">
                            <x-jet-label>Assessement Month</x-jet-label>
                            <input type="month" class="form-control" name="edit_assessement_month" id="edit_assessement_month" />
                            @error('edit_assessement_month')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>
  
                          <div class="form-group">
                              <x-jet-label> Assessement Name</x-jet-label>
                              <x-jet-input name="edit_assessement_name"  id="edit_assessement_name" placeholder="Enter Assessement Name" ></x-jet-input>
                              @error('edit_assessement_name')
                              <span class="text-danger">{{$message}}</span>  
                              @enderror
                          </div>
  
                          <div class="form-group">
                            <x-jet-label> Marks Deadline</x-jet-label>
                            <x-jet-input name="edit_marks_deadline" id="edit_marks_deadline" type="datetime-local" ></x-jet-input>
                            @error('edit_marks_deadline')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>
  
                  </form>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update_assessement">Save</button>
              </div>
            </div>
          </div>
        </div>

          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Create Assessement</h3>
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
                          <x-jet-label>Assessment Term</x-jet-label>
                          <select class="form-control" name="assessement_term">
                          <option value="">Select Assessement Term</option>
                          @foreach ($assessement_terms as $term)
                          <option value="{{$term->term_id}}">{{$term->term_name}}-{{$term->academic_session}} </option>
                          @endforeach
                          </select>
                          @error('assessement_term')
                          <span class="text-danger">{{$message}}</span>  
                          @enderror
                      </div>

                      <div class="form-group">
                        <x-jet-label>Assessement Month</x-jet-label>
                        <input type="month" class="form-control" name="assessement_month"/>
                        @error('assessement_month')
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

                      <div class="form-group">
                        <x-jet-label> Marks Deadline</x-jet-label>
                        <x-jet-input name="marks_deadline" type="datetime-local" ></x-jet-input>
                        @error('deadline')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                    </div>

                      
    
                </div>
                <!-- /end of card-body -->
      
                <div class="card-footer">
                  <x-jet-button>Create Assessement</x-jet-button>
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

              @foreach ($assessements_ as $term_assessement => $data)
              @foreach (\App\Models\Term::where('id', $term_assessement)->get() as $term_a)
              <h4>{{$term_a->term_name }}</h4>
              <small>The following assessements will be written in {{$term_a->term_name}}  </small>
               @endforeach
{{-- 
             <h4>{{$term}}</h4>
              <small>The following assessements will be written in {{$term}}</small> --}}
            <table class="table table-bordered table-hover table-responsive table-compact" >
              <thead class="thead-light">
                <tr>
                  <th>Assessement Name</th>
                  <th> Assessement Month</th>
                  <th>Marks Deadline</th>
                
                  <th>Manage</th>
                </tr>
              </thead>
              <tbody>
              @foreach($data as $assessements)
                <tr>
                  <td>{{$assessements->assessement_name}}</td>
                  <td>
                    @if (is_null($assessements->assessement_month))
                        Not set
                        @else
                        {{ \Carbon\Carbon::parse($assessements->assessement_month)->format('F Y') }}
                    @endif
                   
                  </td>
                  <td> 
                     @if (is_null($assessements->marks_deadline))
                    Not set
                    @else
                    {{ \Carbon\Carbon::parse($assessements->marks_deadline)->diffForHumans() }}
                @endif
              </td>
                 

                <td class="py-0 align-middle">
                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-info create_assessement_edit" value="{{$assessements->assessement_id}}"><i class="fas fa-edit"></i>Change</button>
                    <button class="btn btn-danger create_assessement_delete" value="{{$assessements->assessement_id}}"><i class="fas fa-trash"></i>Delete</button>
                  </div>
                </td>
                </tr>
              @endforeach
              </tbody>
            </table>
<hr>   
          
          
          @endforeach




              

               {{-- <table class="table table-bordered  table-hover">
                    <thead class="thead-light" >
                        <tr>
                            <th>Assessement Term</th>
                            <th>Assigned Assessement </th>
                         
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assessements as $assessement)
                        <tr>
                         
                          <td>{{$assessement->term_name}}-{{$assessement->academic_session}}</td>
                          <td>{{$assessement->assessement_name}}</td>
                         
                          
  <td>
    <div class="row">
      <div class="col">
        <a href="/assessement/type/edit/{{$assessement->assessement_id}}"><i class="fas fa-edit text-primary py-2"> <span>Edit</span> </i></a>
      </div>
      <div class="col">
        <a href="/assessements/assessement/delete/{{$assessement->assessement_id}}"><i class="fas fa-trash-alt text-danger py-2"> <span>Delete</span></i></a>  
      </div>
    </div>
  </td>
                      </tr>  
                        @endforeach    
                    </tbody>
                </table> --}}

            </div>
            <!-- /end of card-body -->
        </div>

    </div>

    
   </div>
 </div>
<!---End of Assessment Management ---->



<!---Beginning of Pass Rates ---->
<div class="tab-pane fade" id="pills-pass-rates" role="tabpanel" aria-labelledby="pills-pass-rates-tab">
  <h4 class="text-bold text-muted">Guidelines for the Criteria Section</h4> 
<p>This is the section where you tell Shunifu the criteria to use when calculating student marks.  Shunifu will use the criteria you set here to generate student report cards, as well as scoresheets.
  <br>
  In the event you want to modify a criteria for a specfic section (e.g Junior) , click on the <span class="text-bold">Change</span> button on row of that section, and to delete a criteria for a specfic section click on the red delete button.

  <h6>Keywords Explaination</h6>
  <ul>
    <li><span class="text-bold">Class</span>-
      A class is grouping of students in a single classroom. For example Form 1A is a class 
    </li>

    <li>
      <span class="text-bold">Stream</span>-
      A stream is a group of classes. For example Form 1 is a stream, it is made of different classes like Form 1A, Form 1B and Form 1C
    </li>

  
  </ul>
 
  {{-- <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
    <i class="fa fa-info" title="Do you like my fa-coq icon?"></i>
  </button> --}}
</p>
<hr>
  <div class="row">
  
      <div class="col-xs-12 col-sm-12 col-md-5">

          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title text-bold">Set Criteria</h3>
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
                          <small id="subjectHelp" class="form-text text-muted">The minimum number of subjects a student is supposed to pass in the above selected section.  </small>
                          <input type="text" name="number_of_subjects" class="form-control" aria-label="">
                          @error('number_of_subjects')
                          <span class="text-danger">{{$message}}</span>  
                          @enderror
                          </div>

                          <div class="form-group">
                              <x-jet-label> Passing Rate</x-jet-label>
                              <small id="PassHelp" class="form-text text-muted">The passing rate of the above selected section </small>
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
                                  <x-jet-label>Passing Subject Rule</x-jet-label><br>
                                  <small id="subjectHelp" class="form-text text-muted">Does the passing subject rule apply?  </small>
                                  <select class="form-control" name="passing_subject_rule">
                                  <option value="">Select Option</option>
                                  <option value="1">Yes, passing subject rule APPLIES</option>
                                  <option value="0"> No, passing subject rule DOES NOT apply</option>
                                  </select>
                                  @error('passing_subject_rule')
                                  <span class="text-danger">{{$message}}</span>  
                                  @enderror
                              </div>

                              <div class="form-group">
                                <x-jet-label>Subject Average Calculation</x-jet-label>
                              
                                <select class="form-control" name="subject_average_calculation">
                                <option value="">Select Option</option>
                                <option value="custom">Based on term assessement assignment</option>
                               
                                </select>
                                @error('subject_average_calculation')
                                <span class="text-danger">{{$message}}</span>  
                                @enderror
                            </div>
                    
                              <div class="form-group">
                                <x-jet-label>Term Average Calculation </x-jet-label>
                                <small id="subjectHelp" class="form-text text-muted">How is a student term average calculated? 
                                 </small>
                                <select class="form-control" name="average_calculation">
                                <option value="">Select Option</option>
                                <option value="custom">An average of the best number of subjects</option>
                                <option value="default">An average of all subjects</option>
                                </select>
                                @error('average_calculation')
                                <span class="text-danger">{{$message}}</span>  
                                @enderror
                            </div>

                            <div class="form-group">
                              <x-jet-label>Term Average Type</x-jet-label>
                              <small id="subjectHelp" class="form-text text-muted">The data type of the term average should be? </small>
                              <select class="form-control" name="term_average_type" id="term_average_type">
                              <option value="">Select Option</option>
                              <option value="decimal">A decimal number</option>
                              <option value="whole"> A whole number</option>
                              </select>
                              @error('term_average_type')
                              <span class="text-danger">{{$message}}</span>  
                              @enderror
                          </div> 
                          
                          <div class="form-group" id="decimal_places">
                            <x-jet-label>Number of Decimal Places</x-jet-label>
                            <input type="number" class="form-control" id="number_of_decimal_places" name="number_of_decimal_places">
                            @error('number_of_decimal_places')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>
                        
                        
                    

                            <div class="form-group">
                              <x-jet-label> Ties </x-jet-label>
                              <small id="subjectHelp" class="form-text text-muted">How are ties positioned?  </small>
                              <select class="form-control" name="tie_type">
                               
                              <option value="">Select Option</option>
                         
                              <option value="share_n_+_1">Share same position but skip</option>
                              </select>
                              @error('tie_type')
                              <span class="text-danger">{{$message}}</span>  
                              @enderror
                          </div>




                            <div class="form-group">
                              <x-jet-label>Term Position Type </x-jet-label>
                              <small id="typeHelp" class="form-text text-muted">How are students positioned? According to Class or Stream? </small>
                              <select class="form-control" name="position_type">

                              <option value="">Select Option</option>
                              <option value="stream_based">According to Stream </option>
                              <option value="class_based">According to Class </option>
                              </select>
                              @error('position_type')
                              <span class="text-danger">{{$message}}</span>  
                              @enderror
                          </div>

                          <div class="form-group">
                            <x-jet-label>Subject Position Type </x-jet-label>
                            <small id="typeHelp" class="form-text text-muted">How are students positioned in a subject? According to Class or Stream or teachers teaching load? </small>
                            <select class="form-control" name="subject_position_type">
                            <option value="">Select Option</option>
                            <option value="stream_based">Stream Based</option>
                            <option value="class_based">Class Based</option>
                            <option value="teacher_based">Teacher Based</option>
                            </select>
                            @error('subject_position_type')
                            <span class="text-danger">{{$message}}</span>  
                            @enderror
                        </div>
                           
                  
                      
    
                </div>
                <!-- /end of card-body -->
      
                <div class="card-footer">
                  <x-jet-button>Add  Criteria</x-jet-button>
                </div>
              </form>
            </div>

        </div>
      
   <div class="col-sm-12 col-xs-12 col-md-7 ">
      <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title text-bold">Criteria List</h3>
          </div>
          <!-- /.card-header -->
        
          <!-- /beginning of card-body -->
            <div class="card-body">

           
<div class="table-responsive">


               <table class="table table-hover table-bordered table-compact">
                    <thead class="thead-light" >
                        <tr>
                            <th>Section</th>
                            {{-- <th>Pass Rate</th>
                            <th>Subjects</th>
                            <th>Passing Subject Rule</th>
                            <th>Term Average Calculation</th>
                            <th>Subject Average Calculation</th>
                            <th>Position Type</th> --}}
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pass_rates as $pass_rate)
                        <tr>
                          <td>{{$pass_rate->section_name}}</td>
                          {{-- <td>{{$pass_rate->passing_rate}}%</td>
                          <td>{{$pass_rate->number_of_subjects}}</td> --}}
                          {{-- <td>
                              @if ($pass_rate->passing_subject_rule==0)
                                  {{'Does not apply'}}
                              @else
                              {{'Applies'}}
                              @endif
                             
                          </td> --}}
                          {{-- <td>{{$pass_rate->average_calculation}}</td>
                          <td>{{$pass_rate->subject_average_calculation}}</td>
                          <td>{{$pass_rate->position_type}}</td> --}}
  {{-- <td>
    <div class="row">
      <div class="col">
        <a href="/assessements/pass-rates/edit/{{$pass_rate->pass_rate_id}}"><i class="fas fa-edit text-primary"> <span>Edit</span> </i></a>
        <span class="mr-4 py-2"></span>
      </div>

      <div class="col">
        <a href="/assessements/pass-rates/delete/{{$pass_rate->pass_rate_id}}"><i class="fas fa-trash-alt text-danger "><span class="ml-1 py-2">Delete</span></i></a>  
      </div>
    </div>

  </td> --}}
  <td class="py-2 align-middle">
    <div class="btn-group btn-group-sm">
      <a href="/assessements/pass-rates/edit/{{$pass_rate->pass_rate_id}}" class="btn btn-success"><i class="fas fa-eye"></i>View</a>
      <a href="/assessements/pass-rates/edit/{{$pass_rate->pass_rate_id}}" class="btn btn-info"><i class="fas fa-edit"></i>Change</a>
      <a href="/assessements/pass-rates/delete/{{$pass_rate->pass_rate_id}}" class="btn btn-danger"><i class="fas fa-trash"></i>Delete</a>
    </div>
  </td>
                      </tr>  
                        @endforeach
                        
                        
                    </tbody>
                </table>
</div>

            </div>
            <!-- /end of card-body -->
        </div>

    </div>

    
   </div>
 </div>
<!---End of Pass Rates---->









<div class="tab-pane fade" id="pills-weight" role="tabpanel" aria-labelledby="pills-weight-tab">
  <div class="py-1">
    <h4 class="text-bold text-muted">Guidelines for the Assessement Weight Section</h4> 
    This section is where you add CA or Exam weights. This is where you tell Shunifu how much the Continuous Assessement or Examination will weight. For an example you can tell Shunifu that in Term 2 , Form 1 the  Continuous Assesement will weight 40% and Examination will weight 60%. <br>
    Please make sure that the both weights when added together equal <span class="text-bold">100%</span>
<p><br>
  <span class="text-bold text-muted">Steps to adding weights.</span>
    <ol>
      <li>Select the stream</li>
      <li>Select the term you want</li>
      <li>Enter the CA weight </li>
      <li>Enter the Exam weight </li>
      <li>Click on Add Assessement-Weight button</li>
    </ol>
  </div>
  <hr>
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
                        <x-jet-label>Stream</x-jet-label>
                        <select class="form-control" name="stream" id="stream">
                        <option value="">Select Stream</option>
                       
                        @foreach ($streams as $stream)
                        <option value="{{$stream->id}}">{{$stream->stream_name}} </option>
                        @endforeach
                        </select>
                        @error('stream')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                    </div>

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
                    

                              {{-- <div class="form-group">
                                <x-jet-label> Settings Apply To:</x-jet-label>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="settings_application" id="settings_application" value="all_classes" >
                                  All Streams
                                </label>
                                <br>
                                <input type="radio" class="form-check-input" name="settings_application" id="settings_application" value="external_only" >
                                  External Classes Only
                                <br>
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="settings_application" id="settings_application" value="internal_only" >
                                    Internal Classes Only
                                  </label>

                              </div>

                                @error('exam_percentage')
                                <span class="text-danger">{{$message}}</span>  
                                @enderror
                                </div>          --}}
                  
                      
    
                </div>
                <!-- /end of card-body -->
      
                <div class="card-footer">
                  <x-jet-button>Add Assessement Weight</x-jet-button>
                </div>
              </form>
            </div>

        </div>
  
   <div class="col">
     
      <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title">Assessement Weights</h3>
          </div>
          <!-- /.card-header -->
        
          <!-- /beginning of card-body -->
          
                    <!-- /beginning of card-body -->
                    <div class="card-body">
  
                      @foreach ($assessement_weight_ as $term_assessement_weight => $data)
                      @foreach (\App\Models\Term::where('id', $term_assessement_weight)->get() as $term_a_weight)
                      <h4>{{$term_a_weight->term_name }}</h4>
                      {{-- <small>The following assessement weights apply in the following term {{$term_a_weight->term_name}}  </small> --}}
                       @endforeach
        {{-- 
                     <h4>{{$term}}</h4>
                      <small>The following assessements will be written in {{$term}}</small> --}}
                    <table class="table table-bordered table-hover table-responsive table-compact" >
                      <thead class="thead-light" >
                        <tr>
    
                            <th>Stream</th>
                            <th>Continuous Assessement</th>
                            <th>Examination</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                      <tbody>
                      @foreach($data as $assessements_weight)
                        <tr>
                          <td>{{$assessements_weight->stream_name}}</td>
                          <td>{{$assessements_weight->ca_percentage}}%</td>
                          <td>{{$assessements_weight->exam_percentage}}%</td>
                        
                        <td class="py-0 align-middle">
                          <div class="btn-group btn-group-sm">
            <a href="/assessements/assessement-weight/edit/{{$assessements_weight->assessement_weight_id}}"><button class="btn btn-info assessement_weight_edit" value=""><i class="fas fa-edit"></i>Change</button></a>
                           <a href="/assessements/assessement-weight/delete/{{$assessements_weight->assessement_weight_id}}"> <button class="btn btn-danger assessement_weight_delete" value="{{$assessements_weight->assessement_weight_id}}"><i class="fas fa-trash"></i>Delete</button></a>
                          </div>
                        </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
        <hr>   
                  
                  
                  @endforeach
        
        
        
        
        
                    </div>
            <!-- /end of card-body -->
        </div>

    </div>

    
   </div>
</div>

<!---End of Assessment Weights---->


</div>
        </div>

       
     
    </div>
 

</div>


    
  </div>   
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
  </script> 

    <script>

$(document).ready(function() {

  $('[data-toggle="tooltip"]').tooltip({
        placement : 'top'
    });

     
$.ajaxSetup({
 headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 }
});
$('#decimal_places').hide();
  if (location.hash) {
      $("a[href='" + location.hash + "']").tab("show");
  }
  $(document.body).on("click", "a[data-toggle='tab']", function(event) {
      location.hash = this.getAttribute("href");
  });
});
$(window).on("popstate", function() {
  var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
  $("a[href='" + anchor + "']").tab("show");
});


$("#term_average_type").change(function (e) { 
e.preventDefault();

var item=$(this).val();

if (item=="decimal") {

  //Show list of subjects
  $('#decimal_places').show();
   
}else{
$('#number_of_decimal_places').val(" ");
  $('#decimal_places').hide();
}

});




            $(document).on("click",'.create_assessement_edit', function (e) {
              e.preventDefault();

              var assessement_id=$(this).val();
              $("#edit_assessement_modal").modal('show');
            

              $.ajax({
                type: "GET",
                url: "/assessements/assessement/edit/"+assessement_id,
                dataType: "json",
              }).done(function(data) {

                console.log(data);

                if (data.status==404) {
                  $("#success_message").html("");
                  $("#success_message").addClass('alert alert-danger');
                  $("#success_message").text(data.message);
                  
                }else{
             
                  $("#edit_assessement_name").val(data.assessement.assessement_name);
                  $("#edit_assessement_month").val(data.assessement.assessement_month);
                  $("#edit_marks_deadline").val(data.assessement.marks_deadline);
                  $("#edit_assessement_type").val(data.assessement.assessement_type);
                  $("#edit_assessement_term").val(data.assessement.term_id);
                  $("#edit_assessement_id").val(data.assessement.id);
                }
                  
                }).fail(function(data) {
                  
              });

              // alert(assessement_id);

           
            
              
              
            });



            $(document).on("click",'.create_assessement_delete', function (e) {
              e.preventDefault();

              var id=$(this).val();
              $('#delete_entry_val').val(id);
              
              $("#delete_assessement_modal").modal('show');
              
            });

            
            $(".yes_delete_assessement").click(function (e) { 
                e.preventDefault();

                var id= $('#delete_entry_val').val();
              
                $.ajax({
                  type: "DELETE",
                  url: "/assessements/assessement/delete/"+id,
                  data: id,
                  dataType: "json",
                }).done(function(data) {

                  if (data.status==400) {
                    $(".response").html(data.errors);
                  } else {
                    $(".response").html(data.message);
                    
                  }

              
                  $(".verification").hide();
                  $(".yes_delete_assessement").hide();

                //  $("#delete_assessement_modal").modal('hide');
                    
                  }).fail(function(data) {
                    
                });

                
                
              });

              $("#close").click(function (e) { 
            e.preventDefault();
            location.reload();   
            
        });


            $(document).on("click",'.update_assessement', function (e) {
              e.preventDefault();

                  // $("#edit_assessement_name").val(data.assessement.assessement_name);
                  // $("#edit_assessement_month").val(data.assessement.assessement_month);
                  // $("#edit_marks_deadline").val(data.assessement.marks_deadline);
                  // $("#edit_assessement_type").val(data.assessement.assessement_type);
                  // $("#edit_assessement_term").val(data.assessement.term_id);
                  // $("#edit_assessement_id").val(data.assessement.id);



              var assessement_id=$('#edit_assessement_id');
              var data={
                'edit_assessement_month': $("#edit_assessement_month").val(),
                'edit_marks_deadline': $("#edit_marks_deadline").val(),
                'edit_assessement_type': $("#edit_assessement_type").val(),
                'term_id': $("#edit_assessement_term").val(),
                'edit_assessement_name': $("#edit_assessement_name").val(),
                'assessement_id': $("#edit_assessement_id").val(),


              }

            

              $.ajax({
                type: "GET",
                url: "/assessements/assessement/update/"+assessement_id,
                data: data,
                dataType: "json",
              }).done(function(data) {


                if(data.status==400){
                  //errors
                  $('#updateForm_errList').html("");
                  $('#updateForm_errList').addClass("alert alert-danger");
                  $.each(data.errors, function (key, value) { 
                    $('#updateForm_errList').append("<li>"+value+"</li>");
                  });

                }else if(data.status==404){
                  $('#updateForm_errList').html("");
                  $('#updateForm_errList').addClass("alert alert-danger");
                  $.each(data.message, function (key, value) { 
                    $('#updateForm_errList').append("<li>"+value+"</li>");
                  });

                }else  {

                  $('#updateForm_errList').html("");
                  $('#updateForm_successList').addClass("alert alert-success");
                  $.each(data, function (key, value) { 
                    $('#updateForm_successList').append("<li>"+value+"</li>");
                  });

                  $("#edit_assessement_modal").modal('hide');
                 
              

                window.location.reload();
                alert("Updated");
                  
                }
                  
                }).fail(function(data) {
                  
              });


            });



            //Assessement Categorization

           

            // $(document).on("click",'.exam_assignment_delete', function (e) {
            //   e.preventDefault();
          
            //   $("#assessement_categorization_delete_modal").modal('show');
              
            // });

            //End of Assessement Categorization



          //Assessement Weights


            //Delete Confirmation Modal
          // $(document).on("click",'#delete_categorization', function (e) {
          //     e.preventDefault();
          
             


            
              
              
          //   });





          //End of Assessement Weights







           




    </script>
</x-app-layout>