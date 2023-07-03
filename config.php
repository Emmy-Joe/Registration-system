<?php
    define('DOMAIN', 'http://localhost/login-registration-system/');


    $host_name = "localhost";
    $username = "root";   //your database username
    $password = "";  //your password
    $db_name = "student_registration_system";  //your database name

    try{
        $conn = new PDO("mysql:host=$host_name; dbname=$db_name", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "connection failed: " .$e->getMessage();
    }

?>