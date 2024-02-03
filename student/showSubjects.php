<?php

$kCourse = $_POST['courseName'];

$kCourse = trim($kCourse);

$con = mysqli_connect("localhost", "root", "", "cap");
$sqq = "SELECT *, 
                DATE_FORMAT(start_time, '%h:%i %p') AS formattedStartTime, 
                DATE_FORMAT(end_time, '%h:%i %p') AS formattedEndTime 
        FROM schedules 
        WHERE courseName='$kCourse'";
$res = mysqli_query($con, $sqq);

while ($rows = mysqli_fetch_array($res)) {
    // Fetch subject name based on subject_id
    $subjectId = $rows['subject_id'];
    $subjectQuery = "SELECT subName FROM subjects WHERE subject_id='$subjectId'";
    $subjectResult = mysqli_query($con, $subjectQuery);
    $subjectRow = mysqli_fetch_array($subjectResult);
    $subName = $subjectRow['subName'];

    // Fetch professor name based on prof_id
    $profId = $rows['prof_id'];
    $profQuery = "SELECT profName FROM teacheruser WHERE prof_id='$profId'";
    $profResult = mysqli_query($con, $profQuery);
    $profRow = mysqli_fetch_array($profResult);
    $profName = $profRow['profName'];
    ?>
    <tr>
        <td style="text-align: center;"><?php echo $rows['courseName']; ?> </td>
        <td style="text-align: center;"><?php echo $subName; ?> </td>
        <td style="text-align: center;"><?php echo $profName; ?> </td>
        <td style="text-align: center;"><?php echo $rows['day_of_week']; ?> </td>
        <td style="text-align: center;"><?php echo $rows['formattedStartTime']; ?> </td>
        <td style="text-align: center;"><?php echo $rows['formattedEndTime']; ?> </td>
    </tr>
    <?php
}

// Close the database connection
mysqli_close($con);
?>
