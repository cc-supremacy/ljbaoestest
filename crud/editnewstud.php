<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "cap";

$connection = new mysqli($servername, $username, $password, $database);

$sss = "Select Distinct profName from teacheruser";
$req = mysqli_query($connection, $sss);
$www = "Select Distinct courseName from subjects";
$win = mysqli_query($connection, $www);

$lrn = "";
$fname = "";
$mname = "";
$lname = "";
$xname = "";
$birth = "";
$age = "";
$sex = "";
$mobile = "";
$pob = "";
$tongue = "";
$strt = "";
$stat = "";
$brgy = "";
$pass = "";
$mncpl = "";
$prvnc = "";
$cntry = "";
$ffname = ""; 
        $fmname = ""; 
        $flname = ""; 
        $mfname = ""; 
        $mmname = ""; 
        $mlname = ""; 
        $gfname = ""; 
        $gmname = ""; 
        $glname = ""; 
        $status = ""; 
        $hschool = ""; 
        $hstrt = ""; 
        $hbrgy = ""; 
        $hmncpl = ""; 
        $hprvnc = ""; 
        $hcntry = "";




$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["lrn"])) {
        header("location: /captest/proghead/proghead.enrolled.students.php");
        exit;
    }

    $lrn = $_GET["lrn"];

    $sqq = "SELECT * from students where lrn=$lrn";
    $result = $connection->query($sqq);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /captest/proghead/proghead.enrolled.students.php");
        exit;
    }

    $lrn = $row["lrn"];
    $fname = $row["fname"];
    $mname = $row["mname"];
    $lname = $row["lname"];
    $xname = $row["xname"];
    $birth = $row["birth"];
    $age = $row["age"];
    $sex = $row["sex"];
    $mobile = $row["mobile"]; 
        $pob = $row["pob"]; 
        $tongue = $row["tongue"]; 
        $strt = $row["strt"]; 
        $stat = $row['stat'];
        $pass = $row['pass'];
        $brgy = $row["brgy"]; 
        $mncpl = $row["mncpl"]; 
        $prvnc = $row["prvnc"]; 
        $cntry = $row["cntry"]; 
        $ffname = $row["fatherfname"]; 
        $fmname = $row["fathermname"]; 
        $flname = $row["fatherlname"]; 
        $mfname = $row["motherfname"]; 
        $mmname = $row["mothermname"]; 
        $mlname = $row["motherlname"]; 
        $gfname = $row["guardianfname"]; 
        $gmname = $row["guardianmname"]; 
        $glname = $row["guardianlname"]; 
        $hschool = $row["hschool"]; 
        $hstrt = $row["hstrt"]; 
        $hbrgy = $row["hbrgy"]; 
        $hmncpl = $row["hmncpl"]; 
        $hprvnc = $row["hprvnc"]; 
        $hcntry = $row["hcntry"];
        $reg_no = $row["reg_no"];
}
else {
        $lrn = $_POST['lrn'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $xname = $_POST['xname']; 
        $birth = $_POST['birth'];
        $age = $_POST['age'];
        $sex = $_POST['sex']; 
        $pass = $_POST['pass'];
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
        $status = $_POST['stat']; 
        $hschool = $_POST['hschool']; 
        $hstrt = $_POST['hstrt']; 
        $hbrgy = $_POST['hbrgy']; 
        $hmncpl = $_POST['hmncpl']; 
        $hprvnc = $_POST['hprvnc']; 
        $hcntry = $_POST['hcntry'];
        
    

        if (empty($fname)){
            $errorMessage = "Fill out all fields";
        } else {
            $edit = "UPDATE students SET
            fname = '$fname',
            mname = '$mname',
            lname = '$lname',
            xname = '$xname',
            birth = '$birth',
            age = '$age',
            sex = '$sex',
            mobile = '$mobile',
            pob = '$pob',
            tongue = '$tongue',
            pass = '$pass',
            strt = '$strt',
            brgy = '$brgy',
            mncpl = '$mncpl',
            prvnc = '$prvnc',
            cntry = '$cntry',
            fatherfname = '$ffname',
            fathermname = '$fmname',
            fatherlname = '$flname',
            motherfname = '$mfname',
            mothermname = '$mmname',
            motherlname = '$mlname',
            guardianfname = '$gfname',
            guardianmname = '$gmname',
            guardianlname = '$glname',
            stat = '$status',
            hschool = '$hschool',
            hstrt = '$hstrt',
            hbrgy = '$hbrgy',
            hmncpl = '$hmncpl',
            hprvnc = '$hprvnc',
            hcntry = '$hcntry' 
            
            WHERE lrn = '$lrn' ";


            $result2 = $connection->query($edit);
        
            if (!$result2){
                $_SESSION['status'] = "Student not updated.";
                header('location: ../proghead/proghead.pending.students.php');
            } else {
                $_SESSION['status'] = "Student Updated!";
                header('location: ../proghead/proghead.pending.students.php');
                exit;
            }
        }
    }
    ?>
    


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Edit Student</title>
</head>
<body>
    <div class="container my-5">
        <h2>Edit Student</h2>

        <?php
            if (!empty($errorMessage)){
                echo "
                        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>$errorMessage</strong>
                              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                ";
            }
        ?>
        <form method="post">
        <div class="row mb-3">
                <label class="col-sm-3 col-form-label">LRN:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="lrn" value="<?php echo $lrn; ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Registration Number:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="reg_no" value="<?php echo $reg_no; ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">First Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="fname" value="<?php echo $fname; ?>">
                </div>
            </div><div class="row mb-3">
                <label class="col-sm-3 col-form-label">Middle Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="mname" value="<?php echo $mname; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Last Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="lname" value="<?php echo $lname; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Extension Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="xname" value="<?php echo $xname; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Birthday:</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="birth" value="<?php echo $birth; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Age:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="age" value="<?php echo $age; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Sex:</label>
                <div class="col-sm-6">
                    <select class="form-control" name="sex">
                        <option value="Male" <?php echo ($sex === 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($sex === 'Female') ? 'selected' : ''; ?>>Female</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Mobile:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="mobile" value="<?php echo $mobile; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Place of Birth:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="pob" value="<?php echo $pob; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Mother Tongue:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="tongue" value="<?php echo $tongue; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Street:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="strt" value="<?php echo $strt; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Barangay:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="brgy" value="<?php echo $brgy; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Municipality/City:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="mncpl" value="<?php echo $mncpl; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Province:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prvnc" value="<?php echo $prvnc; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Country:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="cntry" value="<?php echo $cntry; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Father's First Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ffname" value="<?php echo $ffname; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Father's Middle Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="fmname" value="<?php echo $fmname; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Father's Last Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="flname" value="<?php echo $flname; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Mother's First Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="mfname" value="<?php echo $mfname; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Mother's Middle Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="mmname" value="<?php echo $mmname; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Mother's Last Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="mlname" value="<?php echo $mlname; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Guardian's First Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="gfname" value="<?php echo $gfname; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Guardian's Middle Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="gmname" value="<?php echo $gmname; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Guardian's Last Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="glname" value="<?php echo $glname; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Status:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="stat" value="<?php echo $stat; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Previous School:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="hschool" value="<?php echo $hschool; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Street:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="hstrt" value="<?php echo $hstrt; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Barangay:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="hbrgy" value="<?php echo $hbrgy; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Municipality/City:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="hmncpl" value="<?php echo $hmncpl; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Province:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="hprvnc" value="<?php echo $hprvnc; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Country:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="hcntry" value="<?php echo $hcntry; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Pass:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="pass" value="<?php echo $pass; ?>">
                </div>
            </div>
            <br>
            <br>
            
            <?php
            if (!empty($successMessage)){
                echo "
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>$successMessage</strong>
                              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                ";
            }
        ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <div class="col-sm-3 d-grid">
    <a href="../proghead/proghead.pending.students.php" class="btn btn-danger">Cancel</a>
</div>

            </div>
        </form>
    </div>
</body>
</html>