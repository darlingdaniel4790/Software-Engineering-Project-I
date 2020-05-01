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

  /* RETRIEVE USER SCORE FROM DATABASE */
  $query = "  SELECT `score`
              FROM `users`
              WHERE `username` = '".$_SESSION['username']."'
  ";
  if($result = mysqli_query($link,$query)){
    $row = mysqli_fetch_array($result);
    $score = $row['score'];
  }

  /* RETRIEVE USER TRIES FROM DATABASE */
  $query = "  SELECT `tries`
              FROM `users`
              WHERE `username` = '".$_SESSION['username']."'
  ";
  if($result = mysqli_query($link,$query)){
    $row = mysqli_fetch_array($result);
    $tries = $row['tries'];
  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Crystal Quiz App | Quiz Page</title>
    <style media="screen">
      body{
        background-image: url("images/backg.jpg");
      }
      /* STYLING FOR QUESTIONS DIVS */
      .questions{
        margin-top: 15px;
      }
      /* CUSTOM STYLING FOR JUMBOTRON */
      .custom{
        padding-top: 10px;
        padding-left: 10px;
        background-image: url("images/room.jpeg");
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
      }
      /* STYLING FOR COUNTDOWN TIMER */
      .timer{
        color: white;
        font-weight: bold;
        text-align: center;
        width: 110px;
        position: fixed;
        right: 15px;
        top: 15px;
        z-index: 1;
        background-color: #28a745;
      }
      .shadow{
        color: #dc3545;
        background-color: #d1ecf1;
        border-color: #bee5eb;
        border-radius: .25rem;
        display: block;
        margin: 0 auto;
        width: 100%;
        font-weight: bold;
        font-family: "Arial", san-serif;
        text-align: center;
        text-transform: uppercase;
        text-shadow: 2px 2px #333;

      }


    </style>
  </head>
  <body>
    <div  class="jumbotron jumbotron-fluid custom" id="page" style="margin-bottom: 0px;height: 100%;">
      <form class="" action="" method="post" style="background: rgba(0, 0, 0, 0.5); width:20%;display:flex;">
        <button class="btn btn-info" type="submit" name="logoutButton">Log Out</button>
        <span style="color:yellow;font-weight: bold;text-shadow: black 0px 0px 10px;padding: 5px 5px;">Logged in as <span style="color: white;font-weight: bold;"><?php echo "$_SESSION[username]"; ?></span>.</span>
      </form>
      <div id="jumbo" class="container" style="height: 100%;">
        <br><br>
        <div id="headerDiv" class="">
          <h1 class="shadow">Welcome to Your Quiz Area</h1>
          <br>
          <h5 style="display: block; text-align: center; margin: 0 auto; color: yellow; background: rgba(0, 0, 0, 0.5);letter-spacing: 3px; padding: 20px;text-shadow: black 0px 0px 10px;

          ">The questions will be provided to you once you click on the 'Start Quiz' button. <br>The questions you get will be determined in a random fashion, and your answers will also be shuffled. <br>After your quiz, your score will be displayed, and you will be shown the answers for every question for your review.
          <br><br>
          This particular quiz is to test your knowledge of English Language at an intermediate level. There are <span class="text-danger">10 questions</span> in this quiz. Each of which carries <span class="text-danger">10points</span>.<br>You have precisely <span class="text-danger">ten(10) minutes</span> for this quiz. Click the button when you are ready!</h5>
          <br>
          <p class="alert alert-info" role="alert">
            <?php
            if($tries>1){
              echo "You have taken this test <span class='alert-link'>$tries times</span>, your last score was <span class='alert-link'>$score%</span>.<br>";
            } else if($tries==1){
              echo "This is your <span class='alert-link'>second attempt</span> at this test. Your last score was <span class='alert-link'>$score%</span>.<br>";
            }
            ?>
          </p>
          <br>
          <button class="btn btn-success" id="startButton" type="button">Start Quiz</button>
        </div>
        <div id="resultsDiv" class="" style="display: none;background: rgba(0, 0, 0, 0.4);padding:5px;border-radius: 3px;">
          <h3 style="color:white;font-weight: bold;text-shadow: 2px 2px #FF0000;text-align: center;">All Done!</h3>
          <p id="score" style="display: block; text-align: center; margin: 0 auto; color: yellow;letter-spacing: 3px; padding: 20px;font-weight: bold; text-transform: uppercase;text-shadow: black 0px 0px 10px">
          </p>
          <form id="tryAgainDiv" class="" action="" method="post" target="_self" style="display: none">
            <button class="btn btn-info" type="submit" name="button">Try Again?</button>
          </form>
        </div>
      </div>
    </div>
    <div id="questionsDiv" class="container" style="display: none">
      <p id="timerParagraph"class="rounded-lg float-right timer" style="display: none">Time Left:<br><span id="timer"></span></p>
      <form id="questionForm" class="" action="db-score-update.php" method="post" target="_blank">
        <?php
          /* RETRIEVE QUESTIONS FROM DATABASE */
          $count = 1;
          $allQuestions = [];
          $query = "  SELECT *
          FROM `questions`
          ORDER BY RAND()
          LIMIT 10;
          ";
          if($result = mysqli_query($link,$query)){
            while($row = mysqli_fetch_array($result)){
              $optionControl = range(2,5);
              shuffle($optionControl);
              $name = "q$count";
              $$name = $row;
              $allAnswers[] = $row['answer'];
              echo '
              <div class="questions alert alert-secondary" id="Q'.$count.'">
                '.$count.'. '.$row['question'].'
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="Q'.$count.'" value="'.$row[$optionControl[0]].'">
                  <label class="form-check-label">
                    A) '.$row[$optionControl[0]].'
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="Q'.$count.'" value="'.$row[$optionControl[1]].'">
                  <label class="form-check-label">
                    B) '.$row[$optionControl[1]].'
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="Q'.$count.'" value="'.$row[$optionControl[2]].'">
                  <label class="form-check-label">
                    C) '.$row[$optionControl[2]].'
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="Q'.$count.'" value="'.$row[$optionControl[3]].'">
                  <label class="form-check-label">
                    D) '.$row[$optionControl[3]].'
                  </label>
                </div>
              </div>
              ';
              $count++;
            }
          }
        ?>
        <br>
        <button class="btn btn-primary"id="submitButton" type="submit" name="submitButton" style="display: block">Submit Answers</button>
      </form>
      <br><br>
    </div>

    <!-- BOOTSTRAP, JQUERY, POPPER -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- CUSTOM JAVASCRIPT -->
    <script type="text/javascript">
    /* START COUNTDOWN TIMER */
    document.getElementById('startButton').onclick = function(){
      this.style.display = 'none';
      document.getElementById('jumbo').style.display = 'none';
      document.getElementById('questionsDiv').style.display = 'block';
      document.getElementById('timerParagraph').style.display = 'block';

      // Countdown set to 10 minutes for quiz
      var countDownDate = new Date().getTime() + (1000*60*10);

      // Update the count down every 1 second
      var x = setInterval(function() {

        var now = new Date().getTime();

        var distance = countDownDate - now;

        // Calculate minutes and seconds
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display timer
        document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";

        // If time is at 3 minutes, turn timer red
        if (minutes < 3) {
          document.getElementById("timer").style.color = "red";
        }
        // Time up!
        if (distance < 0) {
          clearInterval(x);
          document.getElementById("timer").innerHTML = "TIME'S UP!";
          // Automatically click the submit button
          if(document.getElementById('submitButton').style.display == "block"){
            document.getElementById('submitButton').click();
          }
        }
      }, 1000);
    }

    /* FUNCTION FOR OFFSETTING LABEL */
    function labelOffset(question){
      if(question == "Q1"){
        return 0;
      }
      if(question == "Q2"){
        return 4;
      }
      if(question == "Q3"){
        return 8;
      }
      if(question == "Q4"){
        return 12;
      }
      if(question == "Q5"){
        return 16;
      }
      if(question == "Q6"){
        return 20;
      }
      if(question == "Q7"){
        return 24;
      }
      if(question == "Q8"){
        return 28;
      }
      if(question == "Q9"){
        return 32;
      }
      if(question == "Q10"){
        return 36;
      }
    }

    /* FUNCTION FOR CHECKING ANSWERS */
    function checkAnswer(answer,question){
      var label = document.getElementsByTagName('label');
      var offset = labelOffset(question);
      var q = (document.getElementsByName(question));
      for(var i=0; i<q.length; i++){
        if(q[i].checked){
          if(q[i].value == answer){
            label[i+offset].innerHTML += ' &#10004';
            // correct answer
            return true;
          }
        } else if(q[i].value == answer){
          label[i+offset].innerHTML += ' &#10004';
          // wrong answer
          return false;
        }
      }
    }
    /* CHECKING THE QUESTIONS ONE AFTER THE OTHER */
    document.getElementById('submitButton').onclick = function(){
      // variable for keeping student score
      var totalScore = 0;

      // copy all answers from php into javascript
      var allAnswers = [<?php foreach ($allAnswers as $value) { echo ('"'."$value".'",'); } ?>];

      for(var i=1; i<=allAnswers.length; i++){
        if(checkAnswer(allAnswers[i-1], "Q"+String(i))) {
          document.getElementById('Q'+String(i)).classList.add("alert-success");
          totalScore += 1;
        } else{
          document.getElementById('Q'+String(i)).classList.add("alert-danger");
        }
      }

      var percent = (totalScore*100)/10;

      this.value = percent;

      document.getElementById("score").innerHTML += "Your score for this test is <span class='alert-link'>"+String(percent)+"%</span>. You can review your answers below, try again, or Logout. Your score has been updated.";

      window.scrollTo(0,0);

      document.getElementById('jumbo').style.display = 'block';

      document.getElementById("resultsDiv").style.display = "block";

      document.getElementById("tryAgainDiv").style.display = "block";

      document.getElementById('timerParagraph').style.display = 'none';

      document.getElementById("submitButton").style.display = "none";

      document.getElementById("headerDiv").style.display = "none";

    }
    </script>
    </body>
</html>
