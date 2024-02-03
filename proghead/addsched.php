<?php
session_start();

$logFilePath = 'C:/xampp/htdocs/captest/log.file';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', $logFilePath);


// Function to check for schedule overlap and insert a new schedule
function checkAndInsertSchedule($newSchedule, $logFilePath) {
    // Database connection information
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cap";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        error_log("Connection failed: " . $conn->connect_error);
        die("Connection failed: " . $conn->connect_error);
    }

    // Begin a transaction
    $conn->begin_transaction();

    try {
        // Check if there are existing rows with overlapping time range in the same room
        $checkQuery = "SELECT * FROM schedules WHERE day_of_week = ? AND room_name = ? AND ((start_time < ? AND end_time > ?) OR (start_time < ? AND end_time > ?))";
        $checkStatement = $conn->prepare($checkQuery);
        $checkStatement->bind_param(
            "ssssss",
            $newSchedule['day_of_week'],
            $newSchedule['room_name'],
            $newSchedule['end_time'],
            $newSchedule['start_time'],
            $newSchedule['start_time'],
            $newSchedule['end_time']
        );

        // Execute the check query
        if (!$checkStatement->execute()) {
            error_log("Error checking for schedule overlap: " . $checkStatement->error);
            $_SESSION['status'] = "Error checking for schedule overlap";
            header('location: ../proghead/proghead.schedules.php');
            $conn->rollback();
            return;
        }

        $checkResult = $checkStatement->get_result();

        if ($checkResult->num_rows > 0) {
            // Overlap found, rollback the transaction
            $_SESSION['status'] = "There is already a scheduled class in the chosen day and time";
            header('location: ../proghead/proghead.schedules.php');
            $conn->rollback();
        } else {
            // Check if there are existing rows with the same professor, day, start time, and end time
            $professorCheckQuery = "SELECT * FROM schedules WHERE day_of_week = ? AND prof_id = ? AND start_time = ? AND end_time = ?";
            $professorCheckStatement = $conn->prepare($professorCheckQuery);
            $professorCheckStatement->bind_param(
                "ssss",
                $newSchedule['day_of_week'],
                $newSchedule['prof_id'],
                $newSchedule['start_time'],
                $newSchedule['end_time'],
                
            );

            // Execute the professor check query
            if (!$professorCheckStatement->execute()) {
                error_log("Error checking for professor schedule overlap: " . $professorCheckStatement->error);
                $_SESSION['status'] = "Error checking for professor schedule overlap";
                header('location: ../proghead/proghead.schedules.php');
                $conn->rollback();
                return;
            }

            $professorCheckResult = $professorCheckStatement->get_result();

            // If there is a row, the input is ignored
            if ($professorCheckResult->num_rows > 0) {
                $_SESSION['status'] = "The same professor is already scheduled at the same day, start time, and end time";
                header('location: ../proghead/proghead.schedules.php');
                $conn->rollback();
            } else {
                try {
                    // No overlap with the professor or different room, proceed with fetching courseName
                    $courseNameQuery = "SELECT courseName FROM subjects WHERE subject_id = ?";
                    $courseNameStatement = $conn->prepare($courseNameQuery);
                    $courseNameStatement->bind_param("s", $newSchedule['subject_id']);

                    // Execute the course name query
                    if (!$courseNameStatement->execute()) {
                        error_log("Error fetching course name: " . $courseNameStatement->error);
                        $_SESSION['status'] = "Error fetching course name";
                        header('location: ../proghead/proghead.schedules.php');
                        $conn->rollback();
                        return;
                    }

                    $courseNameResult = $courseNameStatement->get_result();

                    if ($courseNameResult->num_rows > 0) {
                        $courseNameRow = $courseNameResult->fetch_assoc();
                        $newSchedule['courseName'] = $courseNameRow['courseName'];

                        // Insert the schedule
                        $insertQuery = "INSERT INTO schedules (day_of_week, start_time, end_time, room_name, subject_id, courseName, prof_id, section) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                        $insertStatement = $conn->prepare($insertQuery);
                        $insertStatement->bind_param(
                            "ssssssss",
                            $newSchedule['day_of_week'],
                            $newSchedule['start_time'],
                            $newSchedule['end_time'],
                            $newSchedule['room_name'],
                            $newSchedule['subject_id'],
                            $newSchedule['courseName'],
                            $newSchedule['prof_id'],
                            $newSchedule['section']
                        );

                        // Execute the insert query
                        if (!$insertStatement->execute()) {
            // Handle the error and log it
            $errorMessage = "Error inserting schedule: " . $insertStatement->error;
            error_log($errorMessage, 3, $logFilePath); // 3 means append to the file

            $_SESSION['status'] = "Error inserting schedule";
            header('location: ../proghead/proghead.schedules.php');
            $conn->rollback();
            return;
        }

                        $_SESSION['status'] = "Schedule Added!";
                        
                        header('location: ../proghead/proghead.schedules.php');

                        // Commit the transaction
                        $conn->commit();
                    } else {
                        // Invalid subject_id, rollback the transaction
                        $_SESSION['status'] = "Invalid subject code";
                        header('location: ../proghead/proghead.schedules.php');
                        $conn->rollback();
                    }
                } catch (Exception $e) {
        // Handle exceptions if any
        $errorMessage = "Error: " . $e->getMessage();
        error_log($errorMessage, 3, $logFilePath); // 3 means append to the file

        $_SESSION['status'] = "An error occurred while processing your request. Please try again later.";
        header('location: ../proghead/proghead.schedules.php');
        $conn->rollback();
                }
            }
        }
    } finally {
        // Close the database connection
        $conn->close();
    }
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sample new schedule input (replace this with your actual data from the form)
    $newSchedule = [
        'day_of_week' => $_POST['day_of_week'],
        'start_time' => $_POST['start_time'],   
        'end_time' => $_POST['end_time'],
        'room_name' => $_POST['room_name'],
        'subject_id' => trim($_POST['subject_id']),
        'courseName' => '', // Initialize courseName, it will be fetched later
        'prof_id' => $_POST['prof_id'],
        'section' => $_POST['section'],
    ];

    // Perform the schedule checking and insertion
    checkAndInsertSchedule($newSchedule, $logFilePath);
}
?>
