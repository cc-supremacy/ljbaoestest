<?php
require_once("../connection/config.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Grades</title>
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
            <span class="text"> &nbsp &nbsp &nbsp Grading</span>
        </div>

        <?php
        if (isset($_GET['lrn'])) {
            $lrn = $_GET['lrn'];

            $sql = "SELECT * FROM enrollment WHERE lrn = :lrn";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':lrn', $lrn, PDO::PARAM_STR);
            $stmt->execute();
            $student = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($student) {
                // Fetch school year details
                $schoolYearId = $student['school_year'];
                $schoolYearQuery = "SELECT * FROM school_years";
                $schoolYearStmt = $db->prepare($schoolYearQuery);
                $schoolYearStmt->execute();
                $schoolYears = $schoolYearStmt->fetchAll(PDO::FETCH_ASSOC);
                // Display student information
                echo "<br><br><br><h2>Student Information</h2>";
                echo "<p>Name: {$student['fname']} {$student['mname']} {$student['lname']} {$student['xname']}</p>";
                echo "<p>Strand/Grade: {$student['courseName']}</p>";
                echo "<form method='post' action='submit_grades.php'>";
                echo "<p>School Year: ";
                echo "<select name='school_year' required>";
                foreach ($schoolYears as $year) {
                    $selected = ($year['yearID'] == $schoolYearId) ? 'selected' : '';
                    echo "<option value='{$year['yearID']}' $selected>{$year['description']}</option>";
                }
                echo "</select></p><br><br><br>";

                // Fetch subjects for the courseName
                $courseName = $student['courseName'];
                $subjectQuery = "SELECT subject_id, subName FROM subjects WHERE courseName = :courseName";
                $subjectStmt = $db->prepare($subjectQuery);
                $subjectStmt->bindParam(':courseName', $courseName, PDO::PARAM_STR);
                $subjectStmt->execute();
                $subjects = $subjectStmt->fetchAll(PDO::FETCH_ASSOC);

                // Create a form for grading
                echo "<h2>Grading</h2>";
                
                echo "<input type='hidden' name='lrn' value='$lrn'>";
                echo "<input type='hidden' name='reg_no' value='{$student['reg_no']}'>";
                
                // Loop through subjects to display form fields
                foreach ($subjects as $subject) {
                    $subjectId = $subject['subject_id'];
                    $subName = $subject['subName'];
                
                    echo "<br><label for='{$subName}'>Grade for {$subName}:</label>";
                    echo "<input type='text' id='{$subName}' name='{$subName}' required>";
                    // Include hidden input for subject_id
                    echo "<input type='hidden' name='subject_id_{$subName}' value='{$subjectId}'>";
                    echo "<br><br>";
                }
                echo "<input type='submit' name='submit_grades' value='Submit Grades'>";
                echo "</form>";
            } else {
                echo "Student not found.";
            }
        }
        ?>
    </section>

    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
