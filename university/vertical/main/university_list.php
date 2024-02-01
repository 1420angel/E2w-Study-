<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../images/fav.jpg">

    <title>E2W Study - University List</title>
  
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
					<h4 class="page-title">University List</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="dashboard.php"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">University List</li>
							</ol>
						</nav>
					</div>
				</div>				
			</div>
		</div>

		<!-- Main content -->
		<section class="content">
			<div class="row">
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

// Fetch data from the universities table
$sql = "SELECT * FROM universities";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo '<div class="row">';
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-6 col-lg-6">';
        echo '<div class="box overflow-hidden">';
        echo '<img class="img-responsive" alt="university" src="' . $row["ImagePath"] . '">';
        echo '<div class="box-body">';
        echo '<h4 class="box-title fw-500">' . $row["UniversityName"] . '</h4>';
        echo '<p><span><i class="ti-user me-10"></i> Course Duration: ' . $row["CourseDuration"] . '</span></p>';
        echo '<p><span><i class="fa fa-map-marker me-10"></i> Locations:  ' . $row["Locations"] . '</span></p>';
        echo '<p><span><i class="fa fa-graduation-cap me-10"></i> Tution Fees:  ' . $row["TutionFees"] . '</span></p>';
        
        // Dropdown button
        echo '<div class="btn-group">';
        echo '<button type="button" class="btn btn-primary waves-effect waves-light mt-10" data-bs-toggle="modal" data-bs-target="#detailsModal' . $row["UniversityID"] . '">More Details</button>';
        echo '<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        echo '<span class="visually-hidden">Toggle Dropdown</span>';
        echo '</button>';
        echo '<ul class="dropdown-menu">';
        echo '<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editModal' . $row["UniversityID"] . '">Edit</a></li>';
        echo '<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal' . $row["UniversityID"] . '">Delete</a></li>';
        echo '</ul>';
        echo '</div>';
        
        echo '</div>';
        echo '</div>';
        echo '</div>';

   // Edit Modal
echo '<div class="modal fade" id="editModal' . $row["UniversityID"] . '" tabindex="-1" aria-labelledby="editModalLabel' . $row["UniversityID"] . '" aria-hidden="true">';
echo '<div class="modal-dialog">';
echo '<div class="modal-content">';
echo '<div class="modal-header">';
echo '<h5 class="modal-title" id="editModalLabel' . $row["UniversityID"] . '">Edit University</h5>';
echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
echo '</div>';
echo '<div class="modal-body">';
// Your form fields for editing go here
echo '<form id="editForm' . $row["UniversityID"] . '" action="edit_university.php" method="post" enctype="multipart/form-data">';
echo '<input type="hidden" name="universityID" value="' . $row["UniversityID"] . '">';
echo '<label for="editUniversityName">University Name</label>';
echo '<input type="text" id="editUniversityName" name="editUniversityName" class="form-control" value="' . $row["UniversityName"] . '">';

echo '<label for="editTutionFees">Tution Fees</label>';
echo '<input type="text" id="editTutionFees" name="editTutionFees" class="form-control" value="' . $row["TutionFees"] . '">';

echo '<label for="editDiscount">Discount </label>';
echo '<input type="text" id="editDiscount" name="editDiscount" class="form-control" value="' . $row["Discount"] . '">';

echo '<label for="editUniversityDescription">University Description</label>';
echo '<input type="text" id="editUniversityDescription" name="editUniversityDescription" class="form-control" value="' . $row["UniversityDescription"] . '">';

echo '<label for="editLocation">Locations</label>';
echo '<input type="text" id="editLocation" name="editLocation" class="form-control" value="' . $row["Locations"] . '">';

echo '<label for="editCourseDuration">Course Duration</label>';
echo '<input type="text" id="editCourseDuration" name="editCourseDuration" class="form-control" value="' . $row["CourseDuration"] . '">';

echo '<div class="col-md-4">';
echo '<h4 class="box-title mt-20">Current Image</h4>';
echo '<div class="University-img text-start">';
echo '<img id="current-image-preview" src="' . $row['ImagePath'] . '" alt="Current Image">';
echo '</div>';
echo '</div>';

echo '<div class="col-md-4">';
echo '<h4 class="box-title mt-20">Upload New Image</h4>';
echo '<div class="University-img text-start">';
echo '<img id="image-preview" src="" alt="Image Preview">';
echo '<div class="input-group my-3">';
echo '<label class="input-group-text btn-primary" for="inputGroupFile01">Upload Image</label>';
echo '<input type="file" class="form-control" id="editImage" name="editImage" onchange="previewImage(this);">';
echo '</div>';
echo '</div>';
echo '</div>';

echo '</form>';
echo '</div>';
echo '<div class="modal-footer">';
echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
echo '<button type="button" class="btn btn-primary" onclick="submitEditForm(' . $row["UniversityID"] . ')">Save changes</button>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';


// Delete Modal
echo '<div class="modal fade" id="deleteModal' . $row["UniversityID"] . '" tabindex="-1" aria-labelledby="deleteModalLabel' . $row["UniversityID"] . '" aria-hidden="true">';
echo '<div class="modal-dialog">';
echo '<div class="modal-content">';
echo '<div class="modal-header">';
echo '<h5 class="modal-title" id="deleteModalLabel' . $row["UniversityID"] . '">Delete University</h5>';
echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
echo '</div>';
echo '<div class="modal-body">';
echo '<p>Are you sure you want to delete ' . $row["UniversityName"] . '?</p>';
echo '</div>';
echo '<div class="modal-footer">';
echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>';
echo '<button type="button" class="btn btn-danger" onclick="confirmDelete(' . $row["UniversityID"] . ')">Delete</button>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';

    
     
        // Modal
        echo '<div class="modal fade" id="detailsModal' . $row["UniversityID"] . '" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">';
        echo '<div class="modal-dialog" role="document">';
        echo '<div class="modal-content">';
        echo '<div class="modal-header">';
        echo '<h5 class="modal-title" id="detailsModalLabel">' . $row["UniversityName"] . ' Details</h5>';
        echo '<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">';
        echo '<span aria-hidden="true">&times;</span>';
        echo '</button>';
        echo '</div>';
        echo '<div class="modal-body">';
        // Add more details here, e.g., $row["UniversityDescription"]
        echo '<p>' . $row["UniversityDescription"] . '</p>';
        echo '</div>';
        echo '<div class="modal-footer">';
        echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    
    echo '</div>'; // Closing the row
} else {
    echo "0 results";
}




// Close the database connection
$conn->close();
?>

				
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
    
 
  
</div>
<!-- ./wrapper -->
	

	
	<!-- Page Content overlay -->
	
	
	<!-- Vendor JS -->
	<script src="../src/js/vendors.min.js"></script>
	<script src="../src/js/pages/chat-popup.js"></script>
    <script src="../../../assets/icons/feather-icons/feather.min.js"></script>
	
	<!-- CRMi App -->
	<script src="../src/js/template.js"></script>
	
	<script>
   function submitEditForm(universityID) {
    // Use AJAX to submit the form data to the server for processing
    $.ajax({
        type: "POST",
        url: "edit_university.php",
        data: $("#editForm" + universityID).serialize(),
        success: function (data) {
            // Handle the response from the server
            console.log(data); // You can replace this with actions like updating UI
            // Close the modal
            $("#editModal" + universityID).modal("hide");
        },
        error: function (error) {
            console.log("Error:", error);
        }
    });
}


    function confirmDelete(universityID) {
        // Use AJAX to send a request to the server to delete the record
        // Example using jQuery:
        $.post("delete_university.php", { universityID: universityID }, function (data) {
            // Handle the response from the server
            console.log(data); // You can replace this with actions like updating UI
            // Close the modal
            $("#deleteModal" + universityID).modal("hide");
        });
    }
</script>


<script>
    function previewImage(input) {
        var file = input.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('image-preview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>


</body>
</html>
