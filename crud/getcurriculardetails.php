<?php
// Include your database connection code here
include("../connection/db.php");

if (isset($_GET['lrn']) && isset($_GET['schoolYear'])) {
    $lrn = $_GET['lrn'];
    $schoolYear = $_GET['schoolYear'];

    // Query to fetch curricular details based on LRN and school year
    $curricularSql = "SELECT * FROM curricular WHERE lrn = '$lrn' AND yearID = '$schoolYear'";
    $curricularResult = $connection->query($curricularSql);

    // Check if the query execution is successful
    if ($curricularResult !== false) {
        // Check if there are rows in the result
        if ($curricularResult->num_rows > 0) {
            // Build the HTML for curricular details
            $details = "<h4>Extra-Curricular Activities</h4><ul>";
            while ($row = $curricularResult->fetch_assoc()) {
                $details .= "<li><strong>{$row['description']}</strong>: {$row['category']} - {$row['achievements']}</li>";
            }
            $details .= "</ul>";

            // Output the curricular details
            echo $details;
        } else {
            // No curricular details found
            echo "No details found for the selected school year.";
        }

        // Query to fetch grades based on LRN and school year
        $gradesSql = "SELECT * FROM grades WHERE lrn = '$lrn' AND school_year = '$schoolYear'";
        $gradesResult = $connection->query($gradesSql);

        // Check if there are rows in the grades result
        if ($gradesResult->num_rows > 0) {
            // Build the HTML for grades
            $gradesDetails = "<h4>Grades</h4><ul>";
            while ($gradesRow = $gradesResult->fetch_assoc()) {
                $gradesDetails .= "<li><strong>{$gradesRow['subName']}</strong>: {$gradesRow['subMarks']}</li>";
            }
            $gradesDetails .= "</ul>";

            // Output the grades details
            echo $gradesDetails;
        } else {
            // No grades found
            echo "";
        }
    } else {
        // Query execution failed
        echo "Error executing the query: " . $connection->error;
    }
} else {
    echo "LRN and school year parameters are missing.";
}

// Close the database connection if needed
$connection->close();
?>
