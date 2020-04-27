<?php
  /* START SESSION */
  session_start();

  /* CONNECT TO DATABASE */
  include('database-connect.txt');

  /* RETRIEVE QUESTIONS FROM DATABASE */
  $count = 1;
  $query = "  SELECT *
              FROM `questions`
              ORDER BY RAND()
  ";
  if($result = mysqli_query($link,$query)){
    while($row = mysqli_fetch_array($result)){
      $name = "q$count";
      $$name = $row;  // STORE THE QUESTIONS AND ANSWERS IN THEIR SEPERATE ARRAYS
      $_SESSION['questions'] = $row;  // STORE THE QUESTIONS FOR THE CURRENT SESSTION
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
    <link rel="stylesheet" type="text/css" href="indexPageStyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Open+Sans:wght@800&display=swap" rel="stylesheet">
  </head>
  </head>
  <body>
    <button type="submit" name="logoutButton">Click Here to Log Out</button>
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

    </body>
</html>
