<?php

session_start();

// Check if the success message is set
if (isset($_SESSION['login_success'])) {
    // Display the success message using SweetAlert
    echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "Login Successful",
                    text: "' . $_SESSION['login_success'] . '",
                });
            });
          </script>';

    // Unset the session variable to prevent showing the message on page reload
    unset($_SESSION['login_success']);
}

// Your database connection code here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the count of new students registered this week
$weekStart = date('Y-m-d', strtotime('this week monday'));
$weekEnd = date('Y-m-d', strtotime('this week sunday'));

$sqlNewStudents = "SELECT COUNT(*) as newStudentsCount FROM students WHERE registration_date BETWEEN '$weekStart' AND '$weekEnd'";
$resultNewStudents = $conn->query($sqlNewStudents);

$newStudentsCount = 0;
if ($resultNewStudents !== false && $resultNewStudents->num_rows > 0) {
    $rowNewStudents = $resultNewStudents->fetch_assoc();
    $newStudentsCount = $rowNewStudents['newStudentsCount'];
}

// Query for the total number of students
$sqlTotalStudents = "SELECT COUNT(*) as totalStudentsCount FROM students";
$resultTotalStudents = $conn->query($sqlTotalStudents);

$totalStudentsCount = 0;
if ($resultTotalStudents !== false && $resultTotalStudents->num_rows > 0) {
    $rowTotalStudents = $resultTotalStudents->fetch_assoc();
    $totalStudentsCount = $rowTotalStudents['totalStudentsCount'];
}

// Query for the total number of staff
$sqlTotalStaff = "SELECT COUNT(*) as totalStaffCount FROM staff";
$resultTotalStaff = $conn->query($sqlTotalStaff);

$totalStaffCount = 0;
if ($resultTotalStaff !== false && $resultTotalStaff->num_rows > 0) {
    $rowTotalStaff = $resultTotalStaff->fetch_assoc();
    $totalStaffCount = $rowTotalStaff['totalStaffCount'];
}

// Query for the count of latest updates for today
$todayDate = date('Y-m-d');
$sqlLatestUpdates = "SELECT COUNT(*) as latestUpdatesCount FROM latest_updates WHERE DATE(created_at) = '$todayDate'";
$resultLatestUpdates = $conn->query($sqlLatestUpdates);

$latestUpdatesCount = 0;
if ($resultLatestUpdates !== false && $resultLatestUpdates->num_rows > 0) {
    $rowLatestUpdates = $resultLatestUpdates->fetch_assoc();
    $latestUpdatesCount = $rowLatestUpdates['latestUpdatesCount'];
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../images/fav.jpg">

    <title>E2W Study - Dashboard</title>
    
	<!-- Vendors Style-->
	<link rel="stylesheet" href="../src/css/vendors_css.css">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="../src/css/style.css">
	<link rel="stylesheet" href="../src/css/skin_color.css">
     
  </head>

<body class="dark-skin sidebar-mini theme-primary fixed">
	
<div class="wrapper">
	<div id="loader"></div>
	
	<?php include 'header.php'; ?>
  
    <?php include 'sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xl-3 col-md-6 col-12">
					<div class="box">
						<div class="box-body">
							<div class="d-flex justify-content-between">
								<div>
									<h4 class="text-fade">Total Students</h4>
									<h4 class="fw-600"><?php echo $totalStudentsCount; ?></h4>
									
								</div>
								<div>
									<img src="../../../images/svg-icon/color-svg/custom-24.svg" class="w-100" alt="" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-6 col-12">
					<div class="box">
						<div class="box-body">
							<div class="d-flex justify-content-between">
								<div>
									<h4 class="text-fade">New Students This Week</h4>
									<h4 class="fw-600"><?php echo $newStudentsCount; ?> </h4>
								</div>
							<div>
								<img src="../../../images/svg-icon/color-svg/custom-24.svg" class="w-100" alt="" />
						</div>
					</div>
				</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-6 col-12">
					<div class="box">
						<div class="box-body">
						<div class="d-flex justify-content-between">
								<div>
									<h4 class="text-fade">Total Staffs</h4>
									<h4 class="fw-600"><?php echo $totalStaffCount; ?></h4>
									
								</div>
								<div>
									<img src="../../../images/svg-icon/color-svg/custom-26.svg" class="w-100" alt="" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-md-6 col-12">
					<div class="box">
						<div class="box-body">
						<div class="d-flex justify-content-between">
								<div>
									<h4 class="text-fade">Latest Updates Today</h4>
									<h4 class="fw-600"><?php echo $latestUpdatesCount; ?></h4>
									
								</div>
								<div>
									<img src="../../../images/svg-icon/color-svg/custom-27.svg" class="w-100" alt="" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-12 col-12">
					
				<div class="box">
						<div class="box-header with-border">
							<h4 class="box-title">Staff List</h4>
							<div class="box-controls pull-right">
								<div class="lookup lookup-circle lookup-right">
									<input type="text" name="s">
								</div>
							</div>
						</div>
						<div class="box-body px-0 pt-0">
							<div class="table-responsive">
								<table class="table table-hover">
									<tbody>
										<tr>
											<th class="min-w-80">Img</th>
											<th>Staff. Name</th>
											<th>Des.</th>
											<th>Address</th>
											
											<th>Email</th>
											<th>Mobile</th>
										
											<th class="min-w-100">Actions</th>
										</tr>

										<?php
										// Your database connection code here
										$servername = "localhost";
										$username = "root";
										$password = "";
										$dbname = "mydatabase";

										$conn = new mysqli($servername, $username, $password, $dbname);

										if ($conn->connect_error) {
											die("Connection failed: " . $conn->connect_error);
										}

										// Fetch staff details from the database
										$sql = "SELECT * FROM staff";
										$result = $conn->query($sql);

										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												echo '<tr>';
												echo '<td><img src="' . $row["ImagePath"] . '" class="avatar avatar-lg rounded10 bg-primary-light" alt=""></td>';
												echo '<td class="text-nowrap">' . $row["StaffName"] . '</td>';
												echo '<td><span class="badge badge-danger-light">' . $row["Designation"] . '</span></td>';
												echo '<td>' . $row["Address"] . '</td>';
											
												echo '<td>' . $row["EmailID"] . '</td>';
												echo '<td>' . $row["PhoneNumber"] . '</td>';
												
												echo '<td>';
												echo '<a href="staff_list.php" class="waves-effect waves-light btn btn-sm btn-primary-light btn-circle mx-5"><span class="icon-Write"><span class="path1"></span><span class="path2"></span></span></a>';
												echo '</td>';
												echo '</tr>';
											}
										}
										$conn->close();
										?>
									</tbody>
								</table>
							</div>
						</div>
				</div>

				</div>

				<div class="col-xl-12 col-12">
					
				<div class="box">
						<div class="box-header with-border">
							<h4 class="box-title">Student  List</h4>
							<div class="box-controls pull-right">
								<div class="lookup lookup-circle lookup-right">
									<input type="text" name="s">
								</div>
							</div>
						</div>
						<div class="box-body px-0 pt-0">
							<div class="table-responsive">
								<table class="table table-hover">
									<tbody>
										<tr>
											
											<th>Stu. Name</th>
											<th>Course</th>
											<th>university</th>
											<th>Marital Status</th>
											<th>Email</th>
											<th>Mobile</th>
										
											<th class="min-w-100">Actions</th>
										</tr>

										<?php
										// Your database connection code here
										$servername = "localhost";
										$username = "root";
										$password = "";
										$dbname = "mydatabase";

										$conn = new mysqli($servername, $username, $password, $dbname);

										if ($conn->connect_error) {
											die("Connection failed: " . $conn->connect_error);
										}

										// Fetch staff details from the database
										$sql = "SELECT * FROM students";
										$result = $conn->query($sql);

										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												echo '<tr>';
												echo '<td class="text-nowrap">' . $row["FirstName"] . '</td>';
												echo '<td>' . $row["Course"] . '</td>';
												echo '<td>' . $row["University"] . '</td>';
												echo '<td><span class="badge badge-danger-light">' . $row["MaritalStatus"] . '</span></td>';
												echo '<td>' . $row["StudentEmail"] . '</td>';
												echo '<td>' . $row["CommunicationContactNo"] . '</td>';
												
												echo '<td>';
												echo '<a href="students_list.php" class="waves-effect waves-light btn btn-sm btn-primary-light btn-circle mx-5"><span class="icon-Write"><span class="path1"></span><span class="path2"></span></span></a>';
												echo '</td>';
												echo '</tr>';
											}
										}
										$conn->close();
										?>
									</tbody>
								</table>
							</div>
						</div>
				</div>

				</div>
				
			</div>							
		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
	
  <?php include 'footer.php'; ?>



  <!-- Side panel --> 

   
    
  <?php include 'quick_action.php'; ?>
  
 
  
</div>
<!-- ./wrapper -->
	

	
		
	
	
	<!-- Page Content overlay -->
	
	
	<!-- Vendor JS -->
	<script src="../src/js/vendors.min.js"></script>
	<script src="../src/js/pages/chat-popup.js"></script>
    <script src="../../../assets/icons/feather-icons/feather.min.js"></script>
	
	<script src="../../../assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
	
	<!-- CRMi App -->
	<script src="../src/js/template.js"></script>
	<script src="../src/js/pages/dashboard.js"></script>
	
</body>
</html>
