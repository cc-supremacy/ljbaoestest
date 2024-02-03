<?php
include("../session/student.session.php");
include("../connection/db.php");
if(isset($_SESSION['id'])){
    // ... (existing session variables)

    // Check if the enrollment status is set to 'NO'
    $enrollButtonVisible = ($enrollment === 'NO');
    $validateGradesButtonVisible = ($enrollment === 'YES');
} else {
    // Handle the case when session variables are not set
    $enrollButtonVisible = false;
    $validateGradesButtonVisible = false;
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Enrollment Form</title>
    <link rel="stylesheet" href="../style/sidestyle2.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php include('student.sidebar.php'); ?>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text"> &nbsp &nbsp &nbsp Enrollment</span>
        </div><br><br><br>
        <button type="submit" class="btn btn-success btn-sm" onclick="validateGrades()" <?php echo $validateGradesButtonVisible ? '' : 'style="display:none;"'; ?>>Validate Grades for Enrollment</button>
        <br>
        <br>
        <?php if ($enrollButtonVisible) : ?>
            <button type="submit" class="btn btn-success btn-sm" onclick="redirectEnrollmentForm()">Enroll for New Student</button>
            <br>
        <?php endif; ?>
        <table class="content-table">
        <thead>
          <tr>
            <th>LRN</th>
            <th>Level</th>
            <th>Subject</th>
            <th>Grades</th>
            <th>School Year</th>
            
          </tr>
        </thead>
        <tbody id="showdata">
          
        </tbody>
    </table>
    </section>
</body>
<script src="script.js"></script>
<script>
        // Fetch and populate the table with grades data
        $(document).ready(function () {
    var lrn = "<?php echo $lrn; ?>";

    $.ajax({
        type: 'POST',
        url: 'fetch_grades.php',
        data: { lrn: lrn },
        dataType: 'json',
        success: function (data) {
            var tableBody = $('#showdata');

            // Clear existing data
            tableBody.empty();

            // Populate the table with new data
            if (data.length > 0) {
                $.each(data, function (index, row) {
                    var schoolYearDescription = fetchSchoolYearDescription(row.school_year); // Assuming row.school_year contains the school_year value

                    var newRow = '<tr>' +
                        '<td>' + row.LRN + '</td>' +
                        '<td>' + row.courseName + '</td>' +
                        '<td>' + row.subName + '</td>' +
                        '<td>' + row.subMarks + '</td>' +
                        '<td>' + schoolYearDescription + '</td>' +
                        '</tr>';
                    tableBody.append(newRow);
                });
            } else {
                tableBody.append('<tr><td colspan="4">No data available</td></tr>');
            }
        },
        error: function (xhr, status, error) {
            console.error('Error fetching grades:', error);
        }
    });
});

function fetchSchoolYearDescription(schoolYear) {
    var description = ''; // Default value

    // Perform AJAX call to fetch description based on schoolYear (assuming it's the school_year value)
    $.ajax({
        type: 'POST',
        url: 'fetch_school_year_description.php',
        data: { yearID: schoolYear }, // Include schoolYear in the data
        async: false, // Ensure the function waits for the result
        success: function (data) {
            description = data; // Update the description
        },
        error: function (xhr, status, error) {
            console.error('Error fetching school year description:', error);
        }
    });

    return description;
}

function validateGrades() {
    var gradesTable = $('#showdata');
    var invalidGrade = false;

    // Check each row for subMarks below 75
    gradesTable.find('tr').each(function () {
        var subMarks = parseFloat($(this).find('td:eq(3)').text()); // Use correct column index for subMarks
        if (subMarks < 75) {
            invalidGrade = true;
            return false; // Break out of the loop
        }
    });

    // Take action based on validation result
    if (invalidGrade) {
        alert("Please coordinate with your teacher for subjects with marks below 75.");
    } else {
        // Check if there are no grades available
        if (gradesTable.find('tr').length === 0) {
            alert("You still have no grades for the school year.");
            // Redirect to profile page
            window.location.href = 'student.profile.php';
        } else {
            alert("You can proceed to enrollment.");
            // Redirect to enrollment_form.php or take any other necessary action
            window.location.href = 'enrollment_form2.php';
        }
    }
}




    function redirectEnrollmentForm() {
        window.location.href = 'enrollment_form.php';
    }

    </script>
</html>



