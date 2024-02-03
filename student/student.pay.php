<?php
include("../session/student.session.php");
include("../connection/db.php");

// Example array for payment modes
$paymentModes = array("Cash", "Gcash", "Credit Card", "Bank Transfer");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Payment</title>
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

        .payment-form {
            max-width: 400px;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .payment-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .payment-form select,
        .payment-form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        .payment-form input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .payment-form input[type="submit"]:hover {
            background-color: #45a049;
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
        
        <div class="container">
            <!-- Payment Form -->
            <form class="payment-form" action="process_payment.php" method="post">
                <label for="description">Description:</label>
                <select class="form-control" name="description" id="description" required>
                    <option value="Down Payment">Down Payment</option>
                    <option value="Installment">Installment</option>
                </select>

                <label for="others">Other Purposes:</label>
                <input class="form-control" type="text" name="others" id="others" placeholder="optional">

                <label for="amount">Amount:</label>
                <input class="form-control" type="text" name="amount" id="amount" value="500" required>

                <label for="modeOfPayment">Mode of Payment:</label>
                <select class="form-control" name="modeOfPayment" id="modeOfPayment" required>
                    <?php foreach ($paymentModes as $mode) : ?>
                        <option value="<?php echo $mode; ?>"><?php echo $mode; ?></option>
                    <?php endforeach; ?>
                </select>

                <input class="btn-submit" type="submit" value="Submit Payment">
            </form>
            <!-- End Payment Form -->
        </div>
    </section>

    <script src="../script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>

</html>
