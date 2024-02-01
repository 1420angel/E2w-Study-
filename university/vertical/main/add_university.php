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
    $universityName = mysqli_real_escape_string($conn, $_POST['universityName']);
    $tutionFees = mysqli_real_escape_string($conn, $_POST['tutionFees']);
    $discount = mysqli_real_escape_string($conn, $_POST['discount']);
    $universityDescription = mysqli_real_escape_string($conn, $_POST['universityDescription']);
    $locations = mysqli_real_escape_string($conn, $_POST['locations']);
    $courseDuration = mysqli_real_escape_string($conn, $_POST['courseDuration']);
// Get countries from the form (assuming it's an array)
$countries = isset($_POST['countries']) ? $_POST['countries'] : array();

// Convert the array to a string (comma-separated, for example)
$countriesString = implode(', ', array_map(array($conn, 'real_escape_string'), $countries));
    // Image upload handling
    $uploadDir = 'image/';
    $uploadFile = $uploadDir . basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        // Image uploaded successfully, $uploadFile contains the path to the uploaded file

	
// ... Your existing code ...

// Insert data into the "universities" table
$sql = "INSERT INTO universities (UniversityName, TutionFees, Discount, UniversityDescription, Locations, CourseDuration, ImagePath)
        VALUES ('$universityName', '$tutionFees', '$discount', '$universityDescription', '$locations', '$courseDuration', '$uploadFile')";

if ($conn->query($sql) === TRUE) {
    // Get the last inserted university ID
    $lastUniversityID = $conn->insert_id;

    // Insert university-country relationships into another table
    foreach ($countries as $country) {
        $countryInsertSQL = "INSERT INTO university_countries (UniversityID, UniversityName, Country)
                             VALUES ('$lastUniversityID', '$universityName', '$country')";
        
        if ($conn->query($countryInsertSQL) !== TRUE) {
            echo "Error inserting country: " . $conn->error;
        }
    }

    // Display success message, redirect, etc.
    echo '<div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Record added successfully
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
          </div>';

    echo '<script>
            setTimeout(function(){
                window.location.href = "university_list.php";
            }, 3000);
          </script>';
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

    <title>E2W Study - Add University </title>
  
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
					<h4 class="page-title">Add University</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="dashboard.php"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">University</li>
								<li class="breadcrumb-item active" aria-current="page">Add Details</li>
							</ol>
						</nav>
					</div>
				</div>
				
			</div>
		</div>

		<!-- Main content -->
		<section class="content">

			<div class="row">
			  <div class="col-12">
				<div class="box">
					<div class="box-header with-border">
					  <h4 class="box-title">Add Universities</h4>
					</div>
				  <div class="box-body">
					<form action="#" method="post" enctype="multipart/form-data">
						<div class="form-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									  <label class="fw-700 fs-16 form-label">University Name</label>
									  <input type="text" class="form-control" name="universityName" placeholder="University Name">
									</div>
								</div>
								<!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="countries" class="fw-700 fs-16 form-label mt-3">Countries:</label>
                                        <div id="countryList">
                                            <!-- JavaScript will dynamically add country fields here -->
                                        </div>
                                        <button type="button" class="btn btn-success mt-3" onclick="addCountry()">Add Country</button>
                                    </div>
                                </div>
								<!--/span-->
							</div>
							<!--/row-->


							<!--row
							<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="fw-700 fs-16 form-label">Academic Course Level</label>
            <select class="form-select" id="academic-level" data-placeholder="Choose a Category" tabindex="1">
                <option value="Undergraduate">Undergraduate</option>
                <option value="Postgraduate">Postgraduate</option>
            </select>
        </div>
    </div>
   
    <div class="col-md-6">
        <div class="form-group">
            <label class="fw-700 fs-16 form-label">Course Name</label>
            <select class="form-select" id="course-list" data-placeholder="Choose a Course" tabindex="1">
                <option value="" selected disabled>Select Course</option>
            </select>
        </div>
    </div>
    
</div>
-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="fw-700 fs-16 form-label">Tution Fees</label>
										<div class="input-group">
											<div class="input-group-addon"><i>₹</i></div>
											<input type="text" class="form-control" name="tutionFees" placeholder="270"> 
										</div>
									</div>
								</div>
								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="fw-700 fs-16 form-label">Discount</label>
										<div class="input-group">
											<div class="input-group-addon"><i class="ti-cut"></i></div>
											<input type="text" class="form-control" name="discount" placeholder="50%"> 
										</div>
									</div>
								</div>
								<!--/span-->
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="fw-700 fs-16 form-label">University Description</label>
										<textarea class="form-control p-15" rows="5" name="universityDescription">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</textarea>
									</div>
								</div>
							</div>
							<!--/row-->
							<div class="row">
							<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="fw-700 fs-16 form-label">Locations</label>
                                        <textarea class="form-control" name="locations" rows="4" placeholder="Enter locations, one per line"></textarea>
                                    </div>
                            </div>

								<!--/span-->
								<div class="col-md-6">
									<div class="form-group">
										<label class="fw-700 fs-16 form-label">Course Duration</label>
										<input type="text" class="form-control" name="courseDuration"> </div>
								</div>
								<!--/span-->
								<div class="col-md-4">
									<h4 class="box-title mt-20">Upload Image</h4>
									<div class="University-img text-start">
										<img id="image-preview" src="../../../images/gallery/full/1.jpg" alt="">
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
				</div>
			  </div>		  
		  </div>

		</section>
		<!-- /.content -->
	  </div>
  </div>
  <!-- /.content-wrapper -->
 
   
  <!-- Side panel --> 
  <!-- quick_actions_toggle -->
  <?php include 'quick_action.php'; ?>
  <!-- /quick_actions_toggle -->    
    
  
  
  
</div>
<!-- ./wrapper -->
	
		
<?php include 'footer.php'; ?>
	
	<!-- Page Content overlay -->
	
	
	<!-- Vendor JS -->
	<script src="../src/js/vendors.min.js"></script>
	<script src="../src/js/pages/chat-popup.js"></script>
    <script src="../../../assets/icons/feather-icons/feather.min.js"></script>	
	
	<!-- CRMi App -->
	<script src="../src/js/template.js"></script>
	<script>
    $(document).ready(function () {
        // Define course lists for Undergraduate and Postgraduate
        var undergraduateCourses = ["Select Course", 
		"BA (Hons) Business Studies", "BSc (Hons) Computer Science", "BA (Hons) / BSc (Hons) Education (Primary)",
"BA (Hons) / BSc (Hons) Education (Secondary)",
"BA (Hons) Business Law",
"BA (Hons) Business Studies and Human Resource Management",
"BA (Hons) Business Studies and Management",
"BA (Hons) Business Studies and Marketing",
"BA (Hons) Digital Media",
"BA (Hons) Events Management",
"BA (Hons) Film & Media and Religious Studies",
"BA (Hons) Film & Media Studies and Law",
"BA (Hons) Finance and Mathematics",
"BA (Hons) Heritage and Tourism",
"BA (Hons) History and Heritage",
"BA (Hons) Human Resource Management and Marketing",
"BA (Hons) International Management Studies with European Languages and Society",
"BA (Hons) Journalism and Law",
"BA (Hons) Law",
"BA (Hons) Philosophy and Psychology",
"BA (Hons) Politics, Philosophy and Economics",
"BA (Hons) Professional Accountancy",
"BA (Hons) Professional Education (Secondary, Chemistry or Physics)",
"BA (Hons) Psychology",
"BA (Hons) Social Work",
"BA (Hons) Sport Business Management",
"BA (Hons) Sport Development and Coaching",
"BA Modern Languages and International Politics",
"BAcc (Hons) Accountancy",
"BAcc (Hons) Accountancy and Finance",
"BSc (Hons) Applied Biological Sciences",
"BSc (Hons) Applied Mathematics",
"BSc (Hons) Business Computing",
"BSc (Hons) Ecology and Conservation",
"BSc (Hons) Environmental Geography and Outdoor Education",
"BSc (Hons) Environmental Science and Outdoor Education",
"BSc (Hons) Mathematics",
"BSc (Hons) Mathematics and Psychology",
"BSc (Hons) Nursing - Mental Health",
"BSc (Hons) Nursing – Adult",
"BSc (Hons) Psychology",
"BSc (Hons) Software Development with Cyber Security",
"BSc (Hons) Sport and Exercise Science",
"BSc (Hons) Sport Psychology",
"BSc Nursing - Adult",
"BSc Nursing - Mental Health",
"LLB (Hons) Law",
"LLB Law: Accelerated Graduate"
];
        
        var postgraduateCourses = [
			"Clinical Doctorates",
"LLM International Energy and Environmental Law",
"Master of Business Administration (MBA)",
"MLitt Creative Writing",
"MLitt Publishing Studies",
"MLitt, MSc Gender Studies (Applied)",
"MPP Public Policy",
"MRes Business and Management",
"MRes Educational Research",
"MRes Historical Research",
"MRes Humanities",
"MRes Media Research",
"MRes Publishing Studies",
"MSc / MA Human-Animal Interaction",
"MSc Applied Social Research",
"MSc Aquatic Pathobiology",
"MSc Aquatic Veterinary Studies",
"MSc Artificial Intelligence",
"MSc Autism Research",
"MSc Behavioural Science",
"MSc Big Data",
"MSc Business Analytics",
"MSc Business and Management",
"MSc Criminological Research",
"MSc Criminology",
"MSc Data Science for Business",
"MSc Digital Banking and Finance",
"MSc Digital Media and Communication",
"MSc Disaster Interventions and Humanitarian Aid",
"MSc Education",
"MSc English Language and Linguistics",
"MSc English Language Teaching and Management",
"MSc Environmental Management (Conservation)",
"MSc Environmental Management (Energy)",
"MSc Environmental Remote Sensing and Geospatial Sciences",
"MSc Finance",
"MSc Finance and Data Analytics",
"MSc Finance and Risk Management",
"MSc Financial Technology (FinTech)",
"MSc Health Psychology",
"MSc Heritage",
"MSc Historical Research",
"MSc Human Resource Management",
"MSc Human Rights and Diplomacy",
"MSc International Accounting and Finance",
"MSc International Business",
"MSc International Conflict and Cooperation",
"MSc International Journalism",
"MSc Investment Analysis",
"MSc Marketing",
"MSc Marketing Analytics",
"MSc Marketing and Brand Management",
"MSc Mathematics and Data Science",
"MSc Media Management",
"MSc Psychological Research Methods",
"MSc Psychology (accredited conversion course)",
"MSc Psychology of Sport (Accredited)",
"MSc Social Statistics and Social Research",
"MSc Sport Management",
"MSc Sustainable Aquaculture",
"MSc Teaching English to Speakers of Other Languages (TESOL)",

        ];

     // Function to update course list based on the selected academic level
	 function updateCourseList() {
            var selectedAcademicLevel = $("#academic-level").val();
            var courses = (selectedAcademicLevel === "Undergraduate") ? undergraduateCourses : postgraduateCourses;

            // Empty and update the course list
            $("#course-list").empty();
            $.each(courses, function (index, course) {
                $("#course-list").append("<option value='" + course + "'>" + course + "</option>");
            });
        }

        // Initial update on page load
        updateCourseList();

        // Bind the update function to the change event of the academic level select
        $("#academic-level").change(function () {
            updateCourseList();
        });
    });
</script>
	

<script>
    $(document).ready(function () {
        // Assume this function is triggered on form submission
        function handleFormSubmission() {
            var locationsInput = $("#locations-input").val();
            
            // Split the input based on newline characters to get an array of locations
            var locationsArray = locationsInput.split('\n');

            // Now, you can use the locationsArray as needed
            console.log(locationsArray);
            
            // Add your logic to save or process the list of locations
        }

        // Example: Attach the handleFormSubmission function to a form submit event
        $("#your-form-id").submit(function (event) {
            event.preventDefault(); // Prevent the default form submission
            handleFormSubmission();
        });
    });
</script>

<script>
    function addCountry() {
        // Dynamically add country fields
        var container = document.getElementById('countryList');
        var newDiv = document.createElement('div');
        newDiv.innerHTML =
            '<div class="input-group mb-3">' +
                '<input type="text" name="countries[]" class="form-control" placeholder="Enter a country" required>' +
                '<button type="button" class="btn btn-outline-danger" onclick="removeCountry(this)">Cancel</button>' +
            '</div>';

        container.appendChild(newDiv);
    }

    function removeCountry(element) {
        // Remove the parent input group when the cancel button is clicked
        var inputGroup = element.closest('.input-group');
        inputGroup.parentNode.removeChild(inputGroup);
    }
</script>


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
