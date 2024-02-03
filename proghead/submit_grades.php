<?php
require_once("../connection/config.php");

if (isset($_POST['submit_grades'])) {
    $lrn = $_POST['lrn'];
    $reg_no = $_POST['reg_no'];
    $schoolYear = $_POST['school_year'];

    // Loop through the POST data to get grades for each subject
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'subject_id_') === 0) {
            // This is a hidden input for subject_id
            $subName = substr($key, strlen('subject_id_'));
            $subjectId = $value;

            // Get the corresponding grade for this subject
            $gradeKey = $subName;
            $grade = $_POST[$gradeKey];

            // Validate and insert into the grades table
            $validatedGrade = filter_var($grade, FILTER_SANITIZE_STRING);

            $checkQuery = "SELECT COUNT(*) FROM grades WHERE subject_id = :subject_id AND lrn = :lrn AND reg_no = :reg_no AND school_year = :school_year";
            $checkStmt = $db->prepare($checkQuery);
            $checkStmt->bindParam(':subject_id', $subjectId, PDO::PARAM_INT);
            $checkStmt->bindParam(':lrn', $lrn, PDO::PARAM_STR);
            $checkStmt->bindParam(':reg_no', $reg_no, PDO::PARAM_STR);
            $checkStmt->bindParam(':school_year', $schoolYear, PDO::PARAM_INT);
            $checkStmt->execute();
            $gradeExists = $checkStmt->fetchColumn();

            if (!$gradeExists) {
                $insertQuery = "INSERT INTO grades (subject_id, subName, lrn, reg_no, subMarks, school_year) VALUES (:subject_id, :subName, :lrn, :reg_no, :subMarks, :school_year)";
                $insertStmt = $db->prepare($insertQuery);
                $insertStmt->bindParam(':subject_id', $subjectId, PDO::PARAM_INT);
                $insertStmt->bindParam(':subName', $subName, PDO::PARAM_STR);
                $insertStmt->bindParam(':lrn', $lrn, PDO::PARAM_STR);
                $insertStmt->bindParam(':reg_no', $reg_no, PDO::PARAM_STR);
                $insertStmt->bindParam(':subMarks', $validatedGrade, PDO::PARAM_STR);
                $insertStmt->bindParam(':school_year', $schoolYear, PDO::PARAM_INT);
                $insertStmt->execute();
            }
        }
    }

    // Fetch mobile number from the students table based on LRN
    $mobileQuery = "SELECT mobile FROM students WHERE lrn = :lrn";
    $mobileStmt = $db->prepare($mobileQuery);
    $mobileStmt->bindParam(':lrn', $lrn, PDO::PARAM_STR);
    $mobileStmt->execute();
    $mobile = $mobileStmt->fetchColumn();

    if (!$mobile) {
        // Handle the case where LRN does not exist
        echo "<script>alert('LRN not found. Unable to send SMS.');</script>";
        header('location:proghead.grades.php');
        exit();
    }

    // Use Semaphore API to send SMS
    $semaphoreApiKey = '32e4b035c774155ebc33d32581cbdc95';
    $message = "Your Grades for this School Year has been posted";

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    $parameters = [
        'apikey' => $semaphoreApiKey,
        'number' => $mobile,
        'message' => $message,
        'sendername' => 'SEMAPHORE', // Replace with your desired sender name
    ];

    curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session and get the response
    $output = curl_exec($ch);

    // Close cURL session
    curl_close($ch);

    // Display the server response
    echo "Semaphore API Response: " . $output;

    echo "<script>alert('Grades submitted successfully');</script>";
    header('location:proghead.grades.php');
}
?>
