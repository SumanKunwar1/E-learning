<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Feedback');
define('PAGE', 'feedback');
include('./learnerInclude/header.php'); 
include_once('../dbConnection.php');

 if(isset($_SESSION['is_login'])){
  $l_Email = $_SESSION['stuLogEmail'];
 } 
 else if(isset($_SESSION['loggedin'])){
  $l_Email = $_SESSION['email'];
 }
//  else {
//   echo "<script> location.href='../index.php'; </script>";
//  }
// $l_Email = $_SESSION['email'];
 $sql = "SELECT * FROM learner WHERE l_Email='$l_Email'";
 $result = $conn->query($sql);
 if($result->num_rows == 1){
 $row = $result->fetch_assoc();
 $lId = $row["l_Id"];
}

 if(isset($_REQUEST['submitFeedbackBtn'])){
  if(($_REQUEST['f_content'] == "")){
   // msg displayed if required field missing
   $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   $fcontent = htmlspecialchars($_REQUEST["f_content"]);
   $sql = "INSERT INTO feedback (f_content, l_Id) VALUES ('$fcontent', '$lId')";
   if($conn->query($sql) == TRUE){
   // below msg display on form submit success
   $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Submitted Successfully </div>';
   } else {
   // below msg display on form submit failed
   $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Submit </div>';
      }
    }
 }

?>
 <div class="col-sm-6 mt-5">
  <form class="mx-5" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="lId">Learner ID</label>
      <input type="text" class="form-control" id="lId" name="lId" value=" <?php if(isset($lId)) {echo $lId;} ?>" readonly>
    </div>
    <div class="form-group">
      <label for="f_content">Write Feedback:</label>
      <textarea class="form-control" id="f_content" name="f_content" row=2></textarea>
    </div>
    <button type="submit" class="btn btn-primary" name="submitFeedbackBtn">Submit</button>
    <?php if(isset($passmsg)) {echo $passmsg; } ?>
  </form>
 </div>

 </div> <!-- Close Row Div from header file -->

 <?php
include('./learnerInclude/footer.php'); 
?>