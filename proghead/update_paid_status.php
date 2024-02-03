<?php
// Include your database connection code here
$servername = "localhost";
$username = "root";
$password = "";
$database = "cap";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection Failed: " . $connection->connect_error);
}

if (isset($_GET['lrn'])) {
    $lrn = $_GET['lrn'];

    // Retrieve data from enrollment table
    $retrieveDataQuery = "SELECT fname, mname, lname, gmobile, pmobile FROM enrollment WHERE lrn='$lrn'";
    $retrieveDataResult = $connection->query($retrieveDataQuery);

    if ($retrieveDataResult && $retrieveDataResult->num_rows > 0) {
        $row = $retrieveDataResult->fetch_assoc();
        $fname = $row['fname'];
        $mname = $row['mname'];
        $lname = $row['lname'];
        $gmobile = $row['gmobile'];
        $pmobile = $row['pmobile'];

        // Update the "Paid" column in the enrollment table
        $updateEnrollmentQuery = "UPDATE enrollment SET paid='Yes' WHERE lrn='$lrn'";
        $updateEnrollmentResult = $connection->query($updateEnrollmentQuery);

        if ($updateEnrollmentResult) {
            // Send message using Semaphore API
            $semaphoreApiKey = '32e4b035c774155ebc33d32581cbdc95';

            // Message to be sent
            $message = "This is Lord Jesus Blessed Academy, this is to inform you that $fname $mname $lname has completed the enrollment payment!";

            // Phone numbers
            $phoneNumbers = [$gmobile, $pmobile];

            // Initialize cURL session
            $ch = curl_init();

            // Set cURL options
            foreach ($phoneNumbers as $phoneNumber) {
                $parameters = [
                    'apikey' => $semaphoreApiKey,
                    'number' => $phoneNumber,
                    'message' => $message,
                    'sendername' => 'SEMAPHORE', // Replace with your desired sender name
                ];

                curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                // Execute cURL session and get the response
                $output = curl_exec($ch);

                // Display the server response
                echo "Semaphore API Response: " . $output . "<br>";
            }

            // Close cURL session
            curl_close($ch);

            // Redirect to proghead.transaction.php
            header('location: ../proghead/proghead.transaction.php');
            exit;
        } else {
            echo "Error updating: " . $connection->error;
        }
    } else {
        echo "Data not found for LRN: $lrn";
    }
} else {
    echo "LRN parameter not set";
}

$connection->close();
?>
