<?php
// edit_university.php - Handle the form submission for editing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $universityID = $_POST['universityID'];
    $editedUniversityName = $_POST['editUniversityName'];
    $editedTutionFees = $_POST['editTutionFees'];
    $editedDiscount = $_POST['editDiscount'];
    $editedUniversityDescription = $_POST['editUniversityDescription'];
    $editedLocations = isset($_POST['editLocation']) ? $_POST['editLocation'] : '';
    $editedCourseDuration = $_POST['editCourseDuration'];

    // Fetch existing data from the database
    $fetchSql = "SELECT * FROM universities WHERE UniversityID = ?";
    $fetchStmt = $conn->prepare($fetchSql);
    $fetchStmt->bind_param("i", $universityID);
    $fetchStmt->execute();
    $result = $fetchStmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch the data for the specified UniversityID

       // Handle file upload
        $editedImagePath = $row['ImagePath']; // Set the default path
        if (!empty($_FILES['editImage']['name'])) {
         $uploadDir = 'image/';
         $uploadFile = $uploadDir . basename($_FILES['editImage']['name']);

    if (move_uploaded_file($_FILES['editImage']['tmp_name'], $uploadFile)) {
        // File uploaded successfully, update the image path
        $editedImagePath = $uploadFile;
    } else {
        // Failed to move the uploaded file
        echo "Error uploading file.";
        exit; // Stop execution if file upload fails
    }
}


        // Perform the necessary database update using prepared statement
        $updateSql = "UPDATE universities 
            SET UniversityName = ?,
                TutionFees = ?,
                Discount = ?,
                UniversityDescription = ?,
                Locations = ?,
                CourseDuration = ?,
                ImagePath = ?
            WHERE UniversityID = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("sssssssi", $editedUniversityName, $editedTutionFees, $editedDiscount, $editedUniversityDescription, $editedLocations, $editedCourseDuration, $editedImagePath, $universityID);
        
        if ($updateStmt->execute()) {
            // Record updated successfully
            echo "Record updated successfully";
        } else {
            // Handle the case where the update fails
            echo "Error updating record: " . $updateStmt->error;
        }
    } else {
        echo "Record not found"; // Handle the case where the record is not found
    }

    // Close the statements and the database connection
    $fetchStmt->close();
    $updateStmt->close();
    $conn->close();
}
?>
