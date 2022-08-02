<?php
session_start();
require 'includes/connection.php';

$questions = json_encode($_POST['questions'], true);
//echo "$questions";
//echo '<script>';
//echo 'console.log('.  $questions  .')';
//echo '</script>';

$subject = $_POST['subject'];
$date = date('Y-m-d H:i:s');
$sql_insert = "INSERT INTO answers (id, answers,subject, time_of_submission)
                    VALUES (NULL,'$questions','$subject','$date')";
if(mysqli_query($con, $sql_insert)){
    echo "Item successfully added to the database";
}else{
    echo "ERROR: $sql_insert did not run".mysqli_error($con);
}
?>
