<?php
include("../session/session.php");
include("../connection/db.php");

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];

    $query = "SELECT payments.*, students.lrn FROM payments
              INNER JOIN students ON payments.lrn = students.lrn
              WHERE payments.description LIKE '%$keyword%'
              OR payments.others LIKE '%$keyword%'
              OR students.lrn LIKE '%$keyword%'
              OR students.fname LIKE '%$keyword%'
              OR students.mname LIKE '%$keyword%'
              OR students.lname LIKE '%$keyword%'
              OR payments.amount LIKE '%$keyword%'
              OR payments.mode_of_payment LIKE '%$keyword%'
              OR payments.date_of_transaction LIKE '%$keyword%'";

    $result = mysqli_query($connection, $query);
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['lrn']}</td>";
        echo "<td>{$row['description']}</td>";
        echo "<td>{$row['others']}</td>";
        echo "<td>{$row['amount']}</td>";
        echo "<td>{$row['mode_of_payment']}</td>";
        echo "<td>{$row['date_of_transaction']}</td>";
        echo "</tr>";
    }
}
?>
