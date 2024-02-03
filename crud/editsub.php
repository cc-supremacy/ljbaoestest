<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "cap";

$connection = new mysqli($servername, $username, $password, $database);


$www = "Select Distinct courseName from section";
$win = mysqli_query($connection, $www);

$subject_id = "";
$subName = "";
$courseName = "";
$sub_category = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["subject_id"])) {
        header("location: /cap/proghead/proghead.subjects.php");
        exit;
    }

    $subject_id = $_GET["subject_id"];

    $sqq = "SELECT * from subjects where subject_id=$subject_id";
    $result = $connection->query($sqq);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /cap/proghead/progheaad.subjects.php");
        exit;
    }

    $subName = $row["subName"];
    $courseName = $row["courseName"];
    $sub_category = $row["sub_category"];
}
else {

        $subject_id = $_POST["subject_id"];
        $subName = $_POST["subName"];
        $course = $_POST["course"];
        $sub_category = $_POST["prof"];
    

        do {
            if ( empty($course) || empty($subName) || empty($sub_category)){
                $errorMessage = "Fill out all fields";
                break;
            }

            $edit = "UPDATE subjects
                    SET subName = '$subName', sub_category = '$sub_category', courseName = '$course' WHERE subject_id=$subject_id";

            $result2 = $connection->query($edit);

            if (!$result2){
                $errorMessage = "Invalid Query:" . $connection->error;
                break;
            }

            $successMessage = "Subject Updated!";
            header("location: ../proghead/proghead.subjects.php");
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
        <h2>Edit Subject</h2>

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
            <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>">
            <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Subject</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="subName" value="<?php echo $subName; ?>">
                    </div>
            </div>
            <br>
            <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Strand/Grade</label>
                    <div class="col-sm-6">
                    <select name="course" id=""  class="form-control">
                    <?php
            while ($rows = mysqli_fetch_array($win)) {
                $selected = ($rows['courseName'] == $courseName) ? 'selected' : '';
                ?>
                <option value="<?php echo $rows['courseName']; ?>" <?php echo $selected; ?>>
                    <?php echo $rows['courseName']; ?>
                </option>
            <?php
            }
            ?>
                            </select>
                    </div>
            </div>
            <br>
            <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Category</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="sub_category" value="<?php echo $sub_category; ?>">
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
    <a href="../proghead/proghead.subjects.php" class="btn btn-danger">Cancel</a>
</div>

            </div>
        </form>
    </div>
</body>
</html>