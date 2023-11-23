<?php 
include_once('../dbConnection.php');
 if(!isset($_SESSION)){ 
   session_start(); 
 } 
 if(isset($_SESSION['tloggedin'])){
  $tutorEmail = $_SESSION['email'];
 } 
 else {
  echo "<script> location.href='../index.php'; </script>";
 }

 if(isset($tutorEmail)){
  $sql = "SELECT t_Img FROM tutor WHERE t_Email = '$tutorEmail'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $t_img = $row['t_Img'];
 }
?>

<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>
  <?php echo TITLE ?>
 </title>
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="../css/bootstrap.min.css">

 <!-- Font Awesome CSS -->
 <link rel="stylesheet" href="../css/all.min.css">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

 <!-- Custom CSS -->
 <link rel="stylesheet" href="../css/stustyle.css">
 <link rel="stylesheet" href="../css/a_style.css">
 
 <!-- data table css -->
 <link rel="stylesheet" href="../css/datatables.min.css">

</head>

<body>
 <!-- Top Navbar -->
 <nav class="navbar navbar-dark fixed-top flex-md-nowrap p-0 shadow" style="background-color: #225470;">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../">NextGen</a>
 </nav>

 <!-- Side Bar -->
 <div class="container-fluid mb-5 " style="margin-top:40px;">
  <div class="row">
   <nav class="col-sm-2 bg-light sidebar py-5 d-print-none">
    <div class="sidebar-sticky">
     <ul class="nav flex-column">
      <li class="nav-item mb-3">
      <img src="<?php echo $t_img ?>" alt="tutorimage" class="img-thumbnail rounded-circle">
      </li>
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'profile') {echo 'active';} ?>" href="tutorProfile.php">
        <i class="fas fa-user"></i>
        Profile <span class="sr-only">(current)</span>
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'mycourse') {echo 'active';} ?>" href="teachingCourses.php">
        <i class="fab fa-accessible-icon"></i>
        My Courses
       </a>
      </li> 
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'lessons') {echo 'active';} ?>" href="Lesson.php">
        <i class="fab fa-accessible-icon"></i>
        My Lessons
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'report') {echo 'active';} ?>" href="solve.php">
       <i class="fab fa-accessible-icon"></i>
        Reports
       </a>
      </li>     
      <li class="nav-item">
       <a class="nav-link <?php if(PAGE == 'tutorChangePass') {echo 'active';} ?>" href="tutorChangePass.php">
        <i class="fas fa-key"></i>
        Change Password
       </a>
      </li>
      <li class="nav-item">
       <a class="nav-link" href="../logout.php">
        <i class="fas fa-sign-out-alt"></i>
        Logout
       </a>
      </li>
     </ul>
    </div>
   </nav>