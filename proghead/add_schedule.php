<?php
// Include session and connection files
include("../session/session.php");
include("../connection/db.php");

// Check if the form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape and sanitize form data to prevent SQL injection
    $room = mysqli_real_escape_string($connection, $_POST["room"]);
    $sectionId = mysqli_real_escape_string($connection, $_POST["sectionId"]);
    $subjectId = mysqli_real_escape_string($connection, $_POST["subjectId"]);
    $profId = mysqli_real_escape_string($connection, $_POST["profId"]);
    $dayOfWeek = mysqli_real_escape_string($connection, $_POST["day_of_week"]);
    $startTime = mysqli_real_escape_string($connection, $_POST["start_time"]);
    $endTime = mysqli_real_escape_string($connection, $_POST["end_time"]);

    // Check for any schedule during the specified time for the selected teacher
    // Check for any schedule during the specified time for the selected teacher
        $sqlCheckExistingSchedule = "SELECT * FROM schedule
                                    WHERE prof_id = '$profId'
                                    AND (
                                    ('$startTime' BETWEEN DATE_SUB(start_time, INTERVAL 1 MINUTE) AND DATE_ADD(end_time, INTERVAL 1 MINUTE))
                                    OR ('$endTime' BETWEEN DATE_SUB(start_time, INTERVAL 1 MINUTE) AND DATE_ADD(end_time, INTERVAL 1 MINUTE))
                                    OR (start_time <= DATE_SUB('$startTime', INTERVAL 1 MINUTE) AND end_time >= DATE_ADD('$endTime', INTERVAL 1 MINUTE))
                                    )";


    $resultCheckExistingSchedule = mysqli_query($connection, $sqlCheckExistingSchedule);

    if ($resultCheckExistingSchedule) {
        // Check if there is any overlapping schedule
        if (mysqli_num_rows($resultCheckExistingSchedule) == 0) {
            // If there are no overlapping schedules, proceed with the insert
            // Perform SQL insert
            $sqlInsert = "INSERT INTO schedule (room_id, section_id, subject_id, prof_id, day, start_time, end_time) 
                          VALUES ((SELECT room_id FROM rooms WHERE room_name = '$room'),
                                  '$sectionId', '$subjectId', '$profId', '$dayOfWeek', '$startTime', '$endTime')";

            if (mysqli_query($connection, $sqlInsert)) {
                // If the schedule is added successfully, return a success response
                echo "Successfully added schedule";
            } else {
                // If there is an error adding the schedule, return an error response
                echo "Error adding schedule: " . mysqli_error($connection);
            }
        } else {
            // If there is an overlapping schedule, return a specific response
            echo "Teacher already has a schedule during this time. Please select another time or teacher.";
        }
    } else {
        // If there is an error in the query, return an error response
        echo "Error: " . mysqli_error($connection);
    }
} else {
    // If the script is accessed in a way other than POST, handle accordingly
    echo "Invalid access";
}

// Close the database connection
mysqli_close($connection);
?>
