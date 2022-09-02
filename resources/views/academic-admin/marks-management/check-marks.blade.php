<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Check Marks</h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.80/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_34_style_light_align_center:Check Marks,w_0.2,y_0.14/v1615202389/Untitled_design_1_oaroft.png" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to check teachers that have or have not added marks<br>
          
            </p>
          
         </div>
        
        </div>
    </div> 
<div class="row">
    
    <div class="col-md-12">

        <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title">Select  Assessement</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          
            <div class="card-body">
              
                <form action="{{route('marks.check_search_form')}}" method="post">
                    <div class="card-body">
                      
                          @csrf
                         
          
                          <div class="form-group">
                          <x-jet-label>Select Assessement</x-jet-label>
                          <select class="form-control" name="assessement_id">
                            <option value="">Select Assessement</option>
                            @foreach($assessements as $assessement)
                                <option value="{{ $assessement->assessement_id }}">
                                {{ $assessement->assessement_name }}
                                </option>
                            @endforeach
                        </select>
                          @error('assessement')
                          <span class="text-danger">{{$message}}</span>  
                          @enderror
                          </div>
          
          
                         
                    </div>
                    <!-- /.card-body -->
          
                    <div class="card-footer">
                      <x-jet-button>Load Results</x-jet-button>
                    </div>
                 
                </div>
              </form>
              
            </div>
    
         
        </div>
    
      </div>

  {{-- <div class="col-md-8">

    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Check Marks</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      
        <div class="card-body">
          
          <table class="table">
            <thead class="bg-light">
              <tr>
                <th>Teacher</th>
                <th>Subject</th>
                <th>Class </th>
                <th>Marks Status</th>
                <th>Manage</th>
              </tr>
            </thead>
            <tbody>
              <tr>
               @foreach ($check as $item)

               @foreach ($item as $data)

               
               <tr>
           
                <td>{{$data->salutation}}. {{$data->name}} {{$data->lastname}} </td>
                <td>{{$data->subject_name}}</td>
                <td>{{$data->grade_name}}</td>
                <td>
                 
                    @if ((($data->total_students)-($data->marks_entered))==0)
                    <i class="fas fa-check-circle text-success"></i> No marks missing
                    @elseif((($data->total_students)-($data->marks_entered))==1)
                    <i class="fas fa-exclamation-triangle text-warning"></i> {{($data->total_students)-($data->marks_entered)}} mark missing
                    @else
                    <i class="fas fa-exclamation-triangle text-danger"></i>  {{($data->total_students)-($data->marks_entered)}} marks missing
                    @endif
                 
                </td>
                
                <td>
                 <a href="/academic-admin/class/view/" class="link"><i class="fas fa-eye"></i> View Student(s)</a>
                
                 </td>
                
             </tr>
                   
               @endforeach
               
              
               
               
               @endforeach
              </tr>
              
            </tbody>
          </table>
        </div>

     
    </div>

  </div> --}}
      
    </div>   
            
     
    
</x-app-layout>