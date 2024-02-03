<?php

session_start();

session_destroy();

header('location: serverside.login.php');


?>