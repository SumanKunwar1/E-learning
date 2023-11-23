<?php
session_start();
include('./dbConnection.php');

$msg = '';

if (isset($_POST['submit'])) {
    $l_email = $_POST['email'];
    $l_pass = sha1($_POST['password']);
    $confirm_pass = sha1($_POST['confirmPassword']);

    // Form validation
    if (empty($l_email) || empty($l_pass) || empty($confirm_pass)) {
        $msg = "Please fill in all fields.";
    } elseif ($l_pass !== $confirm_pass) {
        $msg = "Passwords do not match.";
    } else {
        $sql = "SELECT * FROM learner  WHERE l_Email = '$l_email'";
        $res = mysqli_query($conn, $sql);
        $NumRows = mysqli_num_rows($res);

        if ($NumRows == 1) {
            // Update password in the database
            $update_sql = "UPDATE learner SET l_Password = '$l_pass' WHERE l_Email = '$l_email'";
            if (mysqli_query($conn, $update_sql)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $l_email;
                $_SESSION['status'] = '1';
                $msg = "Password reset successfully";
            } else {
                $msg = "Failed to reset password.";
            }
        } else {
            $msg = "User not found.";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <style>
        .input-group {
            margin-bottom: 1rem;
        }
    </style>
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
</head>

<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5" style="border-radius: 11px;padding:22px;box-shadow:  17px 17px 49px #a1a1a1,
             -17px -17px 49px #ffffff;">
                <form method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Enter your password">
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                            placeholder="Confirm your password">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Reset your Password</button>
                    <div class="mb-3 mt-4">
                        <a href="./l-signup.php" class="">Register</a>
                        <a href="./l-login.php" class="" style="float:right;">Login</a>
                    </div>
                    <?php if (!empty($msg)): ?>
                        <div class="alert alert-success mt-3">
                            <?php echo $msg; ?>
                        </div>
                    <?php endif; ?>
                    <div class="back_home">
                        <a href="./index.php"><i class="fa-solid fa-house" style="margin-right: 5px;"></i>Back Home</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./assets/js/isotope.min.js"></script>
    <script src="./assets/js/owl-carousel.js"></script>
    <script src="./assets/js/counter.js"></script>
    <script src="./assets/js/custom.js"></script>
    <script src="./Validations/script.js"></script>
    <!-- <script type="text/javascript" src="js/jquery.min.js"></script> -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- <script type="text/javascript" src="js/bootstrap.min.js"></script> -->

    <!-- Font Awesome JS -->
    <script type="text/javascript" src="./js/all.min.js"></script>

    <!-- Student Testimonial Owl Slider JS  -->
    <script type="text/javascript" src="./js/owl.min.js"></script>
    <script type="text/javascript" src="./js/testyslider.js"></script>

    <!-- Student Ajax Call JavaScript -->
    <script type="text/javascript" src="./js/ajaxrequest.js"></script>

    <!-- Admin Ajax Call JavaScript -->
    <script type="text/javascript" src="./js/adminajaxrequest.js"></script>

    <!-- Custom JavaScript -->
    <script type="text/javascript" src="./js/custom.js"></script>
</body>

</html>