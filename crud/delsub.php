<?php

if (isset($_GET["subject_id"])){
    $subject_id = $_GET["subject_id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cap";

    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE from subjects where subject_id=$subject_id";
    $connection->query($sql);
}

header("location: /captest/proghead/proghead.subjects.php");
exit;




?>