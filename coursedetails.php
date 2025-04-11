<?php
include('./dbConnection.php');
// Header Include from mainInclude 
include('./header.php');

function generateStarRating($rating)
{
  $stars = "";
  $fullStars = floor($rating);
  $halfStar = ($rating - $fullStars) >= 0.5 ? true : false;
  $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

  // Full stars
  for ($i = 0; $i < $fullStars; $i++) {
    $stars .= '<i class="fas fa-star"></i>';
  }

  // Half star
  if ($halfStar) {
    $stars .= '<i class="fas fa-star-half-alt"></i>';
  }

  // Empty stars
  for ($i = 0; $i < $emptyStars; $i++) {
    $stars .= '<i class="far fa-star"></i>';
  }

  return $stars;
}

if (isset($_REQUEST['course_id'])) {
  $course_id = $_REQUEST['course_id'];

  // Retrieve the course details from the database using the course_id
  $sql = "SELECT * FROM course WHERE course_id = '$course_id'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $course_name = $row['course_name'];
    $course_desc = $row['course_desc'];
    $course_img = $row['course_img'];
  }
}
?>
<!-- Start Course Page Banner -->
<div class="container-fluid bg-dark">
  <div class="row">
    <video autoplay muted loop style="height:40%; width: 100%; object-fit: cover; opacity: 0.3;">
      <source src="./assets/video/bannerVid.mp4">
    </video>
  </div>
</div>
<!-- End Course Page Banner -->
<div class="container mt-5"> <!-- Start All Course -->
      <?php
          if(isset($_GET['course_id'])){
           $course_id = $_GET['course_id'];
           $_SESSION['course_id'] = $course_id;
           $sql = "SELECT * FROM course WHERE course_id = '$course_id'";
          $result = $conn->query($sql);
          if($result->num_rows > 0){ 
            while($row = $result->fetch_assoc()){
              echo ' 
                <div class="row">
                <div class="col-md-4">
                  <img src="'.str_replace('..', '.', $row['course_img']).'" class="card-img-top" alt="Guitar" />
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">Course Name: '.$row['course_name'].'</h5>
                    <p class="card-text"> Description: '.$row['course_desc'].'</p>
                    <p class="card-text"> Duration: '.$row['course_duration'].'</p>
                    
                  </div>
                  <form action="checkout.php" method="post">
                      <p class="card-text d-inline">Price: <small><del>&#36;'.$row['course_original_price'].'</del></small> <span class="font-weight-bolder">&#36; '.$row['course_price'].'<span></p>
                      <input type="hidden" name="id" value='. $row["course_price"] .'> 
                      <button style="max-width:25%" type="submit" class="btn btn-primary text-white font-weight-bolder float-right " name="buy">Book Now</button>
                    </form>
                </div>
              ';
            }
          }
         }
        ?>   
      </div><!-- End All Course -->
<div class="container">
  <div class="row">
    <?php
    $sql = "SELECT * FROM lesson";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      echo '
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th scope="col">Session No.</th>
              <th scope="col">Session Name</th>
              <th scope="col">Session Description</th>
            </tr>
          </thead>
          <tbody>';
      $num = 0;
      while ($row = $result->fetch_assoc()) {
        if ($row['course_id'] == $course_id) {
          $num++;
          echo '
            <tr>
              <th scope="row">' . $num . '</th>
              <td>' . $row["lesson_name"] . '</td>
              <td>' . substr($row["lesson_name"], 0, 100) . '</td>
            </tr>';
        }
      }
      echo '
          </tbody>
        </table>';
    }

    // Join learner and feedback tables to display name and image
    $sql = "SELECT feedback.*, learner.l_Name, learner.l_img, AVG(feedback.f_ratings) AS average_rating 
            FROM learner 
            INNER JOIN feedback ON feedback.l_Id = learner.l_Id 
            WHERE feedback.course_id = '$course_id' 
            GROUP BY feedback.f_id, learner.l_Name, learner.l_img";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo '
        <h3>Reviews and Ratings</h3>';

      while ($row = $result->fetch_assoc()) {
        echo '
          <div class="card p-1 m-2" style="width:100%; max-width:100%; min-width:100%;">
            <div class="card-body">
              <div class="media">
                <img src="' . str_replace('..', '.', $row['l_img']) . '" class="mr-3" alt="User Image" style="width: 64px; height: 64px;">
                <div class="media-body">
                  <h5 class="mt-0">' . $row["l_Name"] . '</h5>
                  Rating: <p class="mb-0" style="color:#f7af14;display: contents;" >' . generateStarRating($row["average_rating"]) . '</p>
                  <p class="mb-0">Review: ' . $row["f_content"] . '</p>
                </div>
              </div>
            </div>
          </div>';
      }
    } else {
      echo '<p>No reviews and ratings found for this course.</p>';
    }
    ?>
  </div>
</div>

<?php
// Footer Include from mainInclude 
include('./footer.php');
?>
