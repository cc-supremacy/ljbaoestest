<?php
include("../session/student.session.php");
include("../connection/db.php");

// Check if the user's LRN is available in the session
if (isset($_SESSION['lrn'])) {
    $lrn = $_SESSION['lrn'];

    $query = "SELECT g.subMarks, s.subName, s.subject_id, s.courseName, g.school_year, g.LRN
              FROM grades g
              JOIN subjects s ON g.subject_id = s.subject_id
              WHERE g.LRN = '$lrn'";
    $result = mysqli_query($connection, $query);

    $data = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    if (empty($data)) {
        // No grades found for the student
        echo json_encode(array('error' => 'You still have no grades for the school year'));
        // Redirect to student.profile.php
        header('Location: student.profile.php');
        exit;
    } else {
        // Grades found, echo them as JSON
        echo json_encode($data);
    }
} else {
    echo json_encode(array('error' => 'LRN not found in session'));
}
?>
