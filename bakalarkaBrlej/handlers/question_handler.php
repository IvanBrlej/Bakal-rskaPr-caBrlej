<?php
session_start();
require '../includes/connection.php';

if(isset($_POST['submitQuestion'])) {

    $questionNumber = $_POST['questionNumber'];
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $question = mysqli_real_escape_string($con, $_POST['question']);
    $question = strip_tags($question);

    $query = $con->prepare("INSERT INTO questions VALUES('', ?,?,?)");
    $query->bind_param("sss", $questionNumber, $question,$subject);
    $query->execute();
    $result = $query->get_result();
    header("Location: /bakalarkaBrlej/upload_subject.php");
}
else
{
    header("Location: /bakalarkaBrlej/test.php");
    exit();
}
?>