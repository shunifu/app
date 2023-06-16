<x-app-layout>
    <x-slot name="header">
        <style>
            .profile-head {
                transform: translateY(5rem)
            }

            .cover {
                background-image: url(https://res.cloudinary.com/innovazaniacloud/image/upload/v1637780425/pexels-photo-5905710_pjgdj9.jpg);
                background-size: cover;
                background-repeat: no-repeat
            }

        </style>



<style type="text/css">
          

    .table {
border: 0.5px solid grey;
table-layout: fixed;
}
.table-bordered > thead > tr > th,
.table-bordered > tbody > tr > th,
.table-bordered > tfoot > tr > th,
.table-bordered > thead > tr > td,
.table-bordered > tbody > tr > td,
.table-bordered > tfoot > tr > td {
border: 0.3px solid rgb(35, 35, 35);
}

    
  input,select{
    color:black;
    }
    #img{
    width: 100px;
    height:auto;
    }
    th {
    background-color: {{$variable->column_color}};
    color: rgb(255, 255, 255);
    text-align: center;
    } 
    @media print {
    tr {
    
    }}

    @media print{
        @page { margin: 0px; }
body { margin: 0px; }
    }

    @media print {
    th.background {
        font-size: {{$variable->font_size}};
    background-color: {{$variable->column_color}} !important;
    -webkit-print-color-adjust: exact; 
    color: #FFFFFF !important;

    
    
    }

    .table th#assessement {
width: 5%;
width: fit-content;
}

    /* .table td#fit, 
.table th#fit {

width: 6%;

text-align: center;
}

.table td#ft{

}

.table td#f{
white-space: nowrap;
width: 6%;
text-align: center;
} */


}

    @media all {
.page-break { display: none; }

}

@media print {
.page-break { display: block; page-break-before: always; }
}
#signaturetitle {
font-weight: bold;
text-align: center;

}

#signature {
width: 100%;
border: 0px;
border-bottom: 1px solid black;
/* height: 30px; */
}

table tbody tr td {

font-size:{{$variable->font_size}};
}


</style>
 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/colreorder/1.5.6/css/colReorder.bootstrap4.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.bootstrap4.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.css"/>

    </x-slot>

    

            @include('partials.marks-header')


            <div class="mb-4">

            </div>

            <div class="col-md-12 ">
                <div class="card card-light   elevation-3">
                    <div class="card-header d-print-none">
                        <a href="/marks/my-scoresheet">
                            <h3 class="card-title p4 m-3"><i class="fas fa-hand-point-left mr-2"></i> Back </h3>

                            <button class="btn btn-primary" onclick="window.print()" id="print_report">Print</button>
                        </a>
                    </div>
                    <div class="card-body">
                        <p class="text-gray-700 mb-1 2h-base">
                           {{\Spatie\Emoji\Emoji::waving_hand()}}{{ Auth::user()->name }}.  This is a subject register  for <span class="text-bold"> {{ $subject_description->subject_name }}</span> marks for students in the following class(es).
                            <ul> 
                             @foreach ($loads_description as $item)
                            <li><span class="text-bold">{{ $item->grade_name }}</span></li>
                            @endforeach
                         
                            </ul>
                       
                            @php

// dd(implode(",",$loads));

$db=mysqli_connect(config("app.DB_HOST"),config("app.DB_USERNAME"),config("app.DB_PASSWORD"),env("DB_DATABASE")) or die ("Connection failed!");
$result = $db->multi_query("SET @sql = NULL;
SET SESSION group_concat_max_len = 1000000;
    SELECT
      GROUP_CONCAT(DISTINCT
        CONCAT(
          'MAX(IF(assessements.id = ''',
      assessements.id,
      ''', marks.mark, NULL)) AS ',
      replace(assessement_name, ' ', '') 
        )ORDER BY assessement_name ASC
      ) INTO @sql
from marks  INNER JOIN assessements ON assessements.id=marks.assessement_id 
  WHERE assessements.id IN (".implode(",",$assessement).");
SET @sql = CONCAT('SELECT 
    users.lastname as Surname,  users.name as Name,  users.middlename as Middlename, 
  
    ', @sql, ',
      ROUND(AVG(marks.mark)) as Average,
      marks.effort_grade as EffortGrade,
      marks.id as code
    from marks 
    INNER JOIN assessements ON assessements.id = marks.assessement_id
    INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id
    INNER JOIN users ON users.id = marks.student_id
    WHERE marks.teaching_load_id IN (".implode(",",$loads).") 
    AND marks.active=1 AND teaching_loads.id=marks.teaching_load_id AND marks.assessement_id IN (".implode(",",$assessement).")
    GROUP BY marks.student_id
   	order by users.lastname, users.name');
    PREPARE stmt FROM @sql;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;");

    

if ($err=mysqli_error($db)) { echo $err."<br><hr>"; }
if ($result) {
  do {
  if ($res = $db->store_result()) {


      echo "<form action='/update/marks-data'   csrf_field('post') ><table  id='marks_table' class='table table-compact table-bordered table-hover table-sm table-striped '> <tr>";

        ;
    
      // printing table headers
      for($i=0; $i<mysqli_num_fields($res); $i++)
      {
          $field = mysqli_fetch_field($res);

          echo "<th class='background' id='assessement'>{$field->name}</th>";
      }
      echo "</tr>\n";


      // printing table rows
      while($row = $res->fetch_assoc())
      {

    echo "<tr>";
          foreach($row as $cell=>$value) {
     

        
  


        if (htmlspecialchars($value) < $pass_rate) {
        $class = 'class=text-danger';
     
    } else {
        $class = 'class=text-black';
    }
         if ($cell === "EffortGrade") {echo '<input type="hidden" value="'.$row['code'].'"  name="code[]">';  $value = '<input type="text" value="'.$value.'" class="form-control"  min="0" max="2" name="effort_grade[]">'; }

         if($cell==="code"){

            $value= ' ';

         }

    
        
            if ($value === NULL) { $value = '-'; }


            if(is_numeric($value)){$percentage="%";}else{$percentage=" ";}
             
            echo "<td $class>$value"."$percentage</td>";
          }
          echo "</tr>\n";
      }
      $res->free();

      echo "</table>";
      echo " <div class='card-footer'> <button type='submit' class='btn btn-success'>Update Marks Data</button></div>";
      echo "</form>";

      

    }
  } while ($db->more_results() && $db->next_result());
}
$db->close();

@endphp
    

                          
                    </div>
                </div>
            </div>

            

    </div>
    </div>
  
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.5.6/js/dataTables.colReorder.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.js"></script>
    
    <script type="text/javascript">

    $(document).ready(function () {
      jQuery.noConflict();

        $('#marks_table').DataTable({
    // scrollY:auto,
    scrollCollapse: true,
    "columnDefs": [
        {
            "width": "10%",
            "targets": 0
        }
    ],
    paging: false,
    //scrollX: true,
    info: true,
    dom: 'Bfrtip',
    select: true,
});

document.addEventListener('DOMContentLoaded', function () {
    let table = new DataTable('#marks_table');
});

        
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



 
 
});

    </script>

</x-app-layout>
