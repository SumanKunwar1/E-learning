<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Add Learner');
define('PAGE', 'Learner');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 } 
// else {
//   echo "<script> location.href='../index.php'; </script>";
//  }
 if(isset($_REQUEST['newl_SubmitBtn'])){
  // Checking for Empty Fields
  if(($_REQUEST['l_name'] == "") || ($_REQUEST['l_email'] == "") || ($_REQUEST['l_pass'] == "") || ($_REQUEST['l_occ'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   // Assigning User Values to Variable
   $l_name = $_REQUEST['l_name'];
   $l_email = $_REQUEST['l_email'];
   $l_pass = $_REQUEST['l_pass'];
   $l_occ = $_REQUEST['l_occ'];

    $sql = "INSERT INTO learner (l_Name, l_Email, l_Password, l_occ) VALUES ('$l_name', '$l_email', '$l_pass', '$l_occ')";
    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Learner Added Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add Learner </div>';
    }
  }
  }
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Add New Learner</h3>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="l_name">Name</label>
      <input type="text" class="form-control" id="l_name" name="l_name">
    </div>
    <div class="form-group">
      <label for="l_email">Email</label>
      <input type="text" class="form-control" id="l_email" name="l_email">
    </div>
    <div class="form-group">
      <label for="l_pass">Password</label>
      <input type="text" class="form-control" id="l_pass" name="l_pass">
    </div>
    <div class="form-group">
      <label for="l_occ">Occupation</label>
      <input type="text" class="form-control" id="l_occ" name="l_occ">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="newl_SubmitBtn" name="newl_SubmitBtn">Submit</button>
      <a href="learners.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
</div>  <!-- div Row close from header -->
</div>  <!-- div Conatiner-fluid close from header -->
<!-- Only Number for input fields -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("newl_SubmitBtn").addEventListener("click", function (event) {
      var lName = document.getElementById("l_name").value.trim();
      var lEmail = document.getElementById("l_email").value.trim();
      var lPass = document.getElementById("l_pass").value.trim();
      var lOcc = document.getElementById("l_occ").value.trim();

      var nameRegex = /^[A-Za-z][A-Za-z\s]*$/;
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      var passRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/; // Minimum 8 characters, at least one uppercase letter, one lowercase letter, and one number
      var occRegex = /^[A-Za-z\s]*$/;

      var isValid = true;

      // Remove previous error messages
      removeErrorMessage("l_name");
      removeErrorMessage("l_email");
      removeErrorMessage("l_pass");
      removeErrorMessage("l_occ");

      if (!nameRegex.test(lName)) {
        displayErrorMessage("l_name", "Name must start with an alphabet.");
        isValid = false;
      }

      if (!emailRegex.test(lEmail)) {
        displayErrorMessage("l_email", "Invalid email format.");
        isValid = false;
      }

      if (!passRegex.test(lPass)) {
        displayErrorMessage("l_pass", "Password must be at least 8 characters long, including one uppercase letter, one lowercase letter, and one number.");
        isValid = false;
      }

      if (!occRegex.test(lOcc)) {
        displayErrorMessage("l_occ", "Occupation should only contain alphabets and spaces.");
        isValid = false;
      }

      if (!isValid) {
        event.preventDefault();
      }
    });

    function displayErrorMessage(elementId, message) {
      var errorMessage = document.getElementById(elementId + "_error");
      if (errorMessage === null) {
        errorMessage = document.createElement("div");
        errorMessage.className = "alert alert-danger mt-2";
        errorMessage.id = elementId + "_error";
        document.getElementById(elementId).parentNode.appendChild(errorMessage);
      }
      errorMessage.innerHTML = message;
    }

    function removeErrorMessage(elementId) {
      var errorMessage = document.getElementById(elementId + "_error");
      if (errorMessage !== null) {
        errorMessage.parentNode.removeChild(errorMessage);
      }
    }
  });
</script>

<?php
include('./adminInclude/footer.php'); 
?>