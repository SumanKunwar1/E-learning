<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Learner Sign Up</title>
  <link rel="stylesheet" href="formstyle.css">
  <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
</head>

<body>

  <?php
  session_start();

  include('./dbConnection.php');


  if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = sha1($_POST['pass']);
    $cpass = $_POST['cpass'];


    # data insertion
    $checkdouble = "SELECT * FROM learner WHERE l_Email ='$email'";
    $result = mysqli_query($conn, $checkdouble);
    $present = mysqli_num_rows($result);
    if ($present > 0) {
      $_SESSION['l-email_alert'] = '1';
      // header("Location: learnerLog.php");
    } else {
      $sql = "INSERT INTO learner(l_Name, l_Email, l_Password)
      VALUES('$name','$email','$pass')";


      if (mysqli_query($conn, $sql)) {
        $_SESSION['record'] = 2;
      }
    }
  }
  ?>

  <div class="container">
    <form action="#" method="POST">
      <div class="top-name">
        <h2>Learner SignUp</h2>
      </div>
      <script>
        if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }
      </script>
      <div class="input-group">
        <label>Name</label>
        <input type="text" placeholder="Enter your name" name="name" id="name" onkeyup="validateName()">
        <span id="error-name"></span>
      </div>

      <div class="input-group">
        <label>Email</label>
        <input type="email" placeholder="Enter Email" name="email" id="email" onkeyup="validateEmail()">
        <span id="error-email"></span>
      </div>


      <div class="input-group">
        <label>Password</label>
        <input type="password" placeholder="Enter password" name="pass" id="pass" onkeyup="validatePass()">
        <span id="error-pass"></span>
      </div>

      <div class="input-group">
        <label>Confirm Password</label>
        <input type="password" placeholder="Enter Confirm password" name="cpass" id="cpass" onkeyup="validatePass()">
        <span id="error-cpass"></span>
      </div>

      <input type="submit" name="submit" id="submit" onclick="return validateForm()" value="Submit">
      <span id="error-submit">
        <?php
        $emailmessage = '';
        if (isset($_SESSION['l-email_alert'])) {
          $emailmessage = 'Email ID already exists';
          echo $emailmessage;
        }
        $record = '';
        if (isset($_SESSION['record'])) {
          $showRecord = 'Record saved successfully';
          echo $showRecord;
        }
        ?>
      </span>

      <div class="new-account">
        <p>Already have account?</p>
        <button id="login-btn" style="border:0;">
          <a href="l-login.php">Log In</a>
        </button>
      </div>
      <div class="back_home" style="margin-top: 10px;">
        <a href="./index.php"><i class="fa-solid fa-house" style="margin-right: 5px;"></i>Back Home</a>
      </div>
    </form>
    <?php unset($_SESSION['l-email_alert']);
    unset($_SESSION['record']);
    ?>
  </div>

  <script src="js\script.js"></script>

</body>

</html>