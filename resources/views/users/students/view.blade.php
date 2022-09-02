<x-app-layout>
    <x-slot name="header">
  
    </x-slot>
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light">
              <div class="p-3 no-print">
                <a href="/users/student/manage">Back</a>
              </div>
              
              <div class="card-header no-print">
                <h3 class="card-title">View Students</h3>
              </div>
            
            <div class="card-body">
              @include('users.students.search')
              <hr>
              <div class="p-4"></div>

              @if ($result->isEmpty())
              <h3 class="small lead text-muted text-center ">No Students found this class.</h3>
              <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<lottie-player src="https://assets2.lottiefiles.com/packages/lf20_x62chJ.json" mode="bounce" background="transparent"  speed="1"  style="width: 300px; height: 300px; margin-left:auto; margin-right:auto"   loop  autoplay></lottie-player>
              @else
              <div class="table-responsive">
<div class="col-md-12 mx-auto">
  @foreach (\App\Models\School::all('school_letter_head') as $item)
  <img src={{asset('storage/'.$item->school_letter_head) }}  class="mx-auto d-block" />
  @endforeach
</div>
               
<div class="row">
  <div class="col pb-4">
   <h3 class="text-bold">Class: {{$student_class->grade_name}}</h3> 
  </div>
  
  <div class="col pb-4 no-print">
   <a href="#" onclick="window.print();">Print</a>
  </div>
</div>

               
               
 
                      <table class="table table-sm table-compact">
                        <thead class="thead-light ">
                    <tr>
                      <th> No.</th>
                        <th> Student Name</th>
                        <th> Class</th>
                        <th> Manage</th>
                       
                        
                    </tr>
                    </thead>
                    <tbody>

                    
                        
                            @foreach ($result as $item)
                            <tr>
                            {{-- <td class="vertical-middle">{{$loop->iteration}}  </td> --}}
                            <td class="vertical-middle">{{$item->id}}  </td>
                            <td class="vertical-middle">{{$item->lastname}} {{$item->name}} {{$item->middlename}} </td>
                            <td class="vertical-middle">{{$item->grade_name}}  </td>
                          
                            <td>
                              <a href="/users/student/manage/view/{{$item->user_id}}" class="link"><i class="fas fa-eye 2x mr-1"></i>View</a>
                              <span class="mr-3"></span>
                              <a href="/users/student/delete/{{$item->user_id}}" class="link"><i class="fas fa-trash 2x mr-1"></i>Delete</a>
                            </td>
                        </tr>
                            @endforeach
                    </tbody>
            </table>
              </div>
            @endif
          
        </div>


            
        </div>
     
            
          </div>  
    
</x-app-layout>

 