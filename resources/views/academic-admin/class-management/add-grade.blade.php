<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Manage Classes</h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.80/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_34_style_light_align_center:Manage Classes,w_0.2,y_0.14/v1615202389/Untitled_design_1_oaroft.png" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to school classes<br>
          
            </p>
          
         </div>
        
        </div>
    </div> 
<div class="row">
    
  <div class="col-md-4">

    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">Add Class</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('grade.store')}}" method="post">
          <div class="card-body">
            
                @csrf
                <div class="form-group">
                <x-jet-label> Class Name</x-jet-label>
                <x-jet-input name="grade_name" placeholder="Form 1A" ></x-jet-input>
                @error('grade_name')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

                <div class="form-group">
                <x-jet-label>Class Stream</x-jet-label>
               <select class="form-control" name="stream">
                <option value="">Select Stream</option>
                @foreach ($collection_stream as $item_stream)
                <option value="{{$item_stream->id}}">{{$item_stream->stream_name}}</option>
                @endforeach
               </select>
                @error('stream')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

                <div class="form-group">
                <x-jet-label>Class Section</x-jet-label>
                <select class="form-control" name="section">
                <option value="">Select Section</option>
                @foreach ($collection_section as $item_section)
                <option value="{{$item_section->id}}">{{$item_section->section_name}}</option>
                @endforeach
                </select>
                @error('stream')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

               
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <x-jet-button>Add Class</x-jet-button>
          </div>
       
      </div>
    </form>

  </div>

  <div class="col-md-8">

    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Manage Classes</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      
        <div class="card-body">
          
          <table class="table table-sm table-hover mx-auto table-bordered">
            <thead class="thead-light">
              <tr>
                <th>Class Name</th>
                <th>Class Stream</th>
                <th>Class Section</th>
                <th>Manage</th>
              </tr>
            </thead>
            <tbody>
              <tr>
               @foreach ($master_collection as $grade_item)
               <tr>
                   <td>{{$grade_item->grade_name}}</td>
                   <td>{{$grade_item->stream_name}}</td>
                   <td>{{$grade_item->section_name}}</td>

                   <td class="text-left py-0 align-middle">
                    <div class="btn-group btn-group-md">
                      <a href="/academic-admin/class/view/{{$grade_item->grade_id}}" class="btn btn-success"><i class="fas fa-eye"></i></a>
                      <a href="/academic-admin/class/edit/{{$grade_item->grade_id}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                      <a href="/academic-admin/class/delete/{{$grade_item->grade_id}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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