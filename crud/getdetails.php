<?php
include("../connection/db.php");
if (isset($_GET['lrn'])) {
    $lrn = $_GET['lrn'];

    // Your database connection code here

    $sql = "SELECT * FROM students WHERE lrn = '$lrn'";
    $result = $connection->query($sql);

    if ($row = $result->fetch_assoc()) {
        // Display details
        echo "<p>LRN: {$row['lrn']}</p>";
        echo "<p>Registration Number: {$row['reg_no']}</p>";
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

echo "<p>Enrollment: {$row['enrollment']}</p>";
echo "<p>Selected Documents: {$row['documents']}</p>";
echo "<p>Past Level: {$row['pastlvl']}</p>";
echo "<p>Last Year: {$row['lastyear']}</p>";
echo "<p>Last School: {$row['lastschool']}</p>";


        // Add more details as needed
    } else {
        echo "Student not found.";
    }

    // Close the database connection if needed
    $connection->close();
} else {
    echo "LRN parameter is missing.";
}
?>
