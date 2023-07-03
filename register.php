<?php
session_start();
require 'config.php';

//return back the form information already filled by the user should there be any error
$fullname = $_SESSION['registration-data']['fullname'] ?? null;
$username = $_SESSION['registration-data']['username'] ?? null;
$password = $_SESSION['registration-data']['password'] ?? null;
$rpassword = $_SESSION['registration-data']['rpassword'] ?? null;

//delete the registration session
unset($_SESSION['registration-data']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registraion</title>
    <link rel="stylesheet" href="style.css"
    
</head>
<body>
    
<h2>Registraion System</h2> <br>
<form action="reg_pro.php" method="post">
    <!--display the error message-->
    <?php if(isset($_SESSION['register_error']))  : ?>
        <p style="color: red;"><?= $_SESSION['register_error']; unset($_SESSION['register_error']) ?> </p>
        <?php endif ?>

    <input type="text" value="<?=$fullname ?>" name="fullname" placeholder="full name"><br>
    <input type="text" value="<?= $username ?>" name="username" placeholder="Username"><br>
    <input type="password" value="<?= $password ?>" name="password" placeholder="Password"><br>
    <input type="password" value="<?= $rpassword ?>" name="rpassword" placeholder="Re-type Password"><br>
    <input type="submit" name="submit" value="Register"">
    <a href="login.php">Already a student, Login</a>

</form>
</body>
</html>