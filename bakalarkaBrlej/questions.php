<?php
include("includes/header.php");

if(isset($_GET['subject'])) {
    $subject = $_GET['subject'];
}
else
{
    header("Location: http://localhost:63342/bakalarkaBrlej/homepage.php");
    exit();
}

/*
//aby uzivatel nemohol spravit zber viac ako jeden krat
$query = $con->prepare("SELECT * FROM record WHERE username = ? AND subject= ?");
$query->bind_param("ss", $userLoggedIn, $subject);
$query->execute();
$userCheck = $query->get_result();
$check = mysqli_num_rows($userCheck);
$message = '';

if($check > 0){
    $message.= 'You cannot take the test on a subject more than once per quiz session.';
    header("Location: http://localhost:63342/bakalarkaBrlej/homepage.php?message='$message'");
    exit();
}
*/
//vsetky otazky z predmetu
$query = $con->prepare("SELECT question_number, question FROM questions WHERE subject = ?");
$query->bind_param("s",$subject);
$query->execute();
$result = $query->get_result();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/src/css/style.css">
    <title>Test</title>
</head>
<body>
<div class="container" style="margin-top: 20px;">
    <h3 style="text-align: center; margin-bottom: 25px;">Test your knowledge!</h3>
    <form id="quizForm" method="post" action="handlers/test_handler.php" name="testForm">
        <input type="hidden" name="userLoggedIn" value="<?php echo $userLoggedIn; ?>">
        <input type="hidden" name="subject" value="<?php echo $subject; ?>">
        <?php
        $count = 1;
        while($row = mysqli_fetch_array($result)) {
            ?>
            <div class="container">
                <label for="question" class="col-sm-2 col-form-label">Question <?php echo $count; ?></label>
                <div class="col-sm-10">
                    <input type="hidden" name="question" readonly value="<?php echo $row['question']; ?>">
                    <p><?php echo $row['question']; ?> </p>
                    <input type="text" class="form-control" id="answer" name="answer[]">
                </div>
            </div>
            <?php
            $count++;
        }
        ?>
        <div class="container">
            <div class="col-sm-10">
                <button type="submit" class="sendTest" id="submitTest" name="submitTest">Submit Test</button>
            </div>
        </div>
    </form>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>