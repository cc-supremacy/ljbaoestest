<?php

require_once("../connection/config.php");
require_once "../vendor/autoload.php";

//use Twilio\Rest\Client;

if (isset($_POST['add_stud'])) {
    $lrn = trim($_POST['lrn']);

    // Check if the student with the given snum is already enrolled
    $checkQuery = "SELECT COUNT(*) FROM enrollment WHERE lrn = :lrn";
    $checkStmt = $db->prepare($checkQuery);
    $checkStmt->bindParam(':lrn', $lrn, PDO::PARAM_STR);
    $checkStmt->execute();
    $enrollmentCount = $checkStmt->fetchColumn();

    if ($enrollmentCount > 0) {
        // Student is already enrolled, display an alert and redirect
        echo '<script>alert("LRN has already been enrolled.");';
        echo 'window.location.replace("../proghead/proghead.enrolled.students.php");</script>';
        exit;
    }

    // If not enrolled, proceed with the enrollment process
    $reg_no = rand(100000000,999999999);
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

    $sqle = "INSERT INTO enrollment(fname, mname, lname, lrn, courseName, caddress, birth, age, fourps, fournum, pmobile, xname, reg_no, gmobile) 
            VALUES (:fname, :mname, :lname, :lrn, :courseName, :caddress, :birth, :age, :fourps, :fournum, :pmobile, :xname, :reg_no, :gmobile)";

    $stmt = $db->prepare($sqle);
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


    //Update enrollment column
    $updateQuery = "UPDATE students SET enrollment = 'YES' WHERE lrn = :lrn";
    $updateStmt = $db->prepare($updateQuery);
    $updateStmt->bindParam(':lrn', $lrn, PDO::PARAM_STR);
    $updateStmt->execute();
    
/*
    // Twilio Account SID and Auth Token
    $accountSid = 'AC7f4f3eae6bfa4bd72c4fe447d0bd57b5';
    $authToken = '5316d4f6824141d1621f4eacaa40ddf2';

    // Twilio phone number
    $twilioPhoneNumber = '+17813990598';

    // Initialize Twilio client
    $twilioClient = new Client($accountSid, $authToken);

    // Mobile number provided by the user
    $userMobileNumber = $pmobile;
    $name = $fname;
    $course = $courseName;

    // Send SMS
    try {
        $message = $twilioClient->messages->create(
            $userMobileNumber,
            [
                'from' => $twilioPhoneNumber,
                'body' => "HI $name! Your enrollment as $course was received!"
            ]
        );

        // Get Twilio message SID if needed
        $messageSid = $message->sid;
    } catch (Exception $e) {
        // Handle Twilio API exception if needed
        echo 'Error sending SMS: ' . $e->getMessage();
    }
*/
    // Redirect to preview.php with the enrollment ID
    header("location:../preview.php?id=" . $reg_no);
    exit;
}

?>
