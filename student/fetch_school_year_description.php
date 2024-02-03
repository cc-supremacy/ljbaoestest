<?php
// Establish a database connection (replace with your connection details)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cap";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the yearID from the AJAX request
$yearID = $_POST['yearID'];

// Prepare and execute the SQL query
$sql = "SELECT description FROM school_years WHERE yearID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $yearID);
$stmt->execute();
$stmt->bind_result($description);

// Fetch the result
if ($stmt->fetch()) {
    // Output the result (description) to the AJAX request
    echo $description;
} else {
    // Handle the case where no description is found
    echo "No description available";
}

// Close the database connection
$stmt->close();
$conn->close();
?>
