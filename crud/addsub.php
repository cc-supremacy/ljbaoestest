<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "cap";

$connection = new mysqli($servername, $username, $password, $database);

$course = "";
$subName = "";
$prof = "";

$errorMessage = "";
$successMessage = "";

if (isset($_POST['add_sub'])) {

    $subName = $_POST["subName"];
    $course = $_POST["course"];
    $profName = $_POST["prof"];

    // Remove spaces from $subName
    $subName = str_replace(' ', '', $subName);

    // Check if the subject already exists in the database for the given course (case-insensitive and ignoring spaces)
    $checkQuery = "SELECT * FROM subjects WHERE subName LIKE '$subName' AND courseName = '$course'";
    $checkResult = $connection->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Subject already exists, show error message
        $_SESSION['status'] = "Subject with the same name already exists in the selected course.";
        header('location: ../proghead/proghead.subjects.php');
    } else {
        // Subject doesn't exist, proceed with insertion
        $sql = "INSERT IGNORE INTO `subjects` (subName, courseName, profName) VALUES('$subName', '$course','$profName')";
        $result = $connection->query($sql);

        if ($result) {
            $_SESSION['status'] = "Subject Added!";
            header('location: ../proghead/proghead.subjects.php');
        } else {
            $_SESSION['status'] = "Subject not added.";
            header('location: ../proghead/proghead.subjects.php');
        }
    }
}
?>
