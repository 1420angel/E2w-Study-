
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

// Process form data if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape and sanitize user inputs to prevent SQL injection
    $staffName = mysqli_real_escape_string($conn, $_POST['staffName']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $emailID = mysqli_real_escape_string($conn, $_POST['emailid']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);

    // Image upload handling
    $uploadDir = 'staff_images/';
    $uploadFile = $uploadDir . basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        // Image uploaded successfully, $uploadFile contains the path to the uploaded file

        // Insert data into the database, including the image path
        $sql = "INSERT INTO staff (StaffName, Designation, Address, Username, Password, EmailID, PhoneNumber, ImagePath)
                VALUES ('$staffName', '$designation', '$address', '$username', '$password', '$emailID', '$phoneNumber', '$uploadFile')";

        if ($conn->query($sql) === TRUE) {
            echo "Record added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Failed to move the uploaded file
        echo "Error uploading file.";
    }
}

// Close the database connection
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

    <title>E2W Study - Add Staff </title>
  
	<!-- Vendors Style-->
	<link rel="stylesheet" href="../src/css/vendors_css.css">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="../src/css/style.css">
	<link rel="stylesheet" href="../src/css/skin_color.css">

</head>
<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">
	
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
					<h4 class="page-title">Add Staff Details</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="dashboard.php"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Add Staff</li>
								<li class="breadcrumb-item active" aria-current="page">Details</li>
							</ol>
						</nav>
					</div>
				</div>
				
			</div>
		</div>	  

		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Fill The Staff Details</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
				<form action="#" method="post" enctype="multipart/form-data">
						<div class="form-body">
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
									  <label class="fw-700 fs-16 form-label">Staff Name</label>
									  <input type="text" class="form-control" name="staffName" placeholder="Staff Name">
									</div>
								</div>
								<!--/span-->
							
								<!--/span-->
							</div>
							<!--/row-->


							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="fw-700 fs-16 form-label">Designation</label>
										<div class="input-group">
											
											<input type="text" class="form-control" name="designation" placeholder="Designation"> 
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="fw-700 fs-16 form-label">Address</label>
										<div class="input-group">
											
											<input type="text" class="form-control" name="address" placeholder="Address"> 
										</div>
									</div>
								</div>
								<!--/span-->
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="fw-700 fs-16 form-label">Username</label>
										<div class="input-group">
											
											<input type="text" class="form-control" name="username" placeholder="Username"> 
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="fw-700 fs-16 form-label">Password</label>
										<div class="input-group">
											
											<input type="text" class="form-control" name="password" placeholder="******"> 
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							
							<!--/row-->
							<div class="row">
							<div class="col-md-6">
									<div class="form-group">
										<label class="fw-700 fs-16 form-label">E-Mail Id</label>
										<input type="text" class="form-control" name="emailid" placeholder="Email Id"> 
									</div>
								</div>

								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="fw-700 fs-16 form-label">Phone Number</label>
										<input type="text" class="form-control" name="phonenumber" placeholder="+91 03909 3099"> </div>
								</div>
								<!--/span-->
								<div class="col-md-4">
									<h4 class="box-title mt-20">Upload Image</h4>
									<div class="University-img text-start">
										<img id="image-preview" src="../../../images/avatar/4.jpg" alt="">
										<div class="input-group my-3">
											<label class="input-group-text btn-primary" for="inputGroupFile01">Upload Image</label>
											<input type="file" class="form-control" id="inputGroupFile01" name="image" onchange="previewImage(this);">
										</div>
									</div>
								</div>
							</div>
							
						</div>
						<div class="form-actions mt-10">
							<button type="submit" class="btn btn-primary"> <i class="fa fa-check"></i> Save</button>
							<button type="button" class="btn btn-danger">Cancel</button>
						</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

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
    
  
</div>
<!-- ./wrapper -->
	
	 
	
	<!-- Page Content overlay -->
	
	
	<!-- Vendor JS -->
	<script src="../src/js/vendors.min.js"></script>
	<script src="../src/js/pages/chat-popup.js"></script>
    <script src="../../../assets/icons/feather-icons/feather.min.js"></script>	
	
	<!-- CRMi App -->
	<script src="../src/js/template.js"></script>
		
    <script src="../src/js/pages/validation.js"></script>
    <script src="../src/js/pages/form-validation.js"></script>

	<script>
    function previewImage(input) {
        var preview = document.getElementById('image-preview');
        var file = input.files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "../../../images/gallery/full/1.jpg"; // Default image path
        }
    }
</script>
	
</body>
</html>
