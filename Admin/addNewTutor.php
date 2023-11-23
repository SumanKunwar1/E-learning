<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Add Tutor');
define('PAGE', 'Tutor');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 } 
// else {
//   echo "<script> location.href='../index.php'; </script>";
//  }
 if(isset($_REQUEST['newt_SubmitBtn'])){
  // Checking for Empty Fields
  if(($_REQUEST['t_name'] == "") || ($_REQUEST['t_email'] == "") || ($_REQUEST['t_pass'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   // Assigning User Values to Variable
   $t_name = $_REQUEST['t_name'];
   $t_email = $_REQUEST['t_email'];
   $t_pass = $_REQUEST['t_pass'];

    $sql = "INSERT INTO tutor (t_Name, t_Email, t_Password) VALUES ('$t_name', '$t_email', '$t_pass')";
    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Tutor Added Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add Tutor</div>';
    }
  }
  }
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Add New Tutor</h3>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="t_name">Name</label>
      <input type="text" class="form-control" id="t_name" name="t_name">
    </div>
    <div class="form-group">
      <label for="t_email">Email</label>
      <input type="text" class="form-control" id="t_email" name="t_email">
    </div>
    <div class="form-group">
      <label for="t_pass">Password</label>
      <input type="text" class="form-control" id="t_pass" name="t_pass">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="newt_SubmitBtn" name="newt_SubmitBtn">Submit</button>
      <a href="tutors.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
</div>  <!-- div Row close from header -->
</div>  <!-- div Conatiner-fluid close from header -->
<!-- Only Number for input fields -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("newt_SubmitBtn").addEventListener("click", function (event) {
      var tName = document.getElementById("t_name").value.trim();
      var tEmail = document.getElementById("t_email").value.trim();
      var tPass = document.getElementById("t_pass").value.trim();

      var nameRegex = /^[A-Za-z][A-Za-z\s]*$/;
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      var passRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/; // Minimum 8 characters, at least one uppercase letter, one lowercase letter, and one number

      var isValid = true;

      // Remove previous error messages
      removeErrorMessage("t_name");
      removeErrorMessage("t_email");
      removeErrorMessage("t_pass");

      if (!nameRegex.test(tName)) {
        displayErrorMessage("t_name", "Name must start with an alphabet.");
        isValid = false;
      }

      if (!emailRegex.test(tEmail)) {
        displayErrorMessage("t_email", "Invalid email format.");
        isValid = false;
      }

      if (!passRegex.test(tPass)) {
        displayErrorMessage("t_pass", "Password must be at least 8 characters long, including one uppercase letter, one lowercase letter, and one number.");
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