<?php
include("../session/session.php");
include("../connection/db.php");
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
        </div><br>
        <?php
        // Check if the user has the 'admin' or 'teacher' role to display the input form
        if (checkRole('admin') || checkRole('teacher')) {
        ?>
            <h2>Input Student Grades</h2>
            <form method="get" action="grade_student.php">
                <label for="lrn">LRN:</label>
                <input type="text" id="lrn" name="lrn" required>
                <input type="submit" value="Search">
            </form>
            <br><br>
        <?php
        }
        ?>

        <p><h2>Student Grades</h2></p>
        <h3 class="mt-5"><b>Search</b></h3>
        <div class="input-group mb-4 mt-3">
            <div class="form-outline">
                <input type="text" id="getName"/>
            </div>
        </div>                   
        <table class="content-table">
            <thead>
                <tr>
                    <th>LRN</th>
                    <th>Subject</th>
                    <th>Grades</th>
                    <th>Remarks</th>
                    <th>Action</th> <!-- New column for the Edit button -->
                </tr>
            </thead>
            <tbody id="showdata">
                <!-- Existing rows remain unchanged -->
                <?php
                if(isset($_POST['name'])) {
                    $name = $_POST['name'];
                    $sql = "SELECT * FROM grades WHERE lrn LIKE '$name%'";
                    $query = mysqli_query($connection, $sql);
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo "<tr>
                                <td>".$row['lrn']."</td>
                                <td>".$row['subName']."</td>
                                <td>".$row['subMarks']."</td>
                                <td></td>
                                <td>".generateEditButton()."</td>
                              </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </section>

    <script>
        $(document).ready(function(){
            $('#getName').on("keyup", function(){
                var getName = $(this).val();
                $.ajax({
                    method:'POST',
                    url:'../searchajax.php',
                    data:{name:getName},
                    success:function(response)
                    {
                        $("#showdata").html(response);
                    } 
                });
            });
            
            // Additional code for handling the edit button click event
            $('#showdata').on('click', '.edit-button', function () {
                // Get the LRN and subject name from the clicked row
                var lrn = $(this).closest('tr').find('td:eq(0)').text();
                var subName = $(this).closest('tr').find('td:eq(1)').text();

                // Redirect to the edit_grades.php page with LRN and subject name as parameters
                window.location.href = 'edit_grades.php?lrn=' + lrn + '&subName=' + subName;
            });
        });
    </script>

    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
