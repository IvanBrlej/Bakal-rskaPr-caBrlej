<?php
include('includes/header.php');
$subject = $_POST['subject'];
$username = $_POST['userLoggedIn'];
$type = $_POST['questionType'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>To do</title>
    <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <link rel="stylesheet" href="assets/src/css/style.css">
    <script>
        $(document).ready(function(){
            $.get("/bakalarkaBrlej/JSONFORMSERVICE.php", function(data,status){
                console.log(data);
                var toDoItems = JSON.parse(data);
                for(var i  = 0; i < toDoItems.length; i++){
                    var question = "questionId: " + toDoItems[i].questionId +
                        " questionType: " + toDoItems[i].questionType
                        + " question1: " + toDoItems[i].question1 +
                        " question2: " + toDoItems[i].question2 +
                    " question3: " + toDoItems[i].question3 +
                    " subjectCategory: " + toDoItems[i].subjectCategory +
                    "username: " + toDoItems[i].username;
                    question = "<li>" + question + "<li>";
                    $("#myQuestions").append(question);
                }
            });
            $("#saveQuestions").click(function(){
                var questionType = $("#questionType").val();
                var subjectCategory = $("#subjectCategory").val();
                var questionTitle = $("#questionTitle").val();
                var username = $("#username").val();
                var question1 = $("#question1").val();
                var question2 = $("#question2").val();
                var question3 = $("#question3").val();

                var questions = {
                    questionType : questionType,
                    questionTitle : questionTitle,
                    question1 : question1,
                    question2 : question2,
                    question3 : question3,
                    subjectCategory : subjectCategory,
                    username : username
                };
                $.post("/bakalarkaBrlej/JSONFORMSERVICE.php", questions, function(data){
                    console.log(data);
                });
            });
        });
    </script>
</head>
<body>
<script>
    $(document).ready(function(){
        var skuska = document.getElementById("questionType").value;
    if(skuska === "text"){
        $('#questionTitleDiv').hide();
        $('#question1Div').show();
        $('#question2Div').hide();
        $('#question3Div').hide();
    }else{
        $('#questionTitleDiv').show();
        $('#question1Div').show();
        $('#question2Div').show();
        $('#question3Div').show();
    }
    });
</script>
<div class="container">
    <section class="vh-100 bg-image">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row  justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <input type="hidden" id="subjectCategory" name="subjectCategory" value="<?php echo $subject; ?>">
                                <input type="hidden" id="username" name="username" value="<?php echo $username; ?>">
                                <input type="hidden" id="questionType" value="<?php echo $type; ?>">
                                <h2 style="color: white" align="center">Add new question</h2>
                                <div class="container col-sm-8" id="questionTitleDiv">
                                    <label style="color: white">Question Title</label>
                                    <input type="text" id="questionTitle" /><br>
                                </div>
                                <div class="container col-sm-8" id="question1Div">
                                    <label style="color: white">question1</label>
                                    <input type="text" id="question1" /><br>
                                </div>
                                <div class="container col-sm-8" id="question2Div">
                                    <label style="color: white">question2</label>
                                    <input type="text" id="question2"/><br>
                                </div>
                                <div class="container col-sm-8" id="question3Div">
                                    <label style="color: white">question3</label>
                                    <input type="text" id="question3" /> <br>
                                </div>

                                <a style="color: #1b1b1b; text-decoration: none" id="saveQuestions"  type="submit" href="homepage.php" class="login_btn">Add</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

</body>
</html>