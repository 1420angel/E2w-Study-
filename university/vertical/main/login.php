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
$password = $_POST["password"];

// Prepare and execute the SQL query
$sql = "SELECT * FROM admins WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Admin is verified, store admin details in session
    $admin = $result->fetch_assoc();
    $_SESSION['admin_id'] = $admin['admin_id'];
    $_SESSION['email'] = $admin['email'];
    $_SESSION['username'] = $admin['username'];
    $_SESSION['photo'] = $admin['photo'];
    $_SESSION['address'] = $admin['address'];
    $_SESSION['phone'] = $admin['phone'];
    $_SESSION['last_login'] = $admin['last_login'];
    
    // Update the last login time
    $adminId = $admin['admin_id'];
    $updateQuery = "UPDATE admins SET last_login = CURRENT_TIMESTAMP WHERE admin_id = $adminId";
    $conn->query($updateQuery);

    // Set success message in session
    $_SESSION['login_success'] = "Login Successful, Welcome " . $admin['username'];

    // Redirect to the admin dashboard
    header("Location: dashboard.php");
    exit();
} else {
    // Incorrect email or password
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "error",
            title: "Invalid email or password",
            text: "Please try again.",
        }).then(function() {
            window.location.href = "index.php";
        });
    });
  </script>';
}

$conn->close();
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
