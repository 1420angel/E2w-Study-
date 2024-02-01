<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if an admin is logged in
if (isset($_SESSION["admin_id"])) {
    $adminId = $_SESSION["admin_id"];

    // Fetch admin details
    $stmt = $conn->prepare("SELECT * FROM admins WHERE admin_id = ?");
    
    // Check if the prepare statement was successful
    if ($stmt) {
        $stmt->bind_param("i", $adminId);
        
        // Execute the prepared statement
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $admin = $result->fetch_assoc();
            } else {
                // Admin not found, handle as needed (redirect, show error, etc.)
                $admin = null;
            }
        } else {
            // Handle execution error
            die("Error executing query: " . $stmt->error);
        }

        $stmt->close();
    } else {
        // Handle prepare error
        die("Error preparing query: " . $conn->error);
    }
} else {
    // Admin is not logged in, handle as needed
    $admin = null;
}

// Handle form submission for updating details
if ($_SERVER["REQUEST_METHOD"] == "POST" && $admin) {
    // Retrieve values from the form
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];

    // Update the admin details in the database using prepared statement
    $stmt = $conn->prepare("UPDATE admins SET username = ?, phone = ?, email = ?, address = ? WHERE admin_id = ?");
    
    // Check if the prepare statement was successful
    if ($stmt) {
        $stmt->bind_param("ssssi", $name, $phone, $email, $address, $adminId);
        
        // Execute the prepared statement
        if ($stmt->execute()) {
            // Refresh the admin details after update
            $stmt = $conn->prepare("SELECT * FROM admins WHERE admin_id = ?");
            $stmt->bind_param("i", $adminId);
            
            // Execute the prepared statement
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $admin = $result->fetch_assoc();
            } else {
                // Handle execution error
                die("Error executing query: " . $stmt->error);
            }

            $stmt->close();
        } else {
            // Handle execution error
            die("Error executing query: " . $stmt->error);
        }
    } else {
        // Handle prepare error
        die("Error preparing query: " . $conn->error);
    }
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
    <link rel="icon" href="../../../images/favicon.ico">

    <title>E2W Study  - Admin Profile</title>
  
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
					<h4 class="page-title">Admin Profile</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="dashboard.php"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Admin Profile</li>
							</ol>
						</nav>
					</div>
				</div>				
			</div>
		</div>

		<!-- Main content -->
		<section class="content">
			<div class="row clearfix">
				<div class="col-lg-4 col-md-12">
					<div class="box profile-header">
						<div class="box-body text-center">
						<div class="profile-image mb-30">
    <?php
    // Check if the "photo" key is set in the session
    if (isset($_SESSION["photo"])) {
        $photoPath = $_SESSION["photo"];
        echo '<img src="' . $photoPath . '" class="box-shadowed rounded-circle" alt="Admin Image">';
    } else {
        // If the "photo" key is not set, display a default image or a placeholder
        echo '<img src="../../../images/default-avatar.jpg" class="box-shadowed rounded-circle" alt="Default Image">';
    }
    ?>
</div>							<div>
							<?php
								// Check if address and phone keys are set in the session
								$address = isset($_SESSION["address"]) ? $_SESSION["address"] : 'N/A';
								$phone = isset($_SESSION["phone"]) ? $_SESSION["phone"] : 'N/A';
								?>

								<h3 class="mb-0"><strong><?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : ''; ?></strong> </h3>
								<span class="job_post"><?php echo isset($_SESSION["last_login"]) ? $_SESSION["last_login"] : ''; ?></span>
								<p class="mt-15"><?php echo $address; ?></p>
							</div>
							<div>
								
								<button class="btn btn-primary-light btn-rounded"><?php echo isset($_SESSION["phone"]) ? $_SESSION["phone"] : ''; ?></button>
							</div>
						</div>                    
					</div>                               
					        
				</div>
				<div class="col-lg-8 col-md-12">
					<div class="box box-body">
						<ul class="nav nav-tabs">
							<li class="nav-item"><a class="nav-link active show" data-bs-toggle="tab" href="#about">About</a></li>
							<li class="nav-item"><a class="nav-link show" data-bs-toggle="tab" href="#Account">Account</a></li>                        
						</ul>
						<div class="tab-content">
							<div class="tab-pane py-30 active show" id="about">
							<form  action="" method="post">
								<div class="row clearfix">
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $admin['username']; ?>">
										</div>
									</div>
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Phone No" name="phone" value="<?php echo $admin['phone']; ?>">
										</div>
									</div>                                    

									<div class="col-lg-12 col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="E-mail" name="email" value="<?php echo $admin['email']; ?>">
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group mb-10">
											<textarea rows="4" class="form-control no-resize" placeholder="Address Line 1" name="address"><?php echo $admin['address']; ?></textarea>
										</div>
									</div>
									
									<div class="col-md-12">
										<button class="mt-30 btn btn-primary btn-round" type="submit">Save Changes</button>
									</div>
								</div>
							</form>
						</div>

							<div class="tab-pane py-30 show" id="Account">
							<form action="change_password.php" method="post">
								<div class="form-group">
									<input  type="email" name="email"  class="form-control" placeholder="Email Id" required>
								</div>
								<div class="form-group">
									<input type="password" name="current_password" class="form-control" placeholder="Current Password" required>
								</div>
								<div class="form-group">
									<input type="password" class="form-control" placeholder="New Password" required>
								</div>
								<button type="submit" class="btn btn-info btn-round">Save Changes</button>
							</form>
								<hr>
								
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
  <!-- quick_actions_toggle -->
  <div class="modal modal-right fade" id="quick_actions_toggle" tabindex="-1">
	  <div class="modal-dialog">
		<div class="modal-content slim-scroll">
		  <div class="modal-body bg-white p-30">
			<div class="d-flex align-items-center justify-content-between pb-30">
				<h4 class="m-0">Quick Actions<br>
				<small class="badge fs-12 badge-primary mt-10">23 tasks pending</small></h4>
				<a href="#" class="btn btn-icon btn-danger-light btn-sm no-shadow" data-bs-dismiss="modal">
					<span class="fa fa-close"></span>
				</a>
			</div>
            <div class="row">
                <div class="col-6">
                    <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="accounting.html">
                        <i class="icon-Euro fs-36"><span class="path1"></span><span class="path2"></span></i>
                        <span class="fs-16">Accounting</span>
                    </a>
                </div>
                <div class="col-6">
                    <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="contact_userlist_grid.html">
                        <i class="icon-Mail-attachment fs-36"><span class="path1"></span><span class="path2"></span></i>
                        <span class="fs-16">Members</span>
                    </a>
                </div>
                <div class="col-6">
                    <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="projects.html">
                        <i class="icon-Box2 fs-36"><span class="path1"></span><span class="path2"></span></i>
                        <span class="fs-16">Projects</span>
                    </a>
                </div>
                <div class="col-6">
                    <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="contact_userlist.html">
                        <i class="icon-Group fs-36"><span class="path1"></span><span class="path2"></span></i>
                        <span class="fs-16">Customers</span>
                    </a>
                </div>
                <div class="col-6">
                    <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="mailbox.html">
                        <i class="icon-Chart-bar fs-36"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                        <span class="fs-16">Email</span>
                    </a>
                </div>
                <div class="col-6">
                    <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="setting.html">
                        <i class="icon-Color-profile fs-36"><span class="path1"></span><span class="path2"></span></i>
                        <span class="fs-16">Settings</span>
                    </a>
                </div>
                <div class="col-6">
                    <a class="waves-effect waves-light btn btn-app btn btn-primary-light btn-flat mx-0 mb-20 no-shadow py-35 h-auto d-block" href="ecommerce_orders.html">
                        <i class="icon-Euro fs-36"><span class="path1"></span><span class="path2"></span></i>
                        <span class="fs-18">Orders</span>
                    </a>
                </div>
			</div>
		  </div>
		</div>
	  </div>
  </div>
  <!-- /quick_actions_toggle -->    
    
 
  
  
</div>
<!-- ./wrapper -->
	

	
	
	
	
	<!-- Vendor JS -->
	<script src="../src/js/vendors.min.js"></script>
	<script src="../src/js/pages/chat-popup.js"></script>
    <script src="../../../assets/icons/feather-icons/feather.min.js"></script>
	
	<!-- CRMi App -->
	<script src="../src/js/template.js"></script>
	
	

</body>
</html>
