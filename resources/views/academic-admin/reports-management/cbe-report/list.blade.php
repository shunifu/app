<x-app-layout>
    <x-slot name="header">


    </x-slot>
   
    <div class="card  ">
        <img class="card-img-top"
            src="https://res.cloudinary.com/innovazaniacloud/image/upload/c_fill,g_auto,h_250,q_auto,w_970/b_rgb:000000,e_gradient_fade,y_-0.5/c_scale,co_rgb:ffffff,fl_relative,l_text:montserrat_40_style_light_align_center:Report Management,w_0.3,y_0.18/v1612793225/shunifu/pexels-photo-4143800_vqecd5.jpg"
            alt="">
        <div class="card-body">
           
          
            Hi,  {{ Auth::user()->salutation }}  {{ Auth::user()->lastname }} this is the section where you will generate CBE report cards for students. <hr>
    
  
        </div>
    
    </div>
 


{{-- Beginning of Stream Card --}}

   <div class="card ">
      

    

       <div class="card-body">
       
    

        <table class="table table-bordered table-hover">
            <thead class="thead">
                <tr>
                    <th>Student Name</th>
                    <th>Action</th>
                  
                </tr>
            </thead>
            <tbody>

                @foreach ($students as $student)

                <tr>
                    <td scope="row">{{$student->name}}  {{$student->middlename}} {{$student->lastname}}</td>
                    <td> <a href="/cbe/report/generate/{{$term_id}}/{{\Crypt::encrypt($student->student_id)}} ">Generate</a></td>
                   
                </tr>  
                @endforeach
               
               
            </tbody>
        </table>

     

       
     
       </div>
   </div>



</x-app-layout>
