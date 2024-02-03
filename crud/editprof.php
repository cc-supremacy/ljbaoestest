<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "cap";

$connection = new mysqli($servername, $username, $password, $database);

$sss = "Select Distinct profName from teacheruser";
    $req = mysqli_query($connection, $sss);


$prof_id = "";
$profName = "";
$email = "";
$dept = "";
$mobile = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET'){

    if (!isset($_GET["prof_id"])){
        header("location: /cap/proghead/proghead.professors.php");
        exit;
    }

    $prof_id = $_GET["prof_id"];

    $sqq = "SELECT * from teacheruser where prof_id=$prof_id";
    $result = $connection->query($sqq);
    $row = $result->fetch_assoc();

    if (!$row){
        header("location: /cap/proghead/progheaad.professors.php");
        exit;
    }

    $profName = $row["profName"];
    $email = $row["email"];
    $dept = $row["dept"];
 
    $mobile = $row["mobile"];


}
else {

        $prof_id = $_POST["prof_id"];
        $profName = $_POST["profName"];
        $email = $_POST["email"];
        $dept = $_POST["dept"];
        $mobile = $_POST["mobile"];
    

        do {
            if ( empty($profName) || empty($dept) || empty($email) || empty($mobile)){
                $errorMessage = "Fill out all fields";
                break;
            }

            $edit = "UPDATE teacheruser
                    SET profName = '$profName', dept = '$dept' , email ='$email', mobile = '$mobile' WHERE prof_id=$prof_id";

            $result2 = $connection->query($edit);

            if (!$result2){
                $errorMessage = "Invalid Query:" . $connection->error;
                break;
            }

            $successMessage = "Professor Information Updated!";
            header("location: ../proghead/proghead.professors.php");
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
    <title>Edit Subject</title>
</head>
<body>
    <div class="container my-5">
        <h2>Update Professor Information</h2>

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
            <input type="hidden" name="prof_id" value="<?php echo $prof_id; ?>">
            <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Professor Name:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="profName" value="<?php echo $profName; ?>">
                    </div>
            </div>
            <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Department</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="dept" value="<?php echo $dept; ?>">
                    </div>
            </div>
            <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Mobile</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="mobile" value="<?php echo $mobile; ?>">
                    </div>
            </div>
            <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                    </div>
            </div>
            
        

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
                    <button type="submit" class="btn btn-danger">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>