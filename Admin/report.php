<?php
if (!isset($_SESSION)) {
  session_start();
}
define('TITLE', 'Report');
define('PAGE', 'report');
include('./adminInclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
  $adminEmail = $_SESSION['adminLogEmail'];
}
?>

<div class="col-sm-9 mt-5">
  <!--Table-->
  <p class="bg-dark text-white p-2">List of Reports</p>
  <?php
  $sql = "SELECT * FROM report";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    echo '<table class="table" id="tableid">
       <thead>
        <tr>
         <th scope="col">Learner ID</th>
         <th scope="col">Problem Type</th>
         <th scope="col">Title</th>
         <th scope="col">Solutions</th>
         <th scope="col">Assign</th>
         <th scope="col">Action</th>
        </tr>
       </thead>
       <tbody>';
    while ($row = $result->fetch_assoc()) {
      echo '<tr>';
      echo '<th scope="row">' . $row["l_Id"] . '</th>';
      echo '<td>' . $row["Problem_Type"] . '</td>';
      echo '<td>' . $row["Title"] . '</td>';
      echo '<td>' . $row['solution'] . '</td>';
      echo '<td>
          <form action="" method="POST" class="d-inline">
            <input type="hidden" name="id" value=' . $row["l_Id"] . '>
            <label for="problemType">To</label> &nbsp;
            <select name="problem" id="problem" class="form-control" style="width:auto; display:inherit;">
              <option value="0">Select Tutor</option>';
            
            $tutorSql = "SELECT * FROM tutor";
            $tutorResult = $conn->query($tutorSql);
            while ($tutorRow = $tutorResult->fetch_assoc()) {
              echo '<option value="'.$tutorRow['t_Email'].'" data-profession="'.$tutorRow['t-Profession'].'">'.$tutorRow['t_Name'].'</option>';
            }
            
      echo '</select>
          </td>
          <td>
            <button type="submit" class="btn btn-secondary" name="submit" value="submit"><i class="far fa-paper-plane"></i></button>
            &nbsp;
            <button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button>
          </td>
          </form>
        </tr>';
    }

    echo '</tbody>
        </table>';
  } else {
    echo "0 Result";
  }
  if (isset($_REQUEST['submit'])) {
    $assign = $_POST['problem'];
    if ($assign != '0') {
      $sql = "UPDATE report SET Assign = '$assign' WHERE l_Id = {$_REQUEST['id']}";
      if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success" role="alert">Record assigned to the tutor successfully!</div>';
       
      } else {
        echo '<div class="alert alert-danger" role="alert">Unable to assign the record to the tutor.</div>';
      }
    } else {
      echo '<div class="alert alert-danger" role="alert">Please select a tutor to assign.</div>';
    }
  }
  if (isset($_REQUEST['delete'])) {
    $sql = "DELETE FROM report WHERE l_Id = {$_REQUEST['id']}";
    if ($conn->query($sql) === TRUE) {
      echo '<div class="alert alert-success" role="alert">Record deleted successfully!</div>';
    } else {
      echo '<div class="alert alert-danger" role="alert">Unable to delete the record.</div>';
    }
  }
  ?>
</div>
</div> <!-- div Row close from header -->
</div> <!-- div Conatiner-fluid close from header -->

<?php
include('./adminInclude/footer.php');
?>

<script>
  $(document).ready(function() {
    $('#tableid').DataTable();
  });
  $(function(){
    $("#problem option").each(function(i){
      if(i>0){
        var profession = $(this).data('profession');
        var title = "Profession: " + profession;
        $(this).attr("title", title);
      }
    });
  });
</script>
