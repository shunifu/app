<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Manage Terms</h3>
      </div>
  
<img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.60/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_35_style_light_align_center:Academic Calendar,w_0.2,y_0.28/v1615231896/Untitled_design_7_bahmem.png" alt="">
    <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->salutation}} {{Auth::user()->lastname}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to manage the school's terms. If a term is a final term, please check the final checkbox which is towards the end of the form. <br>
          
              To go back click <a href="/academic-admin/session"><span class="text-bold ">here</span></a>
            </p>
          
         </div>
        
        </div>
    </div> 
  <div class="row">
    
  <div class="col-md-3">
  
    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">Add  <strong>{{$academic_session->academic_session}} </strong> Term</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('term.store')}}" method="post">
          <div class="card-body">
            
            @csrf

            <div class="form-group">
              <x-jet-label>Academic Year</x-jet-label>
              <select name="academic_session" id="academic_session" class="form-control">
                <option value="{{$academic_session->id}}">{{$academic_session->academic_session}}</option>
              </select>
              @error('academic_session')
              <span class="text-danger">{{$message}}</span>  
              @enderror
             
          </div>
            <div class="form-group">
              <x-jet-label>Term Name</x-jet-label>
              <x-jet-input name="term_name"  type="text" placeholder="Term Name" ></x-jet-input>
              @error('term_name')
              <span class="text-danger">{{$message}}</span>  
              @enderror
             
          </div>

          <div class="form-group">
            <x-jet-label>Opening Date</x-jet-label>
            <x-jet-input name="start_date" id="start_date"  type="date"  ></x-jet-input>
            @error('start_date')
            <span class="text-danger">{{$message}}</span>  
            @enderror
           
        </div>

      <div class="form-group">
          <x-jet-label>Closing Date</x-jet-label>
          <x-jet-input name="end_date" id="end_date"  type="date"  ></x-jet-input>
          @error('end_date')
          <span class="text-danger">{{$message}}</span>  
          @enderror
         
      </div>

    

    <div class="form-group">
      <x-jet-label>Border Return Date</x-jet-label>
      <x-jet-input name="borders_return_date" id="end_date"  type="date"  ></x-jet-input>
      @error('end_date')
      <span class="text-danger">{{$message}}</span>  
      @enderror
     
  </div>

      <div class="form-group">
      
        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="final_term" id="final_term" value="1" >
            Make Final Term of <span class="text-bold">{{$academic_session->academic_session}}</span>
          </label>
        </div>
        @error('final_term')
        <span class="text-danger">{{$message}}</span>  
        @enderror
       
    </div>

  
               
          </div>
          <!-- /.card-body -->
  
          <div class="card-footer">
            <x-jet-button>Add Term </x-jet-button>
          </div>
       
      </div>
    </form>
  
  </div>
 
  <div class="col-md-9">
  

   
  
    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Manage <strong>{{$academic_session->academic_session}} </strong>Terms</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      
        <div class="card-body">
        
          <table class="table  table-responsive-sm  table-responsive-xs table-bordered table-hover">
            <thead class="thead-light">
              <tr>
              
                <th>Term Name</th>
                <th>Opening Date</th>
                <th>Closing Date</th>
              
                <th>Borders Return</th>
                <th>Type</th>
                <th>Manage Term</th>

              </tr>
            </thead>
            <tbody>
              
               @foreach ($terms as $term)
               <tr>
                   <td>{{$term->term_name}}</td>
                   <td>{{date("j F Y", strtotime($term->start_date))}} </td>
                   <td>{{date("j F Y", strtotime($term->end_date))}} </td>
                  
                  <td>
                    <?php 
                    if(is_null($term->borders_return_date)){
                    echo 'not applicable';
                  }else{
                    echo date("j F Y", strtotime($term->borders_return_date));
                  }
                  ?>
                  </td>
                  <td>
                     @if ($term->final_term==1)
                         <button class="btn btn-success btn-small">Final Term</button>
                         @else
                         <button class="btn btn-light btn-small">Normal Term</button>
                     @endif
                  </td>
                   

                  <td class="text-left py-0 align-middle">


                  

                    {{-- <div class="btn-group btn-group-sm ">
                    <form action="/terms/edit/" method="POST">
                        @csrf
                        @method('post')
                        <input type="hidden" name="id" value="{{$term->term_id}}" /> 
                  
                        <button type="submit" class="btn btn-primary ">Edit</button>
                    </form>

                      <form action="terms/delete/" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{$term->term_id}}" />
                  
                        <button type="submit" class="btn  btn-danger">Delete</button>
                    </form>

                  </div> --}}
                <td>


                 
               
               @endforeach
              </tr>
              
            </tbody>
          </table>
        </div>
  
     
    </div>
  
  </div>
      
    </div>   
  
  
     
    
  </x-app-layout>