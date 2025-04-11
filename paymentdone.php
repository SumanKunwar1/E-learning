<?php 
include('./dbConnection.php');
session_start();
if(!isset($_SESSION['stuLogEmail']) && !isset($_SESSION['email'])) {
 echo "<script> location.href='loginorsignup.php'; </script>";
} else { 
 date_default_timezone_set('Asia/Kathmandu');
 $date = date('Y-m-d H:i:s');
 if(isset($_POST['ORDER_ID']) && isset($_POST['TXN_AMOUNT'])){
  $order_id = $_POST['ORDER_ID'];
  if(isset($_SESSION['stuLogEmail'])){
    $stu_email = $_SESSION['stuLogEmail'];
  }
  if(isset($_SESSION['email'])){
    $stu_email = $_SESSION['email'];
  }
  $course_id = $_SESSION['course_id'];
  $status = "Success";
  $respmsg = "Done";
  $amount = $_POST['TXN_AMOUNT'];
  $date = $date;
  $sql = "INSERT INTO courseorder(order_id, l_Email, course_id, status, respmsg, amount, order_date) VALUES ('$order_id', '$stu_email', '$course_id', '$status', '$respmsg', '$amount', '$date')";
   if($conn->query($sql) == TRUE){
    echo "Workshop or Community Tour booked successfully, please wait! you are redirecting to your profile...";
    echo "<script> setTimeout(() => {
     window.location.href = './Learner/myCourse.php';
   }, 1500); </script>";
   };
 } else {
 echo "<b>Transaction status is failure</b>" . "<br/>";
 }
}
?>
