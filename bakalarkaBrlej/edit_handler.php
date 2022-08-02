<?php
include("includes/header.php");

if(isset($_POST['subject'])) {
    $subject = $_POST['subject'];
}
else
{
    header("Location: /bakalarkaBrlej/homepage.php");
    exit();
}

$message = '';
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/src/css/style.css">
    <title>Edit Questions</title>
</head>
<body>
<div class="container" style="margin-top: 20px;">
    <h3 style="text-align: center; margin-bottom: 25px;">Edit Questions on <?php echo $subject; ?></h3>
    <form id="quizForm" method="post" action="handlers/test_edit_handler.php" name="testForm" enctype="multipart/form-data">
        <input type="hidden" name="userLoggedIn" value="<?php echo $userLoggedIn; ?>">
        <input type="hidden" name="subject" value="<?php echo $subject; ?>">
        <?php
        $query = $con->prepare("SELECT * FROM questionjson where subject = ?");
        $query->bind_param("s",$subject);
        $query->execute();
        $result = $query->get_result();

        $arr = array();
        while(($row = mysqli_fetch_array($result))) {
            $arr = explode(',', $row['questions']);
            $type = $row['questionType'];
            echo "<div class='question container $type'>";
        ?>
        <?php
            foreach ($arr as $key => $value) {
                if($type == "checkbox"){
                    ?>
                    <input type="text" name="option" class="inputQuestion" id="<?php echo $row['questionId']; ?>" value="<?php echo   $value;?>">
                    <?php
                }else if($type == "text"){
                    ?>
                    <input  class="inputQuestionText" id="<?php echo $row['questionId']; ?>" value="<?php echo   $value;?>">
                    <?php
                }else if($type == "radius button"){
                    ?>
                    <input type="text" name="optionRadiusButton" class="inputRadioQuestion" id="<?php echo $row['questionId']; ?>" value="<?php echo   $value;?>">
                    <?php
                }
            }
        ?>
        <a href="delete_subject.php?id=<?php echo $row['questionId']; ?> ">
            <button type="button" name="delete_question" class="btn btn-danger">Delete</button>
            <br>
            <?php
            echo "</div>";
            ?>
            <br>
            <?php
        }
        ?>

        <div class="container">
            <div class="col-sm-10">
                <button type="submit" class="button_send" id="submitEditTest" name="submitEditTest">Submit Quiz</button>
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