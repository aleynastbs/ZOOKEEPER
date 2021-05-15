<?php
    include("configure.php");
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['user_id']);
    unset($_SESSION['user_type']);
    $_SESSION['logged_in'] = false;

    header('location: login.php');
?>