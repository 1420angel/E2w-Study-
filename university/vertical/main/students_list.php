<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../images/fav.jpg">

    <title>E2W Study - Student Details</title>
  
	<!-- Vendors Style-->
	<link rel="stylesheet" href="../src/css/vendors_css.css">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="../src/css/style.css">
	<link rel="stylesheet" href="../src/css/skin_color.css">	

</head>
<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">
<!-- Site wrapper -->
<div class="wrapper">
	<div id="loader"></div>

	<?php include 'header.php'; ?>
  
  <?php include 'sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="me-auto">
					<h4 class="page-title">Students Application Details</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="dashboard.php"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Students Applications</li>
							</ol>
						</nav>
					</div>
				</div>				
			</div>
		</div>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-sm-12">
					<div class="box">
						<div class="box-body">
						<?php

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Fetch expense details from the database
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

echo '<div class="table-responsive">';
echo '<table id="example" class="table table-center table-hover datatable">';
echo '<thead class="thead-light">';
echo '<tr>';
echo '<th>Name</th>';
echo '<th>Course</th>';
echo '<th>University</th>';
echo '<th>Email Id</th>';
echo '<th>Contact No</th>';
echo '<th>Marital Status</th>';
echo '<th class="text-end">Action</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["FirstName"] . '</td>';
        echo '<td>' . $row["Course"] . '</td>';
        echo '<td>' . $row["University"] . '</td>';
        echo '<td>' . $row["StudentEmail"] . '</td>';
		echo '<td>' . $row["CommunicationContactNo"] . '</td>';
        echo '<td><span class="badge badge-pill bg-success-light">' . $row["MaritalStatus"] . '</span></td>';
      
      
		echo '<td>';												
		echo '<div class="btn-group">
		  <a class="hover-primary dropdown-toggle no-caret" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
		  <div class="dropdown-menu">
		  <a class="dropdown-item" href="students.php?studentID=' . $row["StudentID"] . '"><i class="fa fa-info-circle me-5"></i>View Details</a>
		  <a class="dropdown-item" href="edit_page.php?studentID=' . $row["StudentID"] . '"><i class="fa fa-edit me-5"></i>Edit</a>
		  <a class="dropdown-item" href="#" onclick="deleteStudent(' . $row["StudentID"] . ')"><i class="fa fa-trash me-5"></i>Delete</a>
		</div>
		</div>
	</td>';
       
        echo '</tr>';
    }
} else {
    echo '<tr>';
    echo '<td colspan="7">No expenses found</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</div>';

// Close the database connection
$conn->close();
?>

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

  <!-- quick_actions_toggle -->
  <?php include 'quick_action.php'; ?>
  <!-- /quick_actions_toggle -->    
  
	
	<!-- Page Content overlay -->
	
	
	<!-- Vendor JS -->
	<script src="../src/js/vendors.min.js"></script>
	<script src="../src/js/pages/chat-popup.js"></script>
    <script src="../../../assets/icons/feather-icons/feather.min.js"></script>
       
	<script src="../../../assets/vendor_components/datatable/datatables.min.js"></script>
	
	<!-- CRMi App -->
	<script src="../src/js/template.js"></script>
	<script src="../src/js/pages/data-table.js"></script>
	
	

</body>
</html>


