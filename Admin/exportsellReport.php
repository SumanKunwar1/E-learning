<?php
include('../dbConnection.php');

$html = '<table class="table">
<thead>
  <tr>
    <th scope="col">Order ID</th>
    <th scope="col">Course ID</th>
    <th scope="col">Learner Email</th>
    <th scope="col">Payment Status</th>
    <th scope="col">Amount</th>
  </tr>
</thead>
<tbody>';

$sql = "SELECT order_id, course_id, l_Email, status, SUM(amount) AS total_amount FROM courseorder GROUP BY l_Email";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $html .= '<tr>
      <th scope="row">' . $row["order_id"] . '</th>
      <td>' . $row["course_id"] . '</td>
      <td>' . $row["l_Email"] . '</td>
      <td>' . $row["status"] . '</td>
      <td>' . $row["total_amount"] . '</td>
    </tr>';
}

$html .= '</tbody>
  </table>';

// Generate Excel file
header('Content-Type: application/xls');
header('Content-Disposition: attachment;filename=sellreport.xls');
header('Cache-Control: max-age=0');

echo $html;
exit;
?>
