<?php
    session_start();
    require 'config.php';

    //destroy all session and redirect user to login

    session_destroy();

    header('location: ' . DOMAIN . 'login.php');
    die();
?>