<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Courses');
define('PAGE', 'courses');
include('./tutorInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['tloggedin'])){
  $tutorEmail = $_SESSION['email'];
 }
else {
  echo "<script> location.href='../index.php'; </script>";
 }
  ?>
	
  <div class="col-sm-9 mt-5">
    <!--Table-->
    <p class=" bg-dark text-white p-2">All Lessons</p>
    <?php
    $sql = "SELECT l.course_id,l.lesson_id,l.lesson_name,l.lesson_desc,l.lesson_link, c.course_id, c.course_name FROM lesson AS l JOIN course AS c ON c.course_id = l.course_id WHERE c.t_Email = '$tutorEmail'";
    $result = $conn->query($sql);
      if($result->num_rows > 0){
       echo '<table class="table" id="tableid">
       <thead>
        <tr>
         <th scope="col">Course ID</th>
         <th scope="col">Course Name</th>
         <th scope="col">Lesson ID</th>
         <th scope="col">Lesson Name</th>
         <th scope=""col>Lesson Description</th>
         <th scope="col">Action</th>
        </tr>
       </thead>
       <tbody>';
        while($row = $result->fetch_assoc()){
          echo '<tr>';
          echo '<th scope="row">'.$row["course_id"].'</th>';
          echo '<td>'. $row["course_name"].'</td>';
          echo '<td>'.$row["lesson_id"].'</td>';
		      echo '<td>'.$row["lesson_name"].'</td>';
          echo '<td>'.substr($row["lesson_desc"], 0, 100).'</td>';
          echo '<td><form action="editLesson.php" method="POST" class="d-inline"> <input type="hidden" name="id" value='. $row["lesson_id"] .'><button type="submit" class="btn btn-info mr-3" name="view" value="View"><i class="fas fa-pen"></i></button></form>  
          <form action="" method="POST" class="d-inline"><input type="hidden" name="id" value='. $row["lesson_id"] .'><button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button></form></td>
         </tr>';
        }

        echo '</tbody>
        </table>';
      } else {
        echo "0 Result";
      }
      if(isset($_REQUEST['delete'])){
        $sql = "DELETE FROM lesson WHERE lesson_id = {$_REQUEST['id']}";
        if($conn->query($sql) === TRUE){
          // echo "Record Deleted Successfully";
          // below code will refresh the page after deleting the record
          echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
          } else {
            echo "Unable to Delete Data";
          }
       }
       
     ?>
  </div>
</div>  <!-- div Row close from header -->
<div class="ml-10"><a class="btn btn-danger box" href="addLesson.php"><i class="fas fa-plus fa-2x"></i></a></div>

</div>  <!-- div Conatiner-fluid close from header -->
<?php
include('./tutorInclude/footer.php'); 
?>
<script>
    $(document).ready(function () {
        $('#tableid').DataTable();
    });
</script>