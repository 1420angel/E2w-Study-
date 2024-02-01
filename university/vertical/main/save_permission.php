<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Assume you have a staff ID, replace it with the actual logic to retrieve the staff ID
    if (isset($_GET['staffID'])) {
        $staffID = mysqli_real_escape_string($conn, $_GET['staffID']);

        // Check if countries are selected
        if (isset($_POST['countries']) && is_array($_POST['countries'])) {
            $selectedCountries = array_map('mysqli_real_escape_string', array_fill(0, count($_POST['countries']), $conn), $_POST['countries']);

            // Check if the permission already exists for the specified country
            foreach ($selectedCountries as $country) {
                $checkQuery = "SELECT * FROM staff_permission WHERE staffID = $staffID AND country = '$country'";
                $checkResult = mysqli_query($conn, $checkQuery);

                if ($checkResult && mysqli_num_rows($checkResult) > 0) {
                    // Display alert message using JavaScript
                    echo "<script>alert('Alert: Permission for $country already allocated to the staff.');";
                    echo "window.location.href = 'permission_page.php?staffID=$staffID';</script>";
                    exit;
                } else {
                    // Permission doesn't exist, insert into staff_permission table
                    $insertQuery = "INSERT INTO staff_permission (staffID, country) VALUES (?, ?)";
                    $stmt = $conn->prepare($insertQuery);

                    // Bind parameters
                    $stmt->bind_param("is", $staffID, $country);

                    // Execute the statement
                    $insertResult = $stmt->execute();

                    if (!$insertResult) {
                        // Display error message using JavaScript
                        echo "<script>alert('Error inserting into staff_permission table: " . $stmt->error . "');</script>";
                    } else {
                        // Redirect to permission page after success
                        header("Location: permission_page.php?staffID=$staffID");
                        exit;
                    }

                    // Close the statement
                    $stmt->close();
                }
            }
        } else {
            // Display alert message using JavaScript
            echo "<script>alert('No countries selected.');</script>";
        }
    } else {
        // Display alert message using JavaScript
        echo "<script>alert('Error: Staff ID not provided in the URL.');</script>";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
