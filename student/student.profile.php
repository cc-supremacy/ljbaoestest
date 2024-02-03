<?php
include("../session/student.session.php");
include("../connection/db.php");

if(isset($_SESSION['id'])){
        $mobile   = $_SESSION['mobile'];
        $documents = $_SESSION['documents'];
        $reg_no = $_SESSION['reg_no'];
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
        $enrollment = $_SESSION['enrollment'];
}



?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="../style/sidestyle2.css">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Add this style to the head section */
        .profile-display {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .col-md-5,
        .col-md-7 {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px; /* Add margin at the bottom for spacing */
        }

        .col-md-5 ul,
        .col-md-7 ul {
            list-style: none;
            padding: 0;
        }

        .col-md-5 h2,
        .col-md-7 h2 {
            margin-bottom: 20px;
        }

        .extracurricular-table {
            width: 100%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            margin-top: 20px;
        }

        .extracurricular-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .extracurricular-table table th,
        .extracurricular-table table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .extracurricular-table table th {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <?php include('student.sidebar.php'); ?>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text"> &nbsp &nbsp &nbsp Profile</span>
        </div>
        <div class="container mt-4 profile-display">
    <div class="row">
        <div class="col-md-5">
            
            <input type="hidden" name="reg_no" value="<?php echo"$reg_no"; ?>" readonly>
            <h2>Your Information</h2>
            <ul class="list-group">
                <li class="list-group-item"><strong>LRN:</strong> <?php echo $lrn; ?></li>
                <li class="list-group-item"><strong>Full Name:</strong> <?php echo "$fname $mname $lname $xname"; ?></li>
                <li class="list-group-item"><strong>Age:</strong> <?php echo $age; ?></li>
                <li class="list-group-item"><strong>Birthdate:</strong> <?php echo $birth; ?></li>
                <li class="list-group-item"><strong>Place of Birth:</strong> <?php echo $pob; ?></li>
                <li class="list-group-item"><strong>Mother Tongue:</strong> <?php echo $tongue; ?></li>
                <li class="list-group-item"><strong>Gender:</strong> <?php echo $sex; ?></li>
                <li class="list-group-item"><strong>Address:</strong> <?php echo "$strt, $brgy, $mncpl, $prvnc, $cntry"; ?></li>
                <li class="list-group-item"><strong>Mother's Full Name:</strong> <?php echo "$mfname $mmname $mlname"; ?></li>
                <li class="list-group-item"><strong>Father's Full Name:</strong> <?php echo "$ffname $fmname $flname"; ?></li>
                <li class="list-group-item"><strong>Guardian's Full Name:</strong> <?php echo "$gfname $gmname $glname"; ?></li>
                <li class="list-group-item"><strong>Mobile:</strong>
                            <input type="text" id="mobile" value="<?php echo $mobile; ?>" readonly>
                            <button onclick="toggleEditMode('mobile', false)">Edit</button>
                            <button onclick="saveChanges('mobile')">Save</button>
                        </li>
                <!-- Add more student information here -->
            </ul>
        </div>
        <div class="col-md-7">
            <h2>Educational Information</h2>
            <ul class="list-group">
                
                <li class="list-group-item"><strong>Status:</strong> <?php echo $stat; ?></li>
                <li class="list-group-item"><strong>Previous School:</strong> <?php echo $hschool; ?></li>
                <li class="list-group-item"><strong>Previous School Address:</strong> <?php echo "$hstrt, $hbrgy, $hmncpl, $hprvnc, $hcntry"; ?></li>
                <li class="list-group-item"><strong>Documents to be submitted: </strong> <?php echo"$documents"; ?></li>
                
                <!-- Add more school information here -->
            </ul>
        </div>
    </div>
    <div class="extracurricular-table">
        <h2>Curricular Activities</h2>
    <table>
        <thead>
            <tr>
                
                <th>School Year</th>
                <th>Description</th>
                <th>Category</th>
                <th>Achievements/Positions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Assuming you have lrn in the enrollment table and courseName in both tables
            $lrn = $_SESSION['lrn']; // Change to lowercase 'lrn'
            $query = "SELECT c.yearID, sy.description AS schoolYear, c.description, c.category, c.achievements
                      FROM curricular c
                      JOIN school_years sy ON c.yearID = sy.yearID
                      WHERE c.lrn = ?";

            $statement = $connection->prepare($query);
            $statement->bind_param("s", $lrn);
            $statement->execute();
            $result = $statement->get_result();

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['schoolYear']}</td>";
                echo "<td>{$row['description']}</td>";
                echo "<td>{$row['category']}</td>";
                echo "<td>{$row['achievements']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

            </div>
</div>


    </section>

    <script src="../script.js"></script>
    <script>
    function toggleEditMode(elementId, readOnly) {
        var element = document.getElementById(elementId);
        element.readOnly = readOnly;
    }

    function saveChanges(field) {
        var element = document.getElementById(field);
        var newValue = encodeURIComponent(element.value); // Encode the value

        // Assuming you have different update functions for each field
        // Call the appropriate update function based on the field
        switch (field) {
            case 'mobile':
                updateMobile(newValue, "<?php echo $lrn; ?>");
                break;
            // Add more cases for other fields if needed
        }

        alert("Changes saved successfully!");
    }


    function updateMobile(newMobile, lrn) {
        // Implement an AJAX request to update the mobile in the database
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Handle the response if needed
            }
        };

        // Adjust the URL and other parameters based on your server-side implementation
        var url = "update_mobile.php"; // Change this to the actual URL handling the update
        var params = "lrn=" + lrn + "&mobile=" + newMobile;
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(params);
    }
</script>

</body>

</html>