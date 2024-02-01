<!-- change_password.php -->
<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve values from the form
$email = $_POST["email"];
$currentPassword = $_POST["current_password"];
$newPassword = $_POST["new_password"];

// Check if the current password is correct
$checkPasswordQuery = "SELECT password FROM admins WHERE email = '$email'";
$checkResult = $conn->query($checkPasswordQuery);

if ($checkResult->num_rows > 0) {
    $row = $checkResult->fetch_assoc();
    $storedPassword = $row['password'];

    // Verify the entered current password
    if ($currentPassword === $storedPassword) {
        // Current password is correct, update the password
        $updateQuery = "UPDATE admins SET password = '$newPassword' WHERE email = '$email'";
        $conn->query($updateQuery);

        echo "Password changed successfully.";
    } else {
        // Incorrect current password
        echo "Incorrect current password.";
    }
} else {
    // User not found (email not registered)
    echo "User not found.";
}

$conn->close();
?>
