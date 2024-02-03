<?php

require_once(__DIR__ . '/vendor/autoload.php');

include("connection/db.php");

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
    $pastlvl = $_POST['pastlvl'];
    $lastyear = $_POST['lastyear'];
    $lastschool = $_POST['lastschool'];

    // Replace 'YOUR_SEMAPHORE_API_KEY' with your actual Semaphore API key
    $semaphoreApiKey = '32e4b035c774155ebc33d32581cbdc95';

    // Prepare SMS data
    $smsData = array(
        'apikey' => $semaphoreApiKey,
        'number' => $mobile,
        'message' => "Hi $fname ! Thank you for applying. Your password is: $pass",
        'sendername' => 'SEMAPHORE', // Adjust sender name as needed
    );

    // Set up cURL
    $ch = curl_init();
    $url = 'https://semaphore.co/api/v4/messages';

    // Configure cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($smsData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL and get the response
    $output = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Failed to send SMS. cURL Error: ' . curl_error($ch);
    } else {
        // Parse the response JSON
        $responseData = json_decode($output, true);

        // Check if 'status' key exists in the response array
        if (isset($responseData[0]['status'])) {
            if ($responseData[0]['status'] === 'Queued' || $responseData[0]['status'] === 'Pending') {
                // SMS is in the process of being sent
                echo 'SMS is pending. It will be delivered shortly.';
            } elseif ($responseData[0]['status'] === 'Sent') {
                // SMS sent successfully
                echo 'SMS sent successfully!';
            } else {
                // Handle other statuses
                echo 'Failed to send SMS. Error: ' . $responseData[0]['status'];
            }
        } else {
            // Handle missing 'status' key
            echo 'Failed to send SMS. Unexpected response format.';
        }
    }

    // Close cURL
    curl_close($ch);

    $sql = "INSERT INTO `students` (enrollment, reg_no, fname, mname, lname, xname, birth, age, sex, mobile, pob, tongue, strt, brgy, mncpl, prvnc, cntry, fatherfname, fathermname, fatherlname,
    motherfname, mothermname, motherlname, guardianfname, guardianmname, guardianlname, lrn, stat, hschool, hstrt, hbrgy, hmncpl, hprvnc, hcntry, pass, documents, pastlvl, lastyear, lastschool)
    VALUES ('$enrollment', '$reg_no', '$fname', '$mname', '$lname', '$xname', '$birth', '$age', '$sex', '$mobile', '$pob', '$tongue', '$strt', '$brgy', '$mncpl', '$prvnc', '$cntry', '$ffname', '$fmname', '$flname',
    '$mfname', '$mmname', '$mlname', '$gfname', '$gmname', '$glname', '$lrn', '$status', '$hschool', '$hstrt', '$hbrgy', '$hmncpl', '$hprvnc', '$hcntry', '$pass', '$selectedDocuments', '$pastlvl', '$lastyear', '$lastschool')";

    if ($connection->query($sql) === TRUE) {
        echo "<script> alert('Application received! Use the password sent to your mobile for login!'); window.location='student/student.login.php'; </script>";
        exit();  // Ensure that no further code is executed after the redirection
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}
?>
