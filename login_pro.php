<?php
    session_start();
    require 'config.php';

    if(isset($_POST['submit'])){
        $username = filter_var($_POST["username"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_var($_POST["password"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        //validate login form
        if(!$username){
            $_SESSION['login_error'] = "Username is required";
        }elseif(!$password){
            $_SESSION['login_error'] = "Password is required";
        }else{
            //get the user information from database
            $statement = $conn->prepare('SELECT * FROM users WHERE username = :username');
            $statement->bindValue(':username', $username);
            $statement->execute();
            $statement_result = $statement->rowCount();

            if($statement_result == 1){
                //convert the user data to an array
                $get_user = $statement->fetch(PDO::FETCH_ASSOC);

                //get the encripted/hashed database password
                $database_password = $get_user['password'];

                //compare the inputed password and the one retrieved from the database
                if(password_verify($password, $database_password)){
                    //set the session for the user to access
                    $_SESSION['user-id-session'] = $get_user['id'];
                    //log the user in
                    header('location: ' . DOMAIN . 'index.php'); //this the home page

                }else{
                    $_SESSION['login_error'] = "Incorrect username or password";
                }
            }else{
                $_SESSION['login_error'] = "User not found!";
            }
        }

    //if there was any error, redirect the user back to the login page
    if(isset($_SESSION['login_error'])){
        //get back the login data
        $_SESSION['login-data'] = $_POST;
        header('location: ' . DOMAIN . 'login.php');
        die();
    }


    }else{
        //if the login button was not clicked
        header('location: ' . DOMAIN . 'login.php');
        exit();
    }
?>