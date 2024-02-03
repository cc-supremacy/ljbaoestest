<?php
include("../session/session.php");
include("../connection/db.php");

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
    <!-- ... (other HTML code) ... -->



<!-- ... (other HTML code) ... -->

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
            <th>Strand/Grade</th>
            <th>Mobile</th>
            <th>Enroll Status</th>
            <th>Payment Status</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <?php
            // Assuming you have already checked if the user is logged in
            if (checkRole('admin') || checkRole('registrar')) {
                echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add Student
                    </button>';
            }
            ?>

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

        $sql = "select * from enrollment";
        $result = $connection->query($sql);

        if (!$result) {
            die("Invalid query:" . $connection->connect_error);
        }

        while ($row = $result->fetch_assoc()) {
            echo "
<tr>
    <td>{$row['lrn']}</td>
    <td>{$row['fname']} {$row['mname']} {$row['lname']}</td>
    <td>{$row['courseName']}</td>
    <td>{$row['pmobile']}</td>
    <td>{$row['enrolled']}</td>
    <td>{$row['paid']}</td>
    <td>
        <button class='btn btn-link view-details-btn' data-lrn='{$row['lrn']}'>
            View Full Details
        </button>
    </td>
     
    <td>";


           // Check if the user has admin role before displaying the Edit and Delete buttons
    if (checkRole('admin') || checkRole('registrar')) {
        echo "
            <a href='../crud/editstud.php?lrn=$row[lrn]' class='btn'><i class='bx bx-edit'></i>&nbspEdit</a>
            </td>
            <td>
                <a href='../crud/delstud.php?lrn=$row[lrn]' class='btn'><i class='bx bxs-minus-circle'></i>&nbspDelete</a>
            </td><td>";

        // Check if the payment status is 'Yes' before displaying the "Mark as Enrolled" button
        if ($row['paid'] === 'Yes') {
            echo "
                
                    <a href='update_paid_enrollment.php?lrn=$row[lrn]' class='btn'><i class='bx bx-dollar-circle'></i>&nbspMark as Enrolled</a>
                ";
        }
    }

    echo "</td></td></tr>";
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
                <!-- Student details code goes here -->
                <div id="studentDetailsContainer">
                    <!-- Student details will be inserted here dynamically -->
                </div>
            </div>
            <div class="modal-footer">
            
                
            </div>
        </div>
    </div>
</div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="../crud/addstud.php" method="post">
                    <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">LRN</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="lrn"
                                        value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">First Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="fname"
                                        value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Middle Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="mname"
                                        value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Last Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="lname"
                                        value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Extension Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="xname"
                                        value="" placeholder="optional">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Strand/Grade:</label>
                                <div class="col-sm-6">
                                <select name="courseName" id="course" onchange="showSemester()" class="form-control" required>
                                <?php
                                             while( $rows = mysqli_fetch_array($win)){
                                             ?>
                                <option value="<?php echo $rows['courseName']; ?>"><?php echo $rows['courseName'];?>
                                </option>
                                <?php
                                                  }
                                             ?>
                            </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Birthday</label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" name="birth" value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Current Address</label>
                                <div class="col-sm-6">
                                    <input type="text" size="50" class="form-control" name="caddress" value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Age</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="age" value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Parent Mobile</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="pmobile" value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Guardian Mobile</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="gmobile" value="" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">4Ps Beneficiary</label>
                                <div class="col-sm-6">
                                    <select name="fourps" id="">
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">4Ps #</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="fournum" value="">
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
                                <button type="submit" name="add_stud" class="btn btn-primary">Add Student</button>
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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
        <script src="../script.js"></script>
        <script>
        $(document).ready(function () {
                console.log("jQuery is working!");
            });
$(document).ready(function () {
    // Search functionality
    $("#search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("table tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Modal initialization
    $(document).on("click", "#detailsModal #schoolActivitiesBtn", function () {
        // Your existing code for handling "School Activities" button
    });

    $(document).on("click", "#detailsModal #studentDetailsBtn", function () {
        // Your existing code for handling "Student Details" button
    });

    $(document).on("click", ".view-details-btn", function () {
        var lrn = $(this).data("lrn");

        $("#lrn").val(lrn);

        // Create buttons for School Activities and Student Details
        var buttonsContainer = `
            <div class="text-center">
                <button type="button" class="btn btn-primary" id="schoolActivitiesBtn">School Activities</button>
                <br><br>
                <button type="button" class="btn btn-primary" id="studentDetailsBtn">Full Details</button>
            </div>`;
            

            // Append the buttons to the modal body and show the modal
            $("#modalBody").html(buttonsContainer);
            $("#detailsModal").modal("show");
        

        // Handle click on "School Activities" button
        $(document).on("click", "#detailsModal #schoolActivitiesBtn", function () {
    // Fetch school years from getschoolyears.php
    $.ajax({
        type: "GET",
        url: "../crud/getschoolyears.php",
        success: function (schoolYearOptions) {
            // Wrap the school year options in a select element
            var schoolYearSelect = '<select name="schoolYear" id="schoolYear" class="form-control">' + schoolYearOptions + '</select>';

            // Create a form to contain the select and append it to the modal body
            var schoolYearForm = '<form id="schoolYearForm">' +
                '<button type="button" class="btn btn-primary" id="addExtraCurricularBtn">Add Extra Curricular</button>' +
                schoolYearSelect + '<br>' +
                '<button type="button" class="btn btn-secondary" id="backBtnSchoolActivities">Back</button>' +
                '</form>' + '<br>';
            var schoolActivitiesContainer = '<div id="schoolActivitiesContainer">' + schoolYearForm;

            // Clear existing content and append the new container
            $("#modalBody").html(schoolActivitiesContainer);

            // Handle form submission
            $("#schoolYearForm").change(function () {
                var schoolYear = $("#schoolYear").val();

                // Clear existing curricular details
                $("#curricularDetails").remove();

                // Fetch and display curricular details based on LRN and school year
                $.ajax({
                    type: "GET",
                    url: "../crud/getcurriculardetails.php",
                    data: { lrn: lrn, schoolYear: schoolYear },
                    success: function (curricularDetails) {
                        // Check if the response contains curricular details
                        if (curricularDetails.trim() !== "") {
                            // Append the new curricular details
                            $("#schoolActivitiesContainer").append('<div id="curricularDetails">' + curricularDetails + '</div>');
                        } else {
                            // No curricular details found
                            $("#schoolActivitiesContainer").append('<div id="curricularDetails">No details found for the selected school year.</div>');
                        }
                    },
                });
            });

           
            // Handle click on "Back" button inside School Activities
            $("#backBtnSchoolActivities").click(function () {
                // Revert to the initial buttons
                $("#modalBody").html(buttonsContainer);
            });
        },
    });
});
// Handle click on "Add Extra Curricular" button
$(document).on("click", "#addExtraCurricularBtn", function () {
    // Unbind event handlers for the curricular form
    $("#addCurricularForm").off();

    // Hide school year options and back button
    $("#schoolYearForm").hide();
    $("#backBtnSchoolActivities").hide();

    // Clear existing curricular form
    $("#curricularFormContainer").remove();

    // Fetch and display the curricular form using AJAX
    $.ajax({
        type: "GET",
        url: "../crud/curricular_form.php",
        success: function (curricularForm) {
            // Append the curricular form to the modal body
            $("#schoolActivitiesContainer").html(curricularForm);

            // Manually populate the school year select options
            var schoolYearSelect = $("#curricularYear");
            schoolYearSelect.empty(); // Clear existing options
            schoolYearSelect.append('<option value="" selected disabled>Select Year</option>');

            // Add event handler for cancel button
            $(document).on("click", "#backBtnCurricular", function () {
                // Show school year options and back button
                $("#schoolYearForm").show();
                $("#backBtnSchoolActivities").show();

                // Remove the curricular form
                $("#curricularFormContainer").remove();
            });

            // Unbind existing event handlers
            $("#schoolYearForm").off();
            $("#backBtnSchoolActivities").off();
            $("#addCurricularForm").off();

            <?php
            // Include your database connection code here
            include("../connection/db.php");

            // Query to fetch school years from the school_years table
            $schoolYearSql = "SELECT yearID, description FROM school_years";
            $schoolYearResult = $connection->query($schoolYearSql);

            // Check if there are rows in the result
            if ($schoolYearResult->num_rows > 0) {
                while ($row = $schoolYearResult->fetch_assoc()) {
                    // Output option for each school year
                    echo 'schoolYearSelect.append(\'<option value="' . $row['yearID'] . '">' . $row['description'] . '</option>\');';
                }
            }
            ?>

            // Close the database connection if needed
            <?php $connection->close(); ?>
        },
    });
});

// Add event handler for form submission
$(document).on("submit", "#addCurricularForm", function (event) {
    // Prevent the default form submission
    event.preventDefault();

    // Retrieve LRN
    var lrn = $("#lrn").val();

    // Serialize the form data
    var formData = $(this).serialize();

    // Submit the form data using AJAX
    $.ajax({
        type: "POST",
        url: "../crud/submit_curricular.php",
        data: formData + "&lrn=" + lrn,
        success: function (response) {
            console.log(response);
            // Optionally, you can take further actions like updating UI or closing the modal
        },
        error: function (xhr, textStatus, errorThrown) {
            console.error("Error submitting curricular form: " + errorThrown);
        }
    });
});

       



        // Handle click on "Student Details" button
        $(document).on("click", "#detailsModal #studentDetailsBtn", function () {
            // Fetch student details using AJAX and display in the modal body
            $.ajax({
                type: "GET",
                url: "../crud/getenrollmentdetails.php",
                data: { lrn: lrn },
                success: function (enrollmentDetails) {
                    // Update the content of the modal body with the fetched student details
                    $("#modalBody").html(enrollmentDetails);

                    // Add a Back button handler
                    $(document).on("click", "#backBtn", function () {
                        // Revert to the initial buttons
                        $("#modalBody").html(buttonsContainer);
                    });
                },
            });
        });
    });
});

</script>
<!-- ... (other HTML code) ... -->



<!-- ... (other HTML code) ... -->

</body>

</html>
