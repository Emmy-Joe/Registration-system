<?php
    session_start();
    require "config.php";

    if(isset($_POST["submit"])){
        $fullname = filter_var($_POST["fullname"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $username = filter_var($_POST["username"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_var($_POST["password"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $rpassword = filter_var($_POST["rpassword"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        //form validation
        if(!$fullname){
            $_SESSION['register_error'] = "Fullname is required";
        }elseif(!$username){
            $_SESSION['register_error'] = "Username is require";
        }elseif(!$password){
            $_SESSION['register_error'] = "Password is require";
        }elseif(!$rpassword){
            $_SESSION['register_error'] = "Confirm Password is require";
        }elseif(strlen($password) < 8 || strlen($rpassword) < 8){
            $_SESSION['register_error'] = "Password should be minimum of 8 characters";
        }elseif($password !== $rpassword){
            $_SESSION['register_error'] = "Password do not match!";
        }else{
            //password encription or hash
            $hash = password_hash($password, PASSWORD_DEFAULT);

            //a check if the user already exist
            $statement = $conn->prepare("SELECT * FROM users WHERE username = '$username'");
            $statement->execute();
            $statement->fetchAll(PDO::FETCH_ASSOC);
            $get_username = $statement->rowCount();

            if($get_username > 0){
                $_SESSION['register_error'] = "Username already exist!";
            }

        }
        //end of validation
    //to redirect the user to the registration page if error occur
    if(isset($_SESSION['register_error'])){
        //retreive the form deatils earlier filled by the user
        $_SESSION['registration-data'] = $_POST;
        //head back to registration page
        header('location: ' . DOMAIN . 'register.php');
        die();
    }else{
        //if no error occured
        try{
            //insert into users db table
            $insert_user_query = $conn->prepare("INSERT INTO users (fullname, username, password)
            VALUES ('$fullname', '$username', '$hash')");
            $insert_user_query->execute();

            //redirect to login page with a success message
            $_SESSION['register_success'] = "Successfully registered. Please login";
            header('location: ' . DOMAIN . 'login.php');
            die();
        }catch(PDOException $err){
            $_SESSION['register_error'] = "error: " . $err->getMessage();
            die();
        }
    }



    }
    else{
        //if the button was not clicked
        header('location: ' . DOMAIN . 'register.php');
        exit();
    }
?>