<?php
    session_start();

    if(isset($_SESSION['id'])){
        $profName  = $_SESSION['profName'];
        $dept = $_SESSION['dept'];
        $email = $_SESSION['email'];
        $mobile = $_SESSION['mobile'];
        
       

    }else{

    }


?>