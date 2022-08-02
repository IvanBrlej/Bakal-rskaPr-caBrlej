<?php
session_start();
require 'connection.php';


if(isset($_SESSION['email'])){
    $userEmail = $_SESSION['email'];


    $query = $con->prepare("SELECT username FROM users WHERE email= ?");
    $query->bind_param("s", $userEmail);
    $query->execute();
    $result = $query->get_result();

    while($row = mysqli_fetch_array($result)){
        $userLoggedIn = $row['username'];
        //$userRole = $row['user_role'];
    }
//}else{
//    header("Location: /bakalarkaBrlej/login.php");
}
?>
    <!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- boxicons -->
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/src/css/nav.css">
        <title>Bakalarka</title>
    </head>
<body>

<?php
/*if(isset($_SESSION['email'])){ */?><!--
    <input type="checkbox" id="check">
    <label for="check">
        <i class="bx bx-menu" id="btn"></i>
        <i class="bx bx-menu" id="cancel"></i>
    </label>
    <div class="sidebar">
        <header>Menu</header>

    </div>
--><?php /*} */?>

<nav class="navbar navbar-expand-sm  justify-content-end sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">BrlejBakalarka</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <?php
                if(isset($_SESSION['email'])){ ?>
                    <li>
                        <a href="/bakalarkaBrlej/homepage.php">
                            <i class='bx bx-home-alt-2'></i>
                            <span class="links_name">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="/bakalarkaBrlej/upload_subject.php">
                            <i class='bx bx-comment-add'></i>
                            <span class="lins_name">Add question</span>
                        </a>
                    </li>
                    <li>
                        <a href="/bakalarkaBrlej/edit_subject.php">
                            <i class='bx bx-edit'></i>
                            <span class="lins_name">Delete question</span>
                        </a>
                    </li>
                    <li>
                        <a href="/bakalarkaBrlej/subject.php">
                            <i class='bx bx-folder-plus'></i>
                            <span class="lins_name">Add subject</span>
                        </a>
                    </li>
                    <li>
                        <a href="chooseSubjectToExport.php">
                            <i class='bx bx-file'></i>
                            <span class="lins_name">Export data</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class='bx bx-user'></i>
                            <span class="lins_name"><?php echo $userLoggedIn; ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="logout.php">
                            <i class='bx bx-log-out'></i>
                            <span class="lins_name">Log Out</span>
                        </a>
                    </li>
                <?php } ?>
        </div>
    </div>
</nav>
