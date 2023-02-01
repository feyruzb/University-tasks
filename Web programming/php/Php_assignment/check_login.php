<?php
    session_start();
    function check_login() {
        // Check if the user is not logged in
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            // Redirect the user to the login page
            header("Location: login.php");
            exit;
        }
    }
?>
