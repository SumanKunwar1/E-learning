<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Add Lesson');
define('PAGE', 'lessons');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

//  if(isset($_SESSION['is_admin_login'])){
//   $adminEmail = $_SESSION['adminLogEmail'];
//  } else {
//   echo "<script> location.href='../index.php'; </script>";
//  }
class FileSizeException extends Exception {
  public function __construct($message = "File size exceeds the limit of 200MB.", $code = 0, Throwable $previous = null) {
    parent::__construct($message, $code, $previous);
  }
}

if (isset($_REQUEST['lessonSubmitBtn'])) {
  // Checking for Empty Fields
  if (
    ($_REQUEST['lesson_name'] == "") ||
    ($_REQUEST['lesson_desc'] == "") ||
    ($_REQUEST['course_id'] == "") ||
    ($_REQUEST['course_name'] == "")
  ) {
    // Message displayed if required field missing
    $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
  } else {
    // Assigning User Values to Variables
    $lesson_name = $_REQUEST['lesson_name'];
    $lesson_desc = $_REQUEST['lesson_desc'];
    $course_id = $_REQUEST['course_id'];
    $course_name = $_REQUEST['course_name'];
    $lesson_link = $_FILES['lesson_link']['name'];
    $lesson_link_temp = $_FILES['lesson_link']['tmp_name'];
    $link_folder = '../lessonvid/' . $lesson_link;
    $max_file_size = 500 * 1024 * 1024; // 200MB

    try {
      if ($_FILES['lesson_link']['size'] <= $max_file_size) {
        move_uploaded_file($lesson_link_temp, $link_folder);
        $sql = "INSERT INTO lesson (lesson_name, lesson_desc, lesson_link, course_id, course_name) VALUES ('$lesson_name', '$lesson_desc','$link_folder', '$course_id', '$course_name')";
        if ($conn->query($sql) == TRUE) {
          // Success message
          $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Lesson Added Successfully </div>';
        } else {
          // Error message for database insertion failure
          $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add Lesson </div>';
        }
      } else {
        // File size exceeded
        throw new FileSizeException();
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
  <h3 class="text-center">Add New Lesson</h3>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="course_id">Course ID</label>
      <input type="text" class="form-control" id="course_id" name="course_id" value ="<?php if(isset($_SESSION['course_id'])){echo $_SESSION['course_id'];} ?>" readonly>
    </div>
    <div class="form-group">
      <label for="course_name">Course Name</label>
      <input type="text" class="form-control" id="course_name" name="course_name" value ="<?php if(isset($_SESSION['course_name'])){echo $_SESSION['course_name'];} ?>" readonly>
    </div>
    <div class="form-group">
      <label for="lesson_name">Lesson Name</label>
      <input type="text" class="form-control" id="lesson_name" name="lesson_name">
    </div>
    <div class="form-group">
      <label for="lesson_desc">Lesson Description</label>
      <textarea class="form-control" id="lesson_desc" name="lesson_desc" row=2></textarea>
    </div>
    <div class="form-group">
      <label for="lesson_link">Lesson Video Link</label>
      <input type="file" class="form-control-file" id="lesson_link" name="lesson_link">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="lessonSubmitBtn" name="lessonSubmitBtn">Submit</button>
      <a href="lessons.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
<!-- Only Number for input fields -->
<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }

</script>
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
include('./adminInclude/footer.php'); 
?>