<?php
if (!isset($_SESSION)) {
    session_start();
}
define('TITLE', 'Reports');
define('PAGE', 'reports');
include('./learnerInclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
    $l_Email = $_SESSION['stuLogEmail'];
  } else if (isset($_SESSION['loggedin'])) {
    $l_Email = $_SESSION['email'];
  }
  $sql = "SELECT * FROM learner WHERE l_Email='$l_Email'";
 $result = $conn->query($sql);
 if($result->num_rows == 1){
 $row = $result->fetch_assoc();
 $lId = $row["l_Id"];
}
?>

<div class="col-sm-9 mt-5">
    <!--Table-->
    <p class="bg-dark text-white p-2">List of Reports</p>
    <?php
    $sql = "SELECT report_Id, Problem_Type, Title FROM report where l_Id = $lId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<table id="tableid" class="table">
       <thead>
        <tr>
         <th scope="col">Report ID</th>
         <th scope="col">Problem Type</th>
         <th scope="col">Title</th>
         <th scope="col">Solution</th>
        </tr>
       </thead>
       <tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<th scope="row">' . $row["report_Id"] . '</th>';
            echo '<td>' . $row["Problem_Type"] . '</td>';
            echo '<td>' . substr($row["Title"], 0, 100) . '</td>';
            echo '<td><form action="viewsolution.php" method="POST" class="d-inline">
           <input type="hidden" name="report_id" value=' . $row["report_Id"] . '>
           <button type="submit" class="btn btn-info mr-3" name="view_solution" value="View Solution"><i class="fas fa-eye"></i></button>
           </form></td>
         </tr>';
        }

        echo '</tbody>
        </table>';
    } else {
        echo "No reports found.";
    }
    ?>
    <div><a class="btn btn-danger box" href="./reportProblems.php" style="float: right;"><i class="fas fa-plus fa-2x"></i></a></div> <!-- Add new report or problem button -->
</div>

<?php
include('./learnerInclude/footer.php');
?>
<script>
    $(document).ready(function () {
        $('#tableid').DataTable();
    });
</script>
