<?php
session_start();
require '../includes/connection.php';

$message = '';

if(isset($_POST['submitEditTest'])) {
    $userLoggedIn = $_POST['userLoggedIn'];
    $subject = $_POST['subject'];

    foreach($_POST as $key => $value) {
        if(strpos($key, 'question_answer_') !== false){
            $questionArray = explode('question_answer_', $key);
            $questionNumber = $questionArray[1];
            $question = mysqli_real_escape_string($con, $_POST[$questionArray[1]]);
            $question = strip_tags($question);

            $query = "UPDATE questionjson SET questions = '$question' WHERE id = '$id'
                    AND subject = '$subject'";

            $result = mysqli_query($con, $query);

            if(!$result) {
                $message.= 'Sorry, an error occured while storing your edited questions';
                header("Location: /bakalarkaBrlej/homepage.php?message='$message'");
                exit();
            }

        }
    }
    $message.= 'Questions have been edited successfully';
    header("Location: /bakalarkaBrlej/homepage.php?message='$message'");
    exit();
}
else
{
    header("Location: /bakalarkaBrlej/login.php");
    exit();
}
?>