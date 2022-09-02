<x-app-layout>
    <x-slot name="header">
        <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
        <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.8/holder.min.js" integrity="sha512-O6R6IBONpEcZVYJAmSC+20vdsM07uFuGjFf0n/Zthm8sOFW+lAq/OK1WOL8vk93GBDxtMIy6ocbj6lduyeLuqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </x-slot>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-light  ">
                <div class="card-header">
                    <h3 class="card-title">Attach Questions</h3>
                </div>

                <img class="card-img-top"
                    src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,w_970/b_rgb:000000,e_gradient_fade,y_-0.50/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_32_style_light_align_center:Assessement,w_0.4,y_0.18/v1616621731/73-737475_google-wallpapers-desktop-wallpaper-wallpaper_zpycaw.png"
                    alt="">

                <div class="card-body">
                    <h3 class="lead"> Hi, {{ Auth::user()->name }}</h3>
                    <div class="text-muted">
                        <p class="card-text">
                            <span class="text-bold">Use this section to attach questions to this assessement. </span> On the left you can add additional questions and on the right you can manage already added questions. <br>
                             
                        </p>

                    </div>

                </div>
                     <!-- /.card-header -->
            </div>

                <div class="card text-left">
                  {{-- <img class="card-img-top" src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_scale,h_180,w_1405/v1616621731/73-737475_google-wallpapers-desktop-wallpaper-wallpaper_zpycaw.png" alt=""> --}}
                  <div class="card-body">
                    <h4 class="card-title">Assignment Details</h4>
                    <p class="card-text">
                        <ul>
                         
                            @foreach ($assessement_details as $item)   
                            <li>Assessment Type:<span class="text-bold ml-1">{{$item->assessement_type_name}}</span></li>
                            <li>Assessement Name:<span class="text-bold ml-1">{{$item->assessement_title}}</span></li>
                            <li>Lesson Topic:<span class="text-bold ml-1">{{$item->lesson_topic}}</span></li>
                            <li>Teaching Load:<span class="text-bold ml-1">{{$item->grade_name}}-{{$item->subject_name}}</span></li>
                            <li>Number of Question:<span class="text-bold ml-1">{{$item->total_questions}}</span></li>
                            <li>Total Marks:<span class="text-bold ml-1">
                                @if ($item->total_marks<1)
                                    No
                                    @else
                                    {{$item->total_marks}}
                                @endif
                                
                            </span>
                             Marks</li>
                            <li>Created: <span class="text-bold ml-1">{{$item->created_at}}</span></li>
                            <li>Due Date:<span class="text-bold ml-1">{{$item->due_date}}</span></li>
                
                            <li>Re-Assign</li>
                            @endforeach

                        </ul>
                       
                        
                        
                    </p>
                  </div>
                </div>




           
            <hr>

            <div class="row">

                <div class="col-md-4">
                     <!-- form start -->
            <form action="{{ route('online-learning.attach_questions_store') }}" method="post">
                <div class="card card-light  " >
                    <div class="card-body" >
                        @csrf
                       
                        <div class="" id="master-div">

                            <div class="col-md-12 form-group">
                                <x-jet-label>Question Type</x-jet-label>
                                <select class="form-control" name="question_type[]" id="question_type">
                                    <option value="0">Select Question Type</option>
                                    <option value="short-answer">Short Answer</option>
                                        <option value="multiple-choice">Multiple Choice </option>
                                        <option value="true-false">True or False</option>
                                        <option value="essay">Essay Questions</option>
                                        <option value="file-based">File-Based</option>
                                   
                                </select>
                                @error('question_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                          

                            <div class="col-md-12 form-group" id="question">
                                <x-jet-label> Question</x-jet-label>
                                <x-jet-input  name="question[]" id="question-field" placeholder="Enter Question"></x-jet-input>
                                @error('question')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group" id="">
                                <x-jet-label id="question_label">

                                </x-jet-label>
                               
                            </div>


                            <div class="col-md-12 form-group">
                                <x-jet-label>Answer</x-jet-label>
                                <x-jet-input name="answer[]" required></x-jet-input>
                                @error('answer')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <x-jet-label>Mark</x-jet-label>
                                <x-jet-input name="mark[]" type="number" min="0" max="100" required></x-jet-input>
                                @error('mark')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                           
                            

                            <input type="hidden" name="teacher_id[]" id="teacher_id" value="{{Auth::user()->id}}" >
                            <input type="hidden" name="assessement_id[]" id="assessement_id" value="{{$assessement_id}}" >

                            
          

                        </div>
                        <div id="slave-div"></div>
                      
<div class="col-auto" id="dynamic">
<button type="button" class="btn btn-success" name="add" id="add_input" type="button"><i class="fas fa-plus-circle mr-1"></i>Add Another Question</button>
                                    
                              
                            </div>
                        

                       <hr>

                     


                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <x-jet-button><i class="fas fa-paperclip mr-2"></i> Attach Questions</x-jet-button>
                        
                    </div>
                </div>
            </form>

                </div>

                <div class="col-8">
                   <div class="card text-left">
                   
                     <div class="card-body">
                       <h4 class="card-title">List of Questions</h4><br>
                       <small>Below is the list of questions assigned to this.</small>
                      
                       <p class="card-text">
                           <table class="table">
                               <thead>
                                   <tr>
                                       <th>Question</th>
                                       <th>Answer</th>
                                       <th>Mark</th>
                                       <th>Manage</th>
                                   </tr>
                               </thead>
                               <tbody>
                                  
                                       @foreach ($question_list as $question_item)
                                       <tr>
                                       <td>
                                        {{$question_item->question}}
                                        </td>
                                       <td>{{$question_item->answer}}</td>
                                       <td>{{$question_item->mark}}</td>
                                       <td>
                                           <div class="row">
                <div class="col"><a href="#">edit</a></div>
                 <div class="col">
                 <!-- <a href="#" name="" id="delete" >delete</a>--->
<a data-toggle="modal" data-target="#exampleModal" href="#">Delete</a>
                </div>

                                           </div>
                                           
                                        </td>
                                    </tr>
                                       {{-- <td></td> --}}
                                    <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Delete Question?</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      Are you sure you want to delete this question?
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                                      <a href="/online-learning/assessements/question/delete/{{$question_item->id}}"><button type="button" class="btn btn-danger">Yes, delete question</button></a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!--end of Modal--->
                                       @endforeach
                                      
                                   
                                  
                               </tbody>
                           </table>
                       </p>
                     </div>
                   </div>
                </div>



            </div>
           
        </div>
    </div>


    </div>


    </div>
                           


    <script>

        $(document).ready(function () {
            var i = 1;
            $('#submit').hide();
            $(".sub_div").hide();

            // var question_label=$('#question').val();
            //     $("#title").html(label);

//             window.MathJax = {
//   loader: {load: ['[tex]/physics']},
//   tex: {packages: {'[+]': ['physics']}}
// };

            $('#question-field').keydown(function() {
                var inputString = $("#question-field").val();

                $('#question_label').html(inputString)

});

$('#dynamic').click(function() {
   
    $('#master-div').clone().find("input:text").val("").end().appendTo('#slave-div');
    
});




         




        });

    </script>

</x-app-layout>
