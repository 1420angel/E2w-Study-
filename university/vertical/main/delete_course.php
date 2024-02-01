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

// Check if courseID is provided in the query string
if (isset($_GET['courseID'])) {
    $courseID = $_GET['courseID'];

    // SQL query to delete the course
    $deleteQuery = "DELETE FROM courses WHERE CourseID = $courseID";

    // Perform the deletion
    if ($conn->query($deleteQuery) === TRUE) {
        // Redirect back to course_list page after successful deletion
        header("Location: course_list.php");
        exit();
    } else {
        echo "Error deleting course: " . $conn->error;
    }
} else {
    echo "CourseID not provided.";
}

// Close the database connection
$conn->close();
?>
