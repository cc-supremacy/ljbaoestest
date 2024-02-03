<?php
if (isset($_POST['courseName'])) {
    $courseName = $_POST['courseName'];

    $con = mysqli_connect("localhost", "root", "", "cap");
    $sqq = "SELECT secName FROM section WHERE courseName='$courseName' LIMIT 1";
    $res = mysqli_query($con, $sqq);
    
    if ($row = mysqli_fetch_assoc($res)) {
        echo $row['secName'];
    } else {
        echo "Section Not Found";
    }
}
?>
