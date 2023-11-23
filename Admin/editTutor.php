<?php
if (!isset($_SESSION)) {
  session_start();
}

define('TITLE', 'Edit Tutor');
define('PAGE', 'Tutors');
include('./adminInclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
  $adminEmail = $_SESSION['adminLogEmail'];
}
// else {
//   echo "<script> location.href='../index.php'; </script>";
// }

// Update
if (isset($_REQUEST['requpdate'])) {
  // Checking for Empty Fields
  if (($_REQUEST['t_Id'] == "") || ($_REQUEST['t_Name'] == "") || ($_REQUEST['t_Email'] == "") || ($_REQUEST['t_Password'] == "")) {
    // msg displayed if required field missing
    $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
  } else {
    // Assigning User Values to Variable
    $t_id = $_REQUEST['t_Id'];
    $t_name = $_REQUEST['t_Name'];
    $t_email = $_REQUEST['t_Email'];
    $t_pass = sha1($_REQUEST['t_Password']);

    $sql = "UPDATE tutor SET t_Id = '$t_id', t_Name = '$t_name', t_Email = '$t_email', t_Password='$t_pass' WHERE t_Id = '$t_id'";
    if ($conn->query($sql) == TRUE) {
      // below msg display on form submit success
      $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
    } else {
      // below msg display on form submit failed
      $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
    }
  }
}
?>
<div class="col-sm-6 mt-5 mx-3 jumbotrn">
  <h3 class="text-center">Update Tutor Details</h3>
  <?php
  if (isset($_REQUEST['view'])) {
    $sql = "SELECT * FROM tutor WHERE t_Id = {$_REQUEST['id']}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
  }
  ?>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="t_Id">ID</label>
      <input type="text" class="form-control" id="t_Id" name="t_Id" value="<?php if (isset($row['t_Id'])) {
                                                                              echo $row['t_Id'];
                                                                            } ?>" readonly>
    </div>
    <div class="form-group">
      <label for="t_Name">Name</label>
      <input type="text" class="form-control" id="t_Name" name="t_Name" value="<?php if (isset($row['t_Name'])) {
                                                                                echo $row['t_Name'];
                                                                              } ?>">
    </div>

    <div class="form-group">
      <label for="t_Email">Email</label>
      <input type="text" class="form-control" id="t_Email" name="t_Email" value="<?php if (isset($row['t_Email'])) {
                                                                                  echo $row['t_Email'];
                                                                                } ?>">
    </div>

    <div class="form-group">
      <label for="t_Password">Password</label>
      <input type="text" class="form-control" id="t_Password" name="t_Password" value="<?php if (isset($row['t_Password'])) {
                                                                                            echo $row['t_Password'];
                                                                                          } ?>">
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
      <a href="tutors.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if (isset($msg)) {
      echo $msg;
    } ?>
  </form>
</div>
</div> <!-- div Row close from header -->
</div> <!-- div Container-fluid close from header -->

<?php
include('./adminInclude/footer.php');
?>
