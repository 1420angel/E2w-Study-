<?php
// edit_staff.php - Handle the form submission for editing staff details
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

    $staffID = $_POST['staffID'];
    $editedStaffName = $_POST['editStaffName'];
    $editedDesignation = $_POST['editDesignation'];
    $editedAddress = $_POST['editAddress'];
    $editedPhoneNumber = $_POST['editPhoneNumber'];
    $editedEmailID = $_POST['editEmailID'];
    $editedUsername = $_POST['editUsername'];
    $editedPassword = $_POST['editPassword'];

    // Perform the necessary database update
    $sql = "UPDATE staff 
            SET StaffName = '$editedStaffName',
                Designation = '$editedDesignation',
                Address = '$editedAddress',
                PhoneNumber = '$editedPhoneNumber',
                EmailID = '$editedEmailID',
                Username = '$editedUsername',
                Password = '$editedPassword'
            WHERE StaffID = $staffID";

    if ($conn->query($sql) === TRUE) {
        // Record updated successfully
        echo "Record updated successfully";
    } else {
        // Handle the case where the update fails
        echo "Error updating record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
