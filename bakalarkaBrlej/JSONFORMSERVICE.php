<?php
session_start();
require 'includes/connection.php';

$method = $_SERVER['REQUEST_METHOD'];
 if($method == "POST"){
    $questionType = $_POST['questionType'];
    $subject = $_POST['subjectCategory'];
    $username = $_POST['username'];
    $questionTitle = $_POST['questionTitle'];
     $question1 = $_POST['question1'];
     $question2 = $_POST['question2'];
     $question3 = $_POST['question3'];

     if($questionType == "text"){

        $sql_insert = "INSERT INTO questionjson (questionId, questionType,questions, subject, username)
                    VALUES (NULL, '$questionType','$question1', '$subject','$username')";

         if(mysqli_query($con, $sql_insert)){
             echo "Item successfully added to the database";
         }else{
             echo "ERROR: $sql_insert did not run".mysqli_error($con);
         }
    }else{

        $array = [
            "questionTitle" => $questionTitle,
            "question1" => $question1,
            "question2" => $question2,
            "question3" => $question3
        ];

        $insert_data = implode(",", $array);

        $sql_insert = "INSERT INTO questionjson (questionId, questionType,questions, subject, username)
                    VALUES (NULL, '$questionType','$insert_data', '$subject', '$username')";
        if(mysqli_query($con, $sql_insert)){
            echo "Item successfully added to the database";
        }else{
            echo "ERROR: $sql_insert did not run".mysqli_error($con);
        }
    }
     mysqli_close($con);
}
?>