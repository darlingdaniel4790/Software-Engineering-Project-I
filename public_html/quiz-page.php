<?php
  /* START SESSION */
  session_start();

  /* FUNCTION TO REDIRECT USER */
  function redirect($page) {
    header('Location: ' . $page);
    exit;
  }

  if(!$_SESSION['username']){
    redirect('index.php');
  }

  if(array_key_exists('logoutButton', $_POST)){
    session_unset();
    session_destroy();
    redirect('index.php');
  }

  /* CONNECT TO DATABASE */
  include('database-connect.txt');

  /* RETRIEVE QUESTIONS FROM DATABASE */
  $count = 1;
  $allQuestions = [];
  $query = "  SELECT *
              FROM `questions`
              ORDER BY RAND()
  ";
  if($result = mysqli_query($link,$query)){
    while($row = mysqli_fetch_array($result)){
      $name = "q$count";
      $$name = $row;  // STORE THE QUESTIONS AND ANSWERS IN THEIR SEPERATE ARRAYS
      $allQuestions[] = $row;  // STORE THE QUESTIONS FOR THE CURRENT SESSTION
      $count++;
    }
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crystal Quiz App | Quiz Page</title>
  </head>
  <body>
    <form class="" action="" method="post">
      <button type="submit" name="logoutButton">Click Here to Log Out</button>
    </form>
    <h2>Welcome <?php echo "$_SESSION[username]"; ?></h2>   <!-- PERSONALIZED WELCOME MESSAGE -->
    <p>This is a quiz to test your knowledge of English Language.</p>

    <form class="" action="" method="post">
      <div id="Q1" class="questions">
        <p>1. <?php echo "$q1[question]";  ?></p>
        <input type="radio" name="Q1" value="<?php echo "$q1[option1]"; ?>"><?php echo "$q1[option1]"; ?>
        <input type="radio" name="Q1" value="<?php echo "$q1[option2]"; ?>"><?php echo "$q1[option2]"; ?>
        <input type="radio" name="Q1" value="<?php echo "$q1[option3]"; ?>"><?php echo "$q1[option3]"; ?>
        <input type="radio" name="Q1" value="<?php echo "$q1[option4]"; ?>"><?php echo "$q1[option4]"; ?>
      </div>

      <div id="Q2" class="questions">
        <p>2. <?php echo "$q2[question]";  ?></p>
        <input type="radio" name="Q2"value="<?php echo "$q2[option1]"; ?>"><?php echo "$q2[option1]"; ?>
        <input type="radio" name="Q2"value="<?php echo "$q2[option2]"; ?>"><?php echo "$q2[option2]"; ?>
        <input type="radio" name="Q2"value="<?php echo "$q2[option3]"; ?>"><?php echo "$q2[option3]"; ?>
        <input type="radio" name="Q2"value="<?php echo "$q2[option4]"; ?>"><?php echo "$q2[option4]"; ?>
      </div>

      <div id="Q3" class="questions">
        <p>3. <?php echo "$q3[question]";  ?></p>
        <input type="radio" name="Q3" value="<?php echo "$q3[option1]"; ?>"><?php echo "$q3[option1]"; ?>
        <input type="radio" name="Q3" value="<?php echo "$q3[option2]"; ?>"><?php echo "$q3[option2]"; ?>
        <input type="radio" name="Q3" value="<?php echo "$q3[option3]"; ?>"><?php echo "$q3[option3]"; ?>
        <input type="radio" name="Q3" value="<?php echo "$q3[option4]"; ?>"><?php echo "$q3[option4]"; ?>
      </div>

      <div id="Q4" class="questions">
        <p>4. <?php echo "$q4[question]";  ?></p>
        <input type="radio" name="Q4" value="<?php echo "$q4[option1]"; ?>"><?php echo "$q4[option1]"; ?>
        <input type="radio" name="Q4" value="<?php echo "$q4[option2]"; ?>"><?php echo "$q4[option2]"; ?>
        <input type="radio" name="Q4" value="<?php echo "$q4[option3]"; ?>"><?php echo "$q4[option3]"; ?>
        <input type="radio" name="Q4" value="<?php echo "$q4[option4]"; ?>"><?php echo "$q4[option4]"; ?>
      </div>

      <div id="Q5" class="questions">
        <p>5. <?php echo "$q5[question]";  ?></p>
        <input type="radio" name="Q5" value="<?php echo "$q5[option1]"; ?>"><?php echo "$q5[option1]"; ?>
        <input type="radio" name="Q5" value="<?php echo "$q5[option2]"; ?>"><?php echo "$q5[option2]"; ?>
        <input type="radio" name="Q5" value="<?php echo "$q5[option3]"; ?>"><?php echo "$q5[option3]"; ?>
        <input type="radio" name="Q5" value="<?php echo "$q5[option4]"; ?>"><?php echo "$q5[option4]"; ?>
      </div>

      <div id="Q6" class="questions">
        <p>6. <?php echo "$q6[question]";  ?></p>
        <input type="radio" name="Q6"value="<?php echo "$q6[option1]"; ?>"><?php echo "$q6[option1]"; ?>
        <input type="radio" name="Q6"value="<?php echo "$q6[option2]"; ?>"><?php echo "$q6[option2]"; ?>
        <input type="radio" name="Q6"value="<?php echo "$q6[option3]"; ?>"><?php echo "$q6[option3]"; ?>
        <input type="radio" name="Q6"value="<?php echo "$q6[option4]"; ?>"><?php echo "$q6[option4]"; ?>
      </div>

      <div id="Q7" class="questions">
        <p>7. <?php echo "$q7[question]";  ?></p>
        <input type="radio" name="Q7" value="<?php echo "$q7[option1]"; ?>"><?php echo "$q7[option1]"; ?>
        <input type="radio" name="Q7" value="<?php echo "$q7[option2]"; ?>"><?php echo "$q7[option2]"; ?>
        <input type="radio" name="Q7" value="<?php echo "$q7[option3]"; ?>"><?php echo "$q7[option3]"; ?>
        <input type="radio" name="Q7" value="<?php echo "$q7[option4]"; ?>"><?php echo "$q7[option4]"; ?>
      </div>

      <div id="Q8" class="questions">
        <p>8. <?php echo "$q8[question]";  ?></p>
        <input type="radio" name="Q8" value="<?php echo "$q8[option1]"; ?>"><?php echo "$q8[option1]"; ?>
        <input type="radio" name="Q8" value="<?php echo "$q8[option2]"; ?>"><?php echo "$q8[option2]"; ?>
        <input type="radio" name="Q8" value="<?php echo "$q8[option3]"; ?>"><?php echo "$q8[option3]"; ?>
        <input type="radio" name="Q8" value="<?php echo "$q8[option4]"; ?>"><?php echo "$q8[option4]"; ?>
      </div>

      <div id="Q9" class="questions">
        <p>9. <?php echo "$q9[question]";  ?></p>
        <input type="radio" name="Q9" value="<?php echo "$q9[option1]"; ?>"><?php echo "$q9[option1]"; ?>
        <input type="radio" name="Q9" value="<?php echo "$q9[option2]"; ?>"><?php echo "$q9[option2]"; ?>
        <input type="radio" name="Q9" value="<?php echo "$q9[option3]"; ?>"><?php echo "$q9[option3]"; ?>
        <input type="radio" name="Q9" value="<?php echo "$q9[option4]"; ?>"><?php echo "$q9[option4]"; ?>
      </div>

      <div id="Q10" class="questions">
        <p>10. <?php echo "$q10[question]";  ?></p>
        <input type="radio" name="Q10" value="<?php echo "$q10[option1]"; ?>"><?php echo "$q10[option1]"; ?>
        <input type="radio" name="Q10" value="<?php echo "$q10[option2]"; ?>"><?php echo "$q10[option2]"; ?>
        <input type="radio" name="Q10" value="<?php echo "$q10[option3]"; ?>"><?php echo "$q10[option3]"; ?>
        <input type="radio" name="Q10" value="<?php echo "$q10[option4]"; ?>"><?php echo "$q10[option4]"; ?>
      </div>

      <br><button id="submitButton" type="button" name="button">Submit Answers</button>
    </form>
    <div class="">
      <h3>Your Score:</h3>
      <p id="score"></p>
    </div>
    <script type="text/javascript">
    function checkAnswer(answer,question){
      var q = (document.getElementsByName(question));
      for(var i=0; i<q.length; i++){
        if(q[i].checked){
          if(q[i].value == answer){
            //correct answer
            return true;
          } else {
            //wrong answer
            return false;
          }
        }
      }
      if(i==q.length){
        //no selection made => wrong answer
        return false;
      }
    }


    document.getElementById('submitButton').onclick = function(){
      //variable for keeping student score
      var totalScore = 0;
      if(checkAnswer('<?php echo "$q1[answer]"; ?>', "Q1")){
        document.getElementById("Q1").style.backgroundColor = "green";
        totalScore+=1;
      } else{
        document.getElementById("Q1").style.backgroundColor = "red";
      }
      if(checkAnswer('<?php echo "$q2[answer]"; ?>', "Q2")){
        document.getElementById("Q2").style.backgroundColor = "green";
        totalScore+=1;
      } else{
        document.getElementById("Q2").style.backgroundColor = "red";
      }
      if(checkAnswer('<?php echo "$q3[answer]"; ?>', "Q3")){
        document.getElementById("Q3").style.backgroundColor = "green";
        totalScore+=1;
      } else{
        document.getElementById("Q3").style.backgroundColor = "red";
      }
      if(checkAnswer('<?php echo "$q4[answer]"; ?>', "Q4")){
        document.getElementById("Q4").style.backgroundColor = "green";
        totalScore+=1;
      } else{
        document.getElementById("Q4").style.backgroundColor = "red";
      }
      if(checkAnswer('<?php echo "$q5[answer]"; ?>', "Q5")){
        document.getElementById("Q5").style.backgroundColor = "green";
        totalScore+=1;
      } else{
        document.getElementById("Q5").style.backgroundColor = "red";
      }
      if(checkAnswer('<?php echo "$q6[answer]"; ?>', "Q6")){
        document.getElementById("Q6").style.backgroundColor = "green";
        totalScore+=1;
      } else{
        document.getElementById("Q6").style.backgroundColor = "red";
      }
      if(checkAnswer('<?php echo "$q7[answer]"; ?>', "Q7")){
        document.getElementById("Q7").style.backgroundColor = "green";
        totalScore+=1;
      } else{
        document.getElementById("Q7").style.backgroundColor = "red";
      }
      if(checkAnswer('<?php echo "$q8[answer]"; ?>', "Q8")){
        document.getElementById("Q8").style.backgroundColor = "green";
        totalScore+=1;
      } else{
        document.getElementById("Q8").style.backgroundColor = "red";
      }
      if(checkAnswer('<?php echo "$q9[answer]"; ?>', "Q9")){
        document.getElementById("Q9").style.backgroundColor = "green";
        totalScore+=1;
      } else{
        document.getElementById("Q9").style.backgroundColor = "red";
      }
      if(checkAnswer('<?php echo "$q10[answer]"; ?>', "Q10")){
        document.getElementById("Q10").style.backgroundColor = "green";
        totalScore+=1;
      } else{
        document.getElementById("Q10").style.backgroundColor = "red";
      }

      var percent = (totalScore*100)/10;

      document.getElementById("score").innerHTML = "Your score is "+String(percent)+"%.";


    }
    </script>
    </body>
</html>
