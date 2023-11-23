<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'My Course');
define('PAGE', 'mycourse');
include('./learnerInclude/header.php'); 
include_once('../dbConnection.php');

 if(isset($_SESSION['is_login'])){
  $lLogEmail = $_SESSION['stuLogEmail'];
 }
 if(isset($_SESSION['loggedin'])){
$lLogEmail = $_SESSION['email'];
}
//  else {
//   echo "<script> location.href='../index.php'; </script>";
//  }
?>

 <div class="container mt-5 ml-2">
  <div class="row">
   <div class="jumbotron">
    <h4 class="text-center">All Course</h4>
    <?php 
   if(isset($lLogEmail)){
    $sql = "SELECT co.order_id, c.course_id, c.course_name, c.course_duration, c.course_desc, c.course_img, c.course_author, c.course_original_price, c.course_price FROM courseorder AS co JOIN course AS c ON c.course_id = co.course_id WHERE co.l_email = '$lLogEmail'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
     while($row = $result->fetch_assoc()){ ?>
      <div class="bg-light mb-3">
        <h5 class="card-header"><?php echo $row['course_name']; ?></h5>
          <div class="row">
          
              <div class="col-sm-3">
                <img src="<?php echo $row['course_img']; ?>" class="card-img-top
                mt-4" alt="pic">
              </div>
              <div class="col-sm-6 mb-3">
                <div class="card-body">
                  <p class="card-title"><?php echo $row['course_desc']; ?></p>
                  <small class="card-text">Duration: <?php echo $row['course_duration']; ?></small><br />
                  <small class="card-text">Instructor: <?php echo $row['course_author']; ?></small><br/>
                  <p class="card-text d-inline">Price: <small><del>&#36 <?php echo $row['course_original_price'] ?> </del></small> <span class="font-weight-bolder">&#36 <?php echo $row['course_price']?> <span></p>
                  <div class="float-right">
                      <a href="watchcourse.php?course_id=<?php echo $row['course_id'] ?>" class="btn btn-primary mt-5">Watch Course</a>
                      <a href="feedback.php?course_id=<?php echo $row['course_id'] ?>" class="btn btn-info mt-5 ml-2">Leave Feedback</a>
                  </div>
                </div>
              </div>
          
          </div>
          
      </div> 
    <?php
     }
    }
   }
  
    ?>
    <hr/>
   </div>
  </div>
 </div>

 </div> <!-- Close Row Div from header file -->
 <?php
include('./learnerInclude/footer.php'); 
?>