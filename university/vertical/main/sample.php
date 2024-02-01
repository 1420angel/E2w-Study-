
		<!-- Main content -->
		<section class="content">
		<?php
// Assuming you've already connected to the database
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
// Get the student ID from the URL parameter
$studentID = isset($_GET['studentID']) ? $_GET['studentID'] : null;

// Fetch student details from the database based on the ID
$query = "SELECT * FROM students WHERE StudentID = $studentID";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the student details
    $row = mysqli_fetch_assoc($result);
    
    // Display student details
    echo '<div class="row">';
    echo '<div class="col-lg-4 col-xlg-3 col-md-5">';
    echo '<div class="box">';
    echo '<div class="user-bg"> <img width="100%" alt="user" src="../../../images/avatar/375x200/2.jpg"> </div>';
    echo '<div class="box-body">';
    // Display other details as needed
    echo '<div class="row text-center mt-10">';
    echo '<div class="col-md-6 border-end">';
    echo '<strong>Full Name</strong>';
    <br>
    echo '<p>' . $row["FirstName"] . ' ' . $row["LastName"] . '</p>';
    echo '</div>';
    echo '<div class="col-md-6"><strong>Course</strong>';
    echo '<p>' . $row["Course"] . '</p>';
    echo '</div>';
    echo '<hr>';
    echo '<div class="row text-center mt-10">';
    echo '<div class="col-md-6 border-end"><strong>Course Type</strong>';
    echo '<p>' . $row["CourseType"] . '</p>';
    echo '</div>';
    echo '<div class="col-md-6"><strong>University</strong>';
    echo '<p>' . $row["University"] . '</p>';
    echo '</div>';
    echo '</div>';
   echo'<hr>';
    // Display other details
    echo '</div>';
    // Display other sections like skills, education, etc.
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
} else {
    echo 'Student details not found.';
}

// Close the database connection
mysqli_close($conn);
?>

		</section>



        echo '<div class="col-md-3 col-xs-6 border-end"> <strong>Mobile</strong>';
	echo '<br>';
    echo '<p class="text-muted">' . $row["CommunicationEmail"] . '</p>';
	echo '</div>';
    echo '<div class="col-md-3 col-xs-6 border-end"> <strong>Email</strong>';
	echo '<br>';
	echo '<p class="text-muted">' . $row["CommunicationContactNo"] . '</p>';
	echo '</div>';
	echo '<div class="col-md-3 col-xs-6"> <strong>Marital Status</strong>';
	echo '<br>';
	echo '<p class="text-muted">' . $row["MaritalStatus"] . '</p>';
	echo '</div>';