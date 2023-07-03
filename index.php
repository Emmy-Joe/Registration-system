<?php
    session_start();
    require 'config.php';

    //get the current user from database if the user is in a session
    if(isset($_SESSION['user-id-session'])){
        $id = filter_var($_SESSION['user-id-session'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $statement = $conn->prepare('SELECT * FROM users WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement_result = $statement->fetch(PDO::FETCH_ASSOC);
    }else{
        header('location: ' . DOMAIN . 'login.php');
        exit();
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

<h2>Hello, <?php echo $statement_result['fullname'] ?> </h2>

<!--logout button-->
    
<a href="logout.php">Logout</a>
</body>
</html>