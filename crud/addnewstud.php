<?php
include("../connection/db.php");

$statusMss = '';
$status = 'danger';

$targetDir = 'uploads/';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $xname = $_POST['xname'];
    $birth = $_POST['birth'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $mobile = $_POST['mobile'];
    $pob = $_POST['pob'];
    $tongue = $_POST['tongue'];
    $strt = $_POST['strt'];
    $brgy = $_POST['brgy'];
    $mncpl = $_POST['mncpl'];
    $prvnc = $_POST['prvnc'];
    $cntry = $_POST['cntry'];
    $ffname = $_POST['ffname'];
    $fmname = $_POST['fmname'];
    $flname = $_POST['flname'];
    $mfname = $_POST['mfname'];
    $mmname = $_POST['mmname'];
    $mlname = $_POST['mlname'];
    $gfname = $_POST['gfname'];
    $gmname = $_POST['gmname'];
    $glname = $_POST['glname'];
    $lrn = $_POST['lrn'];
    $status = $_POST['status'];
    $hschool = $_POST['hschool'];
    $hstrt = $_POST['hstrt'];
    $hbrgy = $_POST['hbrgy'];
    $hmncpl = $_POST['hmncpl'];
    $hprvnc = $_POST['hprvnc'];
    $hcntry = $_POST['hcntry'];
    $pass = rand(100000, 999999);
    $reg_no = rand(10000000, 99999999);
    $enrollment = 'NO';
    

    
    $sql = "INSERT INTO `students` (enrollment, reg_no, fname, mname, lname, xname, birth, age, sex, mobile, pob, tongue, strt, brgy, mncpl, prvnc, cntry, fatherfname, fathermname, fatherlname,
    motherfname, mothermname, motherlname, guardianfname, guardianmname, guardianlname, lrn, stat, hschool, hstrt, hbrgy, hmncpl, hprvnc, hcntry, pass)
    VALUES ('$enrollment', '$reg_no', '$fname', '$mname', '$lname', '$xname', '$birth', '$age', '$sex', '$mobile', '$pob', '$tongue', '$strt', '$brgy', '$mncpl', '$prvnc', '$cntry', '$ffname', '$fmname', '$flname',
    '$mfname', '$mmname', '$mlname', '$gfname', '$gmname', '$glname', '$lrn', '$status', '$hschool', '$hstrt', '$hbrgy', '$hmncpl', '$hprvnc', '$hcntry', '$pass')";

    if ($connection->query($sql) === TRUE) {
        echo "<script> alert('Application received! Please login with the password sent to your mobile!')</script>";
        header('location: ../proghead/proghead.pending.students.php');
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}



/*
    
    $stmt = $connection->prepare($sqli);
    $stmt->bind_param("sssssssssssssssssssssssssssssssss", $fname, $mname, $lname, $birth, $age, $sex, $strt, $brgy, $mncpl, $prvnc, $cntry, $ffname, $fmname, $flname,
     $mfname, $mmname, $mlname, $gfname, $gmname, $glname, $lrn, $status, $hschool, $hstrt, $hbrgy, $hmncpl, $hprvnc, $hcntry, $pass, $imageData1, $imageData2, $imageData3, $imageData4);

    if ($stmt->execute()) {
        echo "Images uploaded successfully!";
    } else {
        echo "Error uploading images: " . $stmt->error;
    }

    $stmt->close();
    
   


    
require_once "vendor/autoload.php";
use Twilio\Rest\Client;

$sid = "AC8215d10e75d5b5dc9223af01a5afec52";
$token = "096aa0419647e7cfed492726168f2919";


if (isset($_POST["submit"])){
    $course = $_POST["course"];
    $name= $_POST["fname"];
    $phone = $_POST["mobile"];
    
    $client = new Client($sid, $token);
            $client->messages->create(
                $phone,array(
                    "from" => "+12566395358",
                    "body" => "HI $name from $course, PLEASE PROCEED TO PAYMENT METHODS!"
                )
                );
}  */
?>





