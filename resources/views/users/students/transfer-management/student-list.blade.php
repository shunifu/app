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
<h3>{{$class_name}}</h3>
  </div>
  
</div>

               
               
<form action="/students/transfer/process/" method="POST" >
    @csrf
    {{-- @method('PUT') --}}
                      <table class="table table-sm table-compact">
                        <thead class="thead-light ">
                    <tr>
                      <th> No.</th>
                        <th> Student Name</th>
                        <th>Current Class</th>
                        <th>Transfer To</th>
                       
                    </tr>
                    </thead>
                    <tbody>
                   
                         @foreach ($result as $item)
                            <tr>
                              <input type="hidden" value="{{$item->user_id}}" name="student_id[]">
                              <input type="hidden" value="{{$item->user_id}}" name="transfer_from[]">
                            <td class="vertical-middle">{{$item->user_id}} </td>
                            <td class="vertical-middle">{{$item->lastname}} {{$item->name}} {{$item->middlename}} </td>
                            <td class="vertical-middle">{{$item->grade_name}}  </td>
                            <td class="vertical-middle">
                                <select class="form-control transfer_to " id="{{$item->grade_id}}"  name="transfer_to[]">
                                    <option value="{{$item->grade_id}}">{{$item->grade_name}}</option>
                                    @foreach ($grades_list as $list)
                                    <option value="{{$list->id}}">{{$list->grade_name}}</option>
                                        
                                    @endforeach

                                </select>
                                
                            </td>
                            {{-- <td class="vertical-middle">{{$item->email}}</td>
                            <td><a href="student/view/{{$item->user_id}}" class="link"><i class="fas fa-eye 2x mr-2"></i>View</a></td> --}}
                        </tr>
                            @endforeach
                          
                    </tbody>
            </table>
            <x-jet-button>Transfer Students</x-jet-button>
        </form>
              </div>
            @endif
          
        </div>


            
        </div>     
            
        </div>  
        {{-- <script>
        $(document).ready(function(){
        var token = $('meta[name="csrf-token"]').attr('content');
        $(".transfer_to").change(function () {
        event.preventDefault();

        var transfer_to=this.value;
        var student_id=$(this).attr('id');
            
        $.ajax({
            // header:{
            //   'X-CSRF-TOKEN': token
            // },
            //'+transfer_to+'/'+student_id
            
                url: "/students/transfer/process/",
                type: 'POST',
                data: {transfer_to:transfer_to,student_id:student_id},
                })
                .done(function(data) {
                   
                   
                
                })
                .fail(function(data) {
                    console.log(data);
                })
                .always(function() {
                    console.log("complete");
                });
       });
});
        </script> --}}
       
        

</x-app-layout>

 