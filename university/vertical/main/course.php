<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve posted data
    $universityId = $_POST['university'];
    $courseType = $_POST['course_type'];
    $courseNames = $_POST['courseName'];
    $descriptions = $_POST['description'];
    $countries = $_POST['country']; // Assuming you have a 'country' field in your form
    
    // Your database connection details
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

    // Insert university and course type into the 'Courses' table
    $sql = "INSERT INTO courses (UniversityID, CourseType, Country) VALUES ('$universityId', '$courseType', '$countries')";
    if ($conn->query($sql) === TRUE) {
        $courseId = $conn->insert_id;

        // Retrieve posted data
        $courseNames = $_POST['courseName'];
        $descriptions = $_POST['description'];


        // Insert individual course details
        for ($i = 0; $i < count($courseNames); $i++) {
            $courseName = $conn->real_escape_string($courseNames[$i]);
            $description = $conn->real_escape_string($descriptions[$i]);

            $sql = "INSERT INTO courses (UniversityID, CourseType, CourseName, Description, Country) 
                    VALUES ('$universityId', '$courseType', '$courseName', '$description', '$countries')";

            $conn->query($sql);
        }

        // Close the database connection
        $conn->close();

        // Display success message using SweetAlert
        echo '<script>';
        echo 'Swal.fire({
                icon: "success",
                title: "Courses added successfully!",
                showConfirmButton: false,
                timer: 1500
            });';
        echo '</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="path/to/bootstrap/css/bootstrap.min.css">
    <script src="path/to/jquery.min.js"></script>
    <script src="path/to/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Other head elements -->
</head>
<body>
    <!-- Your HTML content -->
</body>
</html>
