<?php
require '../includes/connection.php';
$message = '';

if(isset($_POST['addSubjectButton'])) {
    $userLoggedIn = $_POST['userLoggedIn'];
    $subject = $_POST['addSubject'];

    $query = $con->prepare("SELECT subject FROM subjects WHERE subject = ?");
    $query->bind_param("s", $subject);
    $query->execute();
    $result = $query->get_result();

    if (!$result) {
        echo(mysqli_error($con));
    }

    if (mysqli_num_rows($result) > 0) {
        $message .= 'Subject is already exists';
        header("Location: /bakalarkaBrlej/subject.php?message='$message'");
        exit();
    } else {

        mysqli_query($con, "INSERT INTO subjects values(NULL,'$subject', '$userLoggedIn')");
    }
}
header("Location: /bakalarkaBrlej/homepage.php");
?>
