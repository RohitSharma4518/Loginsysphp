<?php 
$login = false;
$show_error = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
include("repeatedcode/_dbconnection.php");
#phpvariable  =  form input name;
$username = $_POST["uname"];
$password = $_POST["password"];

  #Sql queries for checking all the username and password exists in the database table users 

  $sql = "SELECT * FROM users WHERE username = '$username'";
  
  $result = mysqli_query($connection, $sql);
  $num = mysqli_num_rows($result);
  if($num == 1){
    while($row = mysqli_fetch_assoc($result)){
        if(password_verify($password, $row['password'])){
          $login = true;
          session_start();
          $_SESSION['loginsuccessful'] = true;
          $_SESSION['username'] = $username;
          header("location: welcomescreen.php");
          }
        else{
          $show_error = "Invalid Credentials";
        }
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

    <title>Login</title>
  </head>
  <body>
    <?php require('repeatedcode/_navbar.php'); ?>
      <?php
        if($login){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> You are now successfully logged in.
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
        if($show_error){
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Error!</strong> ' .$show_error.'.
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }

      ?>
    <div class="container">
        <h1 class="text-center">Login here.</h1>
        <form action="/loginsystem/login.php" method = "post">
            <div class="form-group">
                <label for="uname" class="form-label">UserName</label>
                <input name="uname" type="text" class="form-control" id="uname" aria-describedby="emailHelp" placeholder="Enter your username here">
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Enter password">
            </div>
            <div>
                <label></label>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
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