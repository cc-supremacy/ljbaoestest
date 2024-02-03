<?php
include ("../session/session.php");
include ("../connection/db.php");

$sss = "Select Distinct profName from teacheruser";
    $req = mysqli_query($connection, $sss);
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Professor List</title>
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
            <span class="text"> &nbsp &nbsp &nbsp Teachers</span>
        </div>

        <div class="wrapper">

            <?php
            if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
               
                ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Successful! &nbsp </strong><?php  echo $_SESSION['status']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                unset ($_SESSION['status']);
            }

            ?>


            <table class="content-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        
                        <th>
                        <?php
// Assuming you have already checked if the user is logged in
if (checkRole('admin')) {
    echo '<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Add Professor
          </button>';
}
?>
                        </th>


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

                    $sql = "select * from teacheruser";
                    $result = $connection->query($sql);

                    if (!$result){
                        die("Invalid query:" . $connection->connect_error);
                    }

                    while ($row = $result->fetch_assoc()){
                        echo "

                        <tr>
                         <td>$row[prof_id]</td>
                         <td>$row[profName]</td>
                         <td>$row[dept]</td>
                         <td>$row[email]</td>        
                         <td>$row[mobile]</td>               
                        
                         <td>";

                         // Check if the user has admin role before displaying the Edit and Delete buttons
                         if (checkRole('admin')) {
                             echo "
                                 <a href='../crud/editprof.php?prof_id=$row[prof_id]' class='btn'> <i class='bx bx-edit'></i>&nbspEdit</a>
                                 <a href='../crud/delprof.php?prof_id=$row[prof_id]' class='btn'><i class='bx bxs-minus-circle'></i>&nbspDelete</a>
                             ";
                         }
                     
                         echo "</td></tr>";
                     }
                     ?>

                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Professor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="../crud/addprof.php" method="post">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Professor Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="profName"
                                        value="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Department</label>
                                <div class="col-sm-6">
                                   <input type="text" class="form-control" name="dept">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="email" value="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Mobile</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="mobile" value="">
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
                                <button type="submit" name="add_prof" class="btn btn-primary">Add Professor</button>
                            </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>

    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>