<?php 
include('../database.php');
include('../session.php'); 

$agencyID = isset($_GET['agencyID']);
$agencyCaption = '';
$agencyDescription = '';
$agencyContactNumber = '';
$agencyAddress = '';
$agencyStatus = '';

$result=mysqli_query($con, "SELECT * FROM tblagency WHERE AgencyID='$agencyID'") or die("ERROR!");
$numrows=mysqli_num_rows($result);



if($numrows > 0){
	while($row = mysqli_fetch_assoc($result)){
		$agencyCaption = $row['AgencyCaption'];
		$agencyDescription = $row['AgencyDescription'];
		$agencyContactNumber = $row['AgencyContactNumber'];
		$agencyAddress = $row['AgencyLocation'];
		$agencyStatus = $row['AgencyStatus'];
    $agencyAvailability = $row['AgencyAvailability'];
 	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/logo.png">
  <link rel="icon" type="image/png" href="assets/img/logo.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Edit Agency | ALERRT
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="modal fade" id="btnShowAboutTheSystem" role="dialog">
      <div class="modal-dialog modal-lg">
      
        <!-- Modal content-->
        <div class="modal-content">
        <h3 style="padding-left: 5px;"><b>About The System</b></h3><hr width="100%">
        <p style="text-align: justify; padding: 10px;">
          <b>APP-manila LOCAL EMERGENCY REPORTING AND RESPONSE TOOL (ALERRT)</b> is a way that seeks 
          to encourage the people to become proactive members of the community by increasing their awareness thereby improving resilience 
          and decreasing vulnerabilities. This will provide the citizens to have an easy means of reporting any incidents 
          (emergencies,accidents or concerns) requiring response from any local or national units, allow citizen to have detailed documentation 
          of the event (image, video capture), allow concerned government sector to act based on reported scenario and citizen can 
          track down government actions.
        </p>    
        </div>
        
      </div>
    </div>

    <div class="sidebar" data-color="orange" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="dashboard.php" class="simple-text logo-normal">
        	<?php
            $loggedInUserProfilePicUrl;

            if($session_profile_pic == ""){
              $loggedInUserProfilePicUrl = "assets/img/no-profile-pic-available.jpg";
            }else{
              $loggedInUserProfilePicUrl = $session_profile_pic;
            }

            echo '<img src=' . $loggedInUserProfilePicUrl . ' style="width: 80px; height: 70px; border-radius: 50%;"><br>';
          ?>

        	<strong><?php echo $session_fullname ?><br>
          <span style="font-size: 12px;"><?php echo $session_role ?></span>
        	</strong>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="newsfeed.php">
              <i class="material-icons">web</i>
              <p>Newsfeed</p>
            </a>
          </li>
          
          <?php
            if($session_role == "SUPER_ADMIN" || $session_role == "ADMIN"){
              echo '' .
              '<li class="nav-item active">' .
                '<a class="nav-link" href="agency.php">' .
                  '<i class="material-icons">account_balance</i>' .
                  '<p>Agency</p>' .
                '</a>' .
              '</li>' .

              '<li class="nav-item">' .
                '<a class="nav-link" href="users.php">' .
                  '<i class="material-icons">person</i>' .
                  '<p>Users</p>' .
                '</a>' .
              '</li>';
            }
          ?>

          <li class="nav-item ">
            <a class="nav-link" style="cursor: pointer;" data-toggle="modal" data-target="#btnShowAboutTheSystem">
              <i class="material-icons">info</i>
              <p>About The System</p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="../logout.php">
              <i class="material-icons">exit_to_app</i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
          	<h2>
          		<strong>
		        	<?php 
						if($session_role == "SUPER_ADMIN"){
							echo "Edit Agency";
						}else if($session_role == "ADMIN"){
							echo "Edit Sub-Agency";
						}
					?>
				</strong>
			</h2>

          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row" style="margin-left: auto; margin-right: auto;">
            <div class="col-md-12">
            	<form method="POST" action="../updateAgency.php?agencyID=<?php echo $agencyID; ?>">
			        <div class="modal-body">          
		                <div class="row">
		                  <div class="col-md-12">
		                    <div class="form-group">
		                      <label class="bmd-label-floating">Agency Name</label>
		                      <input type="text" class="form-control" name="agency_name" value="<?php echo $agencyCaption; ?>" required maxlength="50">
		                    </div>
		                  </div>

	                    <div class="col-md-12">
	                      <div class="form-group">
	                        <label class="bmd-label-floating">Agency Description</label>
	                        <textarea cols=50 rows=5 class="form-control" name="agency_description" required maxlength="1000"><?php echo $agencyDescription; ?></textarea>
	                      </div>
	                    </div>

		                  <div class="col-md-12">
		                    <div class="form-group">
		                      <label class="bmd-label-floating">Agency Contact Number</label>
		                      <input type="text" class="form-control" name="agency_contact_number" value="<?php echo $agencyContactNumber; ?>" required>
		                    </div>
		                  </div>

	                    <div class="col-md-12">
	                      <div class="form-group">
	                        <label class="bmd-label-floating">Agency Address</label>
	                        <textarea cols=50 rows=5 class="form-control" name="agency_address" required maxlength="500"><?php echo $agencyAddress; ?></textarea>
	                      </div>
	                    </div>

                      <div class="col-md-12">
                      <div class="form-group">
                        <label class="bmd-label-floating">Agency Availability</label>
                        <textarea cols=50 rows=5 class="form-control" name="agency_availability" required maxlength="500"><?php echo $agencyAvailability; ?></textarea>
                      </div>
                    </div>

		                  <div class="col-md-12">
		                    <div class="form-group">
		                      <select class="form-control" name="agency_status" required>
		                      	<option value="----CHOOSE STATUS----" disabled selected>----CHOOSE STATUS----</option>
		                      	<?php
		                      	if($agencyStatus == "Active"){
		                      		echo '<option value="Active" selected>Active</option>' .
		                      			'<option value="Inactive">Inactive</option>';
		                      	}else{
		                      		echo '<option value="Active">Active</option>' .
		                      			'<option value="Inactive" selected>Inactive</option>';
		                      	}
		                      	?>
		                      </select>
		                    </div>
		                  </div>

		                </div>
		   
		                
		                <div class="clearfix"></div>
		              
			        </div>

			        <div class="modal-footer">
			        	<button type="submit" class="btn btn-warning pull-right">
			              <?php 
			                if($session_role == "SUPER_ADMIN"){
			                  echo "Update Agency";
			                }else if($session_role == "ADMIN"){
			                  echo "Update Sub-Agency";
			                }
			              ?>
			              </button>
			        </div>
		        </form>
            </div>

          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="assets/js/plugins/arrive.min.js"></script>
  <!-- Chartist JS -->
  <script src="assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });
  </script>
</body>

</html>
