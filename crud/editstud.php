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

$courseName = "";
$birth = "";
$age = "";
$caddress = "";
$pmobile = "";
$gmobile = "";



$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["lrn"])) {
        header("location: /captest/proghead/proghead.enrolled.students.php");
        exit;
    }

    $lrn = $_GET["lrn"];

    $sqq = "SELECT * from enrollment where lrn=$lrn";
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
    $courseName = $row["courseName"];
    $birth = $row["birth"];
    $age = $row["age"];
    $caddress = $row["caddress"];
    $pmobile = $row["pmobile"];
    $gmobile = $row["gmobile"];

}
else {
    $lrn = $_POST['lrn'];
    $fname=$_POST['fname'];
    $mname=$_POST['mname'];
    $lname=$_POST['lname'];
    $pmobile=$_POST['pmobile'];
    $gmobile=$_POST['gmobile'];
    $courseName=$_POST['course'];
    $caddress=$_POST['caddress'];
    $birth=$_POST['birth'];
    $age=$_POST['age'];
    

        do {
            if ( empty($courseName) || empty($fname) || empty($mname) || empty($lname) || empty($caddress) || empty($birth) || empty($age) || empty($pmobile) || empty($gmobile)){
                $errorMessage = "Fill out all fields";
                break;
            }

            $edit = "UPDATE enrollment
                    SET fname = '$fname', mname = '$mname', lname = '$lname', caddress = '$caddress', courseName = '$courseName', birth = '$birth', age = '$age', pmobile = '$pmobile', gmobile = '$gmobile' WHERE lrn=$lrn";

           

            $result2 = $connection->query($edit);

            if (!$result2){
                $_SESSION['status'] = "Student not updated.";
            header('location: ../proghead/proghead.enrolled.students.php');
            break;
            }

            $_SESSION['status'] = "Student Updated!";
            header('location: ../proghead/proghead.enrolled.students.php');
             exit;

        } while (false);

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
                    <label class="col-sm-3 col-form-label">Student Number:</label>
                    <div class="col-sm-6">
                    <input type="text" name="lrn" value="<?php echo $lrn; ?>" readonly>
                    </div>
            </div>
            <br>
            
            <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">First Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="fname" value="<?php echo $fname; ?>">
                    </div>
            </div>
            <br>
            <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Middle Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="mname" value="<?php echo $mname; ?>">
                    </div>
            </div>
            <br>
            <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Last Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="lname" value="<?php echo $lname; ?>">
                    </div>
            </div>
            <br>
           
            <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Strand/Grade</label>
                    <div class="col-sm-6">
                    <select name="course" id=""  class="form-control">
                                <?php
                                             while( $rows = mysqli_fetch_array($win)){
                                             ?>
                                <option value=" <?php echo $rows['courseName']; ?>"><?php echo $rows['courseName']; ?>
                                </option>
                                <?php
                                                  }
                                             ?>
                            </select>
                    </div>
            </div>
            <br>
            <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Current Address</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="caddress" value="<?php echo $caddress; ?>">
                    </div>
            </div>
            <br>
            <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Parent Mobile</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="pmobile" value="<?php echo $pmobile; ?>">
                    </div>
            </div>
            <br>
            <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Guardian Mobile</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="gmobile" value="<?php echo $gmobile; ?>">
                    </div>
            </div>
            <br>
            <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Birthday</label>
                    <div class="col-sm-6">
                        <input type="date" class="form-control" name="birth" value="<?php echo $birth; ?>">
                    </div>
            </div>
            <br>
            <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Age</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="age" value="<?php echo $age; ?>">
                    </div>
            </div>
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
    <a href="../proghead/proghead.enrolled.students.php" class="btn btn-danger">Cancel</a>
</div>

            </div>
        </form>
    </div>
</body>
</html>