<?php

if (isset($_GET["lrn"])){
    $lrn = $_GET["lrn"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cap";

    $connection = new mysqli($servername, $username, $password, $database);

    $kill = "DELETE from grades where lrn=$lrn";
    $connection->query($kill);
    $sql = "DELETE from enrollment where lrn=$lrn";
    $connection->query($sql);
    
}

header("location: /captest/proghead/proghead.enrolled.students.php");
exit;




?>