<?php
include('includes/header.php');

if(isset($_POST['subject'])){
    $subject = $_POST['subject'];
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/src/css/style.css">
    <title>Select Question Type</title>
</head>
<body>



<div class="container" style="margin-top: 60px" align="center">
    <h3 style="text-align: center">Select Question Type</h3>
        <!-- <form id="indexFrom" method="post" action="test.php" name="uploadSubjectForm"> -->
    <form id="indexFrom" method="post" action="JSONFORM.php" name="uploadSubjectForm">
        <input type="hidden" name="userLoggedIn" value="<?php  echo $userLoggedIn; ?>">
        <input type="hidden" name="subject" value="<?php  echo $subject; ?>">
        <div class="container">
            <select type="select" class="form-control" name="questionType" id="questionType" style="max-width: 50%; text-align: center">
                <option value="text">Text</option>
                <option value="checkbox">Checkbox</option>
                <option value="radius button">Radius Button</option>
            </select>
        </div>
        <div class="container">
            <div class="col-sm-10">
                <button type="submit" class="button_send" id="selectQuestionType" name="selectQuestionType">Select</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>
