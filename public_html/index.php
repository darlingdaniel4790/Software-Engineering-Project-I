<?php
  /* START SESSION */
  session_start();

  /* CONNECT TO DATABASE */
  include('database-connect.txt');

  /* FUNCTION TO REDIRECT USER */
  function redirect($page) {
    header('Location: ' . $page);
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
          if($_POST['password'] == $row['password']){
            if($_SESSION['username'] = $row['username'])  // STORE THE SESSION USERNAME
              redirect("quiz-page.php");  // SUCCESSFUL SIGN IN
          } else {
            $errorMessage = "Your passord is incorrect";
          }
        } else {
          $errorMessage = "Your username is incorrect";
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
          $errorMessage = "The username you selected has already been taken.";
        } else {  //  SIGN USER UP
          $query = "  INSERT INTO `users`
                      (`username`, `password`)
                      VALUES('".$_POST['username']."', '".$_POST['password']."')
          ";

          if($result = mysqli_query($link, $query)){
            if($_SESSION['username'] = $_POST['username'])  // STORE THE SESSION USERNAME
            redirect("quiz-page.php");  // SUCCESSFUL SIGNUP
          } else {
            $errorMessage = "There was a problem signing you up, Please try again";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crystal Quiz App | Login</title>
    <link rel="stylesheet" type="text/css" href="indexPageStyle.css">
  </head>
  <body >
    <div class="errorDiv">
      <p><?php echo $errorMessage; ?></p>
    </div>
    <form class="" action="" method="post">
      <div id="loginForm">
        <input type="text" name="username" placeholder="Your Username" required>
        <input type="password" name="password" placeholder="Your Password" required>
        <button type="submit" name="login">Login and Take Test</button>
      </div>
    </form>
      <button type="button" id="toggleButton">First Time? Sign Up</button>
    <form class="" action="" method="post">
      <div id="signupForm" style="display: none">
        <input type="text" name="username" placeholder="Your Username" required>
        <input type="password" id="password" name="password" placeholder="Your Password" required>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Your Password Again" required>
        <button type="submit" id="signupButton" name="signup">Sign up and Take Test</button>
      </div>
    </form>

    <script type="text/javascript">
      /* TOGGLE THE DISPLAY OF THE SIGNUP FORM */
      document.getElementById('toggleButton').onclick = function(){
        if (document.getElementById('signupForm').style.display === "none") {
          document.getElementById('signupForm').style.display = "block";
        } else {
          document.getElementById('signupForm').style.display = "none";
        }
      }

      /* CHECK THAT PASSWORDS MATCH FOR SIGNUP */
      document.getElementById("signupButton").onclick = function(event){
        if(document.getElementById('password').value != document.getElementById('confirmPassword').value){
          alert("Please check, your passwords don't match.");
          event.preventDefault();
        }
      }
    </script>
  </body>
</html>
