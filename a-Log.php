<?php
session_start();
include('./dbConnection.php');

if(isset($_POST['submit'])){
    $a_email = $_POST['email'];
    $a_pass = sha1($_POST['pass']);

    $sql = "SELECT * FROM admin  WHERE a_Email = '$a_email' AND a_Password ='$a_pass' ";
    $res = mysqli_query($conn,$sql);
    $NumRows = mysqli_num_rows($res);
    $msg='';
    
    if($NumRows == 1){
        $_SESSION['aloggedin']=true;
        $_SESSION['email'] = $a_email;
        if(isset($_POST['remember'])){
            
            setcookie('email',$a_email,time()+24*3600);
        }
        header("Location: Admin\adminDashboard.php");
        $msg= "Logged In successfully";    
    }else{
        $msg = "Log In failed";
        echo "Record not found";
    }
}
if (isset($_COOKIE['email']) && !empty($_COOKIE['email'])) {
	header("Location: Admin\adminDashboard.php");
}
