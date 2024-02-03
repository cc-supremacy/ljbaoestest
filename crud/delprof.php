<?php

if (isset($_GET["prof_id"])){
    $prof_id = $_GET["prof_id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cap";

    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE from teacheruser where prof_id=$prof_id";
    $connection->query($sql);
}

header("location: /captest/proghead/proghead.professors.php");
exit;




?>