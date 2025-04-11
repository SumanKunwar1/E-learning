<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$db_host = "127.0.0.1";
$db_user = "root";
$db_password = "C0d!ng123";
$db_name = "e_learning";

# connection create
$conn = mysqli_connect($servername,$username,$upassword,$dbname);

# check connection
// if(!$conn){
//     die("Error: Connection failed".mysqli_connect_errno());
// }
// else{
//     echo "Connected<br>";
// }
?>