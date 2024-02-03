<?php
include ("../session/student.session.php");
include ("../connection/db.php");
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Subjects</title>
    <link rel="stylesheet" href="../style/sidestyle2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<?php include('student.sidebar.php'); ?>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text"> &nbsp &nbsp &nbsp Subject List</span>
        </div>

        <div class="wrapper">
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Subject</th>
                        
                        <th>Category</th>

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

                    $sql = "select * from subjects";
                    $result = $connection->query($sql);

                    if (!$result){
                        die("Invalid query:" . $connection->connect_error);
                    }

                    while ($row = $result->fetch_assoc()){
                        echo "

                        <tr>
                        <td>$row[subject_code]</td>
                         <td>$row[subName]</td>

                         <td>$row[sub_category]</td>
                        </tr>

                        ";
                    }

                    ?>

                </tbody>
            </table>
        </div>

        
    </section>

    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>