<?php
if (!isset($_SESSION)) {
  session_start();
}
define('TITLE', 'Edit Course');
define('PAGE', 'courses');
include('./adminInclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
  $adminEmail = $_SESSION['adminLogEmail'];
}
//  else {
//   echo "<script> location.href='../index.php'; </script>";
//  }
// Update
if (isset($_REQUEST['requpdate'])) {
  // Checking for Empty Fields
  if (
    ($_REQUEST['course_id'] == "") ||
    ($_REQUEST['course_name'] == "") ||
    ($_REQUEST['course_desc'] == "") ||
    ($_REQUEST['course_author'] == "") ||
    ($_REQUEST['course_duration'] == "") ||
    ($_REQUEST['course_price'] == "") ||
    ($_REQUEST['course_original_price'] == "")
  ) {
    // msg displayed if required field missing
    $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
    // Assigning User Values to Variables
    $cid = $_REQUEST['course_id'];
    $cname = $_REQUEST['course_name'];
    $cdesc = $_REQUEST['course_desc'];
    $cauthor = $_REQUEST['course_author'];
    $cduration = $_REQUEST['course_duration'];
    $cprice = abs($_REQUEST['course_price']);
    $coriginalprice = abs($_REQUEST['course_original_price']);

    // Handle image upload
    $cimg = '';
    if ($_FILES['course_img']['name'] != '') {
      $file_name = $_FILES['course_img']['name'];
      $file_size = $_FILES['course_img']['size'];
      $file_tmp = $_FILES['course_img']['tmp_name'];
      $file_type = $_FILES['course_img']['type'];
      $file_ext = explode('.', $_FILES['course_img']['name']);
      $file_ext = strtolower(end($file_ext));
      $extensions = array("jpeg", "jpg", "png", "webp");

      if (in_array($file_ext, $extensions) === false) {
        $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Extension not allowed, please choose a JPEG or PNG file.</div>';
      } else if ($file_size > 20097152) {
        $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">File size must be less than 20 MB.</div>';
      } else {
        move_uploaded_file($file_tmp, "../image/courseimg/" . $file_name);
        // Assign the image path to $cimg
        $cimg = '../image/courseimg/' . $file_name;
      }
    }

    $sql = "UPDATE course SET 
            course_name = '$cname', 
            course_desc = '$cdesc', 
            course_author='$cauthor', 
            course_duration='$cduration', 
            course_price='$cprice', 
            course_original_price='$coriginalprice'";

    // Append the image field to the update query only if a new image was uploaded
    if (!empty($cimg)) {
      $sql .= ", course_img='$cimg'";
    }

    $sql .= " WHERE course_id = '$cid'";

    if ($conn->query($sql) == TRUE) {
      // Display success message
      $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Updated Successfully</div>';
    } else {
      // Display error message
      $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Update</div>';
    }
  }
}
?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Update Course Details</h3>
  <?php
  if (isset($_REQUEST['view'])) {
    $sql = "SELECT * FROM course WHERE course_id = {$_REQUEST['id']}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
  }
  ?>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="course_id">Course ID</label>
      <input type="text" class="form-control" id="course_id" name="course_id" value="<?php if (isset($row['course_id'])) {
        echo $row['course_id'];
      } ?>" readonly>
    </div>
    <div class="form-group">
      <label for="course_name">Course Name</label>
      <input type="text" class="form-control" id="course_name" name="course_name" value="<?php if (isset($row['course_name'])) {
        echo $row['course_name'];
      } ?>">
    </div>


    <div class="form-group">
      <label for="course_desc">Course Description</label>
      <textarea class="form-control" id="course_desc" name="course_desc" row=2><?php if (isset($row['course_desc'])) {
        echo $row['course_desc'];
      } ?></textarea>
    </div>
    <div class="form-group">
      <label for="course_author">Author</label>
      <input type="text" class="form-control" id="course_author" name="course_author" value="<?php if (isset($row['course_author'])) {
        echo $row['course_author'];
      } ?>">
    </div>
    <div class="form-group">
      <label for="course_duration">Course Duration</label>
      <input type="text" class="form-control" id="course_duration" name="course_duration" value="<?php if (isset($row['course_duration'])) {
        echo $row['course_duration'];
      } ?>">
    </div>
    <div class="form-group">
      <label for="course_original_price">Course Original Price</label>
      <input type="text" class="form-control" id="course_original_price" name="course_original_price"
        onkeypress="isInputNumber(event)" value="<?php if (isset($row['course_original_price'])) {
          echo $row['course_original_price'];
        } ?>">
    </div>
    <div class="form-group">
      <label for="course_price">Course Selling Price</label>
      <input type="text" class="form-control" id="course_price" name="course_price" onkeypress="isInputNumber(event)"
        value="<?php if (isset($row['course_price'])) {
          echo $row['course_price'];
        } ?>">
    </div>
    <div class="form-group">
      <label for="course_img">Course Image</label>
      <img src="<?php if (isset($row['course_img'])) {
        echo $row['course_img'];
      } ?>" alt="courseimage" class="img-thumbnail">
      <input type="file" class="form-control-file" id="course_img" name="course_img">
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
      <a href="courses.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if (isset($msg)) {
      echo $msg;
    } ?>
  </form>
</div>
</div> <!-- div Row close from header -->
</div> <!-- div Conatiner-fluid close from header -->
<!-- Only Number for input fields -->
<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }

  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("courseSubmitBtn").addEventListener("click", function (event) {
      var courseName = document.getElementById("course_name").value.trim();
      var courseDesc = document.getElementById("course_desc").value.trim();
      var courseAuthor = document.getElementById("course_author").value.trim();
      var courseDuration = document.getElementById("course_duration").value.trim();
      var courseOriginalPrice = document.getElementById("course_original_price").value.trim();
      var coursePrice = document.getElementById("course_price").value.trim();
      var courseImg = document.getElementById("course_img").value.trim();

      var nameRegex = /^[A-Za-z][A-Za-z\s]*$/;
      var descRegex = /^[A-Za-z]/;
      var authorRegex = /^[A-Za-z]+(\s[A-Za-z]+)*$/;
      var durationRegex = /^\d+\s*(months|weeks|years)$/i;
      var priceRegex = /^\d+(\.\d+)?$/;
      var imgRegex = /\.(jpg|jpeg|png|dng)$/i;

      var isValid = true;

      if (!nameRegex.test(courseName)) {
        displayErrorMessage("course_name", "Course name only contains ");
        isValid = false;
      }

      if (!descRegex.test(courseDesc)) {
        displayErrorMessage("course_desc", "Course description only contains english alphabets.");
        isValid = false;
      }

      if (!authorRegex.test(courseAuthor)) {
        displayErrorMessage("course_author", "Author name format does not match");
        isValid = false;
      }

      if (!durationRegex.test(courseDuration)) {
        displayErrorMessage("course_duration", "Duration format does not match. eg: 2 Months/Weeks");
        isValid = false;
      }

      if (!priceRegex.test(courseOriginalPrice) || !priceRegex.test(coursePrice)) {
        displayErrorMessage("course_original_price", "Course price must be a positive number.");
        displayErrorMessage("course_price", "Course selling price must be a positive number.");
        isValid = false;
      }

      if (!imgRegex.test(courseImg)) {
        displayErrorMessage("course_img", "Invalid image format. Supported formats: jpg, jpeg, png, dng.");
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
  });
</script>
<?php
include('./adminInclude/footer.php');
?>