<?php
include("../session/session.php");
include("../connection/db.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Payments</title>
    <link rel="stylesheet" href="../style/sidestyle.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php include('proghead.sidebar.php'); ?>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text"> &nbsp &nbsp &nbsp Transactions</span>
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
           
            <th>Payment Status</th>
            <th></th>
            <th></th>
           
           
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
  
    <td>{$row['paid']}</td>

     
    <td>";


            // Check if the user has admin role before displaying the Edit and Delete buttons
            if (checkRole('admin') || checkRole('cashier')) {
                echo "
            
                    <td>
                    <a href='update_paid_status.php?lrn=$row[lrn]' class='btn'><i class='bx bx-dollar-circle'></i>&nbspMark as Paid</a>
                </td>    ";
            }

            echo "</td></tr>";
        }
        ?>
    </tbody>
</table>

        </div>

    </section>

    

    <script src="../script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>
