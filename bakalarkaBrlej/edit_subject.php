<?php
include("includes/header.php");

if(isset($_GET['message'])) {
    $message = $_GET['message'];
}

$subjectOptions = array();

$query = "SELECT DISTINCT subject FROM questionjson WHERE username = '$userLoggedIn'";
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)){
    $subjectOptions[] = $row['subject'];
}

$totalQuestions = mysqli_num_rows($result);
$questionNumber = (int)$totalQuestions + 1;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/src/css/style.css">
    <title>Edit Question</title>
</head>
<body>
<div class="container" style="margin-top: 60px" align="center">
    <div style="text-align: center; font-weight: bold;">
        <p style="color: white"><?php if(isset($message)) {echo $message;} ?></p>
    </div>
    <h3>Choose subject to edit</h3>
    <form id="editForm" method="POST" action="edit_handler.php" name="editSubjectForm">
        <input  type="hidden" name="userLoggedIn" value="<?php echo $userLoggedIn; ?>">
        <input type="hidden" name="userRole" value="<?php echo $userRole; ?>">
        <div class="container">
            <div class="col-sm-10">
                <select type="select" class="form-control" id="subject" name="subject" style="max-width: 50%; text-align: center">
                    <?php
                    for($i =0; $i < count($subjectOptions); $i++){
                        ?>
                        <option value="<?php echo $subjectOptions[$i]; ?>"><?php echo $subjectOptions[$i]; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="container">
            <div class="col-sm-10">
                <button type="submit" class="button_send" id="submitEditSubject" name="submitEditSubject">Edit</button>
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