<x-app-layout>
    <x-slot name="header">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      
    </x-slot>
    <div class="row">
      
        <div class="col-md-12 mt-4">

          <div class="card bg-white">
           
          
            <div class="card-body">
        
        <p>Hi {{Auth::user()->name}}, to view your childs report card, please select your child from the drop down below, and select the term whose report card you want to view. Siyabonga! </p>
              <p class="card-text">




                @foreach ($children as $child)
                {{-- <div class="col-md-4 mt-4">
                    <div class="card profile-card-5">
                        <div class="card-img-block" style=" width: 51%;
                        margin: 0 auto;
                        position: relative;
                        ">
                            <img class="card-img-top img-round"  src="{{$child->profile_photo_path}}" alt="Card image cap">
                        </div>
                        <div class="card-body pt-0">
                        <h5 class="card-title">{{$child->name}} {{$child->middlename}} {{$child->lastname}}</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">View Report Card</a>
                      </div>
                    </div>
                
                </div>
                     --}}

                     <div class="card p-3">

                        <div class="d-flex align-items-center">
        
                            <div class="image">
                        <img src="{{$child->profile_photo_path}}"  class="rounded" width="155" >
                        </div>
        
                        <div class="ml-3 w-100">
                            
                           <h4 class="mb-0 mt-0">{{$child->lastname}} {{$child->name}} {{$child->middlename}}</h4>
                           <span>{{$child->grade_name}}</span>
        
                        
        
        
                           <div class="button mt-2 d-flex flex-row align-items-center">
        
                     

                           @foreach (\App\Models\School::all() as $item)
                         @if ($item->school_type=="primary-school")
                         <a href="/cbe/report/generate/3/{{\Crypt::encrypt($child->student_id)}}"><button class="btn btn-sm btn-primary w-100">{{$child->name}}'s  Report Card</button></a> 
                         <a href=""> <button class="btn btn-sm btn-outline-primary w-100 ml-2">{{$child->name}}'s Profile</button></a>  
                         @else

                         
                         <form action="{{route('report.stream')}}" method="post">
                            @csrf
                   
                          <div class="card-body">
                          
                           <input type="hidden" name="p_class" value="class_based">
                   
                            <div class="form-row">
                   
                              
                   
                               <div class="col-md-4 form-group">
                                   <x-jet-label>Select Term</x-jet-label>
                                   <select class="form-control" name="term">
                                       <option value="">Term</option>
                                       @foreach($terms as $term)
                                           <option value="{{ $term->term_id }}">
                                               {{ $term->term_name }}-{{ $term->academic_session }}
                                            
                                       @endforeach
                                   </select>
                                   @error('term')
                                       <span class="text-danger">{{ $message }}</span>
                                   @enderror
                               </div>
                   
                   
                   
                               <div class="col-md-4 form-group">
                            <x-jet-label>Choose Class</x-jet-label>
                            <select class="form-control" name="grade">
                               <option value="">Select Class</option>
                               @foreach($classes as $class)
                                   <option value="{{ $class->id }}">
                                       {{ $class->grade_name }}
                                   </option> 
                               @endforeach
                           </select>
                           @error('grade')
                               <span class="text-danger">{{ $message }}</span>
                           @enderror
                        </div>
                      
                       
                        <div class="col-md-4 form-group">
                           <x-jet-label>Choose Report Template</x-jet-label>
                          
                           <select name="report_template" id="report_template" class="form-control">
                               <option value="">Select Template</option>
                             @foreach ($templates as $item)
                            
                             <option value="{{$item->id}}">{{$item->template_name}}</option>
                             @endforeach
                           </select>
                   
                       </div>
                          </div>
                   
                          <div class="card-footer text-muted">
                            <x-jet-button id="btnSelector" onclick="callAjax();">Generate Class Report</x-jet-button>
                          </div>
                          </form>




                         <a href="/report/generate/3/{{\Crypt::encrypt($child->student_id)}}"><button class="btn btn-sm btn-primary w-100">{{$child->name}}'s  Report Card</button></a> 
                         <a href=""> <button class="btn btn-sm btn-outline-primary w-100 ml-2">{{$child->name}}'s Profile</button></a>   
                         @endif
                           @endforeach
        
                               
                           </div>
        
        
                        </div>
        
                            
                        </div>
                        
                    </div>
                @endforeach



                {{-- <form action="cbe/report/generate/{id}/{term}" method="GET">   --}}
                    {{-- <div class="card-body">
                        @csrf --}}
                        {{-- <div class="form-row">
                        <div class="col-md-6 form-group">
                          <x-jet-label>My Child</x-jet-label>
                         <select class="form-control" name="student_id">
                          <option value="">Select Child</option>
                          @foreach ($children as $student)
                          <option value="{{$student->id}}">     <img class="card-img-top img-round"  src="{{$child->profile_photo_path}}" alt="Card image cap">{{$student->lastname}} {{$student->name}} {{{$student->middlename}}}</option>
                              
                          @endforeach
                         </select>
                          @error('student_id')
                          <span class="text-danger">{{$message}}</span>  
                          @enderror
                          </div> --}}
{{--   
                          <div class="col-md-6 form-group">
                              <x-jet-label>Select Term</x-jet-label>
                             <select class="form-control" name="term_id">
                              <option value="">Select Term</option>
                              @foreach ($terms as $term)
                              <option value="{{$term->id}}">{{$term->term_name }}</option>
                              @endforeach
                             </select>
                              @error('term_id')
                              <span class="text-danger">{{$message}}</span>  
                              @enderror
                          </div> --}}
  
{{--                              
                  </div>
                  </div>
                  <!-- /.card-body -->
        
                  <div class="card-footer">
                    <x-jet-button>Load Report Card</x-jet-button>
                  </div>
            </form> --}}
            </div>
          </div>
 
 
 
      
      
    
    </div>
            
          </div>  
    
</x-app-layout>

 