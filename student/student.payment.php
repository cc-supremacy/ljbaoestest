<?php
include("../session/student.session.php");
include("../connection/db.php");

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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        .payment-table {
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .payment-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .payment-table table th,
        .payment-table table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .payment-table table th {
            background-color: #f5f5f5;
        }

        .header {
            padding: 20px 0;
            background-color: #333;
            color: #fff;
            text-align: center;
        }
        
        .total-amount {
            padding: 10px;
            text-align: right;
            font-weight: bold;
        }
        .payment-history-table {
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .payment-history-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .payment-history-table table th,
        .payment-history-table table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .payment-history-table table th {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <?php include('student.sidebar.php'); ?>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text"> &nbsp &nbsp &nbsp Accounts</span>
        </div><br><br>
        <a href="student.pay.php">Online Payment</a>
        <div class="payment-table">
            <table>
                <div class="header">
                    <h2>Accounts Due</h2>
                </div>

                <thead>
                    <tr>
                        <th>Due Date</th>
                        <th>Desc</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Assuming you have lrn in the enrollment table and courseName in both tables
                    $lrn = $_SESSION['lrn']; // Change to lowercase 'lrn'
                    $query = "SELECT tu.courseName, tu.fee, tu.downp, tu.misc, e.lrn, e.dateofenrollment
                              FROM tuitionfee tu
                              JOIN enrollment e ON tu.courseName = e.courseName
                              WHERE e.lrn = ?";

                    $statement = $connection->prepare($query);
                    $statement->bind_param("s", $lrn);
                    $statement->execute();
                    $result = $statement->get_result();

                    $totalAmount = 0;

                    while ($row = mysqli_fetch_assoc($result)) {
                        $totalFee = $row['fee'] + $row['misc']; // Calculate total fee including miscellaneous fees
                        $downPayment = $row['downp']; // Assuming down payment is specified in the tuitionfee table

                        // Calculate the due date after 5 months
                        $dueDate = date('Y-m-d', strtotime($row['dateofenrollment'] . ' + 5 months'));

                        // Assuming 4 installments
                        for ($i = 1; $i <= 4; $i++) {
                            $installmentDesc = "{$i} Installment";

                            // Calculate installment amount based on the remaining balance
                            $installmentAmount = ($totalFee - $downPayment) / 4;

                            echo "<tr>";
                            echo "<td>{$dueDate}</td>";
                            echo "<td>{$installmentDesc}</td>";
                            echo "<td>{$installmentAmount}</td>";
                            echo "</tr>";
                        }
                        // Add the total installment amount to the total
                        $totalAmount += ($totalFee - $downPayment);
                    }
                    ?>
                </tbody>
            </table>
            <p class="total-amount">Total Amount: <?php echo number_format($totalAmount, 2); ?></p>
        </div>
        <div class="payment-history-table">
            <table>
                <div class="header">
                    <h2>Payment History</h2>
                </div>

                <thead>
                    <tr>
                        <th>Date of Transaction</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Remaining Balance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Assuming you have lrn in the enrollment table and courseName in both tables
                    $lrn = $_SESSION['lrn']; // Change to lowercase 'lrn'
                    $query = "SELECT p.date_of_transaction, p.description, p.amount, e.courseName, e.dateofenrollment
                              FROM payments p
                              JOIN enrollment e ON p.lrn = e.lrn
                              WHERE p.lrn = ?
                              ORDER BY p.date_of_transaction DESC";

                    $statement = $connection->prepare($query);
                    $statement->bind_param("s", $lrn);
                    $statement->execute();
                    $result = $statement->get_result();

                    $totalPaidAmount = 0;

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['date_of_transaction']}</td>";
                        echo "<td>{$row['description']}</td>";
                        echo "<td>{$row['amount']}</td>";
                        // Deduct the payment amount directly from the total amount
                        $totalAmount -= $row['amount'];
                        echo "<td>{$totalAmount}</td>";
                        echo "</tr>";

                        $totalPaidAmount += $row['amount'];
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <script src="../script.js"></script>
    <!-- Add this code to the head section of your HTML -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>

</html>
