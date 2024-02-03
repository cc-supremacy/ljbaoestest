<?php
include("../session/session.php");
include("../connection/db.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve LRN and subject name from the form data
    $lrn = $_POST['lrn'];
    $subName = $_POST['subName'];

    // Sanitize and validate the form data (you may need to enhance this based on your requirements)
    $newSubMarks = filter_input(INPUT_POST, 'newSubMarks', FILTER_VALIDATE_INT);

    if ($newSubMarks !== false) {
        // Update the subMarks column in the grades table
        $updateQuery = "UPDATE grades SET subMarks = ? WHERE lrn = ? AND subName = ?";
        $stmt = $connection->prepare($updateQuery);

        if ($stmt) {
            $stmt->bind_param('iss', $newSubMarks, $lrn, $subName);
            $stmt->execute();
            $stmt->close();

            // Redirect back to the grades page or any other appropriate page
            header("Location: proghead.grades.php");
            exit();
        } else {
            // Handle the case when the prepared statement fails
            echo "Failed to prepare the statement.";
        }
    } else {
        // Handle the case when the form data is not valid
        echo "Invalid form data.";
    }
} else {
    // Handle the case when the form is not submitted
    echo "Form not submitted.";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Edit Grades</title>
    <link rel="stylesheet" href="../style/sidestyle.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php include('proghead.sidebar.php'); ?>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text"> &nbsp &nbsp &nbsp Edit Grades</span>
        </div><br>

        <?php
        // Retrieve LRN and subject name from the query parameters
        $lrn = $_GET['lrn'];
        $subName = $_GET['subName'];

        // Fetch the existing subMarks for the selected LRN and subject name
        $selectQuery = "SELECT subMarks FROM grades WHERE lrn = ? AND subName = ?";
        $stmt = $connection->prepare($selectQuery);

        if ($stmt) {
            $stmt->bind_param('ss', $lrn, $subName);
            $stmt->execute();
            $stmt->bind_result($subMarks);
            $stmt->fetch();
            $stmt->close();
        } else {
            // Handle the case when the prepared statement fails
            echo "Failed to prepare the statement.";
        }
        ?>

        <!-- Display the existing subMarks and provide a form to edit it -->
        <h2>Edit SubMarks for LRN: <?php echo $lrn; ?>, Subject: <?php echo $subName; ?></h2>
        <form method="post" action="edit_grades.php">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">New Submarks</label>
                                <div class="col-sm-6">
                                <input type="number" id="newSubMarks" class="form-control" name="newSubMarks" value="<?php echo $subMarks; ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">LRN</label>
                                <div class="col-sm-6">
                                <input type="text" name="lrn" class="form-control" value="<?php echo $lrn; ?>" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Subject Name</label>
                                <div class="col-sm-6">
                                <input type="text" name="subName" class="form-control" value="<?php echo $subName; ?>" readonly>
                                </div>
                            </div>
            
            
            <input type="submit" value="Update">
        </form>
    </section>

    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
