<?php
include('../dbConnection.php');

if (isset($_GET['ORDER_ID'])) {
    $ORDER_ID = $_GET['ORDER_ID'];

    $sql = "SELECT co.order_id, co.status, co.amount, co.order_date, c.course_name
            FROM courseorder co
            JOIN course c ON co.course_id = c.course_id
            WHERE co.order_id = '$ORDER_ID'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Generate Excel file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=paymentreport.xls');

        // Start the Excel file content
        echo "<table>";
        echo "<tr><td><label>Order ID</label></td><td>{$row['order_id']}</td></tr>";
        echo "<tr><td><label>Status</label></td><td>{$row['status']}</td></tr>";
        echo "<tr><td><label>Course Name</label></td><td>{$row['course_name']}</td></tr>";
        echo "<tr><td><label>Amount</label></td><td>$ {$row['amount']}</td></tr>";
        echo "<tr><td><label>Order Date</label></td><td>{$row['order_date']}</td></tr>";
        echo "</table>";
        
        exit;
    }
}

echo "No payment record found for the given order ID.";
?>
