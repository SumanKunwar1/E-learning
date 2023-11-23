<?php
include('./dbConnection.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>NextGen E-Learning</title>
    <!-- ================ *** ====================
    *Author: Dinesh Kumar Rana, Bibek Tamang
    ===================== *** ================ -->


    <!-- Bootstrap core CSS -->
    <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="./assets/css/fontawesome.css">
    <link rel="stylesheet" href="./assets/css/newstyle.css">
    <link rel="stylesheet" href="./assets/css/responsive.css">
    <link rel="stylesheet" href="./assets/css/owl.css">
    <link rel="stylesheet" href="./assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <!-- Student Testimonial Owl Slider CSS -->
    <link rel="stylesheet" type="text/css" href="css/owl.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/testyslider.css">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <style>
        .owl-carousel .owl-nav button.owl-prev,
        .owl-carousel .owl-nav button.owl-next,
        .owl-carousel button.owl-dot {
            display: block;
            border-radius: 50%;
            padding: 15px;
            line-height: 52px;
            width: 55px;
            border: 1px;
            font-size: 22px;
            background-color: white;
            text-align: center;
            margin-right: 6px;
            margin-top: 5px;

        }

        .owl-carousel button.owl-dot {
            display: none;
        }

        .owl-prev::before,
        .owl-next::before {
            content: "";
            color: #fff;
        }

        .owl-next::before {
            content: "";
        }

        .owl-carousel .owl-nav button.owl-prev:hover,
        .owl-carousel .owl-nav button.owl-next:hover {
            background-color: rgba(255, 255, 255, 0.50);
        }

        .back-top-section {
            margin: 100px 50px 150px 0px;
            display: block;
            position: relative;
        }

        .back-to-top-btn {
            float: right;
            background-color: #7a6ad8;
            border-radius: 3px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            padding: 12px;
            color: #fff;
            width: fit-content;
            transform: translate(10px, -50px);

        }

        .back-top-section a:hover {
            scale: 1.1;
        }

        /* CSS for Card */
        .card {
            display: flex;
            flex-direction: column;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        /* CSS for Card Body and Footer */
        .card-body {
            flex-grow: 1;
            min-height: 120px;
            height: 180px;
            max-height: 200px;
            overflow: hidden;
        }

        .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
        }
    </style>

</head>

<body>

    <!--  Preloader Start  -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!--  Preloader End  -->

    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!--  Logo Start  -->
                        <a href="index.php" class="logo">
                            <h1>NextGen</h1>
                        </a>
                        <!--  Logo End  -->
                        <!--  Menu Start  -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="./index.php" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="./services.php">Services</a></li>
                            <li class="scroll-to-section"><a href="./courses.php">Courses</a></li>
                            <!-- <li class="scroll-to-section"><a href="./team.php">Team</a></li> -->
                            <!-- <li class="scroll-to-section"><a href="./feedback.php">Feedback</a></li> -->
                            <li class="scroll-to-section"><a href="./contact.php">Contact</a></li>
                            <!-- <li class="scroll-to-section"><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-user-plus"></i></a></li> -->
                            <li class="scroll-to-section">
                                <?php
                                if (isset($_SESSION['is_login']) || isset($_SESSION['loggedin']) == true) {

                                    echo '
                                    <div class="btn-group" id="dropdownMenu">
                                        <button class="btn btn-avatar dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown">
                                            My Profile
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="./Learner/learnerProfile.php">Profile</a></li>
                                            <li><a class="dropdown-item" href="./Learner/learnerChangePass.php">Change Password</a>
                                            </li>
                                            <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
                                        </ul>
                                    </div>';
                                } elseif (isset($_SESSION['tloggedin']) == true) {
                                    echo '
                                    <div class="btn-group" id="dropdownMenu">
                                        <button class="btn btn-avatar dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown">
                                            My Profile
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="./Tutor/tutorProfile.php">Profile</a></li>
                                            <li><a class="dropdown-item" href="./Tutor/tutorChangePass.php">Change Password</a>
                                            </li>
                                            <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
                                        </ul>
                                    </div>';
                                } else {
                                    echo '<div class="btn-group">
                                    <button class="btn btn-avatar dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="./l-login.php">Learner Login</a></li>
                                        <li><a class="dropdown-item" href="./t-login.php">Tutor Login</a></li>
                                        <li><a class="dropdown-item" href="./a-login.php">Admin Login</a></li>
                                    </ul>
                                </div>';
                                }
                                ?>



                            </li>

                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!--  Menu End  -->
                    </nav>
                </div>
            </div>
        </div>
    </header>