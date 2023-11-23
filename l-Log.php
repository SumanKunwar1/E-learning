<?php
session_start();
include('./dbConnection.php');

if(isset($_POST['submit'])){
    $l_email = $_POST['email'];
    $l_pass = sha1($_POST['pass']);

    $sql = "SELECT * FROM learner  WHERE l_Email = '$l_email' AND l_Password ='$l_pass' ";
    $res = mysqli_query($conn,$sql);
    $NumRows = mysqli_num_rows($res);
    $msg='';
    
    if($NumRows == 1){
        $_SESSION['loggedin']=true;
        $_SESSION['email'] = $l_email;
        $_SESSION['status'] = '1';
        if(isset($_POST['remember'])){
            
            setcookie('email',$l_email,time()+24*3600);
        }
        header("Location: index.php");
        $msg= "Logged In successfully";    
    }else{
        $msg = "Log In failed";
        echo "Record not found";
    }
}
if (isset($_COOKIE['email']) && !empty($_COOKIE['email'])) {
	header("Location: Learner\learnerProfile.php");
}
