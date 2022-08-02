<?php
    include('includes/header.php');

    if(isset($userLoggedIn)){

    }else{
        header("Location: /bakalarkaBrlej/login.php");
    }

    if(isset($_GET['message'])){
        $message = $_GET['message'];
    }

    $subjectOptions = array();

    $query = "SELECT DISTINCT subject FROM questionjson";
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
    <title>Home Page</title>
</head>
<body>
<div class="container" style="margin-top: 60px" align="center">
    <h3 style="text-align: center">Choose subject</h3>
    <div style="text-align: center; font-weight: bold;">
        <p style="color: white"><?php if(isset($message)){echo $message;} ?></p>
    </div>
    <form id="questionForm" action="jsonTest.php" method="get" name="questionForm">
        <input type="hidden" name="userLoggedIn" value="<?php  echo $userLoggedIn; ?>">
        <div class="container">
            <select type="select" class="form-control" id="subject" name="subject" style="max-width: 50%; text-align: center;">
                <?php
                for($i =0; $i < count($subjectOptions); $i++){
                    ?>
                    <option value="<?php echo $subjectOptions[$i]; ?>"><?php echo $subjectOptions[$i]; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="container">
            <div class="col-sm-10">
                <button type="submit" class="button_send" id="sumbitSubject" name="sumbitSubject">Choose</button>
            </div>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
</body>
</html>
