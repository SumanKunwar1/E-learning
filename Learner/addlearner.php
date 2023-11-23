<?php 
if(!isset($_SESSION)){ 
  session_start(); 
}
include_once('../dbConnection.php');

// setting header type to json, We'll be outputting a Json data
header('Content-type: application/json');

// Checking Email already Registered
if(isset($_POST['lemail']) && isset($_POST['checkemail'])){
  $lemail = $_POST['lemail'];
  $sql = "SELECT l_Email FROM learner WHERE l_Email='".$lemail."'";
  $result = $conn->query($sql);
  $row = $result->num_rows;
  echo json_encode($row);
  }
 
  // Inserting or Adding New learner
  if(isset($_POST['lsignup']) && isset($_POST['lname']) && isset($_POST['lemail']) && isset($_POST['lpass'])){
    $lname = $_POST['lname'];
    $lemail = $_POST['lemail'];
    $lpass = sha1($_POST['lpass']);
    $sql = "INSERT INTO learner(l_Name, l_Email, l_Password) VALUES ('$lname', '$lemail', '$lpass')";
    if($conn->query($sql) == TRUE){
      echo json_encode("OK");
    } else {
      echo json_encode("Failed");
    }
  }

  // learner Login Verification
  if(!isset($_SESSION['is_login'])){
    if(isset($_POST['checkLogemail']) && isset($_POST['stuLogEmail']) && isset($_POST['stuLogPass'])){
      $lLogEmail = $_POST['stuLogEmail'];
      $lLogPass = sha1($_POST['stuLogPass']);
      $sql = "SELECT l_Email, l_Password FROM learner WHERE l_Email='".$lLogEmail."' AND l_Password='".$lLogPass."'";
      $result = $conn->query($sql);
      $row = $result->num_rows;
      
      if($row === 1){
        $_SESSION['is_login'] = true;
        $_SESSION['stuLogEmail'] = $lLogEmail;
        echo json_encode($row);
      } else if($row === 0) {
        echo json_encode($row);
      }
    }
  }

?>