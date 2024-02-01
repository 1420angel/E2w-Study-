<?php
// delete_staff.php - Handle the deletion request for staff
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase"; // Replace with your actual database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $staffID = $_POST['staffID'];
    

    // Perform the necessary database deletion
    $sql = "DELETE FROM staff WHERE StaffID = $staffID";

    if ($conn->query($sql) === TRUE) {
        // Record deleted successfully
        echo "Record deleted successfully";
    } else {
        // Handle the case where the deletion fails
        echo "Error deleting record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}

}
?>
