<?php
include("../session/student.session.php");
include("../connection/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $description = $_POST["description"];
    $others = $_POST["others"];
    $amount = $_POST["amount"];
    $modeOfPayment = $_POST["modeOfPayment"];

    // Get the current date
    $dateOfTransaction = date("Y-m-d");

    // Get the lrn from the session
    $lrn = $_SESSION["lrn"];

    // Prepare and execute the SQL statement to insert the payment data
    $query = "INSERT INTO payments (description, others, amount, mode_of_payment, date_of_transaction, lrn)
              VALUES (?, ?, ?, ?, ?, ?)";

    $statement = $connection->prepare($query);
    $statement->bind_param("ssdsss", $description, $others, $amount, $modeOfPayment, $dateOfTransaction, $lrn);

    if ($statement->execute()) {
        // Payment successfully added
        header("Location: student.payment.php"); // Redirect to a success page
        exit();
    } else {
        // Error handling (e.g., display an error message)
        echo "Error: " . $statement->error;
    }

    // Close the database connection
    $statement->close();
    $connection->close();
} else {
    // If the form is not submitted via POST method, redirect to the form page
    header("Location: payment_form.php");
    exit();
}
?>
