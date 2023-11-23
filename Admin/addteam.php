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
 if(isset($_REQUEST['teamSubmitBtn'])){
  // Checking for Empty Fields
  if(($_REQUEST['team_name'] == "") || ($_REQUEST['team_position'] == "") || ($_REQUEST['team_fb_link'] == "") || ($_REQUEST['team_tw_link'] == "") || ($_REQUEST['team_li_link'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   // Assigning User Values to Variable
   $team_name = $_REQUEST['team_name'];
   $team_position = $_REQUEST['team_position'];
   $team_fb_link = $_REQUEST['team_fb_link'];
   $team_tw_link = $_REQUEST['team_tw_link'];
   $team_li_link = $_REQUEST['team_li_link'];
   $team_image = $_FILES['team_img']['name']; 
   $team_image_temp = $_FILES['team_img']['tmp_name'];
   $img_folder = '../image/teamimg/'. $_FILES['team_img']['name']; 
   move_uploaded_file($team_image_temp, $img_folder);
    $sql = "INSERT INTO team (team_name,  team_position, team_image, team_fb, team_twitter, team_linkedin) VALUES ('$team_name','$team_position', '$img_folder', '$team_fb_link', '$team_tw_link', '$team_li_link')";
    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Team Member Added Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add Team Member </div>';
    }
  }
  }
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Add New Team Member</h3>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="team_name">Name</label>
      <input type="text" class="form-control" id="team_name" name="team_name">
    </div>
    <div class="form-group">
      <label for="team_position">Position</label>
      <input type="text" class="form-control" id="team_position" name="team_position">
    </div>
    <div class="form-group">
      <label for="team_fb_link">Facebook link</label>
      <input type="text" class="form-control" id="team_fb_link" name="team_fb_link">
    </div>
    <div class="form-group">
      <label for="team_tw_link">Twitter link</label>
      <input type="text" class="form-control" id="team_tw_link" name="team_tw_link">
    </div>
    <div class="form-group">
      <label for="team_li_link">LinkedIn link</label>
      <input type="text" class="form-control" id="team_li_link" name="team_li_link">
    </div>
    <div class="form-group">
      <label for="team_img">Team Member Image</label>
      <input type="file" class="form-control-file" id="team_img" name="team_img">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="teamSubmitBtn" name="teamSubmitBtn">Submit</button>
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