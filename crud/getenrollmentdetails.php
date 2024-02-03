<?php
include("../connection/db.php");

if (isset($_GET['lrn'])) {
    $lrn = $_GET['lrn'];

    // Your database connection code here

    // Query the enrollment table
    $enrollmentSql = "SELECT * FROM enrollment WHERE lrn = '$lrn'";
    $enrollmentResult = $connection->query($enrollmentSql);

    if ($enrollmentRow = $enrollmentResult->fetch_assoc()) {
        // Display enrollment details
        echo "<p>LRN: {$enrollmentRow['lrn']}</p>";
        echo "<p>Grade/Strand: {$enrollmentRow['courseName']}</p>";
        echo "<p>Registration #: {$enrollmentRow['reg_no']}</p>";
        // ... (other enrollment details)

        // Query the students table
        $studentsSql = "SELECT * FROM students WHERE lrn = '$lrn'";
        $studentsResult = $connection->query($studentsSql);

        if ($row = $studentsResult->fetch_assoc()) {
            // Display students details
            echo "<div id='studentDetailsContainer'>";
            echo "<p>First Name: {$row['fname']}</p>";
echo "<p>Middle Name: {$row['mname']}</p>";
echo "<p>Last Name: {$row['lname']}</p>";
echo "<p>Extension Name: {$row['xname']}</p>";
echo "<p>Birth Date: {$row['birth']}</p>";
echo "<p>Age: {$row['age']}</p>";
echo "<p>Sex: {$row['sex']}</p>";
echo "<p>Mobile: {$row['mobile']}</p>";
echo "<p>Place of Birth: {$row['pob']}</p>";
echo "<p>Mother Tongue: {$row['tongue']}</p>";
echo "<p>Street: {$row['strt']}</p>";
echo "<p>Barangay: {$row['brgy']}</p>";
echo "<p>Municipality: {$row['mncpl']}</p>";
echo "<p>Province: {$row['prvnc']}</p>";
echo "<p>Country: {$row['cntry']}</p>";
echo "<p>Father's First Name: {$row['fatherfname']}</p>";
echo "<p>Father's Middle Name: {$row['fathermname']}</p>";
echo "<p>Father's Last Name: {$row['fatherlname']}</p>";
echo "<p>Mother's First Name: {$row['motherfname']}</p>";
echo "<p>Mother's Middle Name: {$row['mothermname']}</p>";
echo "<p>Mother's Last Name: {$row['motherlname']}</p>";
echo "<p>Guardian's First Name: {$row['guardianfname']}</p>";
echo "<p>Guardian's Middle Name: {$row['guardianmname']}</p>";
echo "<p>Guardian's Last Name: {$row['guardianlname']}</p>";
echo "<p>Status: {$row['stat']}</p>";
echo "<p>High School: {$row['hschool']}</p>";
echo "<p>High School Street: {$row['hstrt']}</p>";
echo "<p>High School Barangay: {$row['hbrgy']}</p>";
echo "<p>High School Municipality: {$row['hmncpl']}</p>";
echo "<p>High School Province: {$row['hprvnc']}</p>";
echo "<p>High School Country: {$row['hcntry']}</p>";
echo "<p>Password: {$row['pass']}</p>";
echo "<p>Selected Documents: {$row['documents']}</p>";
echo "<p>Past Level: {$row['pastlvl']}</p>";
echo "<p>Last Year: {$row['lastyear']}</p>";
echo "<p>Last School: {$row['lastschool']}</p>";
echo "</div>";
            // ... (other students details)
            echo "<button class='btn btn-secondary' id='backBtn'>Back</button>";
        } else {
            echo "Student details not found in the students table.";
        }
    } else {
        echo "Student not found in the enrollment table.";
    }

    // Close the database connection if needed
    $connection->close();
} else {
    echo "LRN parameter is missing.";
}
?>
