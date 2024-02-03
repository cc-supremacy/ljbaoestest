<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("connection/db.php"); // Adjust the path as per your file structure

    $username = $_POST['username'];
    $password = $_POST['pass'];

    // Perform validation and query to check user credentials
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            // Valid user, set session variables
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect all roles to proghead.dashboard.php
            header("Location: proghead/proghead.dashboard.php");
            exit(); // Ensure script stops here after redirect
        } else {
            echo "<script> alert('Invalid username or password.');</script>";
        }
    } else {
        echo "Error: " . mysqli_error($connection);
    }

    mysqli_close($connection);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <title>Admin Login</title>
</head>
<body>
<div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">
                    <!-- image --> 
                    <img src="" alt="">
                </div>
                
                <div class="col-md-6 right">
                    <div class="input-box">
                        <header>Lord Jesus <br> Blessed Academy</header>
                        <form action="" method="post">
                            <div class="input-field">
                                <input type="text" class="input" name="username" required>
                                <label for="username">Username</label>
                            </div>
                            <div class="input-field">
                                <input type="password" class="input" name="pass" required>
                                <label for="password">Password</label>
                            </div>
                            <div class="input-field">
                                <input type="submit" class="submit" name="submit" id="submit" value="Sign In">
                            </div>
                        </form>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>