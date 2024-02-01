<?php
if (isset($_GET['universityId'])) {
    $universityId = $_GET['universityId'];

    // Your database connection code here
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch countries associated with the selected university
    $sql = "SELECT Country FROM university_countries WHERE UniversityID = $universityId";
    $result = $conn->query($sql);

    $countries = array(); // Initialize an empty array

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Assuming countries are stored as a comma-separated string
            $countryList = explode(',', $row['Country']);
            // Add each country to the array
            $countries = array_merge($countries, $countryList);
        }

        // Remove duplicate countries if any
        $countries = array_unique($countries);

        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode($countries);
    } else {
        echo json_encode([]);
    }

    $conn->close();
} else {
    echo json_encode([]);
}
?>
