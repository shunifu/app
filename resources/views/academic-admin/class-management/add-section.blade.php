<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="row">
        <div class="col-md-4">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Add Section</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('section.store')}}" method="post">
                <div class="card-body">
                      @csrf
                      <div class="form-group">
                        <x-jet-label> Section Name</x-jet-label>
                        <x-jet-input name="section_name" placeholder="e.g Junior" ></x-jet-input>
                        @error('section_name')
                        <span class="text-danger">{{$message}}</span>  
                        @enderror
                        </div>
                </div>
                <!-- /.card-body -->
      
                <div class="card-footer">
                  <x-jet-button>Add Section</x-jet-button>
                </div>
            </form>
            </div>
      
      
        </div>
        <div class="col-md-8">
          <div class="card card-light">
            <div class="card-header">
              <h3 class="card-title">Manage Section</h3>
            </div>
            <!-- /.card-header -->
            
            
              <div class="card-body">
                
                <table class="table table-sm table-hover mx-auto table-bordered">
                  <thead class="thead-light">
                    <tr>
                      <th>Section Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                     @foreach ($collection_section as $section_item)
                     <tr>
                         <td>{{$section_item->section_name}}</td>
               
                          <td class="text-left py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                              <a href="section/edit/{{$section_item->id}}" class="btn btn-info"><i class="fas fa-edit mr-1"></i>Edit</a>
                              <a href="section/delete/{{$section_item->id}}" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Delete</a>
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
    
</x-app-layout>

 