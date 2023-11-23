<?php
if (!isset($_SESSION)) {
  session_start();
}
define('TITLE', 'Learner Profile');
define('PAGE', 'profile');
include('./learnerInclude/header.php');
include_once('../dbConnection.php');

if(isset($_SESSION['is_login'])){
  $stuLogEmail = $_SESSION['stuLogEmail'];
}
if(isset($_SESSION['loggedin'])){
  $stuLogEmail = $_SESSION['email'];
}
if(isset($stuLogEmail)){
  $sql = "SELECT * FROM learner WHERE l_Email='$stuLogEmail'";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $lId = $row["l_Id"];
    $l_Name = $row["l_Name"];
    $l_Occ = $row["l_occ"];
    $l_Img = $row["l_img"];
  }
}


//  else {
//   echo "<script> location.href='../index.php'; </script>";
//  }

if (isset($_REQUEST['updatel_NameBtn'])) {
  if (($_REQUEST['l_Name'] == "")) {
    // msg displayed if required field missing
    $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
    $l_Name = $_REQUEST["l_Name"];
    $l_Occ = $_REQUEST["l_Occ"];
    $l_image = $_FILES['l_Img']['name'];
    $l_image_temp = $_FILES['l_Img']['tmp_name'];
    $img_folder = '../image/stu/' . $l_image;
    move_uploaded_file($l_image_temp, $img_folder);
    $sql = "UPDATE learner SET l_Name = '$l_Name', l_occ = '$l_Occ', l_img = '$img_folder' WHERE l_Email = '$stuLogEmail'";
    if ($conn->query($sql) == TRUE) {
      // below msg display on form submit success
      $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
    } else {
      // below msg display on form submit failed
      $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
    }
  }
}

?>
<div class="col-sm-6 mt-5">
  <form class="mx-5" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="lId">learner ID</label>
      <input type="text" class="form-control" id="lId" name="lId" value=" <?php if (isset($lId)) {
                                                                            echo $lId;
                                                                          } ?>" readonly>
    </div>
    <div class="form-group">
      <label for="l_Email">Email</label>
      <input type="email" class="form-control" id="l_Email" value=" <?php echo $stuLogEmail ?>" readonly>
    </div>
    <div class="form-group">
      <label for="l_Name">Name</label>
      <input type="text" class="form-control" id="l_Name" name="l_Name" value=" <?php if (isset($l_Name)) {
                                                                                  echo $l_Name;
                                                                                } ?>">
    </div>
    <div class="form-group">
      <!-- learner doesnt mean school learner it also means learner -->
      <label for="l_Occ">Occupation</label>
      <input type="text" class="form-control" id="l_Occ" name="l_Occ" value=" <?php if (isset($l_Occ)) {
                                                                                echo $l_Occ;
                                                                              } ?>">
    </div>
    <div class="form-group">
      <label for="l_Img">Upload Image</label>
      <input type="file" class="form-control-file" id="l_Img" name="l_Img">
    </div>
    <button type="submit" class="btn btn-primary" name="updatel_NameBtn">Update</button>
    <?php if (isset($passmsg)) {
      echo $passmsg;
    } ?>
  </form>
</div>

</div> <!-- Close Row Div from header file -->

<?php
include('./learnerInclude/footer.php');
?>