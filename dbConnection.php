<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "e_learning";

// Create Connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check Connection
if($conn->connect_error) {
 die("connection failed");
} 
// else {
//  echo"connected";
// }
?>