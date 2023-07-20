<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                  
                </div>

                <img class="card-img-top"
                src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1689527001/ircmjalujakjo1i1bjy4.png"
                    alt="">
                <div class="card-body">
                    <h3 class="lead">Sivusele, {{ Auth::user()->name }}</h3>
                    <div class="text-muted">
                        <a href="">Back </a>
                        <p class="card-text"> Use this section to view the list of strands for {{$term_name}} -{{$stream_name}}- {{$subject_name}}

                        </p>

                    </div>

                </div>


                <div class="card-body">
                    <div class="table-responsive">
                    
                    
                                    <table class="table table-hover table-bordered " id="strands">
                                      <thead class="thead-light">
                                        <tr>
                                          <th>No.</th>
                                          <th>Strand</th>
                                        
                                          <th>Manage</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        
                                          
                                            @foreach ($strands as $item)
                                            <tr>
                                            <td>
                                              {{$loop->iteration}}
                                          
                                            </td>
                                            <td>{{$item->strand}}  </td>
                                       
                                        
                     
                   <td class="text-left py-0 align-middle">


                    <div class="dropdown">
                      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="/academic-admin/strands/edit/{{$item->id}}">Edit Strand</a>
                      
                      </div>
                    </div>
                   
                  </td>
                                            </tr>
                                          
                                            @endforeach
                                          
                                            
                                        
                                        </tbody>
                                    </table>
                    </div>
                                      
                                    </div>

           
              
            </div>


        </div>


    </div>

 

</x-app-layout>
