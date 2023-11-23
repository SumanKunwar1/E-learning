<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Add Services');
define('PAGE', 'services');
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
  if(($_REQUEST['service_title'] == "") || ($_REQUEST['service_desc'] == "") ){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   // Assigning User Values to Variable
   $service_id = $_REQUEST['service_id'];
   $service_title = $_REQUEST['service_title'];
   $service_desc = $_REQUEST['service_desc'];
    
   $sql = "UPDATE services SET service_id = '$service_id', service_title = '$service_title', service_desc='$service_desc' WHERE service_id='$service_id'";
    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
    }
  }
  }
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Update Details Details</h3>
  <?php
 if(isset($_REQUEST['view'])){
  $sql = "SELECT * FROM services WHERE service_id = {$_REQUEST['id']}";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 }
 ?>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="service_id">service ID</label>
      <input type="text" class="form-control" id="service_id" name="service_id" value="<?php if(isset($row['service_id'])) {echo $row['service_id']; }?>" readonly>
    </div>
    <div class="form-group">
      <label for="service_name">Service Title</label>
      <input type="text" class="form-control" id="service_title" name="service_title" value="<?php if(isset($row['service_title'])) {echo $row['service_title']; }?>">
    </div>
    <div class="form-group">
      <label for="service_desc">Service Description</label>
      <textarea cols="30" rows="3" class="form-control" id="service_desc" name="service_desc"><?php if(isset($row['service_desc'])) {echo $row['service_desc']; }?></textarea>
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
      <a href="services.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
</div>  <!-- div Row close from header -->
</div>  <!-- div Conatiner-fluid close from header -->

<?php
include('./adminInclude/footer.php'); 
?>