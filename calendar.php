<?php include 'controller/functions.php'; ?>
<!DOCTYPE html>
<html>
 <head>
  <title>Alhassan Alai Wunpini | TODO CRUD SYSTEM</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <link rel="stylesheet" href="vendors/datatable/css/buttons.dataTables.min.css" />
  <link rel="stylesheet" href="css/style.css" />

  <!-- For exporting --->
  <script type="text/javscript" src="js/tableExport.js"></script>
  <script type="text/javscript" src="js/jquery.base64.js"></script>

  <!-- themefy CSS -->
  <link rel="stylesheet" href="vendors/themefy_icon/themify-icons.css" />
    <!-- select2 CSS -->
    <link rel="stylesheet" href="vendors/niceselect/css/nice-select.css" />
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="vendors/owl_carousel/css/owl.carousel.css" />
    <!-- gijgo css -->
    <link rel="stylesheet" href="vendors/gijgo/gijgo.min.css" />
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="vendors/font_awesome/css/all.min.css" />
    <link rel="stylesheet" href="vendors/tagsinput/tagsinput.css" />

     <!-- scrollabe  -->
     <link rel="stylesheet" href="vendors/scroll/scrollable.css" />
    <!-- datatable CSS -->
    <link rel="stylesheet" href="vendors/datatable/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="vendors/datatable/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="vendors/datatable/css/buttons.dataTables.min.css" />
   
    <!-- morris css -->
    <link rel="stylesheet" href="vendors/morris/morris.css">
    <!-- metarial icon css -->
    <link rel="stylesheet" href="vendors/material_icon/material-icons.css" />

    <!-- menu css  -->
    <link rel="stylesheet" href="css/metisMenu.css">

    <!--Full calendar widget script-->
<?php
include('controller/db.php');
$query = $conn->query("SELECT * FROM events ORDER BY id");
?>
  <script>
    $(document).ready(function() {
     var calendar = $('#calendar').fullCalendar({
        Boolean, default: true, 
      editable:true,
      header:{
       left:'prev,next today',
       center:'title',
       right:'month,agendaWeek,agendaDay'
      },
      events: [<?php while ($row = $query ->fetch_object()) { ?>{ id : '<?php echo $row->id; ?>', title : '<?php echo $row->title; ?>', start : '<?php echo $row->start_event; ?>', end : '<?php echo $row->end_event; ?>', }, <?php } ?>],
      selectable:true,
      selectHelper:true,
      select: function(start, end, allDay)
      {
      var title = prompt("Enter Event Title");
      var description = prompt("Enter description"); 
      if(title && description)
      {
        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
        $.ajax({
        url:"controller/insert.php",
        type:"POST",
        data:{title:title, description:description, start:start, end:end},
        success:function(data)
        {
          calendar.fullCalendar('refetchEvents');
          alert("Added Successfully");
          window.location.replace("index.php");
        }
        })
      }
      },
 
      editable:true,
      eventResize:function(event)
      {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url:"controller/update.php",
        type:"POST",
        data:{title:title, start:start, end:end, id:id},
        success:function(){
        calendar.fullCalendar('refetchEvents');
        alert('Event Update');
        }
      })
      },
 
      eventDrop:function(event)
      {
      var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
      var title = event.title;
      var id = event.id;
      $.ajax({
        url:"controller/update.php",
        type:"POST",
        data:{title:title, start:start, end:end, id:id},
        success:function()
        {
        calendar.fullCalendar('refetchEvents');
        alert("Event Updated");
        }
      });
      },
 
      eventClick:function(event)
      {
      if(confirm("Are you sure you want to remove it?"))
      {
        var id = event.id;
        $.ajax({
        url:"controller/delete.php",
        type:"POST",
        data:{id:id},
        success:function()
        {
          calendar.fullCalendar('refetchEvents');
          alert("Event Removed");
        }
        })
      }
      },
 
    });

  });
</script>

<!--full calendar end -->
 </head>
 <body class="crm_body_bg">

 <!-- sidebar part here -->
<nav class="sidebar vertical-scroll  ps-container ps-theme-default ps-active-y">
    <div class="logo d-flex justify-content-between">
        <a href="#"><img src="#" alt="">Alhassan Alai Wunpini</a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li class="mm-active">
          <a class="has-arrow"  href="#"  aria-expanded="false">
          <!-- <i class="fas fa-th"></i> -->
          <div class="icon_menu">
              <img src="img/menu-icon/dashboard.svg" alt="">
        </div>
            <span>Dashboard</span>
          </a>
        </li>
      </ul>
    
</nav>
<!-- sidebar part end -->

<section class="main_content dashboard_part large_header_bg">
    <!-- menu  -->
    <div class="container-fluid no-gutters">
       
    </div>
    <!--/ menu  -->

    <div class="main_content_iner ">
        <div class="container-fluid p-0 ">
            <div class="row ">
                <div class="col-lg-12">
                    <div class="single_element">
                        <div class="quick_activity">
                            <div class="row">
                                <div class="col-12">
                                    <div class="quick_activity_wrap">
                                        
                                        <!-- single_quick_activity  -->
                                        <div class="single_quick_activity">
                                            <div class="count_content">
                                                <p>Pending Tasks</p>
                                                <h3><span class="counter"><?php echo tasks_status('pending'); ?></span> </h3>
                                            </div>
                                            <a href="#" class="notification_btn yellow_btn">pending</a>
                                            <div id="bar2" class="barfiller">
                                                <div class="tipWrap">
                                                    <span class="tip"></span>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <!-- single_quick_activity  -->
                                        <div class="single_quick_activity">
                                            <div class="count_content">
                                                <p>Completed Tasks</p>
                                                <h3><span class="counter"><?php echo tasks_status('completed'); ?></span> </h3>
                                            </div>
                                            <a href="#" class="notification_btn green_btn">completed</a>
                                            <div id="bar3" class="barfiller">
                                                <div class="tipWrap">
                                                    <span class="tip"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single_quick_activity  -->
                                        <div class="single_quick_activity">
                                            <div class="count_content">
                                                <p>Failed Tasks</p>
                                                <h3><span class="counter"><?php echo tasks_status('failed'); ?></span></h3>
                                            </div>
                                            <a href="#" class="notification_btn danger_btn">failed</a>
                                            <div id="bar4" class="barfiller">
                                                <div class="tipWrap">
                                                    <span class="tip"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Event Creator</h3>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="white_card_body p-0">
                        <div id="calendar"></div>
                           
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30 QA_section">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">To-Do History</h3>
                                </div>

                                <div id="filters" class="single_wrap_input">
                                    <select name="fetchval" id="fetchval" class="nice_Select2 wide">
                                      <option value="" disabled="" selected="">Select Filter</option>
                                      <option value="failed">Failed</option>
                                      <option value="pending">Pending</option>
                                      <option value="completed">Completed</option>
                                    </select>
                                </div>

                                <div>
                                  <input type="submit" class="btn btn-info" id="btnPdfExport" value="Export PDF" />

                                  <button class="btn btn-info" id="exportxml">Export XML</button>
                                </div>
                               
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="QA_table table-responsive tablecontainer">
                                <!-- table-responsive -->
                                <table class="table pt-0" id='eventHistory'>
                                    <thead>
                                        <tr>
                                            <th scope="col">Event Title</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Start Date/Time</th>
                                            <th scope="col">End Date/Time</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $history_query = mysqli_query($conn, "SELECT * FROM events"); 
                                        while($history = mysqli_fetch_array($history_query)){
                                          $main_id = $history['id']; 
                                            echo ' <tr>
                                            <td>'.$history['title'].'</td>
                                           <td class="nowrap">'.$history['description'].'</td>
                                         
                                           <td>'.$history['status'].'</td>
                                           <td>'.$history['start_event'].'</td>
                                           <td>'.$history['end_event'].'</td>
                                           <td><select name="changestatus" id="changestatus" class="nice_Select2 wide" data-rowId="'.$main_id.'">
                                                  <option value="" disabled="" selected="">Change Status</option>
                                                  <option value="failed">Failed</option>
                                                  <option value="pending">Pending</option>
                                                  <option value="completed">Completed</option>
                                                </select>
                                            </td>
                                       </tr>';
                                        }
                                      ?>
          
                                       
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="back-top" style="display: none;">
    <a title="Go to Top" href="#">
        <i class="ti-angle-up"></i>
    </a>
</div>


    <!-- footer part -->
<div class="footer_part">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer_iner text-center">
                    <p>2020 © Alhassan Alai Wunpini - Designed by <a href="https://www.alai.altechinferno.com"> <i class="ti-heart"></i> </a><a href="#"> Alai Wunpini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
  
  


<!-- main content part end -->

<!--PDF Export Script-->
<script type="text/javascript">
        $("body").on("click", "#btnPdfExport", function () {
            html2canvas($('#eventHistory')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("event-data.pdf");
                }
            });
        });
    </script>
<!--PDF EXport end -->


<!-- Filter Script -->
    <script type="text/javascript">
      $(document).ready(function(){
        $("#fetchval").on('change', function(){
          var value = $(this).val(); 
          //alert(value); 

          $.ajax({
           url:"controller/fetchfilter.php", 
           type:"POST", 
           data:'request=' + value,
           beforeSend:function(){
             $(".tablecontainer").html("<span>Working...</span>"); 

           },
            success:function(data){
              $('#eventHistory').load(" #eventHistory > *");

            }
          });
        }); 
      });
    </script>

     <!--change status --->
     <script type="text/javascript">
      $(document).ready(function(){
        $("#changestatus").on('change', function(){
          var value = $(this).val();
          var rowid = $(this).attr('data-rowId');  
          // var rowid = $(this).getAttribute('data-rowId');
          //alert(rowid); 

          $.ajax({
           url:"controller/functions.php", 
           type:"POST", 
           data:{value:value,rowid:rowid},
            success:function(data){
              $(".tablecontainer").html(data); 
            }
          });
        }); 
      });
     
    </script>

   
<!-- responsive table -->
<script src="vendors/datatable/js/jquery.dataTables.min.js"></script>
<script src="vendors/datatable/js/dataTables.responsive.min.js"></script>
<script src="vendors/datatable/js/dataTables.buttons.min.js"></script>
<script src="vendors/datatable/js/buttons.flash.min.js"></script>
<script src="vendors/datatable/js/jszip.min.js"></script>
<script src="vendors/datatable/js/pdfmake.min.js"></script>
<script src="vendors/datatable/js/vfs_fonts.js"></script>
<script src="vendors/datatable/js/buttons.html5.min.js"></script>
<script src="vendors/datatable/js/buttons.print.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

<script src="vendors/datatable/js/buttons.html5.min.js"></script>
<script src="vendors/datatable/js/buttons.print.min.js"></script>

<!-- scrollabe  -->
<script src="vendors/scroll/perfect-scrollbar.min.js"></script>
<script src="vendors/scroll/scrollable-custom.js"></script>

<!-- sidebar menu  -->
<script src="js/metisMenu.js"></script>
<!-- popper js -->
<script src="js/popper.min.js"></script>

 </body>
</html>