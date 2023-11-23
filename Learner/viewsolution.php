<?php
if (!isset($_SESSION)) {
  session_start();
}
define('TITLE', 'View Solution');
define('PAGE', 'view_solution');
include('./learnerInclude/header.php');
include_once('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
  $l_Email = $_SESSION['stuLogEmail'];
} else if (isset($_SESSION['loggedin'])) {
  $l_Email = $_SESSION['email'];
}

$sql = "SELECT * FROM learner WHERE l_Email='$l_Email'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
  $row = $result->fetch_assoc();
  $lId = $row["l_Id"];
}

if (isset($_REQUEST['report_id'])) {
  $reportId = $_REQUEST['report_id'];
  $sql = "SELECT solution FROM report WHERE report_Id='$reportId' AND l_Id='$lId'";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $solution = $row['solution'];
  }
}

?>

<div class="col-sm-6 mt-5">
  <div class="mt-4 mx-5">
    <h5>Solution:</h5>
    <textarea class="form-control" rows="4" readonly><?php echo htmlspecialchars($solution); ?></textarea>
  </div>
</div>

</div> <!-- Close Row Div from header file -->

<?php
include('./learnerInclude/footer.php');
?>
