<?php
define('TITLE', 'Payment Status');
define('PAGE', 'paymentstatus');
include('../dbConnection.php');
include('./adminInclude/header.php');

$ORDER_ID = "";

if (isset($_POST["ORDER_ID"]) && $_POST["ORDER_ID"] != "") {
  $ORDER_ID = $_POST["ORDER_ID"];
}
?>

<div class="container">
  <h2 class="text-center my-4" style="margin-right: 15rem;">Payment Status</h2>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="form-group row" style="align-items: center; justify-content: center;">
      <label class="col-sm-2 col-form-label">Payment ID:</label>
      <div class="col-sm-4">
        <input class="form-control" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="<?php echo $ORDER_ID ?>">
      </div>
      <div class="col-sm-3">
        <input class="btn btn-primary" value="View" type="submit">
      </div>
    </div>
  </form>
</div>

<div class="container" >
  <?php
  if (isset($_POST['ORDER_ID'])) {
    $sql = "SELECT co.order_id, co.status, co.amount, co.order_date, c.course_name
            FROM courseorder co
            JOIN course c ON co.course_id = c.course_id
            WHERE co.order_id = '$ORDER_ID'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      ?>
      <div class="row justify-content-center">
        <div class="col-md-6">
          <h2 class="text-center mt-4">Payment Receipt</h2>
          <table class="table table-bordered mt-4">
            <tbody>
              <tr>
                <td><label>Payment ID</label></td>
                <td><?php echo $row["order_id"]; ?></td>
              </tr>
              <tr>
                <td><label>Status</label></td>
                <td><?php echo $row["status"]; ?></td>
              </tr>
              <tr>
                <td><label>Course Name</label></td>
                <td><?php echo $row["course_name"]; ?></td>
              </tr>
              <tr>
                <td><label>Amount</label></td>
                <td><?php echo '$'.$row["amount"]; ?></td>
              </tr>
              <tr>
                <td><label>Order Date</label></td>
                <td><?php echo $row["order_date"]; ?></td>
              </tr>
              <tr>
                <td></td>
                <td>
                  <button class="btn btn-primary" onclick="javascript:window.print();">Print Receipt</button>
                  <a class="btn btn-primary" href="./paymentStatusExport.php?ORDER_ID=<?php echo $ORDER_ID; ?>">Export To Excel</a>


                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <?php
    } else {
      echo "<p class='text-center'>No payment record found for the given order ID.</p>";
    }
  }
  ?>
</div>

<?php
include('./adminInclude/footer.php');
?>

