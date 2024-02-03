<?php require_once('connection/config.php');
$reg_no=$_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollment Card</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style/previewstyle.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10" style="border: 2px solid black;padding: 10px">
            <?php
                $sqli = "SELECT e.*, s.description AS school_year_description
                        FROM enrollment e
                        JOIN school_years s ON e.school_year = s.yearID
                        WHERE e.reg_no=:reg_no";
                $stmt = $db->prepare($sqli);
                $stmt->bindParam(':reg_no', $reg_no, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
            ?>
                <div class="row">
                    <div class="col-2">
                        <img src="images/logo.png" class="img-fluid">
                    </div>
                    <div class="col">
                        <div class="main-heading">Lord Jesus Blessed Academy</div>
                        <p class="sub-heading" style="text-align:center">"Train up a child in the way he should go and when he is old,
                    he will not depart from it."</p>
                        <div class="address" style="text-align:center">
                            Blk. 10 Lot 34 G3 Francisco Homes, City of San Jose Del Monte, Bulacan
                        </div>
                        <p class="email">Contact No: 0928-222-56-16 Website: www.lordjesusblessedacademy.com</p>
                    </div>
                    <div class="col-sm-12">
                        <hr class="hrcls">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8" style="text-align: center;padding-bottom: 5px;">
                        <h3> <u>ENROLLMENT CARD</u></h3>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
                <div class="row">
    <div class="col-8">
        <!-- Left side content -->
        <div class="form-group row">
                                <div class="col-4">
                                    <label class="label">School Year:</label>
                                </div>
                                <div class="col-5">
                                    <strong><?php echo $row['school_year_description']; ?> </strong>
                                </div>
                            </div>
                <div class="form-group row">
                            <div class="col-4">
                                <label class="label">LRN:</label>
                            </div>
                            <div class="col-5">
                                <strong><?php echo $row['lrn']; ?> </strong>
                            </div>
                        </div>
        <div class="form-group row">
                            <div class="col-4">
                                <label class="label">Full Name:</label>
                            </div>
                            <div class="col-5">
                            <strong><?php echo $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname'] . ' ' . $row['xname']; ?></strong>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                                <label class="label">Birthdate:</label>
                            </div>
                            <div class="col-5">
                                <strong><?php echo $row['birth']; ?> </strong>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                                <label class="label">Age:</label>
                            </div>
                            <div class="col-5">
                                <strong><?php echo $row['age']; ?> </strong>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                                <label class="label">Current Address:</label>
                            </div>
                            <div class="col-5">
                                <strong><?php echo $row['caddress']; ?> </strong>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                                <label class="label">Parent Mobile:</label>
                            </div>
                            <div class="col-5">
                                <strong><?php echo $row['pmobile']; ?> </strong>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                                <label class="label">Guardian Mobile:</label>
                            </div>
                            <div class="col-5">
                                <strong><?php echo $row['gmobile']; ?> </strong>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                                <label class="label">4PS BENEFICIARY:</label>
                            </div>
                            <div class="col-5">
                                <strong><?php echo $row['fourps']; ?> </strong>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-4">
                            <label class="label">Tuition Fee:</label>
                        <?php
                        // Fetch tuition fee details based on courseName
                        $courseName = $row['courseName'];
                        $tuitionQuery = "SELECT fee, misc, downp FROM tuitionfee WHERE courseName = :courseName";
                        $tuitionStmt = $db->prepare($tuitionQuery);
                        $tuitionStmt->bindParam(':courseName', $courseName, PDO::PARAM_STR);
                        $tuitionStmt->execute();
                        $tuitionDetails = $tuitionStmt->fetch(PDO::FETCH_ASSOC);
                        ?>
                     
                        <?php 
                        // Display tuition fee details
                        echo 'Base Fee: ₱' . $tuitionDetails['fee'] . '<br>';
                        echo 'Miscellaneous: ₱' . $tuitionDetails['misc'] . '<br>';
                        echo 'Down Payment: ₱' . $tuitionDetails['downp'] . '<br>';
                        ?>
                        
                            </div>
                        </div>

        <!-- Add more left side labels and values as needed -->
    </div>
    <div class="col-4">
        <!-- Right side content -->
        <div class="form-group row">
            <div class="col-10">
                <label class="label">Grade Level:</label>
                
                                <strong><?php echo $row['courseName']; ?> </strong>
        </div>
        <div class="form-group row">
        <div class="form-group row">
    <div class="col-10">
    <label class="label">Subjects:</label>
    <ul><strong>
    <?php
        // Fetch subjects and related details for the courseName
        $courseName = $row['courseName'];
        $subjectQuery = "SELECT subj.subName, s.day_of_week, DATE_FORMAT(s.start_time, '%h:%i') AS formattedStartTime, DATE_FORMAT(s.end_time, '%h:%i %p') AS formattedEndTime
                        FROM schedules s
                        JOIN subjects subj ON s.subject_id = subj.subject_id
                        WHERE s.courseName = :courseName";
        $subjectStmt = $db->prepare($subjectQuery);
        $subjectStmt->bindParam(':courseName', $courseName, PDO::PARAM_STR);
        $subjectStmt->execute();
        $subjects = $subjectStmt->fetchAll(PDO::FETCH_ASSOC);

        // Group subjects by name
        $groupedSubjects = [];
        foreach ($subjects as $subject) {
            $subjectName = $subject['subName'];
            if (!isset($groupedSubjects[$subjectName])) {
                $groupedSubjects[$subjectName] = [
                    'name' => $subjectName,
                    'days' => [],
                    'time' => '',
                ];
            }
            $groupedSubjects[$subjectName]['days'][] = $subject['day_of_week'];
            $groupedSubjects[$subjectName]['time'] = $subject['formattedStartTime'] . '-' . $subject['formattedEndTime'];
        }

        // Display grouped subjects
        foreach ($groupedSubjects as $groupedSubject) {
            echo '<li>';
            echo '<strong>' . $groupedSubject['name'] . '</strong>';
            echo '<ul>';
            echo '<li>Day: ' . implode(', ', $groupedSubject['days']) . '</li>';
            echo '<li>Time: ' . $groupedSubject['time'] . '</li>';
            echo '</ul>';
            echo '</li>';
        }
    ?>
    </strong></ul>
</div>

        
        <!-- Add more form-group rows as needed -->
    </div>
</div>
<!-- Repeat the above structure for other fields -->










</div>

<?php } ?>
<center>
    <br>
    <button>
    <a href="student/student.payment.php">
        Proceed to Payment</button>
    </a>
    <button>
    <a href="student/student.profile.php">Profile</a>
    </button>
    <br>
</center>
</div>

</div>
</div>

</body>

</html>