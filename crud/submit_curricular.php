<?php
// Include your database connection code here
include("../connection/db.php");

if (isset($_POST["submit"])) {  // Check if the submit button is set

    // Retrieve form data
    $lrn = $_POST["lrn"];
    $yearID = $_POST["curricularYear"];
    $description = $_POST["curricularDescription"];
    $category = $_POST["curricularCategory"];
    $achievements = $_POST["curricularAchievements"];

    // Prepare the SQL statement
    $insertSql = "INSERT INTO curricular (lrn, yearID, `description`, category, achievements) 
                  VALUES (?, ?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $connection->prepare($insertSql);
    $stmt->bind_param("iisss", $lrn, $yearID, $description, $category, $achievements);

    // Execute the query
    if ($stmt->execute()) {
        // Close the statement
        $stmt->close();

        // Close the database connection
        $connection->close();

        // Alert for successful insertion
        echo '<script>alert("Curricular activity added successfully!");</script>';

        // Redirect to "proghead.enrolled.students.php"
        echo '<script>window.location.href = "proghead.enrolled.students.php";</script>';
        exit; // Ensure script execution stops after redirect
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid request!";
}

// Close the database connection if needed
$connection->close();
?>
