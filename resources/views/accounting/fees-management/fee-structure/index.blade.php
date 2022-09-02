<x-app-layout>
    <x-slot name="header">
      <style>
        .profile-head {
        transform: translateY(5rem)
    }
    
    .cover {
        background-image: url(https://images.pexels.com/photos/5965705/pexels-photo-5965705.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940);
      background-size: cover;
        background-repeat: no-repeat
    }
    
    </style>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/js/bootstrap-multiselect.min.js" integrity="sha512-fp+kGodOXYBIPyIXInWgdH2vTMiOfbLC9YqwEHslkUxc8JLI7eBL2UQ8/HbB5YehvynU3gA3klc84rAQcTQvXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.1/css/bootstrap-multiselect.min.css" integrity="sha512-jpey1PaBfFBeEAsKxmkM1Yh7fkH09t/XDVjAgYGrq1s2L9qPD/kKdXC/2I6t2Va8xdd9SanwPYHIAnyBRdPmig==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </x-slot>


 
    <div class="row justify-content-center">
        <div class="col-md-12">
    
    <div class="bg-white shadow rounded overflow-hidden">
        <div class="px-4 py-6 pt-4 pb-4 elevation-2 cover">
            <div class="media align-items-end profile-head">
                <div class="profile mr-2">
                    @if(empty(Auth::user()->profile_photo_url))
                    <img src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1613141854/default-profile-picture-avatar-photo-placeholder-vector-illustration-vector-id1214428300_urpxk5.jpg" alt="..." width="180" class="rounded mt-8 rounded-circle">
                    @else
    
                    <img class="user-image img-circle " width="128" height="128" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    @endif
                </div>
               
            </div>
        </div>
        
        <div class="bg-white p-4 mb-2 mt-5 d-flex justify-content-start ">
            <div class="col-12 col-sm-6 col-lg-8">
                <h3 class="mb-1">{{Auth::user()->name}} {{Auth::user()->middlename}} {{Auth::user()->lastname}}<svg class="ml-1"  xmlns="http://www.w3.org/2000/svg"
                        width="26" height="25.19" viewBox="0 0 24 23.25">
                        <path
                            d="M23.823,11.991a.466.466,0,0,0,0-.731L21.54,8.7c-.12-.122-.12-.243-.12-.486L21.779,4.8c0-.244-.121-.609-.478-.609L18.06,3.46c-.12,0-.36-.122-.36-.244L16.022.292a.682.682,0,0,0-.839-.244l-3,1.341a.361.361,0,0,1-.48,0L8.7.048a.735.735,0,0,0-.84.244L6.183,3.216c0,.122-.24.244-.36.244L2.58,4.191a.823.823,0,0,0-.48.731l.36,3.412a.74.74,0,0,1-.12.487L.18,11.381a.462.462,0,0,0,0,.732l2.16,2.437c.12.124.12.243.12.486L2.1,18.449c0,.244.12.609.48.609l3.24.735c.12,0,.36.122.36.241l1.68,2.924a.683.683,0,0,0,.84.244l3-1.341a.353.353,0,0,1,.48,0l3,1.341a.786.786,0,0,0,.839-.244L17.7,20.035c.122-.124.24-.243.36-.243l3.24-.734c.24,0,.48-.367.48-.609l-.361-3.413a.726.726,0,0,1,.121-.485Z"
                            fill="#0D6EFD"></path>
                        <path data-name="Path" d="M4.036,10,0,5.8,1.527,4.2,4.036,6.818,10.582,0,12,1.591Z"
                            transform="translate(5.938 6.625)" fill="#fff"></path>
                    </svg>
                </h3>
                <hr>
               
                <p class="text-gray-700 mb-1 2h-base"> {{\Spatie\Emoji\Emoji::grinningFace()}}{{Auth::user()->name}}<p>
                  </p>
    
                  <p class="text-gray-700 mb-1 2h-base">
    
                    Use this section to add marks for students.
                    <ol>
                        <li>Select your teaching load </li>
                        <li>Select the assessement you want to add marks for.</li>
                        </ol> 
    
                  </p>
    
            </div>
        </div>
    
    </div>
    
    <div class="card card-light">
        
        <!-- /.card-header -->
        <!-- form start -->
      
          <div class="card-body">
    
         <ul class="nav nav-pills mb-5 flex-column flex-sm-row  nav-fill" id="pills-tab" role="tablist">
    <div class="p3">
    
    </div>
    <li class="nav-item" role="presentation">
    <a class="nav-link active bg-light" id="pills-mark-tab" href="/marks" role="tab" aria-controls="pills-add-mark" aria-selected="true">Add Fee Structure</a>
    </li>
    
    <li class="nav-item" role="presentation">
    <a class="nav-link bg-light" id="pills-section_analysis-tab"  href="/marks/manage" role="tab" aria-controls="pills-section_analysis" aria-selected="false">Manage Fee Structure</a>
    </li>
    
    
    
    
    </ul>
          </div>
    </div>
    
    
        </div>
    </div>         
    
    
    

   
    <div class="mb-4">
  
     
    </div>
    <div class="col-md-12 ">
        <div class="card card-light   elevation-3">
           
            <div class="card-body">
                <form action="{{}}" method="post">

                            @csrf
                            <div class="form-row">


                                <div class="col-md-6 form-group">
                                    <x-jet-label>Select Session</x-jet-label>
                                    <select class="form-control" name="session">
                                        <option value="">Select Session</option>
                                        @foreach($sessions as $session)
                                            <option value="{{ $session->id }}">
                                                {{ $session->academic_session }}
                                             
                                        @endforeach
                                    </select>
                                    @error('session')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
    
                                <div class="col-md-6 form-group">
                                    <x-jet-label>Select Stream</x-jet-label>
                                    <select class="form-control" name="stream[]" id="stream" >
                                        <option value="">Select Class</option>
                                        @foreach($streams as $stream)
                                <option value="{{ $stream->id }}">{{ $stream->stream_name }} </option>
                                        @endforeach
                                    </select>
                                    @error('stream')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
    
                               
    
                            </div>

                        <div class="card-footer col-auto">
                            <x-jet-button id="btnSelector">Show Stream Structure</x-jet-button>
                        </div>
                </form>
       

            </div>

        </div>
    </div>

    <div class="mb-4">

    </div>
 
    <script type="text/javascript">
        // $('#multiple_loads').multiselect();
        $('#multiple_loads').multiselect({
            buttonWidth: '150px'
        });
    </script>
 
    
</x-app-layout>