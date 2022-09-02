<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Edit Comment</h3>
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_290,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_25_style_light_align_center:Comments Management,w_0.4,y_0.28/v1619444117/pexels-photo-1111368_coxluw.jpg" alt="">
        <div class="card-body">
          <h3 class="lead">Hi, {{Auth::user()->name}}</h3>
         <div class="text-muted">
            <p class="card-text"> Use this section to manage report card comments <br>
          
            </p>
          
         </div>
        
        </div>
    </div>  
<div class="row">


    
  <div class="col-md-4">

    <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title">Edit Comment</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('comments.update')}}" method="post">
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
                <div class="row">
                <div class="col">
                    <x-jet-label>Minimum Mark</x-jet-label>
               <x-jet-input name="from" placeholder="from" ></x-jet-input>
                </div>
                <div class="col">
                    <x-jet-label>Maximum Mark</x-jet-label>
                    <x-jet-input name="to" placeholder="to" ></x-jet-input>
                     </div>
                </div>
                @error('to')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                @error('from')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

                <div class="form-group">
                    <x-jet-label>Symbol</x-jet-label>
                    <select class="form-control" name="symbol">
                        <option value="">Select Symbol</option>
                        
                        <option value="A*">A*</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                        <option value="H">H</option>
                        <option value="U">U</option>
                      
                    </select>
                    @error('symbol')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                    </div>

                    
                <div class="form-group">
                    <x-jet-label>Comment</x-jet-label>
                    <textarea class="form-control" name="comment"></textarea>
                    @error('comment')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                    </div>
    
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <x-jet-button>Add Comment</x-jet-button>
          </div>
       
      </div>
    </form>

  </div>

  <div class="col-md-8">

    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title">Manage Comments</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      
        <div class="card-body">
          <div class="table-responsive">

          
          <table class="table">
            <thead class="bg-light">
              <tr>
                <th class="text-center ">Section</th>
                <th class="text-center">Range</th>
                <th class="text-center">Symbol</th>
                <th class="text-center">Comment</th>
                <th class="text-center">Manage</th>
              </tr>
            </thead>
            <tbody>
             <tr>
               @foreach ($comments as $comment)
               <tr id="sid{{$comment->id}}">
<td>{{$comment->section_name}}</td>
<td> {{$comment->from}}%-{{$comment->to}}%</td>
<td> {{$comment->symbol}}</td>
<td> {{$comment->comment}}</td>
 <td>

{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">

</button> --}}
<a href="comment/report/{{$comment->id}}" ><i class="fas fa-edit mr-1"></i></a>
<span class="m-3"></span>
<a href="comment/delete/{{$comment->id}}"><i class="fas fa-trash mr-1"></i></a>

{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> --}}
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



<!-- Modal -->
<div class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editComment">
          <div class="card-body">
            
                @csrf
                <input type="hidden" name="id" id="id"/>
                <div class="form-group">
                <x-jet-label>Section</x-jet-label>
                <select class="form-control" id="editSection" name="section" >
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
                <div class="row">
                <div class="col">
                    <x-jet-label>Minimum Mark</x-jet-label>
               <x-jet-input name="from" placeholder="from" id="editFrom" ></x-jet-input>
                </div>
                <div class="col">
                    <x-jet-label>Maximum Mark</x-jet-label>
                    <x-jet-input name="to" placeholder="to" id="editTo" ></x-jet-input>
                     </div>
                </div>
                @error('to')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                @error('from')
                <span class="text-danger">{{$message}}</span>  
                @enderror
                </div>

                <div class="form-group">
                    <x-jet-label>Symbol</x-jet-label>
                    <select class="form-control" id="editSymbol" name="symbol">
                        <option value="">Select Symbol</option>
                        
                        <option value="A*">A*</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                        <option value="G">G</option>
                        <option value="H">H</option>
                        <option value="U">U</option>
                      
                    </select>
                    @error('symbol')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                    </div>

                    
                <div class="form-group">
                    <x-jet-label>Comment</x-jet-label>
                    <textarea class="form-control" name="comment" id="editComment"></textarea>
                    @error('comment')
                    <span class="text-danger">{{$message}}</span>  
                    @enderror
                    </div>
    
          </div>
          <!-- /.card-body -->
        </form>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
       
      </div>
    
      </div>
     
    </div>
  </div>
</div>
      
    </div>   
            
     <script>
//        function editComment(id){

//   $.get('/comment/report/'+id,function(comment_edit){
//   $("#id").val(comment_edit.id);
//   $("#editSection").val(comment_edit.section_name);
//   $("#editFrom").val(comment_edit.from);
//   $("#editTo").val(comment_edit.to);
//   $("#editComment").val(comment_edit.comment);
//   $("#editCommentModal").modal('toggle');

// });
//    }
     </script>
    
</x-app-layout>