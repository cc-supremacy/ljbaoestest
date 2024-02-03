<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "cap";

$connection = new mysqli($servername, $username, $password, $database);

$profName = "";
$dept = "";
$email = "";
$mobile = "";
$pass = "";

$errorMessage = "";
$successMessage = "";

if ( isset($_POST['add_prof'])){
    $profName = $_POST["profName"];
    $dept = $_POST["dept"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
   


   
        $sql = "INSERT into `teacheruser` (profName, dept, email, mobile) VALUES('$profName', '$dept', '$email', '$mobile')";
        $result = $connection->query($sql);

        if ($result)
        {
            $_SESSION['status'] = "Professor Added!";
            header('location: ../proghead/proghead.professors.php');
        }
        else
        {
            $_SESSION['status'] = "Professor not added.";
            header('location: ../proghead/proghead.professors.php');
        }
}


?>




