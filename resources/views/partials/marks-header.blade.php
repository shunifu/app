<div class="row justify-content-center">
    <div class="col-md-12">

<div class="bg-white shadow rounded overflow-hidden">
    <div class="px-4 py-6 pt-4 pb-4 elevation-2 cover d-print-none">
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
    
    <div class="bg-white p-4 mb-2 mt-5 d-flex justify-content-start d-print-none">
        <div class="col-12 col-sm-6 col-lg-8 d-print-none" >
            <h3 class="mb-1 d-print-none">{{Auth::user()->name}} {{Auth::user()->middlename}} {{Auth::user()->lastname}}<svg class="ml-1"  xmlns="http://www.w3.org/2000/svg"
                    width="26" height="25.19" viewBox="0 0 24 23.25">
                    <path
                        d="M23.823,11.991a.466.466,0,0,0,0-.731L21.54,8.7c-.12-.122-.12-.243-.12-.486L21.779,4.8c0-.244-.121-.609-.478-.609L18.06,3.46c-.12,0-.36-.122-.36-.244L16.022.292a.682.682,0,0,0-.839-.244l-3,1.341a.361.361,0,0,1-.48,0L8.7.048a.735.735,0,0,0-.84.244L6.183,3.216c0,.122-.24.244-.36.244L2.58,4.191a.823.823,0,0,0-.48.731l.36,3.412a.74.74,0,0,1-.12.487L.18,11.381a.462.462,0,0,0,0,.732l2.16,2.437c.12.124.12.243.12.486L2.1,18.449c0,.244.12.609.48.609l3.24.735c.12,0,.36.122.36.241l1.68,2.924a.683.683,0,0,0,.84.244l3-1.341a.353.353,0,0,1,.48,0l3,1.341a.786.786,0,0,0,.839-.244L17.7,20.035c.122-.124.24-.243.36-.243l3.24-.734c.24,0,.48-.367.48-.609l-.361-3.413a.726.726,0,0,1,.121-.485Z"
                        fill="#0D6EFD"></path>
                    <path data-name="Path" d="M4.036,10,0,5.8,1.527,4.2,4.036,6.818,10.582,0,12,1.591Z"
                        transform="translate(5.938 6.625)" fill="#fff"></path>
                </svg>
            </h3>
            <hr>
           
            <p class="text-gray-700 mb-1 2h-base d-print-none">{{$greetings}} {{\Spatie\Emoji\Emoji::grinningFace()}}{{Auth::user()->name}}<p>
          

              {{-- <p class="text-gray-700 mb-1 2h-base d-print-none">

                Use this section to add marks for students.
                <ol>
                    <li>Select your teaching load </li>
                    <li>Select the assessement you want to add marks for.</li>
                    </ol> 

              </p> --}}

        </div>
    </div>

</div>

<div class="card card-light d-print-none">
    
    <!-- /.card-header -->
    <!-- form start -->
  
      <div class="card-body d-print-none">

     <ul class="nav nav-pills mb-5 flex-column flex-sm-row  nav-fill" id="pills-tab" role="tablist">
<div class="p3">

</div>
<li class="nav-item" role="presentation">
<a class="nav-link active bg-light" id="pills-mark-tab" href="/marks" role="tab" aria-controls="pills-add-mark" aria-selected="true">Add Marks</a>
</li>

<li class="nav-item" role="presentation">
<a class="nav-link bg-light" id="pills-section_analysis-tab"  href="/marks/manage" role="tab" aria-controls="pills-section_analysis" aria-selected="false">Delete Marks</a>
</li>

<li class="nav-item" role="presentation">
    <a class="nav-link bg-light" id="pills-section_analysis-tab"  href="/marks/transfer" role="tab" aria-controls="pills-section_analysis" aria-selected="false">Transfer Marks</a>
</li>

<li class="nav-item" role="presentation">
<a class="nav-link bg-light" id="pills-class-analysis-tab"  href="/marks/analytics" role="tab" aria-controls="pills-class-analysis" aria-selected="false">Mark Analyis</a>
</li>

<li class="nav-item" role="presentation">
    <a class="nav-link bg-light" id="pills-class-analysis-tab"  href="/marks/my-scoresheet" role="tab" aria-controls="pills-class-analysis" aria-selected="false">My Scoresheet</a>
    </li>

    <li class="nav-item" role="presentation">
        <a class="nav-link bg-light" id="pills-class-analysis-tab"  href="/marks/my-comments" role="tab" aria-controls="pills-class-analysis" aria-selected="false">My Comments</a>
        </li>


</ul>
      </div>
{{-- </div> --}}


    </div>
</div>         


