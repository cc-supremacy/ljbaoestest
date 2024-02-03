<?php
include("../connection/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lrn = $_POST["lrn"];
    $newMobile = $_POST["mobile"];

    $updateSql = "UPDATE students SET mobile = ? WHERE lrn = ?";
    $stmt = $connection->prepare($updateSql);
    $stmt->bind_param("ss", $newMobile, $lrn);

    if ($stmt->execute()) {
        // Update successful
        $stmt->close();
        $connection->close();
        echo "Mobile updated successfully!";
    } else {
        // Update failed
        echo "Error updating mobile: " . $stmt->error;
    }
} else {
    // Invalid request
    echo "Invalid request!";
}
?>
