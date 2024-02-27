<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="card card-light  ">
      <div class="card-header">
        <h3 class="card-title">Student Registration Portal</h3>
      </div>

        <img class="card-img-top"  src="https://res.cloudinary.com/innovazaniacloud/image/upload/v1709015409/laxkufn0irkhjfxtozgo.png">
        <div class="card-body">
          <h4 class="lead">Student Registration Portal</h4>

          <hr>
         <div class="text-muted">
          Hi, <span class="text-bold">{{Auth::user()->salutation}} {{Auth::user()->lastname}}</span> welcome to the student registration portal. Use this section to register students into the system. There are 3 ways to add students into the system.
            <p class="card-text">
          You can choose the one that you are most comfortable with.
              <ol>
                <li class="text-bold">Single Add</li>
                The single add option is where you add a single student at a time. You will be shown a form where you will add the requested student details.
                <p></p>

                <li class="text-bold">Bulk Add</li>
                The bulk add option is where you can add <span class="text-italic">multiple</span> students at a time.  You will be shown a form where you will add the requested student details, unlike the single add form, the bulk-add form has a button where you can dynamically add another form, to add another student before you click on submit.

                <p></p>
                <li class="text-bold">Spreadsheet Upload</li>
                The spreadsheet upload option is where you upload a spreadsheet and the system will add all the students in the spreadsheet. <br>
                <span class="text-danger">Important Note:</span> To successfully upload students to the platform, you need to first download the <a href="/templates/spreadsheet/student-registration"><span class="text-bold">Shunifu Student Registration Spreadsheet Template</span> </a> and after downloading the spreadsheet, you need to populate it with the desired student info, after you've added the neccessary data you need to then upload the file, through the Spreadsheet-Upload registration pathway.
                <p></p>
              </ol>
              <br>
              Click on the registration pathway of your choice below.
            </p>

         </div>

        </div>
    </div>
    <div class="row">
        <div class="col">
          <div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Single-Add  Registration Pathway</h3>
              </div>


              <div class="card-body">

                To register students using the single pathway, click on the link below:
                <p class="card-text"><a href="/registration/student/pathway/single">Single-Add Student Registration Pathway</a></p>
              </div>

            </div>


        </div>

        <div class="col">
          <div class="card card-light">
            <div class="card-header">
              <h3 class="card-title">Bulk-Add Registration Pathway</h3>
            </div>


            <div class="card-body">

              To register students using the multiple-student registration pathway, click on the link below:
              <p class="card-text"><a href="/registration/student/pathway/bulk">Multiple Student Registration Pathway</a></p>
            </div>

          </div>
        </div>


        <div class="col">
          <div class="card card-light">
            <div class="card-header">
              <h3 class="card-title">Spreadsheet-Upload-Registration Pathway</h3>
            </div>


              <div class="col">
        <div class="card card-light">

          <div class="card-header">
              <h3 class="card-title">Upload Spreadsheet</h3>
            </div>

          <div class="card-body">
          <form action="{{route('student.import')}}" method="post"  enctype="multipart/form-data">
            @csrf
          <input type="file"  name="import">
          <p></p>
          <x-jet-button>Upload Spreadsheet</x-jet-button>
          </form>
        </div>

      </div>

      </div>

          </div>
        </div>


          </div>



</x-app-layout>

