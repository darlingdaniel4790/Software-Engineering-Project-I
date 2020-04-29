<?php
  /* START SESSION */
  session_start();

  /* CONNECT TO DATABASE */
  include('database-connect.txt');

  /* FUNCTION TO REDIRECT USER */
  function redirect($page) {
    header('Location: ' . $page);
    exit;
  }

  $errorMessage = "";
  /* CHECK LOGIN DETAILS */
  if($_POST){
    if(array_key_exists("login", $_POST)){  // USER IS LOGGING IN
      $query = "  SELECT *
                  FROM `users`
                  WHERE `username` = '".$_POST['username']."'
      ";
      if($result = mysqli_query($link, $query)){
        if(mysqli_num_rows($result) > 0){
          $row = mysqli_fetch_array($result);
          if(password_verify($_POST['password'], $row['password'])){
            if($_SESSION['username'] = $row['username'])  // STORE THE SESSION USERNAME
              redirect("quiz-page.php");  // SUCCESSFUL SIGN IN
          } else {
            $errorMessage = "<p class='alert alert-danger'>Your passord is incorrect</p>";
          }
        } else {
          $errorMessage = "<p class='alert alert-danger'>Your username is incorrect</p>";
        }
      }

    } else {  // USER IS SIGNING UP
      //  CHECK IF USER EXISTS
      $query = "  SELECT `id`
                  FROM `users`
                  WHERE `username` = '".$_POST['username']."'
      ";
      if($result = mysqli_query($link, $query)){
        if(mysqli_num_rows($result) > 0){
          $errorMessage = "<p class='alert alert-danger'>The username you selected has already been taken</p>";
        } else {  //  SIGN USER UP
          $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

          $query = "  INSERT INTO `users`
                      (`username`, `password`)
                      VALUES('".$_POST['username']."', '".$hash."')
          ";

          if($result = mysqli_query($link, $query)){
            if($_SESSION['username'] = $_POST['username'])  // STORE THE SESSION USERNAME
            redirect("quiz-page.php");  // SUCCESSFUL SIGNUP
          } else {
            $errorMessage = "<p class='alert alert-danger'>There was a problem signing you up, Please try again</p>";
          }
        }
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Crystal Quiz App | Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>
  <body >
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Fluid jumbotron</h1>
        <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
        <form class="" action="" method="post">
          <div id="loginForm">
            <div class="form-group row">
              <label for="Lusername" class="col-sm-2 col-form-label">Username</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="Lusername" name="username" placeholder="johndoe" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="Lpassword" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="Lpassword" name="password" placeholder="********" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col">
                <button type="submit" class="btn btn-success btn-block" name="login">Login</button>
              </div>
              <div class="col">
                <button type="button" class="btn btn-primary btn-block" id="toggleButton">New? Sign Up!</button>
              </div>
            </div>
          </div>
        </form>
        <div id="errorDiv">
          <?php echo $errorMessage; ?>
        </div>
      </div>
    </div>
    <div class="container">
      <form class="" action="" method="post">
        <div id="signupForm" style="display: none">
          <div class="form-group row">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="username" name="username" placeholder="johndoe" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
            </div>
          </div>
          <div class="form-group row">
            <label for="confirmPassword" class="col-sm-2 col-form-label">Confirm Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="********" required>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-success" id="signupButton" name="signup">Sign up and Take Test</button>
            </div>
          </div>
        </div>
      </form>

    <!-- BOOTSTRAP, JQUERY, POPPER -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- CUSTOM JAVASCRIPT -->
    <script type="text/javascript">
      /* TOGGLE THE DISPLAY OF THE SIGNUP FORM */
      document.getElementById('toggleButton').onclick = function(){
        if (document.getElementById('signupForm').style.display === "none") {
          document.getElementById('signupForm').style.display = "block";
          document.getElementById("username").focus();
        } else {
          document.getElementById('signupForm').style.display = "none";
        }
      }

      /* CHECK THAT PASSWORDS MATCH FOR SIGNUP */
      document.getElementById("signupButton").onclick = function(event){
        if(document.getElementById('password').value != document.getElementById('confirmPassword').value){
          document.getElementById("errorDiv").scrollIntoView();
          document.getElementById("errorDiv").innerHTML = "<br><p class='alert alert-warning'>Please check, your passwords don't match!</p>";
          event.preventDefault();
        }
      }

      if(document.getElementById("errorDiv").innerHTML != ""){
        document.getElementById("errorDiv").scrollIntoView();
      }
    </script>
    </div>
  </body>
</html>
