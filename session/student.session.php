<?php
    session_start();

    if(isset($_SESSION['id'])){
        $mobile   = $_SESSION['mobile'];
        $fname    = $_SESSION['fname'];
        $mname    = $_SESSION['mname'];
        $lname    = $_SESSION['lname'];
        $xname    = $_SESSION['xname'];
        $birth    = $_SESSION['birth'];
        $pob      = $_SESSION['pob'];
        $tongue   = $_SESSION['tongue'];
        $age      = $_SESSION['age'];
        $sex      = $_SESSION['sex'];
        $strt     = $_SESSION['strt'];
        $brgy     = $_SESSION['brgy'];
        $mncpl    = $_SESSION['mncpl'];
        $prvnc    = $_SESSION['prvnc'];
        $cntry    = $_SESSION['cntry'];
        $ffname   = $_SESSION['ffname'];
        $fmname   = $_SESSION['fmname'];
        $flname   = $_SESSION['flname'];
        $mfname   = $_SESSION['mfname'];
        $mmname   = $_SESSION['mmname'];
        $mlname   = $_SESSION['mlname'];
        $gfname   = $_SESSION['gfname'];
        $gmname   = $_SESSION['gmname'];
        $glname   = $_SESSION['glname'];
        $lrn      = $_SESSION['lrn'];
        $stat     = $_SESSION['stat'];
        $hschool  = $_SESSION['hschool'];
        $hstrt    = $_SESSION['hstrt'];
        $hbrgy    = $_SESSION['hbrgy'];
        $hmncpl   = $_SESSION['hmncpl'];
        $hprvnc   = $_SESSION['hprvnc'];
        $hcntry   = $_SESSION['hcntry'];
        $lastyear  = $_SESSION['lastyear'];
        $lastschool  = $_SESSION['lastschool'];
        $pastlvl  = $_SESSION['pastlvl'];
        $reg_no = $_SESSION['reg_no'];
        $documents = $_SESSION['documents'];
        $enrollment = $_SESSION['enrollment'];
    } else {
        // Handle the case when session variables are not set
    }
?>
