<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Queries');
define('PAGE', 'queries');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 }
// else {
//   echo "<script> location.href='../index.php'; </script>";
//  }
//  ?>

  <div class="col-sm-9 mt-5">
    <!--Table-->
    <p class=" bg-dark text-white p-2">List of Queries</p>
    <?php
      $sql = "SELECT * FROM contact";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
       echo '<table class="table" id="tableid">
       <thead>
        <tr>
         <th scope="col">Contact ID</th>
         <th scope="col">Name</th>
         <th scope="col">Email</th>
         <th scope="col">Message</th>
         <th scope="col">Action</th>
        </tr>
       </thead>
       <tbody>';
        while($row = $result->fetch_assoc()){
          echo '<tr>';
          echo '<th scope="row">'.$row["contact_id"].'</th>';
          echo '<td>'. $row["contact_name"].'</td>';
          echo '<td>'.$row["contact_email"].'</td>';
          echo '<td>'.$row["contact_message"].'</td>';
          echo '<td> 
          <form action="" method="POST" class="d-inline"><input type="hidden" name="id" value='. $row["contact_id"] .'><button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button></form></td>
         </tr>';
        }

        echo '</tbody>
        </table>';
      } else {
        echo "0 Result";
      }
      if(isset($_REQUEST['delete'])){
       $sql = "DELETE FROM contact WHERE contact_id = {$_REQUEST['id']}";
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
</div>  <!-- div Conatiner-fluid close from header -->
<?php
include('./adminInclude/footer.php'); 
?>
<script>
    $(document).ready(function () {
        $('#tableid').DataTable();
    });
</script>