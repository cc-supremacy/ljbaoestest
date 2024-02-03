<!-- session.php -->

<?php

session_start();

function login($username, $role) {
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
}

function logout() {
    session_unset();
    session_destroy();
}

function isLoggedIn() {
    return isset($_SESSION['username']);
}

function checkRole($role) {
    return isset($_SESSION['role']) && $_SESSION['role'] == $role;
}

// Add other session-related functions as needed

?>
