<?php
session_start();
require 'includes/connection.php';

$message = '';

if(isset($_POST['submitDeleteSubject'])) {

    $subjects = $_POST['subjects'];
    //string list nieco take separovane ciarkou
    $subjects = implode("','", $subjects);

    $query =
        " DELETE FROM `questions`" .
        " WHERE `subject` IN ('".$subjects."')";

    $result = mysqli_query($con, $query);

    if($result) {
        $message.= 'The selected subjects have been deleted successfully';
        header("Location: /bakalarkaBrlej/delete_subject.php?message='$message'");
        exit();
    }
    else
    {
        $message.= 'Delete error. The selected subjects have not been deleted successfully';
        header("Location: /bakalarkaBrlej/delete_subject.php?message='$message'");
        exit();
    }

}
else
{
    header("Location: /bakalarkaBrlej/test.php");
    exit();
}

?>