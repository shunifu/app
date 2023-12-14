<x-app-layout>

  <style>

 
 @media print {

@page {
{{$size}}
   border: red;
   margin: 0;
   margin: 0px; 
padding: 0px;  
  
}
body{
   /* font-size: 10px; */
   -webkit-print-color-adjust: exact !important;
  
   
}

.row.no-gutters {
  margin-right: 0;
  margin-left: 0;

  & > [class^="col-"],
  & > [class*=" col-"] {
    padding-right: 0;
    padding-left: 0;
  }
}

table td{
margin: 0px; 
padding: 0px; 
user-select: text;
overflow-wrap: break-word;

font-weight: normal; 
font-style: normal; 
vertical-align: baseline; 
text-align: left; 
text-indent: 0px;
font-size: 7.5pt; 
line-height: 10.5px;

}
.table-bordered>tbody>tr>td,  .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th{
  padding:5px;
}
  
div.col-4{
 
  
  
    /* font-size: 9.5px; */
    /* 100 = viewport width, as 1vw = 1/100th of that
       So if the container is 50% of viewport (as here)
       then factor that into how you want it to size.
       Let's say you like 5vw if it were the whole width,
       then for this container, size it at 2.5vw (5 * .5 [i.e. 50%])
    */
    /* font-size: 2.5vw; */

}

/* #des{
 
    border: 1px solid black;
  
  
}


div.assessement{
 
    border: 1px solid black;
  

} */
/* 
table{
 font-size:11px !important;
} */
/* 
#contain{
 font-size: 12px;
} */

}
/* .container {
  width: 100%;
  padding: 0;
  margin: 0;
}

.row {
  height: 8.5in;
  display: inline-flex;
  padding: 0;
  margin: 0;

  max-height: 100;
  width: 100%;
} */

  </style>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<a href="#" class="btn btn-col-4 btn-primary" id="print">Generate PDF of Report</a>
<div class="container-fluid d-flex flex-column bg-white" id="print_area"  >

  {{-- Front Page --}}
     <div class="row" id="makepdf"  >


            
   <div class="col-6">
  {{-- Subjects --}}

  <div class="row">
  

    <div class="col">
        @include('academic-admin.reports-management.cbe-report.personal_skills')

        <div class="col">
            @include('academic-admin.reports-management.cbe-report.expressive_art')
    
        </div>

    </div>
  

<div class="col">
 @include('academic-admin.reports-management.cbe-report.re')
 
<div class="row">
    <div class="col">
@include('academic-admin.reports-management.cbe-report.descriptors')
    </div>
</div>
@php

    
          
@endphp




    </div>
   
    
  </div>


  


</div>


       {{-- This is the front page --}}
    
       <div class="col-6 pt-3" style="display: inline-block;" >
  
        @foreach ($school as $school_item)

        <img src="{{$school_item->school_letter_head}}" class="img-fluid  mx-auto d-block pb-2" alt="">
    

       <h3 class=" text-center font-weight-bold ">Foundation Phase</h3>
      
        @endforeach

        @foreach ($student_details as $student_details_item)
         
        <div class="pic mx-auto" style=" width:120px; height:120px; border-radius:50%; background-image: url({{$student_details_item->student_image}}); background-position: center; background-size:100% auto; background-repeat: no-repeat;"></div>

  <p class="text-center mx-auto">
    <h6 class=" text-center">Student Name: <strong>{{$student_details_item->lastname}} {{$student_details_item->name}} {{$student_details_item->middlename}}</strong></h6>
    <h6 class=" text-center ">Personal Identification Number: <strong>{{$student_details_item->pin}} </strong></h6>
    <h6 class="text-center ">Class: <strong>{{$student_details_item->grade_name}} Report </strong></h6>

    @foreach ($academic_sessions as $session)
    <h6 class="text-center">Reporting Period: <strong>{{$session->term_name}} {{$session->academic_year}} </strong></h6>   
    @endforeach
  
    <table class="table  table-bordered table-sm">
      <thead>
        <tr>
         <center> <th colspan="4">School Calendar</th></center>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="1">Term Close&nbsp;&nbsp;Date</td>
          <td colspan="3">Next Open Date</td>
          <td colspan="3">Resolution</td>
        </tr>
        <tr>
         <td class="text-bold">{{ \Carbon\Carbon::parse($term_closing_date)->format('d F Y')}}</td>
         <td class="text-bold" colspan="3">
           @if ($next_term_date=="0000-00-00")
               Not Entered
           @else
           {{ \Carbon\Carbon::parse($next_term_date)->format('d F Y')}}  
           @endif
          
         
         </td>
         <td></td>
        </tr>
      </tbody>
      </table>
<div class="row">
  

      <div class="col">
          <div id="signaturetitle">
          Headteacher's Signature:
          </div>
          <div class="text-center">
      
            <img class="img-fluid " width="80" height="80" src="{{$school_item->base64}} " alt="">
         
          </div>               
          </div>


          <div class="col">
          <div id="signaturetitle">
          School Stamp
          </div>
          
          </div>
      </div>
<hr>
  <p class="text-justify text-small mx-auto" style="line-height: 12px;"><small> &copy {{date('Y')}} Report generated by the Shunifu Platform. Eswatini's leading school management platform, developed through the incubatory support of the Royal Science & Technology Park (RSTP)</strong></small></p>
  <hr> 
        @endforeach

    </div>
 
     </div>
      


{{-- End of Front page --}}

<div style="break-after:before"></div>     
<div class="row {{$gutter}}">
  
    <div class="col-4 pt-2">
        @include('academic-admin.reports-management.cbe-report.english')
        <div class="col">
            @include('academic-admin.reports-management.cbe-report.hpe')
        </div>
    </div>

    <div class="col-3 p-3">
        @include('academic-admin.reports-management.cbe-report.maths')

        <div class="col pt-2">
            @include('academic-admin.reports-management.cbe-report.general_studies')

            <div class="col pt-2">
                @include('academic-admin.reports-management.cbe-report.french')
            </div>
        </div>
    </div>

    <div class="col pl-2">
        @include('academic-admin.reports-management.cbe-report.siswati')
    </div>

</div>



</div>


{{-- <div> end of row --}}
  

 



</p>

<script>
document.addEventListener("DOMContentLoaded", () => {
    let printLink = document.getElementById("print");
    let container = document.getElementById("print_area");

    printLink.addEventListener("click", event => {
        event.preventDefault();
        printLink.style.display = "none";
        window.print();
    }, false);

    container.addEventListener("click", event => {
        printLink.style.display = "flex";
    }, false);

}, false);
</script>


</x-app-layout>