<?php
// delete.php - Handle the deletion request
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

    // Perform the necessary database deletion
    $deleteSql = "DELETE FROM universities WHERE UniversityID = ?";

    // Use prepared statement to prevent SQL injection
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("i", $universityID);

    // Execute the query
    if ($deleteStmt->execute()) {
        // Record deleted successfully

        // Display success message using SweetAlert
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: "Record deleted successfully",
                    }).then(function() {
                        // Redirect to the current page after a short delay (e.g., 2 seconds)
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    });
                });
              </script>';
    } else {
        // Handle the case where the deletion fails

        // Display error message using SweetAlert
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: "Error deleting record: ' . $deleteStmt->error . '",
                    });
                });
              </script>';
    }

    // Close the database connection
    $deleteStmt->close();
    $conn->close();
}
?>
