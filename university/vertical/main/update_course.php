<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $courseID = $_POST['courseID'];
    $editCourseName = $_POST['editCourseName'];
    $editCourseDescription = $_POST['editCourseDescription'];

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

    // Update query
    $updateQuery = "UPDATE courses SET CourseName = '$editCourseName', Description = '$editCourseDescription' WHERE CourseID = $courseID";

    // Perform the update
    if ($conn->query($updateQuery) === TRUE) {
        // Update successful
        echo '<script>alert("Course updated successfully");</script>';
    } else {
        // Display error message using JavaScript alert
        echo '<script>alert("Error updating course");</script>';
    }

    // Close the database connection
    $conn->close();
// Redirect to course_list page
echo '<script>window.location.href = "course_list.php";</script>';
exit();
} else {
// If the form is not submitted, redirect to the appropriate page
header("Location: index.php"); // Change 'index.php' to the actual page you want to redirect to
exit();
}
?>
