<?php
  /* START SESSION */
  session_start();

  if(!$_SESSION['username']){
    redirect('index.php');
  }

  /* CONNECT TO DATABASE */
  include('database-connect.txt');

  if(array_key_exists('submitButton', $_POST)){
    $newScore = $_POST['submitButton'];
    /* UPDATE USERS SCORE IN DATABASE */
    $query = "  UPDATE `users`
                SET `score` = '".$newScore."'
                WHERE `username` = '".$_SESSION['username']."'
    ";
    mysqli_query($link,$query);
  }

  echo "<script>window.close();</script>";

?>
