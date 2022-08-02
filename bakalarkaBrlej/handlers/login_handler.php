<?php
session_start();
require "../includes/connection.php";

$message = '';

if(isset($_POST['loginButton'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmPassword'];

    if($_POST['loginButton'] == 1){
        if(strlen($firstname) < 2 || strlen($lastname < 2)){
            $message.= 'Your name cannot be 1 letter long';
            header("Location: /bakalarkaBrlej/login.php?message='$message'");
            exit();
        }
        if($password !== $confirmpassword){
            $message.= 'Your password do not match';
            header("Location: /bakalarkaBrlej/login.php?message='$message'");
            exit();
        }

        if(strlen($password) > 60 || strlen($password) < 7){
            $message.= 'Your password must be between 60 and 7';
            header("Location: /bakalarkaBrlej/login.php?message='$message'");
            exit();
        }

        $query = $con->prepare("SELECT email FROM users WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();

        if(!$result){
            echo(mysqli_error($con));
        }

        if(mysqli_num_rows($result) > 0){
            $message.= 'Email is already exists';
            header("Location: /bakalarkaBrlej/login.php?message='$message'");
            exit();
        }else{
            if(preg_match('/[^A-Za-z0-9&$+]/', $password)){
                $message.= 'Your password can contain only english characters, numbers, &, $, +';
                header("Location: /bakalarkaBrlej/login.php?message='$message'");
                exit();
            }
            $password = password_hash($password, PASSWORD_DEFAULT);
            $username = strtolower($firstname."_".$lastname);

            $query = $con->prepare("SELECT username FROM users WHERE username = ?");
            $query->bind_param("s", $username);
            $query->execute();
            $usernameCheck = $query->get_result();

            $i = 0;
            //ak existuje pouzivatel s rovnakym menom prida mu cislo
            while(mysqli_num_rows($usernameCheck) != 0){
                $i++;
                $username = $username."_".$i;

                $query = $con->prepare("SELECT username FROM users WHERE username = ?");
                $query->bind_param("s", $username);
                $query->execute();
                $usernameCheck = $query->get_result();
            }
            $date = date('Y-m-d H:i:s');

            $query = $con->prepare("INSERT INTO users VALUES('',?, ?,?,?,?,?)");
            $query->bind_param("ssssss", $firstname, $lastname, $email,$password,$username,$date);
            $query->execute();

            if($query){
                $_SESSION['email'] = $email;

                header("Location: /bakalarkaBrlej/homepage.php");
            }else{
                $message.= "Your sign up was not succesfull. Please try again later";
                header("Location: /bakalarkaBrlej/login.php?message='$message'");
                exit();
            }
        }
    }else{

        $query = $con->prepare("SELECT email , firstname, username, password FROM users WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();

        if(mysqli_num_rows($result) < 1){
            $message.= 'This email is not registered.';
            header("Location: /bakalarkaBrlej/login.php?message='$message'");
            exit();
        }else{
            $row = mysqli_fetch_array($result);
            $firstname = $row['firstname'];
            $email = $row['email'];
            $username = $row['username'];
            $hashedPassword = $row['password'];

            if(password_verify($password, $hashedPassword)){
                $_SESSION['email'] = $email;
                header("Location: /bakalarkaBrlej/homepage.php");
                exit();
            }else{
                $message.= 'The email/password combination is incorrect.';
                header("Location: /bakalarkaBrlej/login.php?message='$message'");
                exit();
            }
        }
    }
}
else{
    header("Location: /bakalarkaBrlej/login.php");
    exit();
}
?>