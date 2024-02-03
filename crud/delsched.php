<?php

if (isset($_GET["id"])){
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cap";

    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE from schedules where id=$id";
    $connection->query($sql);
}

header("location: /captest/proghead/proghead.schedules.php");
exit;




?>