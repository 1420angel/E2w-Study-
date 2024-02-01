<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../images/fav.jpg">

    <title>E2W Study - Latest Updates </title>
  
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
					<h4 class="page-title">View and Upload Latest Updates</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="dashboard.php"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Latest</li>
								<li class="breadcrumb-item active" aria-current="page">Updates</li>
							</ol>
						</nav>
					</div>
				</div>
				
			</div>
		</div>

		<!-- Main content -->
		<section class="content">	

		
		  <!-- /.row -->

		 

		  <div class="row">
		
			<div class="col-lg-12 col-12">
				<div class="box">
				<div class="box-header">
   					 <h4 class="box-title">Latest Updates</h4>
					
					<button type="button" class="btn btn-primary float-end m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
   					 Delete
					</button>
					<button type="button" class="btn btn-primary float-end m-2" onclick="editDetails()">
    					Edit
					</button>
					<button type="button" class="btn btn-primary float-end m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
   					 Add Latest Updates
					</button>
				</div>

					<!-- /.box-header -->
					<div class="box-body">				  
    <!-- Place somewhere in the <body> of your page -->
    <div class="flexslider2">
        <ul class="slides">
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

            // Fetch image paths from the database
            $sql = "SELECT image_path, title FROM latest_updates";
            $result = $conn->query($sql);
            
            if ($result !== false && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li data-thumb="' . $row["image_path"] . '">';
                    echo '<img src="' . $row["image_path"] . '" alt="slide" />';
                    echo '<div class="slider-title" style="color:royalblue;font-size:30px;font-weight:800">' . $row["title"] . '</div>';
                    echo '</li>';
                }
            } else {
                echo 'No Latest Updates found.';
            }
            
            $conn->close();
            ?>
        </ul>
    </div>
</div>


					<!-- /.box-body -->
				  </div>  
			</div> 
			
			
			<!-- /.col -->
		  </div>
		  <!-- /.row -->


		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
  
   
  <?php include 'footer.php'; ?>

  <!-- Side panel --> 
  <?php include 'quick_action.php'; ?>
    
  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Your image upload form goes here -->
               <!-- Your form in the modal -->
			   <form action="upload_image.php" method="post" enctype="multipart/form-data">
					<label for="title">Title:</label>
					<input type="text" name="title" id="title" class="form-control mb-3" required>
					
					<label for="imageUpload">Choose Image:</label>
					<input type="file" name="imageUpload" id="imageUpload" class="form-control mb-3" required>
					
					<button type="submit" class="btn btn-primary">Upload</button>
				</form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
  
  
  
</div>
<!-- ./wrapper -->
	

	
	
	
	<!-- Page Content overlay -->
	
	
	<!-- Vendor JS -->
	<script src="../src/js/vendors.min.js"></script>
	<script src="../src/js/pages/chat-popup.js"></script>
    <script src="../../../assets/icons/feather-icons/feather.min.js"></script>	<script src="../../../assets/vendor_plugins/bootstrap-slider/bootstrap-slider.js"></script>
	<script src="../../../assets/vendor_components/OwlCarousel2/dist/owl.carousel.js"></script>
	<script src="../../../assets/vendor_components/flexslider/jquery.flexslider.js"></script>
	
	<!-- CRMi App -->
	<script src="../src/js/template.js"></script>
	
	<script src="../src/js/pages/slider.js"></script>
	
	
</body>
</html>
