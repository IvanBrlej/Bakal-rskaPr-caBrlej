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

$query = $con->prepare("SELECT * FROM questionjson where subject = ?");
$query->bind_param("s",$subject);
$query->execute();
$result = $query->get_result();
$arr = array();
$i = 0;
$id = 0;
while(($row = mysqli_fetch_array($result))) {
    $arr = explode(',', $row['questions']);
    $type = $row['questionType'];
    echo "<div class='question container $type'>";
    ?>
    <br>
    <?php
    foreach ($arr as $key => $value) {
        if($type == "checkbox"){
            if($i == 0){
                $i++;
              ?>
                <input name="option" style="background-color: #3AAFA9" class="inputQuestion" id="<?php echo "Question [$i]:";?>" value="<?php echo   $value;?>" readonly>
                <br>
                <?php
            }else{
            ?>
            <input type="checkbox" name="option" class="inputQuestion" id="<?php echo "Question [$i]:";?>" value="<?php echo   $value;?>">
            <label for="<?php echo "Question [$i]:";?>"><?php echo   $value;?></label>
            <br>
            <?php
            }

        }else if($type == "text"){
                ?>
                <input style="background-color: #3AAFA9" class="inputQuestionText" id="<?php echo "Question Text: ";?>" value="<?php echo   $value;?>" readonly>
                <br>
                <br>
                <input  class="inputAnswerText" id="<?php echo "Answer Text: ";?>" placeholder="odpoved na otazku">
            <br>
            <br>
                <?php
    }else if($type == "radius button"){

            if($i == 0){
                $i++;
            ?>
                <input name="optionRadiusButton" style="background-color: #3AAFA9" class="inputQuestion" id="<?php echo "Question [$id]:";?>" value="<?php echo   $value;?>" readonly>
                <br>
                <?php
            }else{
                ?>
            <input type="radio"  class="inputRadioQuestion" name="<?php echo "Question [$id]:";?>" value="<?php echo   $value;?>">
            <label for="<?php echo "Question [$id]:";?>"><?php echo   $value;?></label>
            <br>
            <?php

            }
        }
        $id++;
}
    $i = 0;
    echo "</div>";
    echo "<br>";
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
    <title>Test</title>
    <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
</head>
<body>
<div class="container" style="margin-top: 20px;">
    <input id="subject" type="hidden" name="subject" value="<?php echo $subject; ?>">
    <div class="container">
        <div class="col-sm-10">
            <button type="submit"  onclick="location.href='/bakalarkaBrlej/homepage.php'" class="sendTest" id="submitTest"  name="submitTest">Submit Test</button>
        </div>
    </div>
</div>
</body>
</html>

<script>
    $(document).ready(function(){
        $("#submitTest").click(function(){
            var array = document.getElementsByClassName('question');
            var questions = [];
            var subject = document.getElementById("subject").value;
            var test = {subject};
            questions.push(test);
            for(let j = 0; j < array.length; j ++){
                if(array[j].classList.contains('checkbox')){
                    var otazka = array[j].querySelectorAll('input[name="option"]');
                    for( let l = 0; l < otazka.length; l ++){
                        var Otazka = otazka[0].value;
                        if (otazka[l].checked) {
                            var Odpoved = otazka[l].value;
                            var result = {Otazka, Odpoved};
                            questions.push(result);
                        }
                    }
                }else if(array[j].classList.contains('text')){
                    var Otazka = array[j].querySelector('input[class="inputQuestionText"]').value;
                    var Odpoved = array[j].querySelector('input[class="inputAnswerText"]').value;
                    var result = {Otazka,Odpoved};
                    questions.push(result);
                }else{
                    var questionRadio = array[j].querySelectorAll('input[class="inputRadioQuestion"]');
                    for( let l = 0; l < questionRadio.length; l ++){
                        var Otazka = questionRadio[0].value;
                        if (questionRadio[l].checked) {
                            var Odpoved = questionRadio[l].value;
                            var result = {Otazka, Odpoved};
                            questions.push(result);
                        }
                    }
                }
            }

            $.ajax({
                url: 'JSONTEST_HANDLER.php',
                method: "post",
                data: {questions, subject},
                success: function (res) {
                    console.log(res);
                }
                ,
                error: function (jqXHR, exception) {
                    console.log('Error occured!!');
                }
            });
        });
    });
</script>

