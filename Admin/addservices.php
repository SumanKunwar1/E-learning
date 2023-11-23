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

 if(isset($_REQUEST['serviceSubmitBtn'])){
  // Checking for Empty Fields
  if(($_REQUEST['service_title'] == "") || ($_REQUEST['service_desc'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   // Assigning User Values to Variable
   $service_title = $_REQUEST['service_title'];
   $service_desc = $_REQUEST['service_desc'];
    $sql = "INSERT INTO services (service_title, service_desc) VALUES ('$service_title','$service_desc')";
    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Service Added Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add Service </div>';
    }
  }
  }
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Add New Service</h3>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="service_title">Service Title</label>
      <input type="text" class="form-control" id="service_title" name="service_title">
    </div>
    <div class="form-group">
      <label for="service_desc">Service Description</label>
      <textarea cols="30" rows="3" class="form-control" id="service_desc" name="service_desc"></textarea>
    </div>
    
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="serviceSubmitBtn" name="serviceSubmitBtn">Submit</button>
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