<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../images/fav.jpg">

    <title>E2W Study - Staff Details</title>
  
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
					<h4 class="page-title">Staff Details</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="dashboard.php"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Staff List</li>
							</ol>
						</nav>
					</div>
				</div>				
			</div>
		</div>

		<!-- Main content -->
		<section class="content">
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

// Fetch staff details from the database
$sql = "SELECT * FROM staff";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="row">';
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-4">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<div class="row">';
        echo '<div class="col-md-4 col-sm-4 text-center">';
        echo '<a href="#"><img src="' . $row["ImagePath"] . '" alt="' . $row["StaffName"] . '" class="img-circle img-responsive" style="max-height: 210px;"></a>';
        echo '</div>';
        echo '<div class="col-md-8">';
        echo '<h5 class="card-title mb-0">' . $row["StaffName"] . '</h5> <small>' . $row["Designation"] . '</small>';
        echo '<p class="mt-15">';
        echo '<span class="d-block mb-10">' . $row["Address"] . '</span>';
        echo '<abbr title="Phone"><i class="fa fa-phone"></i></abbr> ' . $row["PhoneNumber"];
        echo '</p>';
        echo '<div class="btn-group">';
        echo '<button type="button" class="btn btn-primary waves-effect waves-light mt-10" data-bs-toggle="modal" data-bs-target="#detailsModal' . $row["StaffID"] . '">More Details</button>';
        echo '<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        echo '<span class="visually-hidden">Toggle Dropdown</span>';
        echo '</button>';
        echo '<ul class="dropdown-menu">';
        echo '<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editModal' . $row["StaffID"] . '">Edit</a></li>';
        echo '<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal' . $row["StaffID"] . '">Delete</a></li>';
        echo '<li><a class="dropdown-item" href="permission_page.php?staffID=' . $row["StaffID"] . '">Permission</a></li>';

        echo '</ul>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

     // Modal for more details
echo '<div class="modal fade" id="detailsModal' . $row["StaffID"] . '" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">';
echo '<div class="modal-dialog" role="document">';
echo '<div class="modal-content">';
echo '<div class="modal-header">';
echo '<h5 class="modal-title" id="detailsModalLabel">' . $row["StaffName"] . ' Details</h5>';
echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
echo '</div>';
echo '<div class="modal-body">';
// Add more details here, e.g., $row["AdditionalDetails"]
echo '<p> Username: ' . $row["Username"] . '</p>';
echo '<p> Password: ' . $row["Password"] . '</p>';
echo '<p> Email Id:' . $row["EmailID"] . '</p>';

// Display permission countries
$staffID = $row["StaffID"];
$query_permission = "SELECT country FROM staff_permission WHERE staffID = $staffID";
$result_permission = mysqli_query($conn, $query_permission);

if ($result_permission) {
    echo '<p> Permission Country: ';
    while ($row_permission = mysqli_fetch_assoc($result_permission)) {
        echo $row_permission["country"] . ', ';
    }
    echo '</p>';
    mysqli_free_result($result_permission);
} else {
    echo "Error fetching permission data: " . mysqli_error($conn);
}

echo '</div>';
echo '<div class="modal-footer">';
echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';


        // Modal for edit
		echo '<div class="modal fade" id="editModal' . $row["StaffID"] . '" tabindex="-1" aria-labelledby="editModalLabel' . $row["StaffID"] . '" aria-hidden="true">';
		echo '<div class="modal-dialog">';
		echo '<div class="modal-content">';
		echo '<div class="modal-header">';
		echo '<h5 class="modal-title" id="editModalLabel' . $row["StaffID"] . '">Edit Staff</h5>';
		echo '<button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>';
		echo '</div>';
		echo '<div class="modal-body">';
		// Your form fields for editing go here
		echo '<form id="editForm' . $row["StaffID"] . '" action="edit_staff.php" method="post">';
		echo '<input type="hidden" name="staffID" value="' . $row["StaffID"] . '">';
		echo '<label for="editStaffName">Staff Name</label>';
		echo '<input type="text" id="editStaffName" name="editStaffName" class="form-control" value="' . $row["StaffName"] . '">';
		
		echo '<label for="editDesignation">Designation</label>';
		echo '<input type="text" id="editDesignation" name="editDesignation" class="form-control" value="' . $row["Designation"] . '">';
		
		echo '<label for="editAddress">Address</label>';
		echo '<input type="text" id="editAddress" name="editAddress" class="form-control" value="' . $row["Address"] . '">';
		
		echo '<label for="editPhoneNumber">Phone Number</label>';
		echo '<input type="text" id="editPhoneNumber" name="editPhoneNumber" class="form-control" value="' . $row["PhoneNumber"] . '">';
		
        echo '<label for="editEmailID">Email Id</label>';
		echo '<input type="text" id="editEmailID" name="editEmailID" class="form-control" value="' . $row["EmailID"] . '">';
		
        echo '<label for="editUsername">Username</label>';
		echo '<input type="text" id="editUsername" name="editUsername" class="form-control" value="' . $row["Username"] . '">';
		
        echo '<label for="editPassword">Password</label>';
		echo '<input type="text" id="editPassword" name="editPassword" class="form-control" value="' . $row["Password"] . '">';
		
		echo '</form>';
		echo '</div>';
		echo '<div class="modal-footer">';
		echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
		echo '<button type="button" class="btn btn-primary" onclick="submitEditForm(' . $row["StaffID"] . ')">Save changes</button>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';

        
		

        // Modal for delete
		echo '<div class="modal fade" id="deleteModal' . $row["StaffID"] . '" tabindex="-1" aria-labelledby="deleteModalLabel' . $row["StaffID"] . '" aria-hidden="true">';
		echo '<div class="modal-dialog">';
		echo '<div class="modal-content">';
		echo '<div class="modal-header">';
		echo '<h5 class="modal-title" id="deleteModalLabel' . $row["StaffID"] . '">Delete Staff</h5>';
		echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
		echo '</div>';
		echo '<div class="modal-body">';
		echo '<p>Are you sure you want to delete ' . $row["StaffName"] . '?</p>';
		echo '</div>';
		echo '<div class="modal-footer">';
		echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>';
		echo '<button type="button" class="btn btn-danger" onclick="submitDeleteForm(' . $row["StaffID"] . ')">Delete</button>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		
    }
} else {
    echo "0 results";
}

?>




		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->

 <!-- Modal Template (put this outside your loop) -->
<div class="modal fade" id="permissionModal<?php echo $row["StaffID"]; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Fetch the list of countries from the database -->
                <?php
                $staffID = $row["StaffID"];
                $sql = "SELECT * FROM countries"; // Adjust the query based on your database schema
                $result = $conn->query($sql);
                ?>

                <!-- Display checkboxes for countries -->
                <form id="permissionForm<?php echo $staffID; ?>">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($country = $result->fetch_assoc()) {
                            echo '<div class="form-check">';
                            echo '<input class="form-check-input" type="checkbox" name="countries[]" value="' . $country["country_code"] . '">';
                            echo '<label class="form-check-label">' . $country["country_name"] . '</label>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No countries found</p>';
                    }
                    ?>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="savePermission(<?php echo $staffID; ?>)">Save Permission</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

  <?php include 'footer.php'; ?>

  <!-- quick_actions_toggle -->
  <?php include 'quick_action.php'; ?>
  <!-- /quick_actions_toggle -->    
    
 
	<!-- Page Content overlay -->
	
	
	<!-- Vendor JS -->
	<script src="../src/js/vendors.min.js"></script>
	<script src="../src/js/pages/chat-popup.js"></script>
    <script src="../../../assets/icons/feather-icons/feather.min.js"></script>
	
	<!-- CRMi App -->
	<script src="../src/js/template.js"></script>
	<script>
    function submitEditForm(staffID) {
        // Use AJAX to submit the edit form data to the server for processing
        $.post("edit_staff.php", $("#editForm" + staffID).serialize(), function (data) {
            // Handle the response from the server
            console.log(data); // You can replace this with actions like updating UI
            // Close the edit modal
            $("#editModal" + staffID).modal("hide");
        });
    }
	function submitDeleteForm(staffID) {
        // Use AJAX to submit the delete request to the server
        $.post("delete_staff.php", { staffID: staffID }, function (data) {
            // Handle the response from the server
            console.log(data); // You can replace this with actions like updating UI
            // Close the delete modal
            $("#deleteModal" + staffID).modal("hide");
        });
    }
</script>

	

</body>
</html>
