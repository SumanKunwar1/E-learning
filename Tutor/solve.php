<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Report');
define('PAGE', 'report');
include('./tutorInclude/header.php'); 
include('../dbConnection.php');

if (isset($_SESSION['tloggedin'])) {
    $tutorEmail = $_SESSION['email'];
  }
 // else {
//   echo "<script> location.href='../index.php'; </script>";
//  }
// ?>
  <div class="col-sm-9 mt-5">
    <!--Table-->
    <p class=" bg-dark text-white p-2">List of Reports</p>
    <?php
      $sql = "SELECT * FROM report WHERE Assign = '$tutorEmail' ";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
       echo '<table class="table" id="tableid">
       <thead>
        <tr>
         <th scope="col">Report ID</th>
         <th scope="col">Learner ID</th>
         <th scope="col">Title</th>
         <th scope="col">Solutions</th>
         <th scope="col">Update</th>
        </tr>
       </thead>
       <tbody>';
        while($row = $result->fetch_assoc()){
          echo '<tr>';
          echo '<td>'.$row["report_Id"].'</td>';
          echo '<td>'.$row["l_Id"].'</td>';
          echo '<td>'.$row["Title"].'</td>';
          echo '<td>'.$row["solution"].'</td>';
          echo '<td><form action="solutions.php" method="POST" class="d-inline"> <input type="hidden" name="id" value='. $row['report_Id'] .'>
          <button type="submit" class="btn btn-info mr-3" name="view" id="View"><i class="fas fa-pen"></i></button></form></td></tr>';
        }
        echo '</tbody>
        </table>';
      } else {
        echo "0 Result";
      }
     ?>
  </div>
 </div>  <!-- div Row close from header -->
</div>  <!-- div Conatiner-fluid close from header -->
<?php
include('./tutorInclude/footer.php'); 
?>
<script>
    $(document).ready(function () {
        $('#tableid').DataTable();
    });
</script>