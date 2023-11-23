<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Add Teams');
define('PAGE', 'teams');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 }
  // else {
//   echo "<script> location.href='../index.php'; </script>";
//  }
 if(isset($_REQUEST['requpdate'])){
  // Checking for Empty Fields
  if(($_REQUEST['team_name'] == "") || ($_REQUEST['team_position'] == "") || ($_REQUEST['team_fb_link'] == "") || ($_REQUEST['team_tw_link'] == "") || ($_REQUEST['team_li_link'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   // Assigning User Values to Variable
   $team_id = $_REQUEST['team_id'];
   $team_name = $_REQUEST['team_name'];
   $team_position = $_REQUEST['team_position'];
   $team_fb_link = $_REQUEST['team_fb_link'];
   $team_tw_link = $_REQUEST['team_tw_link'];
   $team_li_link = $_REQUEST['team_li_link'];
   // Check if a new image file is selected
if ($_FILES['team_img']['size'] > 0) {
  $team_image = $_FILES['team_img']['name'];
  $team_image_temp = $_FILES['team_img']['tmp_name'];
  $img_folder = '../image/teamimg/' . $team_image;

  // Set the maximum file size (in bytes)
  $max_file_size = 20 * 1024 * 1024; // 2MB

  // Check if the file size exceeds the maximum limit
  if ($_FILES['team_img']['size'] > $max_file_size) {
    $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Maximum file size exceeded. Please select a smaller file.</div>';
  } else {
    // Move uploaded image file to the desired folder
    move_uploaded_file($team_image_temp, $img_folder);

    // Update the team record with the new image file
    $sql = "UPDATE team SET team_name = '$team_name', team_position='$team_position', team_fb='$team_fb_link', team_twitter='$team_tw_link', team_linkedin ='$team_li_link', team_image='$img_folder' WHERE team_id = '$team_id'";

    if ($conn->query($sql) == TRUE) {
      // Success message
      $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Updated Successfully</div>';
    } else {
      // Error message for database update failure
      $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Update</div>';
    }
  }
} else {
  // Update the team record without modifying the image file
  $sql = "UPDATE team SET team_name = '$team_name', team_position='$team_position', team_fb='$team_fb_link', team_twitter='$team_tw_link', team_linkedin ='$team_li_link' WHERE team_id = '$team_id'";

  if ($conn->query($sql) == TRUE) {
    // Success message
    $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Updated Successfully</div>';
  } else {
    // Error message for database update failure
    $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Update</div>';
  }
}

  }
  }
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Update Team Members Details</h3>
  <?php
 if(isset($_REQUEST['view'])){
  $sql = "SELECT * FROM team WHERE team_id = {$_REQUEST['id']}";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 }
 ?>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="team_id">Team ID</label>
      <input type="text" class="form-control" id="team_id" name="team_id" value="<?php if(isset($row['team_id'])) {echo $row['team_id']; }?>" readonly>
    </div>
    <div class="form-group">
      <label for="team_name">Name</label>
      <input type="text" class="form-control" id="team_name" name="team_name" value="<?php if(isset($row['team_name'])) {echo $row['team_name']; }?>">
    </div>
    <div class="form-group">
      <label for="team_position">Position</label>
      <input type="text" class="form-control" id="team_position" name="team_position" value="<?php if(isset($row['team_position'])) {echo $row['team_position']; }?>">
    </div>
    <div class="form-group">
      <label for="team_fb_link">Facebook Link</label>
      <input type="text" class="form-control" id="team_fb_link" name="team_fb_link" value="<?php if(isset($row['team_fb'])) {echo $row['team_fb']; }?>">
    </div>
    <div class="form-group">
      <label for="team_tw_link">Twitter Link</label>
      <input type="text" class="form-control" id="team_tw_link" name="team_tw_link"  value="<?php if(isset($row['team_twitter'])) {echo $row['team_twitter']; }?>">
    </div>
    <div class="form-group">
      <label for="team_li_link">LinkedIn Link</label>
      <input type="text" class="form-control" id="team_li_link" name="team_li_link"  value="<?php if(isset($row['team_linkedin'])) {echo $row['team_linkedin']; }?>">
    </div>
    <div class="form-group">
      <label for="team_img">Team Member Image</label>
      <img src="<?php if(isset($row['team_img'])) {echo $row['team_image']; }?>" alt="teamimage" class="img-thumbnail">     
      <input type="file" class="form-control-file" id="team_img" name="team_img">
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
      <a href="teams.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
</div>  <!-- div Row close from header -->
</div>  <!-- div Conatiner-fluid close from header -->

<?php
include('./adminInclude/footer.php'); 
?>