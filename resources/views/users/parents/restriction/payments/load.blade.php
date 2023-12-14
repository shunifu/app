<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                  
                </div>

               
                <div class="card-body">
                    <h3 class="lead">Hi, {{ Auth::user()->name }}</h3>
                    <div class="text-muted">
                        <p>Hi {{Auth::user()->name}}, you are restricting  <span class="text-bold"> parents </span> of the following students due to non-payment of school fees 
                            to continue, please select the parents of the students you want to restrict  from accessing the report cards. Siyabonga! </p>

                    </div>

                </div>



                <!-- /.card-header -->
                <!-- form start -->
              
                    <div class="card-body">
        
                      
                              <p class="card-text">
                                <form action="{{route('payment_restriction.store')}}" method="post">  
                                  @csrf
                                  <div class="student_list">
                        
                         
                            <input type="checkbox" id="select_all" name="select_all">
                          <label for="students">Select All</label>
                          <hr>
                          
                          @foreach ($students as $item)
                          
                          <div>
                           <input type="checkbox" class="parents" name="parents[]" value="{{$item->parent_id}}" >
                           <input type="hidden" id="parent_id" name="students[]" value="{{$item->student_id}}">
                          
                           <label for="students">{{$item->lastname}} {{$item->name}} {{$item->middlename}} </label>
                          </div>
                              
                           @endforeach    
                          
                         
                        </div>
                <hr>

                <div class="form-group">
                  <label for="">Select Action</label>
                  <select class="form-control" name="restriction_status[]" id="restriction_status">
                    <option value="">Select Action</option>
                    <option value="1">Restrict</option>
                    <option value="0"> Unrestrict</option>
                  
                  </select>
                </div>
                    </hr>
                              <div class=" m-0">
                                <x-jet-button>Restrict Parents</x-jet-button>
                              </div>
                            </form>
                            </div>

          
            </div>


        </div>


    </div>

</x-app-layout>
