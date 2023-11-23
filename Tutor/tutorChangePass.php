<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Change Password');
define('PAGE', 'TutorChangePass');
include('./tutorInclude/header.php'); 
include_once('../dbConnection.php');

 if(isset($_SESSION['is_login'])){
  $t_Email = $_SESSION['tutorLogEmail'];
 }
//  else {
//   echo "<script> location.href='../index.php'; </script>";
//  }
$t_Email = $_SESSION['email'];
 if(isset($_REQUEST['t_PassUpdateBtn'])){
  if(($_REQUEST['t_NewPass'] == "")){
   // msg displayed if required field missing
   $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
    $sql = "SELECT * FROM tutor WHERE t_Email='$t_Email'";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
     $t_Pass = sha1($_REQUEST['t_NewPass']);
     $sql = "UPDATE tutor SET t_Password = '$t_Pass' WHERE t_Email = '$t_Email'";
      if($conn->query($sql) == TRUE){
       // below msg display on form submit success
       $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
      } else {
       // below msg display on form submit failed
       $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
      }
    }
   }
}

?>

<div class="col-sm-9 col-md-10">
  <div class="row">
    <div class="col-sm-6">
      <form class="mt-5 mx-5" method="POST">
        <div class="form-group">
          <label for="inputEmail">Email</label>
          <input type="email" class="form-control" id="inputEmail" value=" <?php echo $t_Email ?>" readonly>
        </div>
        <div class="form-group">
          <label for="inputnewpassword">New Password</label>
          <input type="password" class="form-control" id="inputnewpassword" placeholder="New Password" name="t_NewPass">
        </div>
        <button type="submit" class="btn btn-primary mr-4 mt-4" name="t_PassUpdateBtn">Update</button>
        <button type="reset" class="btn btn-secondary mt-4">Reset</button>
        <?php if(isset($passmsg)) {echo $passmsg; } ?>
      </form>

    </div>

  </div>
</div>

 </div> <!-- Close Row Div from header file -->

<?php
include('./tutorInclude/footer.php'); 
?>