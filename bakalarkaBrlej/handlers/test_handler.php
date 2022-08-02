<?php
session_start();

require '../includes/connection.php';
include 'includes/header.php';

$message = '';

if(isset($_POST['submitTest'])) {
    $subject = $_POST['subject'];
    $date = date('Y-m-d H:i:s');

    if(!isset($_SESSION['email'])){
        $userLoggedIn = ' ';
    }else{
        $userLoggedIn = $_POST['userLoggedIn'];
    }

    $query = $con->prepare("INSERT INTO record VALUES('',?,?,?,?,?)");
    $query->bind_param("sssss", $userLoggedIn,$question ,$answer, $date,$subject);;

    foreach($_POST['answer'] as $answer)
    {
        $question = $_POST['question'];
        mysqli_stmt_execute($query);
    }
}
header("Location: /bakalarkaBrlej/homepage.php");
?>