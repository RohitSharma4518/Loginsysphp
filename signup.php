<?php 
$showAlert = false;
$show_password_error = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
include("repeatedcode/_dbconnection.php");
#phpvariable  =  form input name;
$username = $_POST["uname"];
$password = $_POST["password"];
$cpassword = $_POST["cpassword"];


//Check Wheather the user exists or not
$userexists = "SELECT * FROM users WHERE username = '$username'";
$useridexists_queryexecute = mysqli_query($connection, $userexists);
$useridexists_num = mysqli_num_rows($useridexists_queryexecute);
if($useridexists_num > 0){
  $show_password_error = "User already Exists";
}

else{
  //Checks wheather the password is same in the 2 fields given
  if($password == $cpassword){
    $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO `users` (`username`, `password`, `dt`) VALUES ('$username', '$hashed_pwd', current_timestamp())";
    $result = mysqli_query($connection, $sql);
    if($result){
      $showAlert = true;
    }
  }
  else{
    $show_password_error = "Passwords do not match";
  }
}

}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>SignUp</title>
  </head>
  <body>
    <?php require('repeatedcode/_navbar.php'); ?>
      <?php
        if($showAlert){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> You are now Successfully Registered and you can now login.
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
        if($show_password_error){
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Error!</strong> ' .$show_password_error.'.
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
      ?>
    <div class="container">
        <h1 class="text-center">SignUp to our Website</h1>
        <form action="/loginsystem/signup.php" method = "post">
            <div class="form-group">
                <label for="uname" class="form-label">UserName</label>
                <input name="uname" type="text" class="form-control" id="uname" aria-describedby="emailHelp" placeholder="Enter username">
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Enter password">
            </div>
            <div class="form-group my-6">
                <label for="cpassword" class="form-label ">Confirm Password</label>
                <input name="cpassword" type="password" class="form-control" id="cpassword" placeholder="Confirm your password">
                <span style = "color : black;">Please Enter the same password as above</span>
            
            </div>
            <div>
                <label></label>
            </div>
            <button type="submit" class="btn btn-primary">Singup</button>
        </form> 
    </div>
    <!-- Optional JavaScript; choose one of the two! -->


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
  </body>
</html>