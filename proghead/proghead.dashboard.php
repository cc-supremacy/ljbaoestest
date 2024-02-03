<?php
include("../session/session.php");
include("../connection/db.php");
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style/sidestyle.css">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php include('proghead.sidebar.php'); ?>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text"> &nbsp &nbsp &nbsp Dashboard</span>
        </div>
                <main>
            <ul class="box-info">
                <li>
                    <a href="proghead.enrolled.students.php"><i class='bx bxs-group' ></i></a>
                    <span class="text">
                        <h3>
                            <?php
                               require_once("../connection/db.php");

                               $query = "SELECT id from students";
                               $query_run = mysqli_query($connection,$query);

                               $row = mysqli_num_rows($query_run);

                               echo $row;
                            ?>
                        </h3>
                        <p>Total Students</p>
                    </span>
                </li>
                <li>
                    <a href="proghead.pending.students.php"><i class='bx bxs-user-x'></i></a>
                    <span class="text">
                        <h3>
                        <?php
                               require_once("../connection/db.php");

                               $query1 = "SELECT lrn from students WHERE enrollment = 'NO' ";
                               $query_run1 = mysqli_query($connection,$query1);

                               $row1 = mysqli_num_rows($query_run1);

                               echo $row1;
                            ?>
                        </h3>
                        <p>Pending Students</p>
                    </span>
                </li>
                <li>
                    <a href="proghead.enrolled.students.php"><i class='bx bxs-user-check'></i></a>
                    <span class="text">
                        <h3>
                        <?php
                               require_once("../connection/db.php");

                               $query2 = "SELECT lrn from enrollment WHERE enrolled = 'Yes' ";
                               $query_run2 = mysqli_query($connection,$query2);

                               $row2 = mysqli_num_rows($query_run2);

                               echo $row2;
                            ?>
                        </h3>
                        <p>Officially Enrolled</p>
                    </span>
                </li>
            </ul>
            <ul class="box-info">
                <li>
            <a href="proghead.professors.php"><i class='bx bxs-graduation'></i></a>
                    <span class="text">
                        <h3>
                        <?php
                               require_once("../connection/db.php");

                               $query2 = "SELECT prof_id from teacheruser";
                               $query_run2 = mysqli_query($connection,$query2);

                               $row2 = mysqli_num_rows($query_run2);

                               echo $row2;
                            ?>
                        </h3>
                        <p>Professors</p>
                    </span>
                </li>
                <li>
            <a href="proghead.subjects.php"><i class='bx bx-book'></i></a>
                    <span class="text">
                        <h3>
                        <?php
                               require_once("../connection/db.php");

                               $query2 = "SELECT subject_id from subjects";
                               $query_run2 = mysqli_query($connection,$query2);

                               $row2 = mysqli_num_rows($query_run2);

                               echo $row2;
                            ?>
                        </h3>
                        <p>Subjects</p>
                    </span>
                </li>
                <li>
            <a href="proghead.professors.php"><i class='bx bxs-wrench'></i></a>
                    <span class="text">
                        <h3>
                        <?php
                               require_once("../connection/db.php");

                               $query2 = "SELECT id from users";
                               $query_run2 = mysqli_query($connection,$query2);

                               $row2 = mysqli_num_rows($query_run2);

                               echo $row2;
                            ?>
                        </h3>
                        <p>Staff</p>
                    </span>
                </li>
            </ul>
        </main>
    </section>


    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>