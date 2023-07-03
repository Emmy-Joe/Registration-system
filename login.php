<?php
    session_start();
    require 'config.php';

    //return back the form details if there was an error
    $username = $_SESSION['login-data']['username'] ?? null;
    $password = $_SESSION['login-data']['password'] ?? null;

    //delete the form details session
    unset($_SESSION['login-data']);
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
    
<h2>Login System</h2> <br>
<form action="login_pro.php" method="post">

    <!--show the error message-->
<?php if(isset($_SESSION['register_success']))  : ?>
    <p style="color: green; text-align: center"><?= $_SESSION['register_success']; unset($_SESSION['register_success']); ?></p>
    <?php elseif(isset($_SESSION['login_error']))  : ?>
        <p style="color: red; text-align: center"><?= $_SESSION['login_error']; unset($_SESSION['login_error']); ?></p>
        <?php endif ?>
<!--end of show error code-->
    
    
    <input type="text" value="<?= $username ?>" name="username" placeholder="Username"><br>
    <input type="password" value="<?= $password ?>" name="password" placeholder="Password"><br>
    <input type="submit" name="submit" value="Login">
    <a href="register.php">Not yet a student? Register</a>

</form>
</body>
</html>