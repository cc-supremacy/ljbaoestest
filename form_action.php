<?php

require_once("connection/config.php");
require_once "vendor/autoload.php";

if (isset($_POST['submit'])) {
    $reg_no = trim($_POST['reg_no']);

    // Check if the student with the given snum is already enrolled
    $checkQuery = "SELECT COUNT(*) FROM enrollment WHERE reg_no = :reg_no";
    $checkStmt = $db->prepare($checkQuery);
    $checkStmt->bindParam(':reg_no', $reg_no, PDO::PARAM_STR);
    $checkStmt->execute();
    $enrollmentCount = $checkStmt->fetchColumn();

    if ($enrollmentCount > 0) {
        // Student is already enrolled, display an alert and redirect
        echo '<script>alert("Student Number has already been enrolled.");';
        echo 'window.location.replace("student/student.schedule.php");</script>';
        exit;
    }

    // If not enrolled, proceed with the enrollment process
    // If not enrolled, proceed with the enrollment process
$reg_no = trim($_POST['reg_no']);
$fname = trim($_POST['fname']);
$mname = trim($_POST['mname']);
$lname = trim($_POST['lname']);
$xname = trim($_POST['xname']);
$pmobile = trim($_POST['pmobile']);
$gmobile = trim($_POST['gmobile']);
$courseName = trim($_POST['courseName']);
$caddress = trim($_POST['caddress']);
$birth = trim($_POST['birth']);
$age = trim($_POST['age']);
$fourps = trim($_POST['4ps']);
$fournum = trim($_POST['4psnum']);
$lrn = trim($_POST['lrn']);
$yearID = trim($_POST['yearID']);
$dateofenrollment = date("Y-m-d");

$sqle = "INSERT INTO enrollment(school_year, fname, mname, lname, lrn, courseName, caddress, birth, age, fourps, fournum, pmobile, xname, reg_no, gmobile, dateofenrollment, paid) 
        VALUES (:yearID, :fname, :mname, :lname, :lrn, :courseName, :caddress, :birth, :age, :fourps, :fournum, :pmobile, :xname, :reg_no, :gmobile, :dateofenrollment, 'no')";

$stmt = $db->prepare($sqle);
$stmt->bindParam(':yearID', $yearID, PDO::PARAM_STR);
$stmt->bindParam(':dateofenrollment', $dateofenrollment, PDO::PARAM_STR);
$stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
$stmt->bindParam(':mname', $mname, PDO::PARAM_STR);
$stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
$stmt->bindParam(':xname', $xname, PDO::PARAM_STR);
$stmt->bindParam(':courseName', $courseName, PDO::PARAM_STR);
$stmt->bindParam(':pmobile', $pmobile, PDO::PARAM_STR);
$stmt->bindParam(':gmobile', $gmobile, PDO::PARAM_STR);
$stmt->bindParam(':lrn', $lrn, PDO::PARAM_STR);
$stmt->bindParam(':caddress', $caddress, PDO::PARAM_STR);
$stmt->bindParam(':birth', $birth, PDO::PARAM_STR);
$stmt->bindParam(':age', $age, PDO::PARAM_STR);
$stmt->bindParam(':fourps', $fourps, PDO::PARAM_STR);
$stmt->bindParam(':fournum', $fournum, PDO::PARAM_STR);
$stmt->bindParam(':reg_no', $reg_no, PDO::PARAM_STR);
$stmt->execute();
$last_id = $db->lastInsertID();


    

    // Semaphore API Key
    $semaphoreApiKey = '32e4b035c774155ebc33d32581cbdc95';

    // Message to be sent
    $message = "This is Lord Jesus Blessed Academy, this is to inform you that $fname $mname $lname has applied for enrollment!";

    // Phone numbers
    $phoneNumbers = [$gmobile];

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    foreach ($phoneNumbers as $phoneNumber) {
        $parameters = [
            'apikey' => $semaphoreApiKey,
            'number' => $phoneNumber,
            'message' => $message,
            'sendername' => 'SEMAPHORE', // Replace with your desired sender name
        ];

        curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL session and get the response
        $output = curl_exec($ch);

        // Display the server response
        echo "Semaphore API Response: " . $output . "<br>";
    }

    // Close cURL session
    curl_close($ch);

    // Redirect to preview.php with the enrollment ID
    header("location:preview.php?id=" . $reg_no);
    exit;
}

?>
