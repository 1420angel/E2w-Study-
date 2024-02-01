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
	<!-- Add these lines to the head section of your HTML -->

</head>
<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">
<!-- Site wrapper -->
<div class="wrapper">
	<div id="loader"></div>

	<?php include 'header.php'; ?>
  
  <?php include 'sidebar.php'; ?>

  <div class="content-wrapper" style="min-height: 656px;">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="me-auto">
					<h4 class="page-title">Reports</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Reports</li>
							</ol>
						</nav>
					</div>
				</div>				
			</div>
		</div>

		<!-- Main content -->
		<section class="content">
			<div class="row">
			<div class="col-md-4">
    <ul class="nav nav-tabs box box-body mb-0" role="tablist">
        <?php
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

        if (!$result) {
            // Print the SQL query for debugging purposes
            echo "Query: " . $sql . "<br>";
            // Print the error message from MySQL
            die("Query failed: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<li class="nav-item w-p100">';
                echo '<a class="nav-link" data-bs-toggle="tab" href="#university-' . $row["UniversityID"] . '" role="tab" aria-controls="university-' . $row["UniversityID"] . '" aria-selected="false">' . $row["UniversityName"] . '</a>';
                echo '</li>';
            }
        } else {
            // Handle the case where there are no rows
            echo "No records found";
        }

        $conn->close();
        ?>
    </ul>
</div>


<!-- Display University Courses -->
<div class="col-md-8">
    <div class="tab-content pt-0">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydatabase";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT c.UniversityID, u.UniversityName, c.* FROM courses c JOIN universities u ON c.UniversityID = u.UniversityID";
        $result = $conn->query($sql);

        if (!$result) {
            echo "Query: " . $sql . "<br>";
            die("Query failed: " . $conn->error);
        }

     
	
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				echo '<div class="tab-pane" id="university-' . $row["UniversityID"] . '" role="tabpanel">';
				echo '<div class="table-responsive box">';
				echo '<div class="box-body">';
				echo '<h4 class="pb-20">' . $row["UniversityName"] . ' Courses</h4>';
		
				// Fetch all courses for the current UniversityID
				$courseSql = "SELECT * FROM courses WHERE UniversityID = " . $row["UniversityID"];
				$courseResult = $conn->query($courseSql);
		
				// Table structure
				echo '<table class="example table table-striped " id="DataTables_Table_' . $row["UniversityID"] . '" role="grid" aria-describedby="DataTables_Table_' . $row["UniversityID"] . '_info">';
				echo '<thead>';
				echo '<tr role="row">';
				echo '<th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_' . $row["UniversityID"] . '" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Course ID: activate to sort column descending" style="width: 145.438px;">Course ID</th>';
				echo '<th class="sorting" tabindex="0" aria-controls="DataTables_Table_' . $row["UniversityID"] . '" rowspan="1" colspan="1" aria-label="Course Type: activate to sort column ascending" style="width: 107.078px;">Course Type</th>';
				echo '<th class="sorting" tabindex="0" aria-controls="DataTables_Table_' . $row["UniversityID"] . '" rowspan="1" colspan="1" aria-label="Course Name: activate to sort column ascending" style="width: 89.8438px;">Course Name</th>';
				echo '<th class="sorting" tabindex="0" aria-controls="DataTables_Table_' . $row["UniversityID"] . '" rowspan="1" colspan="1" aria-label="Description: activate to sort column ascending" style="width: 86.2656px;">Description</th>';
				echo '<th class="sorting" tabindex="0" aria-controls="DataTables_Table_' . $row["UniversityID"] . '" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 86.2656px;">Actions</th>';
				echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
		
				if ($courseResult->num_rows > 0) {
					while ($courseRow = $courseResult->fetch_assoc()) {
						echo '<tr role="row" class="odd">';
						echo '<td class="sorting_1">' . $courseRow["CourseID"] . '</td>';
						echo '<td>' . $courseRow["CourseType"] . '</td>';
						echo '<td>' . $courseRow["CourseName"] . '</td>';
						echo '<td>' . $courseRow["Description"] . '</td>';
						// Add more columns as needed
		
						// Single column for Edit and Delete Icons
						echo '<td>';
						
						// Edit Icon
						echo '<a href="update_course.php" class="btn btn-sm btn-white text-success me-5" data-bs-toggle="modal" data-bs-target="#editCourseModal" data-courseid="' . $courseRow["CourseID"] . '" data-coursename="' . $courseRow["CourseName"] . '" data-coursedescription="' . $courseRow["Description"] . '"><i class="fa fa-edit me-5"></i></a>';
		
						// Delete Icon
						echo '<a href="javascript:void(0);" onclick="confirmDelete(' . $courseRow["CourseID"] . ')" class="btn btn-sm btn-white text-danger"><i class="fa fa-trash me-5"></i></a>';
		
						echo '</td>';
						echo '</tr>';
					}
				} else {
					echo '<tr><td colspan="5">No course data found for ' . $row["UniversityName"] . '</td></tr>';
				}
		
				echo '</tbody>';
				echo '</table>';
		
				// DataTables initialization script
				echo '<script>';
				echo '$(document).ready(function () {';
				echo '$("#DataTables_Table_' . $row["UniversityID"] . '").DataTable();';
				echo '});';
				echo '</script>';
		
				echo '</div></div></div>';
			}
		} else {
			echo "No records found";
		}
		
		$conn->close();
		
		?>
		

    </div>
</div>

  
    </div>
</div>
</div>


<!-- Modal for Editing Course -->
<div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="editCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCourseModalLabel">Edit Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCourseForm" action="update_course.php" method="post">
                    <input type="hidden" name="courseID" id="editCourseID">
                    <div class="mb-3">
                        <label for="editCourseName" class="form-label">Course Name:</label>
                        <input type="text" class="form-control" id="editCourseName" name="editCourseName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCourseDescription" class="form-label">Description:</label>
                        <textarea class="form-control" id="editCourseDescription" name="editCourseDescription" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editCourseModal = new bootstrap.Modal(document.getElementById('editCourseModal'));

        // Handle edit button click
        $('#editCourseModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var courseID = button.data('courseid');
            var courseName = button.data('coursename');
            var courseDescription = button.data('coursedescription');

            // Set modal values
            $('#editCourseID').val(courseID);
            $('#editCourseName').val(courseName);
            $('#editCourseDescription').val(courseDescription);

            // Show the modal
            editCourseModal.show();
        });
    });
</script>



<script>
document.addEventListener("DOMContentLoaded", function () {
    var universityLinks = document.querySelectorAll('.university-link');

    universityLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();

            var universityId = this.getAttribute('data-university-id');
            var country = this.getAttribute('data-country');
            var courseType = this.getAttribute('data-course-type');
            var courseDescription = this.getAttribute('data-course-description');

            var tableBody = document.getElementById('selected-university-details-body');
            tableBody.innerHTML = '<tr><td>' + universityId + '</td><td>' + country + '</td><td>' + courseType + '</td><td>' + courseDescription + '</td></tr>';
        });
    });
});
</script>


<!-- Your existing JavaScript code -->
<script>
    // Handle deletion with confirmation
    function confirmDelete(courseID) {
        var confirmDelete = confirm("Are you sure you want to delete this course?");
        if (confirmDelete) {
            // If user confirms, redirect to delete_course.php
            window.location.href = 'delete_course.php?courseID=' + courseID;
        } else {
            // If user cancels, do nothing
        }
    }
</script>


			
			</div>
		
		</section>


		<!-- /.content -->
	  </div>
  </div>
 
  <?php include 'footer.php'; ?>
  <!-- Side panel --> 

  <!-- quick_actions_toggle -->
  <?php include 'quick_action.php'; ?>
  <!-- /quick_actions_toggle -->    
  
	
	<!-- Page Content overlay -->
	
	<script>
   $(document).ready(function () {
      $('#DataTables_Table_<?php echo $row["UniversityID"]; ?>').DataTable({
         "lengthMenu": [10, 25, 50, 75, 100], // Number of entries to show in the dropdown
         "searching": true, // Enable search box
         "paging": true // Enable pagination
      });
   });
</script>

	<!-- Vendor JS -->
	<script src="../src/js/vendors.min.js"></script>
	<script src="../src/js/pages/chat-popup.js"></script>
    <script src="../../../assets/icons/feather-icons/feather.min.js"></script>
         
	<script src="../../../assets/vendor_components/apexcharts-bundle/irregular-data-series.js"></script>
	<script src="../../../assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
	<script src="../../../assets/vendor_components/jquery.peity/jquery.peity.js"></script>
       
	<script src="../../../assets/vendor_components/datatable/datatables.min.js"></script>
	
	<!-- CRMi App -->
	<script src="../src/js/template.js"></script>
	<script src="../src/js/pages/reports.js"></script>

</body>
</html>



