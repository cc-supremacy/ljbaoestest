<?php
include("../session/session.php");
include("../connection/db.php");

// Check if the user is logged in and has a role
if (!isLoggedIn() || (!checkRole('registrar') && !checkRole('admin'))) {
    // Redirect or display an access denied message
    echo '<script>alert("Access Denied");</script>';
    header("Location: proghead.dashboard.php");
    exit();
}

$sss = "Select Distinct profName from teacheruser";
$req = mysqli_query($connection, $sss);
$www = "Select Distinct courseName from subjects";
$win = mysqli_query($connection, $www);
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Students</title>
    <link rel="stylesheet" href="../style/sidestyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php include('proghead.sidebar.php'); ?>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text"> &nbsp &nbsp &nbsp Students</span>
        </div>

        <div class="wrapper">
            <?php
            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong></strong><?php echo $_SESSION['status']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                unset($_SESSION['status']);
            }
            ?>

            <label for="search">Search:</label>
            <input type="text" id="search" placeholder="Enter keyword">

            <table class="content-table">
                <thead>
                    <tr>
                        <th>LRN</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Status</th>
                        <th>Registration #</th>
                        <th></th>
                        <th>Action</th>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Add Student
                        </button>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "cap";

                    $connection = new mysqli($servername, $username, $password, $database);

                    if ($connection->connect_error) {
                        die("Connection Failed: " . $connection->connect_error);
                    }

                    $sql = "select * from students WHERE enrollment = 'NO' ";
                    $result = $connection->query($sql);

                    if (!$result) {
                        die("Invalid query:" . $connection->connect_error);
                    }

                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>$row[lrn]</td>
                            <td>$row[fname] $row[mname] $row[lname]</td>
                            <td>$row[mobile]</td>
                            <td>$row[stat]</td>
                            <td>$row[reg_no]</td>
                        
                            <td>
            <button class='btn btn-link view-details-btn' data-lrn='{$row['lrn']}'>
                View Full Details
            </button>
        </td>
                    <td>
                        <a href='../crud/editnewstud.php?lrn=$row[lrn]' class='btn'><i class='bx bx-edit'></i>&nbspEdit</a>
                        <a href='../crud/delnewstud.php?lrn=$row[lrn]' class='btn'><i
                                class='bx bxs-minus-circle'></i>&nbspDelete</a>
                    </td>
                    </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Student Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Details will be loaded here using JavaScript -->
            </div>
        </div>
    </div>
</div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../crud/addnewstud.php" method="post">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="lrn">LRN</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="lrn" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="fname">First Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="fname" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="mname">Middle Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="mname" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="lname">Last Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="lname" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="xname">Extension Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="xname">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="birth">Birthday</label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" name="birth">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="age">Age</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="age" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="sex">Sex</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="sex">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="mobile">Mobile #</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="mobile" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="pob">Place of Birth</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="pob">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="tongue">Mother Tongue</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="tongue">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="strt">Street</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="strt">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="brgy">Barangay</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="brgy">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="mncpl">Municipality/City</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="mncpl">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="prvnc">Province</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="prvnc">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="cntry">Country</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="cntry">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="ffname">Father's First Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="ffname">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="fmname">Father's Middle Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="fmname">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="flname">Father's Last Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="flname">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="mfname">Mother's First Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="mfname">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="mmname">Mother's Middle Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="mmname">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="mlname">Mother's Last Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="mlname">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="gfname">Guardian's First Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="gfname">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="gmname">Guardian's Middle Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="gmname">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="glname">Guardian's Last Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="glname">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="status">Status</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="status">
                                        <option value="Old">Old Student</option>
                                        <option value="New">New Student</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="hschool">Previous School</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="hschool">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="hstrt">School Address (Street)</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="hstrt">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="hbrgy">School Address (Barangay)</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="hbrgy">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="hmncpl">School Address
                                    (Municipality/City)</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="hmncpl">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="hprvnc">School Address (Province)</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="hprvnc">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="hcntry">School Address (Country)</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="hcntry">
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


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="add_newstud" class="btn btn-primary">Add Student</button>
                            </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
        </div>
        </div>
        </div>
    </section>

    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    </script>
<script>
    $(document).ready(function () {
        $(".view-details-btn").click(function () {
            var lrn = $(this).data("lrn");

            $.ajax({
                type: "GET",
                url: "../crud/getdetails.php", // Create a new PHP file for fetching details
                data: { lrn: lrn },
                success: function (data) {
                    $("#modalBody").html(data);
                    $("#detailsModal").modal("show");
                },
            });
        });
    });
</script>

</body>

</html>