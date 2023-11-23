<?php
$servername = "localhost";
$username = "root";
$upassword = "";
$dbname = "e_learning";

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