<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "cap";

$connection = new mysqli($servername, $username, $password, $database);

$username = "";
$password = "";
$role = "";

$errorMessage = "";
$successMessage = "";

if ( isset($_POST['add_user'])){
    $username = $_POST["uname"];
    $password = $_POST["pass"];
    $role = $_POST["role"];
   
   


   
        $sql = "INSERT into `users` (username, password, role) VALUES('$username', '$password', '$role')";
        $result = $connection->query($sql);

        if ($result)
        {
            $_SESSION['status'] = "User Added!";
            header('location: ../proghead/proghead.users.php');
        }
        else
        {
            $_SESSION['status'] = "User not added.";
            header('location: ../proghead/proghead.users.php');
        }
}


?>




