<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Courses');
define('PAGE', 'courses');
include('./tutorInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_tutor_login'])){
  $tutorEmail = $_SESSION['tutorLogEmail'];
 }
// else {
//   echo "<script> location.href='../index.php'; </script>";
//  }
//  ?>
	
  <div class="col-sm-9 mt-5">
    <!--Table-->
    <p class=" bg-dark text-white p-2">All Courses</p>
    <?php
	$tutorEmail = $_SESSION['email'];
      $sql = "SELECT tu.t_Email, c.course_id, c.course_name, c.course_duration, c.course_desc, c.course_img, c.course_author, c.course_original_price, c.course_price, c.status FROM tutor AS tu JOIN course AS c ON c.t_Email= tu.T_Email WHERE tu.t_Email = '$tutorEmail'";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
       echo '<table class="table" id="tableid">
       <thead>
        <tr>
         <th scope="col">Course ID</th>
         <th scope="col">Name</th>
         <th scope="col">Author</th>
         <th scope="col">Status</th>
        </tr>
       </thead>
       <tbody>';
        while($row = $result->fetch_assoc()){
          echo '<tr>';
          echo '<th scope="row">'.$row["course_id"].'</th>';
          echo '<td>'. $row["course_name"].'</td>';
          echo '<td>'.$row["course_author"].'</td>';
		  echo '<td>'.$row["status"].'</td>';
        //   echo '<td><form action="editcourse.php" method="POST" class="d-inline"> <input type="hidden" name="id" value='. $row["course_id"] .'><button type="submit" class="btn btn-info mr-3" name="view" value="View"><i class="fas fa-pen"></i></button></form>  
        //   <form action="" method="POST" class="d-inline"><input type="hidden" name="id" value='. $row["course_id"] .'><button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button></form></td>
         '</tr>';
        }

        echo '</tbody>
        </table>';
      } else {
        echo "0 Result";
      }

     ?>
  </div>
</div>  <!-- div Row close from header -->
<div class="ml-10"><a class="btn btn-danger box" href="addNewCourse.php"><i class="fas fa-plus fa-2x"></i></a></div>

</div>  <!-- div Conatiner-fluid close from header -->
<?php
include('./tutorInclude/footer.php'); 
?>
<script>
    $(document).ready(function () {
        $('#tableid').DataTable();
    });
</script>