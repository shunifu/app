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
    <h3 class="mb-1">{{Auth::user()->name}} {{Auth::user()->middlename}} {{Auth::user()->lastname}}</h3>
            <hr>
    <p class="text-gray-700 mb-1 2h-base">Hi,{{\Spatie\Emoji\Emoji::grinningFace()}}{{Auth::user()->name}}<p>
              </p>

    <p class="text-gray-700 mb-1 2h-base"> Use this section to link parents to students.</p>

        </div>
    </div>

</div>

<div class="card card-light">
    
  
      <div class="card-body">

     <ul class="nav nav-pills mb-5 flex-column flex-sm-row  nav-fill" id="pills-tab" role="tablist">
<div class="p3">

</div>
<li class="nav-item" role="presentation">
<a class="nav-link active bg-light" id="pills-mark-tab" href="/parent-li" role="tab" aria-controls="pills-add-mark" aria-selected="true">Add Parent</a>
</li>

<li class="nav-item" role="presentation">
<a class="nav-link bg-light" id="pills-section_analysis-tab"  href="/verification/otp/generate/" role="tab" aria-controls="pills-section_analysis" aria-selected="false">Send OTP</a>
</li>

{{-- <li class="nav-item" role="presentation">
<a class="nav-link bg-light" id="pills-class-analysis-tab"  href="/marks/analytics" role="tab" aria-controls="pills-class-analysis" aria-selected="false">Mark Analyis</a>
</li> --}}



</ul>
      </div>
</div>


    </div>
</div>         


