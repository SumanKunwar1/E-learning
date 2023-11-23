<?php 
if(!isset($_SESSION)){ 
  session_start(); 
}
include_once('../dbConnection.php');

// setting header type to json, We'll be outputting a Json data
header('Content-type: application/json');

// Checking Email already Registered
if(isset($_POST['t_email']) && isset($_POST['checkemail'])){
  $t_email = $_POST['t_email'];
  $sql = "SELECT t_Email FROM tutor WHERE t_Email='".$t_email."'";
  $result = $conn->query($sql);
  $row = $result->num_rows;
  echo json_encode($row);
  }
 
  // Inserting or Adding New learner
  if(isset($_POST['t_signup']) && isset($_POST['t_name']) && isset($_POST['t_email']) && isset($_POST['t_pass'])){
    $t_name = $_POST['t_name'];
    $t_email = $_POST['t_email'];
    $t_pass = $_POST['t_pass'];
    $sql = "INSERT INTO tutor(t_Name, t_Email, t_Password) VALUES ('$t_name', '$t_email', '$t_pass')";
    if($conn->query($sql) == TRUE){
      echo json_encode("OK");
    } else {
      echo json_encode("Failed");
    }
  }

  // learner Login Verification
  if(!isset($_SESSION['is_login'])){
    if(isset($_POST['checkLogemail']) && isset($_POST['tutorLogEmail']) && isset($_POST['tutorLogPass'])){
      $tutorLogEmail = $_POST['tutorLogEmail'];
      $tutorLogPass = $_POST['tutorLogPass'];
      $sql = "SELECT t_Email, t_Password FROM tutor WHERE t_Email='".$tutorLogEmail."' AND t_Password='".$tutorLogPass."'";
      $result = $conn->query($sql);
      $row = $result->num_rows;
      
      if($row === 1){
        $_SESSION['is_login'] = true;
        $_SESSION['tutorLogEmail'] = $tutorLogEmail;
        echo json_encode($row);
      } else if($row === 0) {
        echo json_encode($row);
      }
    }
  }

?>