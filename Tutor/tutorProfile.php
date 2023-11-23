<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Tutor Profile');
define('PAGE', 'profile');
include('./tutorInclude/header.php'); 
include_once('../dbConnection.php');

 if(isset($_SESSION['is_login'])){
  $t_Email = $_SESSION['tutorLogEmail'];
 }
//  else {
//   echo "<script> location.href='../index.php'; </script>";
//  }
$t_Email = $_SESSION['email'];
 $sql = "SELECT * FROM tutor WHERE t_Email='$t_Email'";
 $result = $conn->query($sql);
 if($result->num_rows == 1){
 $row = $result->fetch_assoc();
 $t_Id = $row["t_Id"];
 $t_Name = $row["t_Name"]; 
 $t_Img = $row["t_Img"];

}

 if(isset($_REQUEST['updatet_NameBtn'])){
  if(($_REQUEST['t_Name'] == "")){
   // msg displayed if required field missing
   $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   $t_Name = $_REQUEST["t_Name"];
   $t_image = $_FILES['t_Img']['name']; 
   $t_image_temp = $_FILES['t_Img']['tmp_name'];
   $img_folder = '../image/tutor/'. $t_image; 
   move_uploaded_file($t_image_temp, $img_folder);
   $sql = "UPDATE tutor SET t_Name = '$t_Name', t_img = '$img_folder' WHERE t_Email = '$t_Email'";
   if($conn->query($sql) == TRUE){
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
      <label for="t_id">Tutor ID</label>
      <input type="text" class="form-control" id="t_id" name="t_id" value=" <?php if(isset($t_Id)) {echo $t_Id;} ?>" readonly>
    </div>
    <div class="form-group">
      <label for="t_Email">Email</label>
      <input type="email" class="form-control" id="t_Email" value=" <?php echo $t_Email ?>" readonly>
    </div>
    <div class="form-group">
      <label for="t_Name">Name</label>
      <input type="text" class="form-control" id="t_Name" name="t_Name" value=" <?php if(isset($t_Name)) {echo $t_Name;} ?>">
    </div>
    <div class="form-group">
      <label for="t_Img">Upload Image</label>
      <input type="file" class="form-control-file" id="t_Img" name="t_Img">
    </div>
    <button type="submit" class="btn btn-primary" name="updatet_NameBtn">Update</button>
    <?php if(isset($passmsg)) {echo $passmsg; } ?>
  </form>
 </div>

 </div> <!-- Close Row Div from header file -->
 <script type="text/javascript" src="./js/ajaxrequest.js"></script>
 <?php
include('./tutorInclude/footer.php'); 
?>