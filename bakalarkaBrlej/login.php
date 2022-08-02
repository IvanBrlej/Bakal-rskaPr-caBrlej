<?php
session_start();
require 'includes/connection.php';

if(isset($_GET['message'])){
    $message = $_GET['message'];
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <link rel="stylesheet" href="assets/src/css/style.css">
      <script src="assets/src/js/script.js"></script>
    <title>Bakalarka</title>
  </head>
  <body>
  <div class="container">
      <section class="vh-100 bg-image">
          <div class="mask d-flex align-items-center h-100 gradient-custom-3">
              <div class="container h-100">
                  <div class="row  justify-content-center align-items-center h-100">
                      <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                          <div class="card" style="border-radius: 15px;">
                              <div class="card-body p-5">
          <p style="color: white"><?php if(isset($message)) {echo $message;} ?></p>
      </div>
    <form id="loginForm" action="handlers/login_handler.php" method="post" name="loginForm">
        <div class="form-group row m-3">
            <label for="email" class="col-sm-2 col-form-label" style="color: white">Email</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
            </div>
        </div>
        <div class="form-group row m-2">
            <label for="password" class="col-sm-2 col-form-label" style="color: white">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
        </div>
        <div class="form-group row m-2" id="confirmPasswordDiv" style="display: none">
            <label for="confirmPassword" class="col-sm-2 col-form-label" style="color: white">Confirm Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
            </div>
        </div>
        <div class="form-group row m-3" id="firstnameDiv" style="display: none">
            <label for="firstnamelabel" class="col-sm-2 col-form-label" style="color: white">First Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="FirstName">
            </div>
        </div>
        <div class="form-group row m-3" id="lastnameDiv" style="display: none">
            <label for="lastnamelabel" class="col-sm-2 col-form-label" style="color: white">Last Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
            </div>
        </div>
        <div class="form-group row m-3">
            <div class="col-sm-10">
                <button type="submit" class="login_btn" id="loginButton" name="loginButton" value="0">Log In</button>
            </div>
        </div>
        <div class="form-group row m-3" onclick="toggleSignup();">
            <div class="col-sm-10">
                <p id="toggleMessage"><a href="#" id="toggleMessageTag" style="text-align: center; font-size: 1.2rem; color: white"><b> If you do not have alread account, click to sign up</b></a></p>
            </div>
        </div>
    </form>
  </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </body>
</html>