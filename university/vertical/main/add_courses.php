
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../images/fav.jpg">

    <title>E2W Study - Add Courses </title>
  
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
					<h4 class="page-title">Add Courses Details</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="dashboard.php"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Add Course</li>
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
			  <h4 class="box-title">Fill The Course University Wise</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
				<form action="course.php" method="post">
<!-- University Dropdown -->
<label for="university" class="fw-700 fs-16 form-label">University:</label>
<select name="university" class="fw-700 fs-16 form-select" id="universityDropdown" required>
    <!-- Populate the dropdown with existing universities -->
    <?php
    // Fetch universities from the 'universities' table
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT UniversityID, UniversityName FROM universities";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row["UniversityID"] . '">' . $row["UniversityName"] .  '</option>';
        }
    }

    $conn->close();
    ?>
</select>

<!-- Country Dropdown -->
<label for="country" class="fw-700 fs-16 form-label">Country:</label>
<select name="country" class="fw-700 fs-16 form-select" required id="countryDropdown">
    <!-- Options will be populated dynamically using JavaScript -->
</select>




    <!-- Course Type Dropdown -->
    <label for="course_type" class="fw-700 fs-16 form-label mt-5">Course Type:</label>
    <select name="course_type" class="fw-700 fs-16 form-select" required>
        <option value="UG" >Undergraduate (UG)</option>
        <option value="PG">Postgraduate (PG)</option>
    </select>

    <!-- Course Details -->
    <div id="courseDetails">
        <!-- JavaScript will dynamically add course fields here -->
    </div>

    <!-- Add Course Button -->
    <button type="button"  class="btn btn-success mt-3" onclick="addCourse()">Add Course</button>

    <!-- Submit Button -->
    <button type="submit"  class="btn btn-primary mt-3">Submit</button>
</form>

<script>
    function addCourse() {
        // Dynamically add course fields
        var container = document.getElementById('courseDetails');
        var newDiv = document.createElement('div');
        newDiv.innerHTML =
            '<div class="row">' +
                '<div class="col-md-6">' +
                    '<label for="courseName" class="fw-700 fs-16 form-label mt-3">Course Name:</label>' +
                    '<input type="text" name="courseName[]" class="form-control mt-5" required>' +
                '</div>' +
                '<div class="col-md-6">' +
                    '<label for="description" class="fw-700 fs-16 form-label mt-3">Description:</label>' +
                    '<textarea name="description[]" class="form-control mt-5" required></textarea>' +
                '</div>' +
                '<div class="col-md-12 text-end mt-3">' +
                    '<button type="button" class="btn btn-outline-danger" onclick="removeCourse(this)">Cancel</button>' +
                '</div>' +
            '</div>' +
            '<hr>';
            
        container.appendChild(newDiv);

        // To check the structure in the console, you can log the innerHTML
        console.log(newDiv.innerHTML);
    }

    function removeCourse(element) {
        // Remove the parent row when the cancel button is clicked
        var row = element.closest('.row');
        row.parentNode.removeChild(row);
    }
</script>



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


<script>
// Change event listener for the university dropdown
$(document).ready(function() {
    $('#universityDropdown').on('change', function() {
        var universityId = $(this).val();

        // Clear existing options
        $('#countryDropdown').empty();

        // Fetch countries for the selected university
        $.ajax({
            url: 'get_countries.php', // Update with the correct URL
            method: 'GET',
            data: { universityId: universityId },
            dataType: 'json',
            success: function(response) {
                // Populate the country dropdown with fetched data
                $.each(response, function(index, country) {
                    $('#countryDropdown').append('<option value="' + country + '">' + country + '</option>');
                });
            },
            error: function() {
                console.error('Error fetching countries.');
            }
        });
    });
});
</script>
	
</body>
</html>
