<?php
session_start();
include('./dbConnection.php');

if(isset($_POST['submit'])){
    $t_email = $_POST['email'];
    $t_pass = sha1($_POST['pass']);

    $sql = "SELECT * FROM tutor WHERE t_Email = '$t_email' AND t_Password ='$t_pass' ";
    $res = mysqli_query($conn,$sql);
    $NumRows = mysqli_num_rows($res);
    $msg='';
    
    if($NumRows == 1){
        $_SESSION['tloggedin'] = true;
        $_SESSION['email'] = $t_email;
        $_SESSION['status'] = '1';
        if(isset($_POST['remember'])){
            
            setcookie('email',$t_email,time()+24*3600);
        }
        header("Location: index.php");
        $msg= "Logged In successfully";    
    }else{
        $msg = "Log In failed";
        echo "Record not found";
    }
}
if (isset($_COOKIE['email']) && !empty($_COOKIE['email'])) {
	header("Location: ./Tutor/tutorProfile.php");
}
