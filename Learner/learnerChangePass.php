<?php
if (!isset($_SESSION)) {
  session_start();
}
define('TITLE', 'Change Password');
define('PAGE', 'LearnerChangePass');
include('./learnerInclude/header.php');
include_once('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
  $l_Email = $_SESSION['stuLogEmail'];
} else if (isset($_SESSION['loggedin'])) {
  $l_Email = $_SESSION['email'];
} else {
  echo "<script> location.href='../index.php'; </script>";
}

if (isset($_REQUEST['lPassUpdateBtn'])) {
  if (($_REQUEST['lNewPass'] == "")) {
    // msg displayed if required field missing
    $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
    $sql = "SELECT * FROM learner WHERE l_Email='$l_Email'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
      $lPass = sha1($_REQUEST['lNewPass']);
      $sql = "UPDATE learner SET l_Password = '$lPass' WHERE l_Email = '$l_Email'";
      if ($conn->query($sql) == TRUE) {
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
          <input type="email" class="form-control" id="inputEmail" value=" <?php echo $l_Email ?>" readonly>
        </div>
        <div class="form-group">
          <label for="inputnewpassword">New Password</label>
          <input type="password" class="form-control" id="inputnewpassword" placeholder="New Password" name="lNewPass">
        </div>
        <button type="submit" class="btn btn-primary mr-4 mt-4" name="lPassUpdateBtn">Update</button>
        <button type="reset" class="btn btn-secondary mt-4">Reset</button>
        <?php if (isset($passmsg)) {
          echo $passmsg;
        } ?>
      </form>

    </div>

  </div>
</div>

</div> <!-- Close Row Div from header file -->

<?php
include('./learnerInclude/footer.php');
?>