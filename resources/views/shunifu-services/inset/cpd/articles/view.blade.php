<x-app-layout>
    <x-slot name="header">
      <style>
     

      </style>
    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
    
      </div>
  
        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1688933646/c6mw5isku7asaukgghlu.jpg">
        <div class="card-body">
          <h4 class="lead"> Article Feed</h4>
         
          <hr>
         <div class="text-muted">
          Hi, <span class="text-bold">{{Auth::user()->salutation}} {{Auth::user()->lastname}}</span>. Welcome to the IN-Service Education & Training Article section. You will use this section to access content curated by the INSET Team to help improve as a teacher.<br>
          To go back click <a href="/users/student">here</a> 
         </div>
       
        </div>
    </div> 
    <div class="row">
     

     
            
          </div>  

          

          
    
</x-app-layout>

 