<x-app-layout>
    <x-slot name="header">
        <style>
  @media print { 
             .table th { 
                background-color: grey !important; 
                color: white;

            } 
        }

 


        </style>
      
    </x-slot>

    <div class="container">
    <div class="row">
        <div class="col-md-12">
          <div class="card card-light">
           
              
              <div class="card-header no-print">
               <h3 class="card-title"> <a href="/academic-admin/class-lists"><span>Back </span></a></h3>
              </div>
            
            <div class="card-body">
            
            

              @if ($data->isEmpty())
              <h3 class="small lead text-muted text-center ">No Students found this class.</h3>
              <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<lottie-player src="https://assets2.lottiefiles.com/packages/lf20_x62chJ.json" mode="bounce" background="transparent"  speed="1"  style="width: 300px; height: 300px; margin-left:auto; margin-right:auto"   loop  autoplay></lottie-player>
              @else
            
      
<div class="row mx-auto d-flex ">

    <div class="col">  @foreach ($school_info as $school_data)
    <img src={{$school_data->school_logo }}  class="mx-auto d-block img-fluid " width="60px" height="60px"/>
    @endforeach
    </div>
    
</div>
<div class="row mx-auto d-flex ">
<div class="col">
<h3 class="text-bold text-center text-underline ">Class list: {{$grade->grade_name}}-{{$session->academic_session}}</h3> 
</div>
  
   </div>
                        <ol>
<hr>
                        @foreach ($data as $item)
                        <li> {{$item->lastname}} {{$item->name}}  {{$item->middlename}} </li>
                        @endforeach
             
                        </ol>
            @endif
                
        </div>
     
            
          </div>  
    </div>
     
</x-app-layout>

 