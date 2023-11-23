<?php 
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Edit Lesson');
define('PAGE', 'lessons');
include('./tutorInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['tloggedin'])){
  $tutorEmail = $_SESSION['email'];
 } 
//else {
//   echo "<script> location.href='../index.php'; </script>";
//  }
// Custom exception class for file size limit
// Custom exception class for file size limit
class FileSizeException extends Exception {
  public function __construct($message = "File size exceeds the limit of 200MB.", $code = 0, Throwable $previous = null) {
    parent::__construct($message, $code, $previous);
  }
}

// Update
if (isset($_REQUEST['requpdate'])) {
  // Checking for Empty Fields
  if (($_REQUEST['lesson_id'] == "") || ($_REQUEST['lesson_name'] == "") || ($_REQUEST['lesson_desc'] == "") || ($_REQUEST['course_id'] == "") || ($_REQUEST['course_name'] == "")) {
    // msg displayed if required field missing
    $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
  } else {
    // Assigning User Values to Variables
    $lid = $_REQUEST['lesson_id'];
    $lname = $_REQUEST['lesson_name'];
    $ldesc = $_REQUEST['lesson_desc'];
    $cid = $_REQUEST['course_id'];
    $cname = $_REQUEST['course_name'];
    $llink = '../lessonvid/' . $_FILES['lesson_link']['name'];

    // Handle image upload
    $file_name = $_FILES['lesson_link']['name'];
    $file_temp = $_FILES['lesson_link']['tmp_name'];
    $file_size = $_FILES['lesson_link']['size'];
    $file_type = $_FILES['lesson_link']['type'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Define allowed extensions and file size limit
    $allowed_extensions = array('mp4', 'avi', 'mov');
    $max_file_size = 200 * 1024 * 1024; // 200MB

    try {
      if (in_array($file_ext, $allowed_extensions)) {
        if ($file_size <= $max_file_size) {
          $upload_path = '../lessonvid/' . $file_name;
          move_uploaded_file($file_temp, $upload_path);

          $sql = "UPDATE lesson SET lesson_id = '$lid', lesson_name = '$lname', lesson_desc = '$ldesc', course_id='$cid', course_name='$cname', lesson_link='$llink' WHERE lesson_id = '$lid'";

          if ($conn->query($sql) == TRUE) {
            // Display success message
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Updated Successfully</div>';
          } else {
            // Display error message
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Update</div>';
          }
        } else {
          // File size exceeded
          throw new FileSizeException();
        }
      } else {
        // Invalid file extension
        throw new Exception('Invalid file. Allowed extensions: mp4, avi, mov.');
      }
    } catch (FileSizeException $e) {
      // Display custom error message for file size limit
      $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">' . $e->getMessage() . '</div>';
    } catch (Exception $e) {
      // Display general error message for other exceptions
      $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">' . $e->getMessage() . '</div>';
    }
  }
}




 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Update Lesson Details</h3>
  <?php
 if(isset($_REQUEST['view'])){
  $sql = "SELECT * FROM lesson WHERE lesson_id = {$_REQUEST['id']}";
 $result = $conn->query($sql);
 $row = $result->fetch_assoc();
 }
 ?>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="lesson_id">Lesson ID</label>
      <input type="text" class="form-control" id="lesson_id" name="lesson_id" value="<?php if(isset($row['lesson_id'])) {echo $row['lesson_id']; }?>" readonly>
    </div>
    <div class="form-group">
      <label for="lesson_name">Lesson Name</label>
      <input type="text" class="form-control" id="lesson_name" name="lesson_name" value="<?php if(isset($row['lesson_name'])) {echo $row['lesson_name']; }?>">
    </div>

    <div class="form-group">
      <label for="lesson_desc">Lesson Description</label>
      <textarea class="form-control" id="lesson_desc" name="lesson_desc" row=2><?php if(isset($row['lesson_desc'])) {echo $row['lesson_desc']; }?></textarea>
    </div>
    <div class="form-group">
      <label for="course_id">Course ID</label>
      <input type="text" class="form-control" id="course_id" name="course_id" value="<?php if(isset($row['course_id'])) {echo $row['course_id']; }?>" readonly>
    </div>
    <div class="form-group">
      <label for="course_name">Course Name</label>
      <input type="text" class="form-control" id="course_name" name="course_name" onkeypress="isInputNumber(event)" value="<?php if(isset($row['course_name'])) {echo $row['course_name']; }?>" readonly>
    </div>
    <div class="form-group">
      <label for="lesson_link">Lesson Link</label>
      <div class="embed-responsive embed-responsive-16by9">
       <iframe class="embed-responsive-item" src="<?php if(isset($row['lesson_link'])) {echo $row['lesson_link']; }?>" allowfullscreen></iframe>
      </div>     
      <input type="file" class="form-control-file" id="lesson_link" name="lesson_link">
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
      <a href="Lesson.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
</div>  <!-- div Row close from header -->
</div>  <!-- div Conatiner-fluid close from header -->
<!-- Only Number for input fields -->
<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }

  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("lessonSubmitBtn").addEventListener("click", function (event) {
      var lessonName = document.getElementById("lesson_name").value.trim();
      var lessonDesc = document.getElementById("lesson_desc").value.trim();
      var lessonLink = document.getElementById("lesson_link").value.trim();

      var nameRegex = /[A-Za-z0-9][A-Za-z\s][\d]*$/;
      var descRegex = /^[A-Za-z]/;
      var linkRegex = /\.(mp4|avi|mkv)$/i; // Adjust the video formats as needed

      var isValid = true;

      // Remove previous error messages
      removeErrorMessage("lesson_name");
      removeErrorMessage("lesson_desc");
      removeErrorMessage("lesson_link");

      if (!nameRegex.test(lessonName)) {
        displayErrorMessage("lesson_name", "Invalid lesson name");
        isValid = false;
      }

      if (!descRegex.test(lessonDesc)) {
        displayErrorMessage("lesson_desc", "Lesson description should only contains alphabets.");
        isValid = false;
      }

      if (!linkRegex.test(lessonLink)) {
        displayErrorMessage("lesson_link", "Invalid video link format. Supported formats: mp4, avi, mkv.");
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
include('./tutorInclude/footer.php'); 
?>