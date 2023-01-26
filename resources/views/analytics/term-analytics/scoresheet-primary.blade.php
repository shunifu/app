<x-app-layout>
    <x-slot name="header">
        <style>
   table, tr, td, th {
  border: 1px solid #000;
  position: relative;
  padding: 16px;
  }
  
  th span {
    position: absolute;
  top: 100%;
  left: 50%;
  transform: rotate(-90deg) translateY(-50%);
  transform-origin: 0 0;
  }
  .red {
  background-color: red !important;
  }
  
        </style>
  
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.6.0/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/r-2.3.0/sb-1.3.3/datatables.min.css"/>
   
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.6.0/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/r-2.3.0/sb-1.3.3/datatables.min.js"></script>
  
  
    </x-slot>
   
    <table class="table table-sm table-hover mx-auto table-bordered " style="width:100%" id="customers">
      <div class="col-md-12 mx-auto">
  
          @foreach (\App\Models\School::all() as $item)
          <div class="mx-auto text-center">
  
        
          <div class="row mx-auto" style="width: 300px; display:block">
              <div class="col"><img src={{$item->school_letter_head}}  /></div>
          </div>
         
                  <p>
                      <h3 class="text-bold">{{$title}} Term Scoresheet</h3>
                  </p>
              
          </div>
         
          @endforeach
        
          </div>
    </table>       
    @forelse($scoresheet as $student)
  
  @php
  
  $db=mysqli_connect(env("DB_HOST"),env("DB_USERNAME"),env("DB_PASSWORD"),env("DB_DATABASE")) or die ("Connection failed!");
  
  
  // $tie_type=$pass_rate->tie_type;



  
  //check if allocations have  been added//
  
  if ($type_key=="stream_based") {

$sql_piece="AND term_averages.student_stream=".$stream."";
$sql_piece2="grades.stream_id IN (".$stream.")";

 } else {
    $sql_piece="AND term_averages.student_class=".$int."";
    $sql_piece2="student_subject_averages.student_class = ".$int."";
 }
  

  
  if($tie_type=="share_n_+_1"){
    $result = $db->multi_query("SET @sql = NULL;
      SELECT
        GROUP_CONCAT(DISTINCT
          CONCAT(
            'MAX(IF(subjects.subject_name = ''',
        subject_name,
        ''', student_subject_averages.student_average, NULL)) AS ',
        replace(subjects.subject_name, ' ', '')
          )
        ) INTO @sql
         FROM student_subject_averages INNER JOIN teaching_loads ON teaching_loads.id=student_subject_averages.teaching_load_id INNER JOIN subjects ON subjects.id=teaching_loads.subject_id INNER JOIN allocations ON allocations.subject_id=teaching_loads.subject_id  INNER JOIN grades ON grades.id=allocations.grade_id WHERE grades.stream_id=".$stream.";
         
         SET @sql = CONCAT('SELECT 
(select t.student_position
from (select term_averages.student_id,term_averages.student_average, rank() over (order by term_averages.student_average desc) as student_position
from term_averages INNER JOIN term_averages a ON a.student_id=term_averages.student_id where term_averages.term_id=".$term." ".$sql_piece."
     ) t
where t.student_id = term_averages.student_id) as Position,


         
  
          grades.grade_name as Grade,
         
          concat(users.name, users.lastname) as name,
          term_averages.final_term_status as Status,
          term_averages.student_average as Average,

          
        
  ', @sql,'
  FROM student_subject_averages 
  INNER JOIN teaching_loads ON teaching_loads.id=student_subject_averages.teaching_load_id 
  INNER JOIN term_averages ON term_averages.student_id=student_subject_averages.student_id 
  INNER JOIN subjects ON teaching_loads.subject_id=subjects.id 
  INNER JOIN users ON users.id=student_subject_averages.student_id  
  INNER JOIN grades_students ON grades_students.student_id=student_subject_averages.student_id
  INNER JOIN grades ON student_subject_averages.student_class=grades.id 
  INNER JOIN streams ON grades.stream_id=streams.id 
  WHERE ".$sql_piece2." AND student_subject_averages.term_id=".$term."  AND teaching_loads.active=1  AND grades.id=student_subject_averages.student_class AND grades_students.active=1  AND users.active=1 
  GROUP BY term_averages.student_id  
  ORDER BY term_averages.student_average DESC');
  
  PREPARE stmt FROM @sql;
  EXECUTE stmt;
  
  DEALLOCATE PREPARE stmt");
  }

  
  @endphp
  @endforeach
  
  <div class="row">
    <div class="col-md-12">
      <div class="card card-light">
          <div class="p-3 no-print">
            <a href="javascript:history.back()" class="btn btn-success">Back </a>
          </div>
          
          <div class="card-header no-print">
            <h3 class="card-title">Stream Analytics</h3>
          </div>
        
        <div class="card-body">
  
          <div class='table-responsive'>
            <table class="table table-sm table-hover mx-auto table-bordered " style="width:100%" id="customers">
             
  
    @php
  
  
  if ($err=mysqli_error($db)) { echo $err."<br><hr>"; }
  
  if ($result) {
    do {
    //  dd($res = $db->store_result());
  
    if ($res = $db->store_result()) {
       
  
      echo "<thead class='head-light hidden-md-up'></tr>\n";
        for($i=0; $i<mysqli_num_fields($res); $i++)
        
        {
            $field = mysqli_fetch_field($res);
         
            echo '<th class="thead-light"><span>'.$field->name.'</span></th>';
        }
        echo "</tr></thead>\n";
      
        // printing table rows
        echo "<tbody>";
        while($row = $res->fetch_row())
        {
            echo "<tr>";
            foreach($row as $cell) {
            //  dd($row[0]);
              if ($cell === NULL) { $cell = '-'; }
              
              
              echo "<td class='align-middle'>".$cell."</td>";
            }
            echo "</tr>";
        }
        $res->free();
        
        
      }
     
    } while ($db->more_results() && $db->next_result());
    echo "</tbody>";
  }
  
  @endphp
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  @php
  $db->close();
  @endphp
  
  
  <script>
    $(document).ready(function () {
        $.noConflict();
        var assessement = "jhjhjh";
        var stream = "jkjk";
        var base64="jkkj";
        var dateNow = new Date();
        var docDefinition = {
  watermark: { text: 'test watermark', color: 'blue', opacity: 0.3, bold: true, italics: false },
  content: [
  '...'
  ]
  };
  
  $('#customers').append('<caption style="margin-bottom:30px; fontSize:23px;">Shunifu a product of Innovazania. Proudly Made in Eswatini, Africa</caption>');
  
        $('#customers').DataTable({
            // scrollY:auto,
            scrollCollapse: true,
            paging: false,
            //scrollX: true,
            info: true,
            dom: 'Bfrtip',
            select: true,
  
            stateSave: true,
  autoWidth: true,
  
  buttons: [
  
    {
        extend: 'colvis',
        collectionLayout: 'fixed columns',
        collectionTitle: 'Column visibility control'
    },
  {
  
    
  
   
  
    extend: 'pdfHtml5',
   
   exportOptions: {
           columns: ':visible',
            alignment: 'center',
                          search: 'applied',
                          order: 'applied'
       },
     
   
      
    // extend: 'pdfHtml5',  
  //   'colvis',
    title: assessement+' '+stream+' '+'Scoresheet',  
    customize: function (doc) {
  //             doc.content[1].table.body[0].forEach(function (h) {
  //     h.fillColor = 'green';
  //     alignment: 'center'
  // });
  doc.styles.title = {
  color: '#2D1D10',
  fontSize: '30',
  alignment: 'center',
  // font-weight: bold;
  
  }
    },  
    orientation: 'landscape',
    pageSize: 'A2',
    header: true,
    text:'Generate PDF',
   
    filename:assessement+'_'+stream+'_scoresheet',
    messageTop:dateNow,
    pageMargins: [ 0, 0, 0, 0 ],
    margin: [ 0, 0, 0, 0 ],
    
    pageBreakBefore: function(currentNode, followingNodesOnPage, nodesOnNextPage, previousNodesOnPage) {
  return currentNode.headlineLevel === 1 && followingNodesOnPage.length === 0;
  },
    
   
  
   
  
  },
  
  
  
  
  {
     extend: 'excel',
     exportOptions: {
            columns: ':visible',
             alignment: 'center'
        },
        customize: function ( xlsx ){
        var sheet = xlsx.xl.worksheets['sheet1.xml'];
  
        // jQuery selector to add a border
        // $('row:first c', sheet).attr('s', '7');
        // $('c[r=A1] t', sheet).text( stream );
  
  
  
  var table = $('#customers').DataTable();
  var thead = table.table().header();
  
  var titles = [];
  
  $(thead).find('th').each(function(){
  titles.push($(this).text());
  });
  
  //     $(thead).find('th').each(function(){
  //         $(this).attr('s', '40');
  // });
  
  console.log(titles);
  
  
  
  
    },
  },
  
  
  ],
  
        });
        {
    extend: 'pdfHtml5',
  //    orientation: 'landscape',
  //    pageSize: 'TABLOID', // TABLOID OR LEGAL
  //    footer: true,
  }
  
  
  
    })
  
  </script>
  
  <script>
   $(function() {
  var header_height = 0;
  $('table th span').each(function() {
  if ($(this).outerWidth() > header_height) header_height = $(this).outerWidth();
  });
  
  $('table th').height(header_height);
  });
  </script>
  
  
  </x-app-layout>
  