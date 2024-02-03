<?php
// Include your database connection code here
include("../connection/db.php");

// Query to fetch school years from the school_years table
$schoolYearSql = "SELECT yearID, description FROM school_years";
$schoolYearResult = $connection->query($schoolYearSql);

// Check if there are rows in the result
if ($schoolYearResult->num_rows > 0) {
    // Build the select options
    $options = "";
    while ($row = $schoolYearResult->fetch_assoc()) {
        $options .= "<option value='{$row['yearID']}'>{$row['description']}</option>";
    }

    // Output the select options
    echo $options;
} else {
    echo "No school years found";
}

// Close the database connection if needed
$connection->close();
?>
